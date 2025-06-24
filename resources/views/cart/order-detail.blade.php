@extends('layouts.main')

@section('body')
    <style>
        .order-container {
            max-width: 1100px;
            margin: 48px auto 32px;
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 6px 32px rgba(0,0,0,0.07);
            padding: 42px 36px 30px 36px;
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
        }

        .order-title {
            margin-bottom: 26px;
            font-size: 2.3rem;
            font-weight: 700;
            color: #252525;
            letter-spacing: 1px;
        }

        .order-section {
            margin-bottom: 30px;
        }

        /* Produk Table */
        .order-products-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 6px;
        }

        .order-products-table th {
            padding: 10px 16px;
            background: #fafbfc;
            color: #666;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 10px 10px 0 0;
            border-bottom: 2px solid #f1f1f1;
        }

        .order-products-table td {
            background: #f9f9f9;
            padding: 12px 14px;
            font-size: 1rem;
            vertical-align: middle;
            border-bottom: 1.5px solid #f3f3f3;
            border-radius: 0 0 12px 12px;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .product-info img {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border-radius: 12px;
            background: #f5f5f5;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }

        .product-info strong {
            font-weight: 600;
            color: #232323;
        }

        /* Form Input */
        .order-form-grid {
            display: flex;
            gap: 20px;
            margin-bottom: 12px;
        }

        .order-form-grid > div {
            flex: 1;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #444;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px 14px;
            border-radius: 9px;
            border: 1.5px solid #e5e6e9;
            background: #fafbfc;
            font-size: 1rem;
            transition: border-color 0.2s;
            margin-bottom: 2px;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #ff9000;
            outline: none;
        }

        textarea {
            resize: vertical;
        }

        /* Payment */
        .order-payment-methods {
            display: flex;
            gap: 30px;
            margin-top: 8px;
            margin-bottom: 8px;
        }

        .order-payment-methods label {
            margin-right: 0;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            background: #f6f6f6;
            border-radius: 8px;
            padding: 8px 18px 8px 10px;
            border: 1.5px solid #ececec;
            transition: border-color 0.2s, background 0.2s;
        }

        .order-payment-methods input[type="radio"]:checked + span {
            color: #ff9000;
            font-weight: 700;
        }

        /* Button */
        .order-submit-btn {
            background: linear-gradient(90deg,#ff9000 0%, #fda700 100%);
            color: #fff;
            padding: 16px 46px;
            border: none;
            border-radius: 36px;
            font-size: 1.18rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 12px rgba(255,144,0,0.10);
            transition: background 0.2s, box-shadow 0.2s;
            letter-spacing: 1px;
        }

        .order-submit-btn:hover {
            background: linear-gradient(90deg,#ff9f2f 0%, #ffd042 100%);
            color: #222;
            box-shadow: 0 4px 24px rgba(255,180,40,0.12);
        }

        @media (max-width: 800px) {
            .order-container { padding: 18px 4vw; }
            .order-title { font-size: 1.6rem; }
            .order-form-grid { flex-direction: column; gap: 0; }
            .order-products-table th, .order-products-table td { font-size: .98rem; }
            .order-submit-btn { width: 100%; }
        }

        .order-summary-box {
            max-width: 350px;
            /*margin-left: auto;*/
            /*margin-right: 0;*/
            /*margin-top: 24px;*/
            background: #fffaf3;
            border: 1.5px solid #ffe3b0;
            border-radius: 16px;
            box-shadow: 0 1px 8px rgba(255,200,64,0.08);
            padding: 22px 26px 12px 26px;
        }

        .order-summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 1.07rem;
            margin-bottom: 8px;
            color: #4d4d4d;
        }

        .order-summary-total {
            font-size: 1.2rem;
            color: #ff9000;
            margin-top: 14px;
            font-weight: bold;
        }


    </style>


    <div class="order-container">
        <div class="order-title">Formulir Pengiriman</div>
        <form action="{{route('cart.createOrderDetail')}}" method="POST" autocomplete="off">
            @csrf
            <input type="hidden" name="orderCode" value="{{ $orderData->order_code }}">
            <!-- 1. Daftar Produk -->
            <div class="order-section">
                <h3 style="margin-bottom: 14px; font-size:1.18rem; color:#ff9000; font-weight:600;">Produk yang Dibeli</h3>
                <table class="order-products-table">
                    <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Size</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactionsData as $item)
                        <tr>
                            <td class="product-info">
                                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" />
                                <div>
                                    <strong>{{ $item->product->name }}</strong>
                                </div>
                            </td>
{{--                            @dd($item)--}}
                            <td >{{ $item->quantity }}</td>
                            <td >{{ $item->size }} ML</td>
                            <td>Rp {{ number_format($item->product->stockProduct->where('size', $item->size)->first()->price,0,',','.') }}</td>
                            <td style="font-weight:600;">Rp {{ number_format($item->total_price,0,',','.') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


            <!-- 2. Info Pengiriman -->
            <div class="order-section">
                <h3 style="margin-bottom: 12px; font-size:1.13rem; color:#ff9000; font-weight:600;">Informasi Pengiriman</h3>
                <div class="order-form-grid">
                    <div>
                        <label for="first_name">Nama Depan</label>
                        <input type="text" name="first_name" id="first_name" required placeholder="Masukkan nama depan anda">
                    </div>
                    <div>
                        <label for="last_name">Nama Belakang</label>
                        <input type="text" name="last_name" id="last_name" required placeholder="Masukkan nama belakang anda">
                    </div>
                </div>
                    <div>
                        <label for="recipient_phone">No. HP</label>
                        <input type="text" name="phone_number" id="recipient_phone" required placeholder="Contoh: 081234567890">
                    </div>
                <label for="recipient_address">Alamat Lengkap</label>
                <textarea name="address" id="recipient_address" rows="3" required placeholder="Contoh: Jl. Rajawali No.4 Medan Kota, Medan"></textarea>
            </div>

            <!-- 3. Metode Pembayaran -->
            <div class="order-section">
                <h3 style="margin-bottom: 10px; font-size:1.13rem; color:#ff9000; font-weight:600;">Metode Pembayaran</h3>
                <div class="order-payment-methods">
                    @foreach($paymentData as $payment)
                    <label>
                        <input type="radio" name="payment_method" value="{{$payment->id}}" required>
                        <span>{{$payment->name}}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            <!-- Ringkasan Total -->
            <div class="order-section">
                <h3 style="margin-bottom: 10px; font-size:1.13rem; color:#ff9000; font-weight:600;">Ringkasan Pembayaran</h3>
                <div class="order-summary-box">
                    <div class="order-summary-row">
                        <span>Total Item</span>
                        <span>{{ $transactionsData->count()}}</span>
                    </div>
                    <div class="order-summary-row order-summary-total">
                        <strong>Total Bayar</strong>
                        <strong>Rp {{ number_format($transactionsData->sum('total_price'),0,',','.') }}</strong>
                    </div>
                </div>
            </div>


            <!-- 4. Tombol Submit -->
            <div class="order-section" style="text-align: right">
                <button type="submit" class="order-submit-btn">Bayar</button>
            </div>
        </form>
    </div>

@endsection
