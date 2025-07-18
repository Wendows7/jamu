{{-- start create modal --}}
<div class="modal fade" tabindex="-1" role="dialog" id="createModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('admin.partnerships.sending.add')}}" enctype="multipart/form-data" class="needs-validation" novalidate="" id="partnership-form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Company Name</label>
                            <select name="partnership_id" class="form-control" required>
                                <option value="">-- Select Company --</option>
                                @foreach($partner as $value)
                                    <option value="{{ $value->id }}" {{ old('partnership_id') == $value->id ? 'selected' : '' }}>
                                        {{ $value->company_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please fill this form</div>
                        </div>
                        <div class="form-group">
                            <label>Product</label>
                            <select name="product_id" id="product_select" class="form-control" required>
                                <option value="">-- Select Product --</option>
                                @foreach($product as $value)
                                    <option value="{{ $value->id }}" {{ old('product_id') == $value->id ? 'selected' : '' }}>
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please fill this form</div>
                        </div>

                        <!-- Container for product stock info (initially hidden) -->
                        <div id="product_stock_container" class="form-group" style="display: none;">
                            <label>Size & Available Stock</label>
                            <select name="size" id="stock_select" class="form-control" required>
                                <option value="">-- Select Stock Size --</option>
                            </select>
                            <div class="invalid-feedback">Please select available stock</div>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" id="quantity_input" class="form-control" min="1" required>
                            <div class="invalid-feedback" id="quantity-error-message">Please fill this form</div>
                            <small id="stock-availability-info" class="text-muted"></small>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="submit-button" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function addSizeStockRow() {
        const tbody = document.getElementById('sizes-stock-body');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="text" name="sizes[]" class="form-control" required></td>
            <td><input type="number" name="stocks[]" class="form-control" min="0" required></td>
        `;
        tbody.appendChild(row);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const productSelect = document.getElementById('product_select');
        const stockContainer = document.getElementById('product_stock_container');
        const stockSelect = document.getElementById('stock_select');
        const quantityInput = document.getElementById('quantity_input');
        const stockInfo = document.getElementById('stock-availability-info');
        const submitButton = document.getElementById('submit-button');
        const form = document.getElementById('partnership-form');

        let maxAvailableStock = 0;

        // Handle product selection and fetch stock information
        productSelect.addEventListener('change', function() {
            const productId = this.value;

            // Reset quantity field when product changes
            quantityInput.value = '';
            quantityInput.classList.remove('is-valid', 'is-invalid');
            stockInfo.textContent = '';
            maxAvailableStock = 0;

            if (productId) {
                // Show loading indicator
                stockContainer.style.display = 'block';
                stockSelect.innerHTML = '<option>Loading stock data...</option>';
                stockSelect.disabled = true;

                // Fetch stock data for the selected product
                fetch(`/products/stocks/${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear and re-enable the stock dropdown
                        stockSelect.innerHTML = '<option value="">-- Select Stock Size --</option>';
                        stockSelect.disabled = false;

                        // Add stock options
                        if (data.length > 0) {
                            data.forEach(stock => {
                                const option = document.createElement('option');
                                option.value = stock.size;
                                option.textContent = `${stock.size} ML - ${stock.stock} items available`;
                                option.dataset.price = stock.price;
                                option.dataset.stock = stock.stock;
                                stockSelect.appendChild(option);
                            });
                        } else {
                            stockSelect.innerHTML = '<option value="">No stock available</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching stock data:', error);
                        stockSelect.innerHTML = '<option value="">Error loading stock data</option>';
                    });
            } else {
                // Hide stock selection if no product is selected
                stockContainer.style.display = 'none';
            }
        });

        // Update available stock info when stock size changes
        stockSelect.addEventListener('change', function() {
            if (this.selectedIndex > 0) {
                const selectedOption = this.options[this.selectedIndex];
                maxAvailableStock = parseInt(selectedOption.dataset.stock);

                // Update quantity input attributes
                quantityInput.max = maxAvailableStock;
                quantityInput.placeholder = `Maximum: ${maxAvailableStock}`;

                // Show stock availability info
                stockInfo.textContent = `Available stock: ${maxAvailableStock} items`;
                stockInfo.className = 'text-muted mt-1';

                // Reset quantity value and validation
                quantityInput.value = '';
                quantityInput.classList.remove('is-valid', 'is-invalid');
            }
        });

        // Validate quantity against available stock
        quantityInput.addEventListener('input', validateQuantity);
        quantityInput.addEventListener('change', validateQuantity);

        function validateQuantity() {
            const quantity = parseInt(quantityInput.value);
            const errorMsg = document.getElementById('quantity-error-message');

            // Clear previous validation
            quantityInput.classList.remove('is-valid', 'is-invalid');

            // Validate if we have a selected stock and quantity
            if (maxAvailableStock > 0 && !isNaN(quantity)) {
                if (quantity <= 0) {
                    quantityInput.classList.add('is-invalid');
                    errorMsg.textContent = 'Quantity must be greater than 0';
                    return false;
                } else if (quantity > maxAvailableStock) {
                    quantityInput.classList.add('is-invalid');
                    errorMsg.textContent = `Quantity cannot exceed available stock (${maxAvailableStock})`;
                    return false;
                } else {
                    quantityInput.classList.add('is-valid');
                    return true;
                }
            }
            return false;
        }

        // Form submission validation
        form.addEventListener('submit', function(event) {
            if (!validateQuantity()) {
                event.preventDefault();
                event.stopPropagation();
            }
        });

        // Check if product is pre-selected (e.g., from validation error)
        if (productSelect.value) {
            productSelect.dispatchEvent(new Event('change'));
        }
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
</style>
