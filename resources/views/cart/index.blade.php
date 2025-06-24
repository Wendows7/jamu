@extends('layouts.main')
@section('body')
    <style>
        .cart-container-page {
            max-width: 950px;
            margin: 36px auto 48px auto;
            padding: 28px 16px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 3px 28px rgba(0,0,0,.06);
        }
        .cart-container-page .cart-title {
            font-size: 2rem;
            font-weight: 700;
            color: #ff9000;
            margin-bottom: 20px;
            letter-spacing: 1px;
            text-align: center;
        }
        .cart-container-page .cart-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
            margin-bottom: 24px;
        }
        .cart-container-page .cart-table th,
        .cart-container-page .cart-table td {
            padding: 14px 12px;
            text-align: center;
            background: #f7f8fb;
            font-size: 1.08rem;
            border-radius: 12px;
            vertical-align: middle;
        }
        .cart-container-page .cart-table th {
            background: #fff8e1;
            color: #ff9000;
            font-weight: bold;
            font-size: 1.09rem;
        }
        .cart-container-page .cart-product {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .cart-container-page .cart-product img {
            width: 60px; height: 60px;
            border-radius: 9px;
            object-fit: cover;
            box-shadow: 0 2px 6px #ffe0b070;
            background: #fffaf5;
        }
        .cart-container-page .cart-pro-title {
            font-weight: 600;
            color: #212121;
            font-size: 1.07rem;
            margin-bottom: 2px;
            text-align: left;
        }
        .cart-container-page .cart-item-size {
            font-size: 0.99rem;
            color: #ff9000;
            margin-bottom: 4px;
            text-align: left;
        }
        .cart-container-page .cart-price {
            font-weight: 500;
            color: #333;
        }
        .cart-container-page .cart-remove {
            color: #e74c3c;
            font-size: 1.7rem;
            cursor: pointer;
            border: none;
            background: transparent;
            transition: color .15s;
        }
        .cart-container-page .cart-remove:hover { color: #b81a1a;}
        .cart-container-page .cart-summary {
            max-width: 370px;
            margin-left: auto;
            background: #fffaed;
            border-radius: 14px;
            box-shadow: 0 2px 14px #ffecb366;
            padding: 25px 28px 17px 28px;
        }
        .cart-container-page .cart-summary-title {
            font-weight: 600;
            color: #ff9000;
            font-size: 1.12rem;
            margin-bottom: 12px;
        }
        .cart-container-page .cart-summary-table {
            width: 100%;
            margin-bottom: 12px;
        }
        .cart-container-page .cart-summary-table td {
            padding: 6px 0;
            font-size: 1.03rem;
            color: #555;
        }
        .cart-container-page .cart-summary-total {
            font-weight: 700;
            color: #ff9000;
            font-size: 1.2rem;
            border-top: 2px dashed #ffd580;
            padding-top: 10px;
            margin-top: 7px;
        }
        .cart-container-page .cart-btn-row {
            display: flex;
            gap: 16px;
            margin-top: 20px;
            justify-content: flex-end;
        }
        .cart-container-page .btn-cart {
            border: none;
            border-radius: 24px;
            font-size: 1.09rem;
            font-weight: bold;
            padding: 13px 38px;
            cursor: pointer;
            transition: background .18s;
            background: #fff;
            color: #ff9000;
            border: 2px solid #ff9000;
        }
        .cart-container-page .btn-cart:hover {
            background: #ff9000;
            color: #fff;
        }
        .cart-container-page .btn-cart-checkout {
            background: linear-gradient(90deg,#ffa726 0%, #ff9000 100%);
            color: #fff;
            border: none;
        }
        .cart-container-page .btn-cart-checkout:hover {
            background: #ffd580;
            color: #ff9000;
        }
        .cart-container-page .cart-item-qty {
            display: flex;
            align-items: center;
            border: 1px solid #eeeeee;
            border-radius: 30px;
            overflow: hidden;
            width: 90px;
            height: 36px;
            margin-top: 0;
            background: #ffffff;
        }
        .cart-container-page .cart-item-qty button {
            width: 28px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: none;
            font-size: 18px;
            color: #777777;
            cursor: pointer;
            padding: 0;
        }
        .cart-container-page .cart-item-qty .cart-qty-minus { border-right: 1px solid #eeeeee; }
        .cart-container-page .cart-item-qty .cart-qty-plus { border-left: 1px solid #eeeeee; }
        .cart-container-page .cart-item-qty .cart-qty-input {
            width: 30px;
            border: none;
            text-align: center;
            font-size: 15px;
            color: #444444;
            padding: 0;
            background: transparent;
        }
        .cart-container-page .cart-item-qty button:hover { background-color: #f5f5f5; }
        .cart-container-page .cart-item-qty button:active { background-color: #eeeeee; }
        @media (max-width: 800px) {
            .cart-container-page .cart-summary { max-width: 99vw; }
            .cart-container-page { padding: 9vw 1vw;}
        }
        @media (max-width: 600px) {
            .cart-container-page .cart-title { font-size: 1.12rem; }
            .cart-container-page .cart-table th,
            .cart-container-page .cart-table td { font-size: 1rem; padding: 9px 3px;}
            .cart-container-page .cart-summary { padding: 15px 3vw 7px 3vw;}
            .cart-container-page .cart-btn-row { flex-direction: column; gap: 7px;}
        }

        .cart-container-page .cart-size-select {
            border-radius: 10px;
            border: 1.5px solid #ffcb6d;
            padding: 6px 15px 6px 8px;
            font-size: 1rem;
            color: #ff9000;
            font-weight: 600;
            background: #fffdfa;
            transition: border .18s;
            margin-top: 2px;
            margin-bottom: 2px;
            outline: none;
        }
        .cart-container-page .cart-size-select:focus {
            border: 1.5px solid #ff9000;
            background: #fff6e4;
        }

    </style>

    <div class="cart-container-page">
        <div class="cart-title">Keranjang Saya</div>
        <form action="{{route('cart.checkout')}}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="1">
            <table class="cart-table">
                <thead>
                <tr>
                    <th>Produk</th>
                    <th>Size</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(session('cart') && count(session('cart')))
                    @foreach(session('cart') as $id => $cart)
                        <tr data-product-id="{{ $id }}">
                            <td>
                                <div class="cart-product">
                                    <img src="{{asset($cart['image'])}}" alt="product">
                                    <div>
                                        <div class="cart-pro-title">{{$cart['name']}}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select class="cart-size-select" data-product-id="{{ $id }}">
                                    @foreach($cart['data_stock'] as $size)
                                        <option value="{{ $size->size }}" @if($size->size == $cart['size']) selected @endif>
                                            {{ $size->size }} ML
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="cart-price">Rp {{number_format($cart['price'])}}</td>
                            <td>
                                <div class="cart-item-qty">
                                    <button type="button" class="cart-qty-minus">-</button>
                                    <input class="cart-qty-input" type="text" name="quantity[{{$id}}]" value="{{$cart['quantity']}}" readonly>
                                    <button type="button" class="cart-qty-plus">+</button>
                                </div>
                            </td>
                            <td class="cart-price">Rp {{number_format($cart['price'] * $cart['quantity'])}}</td>
                            <td>
                                <button type="button" class="cart-remove" title="Hapus">×</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="6" style="text-align:center;">Keranjang kamu kosong.</td></tr>
                @endif
                </tbody>
            </table>
            <div class="cart-summary">
                <div class="cart-summary-title">Ringkasan Belanja</div>
                <table class="cart-summary-table">
                    <tbody>
                    @if(session('cart') && count(session('cart')))
                        @foreach(session('cart') as $id => $cart)
                            <tr data-product-id="{{ $id }}">
                                <td class="text-left">
                                    {{ $cart['name'] }} ({{ $cart['size'] }}ML, {{ $cart['quantity'] }}x)
                                </td>
                                <td class="text-right item-total">Rp {{number_format($cart['price'] * $cart['quantity'])}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-left cart-summary-total">Total :</td>
                            <td class="text-right cart-summary-total" id="cart-total">
                                Rp {{number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, session('cart'))))}}
                            </td>
                        </tr>
                    @else
                        <tr><td colspan="2" class="cart-summary-total" style="text-align:center;">Rp 0</td></tr>
                    @endif
                    </tbody>
                </table>
                <div class="cart-btn-row">
                    <button type="submit" class="btn-cart btn-cart-checkout" @if(!session('cart') || !count(session('cart'))) disabled @endif>
                        Checkout
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Button event handlers, scoped ke halaman cart page
            const cartPage = document.querySelector('.cart-container-page');
            if (!cartPage) return;

            const plusBtns = cartPage.querySelectorAll('.cart-qty-plus');
            const minusBtns = cartPage.querySelectorAll('.cart-qty-minus');

            plusBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const input = this.parentNode.querySelector('.cart-qty-input');
                    let currentVal = parseInt(input.value);
                    input.value = currentVal + 1;
                    updateCartQuantity(input);
                });
            });

            minusBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const input = this.parentNode.querySelector('.cart-qty-input');
                    let currentVal = parseInt(input.value);
                    if (currentVal > 1) {
                        input.value = currentVal - 1;
                        updateCartQuantity(input);
                    }
                });
            });

            // Size control
            cartPage.querySelectorAll('.cart-size-select').forEach(function(select) {
                select.addEventListener('change', function() {
                    updateCartSize(this);
                });
            });

            function updateCartQuantity(input) {
                const quantity = parseInt(input.value);
                const row = input.closest('tr');
                const productId = row.dataset.productId;
                const sizeSelect = row.querySelector('.cart-size-select');
                const selectedSize = sizeSelect ? sizeSelect.value : null;

                // Update subtotal di tabel cart
                const priceCell = row.querySelectorAll('.cart-price')[0];
                const subtotalCell = row.querySelectorAll('.cart-price')[1];
                const price = parseInt(priceCell.textContent.replace(/[^\d]/g, ''));
                subtotalCell.textContent = 'Rp ' + formatNumber(price * quantity);

                // Update item di summary
                const summaryRow = cartPage.querySelector(`.cart-summary-table tr[data-product-id="${productId}"]`);
                if (summaryRow) {
                    summaryRow.querySelector('td.text-left').textContent =
                        row.querySelector('.cart-pro-title').textContent + ` (${selectedSize}ML, ${quantity}x)`;
                    summaryRow.querySelector('.item-total').textContent = 'Rp ' + formatNumber(price * quantity);
                }

                // Update cart totals
                updateCartTotals();

                // Send update to server
                updateCartSession(productId, quantity, selectedSize);
            }

            function updateCartSize(select) {
                const row = select.closest('tr');
                const productId = row.dataset.productId;
                const input = row.querySelector('.cart-qty-input');
                const quantity = parseInt(input.value);
                const selectedSize = select.value;

                fetch('/cart/updateQuantity', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ id: productId, quantity: quantity, size: selectedSize })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.price) {
                            const priceCell = row.querySelectorAll('.cart-price')[0];
                            const subtotalCell = row.querySelectorAll('.cart-price')[1];
                            priceCell.textContent = 'Rp ' + formatNumber(data.price);
                            subtotalCell.textContent = 'Rp ' + formatNumber(data.price * quantity);

                            const summaryRow = cartPage.querySelector(`.cart-summary-table tr[data-product-id="${productId}"]`);
                            if (summaryRow) {
                                summaryRow.querySelector('td.text-left').textContent =
                                    row.querySelector('.cart-pro-title').textContent + ` (${selectedSize}ML, ${quantity}x)`;
                                summaryRow.querySelector('.item-total').textContent = 'Rp ' + formatNumber(data.price * quantity);
                            }
                            updateCartTotals();
                        } else {
                            const summaryRow = cartPage.querySelector(`.cart-summary-table tr[data-product-id="${productId}"]`);
                            if (summaryRow) {
                                summaryRow.querySelector('td.text-left').textContent =
                                    row.querySelector('.cart-pro-title').textContent + ` (${selectedSize}ML, ${quantity}x)`;
                            }
                            updateCartTotals();
                        }
                    });
            }


            function formatNumber(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function updateCartTotals() {
                let subtotal = 0;
                cartPage.querySelectorAll('.cart-summary-table .item-total').forEach(function(td){
                    subtotal += parseInt(td.textContent.replace(/[^\d]/g,''));
                });
                cartPage.querySelector('#cart-total').textContent = 'Rp ' + formatNumber(subtotal);
            }

            function updateCartSession(productId, quantity, size) {
                fetch('/cart/updateQuantity', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ id: productId, quantity: quantity, size: size })
                })
                    .then(res => res.json())
                    .then(data => {
                        console.log(data);
                        // Jika backend mengirim harga baru (misal size berubah via plus/minus), update juga harga & subtotal
                        if (data.price) {
                            const row = cartPage.querySelector(`tr[data-product-id="${productId}"]`);
                            const priceCell = row.querySelectorAll('.cart-price')[0];
                            const subtotalCell = row.querySelectorAll('.cart-price')[1];
                            priceCell.textContent = 'Rp ' + formatNumber(data.price);
                            subtotalCell.textContent = 'Rp ' + formatNumber(data.price * quantity);

                            // Update summary
                            const summaryRow = cartPage.querySelector(`.cart-summary-table tr[data-product-id="${productId}"]`);
                            if (summaryRow) {
                                summaryRow.querySelector('.item-total').textContent = 'Rp ' + formatNumber(data.price * quantity);
                            }
                            updateCartTotals();
                        }
                    });
            }

            // Add event listeners to remove buttons
            const removeBtns = cartPage.querySelectorAll('.cart-remove');
            removeBtns.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    const row = this.closest('tr');
                    const productId = row.dataset.productId;

                    fetch('/cart/remove', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ id: productId })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Remove item from DOM
                                row.remove();

                                // Remove corresponding row from subtotal section
                                const subtotalRow = cartPage.querySelector(`.cart-summary-table tr[data-product-id="${productId}"]`);
                                if (subtotalRow) {
                                    subtotalRow.remove();
                                }

                                // Update cart totals
                                updateCartTotals();

                                // Show empty cart message if no items left
                                if (cartPage.querySelectorAll('.cart-table tbody tr').length === 0) {
                                    cartPage.querySelector('.cart-table tbody').innerHTML = `<tr><td colspan="6" style="text-align:center;">Keranjang kamu kosong.</td></tr>`;
                                    cartPage.querySelector('.cart-summary-table tbody').innerHTML = `<tr><td colspan="2" class="cart-summary-total" style="text-align:center;">Rp 0</td></tr>`;
                                    cartPage.querySelector('.btn-cart-checkout').setAttribute('disabled', true);
                                }
                            }
                        })
                        .catch(error => console.error('Error removing item:', error));
                });
            });

        });
    </script>



@endsection
