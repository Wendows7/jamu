@extends('layouts.main')
@section('body')
    @include('orders.modal.order-view')
    <style>
        .order-table-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            padding: 24px;
            margin-top: 32px;
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

        .order-table-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            padding: 24px;
            margin-top: 32px;
            margin-bottom: 150px; /* Add this for spacing below the table */
        }

        .ec-page-content {
            margin-bottom: 180px;
        }
    </style>

    <style>/* Popup Modal */
        .popup-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        /* Hidden class to toggle visibility */
        .popup-modal.hidden {
            display: none;
        }

        /* Content Box */
        .popup-content {
            background-color: #fff;
            padding: 18px 16px;
            border-radius: 8px;
            max-width: 320px;
            width: 95%;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            position: relative;
        }

        /* Close Button */
        .close-btn {
            position: absolute;
            top: 12px;
            right: 18px;
            font-size: 22px;
            cursor: pointer;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
    <body>
    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row justify-content-center">
                <div class="ec-shop-rightside col-lg-10 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Order History</h5>
{{--                            <div class="ec-header-btn">--}}
{{--                                <a class="btn btn-lg btn-primary" href="{{route('products')}}">Shop Now</a>--}}
{{--                            </div>--}}
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Order Code</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Payment Method</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- Table rows remain the same -->
                                    @forelse($orders as $key => $order)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $order['order_code'] }}</td>
                                            <td>{{ $order['created_at'] ? $order['created_at']->timezone('Asia/Jakarta')->format('d M Y H:i') : '-' }}</td>
                                            <td>Rp {{number_format($order['total_price']) }}</td>
                                            <td>{{$order['payment']}}</td>
                                            <td>
                                                @php
                                                    $status = strtolower($order['status'] ?? 'other');
                                                    $badgeClass = match($status) {
                                                        'pending' => 'pending',
                                                        'success', 'settlement', 'paid' => 'success',
                                                        'cancel', 'failed', 'deny' => 'cancel',
                                                         'packaged' => 'packaged',
                                                         'sending' => 'sending',
                                                          'done' => 'done',
                                                        default => 'other'
                                                    };
                                                @endphp
                                                <span class="badge badge-status {{ $badgeClass }}">
                                                    {{ ucfirst($order['status'] ?? '-') }}
                                                </span>
                                            </td>
                                            <td>
                                                <div style="display: flex; gap: 8px; align-items: center;">
                                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailModal{{ $order['order_code'] }}">Detail</button>
                                                    @if($order['payment'] == null)
                                                        <form action="{{route('cart.orderDetail', ['orderCode' => $order['order_code']])}}" method="get">
                                                            @csrf
                                                        <button type="submit"
                                                                class="btn btn-sm btn-success pay-button">
                                                            Payment
                                                        </button>
                                                        </form>
                                                    @endif
                                                    @if($order['status'] == 'pending')
                                                        <form method="post" action="{{route('user.cancelOrderByOrderCode', ["orderCode" => $order['order_code']])}}" style="margin: 0;">
                                                            @csrf
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-danger show_confirm mt-1">
                                                                Cancel
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No order history found.</td>
                                            </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{$orders->links('components.pagination')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </body>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.show_confirm').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to cancel this order?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, cancel it!',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize tooltips
            if (typeof $.fn.tooltip === 'function') {
                $('[data-toggle="tooltip"]').tooltip();
            }

            // Ensure modals are properly initialized
            if (typeof $.fn.modal === 'function') {
                $('.modal').modal({
                    show: false
                });
            }

            // Your existing SweetAlert code
            document.querySelectorAll('.show_confirm').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to cancel this order?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, cancel it!',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
