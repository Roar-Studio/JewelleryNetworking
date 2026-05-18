<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
@include('frontend.layouts.include.head')
<body>
	@include('frontend.layouts.include.header')
	@yield('content')
	@include('frontend.layouts.include.footer')
</body>
</html>