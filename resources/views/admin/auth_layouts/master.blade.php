<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
@include('admin.auth_layouts.include.head')
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
	@include('admin.auth_layouts.include.header')
	@yield('content')
	@include('admin.auth_layouts.include.footer')
</body>
</html>