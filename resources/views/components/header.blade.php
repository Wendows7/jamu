<!-- Header start  -->
<header class="ec-header">

    <!-- Ec Header Bottom  Start -->
    <div class="ec-header-bottom d-none d-lg-block">
        <div class="container position-relative">
            <div class="row">
                <div class="ec-flex">
                    <!-- Ec Header Logo Start -->
                    <div class="align-self-center ec-header-logo">
                        <div class="header-logo">
                            <a href="index.html"><img src="{{asset('img/logo.png')}}" alt="Site Logo" /><img
                                    class="dark-logo" src="{{asset('assets/images/logo/dark-logo-6.png')}}" alt="Site Logo"
                                    style="display: none;" /></a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->

                    <!-- Ec Header Search Start -->
                    <div class="align-self-center ec-header-search">
                        <div class="header-search">
                            <form class="ec-search-group-form" action="{{ route('products.search') }}" method="get">
                                <input class="form-control" placeholder="Search Your Products..." type="text" name="slug">
                                <button class="search_submit" type="submit"><i class="fi-rr-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- Ec Header Search End -->

                    <!-- Ec Header Button Start -->
                    <div class="align-self-center">
                        <div class="ec-header-bottons">
                            <!-- Header User Start -->
                            <a href="login.html" class="ec-header-btn ec-header-user">
                                <div class="header-icon"><i class="fi-rr-user"></i></div>
                                <div class="ec-btn-desc">
                                    <span class="ec-btn-title">Account</span>
                                    <span class="ec-btn-stitle">Login</span>
                                </div>
                            </a>
                            <!-- Header User End -->

                            <!-- Header Cart Start -->
                            <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                                <div class="header-icon"><i class="fi-rr-shopping-basket"></i></div>
                                <div class="ec-btn-desc">
                                    <span class="ec-btn-title">Cart</span>
                                    @if(session('cart'))
                                        <span class="ec-btn-stitle"><b class="ec-cart-count">{{count(session('cart'))}}</b>-items</span>
                                    @else
                                        <span class="ec-btn-stitle"><b class="ec-cart-count">0</b>-items</span>
                                    @endif
                                </div>
                            </a>
                            <!-- Header Cart End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ekka Menu Start -->
    <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
        <div class="ec-menu-title">
            <span class="menu_title">My Menu</span>
            <button class="ec-close">×</button>
        </div>
        <div class="ec-menu-inner">
            <div class="ec-menu-content">
                <ul>
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('products')}}">Products</a></li>
                    <li><a href="{{route('products')}}">Contact</a></li>
                    <li><a href="{{route('products')}}">About</a></li>
                </ul>
            </div>
            <div class="header-res-lan-curr">
                <!-- Social Start -->
                <div class="header-res-social">
                    <div class="header-top-social">
                        <ul class="mb-0">
                            <li class="list-inline-item"><a href="#"><i class="ecicon eci-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ecicon eci-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ecicon eci-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ecicon eci-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- Social End -->
            </div>
        </div>
    </div>
    <!-- Ekka Menu End -->
    <!-- Ec Header Button End -->
    <div class="ec-header-cat d-none d-lg-block">
        <div class="container position-relative">
            <div class="row ">
                <!-- EC Main Menu Start -->
                <div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
                    <div class="position-relative nav-desk">
                        <div class="row">
                            <div class="col-md-10 align-self-center">
                                <div class="ec-main-menu">
                                    <ul>
                                        <li class="non-drop">
                                            <a href="{{route('home')}}">Home</a>
                                        </li>
                                        <li class="non-drop">
                                            <a href="{{route('products')}}" class="dropdown-arrow">Products</a>
                                        </li>
                                        <li class="non-drop">
                                            <a href="javascript:void(0)" class="dropdown-arrow">Contact</a>
                                        </li>
                                        <li class="non-drop">
                                            <a href="javascript:void(0)" class="dropdown-arrow">About</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Ec Main Menu End -->
            </div>
        </div>
    </div>
    <!-- Header responsive Bottom  Start -->
    <div class="ec-header-bottom d-lg-none">
        <div class="container position-relative">
            <div class="row ">
                <div class="ec-flex">
                    <!-- Ec Header Logo Start -->
                    <div class="col ec-header-logo">
                        <div class="header-logo">
                            <a href="index.html"><img src="assets/images/logo/logo-6.png" alt="Site Logo" /><img class="dark-logo" src="assets/images/logo/dark-logo-6.png" alt="Site Logo" style="display: none;" /></a>
                        </div>
                    </div>
                </div>
                <!-- Ec Header Search Start -->
                <div class="col align-self-center ec-header-search">
                    <div class="header-search">
                        <form class="ec-search-group-form" action="#">
                            <input class="form-control" placeholder="Search Your Products..." type="text">
                            <button class="search_submit" type="submit"><i class="fi-rr-search"></i></button>
                        </form>
                    </div>
                </div>
                <!-- Ec Header Search End -->

            </div>
        </div>
    </div>
    <!-- Header responsive Bottom  End -->
</header>
