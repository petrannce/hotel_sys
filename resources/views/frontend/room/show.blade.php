@extends('layouts.frontend.header')

@section('content')

<!-- Primary Page Layout
	================================================== -->

<div class="section big-55-height over-hide">

	<div class="parallax parallax-top" style="background-image: url('{{asset('img/rooms.jpg')}}')"></div>
	<div class="dark-over-pages"></div>

	<div class="hero-center-section pages">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 parallax-fade-top">
					<div class="hero-text">Rooms</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="section background-dark padding-top-bottom-smaller over-hide">
	<div class="section z-bigger">
		<div class="container">
			<div class="row">
				<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center">
					<div class="amenities">
						<img src="{{asset('img/icons/1.svg')}}" alt="">
						<p>no smoking</p>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center">
					<div class="amenities">
						<img src="{{asset('img/icons/2.svg')}}" alt="">
						<p>big beds</p>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center mt-4 mt-md-0">
					<div class="amenities">
						<img src="{{asset('img/icons/3.svg')}}" alt="">
						<p>yacht riding</p>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center mt-4 mt-lg-0">
					<div class="amenities">
						<img src="{{asset('img/icons/4.svg')}}" alt="">
						<p>free drinks</p>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center mt-4 mt-lg-0">
					<div class="amenities">
						<img src="{{asset('img/icons/5.svg')}}" alt="">
						<p>swimming pool</p>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-4 col-lg-2 text-center mt-4 mt-lg-0">
					<div class="amenities">
						<img src="{{asset('img/icons/6.svg')}}" alt="">
						<p>room breakfast</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="section padding-top-bottom z-bigger">
	<div class="section z-bigger">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mt-4 mt-lg-0">
					<div class="section">
						<div class="customNavigation rooms-sinc-1-2">
							<a class="prev-rooms-sync-1"></a>
							<a class="next-rooms-sync-1"></a>
						</div>
						<div id="rooms-sync1" class="owl-carousel">
							<div class="item">
								<img src="{{asset('img/gallery/2.jpg')}}" alt="">
							</div>
							<div class="item">
								<img src="{{asset('img/gallery/3.jpg')}}" alt="">
							</div>
							<div class="item">
								<img src="{{asset('img/gallery/4.jpg')}}" alt="">
							</div>
							<div class="item">
								<img src="{{asset('img/gallery/5.jpg')}}" alt="">
							</div>
							<div class="item">
								<img src="{{asset('img/gallery/6.jpg')}}" alt="">
							</div>
							<div class="item">
								<img src="{{asset('img/gallery/7.jpg')}}" alt="">
							</div>
							<div class="item">
								<img src="{{asset('img/gallery/8.jpg')}}" alt="">
							</div>
							<div class="item">
								<img src="{{asset('img/gallery/9.jpg')}}" alt="">
							</div>
						</div>
					</div>
					<div class="section">
						<div id="rooms-sync2" class="owl-carousel">
							<div class="item">
								<img src="{{asset('img/gallery/2-s.jpg')}}" alt="">
							</div>
							<div class="item">
								<img src="{{asset('img/gallery/3-s.jpg')}}" alt="">
							</div>
							<div class="item">
								<img src="{{asset('img/gallery/4-s.jpg')}}" alt="">
							</div>
							<div class="item">
								<img src="{{asset('img/gallery/5-s.jpg')}}" alt="">
							</div>
							<div class="item">
								<img src="{{asset('img/gallery/6-s.jpg')}}" alt="">
							</div>
							<div class="item">
								<img src="{{asset('img/gallery/7-s.jpg')}}" alt="">
							</div>
							<div class="item">
								<img src="{{asset('img/gallery/8-s.jpg')}}" alt="">
							</div>
							<div class="item">
								<img src="{{asset('img/gallery/9-s.jpg')}}" alt="">
							</div>
						</div>
					</div>
					<div class="section pt-5">
						<h5>description</h5>
						<p class="mt-3">{{$room->description}}</p>
					</div>
				</div>

				<div class="col-lg-4 order-first order-lg-last">
					<div class="section background-dark p-4">

						<form id="booking-form">
							@csrf

							<div class="row">
								<div class="col-12 pt-4">
									<input type="text" class="form-control" name="fname"
										value="{{ auth()->user()->fname }}" readonly required>
								</div>

								<div class="col-12 pt-4">
									<input type="text" class="form-control" name="lname"
										value="{{ auth()->user()->lname }}" readonly required>
								</div>

								<!-- Room Name -->
								<div class="col-12 pt-4">
									<input class="form-control" id="room-name-input" name="room_id"
										value="{{ $room->id }}" readonly required hidden>
								</div>

								<!-- Room Number -->
								<div class="col-12 pt-4">
									<div class="form-item">
										<select name="room_number" class="wide"
											style="background-color: black; color: white; border: 1px solid white; border-radius: 5px; padding: 10px; width: 100%;">
											<option value="" disabled selected>Room Number</option>
											@foreach ($availableRooms as $roomNumber)
												<option value="{{$roomNumber}}">{{$roomNumber}}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-12 pt-4">
									<div class="input-daterange input-group" id="flight-datepicker">
										<div class="row">
											<div class="col-12">
												<div class="form-item">
													<span class="fontawesome-calendar"></span>
													<input class="input-sm" type="text" id="start-date-1"
														name="check_in" placeholder="check-in date" autocomplete="off"
														data-date-format="yyyy-mm-dd" />
													<span class="date-text date-depart"></span>
												</div>
											</div>
											<div class="col-12 pt-4">
												<div class="form-item">
													<span class="fontawesome-calendar"></span>
													<input class="input-sm" type="text" id="end-date-1" name="check_out"
														placeholder="check-out date" autocomplete="off"
														data-date-format="yyyy-mm-dd" />
													<span class="date-text date-return"></span>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-12 pt-4">
									<input type="text" class="form-control" name="price" value="{{$room->price}}"
										readonly required>
								</div>

								<!-- Booking Button -->
								<div class="col-12 pt-4">
									<button type="submit" class="booking-button">book now</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function () {
		$('#booking-form').on('submit', function (event) {
			event.preventDefault(); // Prevent the default form submission
			console.log('Form submitted'); // Debugging line

			$.ajax({
				url: '{{ route('store-booking') }}', // Ensure this is correct
				method: 'POST',
				data: $(this).serialize(), // Serialize the form data
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function (response) {
					if (response.success) {
						// Alert message
						alert(response.message);
						// Redirect to /checkout after success
						window.location.href = '/checkout';
					} else {
						alert('Booking failed, please try again.');
					}
				},
				error: function (xhr) {
					console.error(xhr.responseText);
					alert("An error occurred: " + xhr.responseText);
				}
			});
		});
	});
</script>

<script>
	// Initialize Date Picker for Check-In and Check-Out
	$(document).ready(function () {
		var dateSelect = $('#flight-datepicker');
		var dateDepart = $('#start-date-1'); // Check-in date
		var dateReturn = $('#end-date-1'); // Check-out date

		dateSelect.datepicker({
			autoclose: true,
			format: "yyyy-mm-dd", // Ensure format is correct
			maxViewMode: 0,
			startDate: "now"
		});

		// Event listener for Check-In date
		dateDepart.datepicker().on('changeDate', function (selected) {
			var minCheckOutDate = new Date(selected.date); // Get selected date
			minCheckOutDate.setDate(minCheckOutDate.getDate() + 1); // Add one day to it
			dateReturn.datepicker('setStartDate', minCheckOutDate); // Set minimum date for Check-Out
			dateReturn.datepicker('setDate', minCheckOutDate); // Optionally set check-out date to min
		});
	});

</script>


@endsection