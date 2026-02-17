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

			<form id="contact-form" class="col-md-8">
				@csrf

				<div class="row">
					<div class="col-md-6 ajax-form">
						<input id="contact-name" name="name" type="text" placeholder="Enter your name" autocomplete="off"
							value="{{ old('name', Auth::check() ? Auth::user()->fname . ' ' . Auth::user()->lname : '') }}" 
							required />
					</div>
					<div class="col-md-6 mt-4 mt-md-0 ajax-form">
						<input id="contact-email" name="email" type="email" placeholder="Enter your email" autocomplete="off" 
							value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}"
							required />
					</div>
					
					<div class="section clearfix"></div>
					
					<div class="col-12 mt-4 ajax-form">
						<textarea id="contact-message" name="message" placeholder="Tell Us Everything" required>{{ old('message') }}</textarea>
					</div>
					
					<div class="section clearfix"></div>
					
					<div class="col-12 mt-3 ajax-checkbox">
						<ul class="list">
							<li class="list__item">
								<label class="label--checkbox">
									<input type="checkbox" class="checkbox" name="checkbox" id="consent-checkbox" required>
									I agree to have my details collected through this form
								</label>
								<span id="checkbox-error" style="color: red; display: none; font-size: 12px; margin-top: 5px;">
									You must agree to the terms before submitting
								</span>
							</li>
						</ul>
					</div>
					
					<div class="section clearfix"></div>
					
					<div class="col-12 mt-3 ajax-form text-center">
						<button type="submit" class="send_message" id="send" data-lang="en">
							<span>Submit</span>
						</button>
					</div>
				</div>
			</form>
			
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
		let isSubmitting = false;

		// Hide error message when checkbox is checked
		$('#consent-checkbox').on('change', function() {
			if ($(this).is(':checked')) {
				$('#checkbox-error').hide();
			}
		});

		$('#contact-form').on('submit', function (event) {
			event.preventDefault();

			// Prevent multiple submissions
			if (isSubmitting) {
				return;
			}

			// FIRST: Check if checkbox is checked
			if (!$('#consent-checkbox').is(':checked')) {
				$('#checkbox-error').show();
				alert('You must agree to have your details collected before submitting the form.');
				$('#consent-checkbox').focus();
				return false; // Stop form submission
			}

			// Hide error if checkbox is checked
			$('#checkbox-error').hide();

			// Gather form data
			var contactData = {
				name: $('#contact-name').val().trim(),
				email: $('#contact-email').val().trim(),
				message: $('#contact-message').val().trim(),
				checkbox: 1 // We already validated it's checked
			};

			// Validate other fields
			if (!contactData.name) {
				alert('Please enter your name.');
				$('#contact-name').focus();
				return false;
			}

			if (!contactData.email) {
				alert('Please enter your email.');
				$('#contact-email').focus();
				return false;
			}

			// Validate email format
			var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			if (!emailPattern.test(contactData.email)) {
				alert('Please enter a valid email address.');
				$('#contact-email').focus();
				return false;
			}

			if (!contactData.message) {
				alert('Please enter your message.');
				$('#contact-message').focus();
				return false;
			}

			// Disable submit button
			$('#send').prop('disabled', true).html('<span>Sending...</span>');
			isSubmitting = true;

			// Send AJAX request
			$.ajax({
				url: '{{ route('contact.store') }}',
				method: 'POST',
				data: contactData,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function (response) {
					alert("Message sent successfully!");
					console.log(response);
					
					// Clear form fields
					@guest
						$('#contact-name').val('');
						$('#contact-email').val('');
					@endguest
					$('#contact-message').val('');
					$('#consent-checkbox').prop('checked', false);
				},
				error: function (xhr) {
					console.error(xhr.responseText);
					let errorMessage = "An error occurred. Please try again.";
					
					// Parse validation errors if they exist
					if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
						errorMessage = Object.values(xhr.responseJSON.errors).flat().join('\n');
					}
					
					alert(errorMessage);
				},
				complete: function () {
					// Re-enable submit button
					$('#send').prop('disabled', false).html('<span>Submit</span>');
					isSubmitting = false;
				}
			});
		});
	});
</script>

@endsection