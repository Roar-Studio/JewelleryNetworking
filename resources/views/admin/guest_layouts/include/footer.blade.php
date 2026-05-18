<!-- BEGIN: Vendor JS-->
<script src="{{ asset('new_ui/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('new_ui/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('new_ui/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/js/core/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/crypto-js.min.js"></script>
<script src="{{ asset('new_ui/app-assets/js/scripts/axios/axios.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/js/scripts/axios/axios-config.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
<!-- <script src="{{ asset('new_ui/app-assets/js/scripts/cryptoHelper.js') }}"></script> -->

<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('new_ui/app-assets/js/scripts/pages/auth-login.js') }}"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
@yield('script')
