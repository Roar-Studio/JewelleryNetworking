(function (window, undefined){
    'use strict';

    Dropzone.autoDiscover = false;
    document.addEventListener("DOMContentLoaded", function() {
        
        let currentGalleryCategoryId = null;
        let maxFilesLimit = 500;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // call from custom.js
        
        // ========================  

        // $('#addGalleryForm').find('input[name="gallery_date"]').pickadate('picker').set('min', new Date());
        let cropperInstance = null;
        let currentFile = null;

        var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
            url: APP_URL + "/api/admin/gallery/file-upload",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            paramName: "file",
            maxFiles: maxFilesLimit,
            acceptedFiles: ".jpg,.jpeg,.png,.gif,.mp4,.mov,.mpeg,.mpg,.mpeg1,.mpeg2,.mpeg4, .webm, .avi, .mkv",
            addRemoveLinks: true,
            dictRemoveFile: "Remove",
            autoProcessQueue: false, // Don't auto-upload
            accept: function(file, done) {
                // Check if it's an image that needs cropping
                if (file.type.match(/image\/(jpeg|jpg|png)/)) {
                    currentFile = file;
                    
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#crop-image').attr('src', e.target.result);
                        $('#crop-image-modal').modal('show');
                        
                        // Initialize Cropper
                        if (cropperInstance) {
                            cropperInstance.destroy();
                        }
                        cropperInstance = new Cropper(document.getElementById('crop-image'), {
                            aspectRatio: NaN, // Free aspect ratio
                            viewMode: 1,
                            responsive: true,
                            autoCropArea: 1
                        });
                    };
                    reader.readAsDataURL(file);
                    done(); // Accept the file
                } else {
                    // For videos and other files, upload directly
                    done();
                    uploadFile(file);
                }
            },
            init: function () {
                const dzInstance = this;
                
                this.on("sending", function(file, xhr, formData) {
                    formData.append("category_id", currentGalleryCategoryId);
                });
                
                this.on("success", function(file, response) {
                    file.serverId = response.data.id;

                    const removeButton = file.previewElement.querySelector(".dz-remove");
                    if (removeButton) {
                        removeButton.addEventListener("click", function (e) {
                            e.preventDefault();
                            e.stopPropagation();

                            if (confirm("Are you sure you want to delete this file?")) {
                                window.axiosApiClient.post(`admin/gallery/removefile/${file.serverId}`, {}, {
                                    headers: {
                                        'Authorization': 'Bearer ' + getAuthToken()
                                    }
                                }).then(res => {
                                    file.previewElement.remove();
                                    toastr.success("File deleted successfully.");
                                    myDropzone.options.maxFiles++;
                                }).catch(err => {
                                    toastr.error("Failed to delete file.");
                                });
                            }
                        });
                    }
                });
                
                this.on("maxfilesexceeded", function(file) {
                    this.removeFile(file);
                    toastr.error("You can only upload up to 500 files.");
                });
            }
        });

        // Function to upload file
        function uploadFile(file) {
            const formData = new FormData();
            formData.append('file', file);
            formData.append('category_id', currentGalleryCategoryId);

            window.axiosApiClient.post('admin/gallery/file-upload', formData, {
                headers: {
                    'Authorization': 'Bearer ' + getAuthToken(),
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                // Check for response.data.data instead of just response.data.status
                if (response.data && response.data.data) {
                    file.serverId = response.data.data.id;
                    
                    // Manually add the file to Dropzone preview
                    myDropzone.emit("addedfile", file);
                    myDropzone.emit("thumbnail", file, URL.createObjectURL(file));
                    myDropzone.emit("success", file, response.data);
                    myDropzone.emit("complete", file);
                    file.status = Dropzone.SUCCESS;
                    myDropzone.files.push(file);
                    
                    toastr.success("File uploaded successfully.");
                } else {
                    myDropzone.emit("error", file, "Upload failed - Invalid response");
                    toastr.error("Failed to upload file.");
                }
            }).catch(error => {
                console.error('Upload error:', error);
                myDropzone.emit("error", file, error.message || "Upload failed");
                toastr.error("Failed to upload file.");
            });
        }

        // Crop and Upload Button Handler
        $(document).on('click', '#crop-and-upload', function() {
            if (!cropperInstance || !currentFile) return;

            const canvas = cropperInstance.getCroppedCanvas({
                maxWidth: 4096,
                maxHeight: 4096,
                imageSmoothingQuality: 'high'
            });

            canvas.toBlob(function(blob) {
                const croppedFile = new File([blob], currentFile.name, {
                    type: currentFile.type,
                    lastModified: Date.now()
                });

                // Upload the cropped image
                uploadFile(croppedFile);

                // Clean up
                cropperInstance.destroy();
                cropperInstance = null;
                currentFile = null;
                $('#crop-image-modal').modal('hide');
            }, currentFile.type);
        });

        // Clean up on modal close
        $('#crop-image-modal').on('hidden.bs.modal', function() {
            if (cropperInstance) {
                cropperInstance.destroy();
                cropperInstance = null;
            }
            if (currentFile) {
                myDropzone.removeFile(currentFile);
                currentFile = null;
            }
        });

        window.gallery_table = $('#gallery-list-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + '/api/admin/gallery/list',
                type: 'GET',
                data: function (d) {
                    d.search_key = $('#search_key').val();
                    d.date_from = $('#date_from').val();
                    d.date_to = $('#date_to').val();
                    d.is_active = $('#is_active').val();
                },
                headers: {
                    'Authorization': 'Bearer ' + getAuthToken()
                },
                dataSrc: function (json) {
                    try {
                        if(USE_ENCRYPTION){
                            const decryptedData = CryptoHelper.decrypt(json.data);
                            json.data = decryptedData.data; // Only update the data array
                            json.recordsTotal = decryptedData.recordsTotal ?? decryptedData.total ?? json.recordsTotal;
                            json.recordsFiltered = decryptedData.recordsFiltered ?? decryptedData.totalFiltered ?? json.recordsFiltered;
                        }
                        return json.data;
                    } catch (err) {
                        console.error('Decryption failed:', err);
                        return [];
                    }
                },
                error: function (xhr, error, thrown) {
                    console.error('Error fetching data:', error);
                    alert('There was an error fetching data. Please try again later.');
                }
            },
            columns: [
                // { data: 'responsive_id', title: '' },
                // { data: 'id', title: 'ID' },
                {
                    data: 'name', 
                    title: 'Gallery Name', 
                    render: function (data, type, full, meta) {
                        var $name = full['name'];
                
                        return (
                            '<div class="d-flex flex-column justify-content-center align-items-start">' +
                            '<a class="emp-name" data-bs-toggle="tooltip" data-bs-placement="top" title="'+ $name +'" href="javascript:void(0);" onclick="fetchGalleryRecords('+ full['id'] +')">' +
                            '<span class="emp-name text-truncate fw-bold">' + $name + '</span>' +
                            '</a>' +
                            '</div>'
                        );
                    } 
                }, 
                {
                    data: 'gallery_type',
                    title: 'Category',
                    render: function (data, type, full, meta) {
                        if (!full['gallery_type']) return '-';
                        
                        // First letter capital, baaki same
                        return full['gallery_type'].charAt(0).toUpperCase() + full['gallery_type'].slice(1).toLowerCase();
                    }
                },
                {
                    data: 'gallery_date',
                    title: 'Start Date',
                    render: function (data, type, full, meta) {
                        return (full['gallery_date']) ? formatDate(full['gallery_date']) : '-';
                    }
                },
                {
                    data: 'is_active', 
                    title: 'Status',
                    render: function (data, type, full, meta) {
                        var statusMapping = {
                            '1': { title: 'Active', class: 'badge-light-success' },
                            '0': { title: 'Inactive', class: 'badge-light-danger' },
                        };
    
                        var statusKey = String(full['is_active']).trim(); // Ensure string consistency
    
                        if (!statusMapping.hasOwnProperty(statusKey)) {
                            return data; // Return default data if value is unexpected
                        }
    
                        return (
                            '<span class="badge rounded-pill ' +
                            statusMapping[statusKey].class +
                            '">' +
                            statusMapping[statusKey].title +
                            '</span>'
                        );
                    } 
                },
                {
                    data: 'id', 
                    title: 'Actions', 
                    orderable: false,
                    render: function (data, type, full, meta) {
                        let html = '<div class="d-inline-flex">';
                    
                        html += '<a href="javascript:;" class="item-edit me-2" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Folder" onclick="fetchGalleryRecords(' + full['id'] + ')">' +
                            '<i class="bi bi-pencil-square"></i>' +
                            '</a>';

                        html += '<a href="javascript:;" class="item-edit me-2" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="Add Media" onclick="fetchGalleryRecords(' + full['id'] + ', \'media\')">' +
                            '<i class="bi bi-upload"></i>' +
                            '</a>';

                        html += '<a href="javascript:;" class="item-edit me-2" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="Add Video" onclick="fetchGalleryRecords(' + full['id'] + ', \'video\')">' +
                            '<i class="bi bi-camera-video"></i>' +
                            '</a>';
                        
                        html += '<a href="javascript:;" class="item-edit text-danger me-2" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Folder" onclick="deleteGalleryRecords(' + full['id'] + ')">' +
                            '<i class="bi bi-trash"></i>' +
                            '</a>';
                    
                        html += '</div>';
                        return html;
                    }                    
                }, 
            ],
            drawCallback: function(settings) {
                $('[data-bs-toggle="tooltip"]').tooltip();
            },
            order: [[0, 'asc']],
            dom: '<"table-box"t><"d-flex border-top justify-content-between mx-0"<""l><""i><""p>>',
            displayLength: 15,
            lengthMenu: [15, 25, 50, 75, 100],
            language: {
                paginate: {
                    previous: '&nbsp;',
                    next: '&nbsp;'
                },
                emptyTable: `<p class="text-center my-3">No gallery found</p>`
            }
        });

        window.fetchGalleryRecords = function(id, selected_form = null){
            $('input[name="gallery_id"]').val(id);
            // $('#gallery-detail-modals').modal('show');
            fetchGalleryDetails(selected_form);
        }
        
        window.deleteGalleryRecords = function(id){
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to delete this gallery record?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Delete it!",
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    loadingBlock();
                    window.axiosApiClient.post(`admin/gallery/remove/${id}`,{},{
                        headers: {
                            'Authorization': 'Bearer ' + getAuthToken()
                        }
                    }).then(response => {
                        if (response.data.status) {
                            toastr.success('Gallery deleted successfully.', 'Success!');
                            gallery_table.ajax.reload();
                        }
                    });
    
                }
            });
            
        }

        window.fetchGalleryDetails = function (selected_form) {
            loadingBlock();
            let id = $('input[name="gallery_id"]').val();

            window.axiosApiClient.post(`admin/gallery/view/${id}`, {}, {
                headers: {
                    'Authorization': 'Bearer ' + getAuthToken()
                }
            }).then(response => {
                if(selected_form != 'media'){
                    var editGalleryForm = $('#editGalleryForm');
                    window.resetForm('#editGalleryForm');
                }

                if (response.data.status) {
                    var gallery = response.data.data;

                    // Set form fields
                    if(selected_form != 'media'){
                        editGalleryForm.find('[name="gallery_id"]').val(gallery.id);
                        editGalleryForm.find('[name="gallery_name"]').val(gallery.name);
                        editGalleryForm.find('[name="location"]').val(gallery.location);
                        editGalleryForm.find('[name="gallery_type"][value="' + gallery.gallery_type + '"]').prop('checked', true);
                        editGalleryForm.find('[name="gallery_date"]').pickadate('picker').set(
                            'select',
                            moment(gallery.gallery_date, "YYYY-MM-DD").format("DD/MM/YYYY")
                        );
                        
                        editGalleryForm.find('[name="is_active"]').prop('checked', gallery.is_active == 1).val(gallery.is_active);
                    }
                    else if(selected_form == 'video'){
                        $('#addVideoForm').find('[name="gallery_id"]').val(gallery.id);
                        
                        // Reset validator
                        if ($('#addVideoForm').data('validator')) {
                            $('#addVideoForm').validate().resetForm();
                        }
                        
                        // Reset form and keep only one input
                        $('#video-inputs-container').html(`
                            <div class="video-input-row mb-2">
                                <div class="row align-items-start">
                                    <div class="col-10">
                                        <input type="url" class="form-control" name="youtube_urls[]" placeholder="Enter YouTube URL" required />
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-primary btn-md add-video-input w-100">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `);
                        
                        // Add validation to the initial input
                        const initialInput = $('#video-inputs-container input[name="youtube_urls[]"]:first');
                        initialInput.rules('add', {
                            required: true,
                            url: true,
                            youtube_url: true,
                            messages: {
                                required: "YouTube URL is required.",
                                url: "Please enter a valid URL.",
                                youtube_url: "Please enter a valid YouTube URL."
                            }
                        });
                        
                        $('#upload-videos-modals').modal('show');
                    }
                    else{
                        currentGalleryCategoryId = gallery.id;
                        $('.folder_name').text(gallery.name);
                        myDropzone.removeAllFiles(true);
                        myDropzone.options.maxFiles = Math.max(0, maxFilesLimit - gallery.media_files.length);

                        if (Array.isArray(gallery.media_files)) {
                            gallery.media_files.forEach(file => {
                                const mockFile = {
                                    name: `File_${file.id}.png`, // or just "Image" + ID
                                    size: 123456, // Dummy size
                                    serverId: file.id
                                };

                                let imageUrl;
                                const videoExtensions = [
                                    'mp4', 'mov', 'mpeg', 'mpg', 'mpeg1', 'mpeg2', 'mpeg4', 'webm', 'avi', 'mkv'
                                ];

                                const fileExtension = file.url.split('.').pop().split('?')[0].toLowerCase().trim();

                                if (videoExtensions.includes(fileExtension)) {
                                    imageUrl = '/new_ui/assets/images/video-placeholder.png';
                                } else {
                                    imageUrl = `${APP_URL}/storage/${file.url}`;
                                }
                                myDropzone.emit("addedfile", mockFile);
                                myDropzone.emit("thumbnail", mockFile, imageUrl);
                                myDropzone.emit("complete", mockFile);
                                mockFile.status = myDropzone.SUCCESS;       // ✅ Mark as accepted
                                myDropzone.files.push(mockFile);
                                
                                // Add custom remove functionality
                                const removeBtn = mockFile.previewElement.querySelector(".dz-remove");
                                if (removeBtn) {
                                    removeBtn.addEventListener("click", function (e) {
                                        e.preventDefault();
                                        e.stopPropagation();

                                        if (confirm("Are you sure you want to delete this file?")) {
                                            window.axiosApiClient.post(`${APP_URL}/api/admin/gallery/removefile/${file.id}`, {}, {
                                                headers: {
                                                    'Authorization': 'Bearer ' + getAuthToken()
                                                }
                                            }).then(() => {
                                                mockFile.previewElement.remove();
                                                toastr.success("File deleted successfully.");
                                                myDropzone.options.maxFiles++;


                                            }).catch(() => {
                                                toastr.error("Failed to delete file.");
                                            });
                                        }
                                    });
                                }
                            });
                        }

                    }

                    if(selected_form == 'media'){
                        $('#upload-files-modals').modal('show');
                    }
                    else if(selected_form == 'video'){
                        $('#upload-videos-modals').modal('show');
                    }
                    else{
                        $('#gallery-detail-modals').modal('show');
                    }
                }
            });
        }


        $('#search_key').on('keyup input change', function() {
            let clear_btn = $(this).closest('.table-header-search').find('.clear-btn');
            if ($(this).val().length > 0) {
                clear_btn.show();  // Show button when input has text
            } else {
                clear_btn.hide();  // Hide button when empty
            }
        });
    
        $('.clear-btn').on('click', function() {
            $(this).closest('.table-header-search').find('#search_key').val('').trigger('change'); // Clear input and trigger event
            gallery_table.ajax.reload();
        });

        $(document).on('click', '.add-gallery', function () {
            var addGalleryForm = $('#addGalleryForm');
            window.resetForm('#addGalleryForm');
            $('#add-gallery-modals').modal('show');
        });
    
    
        $('#resetFilters').on('click', function () {
            $('#search_key').val('');
            $('#date_from').val('');
            $('#date_to').val('');
            $('#is_active').val('').trigger('change');
            gallery_table.ajax.reload(); // Reload table with reset filters
            $(this).prop('disabled', true);
        });
    
        $('#search_key, #is_active').on('change keyup', function () {
            gallery_table.ajax.reload(); // Reload table when any filter changes
        });

        $('.filter-container').on('change keyup', '#search_key, #is_active', function () {
            let isAnyFieldFilled = false;
        
            $('.filter-container').find('input, select').each(function () {
                if ($(this).val().trim() !== '') {
                    isAnyFieldFilled = true;
                    return false; // Exit loop early if any field is filled
                }
            });
        
            $('#resetFilters').prop('disabled', !isAnyFieldFilled);
        });

        $('#addGalleryForm').validate({
            rules: {
                gallery_name: {
                    required: true,
                    maxlength: 50,
                },
                // gallery_date: {
                //     required: true,
                // },
                gallery_type: {
                    required: true
                },
                // location: {
                //     required: true,
                //     maxlength: 50,
                // },
                status: {
                    required: true
                }
            },
            messages: {
                gallery_name: {
                    required: "Gallery name is required.",
                    maxlength: "Gallery name cannot exceed 50 characters."
                },
                // gallery_date: {
                //     required: "Start date is required."
                // },
                // location: {
                //     required: 'location is required.',
                //     maxlength: "Location cannot exceed 50 characters."
                // },
                gallery_type: {
                    required: "Gallery type is required."
                },
                status: {
                    required: "Status is required."
                }
            },
            onkeyup: function (element) {
                $(element).valid(); // Validate on keypress
            },
            onfocusout: function (element) {
                $(element).valid(); // Validate on focus out
            },
            onchange: function (element) {
                $(element).valid(); // Validate on change
            },
            submitHandler: async function (form, event) {
                event.preventDefault();
                $(form).find('button[type="submit"]').attr('disabled', 'disabled');
                
                const payload = {
                    gallery_name: $(form).find("[name=gallery_name]").val(),
                    gallery_date_submit: $(form).find("[name=gallery_date_submit]").val(),
                    location: $(form).find("[name=location]").val(),
                    gallery_type: $(form).find("[name=gallery_type]:checked").val(),
                    is_active: $(form).find("[name=is_active]").val(),
                };

                loadingBlock();

                window.axiosApiClient.post('admin/gallery/addnew', payload, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken(),
                    }
                }).then(response => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                    toastr.success('Gallery details have been added successfully.', 'Success!');
                    $('#add-gallery-modals').modal('hide');

                    gallery_table.ajax.reload();
                }).catch(error => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                })
            }
        });

        $('#editGalleryForm').validate({
            rules: {
                gallery_name: {
                    required: true,
                    maxlength: 50,
                },
                // gallery_date: {
                //     required: true,
                // },
                // location: {
                //     required: true,
                //     maxlength: 50,
                // },
                gallery_type: {
                    required: true
                },
                status: {
                    required: true
                }
            },
            messages: {
                gallery_name: {
                    required: "Gallery name is required.",
                    maxlength: "Gallery name cannot exceed 50 characters."
                },
                // gallery_date: {
                //     required: "Start date is required."
                // },
                // location: {
                //     required: 'location is required',
                //     maxlength: "Location cannot exceed 50 characters."
                // },
                gallery_type: {
                    required: "Gallery type is required."
                },
                status: {
                    required: "Status is required."
                }
            },
            onkeyup: function (element) {
                $(element).valid(); // Validate on keypress
            },
            onfocusout: function (element) {
                $(element).valid(); // Validate on focus out
            },
            onchange: function (element) {
                $(element).valid(); // Validate on change
            },
            submitHandler: async function (form, event) {
                event.preventDefault();
                $(form).find('button[type="submit"]').attr('disabled', 'disabled');

                const payload = {
                    gallery_id : $(form).find("[name=gallery_id]").val(),
                    gallery_name: $(form).find("[name=gallery_name]").val(),
                    gallery_date_submit: $(form).find("[name=gallery_date_submit]").val(),
                    location: $(form).find("[name=location]").val(),
                    gallery_type: $(form).find("[name=gallery_type]:checked").val(),
                    is_active: $(form).find("[name=is_active]").val(),
                };

                loadingBlock();

                window.axiosApiClient.post('admin/gallery/update', payload, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(response => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                    toastr.success('Gallery have been updated successfully.', 'Success!');
                    $('#gallery-detail-modals').modal('hide');
                    gallery_table.ajax.reload();
                }).catch(error => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                })
            }
        }); 

        //=================================add video section==============================================
        window.fetchGalleryDetails = function (selected_form) {
            loadingBlock();
            let id = $('input[name="gallery_id"]').val();

            window.axiosApiClient.post(`admin/gallery/view/${id}`, {}, {
                headers: {
                    'Authorization': 'Bearer ' + getAuthToken()
                }
            }).then(response => {
                if(selected_form != 'media'){
                    var editGalleryForm = $('#editGalleryForm');
                    window.resetForm('#editGalleryForm');
                }

                if (response.data.status) {
                    var gallery = response.data.data;

                    // Set form fields for edit gallery form
                    if(selected_form != 'media' && selected_form != 'video'){
                        editGalleryForm.find('[name="gallery_id"]').val(gallery.id);
                        editGalleryForm.find('[name="gallery_name"]').val(gallery.name);
                        editGalleryForm.find('[name="location"]').val(gallery.location);
                        editGalleryForm.find('[name="gallery_type"][value="' + gallery.gallery_type + '"]').prop('checked', true);
                        editGalleryForm.find('[name="gallery_date"]').pickadate('picker').set(
                            'select',
                            moment(gallery.gallery_date, "YYYY-MM-DD").format("DD/MM/YYYY")
                        );
                        
                        editGalleryForm.find('[name="is_active"]').prop('checked', gallery.is_active == 1).val(gallery.is_active);
                    }
                    else if(selected_form == 'video'){
                        $('#addVideoForm').find('[name="gallery_id"]').val(gallery.id);
                        
                        // Reset validator
                        if ($('#addVideoForm').data('validator')) {
                            $('#addVideoForm').validate().resetForm();
                        }
                        
                        // Reset form
                        $('#video-inputs-container').empty();
                        
                        // If videos exist, populate them
                        if(gallery.videos && gallery.videos.length > 0) {
                            gallery.videos.forEach(function(video, index) {
                                const videoInputRow = createVideoInputRow(video.youtube_url, video.id, index === 0);
                                $('#video-inputs-container').append(videoInputRow);
                            });
                        } else {
                            // Add one empty input if no videos exist
                            const emptyInputRow = createVideoInputRow('', null, true);
                            $('#video-inputs-container').append(emptyInputRow);
                        }
                        
                        // Re-initialize validation for all inputs
                        initializeVideoValidation();
                        
                        $('#upload-videos-modals').modal('show');
                    }
                    else{
                        // Media upload logic (existing)
                        currentGalleryCategoryId = gallery.id;
                        $('.folder_name').text(gallery.name);
                        myDropzone.removeAllFiles(true);
                        myDropzone.options.maxFiles = Math.max(0, maxFilesLimit - gallery.media_files.length);

                        if (Array.isArray(gallery.media_files)) {
                            gallery.media_files.forEach(file => {
                                const mockFile = {
                                    name: `File_${file.id}.png`,
                                    size: 123456,
                                    serverId: file.id
                                };

                                let imageUrl;
                                const videoExtensions = [
                                    'mp4', 'mov', 'mpeg', 'mpg', 'mpeg1', 'mpeg2', 'mpeg4', 'webm', 'avi', 'mkv'
                                ];

                                const fileExtension = file.url.split('.').pop().split('?')[0].toLowerCase().trim();

                                if (videoExtensions.includes(fileExtension)) {
                                    imageUrl = '/new_ui/assets/images/video-placeholder.png';
                                } else {
                                    imageUrl = `${APP_URL}/storage/${file.url}`;
                                }
                                myDropzone.emit("addedfile", mockFile);
                                myDropzone.emit("thumbnail", mockFile, imageUrl);
                                myDropzone.emit("complete", mockFile);
                                mockFile.status = myDropzone.SUCCESS;
                                myDropzone.files.push(mockFile);
                                
                                // Add custom remove functionality
                                const removeBtn = mockFile.previewElement.querySelector(".dz-remove");
                                if (removeBtn) {
                                    removeBtn.addEventListener("click", function (e) {
                                        e.preventDefault();
                                        e.stopPropagation();

                                        if (confirm("Are you sure you want to delete this file?")) {
                                            window.axiosApiClient.post(`${APP_URL}/api/admin/gallery/removefile/${file.id}`, {}, {
                                                headers: {
                                                    'Authorization': 'Bearer ' + getAuthToken()
                                                }
                                            }).then(() => {
                                                mockFile.previewElement.remove();
                                                toastr.success("File deleted successfully.");
                                                myDropzone.options.maxFiles++;
                                            }).catch(() => {
                                                toastr.error("Failed to delete file.");
                                            });
                                        }
                                    });
                                }
                            });
                        }
                    }

                    if(selected_form == 'media'){
                        $('#upload-files-modals').modal('show');
                    }
                    else if(selected_form == 'video'){
                        // Already handled above
                    }
                    else{
                        $('#gallery-detail-modals').modal('show');
                    }
                }
            });
        }

        // Create video input row
        function createVideoInputRow(url = '', videoId = null) {
            return `
                <div class="video-input-row mb-2" data-video-id="${videoId || ''}">
                    <div class="row align-items-start">
                        <div class="col-10">
                            <input type="url" class="form-control" name="youtube_urls[]" 
                                placeholder="Enter YouTube URL" value="${url}" />
                            <input type="hidden" name="video_ids[]" value="${videoId || ''}" />
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-danger btn-md remove-video-input w-100">
                                <i class="bi bi-dash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }

        // Function to initialize video inputs (no validation)
        function initializeVideoValidation() {
            // Simply ensure video inputs container exists
            if ($('#video-inputs-container .video-input-row').length === 0) {
                const emptyInputRow = createVideoInputRow('', null, true);
                $('#video-inputs-container').append(emptyInputRow);
            }
        }

        // Add video input (triggered by plus button row)
        $(document).on('click', '.add-video-input', function() {
            const newRow = createVideoInputRow('', null);
            $('#video-inputs-container').append(newRow);
        });

        // Remove video input
        $(document).on('click', '.remove-video-input', function() {
            const videoRow = $(this).closest('.video-input-row');
            const videoId = videoRow.data('video-id');

            if(videoId) {
                if (confirm("Are you sure you want to delete this video?")) {
                    window.axiosApiClient.post(`admin/gallery/remove-video/${videoId}`, {}, {
                        headers: { 'Authorization': 'Bearer ' + getAuthToken() }
                    }).then(response => {
                        if(response.data.status) {
                            toastr.success('Video deleted successfully.');
                            videoRow.remove();
                        }
                    }).catch(error => {
                        toastr.error('Failed to delete video.');
                    });
                }
            } else {
                videoRow.remove();
            }
        });

        // Also allow removing the first video input by changing the button
        // $(document).on('click', '.add-video-input', function() {
        //     // Change the first button to remove button when adding new input
        //     $(this).removeClass('btn-primary add-video-input')
        //         .addClass('btn-danger remove-video-input')
        //         .html('<i class="bi bi-dash"></i>');
            
        //     const newInputRow = createVideoInputRow('', null, false);
        //     $('#video-inputs-container').append(newInputRow);
        // });

        // Update the form submission handler - removed all validation
        $('#addVideoForm').submit(async function (event) {
            event.preventDefault();
            $(this).find('button[type="submit"]').attr('disabled', 'disabled');
            
            const videosData = [];
            
            $('#video-inputs-container .video-input-row').each(function() {
                const url = $(this).find('input[name="youtube_urls[]"]').val().trim();
                const videoId = $(this).find('input[name="video_ids[]"]').val();
                
                if(url) {
                    videosData.push({
                        id: videoId || null,
                        youtube_url: url
                    });
                }
            });

            const payload = {
                gallery_id: $(this).find("[name=gallery_id]").val(),
                videos: videosData
            };

            loadingBlock();

            window.axiosApiClient.post('admin/gallery/manage-videos', payload, {
                headers: {
                    'Authorization': 'Bearer ' + getAuthToken()
                }
            }).then(response => {
                $(this).find('button[type="submit"]').removeAttr('disabled');
                toastr.success('Videos have been updated successfully.', 'Success!');
                $('#upload-videos-modals').modal('hide');
                gallery_table.ajax.reload();
            }).catch(error => {
                $(this).find('button[type="submit"]').removeAttr('disabled');
            })
        });

        // Add custom YouTube URL validation method
        $.validator.addMethod("youtube_url", function(value, element) {
            if (!value) return true; // Let required rule handle empty values
            
            const youtubePattern = /^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+/;
            return youtubePattern.test(value);
        }, "Please enter a valid YouTube URL.");

    });

    // NOTE: ------ PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
})(window);