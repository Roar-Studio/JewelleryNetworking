const APP_URL = document.querySelector("meta[name='app-url']").getAttribute("content");
const USE_ENCRYPTION = false;

window.CryptoHelper = (() => {
    
    const SECRET_KEY = CryptoJS.enc.Utf8.parse('12345678901234567890123456789012');
    const IV = CryptoJS.enc.Utf8.parse('1234567890123456');
    

    const encrypt = (data) => {
        const json = JSON.stringify(data);
        const encrypted = CryptoJS.AES.encrypt(json, SECRET_KEY, {
            iv: IV,
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7
        });
        return encrypted.toString();
    };
    
    const decrypt = (cipherText) => {
        const decrypted = CryptoJS.AES.decrypt(cipherText, SECRET_KEY, {
            iv: IV,
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7
        });
        const json = decrypted.toString(CryptoJS.enc.Utf8);
        return JSON.parse(json);
    };
    

    return {
        encrypt,
        decrypt,
    };
})();

window.axiosApiClient = axios.create({
    baseURL: `${APP_URL}/api/`,
    headers: {
        'Content-Type': 'application/json'
    }
});

window.axiosApiClient.interceptors.request.use(config => {
    if (USE_ENCRYPTION && config.data && !(config.data instanceof FormData)) {
        config.data = { data: CryptoHelper.encrypt(config.data) };
    }
    return config;
});

// Add a global interceptor for 401 errors
window.axiosApiClient.interceptors.response.use(
    response => {
        unloadingBlock();
        
        if (USE_ENCRYPTION && response.data?.data) {
            try {
                response.data = CryptoHelper.decrypt(response.data.data);
            } catch (e) {
                console.error("Decryption failed", e);
                toastr.error("Response decryption failed", "Error!");
            }
        }
        return response;
    },
    error => {
        unloadingBlock();
        console.log(error ,' : errer');
        if (!error.response) {
            toastr.error('Network error. Please check your internet connection.', 'Error!', {
                closeButton: true,    
                progressBar: false,    
                positionClass: "toast-top-right",
                timeOut: 3000,           
                extendedTimeOut: 0     
            });
            //Swal.fire("Error!", "Network error. Please check your internet connection.", "error");
            return Promise.reject(error);
        }

        if (USE_ENCRYPTION && error.response.data?.data) {
            error.response.data = CryptoHelper.decrypt(error.response.data.data);
        }    
        const { status, data } = error.response;

        if (status === 401) {
            let tokenType = localStorage.getItem('tokenType');
            
            if(error.config.url == '/user'){
                return false;
            }
            toastr.error('Session expired. Please log in again.', 'Error!', {
                closeButton: true,    
                progressBar: false,    
                positionClass: "toast-top-right",
                timeOut: 3000,           
                extendedTimeOut: 0     
            });
            
            if(tokenType && tokenType == 'customer'){
                localStorage.removeItem("userData");
                localStorage.removeItem("tokenExpiry");
                localStorage.removeItem("tokenType");
                localStorage.removeItem("authToken");
                window.location.href = '/login';
            }
            else{
                localStorage.removeItem('userDataAdmin');
                localStorage.removeItem('tokenExpiryAdmin');
                localStorage.removeItem('authTokenAdmin');
                localStorage.removeItem('sessionIdAdmin');
                window.location.href = '/admin/login';
            }
        }
        else if(status === 419) {
            let tokenType = localStorage.getItem('tokenType');
            if(tokenType == 'admin'){
                window.location.href = '/admin/login';
            }
            else if(error.config.url != '/user'){
                window.location.href = '/login';
            }
        }
        else if (status === 422) {

            let print_error = data?.message;
            if(data?.message  == 'Validation failed'){
                print_error = Object.values(data.data)[0][0]; 
            }
            toastr.error(print_error, 'Error!');
        }
        else if (data?.message){
            toastr.error(data?.message, 'Error!');
            //Swal.fire("Error!", data?.message, "error");
        }
        
        else {
            toastr.error('Something went wrong', 'Error!', {
                closeButton: true,    
                progressBar: false,    
                positionClass: "toast-top-right",
                timeOut: 3000,           
                extendedTimeOut: 0     
            });
            //Swal.fire("Error!", "Something went wrong", "error");
        }
        return Promise.reject(error);
    }
);

window.loadingBlock = function(){
    $.blockUI({
        message:
            '<div class="d-flex justify-content-center align-items-center"><p class="me-50 mb-0">Please wait...</p><div class="spinner-grow spinner-grow-sm text-white" role="status"></div></div>',
        css: {
            backgroundColor: 'transparent',
            color: '#fff',
            border: '0'
        },
        overlayCSS: {
            opacity: 0.5
        }
    });
}

window.unloadingBlock = function(){
        $.unblockUI();
}
