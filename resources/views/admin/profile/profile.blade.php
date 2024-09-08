@extends('admin.layouts.logged.master')
@section('title', 'Admin Profile')

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
                        <h4 class="mb-sm-0 font-size-18">Form Layouts</h4>
                        
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" id="autoDismissAlert" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    
                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Update Profile</h4>
                            <form method="post" action="{{ route('admin.update.profile') }}" enctype="multipart/form-data">
                                @csrf
                                <img src="{{ Auth::user()->avatar_image_url }}" onerror="this.onerror=null;this.src='{{ asset('assets/images/users/user-dummy-img.jpg') }}';" alt="" onclick="$('#avatar').trigger('click'); return false;" id="blah" style="height: 150px;width: 150px">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Avatar (Please select jpeg,png,jpg image with max 1 MB)</label>
                                    <input class="form-control @error('avatar') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg" type="file" onchange="readURL(this);" id="avatar" name="avatar">
                                    @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required value="{{ Auth::user()->name }}" id="basic-default-fullname" placeholder="admin">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="basic-default-company" required name="email" value="{{ Auth::user()->email }}" placeholder="test@gmail.com" >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </form>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
                
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Change Password</h4>
                            
                            <form method="post" action="{{ route('admin.update.password') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Current Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" required value="" name="current_password" id="basic-icon-default-fullname">
                                        @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" value="" required name="new_password" id="basic-icon-default-fullname">
                                        @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Confirm Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" value="" name="new_confirm_password" id="basic-icon-default-fullname">
                                        @error('new_confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </form>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

@endsection

@section('script')
@endsection