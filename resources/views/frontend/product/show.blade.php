@extends('frontend.layouts.master')
@section('title', 'Home Page')

@section('style')
    <style>
        .zoom-image-hover {
            display: flex; /* Optional: to align multiple images side by side */
            justify-content: center; /* Center the image horizontally */
            align-items: center; /* Center the image vertically */
            overflow: hidden; /* Hide overflow if the image is larger than the container */
            width: 100%; /* Set your desired container width */
            max-width: 400px; /* Optional: Set a maximum width for the container */
            height: 300px; /* Set the height of the container */
        }

        .zoom-image-hover img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Crop the image to fill the container while preserving aspect ratio */
        }

        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 99; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            max-width: 80%;
            max-height: 85%;
            object-fit: contain;
        }

        /* Add Animation */
        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(1)}
            to {-webkit-transform:scale(2)}
        }

        @keyframes zoom {
            from {transform:scale(0.4)}
            to {transform:scale(1)}
        }

        @keyframes zoom-out {
            from {transform:scale(1)}
            to {transform:scale(0)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
    
    </style>
@endsection

@section('content')
    <section class="section-breadcrumb">
    </section>
    <!-- Modal Structure -->
    <div id="imageModal" class="modal" onclick="closeModal()">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>
    <!-- Product -->
    <section class="section-product padding-t-100">
        <div class="container">
            <div class="row mb-minus-24" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="600">
                <div class="col-xxl-4 col-xl-5 col-md-6 col-12 mb-24">
                    <div class="vehicle-detail-banner banner-content clearfix">
                        <div class="banner-slider">
                            @if($product->images()->count() > 0)
                                <div class="slider slider-for">
                                    @foreach($product->images as $image)
                                        <div class="slider-banner-image">
                                            <div class="zoom-image-hover">
                                                <img src="{{ $image->image_url }}" alt="product-tab-1"
                                                     class="product-image" style="width: auto">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if($product->images()->count() > 0)
                                <div class="slider slider-nav thumb-image">
                                    @foreach($product->images as $image)
                                        <div class="thumbnail-image">
                                            <div class="thumbImg" style="display: flex; justify-content: center;align-items: center;overflow: hidden;width: 100%;max-width: 400px;height: 200px;">
                                                <img src="{{ $image->image_url }}" style="width: 100%;height: 100%;object-fit: contain;" alt="product-tab-1">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8 col-xl-7 col-md-6 col-12 mb-24">
                    <div class="cr-size-and-weight-contain">
                        <h2 class="heading">{{ $product->name }} ({{ $product->code }})</h2>
                        {!! $product->description !!}
                    </div>
                    <div class="cr-size-and-weight">
                        <div class="list">
                            <ul>
                                <li>
                                    <label>Category
                                        <span>:</span>
                                    </label>{{ $product->category->name }}</li>
                                <li>
                                    <label>Code
                                        <span>:</span>
                                    </label>{{ $product->code }}</li>
                                <li>
                                    <label>Materials
                                        <span>:</span>
                                    </label>{{ $product->material }}</li>
                                @if($product->price_per != '' && $product->price_per != 'none')
                                    <li>
                                        <label>Rate Per
                                            <span>:</span>
                                        </label>{{ ucwords($product->price_per) }}</li>
                                @endif
                                @if ($product->MRP != '' && $product->MRP != 0)
                                    <li>
                                        <label>MRP
                                            <span>:</span>
                                        </label>{{ $product->MRP != '' ? $product->MRP : '-' }}
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="600">
                <div class="col-12">
                    <div class="cr-paking-delivery">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab" aria-controls="description"
                                        aria-selected="true">Attributes
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                 aria-labelledby="description-tab">
                                <div class="cr-tab-content">
                                    <p class="mt-4 mb-4">Note : <b style="color: red">Red font</b> value is currently not available in the display.</p>
                                    <div class="col-xl-12">
                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table mb-0 table-striped mb-0">
                                                    <thead class="table-light">
                                                    <tr>
                                                        @if($product->attributes()->count() > 0)
                                                            @foreach($product->attributes as $attribute)
                                                                <th style="background-color: #0096d8;color: white;">{{ $attribute->name }}</th>
                                                            @endforeach
                                                        @endif
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        // Find the maximum number of rows in the values for any attribute
                                                        $maxRows = $attributes->map(function($attribute) {
                                                            return $attribute->attributeValues->count();
                                                        })->max();
                                                    @endphp
                                                    @for ($i = 0; $i < $maxRows; $i++)
                                                        <tr>
                                                            {{-- Loop through each attribute --}}
                                                            @foreach ($attributes as $attribute)
                                                                <td>
                                                                    {{-- Check if there is a value for the current row ($i) --}}
                                                                    @if (isset($attribute->attributeValues[$i]))
                                                                        <p style="{{ $attribute->attributeValues[$i]->is_available == 0 ? 'color:red;' : 'color: black;' }}; ">{{ $attribute->attributeValues[$i]->value }}</p>
                                                                    @else
                                                                        {{-- If there is no value, leave the cell empty --}}
                                                                        &nbsp;
                                                                    @endif
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endfor
                                                    </tbody>
                                                </table>
                                                @if($product->price_per != '' && $product->price_per != 'none')
                                                    <p class="mt-2">Rate Per {{ ucwords($product->price_per != '' && $product->price_per != 'none' ? $product->price_per : '-') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        // Add event listener to all images with the class 'zoomImg'
        document.querySelectorAll('.zoomImg').forEach(function (image) {
            image.addEventListener('click', function () {
                // Get the source of the clicked image
                var imageUrl = this.src;
                openModal(imageUrl); // Call the modal opening function
            });
        });

        // Open the modal and set the clicked image
        function openModal(imageUrl) {
            var modal = document.getElementById("imageModal");
            var modalImage = document.getElementById("modalImage");
            modal.style.display = "block";
            modalImage.src = imageUrl;
        }

        // Close the modal when clicked
        function closeModal() {
            var modal = document.getElementById("imageModal");
            modal.style.display = "none";
        }
    
    </script>
@endsection
