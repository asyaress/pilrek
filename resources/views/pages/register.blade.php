@extends('layouts.app')

@section('title', 'Register')

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
                                <div class="mil-text-m mil-mb-20">Register</div>
                                <h1 class="mil-mb-60">Register with Plax:</h1>
                                <ul class="mil-breadcrumbs mil-center">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner end -->

            <!-- register form -->
            <div class="mil-blog-list mip-p-0-160">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-5">
                            <form>

                                <input class="mil-input mil-up mil-mb-15" type="text" placeholder="Full name">

                                <input class="mil-input mil-up mil-mb-15" type="email" placeholder="Your e-mail">

                                <input class="mil-input mil-up mil-mb-15" type="password" placeholder="Password">

                                <input class="mil-input mil-up mil-mb-30" type="password" placeholder="Confirm Password">

                                <div class="mil-up mil-mb-30">
                                    <button type="submit" class="mil-btn mil-md mil-fw">Create Account</button>
                                </div>
                                <p class="mil-text-xs mil-text-center mil-soft mil-mb-30">Or Register with:</p>
                                <div class="mil-up mil-mb-15">
                                    <a href="javascript:void(0)" class="mil-btn mil-md mil-grey mil-fw mil-mb-30">Sign up with Google</a>
                                </div>
                                <p class="mil-text-xs mil-soft">By registering, you agree to our <a href="javascript:void(0)" class="mil-accent">Terms and Conditions</a>. Your information is protected and will never be shared with third parties</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- register form end -->
            
            <div class="mil-space-fix"></div>

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


