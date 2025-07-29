@extends('layouts.main')
@section('body')
{{--    <style>--}}
{{--        /* Main slider consistent image size fix */--}}
{{--        .ec-main-slider .ec-slider {--}}
{{--            border-radius: 30px;--}}
{{--            height: 750px; /* Set a consistent height */--}}
{{--            overflow: hidden;--}}
{{--        }--}}

{{--        .ec-main-slider .swiper-wrapper {--}}
{{--            height: 100%;--}}
{{--        }--}}

{{--        .ec-slide-item {--}}
{{--            height: 100%;--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            justify-content: center;--}}
{{--        }--}}

{{--        .ec-slide-item .container {--}}
{{--            position: relative;--}}
{{--            z-index: 2;--}}
{{--        }--}}

{{--        /* Style for all slide backgrounds */--}}
{{--        .slide-1, .slide-2, .slide-3, .slide-4 {--}}
{{--            background-size: cover;--}}
{{--            background-position: center;--}}
{{--            width: 100%;--}}
{{--            height: 100%;--}}
{{--        }--}}

{{--        /* Image inside slides (if you're using <img> tags) */--}}
{{--        .ec-slide-item img {--}}
{{--            width: 100%;--}}
{{--            height: 100%;--}}
{{--            object-fit: cover; /* Prevents image distortion */--}}
{{--            object-position: center;--}}
{{--        }--}}

{{--        /* Responsive adjustments */--}}
{{--        @media (max-width: 767px) {--}}
{{--            .ec-main-slider .ec-slider {--}}
{{--                height: 300px; /* Smaller height on mobile */--}}
{{--            }--}}
{{--        }--}}
{{--    </style>--}}
    <body>
    <!-- Main Slider Start -->
    <div class="ec-main-slider section section-space-p-30">
        <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
            <!-- Main slider -->
            <div class="swiper-wrapper">
                <div class="ec-slide-item swiper-slide d-flex slide-1">
                    <div class="container align-self-center">
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-12 align-self-center">--}}
{{--                                <div class="ec-slide-content slider-animation">--}}
{{--                                    <h2 class="ec-slide-stitle">fresh & healthy</h2>--}}
{{--                                    <h1 class="ec-slide-title">Organic Fruits</h1>--}}
{{--                                    <div class="ec-slide-desc">--}}
{{--                                        <p>starting at $ <b>29</b>.99</p>--}}
{{--                                        <a href="#" class="btn btn-lg btn-primary">Shop Now <i--}}
{{--                                                class="ecicon eci-angle-double-right" aria-hidden="true"></i></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="ec-slide-item swiper-slide d-flex slide-2">
                    <div class="container align-self-center">
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-12 align-self-center">--}}
{{--                                <div class="ec-slide-content slider-animation">--}}
{{--                                    <h2 class="ec-slide-stitle">Organic & healthy</h2>--}}
{{--                                    <h1 class="ec-slide-title">fresh vegetables</h1>--}}
{{--                                    <div class="ec-slide-desc">--}}
{{--                                        <p>starting at $ <b>20</b>.00</p>--}}
{{--                                        <a href="#" class="btn btn-lg btn-primary">Shop Now <i--}}
{{--                                                class="ecicon eci-angle-double-right" aria-hidden="true"></i></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="ec-slide-item swiper-slide d-flex slide-3">
                    <div class="container align-self-center">
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-12 align-self-center">--}}
{{--                                <div class="ec-slide-content slider-animation">--}}
{{--                                    <h2 class="ec-slide-stitle">Organic & healthy</h2>--}}
{{--                                    <h1 class="ec-slide-title">fresh vegetables</h1>--}}
{{--                                    <div class="ec-slide-desc">--}}
{{--                                        <p>starting at $ <b>20</b>.00</p>--}}
{{--                                        <a href="#" class="btn btn-lg btn-primary">Shop Now <i--}}
{{--                                                class="ecicon eci-angle-double-right" aria-hidden="true"></i></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="ec-slide-item swiper-slide d-flex slide-4">
                    <div class="container align-self-center">
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-12 align-self-center">--}}
{{--                                <div class="ec-slide-content slider-animation">--}}
{{--                                    <h2 class="ec-slide-stitle">Organic & healthy</h2>--}}
{{--                                    <h1 class="ec-slide-title">fresh vegetables</h1>--}}
{{--                                    <div class="ec-slide-desc">--}}
{{--                                        <p>starting at $ <b>20</b>.00</p>--}}
{{--                                        <a href="#" class="btn btn-lg btn-primary">Shop Now <i--}}
{{--                                                class="ecicon eci-angle-double-right" aria-hidden="true"></i></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="swiper-pagination swiper-pagination-white"></div>
            <div class="swiper-buttons">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <!-- Main Slider End -->

    <!--  category Section Start -->
{{--    <section class="section ec-category-section section-space-pb">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row d-none">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="section-title">--}}
{{--                        <h2 class="ec-title">Top Category</h2>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row margin-minus-b-15 margin-minus-t-15">--}}
{{--                <div id="ec-cat-slider">--}}
{{--                    <div class="ec_cat_content ec_cat_content_1 col-sm-12 col-md-6 col-lg-3">--}}
{{--                        <div class="ec_cat_inner ec_cat_inner-1">--}}
{{--                            <div class="ec-category-image">--}}
{{--                                <img src="assets/images/icons/drink-6.png" class="svg_img" alt="drink" />--}}
{{--                            </div>--}}
{{--                            <div class="ec-category-desc">--}}
{{--                                <h3>juice & drinks</h3>--}}
{{--                                <ul>--}}
{{--                                    <li><a href="#">Energy Drink</a></li>--}}
{{--                                    <li><a href="#">Ice Tea</a></li>--}}
{{--                                    <li><a href="#">Milk Shake</a></li>--}}
{{--                                    <li><a href="#">Soft Drink</a></li>--}}
{{--                                </ul>--}}
{{--                                <a href="shop-left-sidebar-col-3.html" class="cat-show-all">Show All <i class="ecicon eci-angle-double-right"--}}
{{--                                                                                                        aria-hidden="true"></i></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="ec_cat_content ec_cat_content_2 col-sm-12 col-md-6 col-lg-3">--}}
{{--                        <div class="ec_cat_inner ec_cat_inner-2">--}}
{{--                            <div class="ec-category-image">--}}
{{--                                <img src="assets/images/icons/fruit-6.png" class="svg_img" alt="drink" />--}}
{{--                            </div>--}}
{{--                            <div class="ec-category-desc">--}}
{{--                                <h3>Fresh Fruits</h3>--}}
{{--                                <ul>--}}
{{--                                    <li><a href="#">Graps</a></li>--}}
{{--                                    <li><a href="#">Apple</a></li>--}}
{{--                                    <li><a href="#">Cherry</a></li>--}}
{{--                                    <li><a href="#">Mango</a></li>--}}
{{--                                </ul>--}}
{{--                                <a href="shop-left-sidebar-col-3.html" class="cat-show-all">Show All <i class="ecicon eci-angle-double-right"--}}
{{--                                                                                                        aria-hidden="true"></i></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="ec_cat_content ec_cat_content_3 col-sm-12 col-md-6 col-lg-3">--}}
{{--                        <div class="ec_cat_inner ec_cat_inner-3">--}}
{{--                            <div class="ec-category-image">--}}
{{--                                <img src="assets/images/icons/pack-6.png" class="svg_img" alt="drink" />--}}
{{--                            </div>--}}
{{--                            <div class="ec-category-desc">--}}
{{--                                <h3>Snack & Spice</h3>--}}
{{--                                <ul>--}}
{{--                                    <li><a href="#">Cheerios</a></li>--}}
{{--                                    <li><a href="#">potato chips</a></li>--}}
{{--                                    <li><a href="#">french fries</a></li>--}}
{{--                                    <li><a href="#">cookies</a></li>--}}
{{--                                </ul>--}}
{{--                                <a href="shop-left-sidebar-col-3.html" class="cat-show-all">Show All <i class="ecicon eci-angle-double-right" aria-hidden="true"></i></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!--category Section End -->

    <!--  offer Section Start -->
{{--    <section class="section ec-offer-secti section-space-m">--}}
{{--        <h2 class="d-none">Offer</h2>--}}
{{--        <div class="container">--}}
{{--            <div class="row ec-pos ec-ofr-bnr" data-animation="fadeIn">--}}
{{--                <!-- <img src="assets/images/offer-image/offer_bg.jpg" alt="" class="offer_bg" /> -->--}}
{{--                <div class="ec-offer-inner">--}}
{{--                    <div class="col-xl-5 col-md-6 col-sm-6 align-self-center ec-offer-content">--}}
{{--                        <h3 class="ec-offer-stitle">Start Today !</h3>--}}
{{--                        <h2 class="ec-offer-title">Fresh Vegetables & Fruits</h2>--}}
{{--                        <span class="ec-offer-desc">Make your first order to get free home delivery!!!</span>--}}
{{--                        <span class="ec-offer-btn"><a href="#" class="btn btn-lg btn-primary">Shop Now <i--}}
{{--                                    class="ecicon eci-angle-double-right" aria-hidden="true"></i></a></span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- offer Section End -->

    <!-- Product tab Area Start -->
    <section class="section ec-product-tab section-space-p">
        <div class="container" data-animation="fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 class="ec-title">New Products</h2>
                    </div>
                </div>
            </div>
            <div class="row margin-minus-b-15">
                <div class="col">
                    <div class="tab-content">
                        <!-- 1st Product tab start -->
                        <div class="tab-pane fade show active" id="all">
                            <div class="row">
                                @foreach($products as $product)
                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-5 ec-product-content">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="{{route('products.detail', ['product' => $product->id])}}" class="image">
                                                        <span class="label veg">
                                                            <span class="dot"></span>
                                                        </span>
                                                    <img class="main-image"
                                                         src="{{asset($product->image)}}" alt="Product" />
                                                </a>
                                                <div class="ec-pro-actions">
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
                                        </div>
                                        <div class="ec-pro-content">
                                            <a href="{{route('products.detail', ['product' => $product->id])}}"><h6 class="ec-pro-stitle">{{$product->name}}</h6></a>
                                            <h5 class="ec-pro-title"><a href="{{route('products.detail', ['product' => $product->id])}}">{{$product->category->name}}</a></h5>
                                            <div class="ec-pro-rat-price">
                                                <span class="ec-price">
                                                        <span class="new-price">Rp. {{number_format($product->stockProduct->first()->price)}}</span>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        <!-- ec 1st Product tab end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ec Product tab Area End -->


    <!-- Ec Instagram Start -->
{{--    <section class="section ec-instagram-section section-space-pt">--}}
{{--        <h2 class="d-none">Instagram</h2>--}}
{{--        <div class="ec-insta-wrapper" data-animation="fadeIn">--}}
{{--            <div class="ec-insta-outer">--}}
{{--                <div class="insta-auto">--}}
{{--                    <!-- instagram item -->--}}
{{--                    <div class="ec-insta-item">--}}
{{--                        <div class="ec-insta-inner">--}}
{{--                            <a href="#" target="_blank"><img src="assets/images/product-image/79_1.jpg" alt="">--}}

{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- instagram item -->--}}
{{--                    <div class="ec-insta-item">--}}
{{--                        <div class="ec-insta-inner">--}}
{{--                            <a href="#" target="_blank"><img src="assets/images/product-image/80_1.jpg" alt="">--}}

{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- instagram item -->--}}
{{--                    <div class="ec-insta-item">--}}
{{--                        <div class="ec-insta-inner">--}}
{{--                            <a href="#" target="_blank"><img src="assets/images/product-image/81_1.jpg" alt="">--}}

{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- instagram item -->--}}
{{--                    <div class="ec-insta-item">--}}
{{--                        <div class="ec-insta-inner">--}}
{{--                            <a href="#" target="_blank"><img src="assets/images/product-image/82_1.jpg" alt="">--}}

{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- instagram item -->--}}
{{--                    <!-- instagram item -->--}}
{{--                    <div class="ec-insta-item">--}}
{{--                        <div class="ec-insta-inner">--}}
{{--                            <a href="#" target="_blank"><img src="assets/images/product-image/83_1.jpg" alt="">--}}

{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- instagram item -->--}}
{{--                    <div class="ec-insta-item">--}}
{{--                        <div class="ec-insta-inner">--}}
{{--                            <a href="#" target="_blank"><img src="assets/images/product-image/84_1.jpg" alt="">--}}

{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- instagram item -->--}}
{{--                    <div class="ec-insta-item">--}}
{{--                        <div class="ec-insta-inner">--}}
{{--                            <a href="#" target="_blank"><img src="assets/images/product-image/85_1.jpg" alt="">--}}

{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- instagram item -->--}}
{{--                    <div class="ec-insta-item">--}}
{{--                        <div class="ec-insta-inner">--}}
{{--                            <a href="#" target="_blank"><img src="assets/images/product-image/86_1.jpg" alt="">--}}

{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- instagram item -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    </body>
<!-- Ec Instagram End -->

@endsection
