let attributeIndex = 0; // Starts at 0 as default attribute is present
let valueIndex = 1;     // Starts at 1 as default value row is present

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

    // if no image is uploaded, give error message
    if (dropzone.getAcceptedFiles().length == 0) {
        alert("Please upload at least one image.");
        return;
    }

    // Disable the submit button to prevent multiple submissions
    var submitButton = $(this).find('button[type="submit"]');
    submitButton.prop('disabled', true);

    this.submit(); // Submit the form
});