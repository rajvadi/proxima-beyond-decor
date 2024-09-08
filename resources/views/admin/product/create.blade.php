@extends('admin.layouts.logged.master')
@section('title', 'dashboard')

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
                                            <label for="code">Product Code</label>
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
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="material">Materials</label>
                                            <input id="material" name="material" type="text" class="form-control @error('material') is-invalid @enderror" placeholder="Stainless steel">
                                            @error('material')
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
                                            <label for="finishes">Finishes</label>
                                            <input id="finishes" name="finishes" type="text" class="form-control @error('finishes') is-invalid @enderror" placeholder="Black Matt/Black">
                                            @error('finishes')
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
                                {{--<input type="search" class="form-control" list="languages" placeholder="Pick a programming language..">
                                
                                <datalist id="languages">
                                    <option value="PHP" />
                                    <option value="C++" />
                                    <option value="Java" />
                                    <option value="Ruby" />
                                    <option value="Python" />
                                    <option value="Go" />
                                    <option value="Perl" />
                                    <option value="Erlang" />
                                </datalist>--}}
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table mb-0 table-striped mb-0" id="attributeTable">
                                            <thead class="table-light">
                                            <tr id="attribute-head">
                                                <th>Actions</th>
                                                <th>
                                                    <input type="text" name="attributes[0][name]" required class="form-control" placeholder="Default Attribute">
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody id="attribute-body">
                                            <tr data-value-index="0">
                                                <td><button type="button" title="Delete Value" class="delete-row" style="color: #d17981;cursor: no-drop;" disabled><i class="fa fa-trash"></i></button></td>
                                                <td>
                                                    <input type="text" name="values[0][0]" required class="form-control" placeholder="Value">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="mt-3 text-center">
                                            <button type="button" id="add-attribute" class="btn btn-primary">Add Attribute</button>
                                            <button type="button" id="add-value" class="btn btn-secondary">Add Value Row</button>
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
                                    <button type="button" class="btn btn-secondary waves-effect waves-light">Cancel</button>
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
    
    <script>
        let attributeIndex = 0; // Starts at 0 as default attribute is present
        let valueIndex = 1;     // Starts at 1 as default value row is present

        // Function to add a new attribute column
        document.getElementById('add-attribute').addEventListener('click', function () {
            attributeIndex++;

            // Add the new attribute column header with a delete button
            const newHeader = document.createElement('th');
            newHeader.innerHTML = `<input type="text" required name="attributes[${attributeIndex}][name]" class="form-control" placeholder="Attribute Name" required>
                                   <button type="button" class="delete-attribute" style="margin-left: 50%;margin-top: 5px;" title="Delete Attribute" data-index="${attributeIndex}"><i class="fa fa-trash"></i></button>`;
            document.getElementById('attribute-head').appendChild(newHeader);

            // Add input field for each existing value row
            const rows = document.querySelectorAll('#attribute-body tr');
            rows.forEach(row => {
                const newValueCell = document.createElement('td');
                newValueCell.setAttribute('data-attr-index', attributeIndex); // Track attribute index for deletion
                newValueCell.innerHTML = `<input type="text" required name="values[${row.getAttribute('data-value-index')}][${attributeIndex}]" class="form-control" placeholder="Value">`;
                row.appendChild(newValueCell);
            });

            // Reapply event listener for the delete attribute buttons
            resetDeleteAttributeListeners();
        });

        // Function to add a new row for attribute values
        document.getElementById('add-value').addEventListener('click', function () {
            const newRow = document.createElement('tr');
            newRow.setAttribute('data-value-index', valueIndex); // Track the row index

            // Add delete row button as the first column (before values)
            const actionCell = document.createElement('td');
            actionCell.innerHTML = `<button type="button" title="Delete Value" class="delete-row"><i class="fa fa-trash"></i></button>`;
            newRow.appendChild(actionCell);

            // Create input cells for each existing attribute
            for (let i = 0; i <= attributeIndex; i++) {
                const newValueCell = document.createElement('td');
                newValueCell.setAttribute('data-attr-index', i); // Track attribute index for deletion
                newValueCell.innerHTML = `<input type="text" required name="values[${valueIndex}][${i}]" class="form-control" placeholder="Value">`;
                newRow.appendChild(newValueCell);
            }

            document.getElementById('attribute-body').appendChild(newRow);
            valueIndex++;

            // Add event listener for the delete row button
            addDeleteRowListener();
        });

        // Function to remove and reapply delete attribute listener for all buttons
        function resetDeleteAttributeListeners() {
            const deleteButtons = document.querySelectorAll('.delete-attribute');

            deleteButtons.forEach(button => {
                if (button.getAttribute('data-index') != 0) {
                    button.removeEventListener('click', deleteAttributeHandler); // Remove existing listener
                    button.addEventListener('click', deleteAttributeHandler); // Add new listener
                }
            });
        }

        // Handler function for deleting an attribute
        function deleteAttributeHandler() {
            const index = this.getAttribute('data-index');

            // Remove the attribute column header
            this.parentElement.remove();

            // Remove the corresponding attribute cells in each row
            const rows = document.querySelectorAll('#attribute-body tr');
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                cells.forEach(cell => {
                    if (cell.getAttribute('data-attr-index') == index) {
                        cell.remove(); // Remove the correct column
                    }
                });
            });

            // Decrease the attribute index to reflect the removal
            attributeIndex--;
        }

        // Function to add delete row listener
        function addDeleteRowListener() {
            const deleteRowButtons = document.querySelectorAll('.delete-row');
            deleteRowButtons.forEach(button => {
                button.removeEventListener('click', deleteRowHandler); // Remove existing listener
                button.addEventListener('click', deleteRowHandler); // Add new listener
            });
        }

        // Handler function for deleting a row
        function deleteRowHandler() {
            this.parentElement.parentElement.remove(); // Remove the entire row
        }

        // Initialize default row and attribute handlers
        addDeleteRowListener();
        resetDeleteAttributeListeners();

        document.getElementById("product_form").addEventListener("submit", function(e) {
            e.preventDefault(); // Prevent default form submission
            
            // remove old hidden inputs
            document.querySelectorAll('input[name^="product_images"]').forEach(input => input.remove());
            dropzone.getAcceptedFiles().forEach((file, index) => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = `product_images[${index}]`; // Unique name for each file
                hiddenInput.value = file.dataURL; // Use file.name or file.path if available
                document.getElementById('product_form').appendChild(hiddenInput);
            });

            this.submit(); // Submit the form
        });
    </script>
@endsection