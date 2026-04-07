@extends('layouts.app')

@section('title', 'Services')

@section('content')
<!-- wrapper -->
    <div id="smooth-wrapper" class="mil-wrapper">

        <!-- preloader -->
        <div class="mil-preloader">
            <div class="mil-load"></div>
            <p class="h2 mil-mb-30"><span class="mil-light mil-counter" data-number="100">100</span><span class="mil-light">%</span></p>
        </div>
        <!-- preloader end -->

        <!-- scroll progress -->
        <div class="mil-progress-track">
            <div class="mil-progress"></div>
        </div>
        <!-- scroll progress end -->

        <!-- back to top -->
        <div class="progress-wrap active-progress"></div>

        <!-- top panel end -->
        <div class="mil-top-panel">
            <div class="container">
                <a href="{{ route('home') }}" class="mil-logo">
                    <img src="{{ asset('template/img/logo.png') }}" alt="Plax" width="83" height="32">
                </a>
                <nav class="mil-top-menu">
                    <ul>
                        <li class="mil-has-children">
                            <a href="javascript:void(0)">Home</a>
                            <ul>
                                <li><a href="{{ route('home') }}">Type 1</a></li>
                                </ul>
                        </li>
                        <li>
                            <a href="{{ route('about') }}">About</a>
                        </li>
                        <li class="mil-active">
                            <a href="{{ route('services') }}">Services</a>
                        </li>
                        <li class="mil-has-children">
                            <a href="javascript:void(0)">Blog</a>
                            <ul>
                                <li><a href="{{ route('blog') }}">Blog list</a></li>
                                <li><a href="{{ route('publication') }}">Blog details</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>
                        <li class="mil-has-children">
                            <a href="javascript:void(0)">Pages</a>
                            <ul>
                                <li><a href="{{ route('career') }}">Career</a></li>
                                <li><a href="{{ route('career.details') }}">Career details</a></li>
                                <li><a href="{{ route('price') }}">Pricing</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                                
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="mil-menu-buttons">
                    <a href="{{ route('register') }}" class="mil-btn mil-sm">Log in</a>
                    <div class="mil-menu-btn">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- top panel end -->

        <!-- content -->
        <div id="smooth-content">

            <!-- banner -->
            <div class="mil-banner mil-banner-inner mil-dissolve">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-8">
                            <div class="mil-banner-text mil-text-center">
                                <div class="mil-text-m mil-mb-20">Services</div>
                                <h1 class="mil-mb-60">Adapted to your needs, discover what we have</h1>
                                <ul class="mil-breadcrumbs mil-center">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('services') }}">Services</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner end -->

            <!-- service -->
            <div class="mil-features mil-p-0-80">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-xl-5 mil-mb-80">
                            <h2 class="mil-mb-30 mil-up">Freedom to send, request money globally</h2>
                            <p class="mil-text-m mil-soft mil-mb-30 mil-up">From sending money to friends and family to receiving payments from around the world, Plax Consumer offers you a simple and instant experience.</p>
                            <div class="mil-up"><a href="{{ route('register') }}" class="mil-btn mil-m mil-add-arrow">Learn more</a></div>
                        </div>
                        <div class="col-xl-6 mil-mb-80">
                            <div class="mil-image-frame mil-up">
                                <img src="{{ asset('template/img/inner-pages/3.png') }}" alt="image" class="mil-scale-img" data-value-1="1" data-value-2="1.2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- service end -->

            <!-- service -->
            <div class="mil-features mil-p-0-80">
                <div class="container">
                    <div class="row flex-sm-row-reverse justify-content-between align-items-center">
                        <div class="col-xl-5 mil-mb-80">
                            <h2 class="mil-mb-30 mil-up">Instant Financial Solutions for Global Businesses</h2>
                            <p class="mil-text-m mil-soft mil-mb-30 mil-up">From instant and secure transactions to the flexibility to adapt to global needs, Plax Enterprise offers a reliable platform to drive your company's financial growth.</p>
                            <div class="mil-up"><a href="{{ route('register') }}" class="mil-btn mil-m mil-add-arrow">Learn more</a></div>
                        </div>
                        <div class="col-xl-6 mil-mb-80">
                            <div class="mil-image-frame ml-up">
                                <img src="{{ asset('template/img/inner-pages/4.png') }}" alt="image" class="mil-scale-img" data-value-1="1" data-value-2="1.2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- service end -->

            <!-- service -->
            <div class="mil-features mil-p-0-80">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-xl-5 mil-mb-80">
                            <h2 class="mil-mb-30 mil-up">Financial Innovation, discover the Plax Virtual Card</h2>
                            <p class="mil-text-m mil-soft mil-mb-30 mil-up">Discover how this innovative tool boosts financial well-being and provides a safe and affordable alternative for financial inclusion in the region.</p>
                            <div class="mil-up"><a href="{{ route('register') }}" class="mil-btn mil-m mil-add-arrow">Learn more</a></div>
                        </div>
                        <div class="col-xl-6 mil-mb-80">
                            <div class="mil-image-frame mil-up">
                                <img src="{{ asset('template/img/inner-pages/5.png') }}" alt="image" class="mil-scale-img" data-value-1="1" data-value-2="1.2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- service end -->

            <!-- call to action -->
            <div class="mil-cta mil-up">
                <div class="container">
                    <div class="mil-out-frame mil-p-160-100">
                        <div class="row justify-content-center mil-text-center">
                            <div class="col-xl-8 mil-mb-80-adaptive-30">
                                <h2 class="mil-up">Innovation and Efficiency in Every Transaction</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 mil-mb-60">
                                <div class="mil-icon-box">
                                    <img src="{{ asset('template/img/inner-pages/icons/4.svg') }}" alt="icon" class="mil-mb-30 mil-up">
                                    <h5 class="mil-mb-20 mil-up">Simplicity in Every Step</h5>
                                    <p class="mil-text-m mil-soft mil-up">Experience the convenience of a simplified payment process, from creating your account</p>
                                </div>
                            </div>
                            <div class="col-xl-4 mil-mb-60">
                                <div class="mil-icon-box">
                                    <img src="{{ asset('template/img/inner-pages/icons/5.svg') }}" alt="icon" class="mil-mb-30 mil-up">
                                    <h5 class="mil-mb-20 mil-up">Guaranteed Advanced Security</h5>
                                    <p class="mil-text-m mil-soft mil-up">We implement cutting-edge security measures to protect your financial information at all times.</p>
                                </div>
                            </div>
                            <div class="col-xl-4 mil-mb-60">
                                <div class="mil-icon-box">
                                    <img src="{{ asset('template/img/inner-pages/icons/6.svg') }}" alt="icon" class="mil-mb-30 mil-up">
                                    <h5 class="mil-mb-20 mil-up">Unparalleled Efficiency</h5>
                                    <p class="mil-text-m mil-soft mil-up">Fast, secure and reliable transactions that reflect our commitment to excellence every step of the way.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- call to action end -->

            <!-- quote -->
            <div class="mil-quote mil-p-160-130">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            <h2 class="mil-mb-30">"At Plax, transparency is not just a promise; It is the cornerstone of our relationship with you. We believe that trust is built with clear policies and coherent actions."</h2>
                            <p class="mil-text-m mil-soft mil-mb-60">- Plax Team</p>
                            <div class="row">
                                <div class="col-xl-6">
                                    <ul class="mil-list-2 mil-type-2 mil-mb-30">
                                        <li>
                                            <div class="mil-up">
                                                <h5 class="mil-mb-15">Privacy policies</h5>
                                                <p class="mil-text-m mil-soft">Your privacy is our priority. We never share your information with third parties without your express consent.</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xl-6">
                                    <ul class="mil-list-2 mil-type-2 mil-mb-30">
                                        <li>
                                            <div class="mil-up">
                                                <h5 class="mil-mb-15">Data protection</h5>
                                                <p class="mil-text-m mil-soft">We are committed to protecting your personal and financial data with the highest security measures</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- quote end -->

            <!-- call to action -->
            <div class="mil-cta mil-up">
                <div class="container">
                    <div class="mil-out-frame mil-p-160-160" style="background-image: url({{ asset('template/img/home-3/5.png') }})">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-xl-7 mil-sm-text-center">
                                <h2 class="mil-light mil-mb-30 mil-up">Discover the freedom <br>of Total Financial Control</h2>
                                <p class="mil-text-m mil-mb-60 mil-dark-soft mil-up">Join Plax and take the first step towards a more <br> balanced and hassle-free financial life.</p>
                                <div class="mil-buttons-frame mil-up">
                                    <a href="javascript:void(0)" class="mil-btn mil-md">App Store</a>
                                    <a href="javascript:void(0)" class="mil-btn mil-border mil-md">Google Play</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- call to action end -->

            <!-- footer -->
            <footer class="mil-p-160-0">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3">
                            <a href="javascript:void(0)" class="mil-footer-logo mil-mb-60">
                                <img src="{{ asset('template/img/logo-2.png') }}" alt="Plax" width="28" height="32">
                            </a>
                        </div>
                        <div class="col-xl-3 mil-mb-60">
                            <h6 class="mil-mb-60">Usefull Links</h6>
                            <ul class="mil-footer-list">
                                <li class="mil-text-m mil-soft mil-mb-15">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="mil-text-m mil-soft mil-mb-15">
                                    <a href="{{ route('about') }}">About Us</a>
                                </li>
                                <li class="mil-text-m mil-soft mil-mb-15">
                                    <a href="{{ route('contact') }}">Contact Us</a>
                                </li>
                                <li class="mil-text-m mil-soft mil-mb-15">
                                    <a href="{{ route('services') }}">Services</a>
                                </li>
                                <li class="mil-text-m mil-soft mil-mb-15">
                                    <a href="{{ route('price') }}">Pricing</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-3 mil-mb-60">
                            <h6 class="mil-mb-60">Help</h6>
                            <ul class="mil-footer-list">
                                <li class="mil-text-m mil-soft mil-mb-15">
                                    999 Rue du Cherche-Midi, 7755500666 Paris, <br>France
                                </li>
                                <li class="mil-text-m mil-soft mil-mb-15">
                                    +001 (808) 555-0111
                                </li>
                                <li class="mil-text-m mil-soft mil-mb-15">
                                    support@plax.network
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-3 mil-mb-80">
                            <h6 class="mil-mb-60">Newsletter</h6>
                            <p class="mil-text-xs mil-soft mil-mb-15">Subscribe to get the latest news form us</p>
                            <form class="mil-subscripe-form-footer">
                                <input class="mil-input" type="email" placeholder="Email">
                                <button type="submit"><i class="far fa-envelope-open mil-dark"></i></button>
                                <div class="mil-checkbox-frame mil-mt-15">
                                    <div class="mil-checkbox">
                                        <input type="checkbox" id="checkbox" checked>
                                        <label for="checkbox"></label>
                                    </div>
                                    <p class="mil-text-xs mil-soft">Subscribe to get the latest news</p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mil-footer-bottom">
                        <div class="row">
                            <div class="col-xl-6">
                                <p class="mil-text-s mil-soft">Â© 2024 Plax Finance & Fintech Design</p>
                            </div>
                            <div class="col-xl-6">
                                <p class="mil-text-s mil-text-right mil-sm-text-left mil-soft">Developed by <a href="https://bslthemes.com" target="_blank">bslthemes</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- footer end -->

        </div>
        <!-- content end -->
    </div>
    <!-- wrapper end -->

    <!-- jquery js -->
    <script src="js/plugins/jquery.min.js"></script>

    <!-- swiper css -->
    <script src="js/plugins/swiper.min.js"></script>
    <!-- gsap js -->
    <script src="js/plugins/gsap.min.js"></script>
    <!-- scroll smoother -->
    <script src="js/plugins/ScrollSmoother.min.js"></script>
    <!-- scroll trigger js -->
    <script src="js/plugins/ScrollTrigger.min.js"></script>
    <!-- scroll to js -->
    <script src="js/plugins/ScrollTo.min.js"></script>
    <!-- magnific -->
    <script src="js/plugins/magnific-popup.js"></script>
    <!-- plax js -->
    <script src="js/main.js"></script>
@endsection
