<footer class="ec-footer">
    <div class="footer-container">
        <div class="footer-top section-space-footer-p">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-3 ec-footer-cat">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Popular Categories</h4>
                            <div class="ec-footer-links">
                            <ul class="align-items-center">
                                @foreach($totalProductByCategory as $value)
                                    <li class="ec-footer-link"><a href="{{ route('products.search', ['slug' => $value['name']]) }}">{{$value['name']}}</a></li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 ec-footer-info">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Products</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    @foreach($categories as $value)
                                    <li class="ec-footer-link"><a href="{{ route('products.search', ['slug' => $value->name]) }}">{{$value->name}}</a></li>
                                    @endforeach
{{--                                    <li class="ec-footer-link"><a href="#">New products</a></li>--}}
{{--                                    <li class="ec-footer-link"><a href="#">Best sales</a></li>--}}
{{--                                    <li class="ec-footer-link"><a href="contact-us.html">Contact us</a></li>--}}
{{--                                    <li class="ec-footer-link"><a href="#">Sitemap</a></li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
{{--                    <div class="col-sm-12 col-lg-3 ec-footer-account">--}}
{{--                        <div class="ec-footer-widget">--}}
{{--                            <h4 class="ec-footer-heading">Our Company</h4>--}}
{{--                            <div class="ec-footer-links">--}}
{{--                                <ul class="align-items-center">--}}
{{--                                    <li class="ec-footer-link"><a href="track-order.html">Delivery</a></li>--}}
{{--                                    <li class="ec-footer-link"><a href="privacy-policy.html">Legal Notice</a></li>--}}
{{--                                    <li class="ec-footer-link"><a href="terms-condition.html">Terms and conditions</a></li>--}}
{{--                                    <li class="ec-footer-link"><a href="about-us.html">About us</a></li>--}}
{{--                                    <li class="ec-footer-link"><a href="checkout.html">Secure payment</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-12 col-lg-3 ec-footer-service">--}}
{{--                        <div class="ec-footer-widget">--}}
{{--                            <h4 class="ec-footer-heading">Services</h4>--}}
{{--                            <div class="ec-footer-links">--}}
{{--                                <ul class="align-items-center">--}}
{{--                                    <li class="ec-footer-link"><a href="#">Prices drop</a></li>--}}
{{--                                    <li class="ec-footer-link"><a href="#">New products</a></li>--}}
{{--                                    <li class="ec-footer-link"><a href="#">Best sales</a></li>--}}
{{--                                    <li class="ec-footer-link"><a href="contact-us.html">Contact us</a></li>--}}
{{--                                    <li class="ec-footer-link"><a href="#">Sitemap</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-sm-12 col-lg-3 ec-footer-cont-social">
                        <div class="ec-footer-contact">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">Contact</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link ec-foo-location"><span><i class="fi fi-rr-marker"></i></span>
                                            <p>Gg. Karya, Rengas Pulau, Kec. Medan Marelan, Kota Medan, Sumatera Utara 20252</p>
                                        </li>
                                        <li class="ec-footer-link ec-foo-call"><span><i class="fi-rr-phone-call"></i></span><a href="tel:+6281376097740">+62 813 7609 7740</a>
                                        </li>
                                        <li class="ec-footer-link ec-foo-mail"><span><i class="fi fi-rr-envelope"></i></span><a
                                                href="mailto:niswahjamu@gmail.com">niswahjamu@gmail.com</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ec-footer-social">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading marg-b-0 s-head">Follow Us</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"><a href="instagram.com/dapoer_niswah"><i class="ecicon eci-instagram"
                                                                                  aria-hidden="true"></i></a></li>
                                        <li class="ec-footer-link"><a href="https://www.facebook.com/profile.php?id=100027949369440"><i class="ecicon eci-facebook-square"
                                                                                  aria-hidden="true"></i></a></li>
                                        <li class="ec-footer-link"><a href="https://wa.me/6281376097740"><i class="ecicon eci-whatsapp"
                                                                                  aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <!-- Footer payment -->
{{--                    <div class="footer-bottom-right">--}}
{{--                        <div class="footer-bottom-payment d-flex justify-content-center">--}}
{{--                            <div class="payment-link">--}}
{{--                                <img src="assets/images/icons/payment.png" alt="">--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
                    <!-- Footer payment -->
                    <!-- Footer Copyright Start -->
                    <div class="footer-copy">
                        <div class="footer-bottom-copy ">
                            <div class="ec-copy">Copyright © <span id="copyright_year"></span> <a class="site-name" href="{{route('home')}}">Jamu Niswah</a></div>
                        </div>
                    </div>
                    <!-- Footer Copyright End -->

                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->
