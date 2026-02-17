@extends('layouts.admin.header')

@section('content')

<!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Hotel Details</h3>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">

        <!-- Hotel Info Display Card -->
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">

            @if($hotel_details)
            <div class="card" style="border-radius: 8px; overflow: hidden;">
                <!-- Hotel Image -->
                @if($hotel_details->image)
                <div style="height: 160px; overflow: hidden;">
                    <img src="{{ asset('storage/' . $hotel_details->image) }}" alt="Hotel Image"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                @endif

                <div class="card-body" style="padding: 20px;">
                    <!-- Logo & Name -->
                    <div class="text-center mb-3">
                        @if($hotel_details->logo)
                        <img src="{{ asset('storage/' . $hotel_details->logo) }}" alt="Hotel Logo"
                            style="height: 60px; width: auto; object-fit: contain; margin-bottom: 10px;">
                        @endif
                        <h5 class="card-title mb-0">{{ $hotel_details->name }}</h5>
                    </div>

                    <hr>

                    <!-- Contact Info -->
                    <ul class="list-unstyled" style="font-size: 13px;">
                        <li class="mb-2">
                            <i class="fa fa-map-marker text-primary mr-2"></i>
                            {{ $hotel_details->address }}
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-phone text-primary mr-2"></i>
                            {{ $hotel_details->phone_number }}
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-envelope text-primary mr-2"></i>
                            {{ $hotel_details->email }}
                        </li>
                        <li class="mb-2">
                            <i class="fa fa-globe text-primary mr-2"></i>
                            <a href="{{ $hotel_details->website }}" target="_blank">{{ $hotel_details->website }}</a>
                        </li>
                    </ul>

                    <hr>

                    <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#edit_hotel">
                        <i class="fa fa-edit"></i> Edit Details
                    </a>
                </div>
            </div>
            @else
            <div class="card text-center" style="border-radius: 8px; padding: 30px;">
                <i class="fa fa-hotel fa-3x text-muted mb-3"></i>
                <p class="text-muted">No hotel details found.</p>
                <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_hotel">
                    <i class="fa fa-plus"></i> Add Hotel Details
                </a>
            </div>
            @endif

        </div>
        <!-- /Hotel Info Display Card -->

        <!-- Hotel Details Form / Info Section -->
        <div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">
            <h6 class="card-title m-b-20">Hotel Information</h6>

            <div class="card" style="border-radius: 8px;">
                <div class="card-body">
                    @if($hotel_details)
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="detail-group">
                                <label class="text-muted" style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Hotel Name</label>
                                <p class="font-weight-bold mb-0">{{ $hotel_details->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="detail-group">
                                <label class="text-muted" style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Email Address</label>
                                <p class="font-weight-bold mb-0">{{ $hotel_details->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="detail-group">
                                <label class="text-muted" style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Phone Number</label>
                                <p class="font-weight-bold mb-0">{{ $hotel_details->phone_number }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="detail-group">
                                <label class="text-muted" style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Website</label>
                                <p class="font-weight-bold mb-0">
                                    <a href="{{ $hotel_details->website }}" target="_blank">{{ $hotel_details->website }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="detail-group">
                                <label class="text-muted" style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Address</label>
                                <p class="font-weight-bold mb-0">{{ $hotel_details->address }}</p>
                            </div>
                        </div>

                        <!-- Logo Preview -->
                        <div class="col-md-6 mb-4">
                            <div class="detail-group">
                                <label class="text-muted" style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Logo</label>
                                <div class="mt-2">
                                    @if($hotel_details->logo)
                                    <img src="{{ asset('storage/' . $hotel_details->logo) }}" alt="Logo"
                                        style="height: 80px; width: auto; object-fit: contain; border: 1px solid #eee; border-radius: 6px; padding: 8px;">
                                    @else
                                    <span class="text-muted">No logo uploaded</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Hotel Image Preview -->
                        <div class="col-md-6 mb-4">
                            <div class="detail-group">
                                <label class="text-muted" style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Hotel Image</label>
                                <div class="mt-2">
                                    @if($hotel_details->image)
                                    <img src="{{ asset('storage/' . $hotel_details->image) }}" alt="Hotel Image"
                                        style="height: 80px; width: auto; object-fit: cover; border-radius: 6px; border: 1px solid #eee;">
                                    @else
                                    <span class="text-muted">No image uploaded</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#edit_hotel">
                                <i class="fa fa-edit mr-1"></i> Update Hotel Details
                            </button>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fa fa-hotel fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">No hotel details configured yet.</h5>
                        <p class="text-muted">Click the button below to add your hotel information.</p>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_hotel">
                            <i class="fa fa-plus mr-1"></i> Add Hotel Details
                        </a>
                    </div>
                    @endif
                </div>
            </div>

        </div>
        <!-- /Hotel Details Section -->

    </div>
</div>
<!-- /Page Content -->


<!-- Add Hotel Modal -->
<div id="add_hotel" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Hotel Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('hotel_details.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hotel Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" placeholder="Enter hotel name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="phone_number" placeholder="Enter phone number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" placeholder="Enter email address" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Website <span class="text-danger">*</span></label>
                                <input class="form-control" type="url" name="website" placeholder="https://example.com" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" rows="2" placeholder="Enter hotel address" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Logo <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="add_logo" name="logo" accept="image/*" onchange="previewImage(this, 'add_logo_preview')" required>
                                    <label class="custom-file-label" for="add_logo">Choose logo</label>
                                </div>
                                <div class="mt-2">
                                    <img id="add_logo_preview" src="#" alt="Logo Preview" style="display:none; height: 60px; width: auto; object-fit: contain; border: 1px solid #eee; border-radius: 6px; padding: 6px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hotel Image <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="add_image" name="image" accept="image/*" onchange="previewImage(this, 'add_image_preview')" required>
                                    <label class="custom-file-label" for="add_image">Choose image</label>
                                </div>
                                <div class="mt-2">
                                    <img id="add_image_preview" src="#" alt="Image Preview" style="display:none; height: 60px; width: auto; object-fit: cover; border-radius: 6px; border: 1px solid #eee;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Hotel Modal -->


<!-- Edit Hotel Modal -->
<div id="edit_hotel" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Hotel Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if($hotel_details)
                <form action="{{ route('hotel_details.update', $hotel_details->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hotel Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" value="{{ $hotel_details->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="phone_number" value="{{ $hotel_details->phone_number }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" value="{{ $hotel_details->email }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Website <span class="text-danger">*</span></label>
                                <input class="form-control" type="url" name="website" value="{{ $hotel_details->website }}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" rows="2" required>{{ $hotel_details->address }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Logo <small class="text-muted">(Leave blank to keep current)</small></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="edit_logo" name="logo" accept="image/*" onchange="previewImage(this, 'edit_logo_preview')">
                                    <label class="custom-file-label" for="edit_logo">Choose logo</label>
                                </div>
                                <div class="mt-2">
                                    @if($hotel_details->logo)
                                    <img id="edit_logo_preview" src="{{ asset('storage/' . $hotel_details->image) }}" alt="Logo Preview"
                                        style="height: 60px; width: auto; object-fit: contain; border: 1px solid #eee; border-radius: 6px; padding: 6px;">
                                    @else
                                    <img id="edit_logo_preview" src="#" alt="Logo Preview" style="display:none; height: 60px; width: auto; object-fit: contain; border: 1px solid #eee; border-radius: 6px; padding: 6px;">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hotel Image <small class="text-muted">(Leave blank to keep current)</small></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="edit_image" name="image" accept="image/*" onchange="previewImage(this, 'edit_image_preview')">
                                    <label class="custom-file-label" for="edit_image">Choose image</label>
                                </div>
                                <div class="mt-2">
                                    @if($hotel_details->image)
                                    <img id="edit_image_preview" src="{{ asset('storage/' . $hotel_details->image) }}" alt="Image Preview"
                                        style="height: 60px; width: auto; object-fit: cover; border-radius: 6px; border: 1px solid #eee;">
                                    @else
                                    <img id="edit_image_preview" src="#" alt="Image Preview" style="display:none; height: 60px; width: auto; object-fit: cover; border-radius: 6px; border: 1px solid #eee;">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Save Changes</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- /Edit Hotel Modal -->


<script>
    // Update custom file input label with selected filename
    document.querySelectorAll('.custom-file-input').forEach(function(input) {
        input.addEventListener('change', function() {
            const fileName = this.files[0] ? this.files[0].name : 'Choose file';
            const label = this.nextElementSibling;
            if (label) label.textContent = fileName;
        });
    });

    // Preview image before upload
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection