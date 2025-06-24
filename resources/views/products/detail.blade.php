
@extends('layouts.main')
@section('body')
    <style>
        /* --- PRODUCT DETAIL --- */
        .product-detail {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.03);
            padding: 32px;
            margin-bottom: 36px;
            margin-top: 50px;
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            align-items: flex-start;
        }
        .product-gallery {
            flex: 1 1 320px;
            max-width: 400px;
            min-width: 270px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .main-image {
            width: 100%;
            height: 340px;
            background: #f4f5f6;
            border-radius: 10px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            overflow: hidden;
        }
        .main-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            display: block;
            margin: 0 auto;
            background: #fafbfc;
            border-radius: 10px;
        }
        .thumb-list {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .thumb-list img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border-radius: 6px;
            background: #fff;
            border: 2px solid #e2e8f0;
            cursor: pointer;
            transition: border .2s;
        }
        .thumb-list img.active, .thumb-list img:hover {
            border: 2.5px solid #3b82f6;
        }

        .product-info {
            flex: 2 1 400px;
            min-width: 260px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .product-info h2 {
            margin-top: 0;
            margin-bottom: 12px;
            font-size: 2rem;
        }
        .product-meta {
            color: #999;
            font-size: 1.05rem;
            margin-bottom: 4px;
        }
        .product-price {
            font-size: 1.7rem;
            font-weight: bold;
            color: #ef7800;
            margin-bottom: 8px;
        }
        .product-stock {
            font-size: 1.05rem;
            color: #18c964;
            font-weight: 500;
            margin-bottom: 12px;
        }
        .product-size {
            margin-bottom: 16px;
        }
        .size-options {
            display: flex;
            gap: 10px;
            margin-top: 6px;
        }
        .size-options span {
            padding: 6px 16px;
            border: 1.5px solid #d3dbe8;
            border-radius: 6px;
            font-size: 1rem;
            background: #f7fafc;
            cursor: pointer;
            transition: all .2s;
        }
        .size-options span.active, .size-options span:hover {
            border-color: #3b82f6;
            background: #e0eaff;
        }
        .product-qty-cart {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 20px;
        }
        .qty-btn {
            width: 32px;
            height: 32px;
            background: #f1f5f9;
            border: none;
            border-radius: 6px;
            font-size: 1.3rem;
            cursor: pointer;
            transition: background .2s;
        }
        .qty-btn:hover {
            background: #dbeafe;
        }
        .qty-input {
            width: 38px;
            text-align: center;
            font-size: 1.1rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 6px;
            background: #fff;
            padding: 4px;
        }
        .add-cart-btn {
            background: #f59e42;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 34px;
            font-size: 1.12rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 1px 8px rgba(255,184,0,0.06);
            margin-left: 18px;
            transition: background .2s;
        }
        .add-cart-btn:hover {
            background: #ff8500;
        }
        .product-social {
            margin-top: 10px;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .product-social a {
            color: #6b7280;
            font-size: 1.3rem;
            background: #f1f5f9;
            border-radius: 50%;
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .18s;
        }
        .product-social a:hover {
            background: #e0eaff;
            color: #2563eb;
        }

        /* --- PRODUCT TAB --- */
        .product-tab {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.03);
            padding: 30px;
            margin-bottom: 50px;
        }
        .tab-nav {
            display: flex;
            gap: 4px;
            border-bottom: 2px solid #e5e7eb;
            margin-bottom: 18px;
        }
        .tab-nav button {
            background: none;
            border: none;
            padding: 10px 20px;
            font-size: 1.1rem;
            cursor: pointer;
            font-weight: 600;
            color: #888;
            border-radius: 7px 7px 0 0;
            transition: color .2s, background .2s;
        }
        .tab-nav button.active, .tab-nav button:hover {
            background: #e0eaff;
            color: #2563eb;
            border-bottom: 2px solid #2563eb;
        }
        .tab-content { display: none; }
        .tab-content.active { display: block; }

        /* --- RESPONSIVE --- */
        @media (max-width: 900px) {
            .flex { flex-direction: column; gap: 30px; }
            .product-detail { padding: 16px; }
            .product-tab { padding: 16px; }
        }
        @media (max-width: 600px) {
            .main-image { height: 210px; }
            .thumb-list img { width: 45px; height: 45px; }
            .container { padding: 12px; }
            .product-detail { gap: 16px; }
        }
    </style>
<body>
<form action="{{ route('cart.addToCart') }}" method="post" >
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">

<div class="container">
    <!-- PRODUCT DETAIL -->
    <div class="product-detail flex">
        <!-- GALLERY -->
        <div class="product-gallery">
            <div class="main-image" id="main-image">
                <img src="{{asset($product->image)}}" alt="Product" id="mainImageTag">
            </div>
            <div class="thumb-list">
                <img src="{{asset($product->image)}}" alt="Thumb1" class="active" onclick="setMainImage(this)">
                <img src="{{asset($product->image_2)}}" alt="Thumb2" onclick="setMainImage(this)">
                <img src="{{asset($product->image_3)}}" alt="Thumb3" onclick="setMainImage(this)">
            </div>
        </div>
        <!-- INFO -->
        <div class="product-info">
            <div>
                <h2>{{$product->name}}</h2>
                <div class="product-meta">{{$product->category->name}}</div>
                <div class="product-price" id="productPrice">
                    Rp {{ number_format($product->stockProduct->first()->price) }}
                </div>
                <div class="product-stock">In Stock: <b>{{$totalStock}}</b></div>
            </div>
            <div class="product-size">
                <div><b>Size</b></div>
                <div class="size-options">
                    @foreach($product->stockProduct as $stock)
                        <span onclick="setSize(this, '{{$stock->size}}')" @if($loop->first) class="active" @endif>
                            {{$stock->size}} ML
                        </span>
                    @endforeach
                    <input type="hidden" name="size" id="selectedSize" value="{{ $product->stockProduct->first()->size ?? '' }}">
                </div>
            </div>
            <div class="product-qty-cart">
                <button class="qty-btn" onclick="setQty(-1)" type="button">-</button>
                <input type="text" value="1" class="qty-input" id="qtyInput" name="quantity">
                <button class="qty-btn" onclick="setQty(1)" type="button">+</button>
                <button type="submit" class="add-cart-btn">ADD TO CART</button>
            </div>
        </div>
    </div>

    <!-- PRODUCT TAB -->
    <div class="product-tab">
        <div class="tab-nav">
            <button class="active" onclick="showTab(0)">Detail</button>
{{--            <button onclick="showTab(1)">Komposisi</button>--}}
        </div>
        <div class="tab-content active">
            <p>{!! $product->description !!}</p>
        </div>
{{--        <div class="tab-content">--}}
{{--            <ul>--}}
{{--                <li><b>Komposisi:</b> Kunyit segar, asam jawa, gula aren, air, jahe, rempah lain.</li>--}}
{{--                <li><b>Berat:</b> 700 gram (dengan botol)</li>--}}
{{--                <li><b>Dimensi:</b> 18 cm x 7 cm x 7 cm</li>--}}
{{--            </ul>--}}
{{--        </div>--}}
    </div>
</div>
</form>
<!-- SCRIPT GALLERY & TAB -->
<script>
    // GALLERY THUMBNAIL
    function setMainImage(thumb) {
        document.getElementById('mainImageTag').src = thumb.src;
        document.querySelectorAll('.thumb-list img').forEach(img => img.classList.remove('active'));
        thumb.classList.add('active');
    }
    function setSize(sizeElem, sizeValue) {
        document.querySelectorAll('.size-options span').forEach(s => s.classList.remove('active'));
        sizeElem.classList.add('active');
        document.getElementById('selectedSize').value = sizeValue;
    }
    // QUANTITY
    function setQty(val) {
        var input = document.getElementById('qtyInput');
        var now = parseInt(input.value || 1);
        if (isNaN(now)) now = 1;
        now += val;
        if (now < 1) now = 1;
        input.value = now;
    }
    // TAB
    function showTab(idx) {
        document.querySelectorAll('.tab-nav button').forEach((btn, i) => {
            btn.classList.toggle('active', i === idx);
        });
        document.querySelectorAll('.tab-content').forEach((c, i) => {
            c.classList.toggle('active', i === idx);
        });
    }
</script>

<script>
    // Map size to price
    const sizePriceMap = @json($product->stockProduct->pluck('price', 'size'));

    function setSize(sizeElem, sizeValue) {
        document.querySelectorAll('.size-options span').forEach(s => s.classList.remove('active'));
        sizeElem.classList.add('active');
        document.getElementById('selectedSize').value = sizeValue;

        // Update price
        const price = sizePriceMap[sizeValue] || 0;
        document.getElementById('productPrice').innerText = 'Rp ' + price.toLocaleString('id-ID');
    }
</script>
</body>
@endsection
