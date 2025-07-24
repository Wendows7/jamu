@extends('layouts.main')
@section('body')
    <style>
        .order-table-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            padding: 24px;
            margin-top: 32px;
            margin-bottom: 150px;
        }

        .table thead th {
            background: #f8f9fa;
            font-weight: 700;
            border-bottom: 2px solid #dee2e6;
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: 12px;
            font-size: 0.95em;
        }
        .badge-status.pending { background: #ffe082; color: #856404; }
        .badge-status.success { background: #c8e6c9; color: #256029; }
        .badge-status.cancel { background: #ffcdd2; color: #b71c1c; }
        .badge-status.other { background: #e3e3e3; color: #333; }

        .ec-page-content {
            margin-bottom: 180px;
        }

        .view-products-btn {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.2s;
        }

        .view-products-btn:hover {
            background-color: #2980b9;
        }

        .modal-table th, .modal-table td {
            padding: 8px 12px;
        }
    </style>

    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row justify-content-center">
                <div class="ec-shop-rightside col-lg-10 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Sending History</h5>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Batch Number</th>
                                        <th scope="col">Company Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Products</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($data as $key => $batch)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>#{{ $batch['batch_number'] }}</td>
                                            <td>{{ $batch['company_name'] }}</td>
                                            <td>{{ $batch['created_at'] }}</td>
                                            <td>{{ $batch['products']->count() }} items</td>
                                            <td>
                                                @php
                                                    $status = 'pending'; // Default status or you can get it from batch
                                                    $badgeClass = match($status) {
                                                        'pending' => 'pending',
                                                        'approved', 'settlement', 'paid', 'sending' => 'success',
                                                        'cancel', 'failed', 'deny' => 'cancel',
                                                        default => 'other'
                                                    };
                                                @endphp
                                                <span class="badge badge-status {{ $badgeClass }}">
                                                    {{ ucfirst($status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <button class="view-products-btn" data-batch="{{ $key }}">
                                                    <i class="fas fa-eye"></i> View Products
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No sending history found.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Details Modal -->
    <div class="modal fade" id="productDetailsModal" tabindex="-1" role="dialog" aria-labelledby="productDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailsModalLabel">Batch Products</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered modal-table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Product Name</th>
                                <th>Size</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody id="modalProductTableBody">
                            <!-- Products will be inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Store batch data for modal use - using $data which matches your view variable
            const batchData = @json($data ?? []);

            // Set up click handlers for view buttons
            document.querySelectorAll('.view-products-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const batchIndex = this.dataset.batch;
                    const batch = batchData[batchIndex];

                    if (!batch) {
                        console.error('Batch data not found for index:', batchIndex);
                        return;
                    }

                    // Clear previous modal content
                    const modalTableBody = document.getElementById('modalProductTableBody');
                    modalTableBody.innerHTML = '';

                    // Set modal title
                    document.getElementById('productDetailsModalLabel').textContent =
                        `Batch #${batch.batch_number} - ${batch.company_name}`;

                    // Add products to modal table
                    batch.products.forEach((product, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${product.product_name}</td>
                    <td>${product.size} ML</td>
                    <td>${product.quantity}</td>
                `;
                        modalTableBody.appendChild(row);
                    });

                    // Show the modal using jQuery
                    $('#productDetailsModal').modal('show');
                });
            });

            // Debug log to verify that buttons are found
            console.log('View product buttons found:', document.querySelectorAll('.view-products-btn').length);
        });
    </script>
@endsection
