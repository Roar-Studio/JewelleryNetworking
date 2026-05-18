<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <!-- <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; {{ date('Y') }}<a class="ms-25" href="https://vervali.com" target="_blank">Vervali Systems Pvt Ltd</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span></p> -->
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="{{ asset('new_ui/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->
<script src="{{ asset('new_ui/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('new_ui/app-assets/js/scripts/forms/pickers/form-pickers.js') }}?v={{ time() }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/crypto-js@4.1.1/crypto-js.min.js"></script>
<script src="{{ asset('new_ui/app-assets/js/scripts/axios/axios.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/js/scripts/axios/axios-config.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
<!-- <script src="{{ asset('new_ui/app-assets/js/scripts/texteditor/jquery-te-1.4.0.min.js') }}"></script> -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<!-- <script src="{{ asset('new_ui/app-assets/js/scripts/cryptoHelper.js') }}"></script> -->

<!-- <script src="{{ asset('new_ui/app-assets/js/scripts/extensions/ext-component-toastr.js') }}"></script> -->

<!-- BEGIN: Page Vendor JS-->
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('new_ui/app-assets/js/scripts/forms/form-select2.js') }}?v={{ time() }}"></script>
<script src="{{ asset('new_ui/app-assets/js/core/app-menu.js') }}?v={{ time() }}"></script>
<script src="{{ asset('new_ui/app-assets/js/core/app.js') }}?v={{ time() }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="{{ asset('new_ui/assets/js/admin/custom.js') }}?v={{ time() }}"></script>
<!-- END: Theme JS--> 
<!-- BEGIN: Page JS-->
<!-- END: Page JS-->
@yield('script')
