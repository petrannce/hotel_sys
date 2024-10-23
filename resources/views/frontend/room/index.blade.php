@extends('layouts.frontend.header')

@section('content')

<!-- Primary Page Layout
	================================================== -->

<div class="section big-55-height over-hide z-bigger">

	<div class="parallax parallax-top" style="background-image: url('img/rooms.jpg')"></div>
	<div class="dark-over-pages"></div>

	<div class="hero-center-section pages">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 parallax-fade-top">
					<div class="hero-text">Our Rooms</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="section padding-top-bottom over-hide background-grey">
	<div class="container">
		<div class="row justify-content-center">
			@foreach ($rooms as $room)

				<div class="col-md-6 mt-4 mt-md-0">
					<div class="room-box background-white">
						<img src="#" alt="">
						<div class="room-box-in">
							<h5 class="">{{$room->name}}</h5>
							<p class="mt-3">{!!Str::limit($room->description, 200)!!}..</p>
							<a class="mt-1 btn btn-primary" href="/room-details/{{ str_replace(' ', '-', $room->id)}}">book
								from kes {{$room->price}}</a>

						</div>
					</div>
				</div>

			@endforeach

		</div>
	</div>
</div>

@endsection