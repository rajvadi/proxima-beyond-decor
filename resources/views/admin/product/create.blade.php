@extends('admin.layouts.logged.master')
@section('title', 'Create Product')

@section('css')
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('style')
    <style>
        .delete-row, .delete-attribute {
            cursor: pointer;
            color: #dc3545; /* Bootstrap red */
            font-size: 1.1rem; /* Larger icon */
            border: none;
            background: none;
        }
        .delete-row:hover, .delete-attribute:hover {
            color: #c82333; /* Darker red for hover effect */
        }
    </style>
@endsection

@section('content')
    <!-- Container-fluid starts-->
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add Product</h4>
                        
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.product.index') }}">Products</a>
                                </li> &nbsp;&nbsp;/
                                <li class="breadcrumb-item active">Add Product</li>
                            </ol>
                        </div>
                    
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form method="post" id="product_form" enctype="multipart/form-data" action="{{ route('admin.product.store') }}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Basic Information</h4>
                                <p class="card-title-desc">Fill all information below</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="code">Product Code </label>
                                            <input id="code" name="code" required type="text" class="form-control @error('code') is-invalid @enderror" placeholder="Product Code">
                                            @error('code')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="name">Product Name</label>
                                            <input id="name" name="name" type="text" required class="form-control @error('name') is-invalid @enderror" placeholder="Product Name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="material">Category</label>
                                            <select id="category" name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="name">MRP</label>
                                            <input id="name" name="MRP" type="text" class="form-control @error('MRP') is-invalid @enderror" placeholder="0.68">
                                            @error('MRP')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="material">Materials</label>
                                            <input id="material" name="material" required type="text" class="form-control @error('material') is-invalid @enderror" placeholder="Stainless steel">
                                            @error('material')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="finishes">Finishes</label>
                                            <input id="finishes" name="finishes" type="text" class="form-control @error('finishes') is-invalid @enderror" placeholder="Black Matt/Black">
                                            @error('finishes')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>--}}
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="finishes">Description</label>
                                            <textarea id="elm1" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                
                                <h4 class="card-title">Product Attributes</h4>
                                <p class="card-title-desc">Fill all information below</p>
                                
                                @if ($attributes->count() > 0)
                                    <datalist id="attributes">
                                        @foreach($attributes as $attribute)
                                            <option value="{{ $attribute->name }}" />
                                        @endforeach
                                    </datalist>
                                @endif
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table mb-0 table-striped mb-0" id="attributeTable">
                                            <thead class="table-light">
                                            <tr id="attribute-head">
                                                <th>Actions</th>
                                                <th>
                                                    <input type="text" list="attributes" name="attributes[0][name]" required class="form-control" placeholder="Default Attribute">
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="attribute-body">
                                            <tr data-value-index="0">
                                                <td><button type="button" title="Delete Value" class="delete-row" style="color: #d17981;cursor: no-drop;" disabled><i class="fa fa-trash"></i></button></td>
                                                <td>
                                                    <input type="text" name="values[0][0]" required class="form-control" placeholder="Value">
                                                    <p style="margin-left: 50%;
    margin-top: 10px;">Available : <input type="checkbox" name="availables[0][0]"  value="1" checked></p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="mt-3 text-center">
                                            <button type="button" id="add-attribute" class="btn btn-primary">Add Attribute</button>
                                            <button type="button" id="add-value" class="btn btn-secondary">Add Value Row</button>
                                            <div class="mt-3">
                                                <input class="form-check-input" type="radio" name="price_per" id="price_per1" value="piece" checked="">
                                                <label class="form-check-label me-2" for="price_per1">
                                                    Price Per Piece
                                                </label>
                                                <input class="form-check-input" type="radio" name="price_per" value="set" id="price_per2">
                                                <label class="form-check-label" for="price_per2">
                                                    Price Per Set
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Product Images</h4>
                                <div class="dropzone">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple="multiple" accept="image/png, image/gif, image/jpeg">
                                    </div>
                                    <div class="dz-message needsclick">
                                        <div class="mb-3">
                                            <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                        </div>
                                        
                                        <h4>Drop files here or click to upload.</h4>
                                    </div>
                                </div>
                                
                                <ul class="list-unstyled mb-0" id="dropzone-preview">
                                    <li class="mt-2" id="dropzone-preview-list">
                                        <!-- This is used as the file preview template -->
                                        <div class="border rounded">
                                            <div class="d-flex p-2">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm bg-light rounded">
                                                        <img data-dz-thumbnail class="img-fluid rounded d-block" src="../../../img.themesbrand.com/judia/new-document.png" alt="Dropzone-Image">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="pt-1">
                                                        <h5 class="fs-md mb-1" data-dz-name>&nbsp;</h5>
                                                        <p class="fs-sm text-muted mb-0" data-dz-size></p>
                                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 ms-3">
                                                    <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="d-flex flex-wrap gap-2 mt-5">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                    <a href="{{ route('admin.product.index') }}" type="button" class="btn btn-secondary waves-effect waves-light">Cancel</a>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div>
                </div>
            </form>
            <!-- end row -->
        
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection

@section('script')
    <!-- select 2 plugin -->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    
    <!-- Plugins js -->
    <script src="{{ asset('assets/libs/dropzone/dropzone-min.js') }}"></script>
    
    <!-- init js -->
    <script src="{{ asset('assets/js/pages/ecommerce-select2.init.js') }}"></script>
    
    <!--tinymce js-->
    <script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>
    
    <!-- init js -->
    <script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>
    
    <script src="{{ asset('assets/js/create-product.js') }}"></script>
@endsection