@extends('admin.layouts.logged.master')
@section('title', 'Product List')

@section('css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

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
                        <h4 class="mb-sm-0 font-size-18">Product List</h4>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" id="autoDismissAlert" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" id="autoDismissAlert" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- end page title -->
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="material">Category</label>
                                        <select id="category" name="category_id" class="form-control">
                                            <option value="">All Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="product-list" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Material</th>
                                    <th>Action</th>
                                    {{--<th>Finishes</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Product Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Show a second modal and hide this one with the button below.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    
    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    
    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    
    <script>
        $(document).ready(function () {
            let table = $('#product-list');
            
            // onchange of category
            $('#category').on('change', function () {
                table.DataTable().ajax.reload();
            });

            let datatable = table.DataTable({
                dom: 'Bfrtip',
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        text: 'Export PDF',
                        exportOptions: {
                            // Specify the columns to include (use column index or column names)
                            columns: [0, 2, 3, 4, 5] // Replace with the columns you want to include in the export
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Export Excel',
                        exportOptions: {
                            // Specify the columns to include (use column index or column names)
                            columns: [0, 2, 3, 4, 5] // Replace with the columns you want to include in the export
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        exportOptions: {
                            // Specify the columns to include (use column index or column names)
                            columns: [0, 2, 3, 4, 5] // Replace with the columns you want to include in the export
                        }
                    }
                ],
                "bStateSave": true,
                "fnStateSave": function (oSettings, oData) {
                    localStorage.setItem('offersDataTables', JSON.stringify(oData));
                },
                "fnStateLoad": function (oSettings) {
                    return JSON.parse(localStorage.getItem('offersDataTables'));
                },
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }],
                ajax: {
                    url: '{{route('admin.product.index')}}',
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    data: function (d) {
                        d.category_id = $('#category').val();
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'id'},
                    {data: 'image', name: 'image', orderable: false, searchable: false},
                    {data: 'category', name: 'category'},
                    {data: 'code', name: 'code'},
                    {data: 'name', name: 'name'},
                    {data: 'material', name: 'material'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                    /*{data: 'finishes', name: 'finishes'},*/
                ]
            });

            // change status
            table.on('click', '.status-link', function (e) {
                category_change_status(this, datatable);
            });

            // category delete
            table.on('click', '.delete-link', function (e) {
                product_delete(this, datatable);
            });

            table.on('click', '.view-link', function (e) {
                product_view(this);
            });

        });

        function product_view(el)
        {
            $.ajax({
                url: $(el).data('remote'),
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    if(response.html){
                        //$('#exampleModalLong').modal('show');
                        $('.modal-body').html(response.html);
                    }
                },
                error: function (error) {
                    // close modal
                    Swal.fire('Oops!', 'Something went wrongs', 'error');
                    $('#exampleModalLong').modal('hide');
                }
            });
        }

        function product_delete(el, table) {
            Swal.fire({
                title: "Are you sure?",
                text: "Product account will be deleted!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete it!"
            }).then(t => {
                if (t.value) {
                    $.ajax({
                        url: $(el).data('remote'),
                        type: 'delete',
                        data: {_token: '{{csrf_token()}}', _method: 'delete'},
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                Swal.fire('Success', response.data, 'success');
                                table.draw();
                            } else if (!response.success) {
                                Swal.fire('Oops!', response.message, 'error');
                            } else {
                                Swal.fire('Oops!', 'Something went wrong', 'error');
                            }
                        },
                        error: function (error) {
                            Swal.fire('Oops!', 'Something went wrong', 'error');
                        }
                    });
                }
            });
        }
    </script>
@endsection