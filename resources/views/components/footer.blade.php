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
                                    <li class="ec-footer-link"><a href="#">Prices drop</a></li>
                                    <li class="ec-footer-link"><a href="#">New products</a></li>
                                    <li class="ec-footer-link"><a href="#">Best sales</a></li>
                                    <li class="ec-footer-link"><a href="contact-us.html">Contact us</a></li>
                                    <li class="ec-footer-link"><a href="#">Sitemap</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 ec-footer-account">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Our Company</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="track-order.html">Delivery</a></li>
                                    <li class="ec-footer-link"><a href="privacy-policy.html">Legal Notice</a></li>
                                    <li class="ec-footer-link"><a href="terms-condition.html">Terms and conditions</a></li>
                                    <li class="ec-footer-link"><a href="about-us.html">About us</a></li>
                                    <li class="ec-footer-link"><a href="checkout.html">Secure payment</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 ec-footer-service">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Services</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="#">Prices drop</a></li>
                                    <li class="ec-footer-link"><a href="#">New products</a></li>
                                    <li class="ec-footer-link"><a href="#">Best sales</a></li>
                                    <li class="ec-footer-link"><a href="contact-us.html">Contact us</a></li>
                                    <li class="ec-footer-link"><a href="#">Sitemap</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 ec-footer-cont-social">
                        <div class="ec-footer-contact">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">Contact</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link ec-foo-location"><span><i class="fi fi-rr-marker"></i></span>
                                            <p>2548 Broaddus Maple Court, Madisonville KY 4783, USA</p>
                                        </li>
                                        <li class="ec-footer-link ec-foo-call"><span><i class="fi-rr-phone-call"></i></span><a href="tel:+919999999999">+91 999 999 9999</a>
                                        </li>
                                        <li class="ec-footer-link ec-foo-mail"><span><i class="fi fi-rr-envelope"></i></span><a
                                                href="mailto:support@demo.email">support@demo.email</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ec-footer-social">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading marg-b-0 s-head">Follow Us</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"><a href="#"><i class="ecicon eci-instagram"
                                                                                  aria-hidden="true"></i></a></li>
                                        <li class="ec-footer-link"><a href="#"><i class="ecicon eci-twitter-square"
                                                                                  aria-hidden="true"></i></a></li>
                                        <li class="ec-footer-link"><a href="#"><i class="ecicon eci-facebook-square"
                                                                                  aria-hidden="true"></i></a></li>
                                        <li class="ec-footer-link"><a href="#"><i class="ecicon eci-linkedin-square"
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
                    <div class="footer-bottom-right">
                        <div class="footer-bottom-payment d-flex justify-content-center">
                            <div class="payment-link">
                                <img src="assets/images/icons/payment.png" alt="">
                            </div>

                        </div>
                    </div>
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
