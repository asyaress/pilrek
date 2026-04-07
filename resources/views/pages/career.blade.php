@extends('layouts.app')

@section('title', 'Career')

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
                                <div class="mil-text-m mil-mb-20">Careers</div>
                                <h1 class="mil-mb-60">Where your Talent Finds a Home</h1>
                                <ul class="mil-breadcrumbs mil-center">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('services') }}">Career</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner end -->

            <!-- about -->
            <div class="mil-features mil-p-0-80">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-xl-5 mil-mb-80">
                            <h2 class="mil-mb-30 mil-up">Be part of our Team of Experts</h2>
                            <p class="mil-text-m mil-soft mil-mb-60 mil-up">Explore exciting opportunities and discover how your career can flourish at Plax.</p>
                            <ul class="mil-list-2">
                                <li>
                                    <div class="mil-up">
                                        <h5 class="mil-mb-15">Innovation Culture</h5>
                                        <p class="mil-text-m mil-soft">At Plax, we foster an environment of constant innovation. Here, your creativity and passion combine to drive industry-leading solutions.</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="mil-up">
                                        <h5 class="mil-mb-15">Professional growth</h5>
                                        <p class="mil-text-m mil-soft">We offer opportunities for continued professional development. At Plax, you not only work on your job, but on your career. Training, mentoring and significant challenges await you.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 mil-mb-80">
                            <div class="mil-image-frame mil-up">
                                <img src="{{ asset('template/img/inner-pages/6.png') }}" alt="image" class="mil-scale-img" data-value-1="1" data-value-2="1.2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- about end -->

            <!-- call to action -->
            <div class="mil-cta mil-p-0-160 mil-up">
                <div class="container">
                    <div class="mil-out-frame mil-bg-2">
                        <div class="row justify-content-center align-items-center mil-p-160-160">
                            <div class="col-xl-7 mil-text-center">
                                <h2 class="mil-light mil-mb-30 mil-up">Join our team, where Innovation is our priority</h2>
                                <p class="mil-text-m mil-light mil-mb-60 mil-up">Join a dedicated, innovative team committed <br>to excellence at every step.</p>
                                <div class="mil-up"><a href="{{ route('register') }}" class="mil-btn mil-md mil-add-arrow">Register now</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- call to action end -->

            <!-- vacancies -->
            <div class="mil-faq mil-p-0-130">
                <div class="container">
                    <div class="mil-text-center">
                        <h2 class="mil-mb-60 mil-up">Explore Career <br>Opportunities at Plax</h2>
                    </div>

                    <div class="mil-vacancie mil-mb-30 mil-up">
                        <div class="mil-left">
                            <h4 class="mil-mb-30">International Business Development Specialist</h4>
                            <p class="mil-text-m mil-soft mil-mb-30">Develop and execute strategies to expand our presence in new international markets.</p>
                            <ul class="mil-tags">
                                <li>Business Development</li>
                                <li>Office work</li>
                                <li>Paris, France</li>
                            </ul>
                        </div>
                        <div class="mil-right mil-up">
                            <a href="{{ route('career.details') }}" class="mil-btn mil-m mil-add-arrow">See position</a>
                        </div>
                    </div>
                    <div class="mil-vacancie mil-mb-30 mil-up">
                        <div class="mil-left">
                            <h4 class="mil-mb-30">Frontend Software Engineer</h4>
                            <p class="mil-text-m mil-soft mil-mb-30">Develop and execute strategies to expand our presence in new international markets.</p>
                            <ul class="mil-tags">
                                <li>Business Development</li>
                                <li>Office work</li>
                                <li>Paris, France</li>
                            </ul>
                        </div>
                        <div class="mil-right mil-up">
                            <a href="{{ route('career.details') }}" class="mil-btn mil-m mil-add-arrow">See position</a>
                        </div>
                    </div>
                    <div class="mil-vacancie mil-mb-30 mil-up">
                        <div class="mil-left">
                            <h4 class="mil-mb-30">Financial Data Analyst</h4>
                            <p class="mil-text-m mil-soft mil-mb-30">Develop and execute strategies to expand our presence in new international markets.</p>
                            <ul class="mil-tags">
                                <li>Business Development</li>
                                <li>Office work</li>
                                <li>Paris, France</li>
                            </ul>
                        </div>
                        <div class="mil-right mil-up">
                            <a href="{{ route('career.details') }}" class="mil-btn mil-m mil-add-arrow">See position</a>
                        </div>
                    </div>
                    <div class="mil-vacancie mil-mb-30 mil-up">
                        <div class="mil-left">
                            <h4 class="mil-mb-30">Digital Marketing Specialist</h4>
                            <p class="mil-text-m mil-soft mil-mb-30">Develop and execute strategies to expand our presence in new international markets.</p>
                            <ul class="mil-tags">
                                <li>Business Development</li>
                                <li>Office work</li>
                                <li>Paris, France</li>
                            </ul>
                        </div>
                        <div class="mil-right mil-up">
                            <a href="{{ route('career.details') }}" class="mil-btn mil-m mil-add-arrow">See position</a>
                        </div>
                    </div>
                    <div class="mil-vacancie mil-mb-60 mil-up">
                        <div class="mil-left">
                            <h4 class="mil-mb-30">Information Security Engineer</h4>
                            <p class="mil-text-m mil-soft mil-mb-30">Develop and execute strategies to expand our presence in new international markets.</p>
                            <ul class="mil-tags">
                                <li>Business Development</li>
                                <li>Office work</li>
                                <li>Paris, France</li>
                            </ul>
                        </div>
                        <div class="mil-right mil-up">
                            <a href="{{ route('career.details') }}" class="mil-btn mil-m mil-add-arrow">See position</a>
                        </div>
                    </div>

                    <div class="mil-text-center mil-up">
                        <a href="#" class="mil-btn mil-m mil-add-arrow">Loads more jobs</a>
                    </div>

                </div>
            </div>
            <!-- vacancies end -->

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
