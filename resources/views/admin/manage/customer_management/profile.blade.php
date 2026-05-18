<!-- <div class="d-flex justify-content-end mb-1">
    <button class="btn common-btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Coming Soon...."><i class="bi bi-clock-history me-25"></i>Activity History</button>
</div> -->
<form id="editCustomerForm">
    <input type="hidden" name="user_id" value="">

    <div class="row">

        <!-- First Name -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label required">First Name</label>
            <input type="text" class="form-control" name="first_name" placeholder="Enter First Name"/>
        </div>

        <!-- Last Name -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name"/>
        </div>

        <!-- username -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label required">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Enter username" maxlength="50"/>
            <div class="username_feedback text-end"></div>
        </div>

        <!-- Email ID -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label required">Email ID</label>
            <input type="email" name="email" class="form-control" placeholder="eg: user@example.com" disabled/>
        </div>

        <!-- Mobile Number -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label">Mobile Number</label>
            <input type="text" class="form-control mobile" name="mobile_no" placeholder="Enter Mobile Number" disabled/>
        </div>

        <div class="form-group mb-2 col-md-6">
            <label class="form-label required">Industry</label>
            <select class="select2InModal select2 form-select category_id" name="category_id" data-placeholder="Select Industry">
                <option></option>
            </select>
        </div>
        <div class="form-group mb-2 col-md-6">
            <label class="form-label required">Company Name</label>
            <input type="text" class="form-control" name="company_name" placeholder="Enter company name">
        </div>
        <div class="form-group mb-2 col-md-6">
            <label class="form-label required">Company Address</label>
            <input type="text" class="form-control" name="company_address" placeholder="Enter address here">
        </div>
        <div class="form-group mb-2 col-md-6">
            <label class="form-label">Google map link</label>
            <input type="text" class="form-control" name="google_map_link" placeholder="Enter link">
        </div>
        <div class="form-group mb-2 col-md-6">
            <label class="form-label">Business Description</label>
            <input type="text" class="form-control" name="business_description" placeholder="Enter description here">
        </div>
        <!-- Tax Id -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label">Tax Id</label>
            <input type="text" class="form-control" name="trn_no" placeholder="Enter Tax Id"/>
        </div>

        <!-- Website URL -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label">Website URL</label>
            <input type="text" class="form-control" name="website" placeholder="Enter Website URL"/>
        </div>

        <!-- Facebook Link -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label">Facebook Link</label>
            <input type="text" class="form-control" name="facebook_link" placeholder="Enter Facebook Link"/>
        </div>

        <!-- X (formerly Twitter) Link -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label">X (Twitter) Link</label>
            <input type="text" class="form-control" name="x_link" placeholder="Enter X (Twitter) Link"/>
        </div>

        <div class="form-group mb-2 col-md-6">
            <label class="form-label">Linkedin link</label>
            <input type="text" class="form-control" name="linkedin_link" placeholder="Enter linkedin link">
        </div>

        <!-- Google Link -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label">Youtube Link</label>
            <input type="text" class="form-control" name="youtube_link" placeholder="Enter Youtube Link"/>
        </div>

        <!-- Instagram Link -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label">Instagram Link</label>
            <input type="text" class="form-control" name="instagram_link" placeholder="Enter Instagram Link"/>
        </div>
        
        <!-- Is Active? -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-check-label mb-50">Is Active?</label>
            <div class="form-check form-check-primary form-switch">
                <input name="is_active" type="checkbox" class="form-check-input"/>
                <input type="hidden" name="is_active" value="1">
            </div>
        </div>

        <!-- Specialization -->
        <div class="form-group mb-2 col-md-12">
            <label class="form-label">Specialization</label>
            <textarea class="form-control" name="specialization" placeholder="Enter Specialization" rows="3"></textarea>
        </div>

        <!-- Profile Photo -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label">Profile Photo</label>
            <div class="profile_photo-wrapper wrapper">
                <!-- Only one upload box -->
                <div class="upload-box" data-name="profile_photo">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/3f/Placeholder_view_vector.svg" class="upload-trigger" alt="Click or Drop">
                    <input type="file" name="profile_photo" accept="image/*">
                    <p class="remove-image-btn" style="display: none;">×</p>
                </div>
            </div>
        </div>

        <div class="form-group mb-2 col-md-4">
            <label class="form-label">Company Logo</label>
            
            <div class="company_logo-wrapper wrapper">
                <!-- Only one upload box -->
                <div class="upload-box" data-name="company_logo">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/3f/Placeholder_view_vector.svg" class="upload-trigger mb-25" alt="Click or Drop">
                    <input type="file" name="company_logo" accept="image/*">
                    <p class="remove-image-btn" style="display: none;">×</p>
                </div>
            </div>
        </div>

        <div class="form-group mb-4 col-md-12">
            <label class="form-label">
                Media Images
                <button type="button" class="btn btn-primary btn-sm add-btn ms-50 addmediaBtn" data-type="media[]">+ Add Images</button>
            </label>
            <div class="media-wrapper wrapper">
            </div>
        </div>
        <div class="form-group mb-2 col-md-12">
            <label class="form-label">Company Video</label>

            <div class="company_video-wrapper wrapper">
                <div class="upload-box" data-name="company_video">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/3f/Placeholder_view_vector.svg" class="upload-placeholder mb-25" alt="Click or Drop">
                    <input type="file" name="company_video" accept="video/*">
                    <p class="remove-video-btn" style="display: none;">×</p>
                    <video class="upload-video-trigger mb-25" controls style="display: none; width: 100%; max-height: 300px;">
                        <source>
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>


    </div>

    <!-- Submit Buttons -->
    <div class="d-flex justify-content-between">
        <label></label>
        <div>
            <button type="reset" class="btn common-btn btn-outline-secondary me-50" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn common-btn btn-primary">Update</button>
        </div>
    </div>
</form>

