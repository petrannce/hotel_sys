<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-primary-custom {
            background-color: #04AA6D;
            color: white;
            border: none;
        }

        .btn-primary-custom:hover {
            background-color: #45a049;
        }

        .container {
            padding: 2rem;
            margin-top: 2rem;
            background-color: #f2f2f2;
            border-radius: 5px;
        }

        .cart-summary {
            padding: 1rem;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

          /* Custom styles for navbar */
        .navbar-nav {
            margin-left: 20px; /* Space from the left edge */
        }

        .navbar-nav .nav-link {
            margin-left: 15px; /* Space between nav items */
        }
    </style>
</head>

<body>

<!-- Navigation Bar with Tabs -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav"> <!-- Removed mr-auto to keep items aligned left -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">Home</a> <!-- Link to the homepage -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact') }}">Contact Us</a> <!-- Link to the contact page -->
            </li>
        </ul>
    </div>
</nav>

    <div class="container">
        <h2>Booking Checkout Form</h2>
        <p class="mb-4">Please fill in the details below to complete your booking checkout.</p>

        <div class="row">
            <div class="col-md-8">
                <div class="container bg-light p-4">
                    <form action="/action_page.php">

                        <h3>Billing Address</h3>
                        <div class="mb-3">
                            <label for="fname" class="form-label"><i class="fa fa-user"></i> Full Name</label>
                            <input type="text" id="fname" name="firstname" class="form-control"
                                placeholder="Enter your full name">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label"><i class="fa fa-envelope"></i> Email</label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Enter your email">
                        </div>

                        <div class="mb-3">
                            <label for="adr" class="form-label"><i class="fa fa-address-card-o"></i> Address</label>
                            <input type="text" id="adr" name="address" class="form-control"
                                placeholder="Enter your address">
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label"><i class="fa fa-institution"></i> City</label>
                            <input type="text" id="city" name="city" class="form-control" placeholder="Enter your city">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="state" class="form-label">State</label>
                                <input type="text" id="state" name="state" class="form-control" placeholder="Enter your state">
                            </div>
                        </div>

                        <h3>Payment</h3>
                        <div class="mb-3">
                            <label for="cards" class="form-label">Accepted Cards</label>
                            <div class="icon-container">
                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="cname" class="form-label">Name on Card</label>
                            <input type="text" id="cname" name="cardname" class="form-control"
                                placeholder="Enter your name on card">
                        </div>

                        <div class="mb-3">
                            <label for="ccnum" class="form-label">Credit card number</label>
                            <input type="text" id="ccnum" name="cardnumber" class="form-control"
                                placeholder="Enter your credit card number">
                        </div>

                        <div class="mb-3">
                            <label for="expmonth" class="form-label">Exp Month</label>
                            <input type="text" id="expmonth" name="expmonth" class="form-control"
                                placeholder="Enter your exp month">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="expyear" class="form-label">Exp Year</label>
                                <input type="text" id="expyear" name="expyear" class="form-control" placeholder="Enter your exp year">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" id="cvv" name="cvv" class="form-control" placeholder="Enter your cvv">
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="sameadr" checked>
                            <label class="form-check-label" for="sameadr">Shipping address same as billing</label>
                        </div>

                        <input type="submit" value="Continue to checkout" class="btn btn-primary-custom">
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="cart-summary">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge bg-secondary rounded-pill">4</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Hotel Room </h6>
                            </div>
                            <span class="text-muted">$30</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>$30</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
