// cryptoHelper.js
// window.CryptoHelper = (() => {
//     const SECRET_KEY = 'JewelleryNetwoking'; // Same key logic as backend
//     const USE_ENCRYPTION = true;

//     function encrypt(data) {
//         const json = JSON.stringify(data);
//         return CryptoJS.AES.encrypt(json, SECRET_KEY).toString();
//     }

//     function decrypt(cipher) {
//         const bytes = CryptoJS.AES.decrypt(cipher, SECRET_KEY);
//         const json = bytes.toString(CryptoJS.enc.Utf8);
//         return JSON.parse(json);
//     }

//     return {
//         encrypt,
//         decrypt,
//         USE_ENCRYPTION
//     };
// })();
