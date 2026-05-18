
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Email</title>
  <link href="{{ asset('images/logo.svg') }}" rel="icon">
  <link href="asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

</head>
  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/email-style.css') }}" rel="stylesheet"/>
  @yield('css')
</head>
<body style="background: #f6f7fb;">
	<main id="main" class="main">
		<div class="header">
			<img src="{{asset('new_ui/assets/images/email-header.jpg')}}" style="width: 100%;"/>
			<!-- <img src="{{asset('images/logo-white.svg')}}"/> -->
		</div>
		<section class="section" style="box-shadow: 0px 0px 10px -2px #777; background: #fff; max-width: 500px; margin: 30px auto; padding: 20px; border-bottom: 5px solid #264c5a;">
			<div class="row">
				@yield('content')	
				<div class="col-md-12">
					<p style="font-size: 13px; margin-top: 3rem;" class="mt-5">Thanks and Regards,</p>
					{{-- <img width="50px" src="{{asset('new_ui/assets/images/jn-logo.webp')}}"/> --}}
					<img width="50px" src="{{asset('new_ui/assets/images/jn_logo.webp')}}"/>
				</div>
			</div>
		</section>
		<div class="footer" style="padding: 15px 30px; margin: 0 auto; font-size: 12px; text-align: center;">
			<p class="mb-4" style="margin-bottom: 1.5rem;">Jewellery Networking</p>
			<p class="mb-4" style="margin-bottom: 1.5rem;">Jewellery Networking brings together people from gems, jewellery, and allied industries worldwide. Join us to grow your business community. Use our global directory to make new contacts, share ideas, and work together for success.</p>
			<div class="media">
				<a href="https://www.instagram.com/jewellerynetworking/?igsh=ZW41NGx4cm91czA3#"><i style="font-size: 28px; padding:0 5px; color: #264c5a; border-radius: 65px;" class="fab fa-instagram"></i></a>
				<a href="https://www.facebook.com/people/Jewellery-Networking/61554254949019/"><i style="font-size: 28px; padding:0 5px; color: #264c5a; border-radius: 65px;" class="fab fa-facebook"></i></a>
				<a href="https://www.linkedin.com/company/jewellerynetworking/"><i style="font-size: 28px; padding:0 5px; color: #264c5a; border-radius: 65px;" class="fab fa-linkedin"></i></a>
				<a href="https://www.youtube.com/@JewelleryNetworking">
					<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50">
						<path d="M 44.898438 14.5 C 44.5 12.300781 42.601563 10.699219 40.398438 10.199219 C 37.101563 9.5 31 9 24.398438 9 C 17.800781 9 11.601563 9.5 8.300781 10.199219 C 6.101563 10.699219 4.199219 12.199219 3.800781 14.5 C 3.398438 17 3 20.5 3 25 C 3 29.5 3.398438 33 3.898438 35.5 C 4.300781 37.699219 6.199219 39.300781 8.398438 39.800781 C 11.898438 40.5 17.898438 41 24.5 41 C 31.101563 41 37.101563 40.5 40.601563 39.800781 C 42.800781 39.300781 44.699219 37.800781 45.101563 35.5 C 45.5 33 46 29.398438 46.101563 25 C 45.898438 20.5 45.398438 17 44.898438 14.5 Z M 19 32 L 19 18 L 31.199219 25 Z" fill="#264C5A"></path>
					</svg>
				</a>
			</div>
		</div>
		
	</main>
</body>
</html>