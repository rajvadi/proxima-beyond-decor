@extends('admin.layouts.logged.master')
@section('title', 'dashboard')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Total Product</p>
                                            <h4 class="mb-0">{{ \App\Models\Product::count() }}</h4>
                                        </div>
                                        
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-copy-alt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                        $categories = \App\Models\Category::get();
                        @endphp
                        @foreach($categories as $category)
                            <div class="col-md-4">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium">Total {{ $category->name }} Products</p>
                                                <h4 class="mb-0">{{ $category->products()->count() }}</h4>
                                            </div>
                                            
                                            <div class="flex-shrink-0 align-self-center ">
                                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-archive-in font-size-24"></i>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- end row -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection

@section('script')
@endsection