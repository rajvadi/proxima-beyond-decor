@extends('admin.layouts.logged.master')
@section('title', 'Print Product Code')

@section('css')
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
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
                        <h4 class="mb-sm-0 font-size-18">Print Product Code</h4>
                        
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.product.index') }}">Products</a>
                                </li> &nbsp;&nbsp;/
                                <li class="breadcrumb-item active">Print</li>
                            </ol>
                        </div>
                    
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form method="post" id="product_form" enctype="multipart/form-data" action="{{ route('admin.product.print') }}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="form-rows">
                                    <!-- First Row (initial) -->
                                    <div class="row mb-3 product-row">
                                        <div class="col-md-6">
                                            <label for="product" class="form-label">Product</label>
                                            <select name="product[]" class="form-select" required>
                                                <option value="">Select Product</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->code.' - '.$product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="qty" class="form-label">Qty</label>
                                            <input type="number" name="qty[]" class="form-control" min="1" required>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <!-- Empty space for first row -->
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <button type="button" id="add-row" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Add More
                                    </button>
                                </div>
                                
                                <div class="d-flex flex-wrap gap-2 mt-5">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                    <a href="{{ route('admin.product.index') }}" type="button" class="btn btn-secondary waves-effect waves-light">Cancel</a>
                                </div>
                            </div>
                        </div>
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
    
    <!-- init js -->
    <script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>
    
    <script>
        $(document).ready(function () {
            
            // select 2
            $('.form-select').select2();
            
            let formRows = $('#form-rows');

            // Add more rows
            $('#add-row').click(function () {
                let newRow = `
                    <div class="row mb-3 product-row">
                        <div class="col-md-6">
                            <select name="product[]" class="form-select" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->code.' - '.$product->name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="qty[]" class="form-control" min="1" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-row">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>`;

                formRows.append(newRow);
                $('.form-select').select2();
            });

            // Remove row
            $(document).on('click', '.remove-row', function () {
                $(this).closest('.product-row').remove();
            });
        });
    </script>
@endsection