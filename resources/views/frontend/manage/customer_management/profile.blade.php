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

        <!-- Business Name -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label required">Business Name</label>
            <input type="text" class="form-control" name="business_name" placeholder="Enter Business Name" maxlength="50"/>
            <div class="business_feedback text-end"></div>
        </div>

        <!-- Email ID -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label required">Email ID</label>
            <input type="email" name="email" class="form-control" placeholder="eg: user@example.com" disabled/>
        </div>

        <!-- Mobile Number -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label">Mobile Number</label>
            <input type="text" class="form-control mobile" name="mobile_no" placeholder="Enter Mobile Number"/>
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

        <!-- Google Link -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label">Google Link</label>
            <input type="text" class="form-control" name="google_link" placeholder="Enter Google Link"/>
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

        <!-- Specialisation -->
        <div class="form-group mb-2 col-md-6">
            <label class="form-label">Specialisation</label>
            <textarea class="form-control" name="specialisation" placeholder="Enter Specialisation" rows="3"></textarea>
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

