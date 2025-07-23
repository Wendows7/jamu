{{-- start create modal --}}
@foreach($partnerships as $data)
    <div class="modal fade" tabindex="-1" role="dialog" id="addBatch{{ $data->id }}">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Batch Sending</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.partnerships.sending.add')}}" enctype="multipart/form-data" class="needs-validation" novalidate="" id="partnership-form-{{ $data->id }}">
                        @csrf
                        <input type="hidden" name="partnership_id" value="{{ $data->id }}">

                        <!-- Container for all batch forms -->
                        <div id="batch-forms-container-{{ $data->id }}">
                            <!-- First batch form (template) -->
                            <div class="batch-form" id="batch-form-{{ $data->id }}-0">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center bg-light">
                                        <h6 class="mb-0 batch-title">Batch #1</h6>
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-batch-btn" style="display: none;">
                                            <i class="fas fa-times"></i> Remove
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Batch Number</label>
                                            <input type="number" name="batch_number[]" class="form-control batch-number" min="1" required>
                                            <div class="invalid-feedback">Please fill this form</div>
                                        </div>
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control" value="{{ $data->company_name }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Product</label>
                                            <select name="product_id[]" class="form-control product-select" required>
                                                <option value="">-- Select Product --</option>
                                                @foreach($product as $value)
                                                    <option value="{{ $value->id }}">
                                                        {{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a product</div>
                                        </div>

                                        <!-- Container for product stock info (initially hidden) -->
                                        <div class="form-group stock-container" style="display: none;">
                                            <label>Size & Available Stock</label>
                                            <select name="size[]" class="form-control stock-select" required>
                                                <option value="">-- Select Stock Size --</option>
                                            </select>
                                            <div class="invalid-feedback">Please select available stock</div>
                                        </div>
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="number" name="quantity[]" class="form-control quantity-input" min="1" required>
                                            <div class="invalid-feedback quantity-error-message">Please fill this form</div>
                                            <small class="text-muted stock-availability-info"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button to add more batches -->
                        <div class="text-center mb-4">
                            <button type="button" class="btn btn-outline-primary add-batch-btn" data-partnership-id="{{ $data->id }}">
                                <i class="fas fa-plus"></i> Add Another Batch
                            </button>
                        </div>

                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary submit-btn">Add Batches</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Object to track available stock for each batch form
        const batchStockData = {};

        // Store original template for each partnership
        const originalTemplates = {};

        // Declare templateId once outside the loop
        let templateId;

        // Initialize the first batch form for each partnership and store templates
        @foreach($partnerships as $data)
        // Just assign to templateId without redeclaring it
        templateId = `batch-form-{{ $data->id }}-0`;
        originalTemplates['{{ $data->id }}'] = document.getElementById(templateId).cloneNode(true);
        initializeBatchForm('{{ $data->id }}', 0);
        @endforeach

        // Add click handlers for "Add Another Batch" buttons
        document.querySelectorAll('.add-batch-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                console.log("Add batch button clicked");
                const partnershipId = this.dataset.partnershipId;

                // Check if partnership ID exists
                if (!partnershipId) {
                    console.error("Missing partnership ID on button");
                    return;
                }

                const container = document.getElementById(`batch-forms-container-${partnershipId}`);
                if (!container) {
                    console.error(`Container not found: batch-forms-container-${partnershipId}`);
                    return;
                }

                const batchForms = container.querySelectorAll('.batch-form');
                const newIndex = batchForms.length;

                // Use the stored original template instead of the current form
                const newForm = originalTemplates[partnershipId].cloneNode(true);
                newForm.id = `batch-form-${partnershipId}-${newIndex}`;

                // Update batch title and show remove button - with null checks
                const batchTitle = newForm.querySelector('.batch-title');
                if (batchTitle) {
                    batchTitle.textContent = `Batch #${newIndex + 1}`;
                }

                const removeBtn = newForm.querySelector('.remove-batch-btn');
                if (removeBtn) {
                    removeBtn.style.display = 'block';
                }

                // Clear form inputs but keep readonly values
                newForm.querySelectorAll('input:not([readonly])').forEach(input => {
                    input.value = '';
                });

                // Reset selects
                newForm.querySelectorAll('select').forEach(select => {
                    select.selectedIndex = 0;
                    if (!select.classList.contains('product-select')) {
                        select.innerHTML = '<option value="">-- Select Stock Size --</option>';
                    }
                });

                // Reset validation classes and messages
                newForm.querySelectorAll('.is-valid, .is-invalid').forEach(element => {
                    element.classList.remove('is-valid', 'is-invalid');
                });

                // Hide stock container and clear info
                const stockContainer = newForm.querySelector('.stock-container');
                if (stockContainer) {
                    stockContainer.style.display = 'none';
                }

                const stockInfo = newForm.querySelector('.stock-availability-info');
                if (stockInfo) {
                    stockInfo.textContent = '';
                }

                // Add the new form to the container
                container.appendChild(newForm);

                // Initialize the new batch form
                initializeBatchForm(partnershipId, newIndex);
            });
        });

        function initializeBatchForm(partnershipId, index) {
            const batchForm = document.getElementById(`batch-form-${partnershipId}-${index}`);
            if (!batchForm) {
                console.error(`Form not found: batch-form-${partnershipId}-${index}`);
                return;
            }

            const batchId = `${partnershipId}-${index}`;

            // Initialize stock data tracking
            batchStockData[batchId] = { maxAvailableStock: 0 };

            // Get form elements with null checks
            const productSelect = batchForm.querySelector('.product-select');
            const stockContainer = batchForm.querySelector('.stock-container');
            const stockSelect = batchForm.querySelector('.stock-select');
            const quantityInput = batchForm.querySelector('.quantity-input');
            const stockInfo = batchForm.querySelector('.stock-availability-info');
            const removeBtn = batchForm.querySelector('.remove-batch-btn');

            // Set up remove button handler
            if (removeBtn) {
                removeBtn.onclick = function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    batchForm.remove();
                    delete batchStockData[batchId];

                    // Update batch numbers
                    const container = document.getElementById(`batch-forms-container-${partnershipId}`);
                    const remainingForms = container.querySelectorAll('.batch-form');
                    remainingForms.forEach((form, i) => {
                        const titleElem = form.querySelector('.batch-title');
                        if (titleElem) titleElem.textContent = `Batch #${i + 1}`;

                        const btnElem = form.querySelector('.remove-batch-btn');
                        if (btnElem) btnElem.style.display = i > 0 ? 'block' : 'none';
                    });
                };
            }

            // Set up product select change handler
            if (productSelect) {
                productSelect.onchange = function() {
                    const productId = this.value;
                    console.log(`Product selected: ${productId} for batch ${batchId}`);

                    // Reset quantity and validation
                    if (quantityInput) {
                        quantityInput.value = '';
                        quantityInput.classList.remove('is-valid', 'is-invalid');
                    }

                    if (stockInfo) stockInfo.textContent = '';
                    batchStockData[batchId].maxAvailableStock = 0;

                    if (productId && stockContainer && stockSelect) {
                        // Show loading indicator
                        stockContainer.style.display = 'block';
                        stockSelect.innerHTML = '<option>Loading stock data...</option>';
                        stockSelect.disabled = true;

                        // Fetch stock data
                        fetch(`/products/stocks/${productId}`)
                            .then(response => response.json())
                            .then(data => {
                                console.log(`Stock data received for batch ${batchId}:`, data);

                                // Clear and re-enable dropdown
                                stockSelect.innerHTML = '<option value="">-- Select Stock Size --</option>';
                                stockSelect.disabled = false;

                                // Add stock options
                                if (data && data.length > 0) {
                                    data.forEach(stock => {
                                        const option = document.createElement('option');
                                        option.value = stock.size;
                                        option.textContent = `${stock.size} ML - ${stock.stock} items available`;
                                        option.dataset.stock = stock.stock;
                                        stockSelect.appendChild(option);
                                    });
                                    console.log(`Added ${data.length} stock options to select`);
                                } else {
                                    stockSelect.innerHTML = '<option value="">No stock available</option>';
                                }
                            })
                            .catch(error => {
                                console.error(`Error fetching stock:`, error);
                                stockSelect.innerHTML = '<option value="">Error loading stock data</option>';
                                stockSelect.disabled = false;
                            });
                    } else if (stockContainer) {
                        stockContainer.style.display = 'none';
                    }
                };
            }

            // Rest of the function remains the same
            if (stockSelect) {
                stockSelect.onchange = function() {
                    if (this.selectedIndex > 0 && quantityInput && stockInfo) {
                        const selectedOption = this.options[this.selectedIndex];
                        const stockAmount = parseInt(selectedOption.dataset.stock);

                        batchStockData[batchId].maxAvailableStock = stockAmount;
                        quantityInput.max = stockAmount;
                        quantityInput.placeholder = `Maximum: ${stockAmount}`;
                        quantityInput.value = '';
                        quantityInput.classList.remove('is-valid', 'is-invalid');

                        stockInfo.textContent = `Available stock: ${stockAmount} items`;
                        stockInfo.className = 'text-muted mt-1';
                    }
                };
            }

            if (quantityInput) {
                quantityInput.oninput = function() {
                    validateQuantity(this, batchId);
                };
                quantityInput.onchange = function() {
                    validateQuantity(this, batchId);
                };
            }
        }

        // Rest of the code remains the same
    });
</script>

<style>
    /* Custom validation styling */
    .form-control.is-valid {
        border-color: #28a745;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='-2 -2 7 7'%3e%3cpath stroke='%23dc3545' d='M0 0l3 3m0-3L0 3'/%3e%3ccircle r='.5'/%3e%3ccircle cx='3' r='.5'/%3e%3ccircle cy='3' r='.5'/%3e%3ccircle cx='3' cy='3' r='.5'/%3e%3c/svg%3E");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    /* Batch form styling */
    .batch-form {
        position: relative;
    }

    .batch-form .card {
        border: 1px solid #e9ecef;
        transition: all 0.2s ease;
    }

    .batch-form .card:hover {
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .add-batch-btn {
        transition: all 0.2s ease;
    }

    .add-batch-btn:hover {
        transform: translateY(-2px);
    }

    .remove-batch-btn {
        transition: all 0.2s ease;
    }

    .remove-batch-btn:hover {
        background-color: #f8d7da;
    }
</style>
