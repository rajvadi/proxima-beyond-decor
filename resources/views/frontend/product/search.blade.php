@extends('frontend.layouts.master')
@section('title', 'Home Page')

@section('style')
@endsection

@section('content')
    <!-- Hero slider -->
    <section class="section-shop padding-tb-100">
        <div class="container">
            <div class="row d-none">
                <div class="col-lg-12">
                    <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                        <div class="cr-banner">
                            <h2>Categories</h2>
                        </div>
                        <div class="cr-banner-sub-title">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore lacus vel facilisis. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="600">
                    <div class="row">
                        <div class="col-12">
                            <div class="cr-shop-bredekamp">
                                <div class="cr-toggle">
                                    <a href="javascript:void(0)" class="gridCol active-grid">
                                        <i class="ri-grid-line"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="gridRow">
                                        <i class="ri-list-check-2"></i>
                                    </a>
                                </div>
                                <div class="center-content">
                                    <span>We found {{ $products->count() }} items for you!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-50 mb-minus-24">
                        @if($products->count() == 0)
                            <div class="col-lg-12">
                                <div class="cr-shop-bredekamp">
                                    <div class="center-content">
                                        <span>No product found!</span>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach($products as $product)
                                <div class="col-lg-3 col-6 cr-product-box mb-24">
                                    <div class="cr-product-card">
                                        <div class="cr-product-image">
                                            <div class="cr-image-inner zoom-image-hover">
                                                @php
                                                   $image = $product->images->first();
                                                @endphp
                                                @if($image)
                                                    <img src="{{ $image->image_url }}" alt="product-1">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="cr-product-details">
                                            <div class="cr-brand">
                                                <a href="javascript:void(0);">{{ $product->category->name }}</a>
                                            </div>
                                            <a href="{{ route('product.show',['product' => $product->id]) }}" class="title">{{ $product->code.' - '.$product->name }}</a>
                                            <h6>Materials : {{ $product->material }}</h6>
                                            <p>Rate Per {{ ucwords($product->price_per) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
