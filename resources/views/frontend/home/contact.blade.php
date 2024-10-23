@extends('layouts.frontend.header')
@section('content')

<!-- Primary Page Layout
	================================================== -->

<div class="section big-55-height over-hide z-bigger">

	<div class="parallax parallax-top" style="background-image: url('img/gallery/10.jpg')"></div>
	<div class="dark-over-pages"></div>

	<div class="hero-center-section pages">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 parallax-fade-top">
					<div class="hero-text">Get in Touch</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="section padding-top z-bigger">
	<div class="container">
		<div class="row justify-content-center padding-bottom-smaller">
			<div class="col-md-8">
				<div class="subtitle with-line text-center mb-4">get in touch</div>
				<h3 class="text-center padding-bottom-small">drop us a line</h3>
			</div>
			<div class="section clearfix"></div>

			<div class="col-md-4 ajax-form">
				<input id="contact-name" name="name" type="text" autocomplete="off"
					value="{{Auth::user()->fname}} {{Auth::user()->lname}}" required />
			</div>
			<div class="col-md-4 mt-4 mt-md-0 ajax-form">
				<input id="contact-email" name="email" type="email" autocomplete="off" value="{{Auth::user()->email}}"
					required />
			</div>
			<div class="section clearfix"></div>
			<div class="col-md-8 mt-4 ajax-form">
				<textarea id="contact-message" name="message" placeholder="Tell Us Everything" required></textarea>
			</div>
			<div class="section clearfix"></div>
			<div class="col-md-8 mt-3 ajax-checkbox">
				<ul class="list">
					<li class="list__item">
						<label class="label--checkbox">
							<input type="checkbox" class="checkbox" name="checkbox" required>
							collect my details through this form
						</label>
					</li>
				</ul>
			</div>
			<div class="section clearfix"></div>
			<div class="col-md-8 mt-3 ajax-form text-center">
				<button type="submit" class="send_message" id="send" data-lang="en"><span>submit</span></button>
			</div>
			<div class="section clearfix"></div>
			<div class="col-md-8 padding-top-bottom">
				<div class="sep-line"></div>
			</div>
			<div class="section clearfix"></div>
			<!-- Address Information -->
			<div class="col-md-6 col-lg-4">
				<div class="address">
					<div class="address-in text-left">
						<p class="color-black">Address:</p>
					</div>
					<div class="address-in text-right">
						<p>Avenue Str. 328</p>
					</div>
				</div>
				<div class="address">
					<div class="address-in text-left">
						<p class="color-black">City:</p>
					</div>
					<div class="address-in text-right">
						<p>Nairobi</p>
					</div>
				</div>
				<div class="address">
					<div class="address-in text-left">
						<p class="color-black">Check-In:</p>
					</div>
					<div class="address-in text-right">
						<p>14:00 pm</p>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="address">
					<div class="address-in text-left">
						<p class="color-black">Phone:</p>
					</div>
					<div class="address-in text-right">
						<p>+254 7126 60170</p>
					</div>
				</div>
				<div class="address">
					<div class="address-in text-left">
						<p class="color-black">Email:</p>
					</div>
					<div class="address-in text-right">
						<p>info@hotel.com</p>
					</div>
				</div>
				<div class="address">
					<div class="address-in text-left">
						<p class="color-black">Check-Out:</p>
					</div>
					<div class="address-in text-right">
						<p>11:00 am</p>
					</div>
				</div>
			</div>
			<div class="section clearfix"></div>
			<div class="col-md-8 text-center mt-5" data-scroll-reveal="enter bottom move 50px over 0.7s after 0.2s">
				<p class="mb-0"><em>available at: 8am - 10pm</em></p>
				<h2 class="text-opacity">+254 7126 60170</h2>
			</div>
		</div>

	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function () {
		// Variable to prevent multiple submissions
		let isSubmitting = false;

		$('#send').on('click', function (event) {
			event.preventDefault(); // Prevent the default form submission

			// Prevent further submissions if already submitting
			if (isSubmitting) {
				return; // Exit the function if a submission is already in progress
			}

			// Gather form data
			var contactData = {
				name: $('input[name="name"]').val().trim(),
				email: $('input[name="email"]').val().trim(),
				message: $('textarea[name="message"]').val().trim(),
				checkbox: $('.checkbox').is(':checked') ? 1 : 0 // Store checkbox value as 1 or 0
			};

			// Check if all fields are filled
			if (!contactData.name || !contactData.email || !contactData.message) {
				alert('Please fill all required fields.');
				return; // Exit the function if fields are missing
			}

			// Check if the checkbox is checked
			if (!$('.checkbox').is(':checked')) {
				alert('Please check the box to confirm your consent.');
				return; // Exit the function if not checked
			}

			// Set submitting flag to true
			isSubmitting = true;

			// Send AJAX request
			$.ajax({
				url: '{{ route('contact.store') }}', // Update this to your route
				method: 'POST',
				data: contactData,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
				},
				success: function (response) {
					alert("Message sent successfully!");
					console.log(response);
					// Optionally clear the form fields
					$('input[name="name"]').val(''); // Clear name input
					$('input[name="email"]').val(''); // Clear email input
					$('textarea[name="message"]').val(''); // Clear message textarea
					$('.checkbox').prop('checked', false); // Uncheck the checkbox
				},
				error: function (xhr) {
					console.error(xhr.responseText); // Log error response
					alert("An error occurred: " + xhr.responseText); // Show error message
				},
				complete: function () {
					// Reset submitting flag when done
					isSubmitting = false;
				}
			});
		});
	});

</script>



@endsection