@extends('frontend.layouts.master')
@section('title', 'Home Page')

@section('style')
@endsection

@section('content')
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
                                                     class="product-image">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if($product->images()->count() > 0)
                                <div class="slider slider-nav thumb-image">
                                    @foreach($product->images as $image)
                                        <div class="thumbnail-image">
                                            <div class="thumbImg">
                                                <img src="{{ $image->image_url }}" alt="product-tab-1">
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
                                <li>
                                    <label>Rate Per
                                        <span>:</span>
                                    </label>{{ ucwords($product->price_per) }}</li>
                                <li>
                                    <label>MRP
                                        <span>:</span>
                                    </label>{{ $product->MRP != '' ? $product->MRP : '-' }}</li>
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
                                    <p class="mt-4 mb-4">Note : <b style="color: red">Red font</b> value is currently not available</p>
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
                                                                        <p style="{{ $attribute->attributeValues[$i]->is_available == 0 ? 'color:red;' : '' }}; color: black">{{ $attribute->attributeValues[$i]->value }}</p>
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
                                                <p class="mt-2">Rate Per {{ ucwords($product->price_per) }}</p>
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
@endsection
