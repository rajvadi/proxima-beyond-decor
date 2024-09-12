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
<div class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="mt-1 mb-3">Product : <b>{{ $product->name }} ({{ $product->code }})</b></h4>
                <form method="post" id="edit_product_attr" enctype="multipart/form-data" action="{{ route('admin.product.attribute',['product' => $product->id]) }}">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table mb-0 table-striped mb-0">
                                    <thead class="table-light">
                                    <tr id="attribute-head">
                                        <th>Actions</th>
                                        @if($product->attributes()->count() > 0)
                                            @foreach($product->attributes as $index => $attribute)
                                                <th>
                                                    <input type="text" list="attributes" name="attributes[{{ $index }}][name]" required class="form-control" value="{{ $attribute->name }}" placeholder="Default Attribute">
                                                    @if($index != 0)
                                                        <button type="button" class="delete-attribute" style="margin-left: 50%;margin-top: 5px;" title="Delete Attribute" data-index="{{ $index }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </th>
                                            @endforeach
                                        @else
                                            <th>
                                                <input type="text" list="attributes" name="attributes[0][name]" required class="form-control" placeholder="Default Attribute">
                                            </th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody id="attribute-body">
                                    @php
                                        // Find the maximum number of rows in the values for any attribute
                                        $maxRows = $attributes->map(function($attribute) {
                                            return $attribute->attributeValues->count();
                                        })->max();
                                        $key = 0;
                                    @endphp
                                    @if($maxRows > 0)
                                        @for ($i = 0; $i < $maxRows; $i++)
                                            <tr data-value-index="{{$i}}">
                                                @if($i == 0)
                                                    <td>
                                                        <button type="button" title="Delete Value" class="delete-row" style="color: #d17981;cursor: no-drop;" disabled>
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                @else
                                                    <td>
                                                        <button type="button" title="Delete Value" class="delete-row">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                @endif
                                                
                                                {{-- Loop through each attribute --}}
                                                @foreach ($attributes as $key => $attribute)
                                                    <td data-attr-index="{{ $key }}">
                                                        {{-- Check if there is a value for the current row ($i) --}}
                                                        @if (isset($attribute->attributeValues[$i]))
                                                            <input type="text" name="values[{{ $i }}][{{ $key }}]" required class="form-control" value="{{ $attribute->attributeValues[$i]->value }}" placeholder="Value">
                                                            <p style="margin-left: 50%;margin-top: 10px;">
                                                                Available :
                                                                <input type="checkbox" name="availables[{{ $i }}][{{ $key }}]" value="1" {{ $attribute->attributeValues[$i]->is_available == 0 ? '' : 'checked' }}>
                                                            </p>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endfor
                                    @else
                                        <tr data-value-index="0">
                                            <td>
                                                <button type="button" title="Delete Value" class="delete-row" style="color: #d17981;cursor: no-drop;" disabled>
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <input type="text" name="values[0][0]" required class="form-control" placeholder="Value">
                                                <p style="margin-left: 50%;
        margin-top: 10px;">Available :
                                                    <input type="checkbox" name="availables[0][0]" value="1" checked>
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3 text-center">
                                <button type="button" id="add-attribute" class="btn btn-primary">Add Attribute</button>
                                <button type="button" id="add-value" class="btn btn-secondary">Add Value Row</button>
                                <div class="mt-3">
                                    <input class="form-check-input" type="radio" name="price_per" id="price_per1" value="piece" {{ $product->price_per == 'piece' ? 'checked' : '' }}>
                                    <label class="form-check-label me-2" for="price_per1">
                                        Price Per Piece
                                    </label>
                                    <input class="form-check-input" type="radio" name="price_per" value="set" id="price_per2" {{ $product->price_per == 'set' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="price_per2">
                                        Price Per Set
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2 mt-5">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                            </div>
                        
                        </div>
                    </div>
                </form>
                <!-- end card -->
            </div>
        </div>
        <!-- end row -->
        <!-- end row -->
    
    </div> <!-- container-fluid -->
</div>
<script>
    var attributeIndex = {{ $key }}; // Starts at 0 as default attribute is present
    var valueIndex = {{ $maxRows }};     // Starts at 1 as default value row is present

    // Function to add a new attribute column
    document.getElementById('add-attribute').addEventListener('click', function () {
        attributeIndex++;

        // Add the new attribute column header with a delete button
        const newHeader = document.createElement('th');
        newHeader.innerHTML = `<input type="text" list="attributes" required name="attributes[${attributeIndex}][name]" class="form-control" placeholder="Attribute Name" required>
                                   <button type="button" class="delete-attribute" style="margin-left: 50%;margin-top: 5px;" title="Delete Attribute" data-index="${attributeIndex}"><i class="fa fa-trash"></i></button>`;
        document.getElementById('attribute-head').appendChild(newHeader);

        // Add input field for each existing value row
        const rows = document.querySelectorAll('#attribute-body tr');
        rows.forEach(row => {
            const newValueCell = document.createElement('td');
            newValueCell.setAttribute('data-attr-index', attributeIndex); // Track attribute index for deletion
            newValueCell.innerHTML = `<input type="text" required name="values[${row.getAttribute('data-value-index')}][${attributeIndex}]" class="form-control" placeholder="Value"><p style="margin-left: 50%;
    margin-top: 10px;">Available : <input type="checkbox" name="availables[${row.getAttribute('data-value-index')}][${attributeIndex}]" checked value="1"></p>`;
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
            newValueCell.innerHTML = `<input type="text" required name="values[${valueIndex}][${i}]" class="form-control" placeholder="Value">
                                           <p style="margin-left: 50%;
    margin-top: 10px;">Available : <input type="checkbox" name="availables[${valueIndex}][${i}]" checked value="1"></p>`;
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
</script>