@extends('layouts.main')
@section('body')
    <style>
        .ec-pro-pagination {
            margin: 30px 0 10px;
            display: flex;
            justify-content: center;
        }

        .ec-pro-pagination-inner {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .ec-pro-pagination-inner li {
            margin: 0 5px;
        }

        .ec-pro-pagination-inner li a {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 40px;
            width: 40px;
            font-size: 14px;
            border-radius: 50%;
            color: #777;
            background-color: #f7f7f7;
            text-decoration: none;
            transition: all 0.3s ease 0s;
        }

        .ec-pro-pagination-inner li.active a {
            background-color: #FF8C00;
            color: #fff;
            box-shadow: 0px 0px 10px 0px rgba(52, 116, 212, 0.3);
        }

        .ec-pro-pagination-inner li a:hover {
            background-color: #FF8C00;
            color: #fff;
        }

        .ec-pro-pagination-inner li.disabled a {
            color: #ccc;
            cursor: not-allowed;
        }

        .ec-pro-pagination-inner li.disabled a:hover {
            background-color: #f7f7f7;
            color: #ccc;
        }


    </style>

    <body>

    <!-- START Product Transparent Style -->
    <section class="sec-tp el-prod section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Products</h2>
                        <p class="sub-title">Browse The Collection of Our Products</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <!-- START single card -->
                    <div class="ec-product-tp">
                        <div class="ec-product-image">
                            <a href="{{route('products.detail', ['product' => $product->id])}}">
                                <img src="{{$product->image}}" class="img-center" alt="">
                            </a>
                            <div class="ec-link-icon">
                                <a href="{{route('products.detail', ['product' => $product->id])}}" data-tip="Quick View"><button><i class="fi-rr-eye"></i></button></a>
                                <form action="{{ route('cart.addToCart') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="size" value="60">
                                    <a href="#">
                                    <button type="submit">
                                        <i class="fi-rr-shopping-basket"></i>
                                    </button>
                                    </a>
                                </form>
                            </div>
                        </div>
                        <div class="ec-product-body">
                            <h3 class="ec-title"><a href="{{route('products.detail', ['product' => $product->id])}}">{{$product->name}}</a></h3>
                            <p class="ec-description">
                                {{$product->category->name}}
                            </p>
                            <div class="ec-price">Rp.{{number_format($product->stockProduct->where('size', 60)->first()->price)}}</div>
                            <div class="ec-link-btn">
                                <form action="{{ route('cart.addToCart') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="size" value="60">

                                    <button type="submit"
                                            class="btn ec-add-to-cart"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Add to Cart">Add To Cart
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
            {{$products->links('components.pagination')}}
        </div>
    </section>
    </body>
@endsection
