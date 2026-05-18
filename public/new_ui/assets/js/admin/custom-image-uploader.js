(function (window, undefined) {
    'use strict';

    const defaultImage = 'https://upload.wikimedia.org/wikipedia/commons/3/3f/Placeholder_view_vector.svg';

    document.addEventListener('DOMContentLoaded', function() {
        window.createUploadBox = function(name, removeApiCall = null, apiCallId = 0 , removable = true) {
            const box = document.createElement('div');
            box.className = 'upload-box';
            box.dataset.name = name;
            box.innerHTML = `
                <img src="${defaultImage}" class="upload-trigger" alt="Click or Drop">
                <input type="file" name="${name}" accept="image/*">
                ${removable ? `<button type="button" class="remove-image-btn ${removeApiCall}" data-id="${apiCallId}">×</button>` : ''}

            `;
            initUploadBox(box);
            return box;
        };

        window.initUploadBox = function(box) {
            const imgTrigger = box.querySelector('.upload-trigger');
            const fileInput = box.querySelector('input[type="file"]');
            const removeBtn = box.querySelector('.remove-image-btn');

            if (!imgTrigger || !fileInput) {
                console.warn('upload-box missing necessary elements:', box);
                return;
            }

            fileInput.addEventListener('click', function(event) {
                if (imgTrigger.src !== defaultImage) {
                    event.preventDefault();
                }
            });

            imgTrigger.addEventListener('click', () => fileInput.click());

            fileInput.addEventListener('change', () => {
                handleFileSelection(fileInput, imgTrigger, removeBtn);
            });

            box.addEventListener('dragover', (e) => {
                e.preventDefault();
                box.classList.add('dragover');
            });

            box.addEventListener('dragleave', (e) => {
                e.preventDefault();
                box.classList.remove('dragover');
            });

            box.addEventListener('drop', (e) => {
                e.preventDefault();
                box.classList.remove('dragover');
                handleFileSelection(fileInput, imgTrigger, removeBtn, e.dataTransfer.files);
            });

            box.setImage = function(url) {
                if (url) {
                    imgTrigger.src = `/storage/${url}`;
                    if (removeBtn) removeBtn.style.display = 'block';
                } else {
                    imgTrigger.src = defaultImage;
                    if (removeBtn) removeBtn.style.display = 'none';
                }
            };

            if (removeBtn) {
                removeBtn.addEventListener('click', () => {
                    resetImage(imgTrigger, fileInput, box);
                });
            }
        };

        window.handleFileSelection = function(fileInput, imgTrigger, removeBtn, files) {
            const selectedFiles = files || fileInput.files;
            if (selectedFiles.length > 0) {
                const file = selectedFiles[0]; // Single file upload
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgTrigger.src = e.target.result;
                        if (removeBtn) removeBtn.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            }
        };

        window.resetImage = function(imgTrigger, fileInput, box) {
            if (!imgTrigger || !fileInput || !box) {
                console.warn('resetImage() called with missing elements:', { imgTrigger, fileInput, box });
                return;
            }

            const removeBtn = box.querySelector('.remove-image-btn');

            if (imgTrigger.src !== defaultImage) {
                imgTrigger.src = defaultImage;
                fileInput.value = ""; // Clear the file input
                fileInput.dispatchEvent(new Event('change'));
                if (removeBtn) {
                    removeBtn.style.display = (fileInput.name.includes('[]')) ? 'block' : 'none';
                }
            } else {
                if (fileInput.name.includes('[]')) {
                    box.remove();
                }
            }
        };


        // Initialize all existing upload-boxes
        document.querySelectorAll('.upload-box').forEach(initUploadBox);

    });

    // Function to convert file to Base64
    window.getBase64 = async function(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onloadend = () => resolve(reader.result);
            reader.onerror = reject;
            reader.readAsDataURL(file);
        });
    };

    // Handle full form submission
    window.handleFormSubmission = async function(form) {
        const bannerInputs = $(form).find("[name='banner[]']");
        const sponsorInputs = $(form).find("[name='sponsor[]']");
        let bannerBase64 = [];
        let sponsorBase64 = [];

        for (const bannerInput of bannerInputs) {
            if (bannerInput.files.length > 0) {
                const bannerFile = bannerInput.files[0];
                const base64 = await getBase64(bannerFile);
                bannerBase64.push(base64);
            }
        }

        for (const sponsorInput of sponsorInputs) {
            if (sponsorInput.files.length > 0) {
                const sponsorFile = sponsorInput.files[0];
                const base64 = await getBase64(sponsorFile);
                sponsorBase64.push(base64);
            }
        }

        const payload = {
            name: $(form).find("[name=name]").val(),
            description: $(form).find("[name=description]").val(),
            event_datetime: $(form).find("[name=event_datetime]").val(),
            amount_in_inr: $(form).find("[name=amount_in_inr]").val(),
            amount_in_usd: $(form).find("[name=amount_in_usd]").val(),
            venue_address: $(form).find("[name=venue_address]").val(),
            google_maps_link: $(form).find("[name=google_maps_link]").val(),
            total_seats: $(form).find("[name=total_seats]").val(),
            display_start_date_submit: $(form).find("[name=display_start_date_submit]").val(),
            display_end_date_submit: $(form).find("[name=display_end_date_submit]").val(),
            is_active: $(form).find("[name=is_active]").val(),
            banner: bannerBase64,
            sponsors: sponsorBase64
        };

        console.log(payload);
        /*
        $.ajax({
            url: '/your-server-endpoint',
            method: 'POST',
            data: payload,
            success: function(response) {
                console.log('Form submitted successfully:', response);
            },
            error: function(error) {
                console.log('Error submitting form:', error);
            }
        });
        */
    };

})(window);
