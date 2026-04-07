@extends('layouts.app')

@section('title', 'Career Details')

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
                        <li>
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
                        <li class="mil-has-children mil-active">
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
                                <div class="mil-text-m mil-mb-20">Job Information</div>
                                <h1 class="mil-mb-60">Frontend Software Engineer</h1>
                                <ul class="mil-breadcrumbs mil-pub-info mil-center">
                                    <li><span>Software Engineering</span></li>
                                    <li><a href="{{ route('about') }}">Office work</a></li>
                                    <li><a href="{{ route('about') }}">Paris, France</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner end -->

            <!-- vacancie -->
            <div class="mil-blog-list mil-p-0-160">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9">
                            <h4 class="mil-mb-30 mil-up">Description:</h4>
                            <p class="mil-text-m mil-soft mil-mb-60 mil-up">As a Frontend Software Engineer at Plax, you will be responsible for designing, developing and implementing attractive and effective user interfaces. You will work closely with backend designers and developers to ensure a smooth and enjoyable user experience.</p>
                            <h4 class="mil-mb-30 mil-up">Your homework:</h4>
                            <ul class="mil-text-mist mil-text-m mil-soft mil-mb-60">
                                <li class="mil-up">Develop interactive and responsive user interfaces.</li>
                                <li class="mil-up">Collaborate with designers to translate designs to code.</li>
                                <li class="mil-up">Optimize applications to ensure fast and efficient performance.</li>
                                <li class="mil-up">Collaborate with the backend team to integrate functionalities.</li>
                                <li class="mil-up">Collaborate with the backend team to integrate functionalities.</li>
                            </ul>
                            <h4 class="mil-mb-30 mil-up">Requirements:</h4>
                            <ul class="mil-text-mist mil-check mil-text-m mil-soft mil-mb-60">
                                <li class="mil-up">Proven experience in frontend software development.</li>
                                <li class="mil-up">Solid knowledge of HTML, CSS and JavaScript.</li>
                                <li class="mil-up">Experience in frontend frameworks such as React or Angular.</li>
                                <li class="mil-up">Ability to work in a collaborative and agile environment.</li>
                                <li class="mil-up">Passion for creating exceptional user experiences.</li>
                            </ul>
                            <h4 class="mil-mb-30 mil-up">Profile:</h4>
                            <p class="mil-text-m mil-soft mil-up mil-mb-60">We are looking for an engineer passionate about frontend technology, with skills to transform creative designs into captivating user experiences. If you are passionate about innovation, collaboration and creating quality products, we want to meet you!</p>
                            <div class="mil-up">
                                <a href="{{ route('contact') }}" class="mil-btn mil-m mil-add-arrow mil-add-arrow">Apply for this position</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- vacancie end -->

            <!-- footer -->
            <footer class="mil-footer-with-bg mil-p-160-0">
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
