@extends('layouts.frontend.header')

@section('content')

<div class="section big-55-height over-hide z-bigger">
	
		<div id="poster_background-about"></div>
		<div id="video-wrap" class="parallax-top">
			<video id="video_background" preload="auto" autoplay loop="loop" muted="muted" poster="img/trans.png"> 
				<source src="video/video-about.mp4" type="video/mp4"> 
			</video>
		</div>
		<div class="dark-over-pages"></div>
	
		<div class="hero-center-section pages">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 parallax-fade-top">
						<div class="hero-text">About Us</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="section padding-top-bottom over-hide">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8 align-self-center">
					<div class="subtitle with-line text-center mb-4">a bit about us</div>
					<h3 class="text-center padding-bottom-small">finest hotel</h3>
				</div>
				<div class="section clearfix"></div>
				<div class="col-md-4">
					<div class="services-box text-center">
						<img src="img/4.svg" alt="">
						<h5 class="mt-2">welcome drink</h5>
						<p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
						<a class="mt-1 btn btn-primary" href="services.html">read more</a>
					</div>
				</div>
				<div class="col-md-4 mt-5 mt-md-0">
					<div class="services-box text-center">
						<img src="img/5.svg" alt="">
						<h5 class="mt-2">swimming pool</h5>
						<p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
						<a class="mt-1 btn btn-primary" href="services.html">read more</a>
					</div>
				</div>
				<div class="col-md-4 mt-5 mt-md-0">
					<div class="services-box text-center">
						<img src="img/6.svg" alt="">
						<h5 class="mt-2">food included</h5>
						<p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
						<a class="mt-1 btn btn-primary" href="services.html">read more</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="section background-grey over-hide">
		<div class="container-fluid px-0">
			<div class="row mx-0">
				<div class="col-xl-6 px-0">
					<div class="img-wrap" id="rev-1">
						<img src="img/room1.jpg" alt="">
						<div class="text-element-over">private pool suite</div>
					</div>
				</div>
				<div class="col-xl-6 px-0 mt-4 mt-xl-0 align-self-center">
					<div class="row justify-content-center">
						<div class="col-10 col-xl-8 text-center">
							<h3 class="text-center">Private pool suite</h3>
							<p class="text-center mt-4">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
							<a class="mt-5 btn btn-primary" href="search.html">check availability</a>
						</div>	
					</div>
				</div>
			</div>
			<div class="row mx-0">
				<div class="col-xl-6 px-0 mt-4 mt-xl-0 pb-5 pb-xl-0 align-self-center">
					<div class="row justify-content-center">
						<div class="col-10 col-xl-8 text-center">
							<h3 class="text-center">Sea view suite</h3>
							<p class="text-center mt-4">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
							<a class="mt-5 btn btn-primary" href="search.html">check availability</a>
						</div>	
					</div>
				</div>
				<div class="col-xl-6 px-0 order-first order-xl-last mt-5 mt-xl-0">
					<div class="img-wrap" id="rev-2">
						<img src="img/room2.jpg" alt="">
						<div class="text-element-over">sea view suite</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection