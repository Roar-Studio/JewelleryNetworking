@extends('admin.guest_layouts.master')

@section('css')
<style>
    .brand-logo img{
        height: 60px;
    }
</style>
@endsection

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-basic px-2">
                <div class="auth-inner my-2">
                    <!-- Login basic -->
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="" class="brand-logo">
                                <img src="{{ asset('new_ui/assets/images/jn-logo.webp') }}">

                                <h2 class="brand-text text-primary ms-1">Jewellery Networking</h2>
                            </a>

                            <h2 class="font-weight-bold mb-1">Sign In</h2>
                            
                            <form class="auth-login-form mt-2" id="authLoginForm">
                                <div class="mb-1">
                                    <label for="login-email" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="login-email" name="email" placeholder="Enter username" aria-describedby="login-email" tabindex="1" autofocus maxlength="50" />
                                </div>

                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="login-password">Password</label>
                                        <!-- <a href="auth-forgot-password-basic.html">
                                            <small>Forgot Password?</small>
                                        </a> -->
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" placeholder="Enter password" aria-describedby="login-password" maxlength="20" />
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input" name="remember_me" type="checkbox" id="remember_me" tabindex="3" />
                                        <label class="form-check-label" for="remember_me"> Remember Me </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100" tabindex="4">Sign in</button>
                            </form>
                        </div>
                    </div>
                    <!-- /Login basic -->
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('new_ui/assets/js/admin/login.js') }}?v={{ time() }}"></script>

@endsection
