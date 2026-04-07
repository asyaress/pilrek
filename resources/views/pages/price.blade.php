@extends('layouts.app')

@section('title', 'Pricing')

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
    @include('partials.navbar', ['activePage' => ''])


        <div id="smooth-content">

            <!-- banner -->
            <div class="mil-banner mil-banner-inner mil-dissolve">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-8">
                            <div class="mil-banner-text mil-text-center">
                                <div class="mil-text-m mil-mb-20">Pricing</div>
                                <h1 class="mil-mb-60">Transparent, Simple and Adapted to your Needs</h1>
                                <ul class="mil-breadcrumbs mil-pub-info mil-center">
                                    <li><span>Software Engineering</span></li>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('price') }}">Pricing</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner end -->

            <!-- prices-->
            <div class="mil-blog-list mil-p-0-130">
                <div class="container">
                    <div class="row justify-content-center">

                        <div class="mil-switcher mil-mb-60 mil-up">
                            <span class="mil-active" id="month">Monthly</span>
                            <span class="" id="year">Yearly</span>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-6">


                                <div class="mil-price-card mil-up mil-mb-30">
                                    <h6 class="mil-mb-15">Plax Consumer</h6>
                                    <p class="mil-text-s mil-soft mil-mb-30">Sending and receiving money in up to 5 countries</p>
                                    <h4 class="mil-mb-30">$ <span class="mil-pricing-table-price" data-year-price="0.00" data-month-price="0.00">0.00</span><span class="mil-sup-text mil-soft"> / month</span></h4>
                                    <a href="{{ route('kontak') }}" class="mil-btn mil-m mil-fw mil-mb-30">Choose a plan</a>
                                    <ul class="mil-text-mist mil-type-2 mil-check mil-text-s mil-soft mil-mb-60">
                                        <li>Unlimited transactions</li>
                                        <li>Basic Technical Support (Email)</li>
                                        <li>Instructional advisor</li>
                                    </ul>
                                    <a href="javascript:void(0)" class="mil-link mil-accent">View all features</a>
                                </div>

                            </div>

                            <div class="col-md-4 col-sm-6">


                                <div class="mil-price-card mil-featured mil-up mil-mb-30">
                                    <h6 class="mil-light mil-mb-15">Plax Business</h6>
                                    <p class="mil-text-s mil-dark-soft mil-mb-30">Access to multi-currency accounts and local payments</p>
                                    <h4 class="mil-light mil-mb-30">$ <span class="mil-light mil-pricing-table-price" data-year-price="9.99" data-month-price="14.99">14.99</span><span class="mil-sup-text mil-dark-soft"> / month</span></h4>
                                    <a href="{{ route('kontak') }}" class="mil-btn mil-m mil-fw mil-mb-30">Choose a plan</a>
                                    <ul class="mil-text-mist mil-type-2 mil-check mil-text-s mil-dark-soft mil-mb-60">
                                        <li>Unlimited transactions</li>
                                        <li>Basic Technical Support (Email)</li>
                                        <li>Instructional advisor</li>
                                    </ul>
                                    <a href="javascript:void(0)" class="mil-link mil-accent">View all features</a>
                                </div>

                            </div>

                            <div class="col-md-4 col-sm-6">

                                <div class="mil-price-card mil-up mil-mb-30">
                                    <h6 class="mil-mb-15">Plax Enterprise</h6>
                                    <p class="mil-text-s mil-soft mil-mb-30">Secure and reliable transactions at the enterprise level</p>
                                    <h4 class="mil-mb-30">$ <span class="mil-pricing-table-price" data-year-price="34.99" data-month-price="49.00">49.99</span><span class="mil-sup-text mil-soft"> / month</span></h4>
                                    <a href="{{ route('kontak') }}" class="mil-btn mil-m mil-fw mil-mb-30">Choose a plan</a>
                                    <ul class="mil-text-mist mil-type-2 mil-check mil-text-s mil-soft mil-mb-60">
                                        <li>Unlimited transactions</li>
                                        <li>Basic Technical Support (Email)</li>
                                        <li>Instructional advisor</li>
                                    </ul>
                                    <a href="javascript:void(0)" class="mil-link mil-accent">View all features</a>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- prices end -->

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
        @include('partials.footer')

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



