<!DOCTYPE html>

<head>

	<!-- Basic Page Needs
	================================================== -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DMP - Hotel_sys</title>
	<meta name="description" content="Professional Creative Template" />
	<meta name="author" content="IG Design">
	<meta name="keywords"
		content="ig design, website, design, html5, css3, jquery, creative, clean, animated, portfolio, blog, one-page, multi-page, corporate, business," />
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="theme-color" content="#212121" />
	<meta name="msapplication-navbutton-color" content="#212121" />
	<meta name="apple-mobile-web-app-status-bar-style" content="#212121" />

	<!-- Web Fonts 
	================================================== -->
	<link
		href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet" />
	<link
		href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
		rel="stylesheet">

	<!-- CSS
	================================================== -->
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" />
	<link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}" />
	<link rel="stylesheet" href="{{asset('css/datepicker.css')}}" />
	<link rel="stylesheet" href="{{asset('css/jquery.fancybox.min.css')}}" />
	<link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}" />
	<link rel="stylesheet" href="{{asset('css/owl.transitions.css')}}" />
	<link rel="stylesheet" href="{{asset('css/style.css')}}" />
	<link rel="stylesheet" href="{{asset('css/colors/color.css')}}" />
	<link rel="stylesheet" href="{{asset('css/checkout.css')}}" />

	<!-- Favicons
	================================================== -->
	<link rel="icon" type="image/png" href="{{asset('favicon.png')}}">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png">

</head>

<body>

	<div class="loader">
		<div class="loader__figure"></div>
	</div>

	<svg class="hidden">
		<svg id="icon-nav" viewBox="0 0 152 63">
			<title>navarrow</title>
			<path
				d="M115.737 29L92.77 6.283c-.932-.92-1.21-2.84-.617-4.281.594-1.443 1.837-1.862 2.765-.953l28.429 28.116c.574.57.925 1.557.925 2.619 0 1.06-.351 2.046-.925 2.616l-28.43 28.114c-.336.327-.707.486-1.074.486-.659 0-1.307-.509-1.69-1.437-.593-1.442-.315-3.362.617-4.284L115.299 35H3.442C2.032 35 .89 33.656.89 32c0-1.658 1.143-3 2.552-3H115.737z" />
		</svg>
	</svg>


	<!-- Nav and Logo
	================================================== -->

	<nav id="menu-wrap" class="menu-back cbp-af-header">
		<div class="menu-top background-black">
			<div class="container">
				<div class="row">
					<div class="col-6 px-0 px-md-3 pl-1 py-3">
						<span class="call-top">call us:</span> <a href="#" class="call-top">(254) 712 660170</a>
					</div>
					<div class="col-6 px-0 px-md-3 py-3 text-right">
						<a href="#" class="social-top">fb</a>
						<a href="#" class="social-top">#</a>
						@if(Auth::check())
							<span class="social-top">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</span>
						@else
							<span class="social-top">Guest</span>
						@endif
						<div class="lang-wrap">
							eng
							<ul>
								<li><a href="#">ger</a></li>
								<li><a href="#">rus</a></li>
								<li><a href="#">ser</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="menu">
			<a href="index.html">
				<div class="logo">
					<img src="{{asset('img/logo.png')}}" alt="" style="width: 110px; height: 64px;">
				</div>
			</a>
			<ul>
				<li>
					<a class="{{ request()->routeIs('home') ? 'current-page' : '' }}"
						href="{{ route('home') }}">home</a>
				</li>
				<li>
					<a class="{{ request()->routeIs('rooms') ? 'current-page' : '' }}"
						href="{{ route('rooms') }}">rooms</a>
				</li>
				<li>
					<a class="{{ request()->routeIs('about') ? 'current-page' : '' }}" href="{{ route('about') }}">about
						us</a>
				</li>
				<li>
					<a class="{{ request()->routeIs(patterns: 'gallery') ? 'current-page' : '' }}" href="{{ route('gallery') }}">gallery
						us</a>
				</li>
				<li>
					<a class="{{ request()->routeIs('contact') ? 'current-page' : '' }}"
						href="{{ route('contact') }}">contact</a>
				</li>
				@if(Auth::check())
					@if(Auth::user()->hasRole('admin'))
						<li>
							<a href="{{ route('admin.dashboard') }}"><span>Admin Dashboard</span></a>
						</li>
					@elseif(Auth::user()->hasRole('client'))
						<li>
							<a href="{{ route('client.dashboard') }}"><span>Dashboard</span></a>
						</li>
					@elseif(Auth::user()->hasRole('employee'))
						<li>
							<a href="{{ route('employee.dashboard') }}"><span>Employee Dashboard</span></a>
						</li>
					@endif

					<!-- Logout option -->
					<li>
						<a href="{{ route('logout') }}"
							onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<span>Logout</span>
						</a>
					</li>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				@else
					<!-- If not logged in, show login and register -->
					<li>
						<a href="{{ route('login') }}"><span>Login</span></a>
					</li>
					<li>
						<a href="{{ route('register') }}"><span>Register</span></a>
					</li>
				@endif

			</ul>
		</div>
	</nav>

	<!-- Primary Page Layout
	================================================== -->

	@yield('content')

	<div class="section">
		<div id="owl-sep-2" class="owl-carousel owl-theme">
			<div class="item">
				<a href="img/gallery/1.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/1-s.jpg')}}" alt="">
					</div>
				</a>
			</div>
			<div class="item">
				<a href="img/gallery/2.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/2-s.jpg')}}" alt="">
					</div>
				</a>
			</div>
			<div class="item">
				<a href="img/gallery/3.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/3-s.jpg')}}" alt="">
					</div>
				</a>
			</div>
			<div class="item">
				<a href="img/gallery/4.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/4-s.jpg')}}" alt="">
					</div>
				</a>
			</div>
			<div class="item">
				<a href="img/gallery/5.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/5-s.jpg')}}" alt="">
					</div>
				</a>
			</div>
			<div class="item">
				<a href="img/gallery/6.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/6-s.jpg')}}" alt="">
					</div>
				</a>
			</div>
			<div class="item">
				<a href="img/gallery/7.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/7-s.jpg')}}" alt="">
					</div>
				</a>
			</div>
			<div class="item">
				<a href="img/gallery/8.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/8-s.jpg')}}" alt="">
					</div>
				</a>
			</div>
			<div class="item">
				<a href="img/gallery/9.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/9-s.jpg')}}" alt="">
					</div>
				</a>
			</div>
			<div class="item">
				<a href="img/gallery/10.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/10-s.jpg')}}" alt="">
					</div>
				</a>
			</div>
			<div class="item">
				<a href="img/gallery/1.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/1-s.jpg')}}" alt="">
					</div>
				</a>
			</div>
			<div class="item">
				<a href="img/gallery/2.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/2-s.jpg')}}" alt="">
					</div>asset
				</a>
			</div>
			<div class="item">
				<a href="img/gallery/3.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/3-s.jpg')}}" alt="">
					</div>
				</a>
			</div>
			<div class="item">
				<a href="img/gallery/4.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/4-s.jpg')}}" alt="">
					</div>
				</a>
			</div>
			<div class="item">
				<a href="img/gallery/5.jpg" data-fancybox="gallery">
					<div class="img-wrap gallery-small">
						<img src="{{asset('img/gallery/5-s.jpg')}}" alt="">
					</div>
				</a>
			</div>
		</div>
	</div>

	<div class="section padding-top-bottom-small background-black over-hide footer">
		<div class="container">
			<div class="row">
				<div class="col-md-3 text-center text-md-left">
					<img src="{{asset('img/logo.png')}}" alt="" style="width: 110px; height: 64px;">
					<p class="color-grey mt-4">Avenue Street 3284<br>Nairobi</p>
				</div>
				<div class="col-md-4 text-center text-md-left">
					<h6 class="color-white mb-3">information</h6>
					<a href="tandc.html">terms &amp; conditions</a>
					<a href="services.html">services</a>
					<a href="restaurant.html">restaurant</a>
					<a href="testimonials.html">testimonials</a>
					<a href="gallery.html">gallery &amp; images</a>
				</div>
				<div class="col-md-5 mt-4 mt-md-0 text-center text-md-left logos-footer">
					<h6 class="color-white mb-3">about us</h6>
					<p class="color-grey mb-4">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
						praesentium voluptatum deleniti atque corrupti quos dolores.</p>
				</div>
			</div>
		</div>
	</div>

	<div class="section py-4 background-dark over-hide footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-6 text-center text-md-left mb-2 mb-md-0">
					<p>Copyright © DMP Tech {{ date('Y') }}. All rights reserved.</p>
				</div>
				<div class="col-md-6 text-center text-md-right">
					<a href="#" class="social-footer-bottom">facebook</a>
					<a href="#" class="social-footer-bottom">twitter</a>
					<a href="#" class="social-footer-bottom">instagram</a>
				</div>
			</div>
		</div>
	</div>


	<div class="scroll-to-top"></div>


	<!-- JAVASCRIPT
    ================================================== -->
	<script src="{{asset('js/jquery.min.js')}}"></script>
	<script src="{{asset('js/popper.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/plugins.js')}}"></script>
	<script src="{{asset('js/flip-slider.js')}}"></script>
	<script src="{{asset('js/reveal-home.js')}}"></script>
	<script src="{{asset('js/custom.js')}}"></script>



	<script>
		$(document).ready(function () {
			$("#send").click(function (e) {
				e.preventDefault(); // Prevent the default form submission

				// Capture the form data
				var name = $("input[name='name']").val();
				var email = $("input[name='email']").val();
				var message = $("textarea[name='message']").val();
				var checkbox = $(".checkbox").is(":checked"); // Capture checkbox status

				// Prepare the data to be sent via Ajax
				var formData = {
					name: name,
					email: email,
					message: message,
					checkbox: checkbox ? 1 : 0 // Convert boolean to 1 or 0
				};

				// Make the Ajax request
				$.ajax({
					url: '{{ route('contact.store') }}', // URL to your PHP/Laravel script
					type: 'POST',
					data: formData,
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					success: function (response) {
						// Handle the success response
						alert("Form data submitted successfully!");
						console.log(response); // Check response from server
					},
					error: function (xhr, status, error) {
						// Handle errors
						console.error(error);
						alert("Something went wrong. Please try again.");
					}
				});
			});
		});
	</script>

	<!-- End Document
================================================== -->
</body>

</html>