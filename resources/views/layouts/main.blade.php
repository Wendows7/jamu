<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Jamu</title>
    <meta name="keywords" content="apparel, catalog, clean, ecommerce, ecommerce HTML, electronics, fashion, html eCommerce, html store, minimal, multipurpose, multipurpose ecommerce, online store, responsive ecommerce template, shops" />
    <meta name="description" content="Best ecommerce html template for single and multi vendor store.">
    <meta name="author" content="ashishmaraviya">

    <!-- site Favicon -->
    <link rel="icon" href="{{asset('assets/images/favicon/favicon-6.png')}}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{asset('assets/images/favicon/favicon-6.png')}}" />
    <meta name="msapplication-TileImage" content="{{asset('assets/images/favicon/favicon-6.png')}}" />

    <!-- css Icon Font -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/ecicons.min.css')}}" />

    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/plugins/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/plugins/jquery-ui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/plugins/countdownTimer.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/plugins/slick.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/plugins/bootstrap.css')}}" />

    <!-- Main Style -->
    <link rel="stylesheet" href="{{asset('assets/css/demo6.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}" />



</head>

<!-- Add to Cart successfully toast Start -->
<div id="addtocart_toast" class="addtocart_toast">
    <div class="desc">You Have Add To Cart Successfully</div>
</div>
<!-- Add to Cart successfully toast end -->
<!-- Header End  -->
@include('sweetalert::alert')
@include('components.header')
@include('components.cart')
@yield('body')
@include('components.footer')
<!-- Footer Start -->


<!-- Modal -->
{{--<div class="modal fade" id="ec_quickview_modal" tabindex="-1" role="dialog">--}}
{{--    <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--            <div class="modal-body">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-5 col-sm-12 col-xs-12">--}}
{{--                        <!-- Swiper -->--}}
{{--                        <div class="qty-product-cover">--}}
{{--                            <div class="qty-slide">--}}
{{--                                <img class="img-responsive" src="assets/images/product-image/52_1.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="qty-slide">--}}
{{--                                <img class="img-responsive" src="assets/images/product-image/52_2.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="qty-slide">--}}
{{--                                <img class="img-responsive" src="assets/images/product-image/54_1.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="qty-slide">--}}
{{--                                <img class="img-responsive" src="assets/images/product-image/54_2.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="qty-slide">--}}
{{--                                <img class="img-responsive" src="assets/images/product-image/55_2.jpg" alt="">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="qty-nav-thumb">--}}
{{--                            <div class="qty-slide">--}}
{{--                                <img class="img-responsive" src="assets/images/product-image/52_1.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="qty-slide">--}}
{{--                                <img class="img-responsive" src="assets/images/product-image/52_2.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="qty-slide">--}}
{{--                                <img class="img-responsive" src="assets/images/product-image/54_1.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="qty-slide">--}}
{{--                                <img class="img-responsive" src="assets/images/product-image/54_2.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="qty-slide">--}}
{{--                                <img class="img-responsive" src="assets/images/product-image/55_2.jpg" alt="">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-7 col-sm-12 col-xs-12">--}}
{{--                        <div class="quickview-pro-content">--}}
{{--                            <h5 class="ec-quick-title"><a href="product-left-sidebar.html">premium quality organic trail mix dried fruit</a></h5>--}}
{{--                            <div class="ec-quickview-rating">--}}
{{--                                <i class="ecicon eci-star fill"></i>--}}
{{--                                <i class="ecicon eci-star fill"></i>--}}
{{--                                <i class="ecicon eci-star fill"></i>--}}
{{--                                <i class="ecicon eci-star fill"></i>--}}
{{--                                <i class="ecicon eci-star"></i>--}}
{{--                            </div>--}}

{{--                            <div class="ec-quickview-desc">Lorem Ipsum is simply dummy text of the printing and--}}
{{--                                typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever--}}
{{--                                since the 1500s,</div>--}}
{{--                            <div class="ec-quickview-price">--}}
{{--                                <span class="new-price">$199.00</span>--}}
{{--                                <span class="old-price">$200.00</span>--}}
{{--                            </div>--}}

{{--                            <div class="ec-pro-variation">--}}
{{--                                <div class="ec-pro-variation-inner ec-pro-variation-size">--}}
{{--                                    <span>Size</span>--}}
{{--                                    <div class="ec-pro-variation-content">--}}
{{--                                        <ul>--}}
{{--                                            <li><span>250 g</span></li>--}}
{{--                                            <li><span>500 g</span></li>--}}
{{--                                            <li><span>1 kg</span></li>--}}
{{--                                            <li><span>2 kg</span></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="ec-quickview-qty">--}}
{{--                                <div class="qty-plus-minus">--}}
{{--                                    <input class="qty-input" type="text" name="ec_qtybtn" value="1" />--}}
{{--                                </div>--}}
{{--                                <div class="ec-quickview-cart ">--}}
{{--                                    <button class="btn btn-primary">Add To Cart</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Modal end -->

<!-- Click To Call -->
{{--<div class="ec-cc-style cc-right-bottom">--}}
{{--    <!-- Start Floating Panel Container -->--}}
{{--    <div class="cc-panel">--}}
{{--        <!-- Panel Content -->--}}
{{--        <div class="cc-header">--}}
{{--            <img src="assets/images/whatsapp/profile_01.jpg" alt="profile image"/>--}}
{{--            <h2>John Mark</h2>--}}
{{--            <p>Tachnical Manager</p>--}}
{{--        </div>--}}
{{--        <div class="cc-body">--}}
{{--            <p><b>Hey there &#128515;</b></p>--}}
{{--            <p>Need help ? just give me a call.</p>--}}
{{--        </div>--}}
{{--        <div class="cc-footer">--}}
{{--            <a href="tel:+919099153528" class="cc-call-button">--}}
{{--                <span>Call me</span>--}}
{{--                <svg width="13px" height="10px" viewBox="0 0 13 10">--}}
{{--                    <path d="M1,5 L11,5"></path>--}}
{{--                    <polyline points="8 1 12 5 8 9"></polyline>--}}
{{--                </svg>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!--/ End Floating Panel Container -->--}}

{{--    <!-- Start Right Floating Button-->--}}
{{--    <div class="cc-button cc-right-bottom">--}}
{{--        <i class="fi-rr-phone-call"></i>--}}
{{--    </div>--}}
{{--    <!--/ End Right Floating Button-->--}}

{{--</div>--}}
{{--<!-- Click To Call end -->--}}

<!-- Footer navigation panel for responsive display -->
<div class="ec-nav-toolbar">
    <div class="container">
        <div class="ec-nav-panel">
            <div class="ec-nav-panel-icons">
                <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><i class="fi fi-rr-menu-burger"></i></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle"><i class="fi-rr-shopping-basket"></i>
                    @if(session('cart'))
                    <span class="ec-cart-noti ec-header-count cart-count-lable">{{count(session('cart'))}}</span>
                    @endif
            </a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="{{route('home')}}" class="ec-header-btn"><i class="fi-rr-home"></i></a>
            </div>
            <div class="ec-nav-panel-icons">
                <a href="login.html" class="ec-header-btn"><i class="fi-rr-user"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Footer navigation panel for responsive display end -->



<!-- Vendor JS -->
<script src="{{asset('assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/popper.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/modernizr-3.11.2.min.js')}}"></script>

<!--Plugins JS-->
<script src="{{asset('assets/js/plugins/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/countdownTimer.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/scrollup.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.zoom.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/slick.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/infiniteslidev2.js')}}"></script>
<script src="{{asset('assets/js/plugins/click-to-call.js')}}"></script>

<!-- Main Js -->
<script src="{{asset('assets/js/vendor/index.js')}}"></script>
<script src="{{asset('assets/js/demo-6.js')}}"></script>

<script src="{{asset('assets/js/vendor/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.sticky-sidebar.js')}}"></script>

<!-- Vendor JS -->
<script src="{{ asset('assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>

<!--Plugins JS-->
<script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/countdownTimer.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/scrollup.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/infiniteslidev2.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>

<!-- Main Js -->
<script src="{{ asset('assets/js/vendor/index.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>


</html>
