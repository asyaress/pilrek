@extends('layouts.app')

@section('title', 'Publication')

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
    @include('partials.navbar', ['activePage' => 'berita'])


        <div id="smooth-content">

            <!-- banner -->
            <div class="mil-banner mil-banner-inner mil-dissolve">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-8">
                            <div class="mil-banner-text mil-text-center">
                                <div class="mil-text-m mil-mb-20">Blog</div>
                                <h1 class="mil-mb-60">The Benefits of Using Virtual Cards</h1>
                                <ul class="mil-breadcrumbs mil-pub-info mil-center">
                                    <li><span>December 9, 2023</span></li>
                                    <li><a href="{{ route('timeline') }}">48 Comments</a></li>
                                    <li><a href="{{ route('timeline') }}">356 Shared</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner end -->

            <!-- publication -->
            <div class="mil-blog-list mil-p-0-160">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <div class="mil-pub-cover mil-up">
                                <img src="{{ asset('template/img/inner-pages/blog/2.png') }}" alt="cover" class="mil-scale-img" data-value-1="1" data-value-2="1.2">
                            </div>
                        </div>
                        <div class="col-xl-9 mil-p-80-80">
                            <h2 class="mil-mb-60 mil-up">Delving into the Era of Digital Finance</h2>
                            <p class="mil-text-m mil-soft mil-mb-30 mil-up">Discover how virtual cards are transforming the way we manage our personal finances. This article thoroughly explores the various benefits these innovative tools offer, from added security to transaction flexibility. Join us as we explore the future of digital transactions and how virtual cards are paving the way.</p>
                            <p class="mil-text-m mil-soft mil-mb-30 mil-up">Virtual cards represent a significant evolution in the way we manage our money. Beyond convenience, they offer an additional layer of security, enabling safer transactions in an ever-changing digital world. Discover how these cards are setting the standard for the future of personal finances.</p>
                            <p class="mil-text-m mil-soft mil-mb-60 mil-up">To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee</p>
                            <div class="mil-mb-60 mil-up">
                                <blockquote class="mil-text-xl mil-mb-30">"With virtual cards, you're not just taking your wallet into the digital world, you're taking security and flexibility to new heights. We're seeing a revolutionary change in how we interact with money, and virtual cards are leading the way.â€</blockquote>
                                <p class="mil-text-m"> - Jill Martinsen</p>
                            </div>
                            <h4 class="mil-mb-60 mil-up">No one Rejects, Dislikes</h4>
                            <p class="mil-text-m mil-soft mil-mb-30 mil-up">No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever</p>
                            <p class="mil-text-m mil-soft mil-up">The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 mil-up">
                            <div class="mil-pub-cover mil-inner mil-mb-30">
                                <img src="{{ asset('template/img/inner-pages/blog/3.png') }}" alt="cover" class="mil-scale-img" data-value-1="1" data-value-2="1.2">
                            </div>
                        </div>
                        <div class="col-sm-6 mil-up">
                            <div class="mil-pub-cover mil-inner mil-mb-30">
                                <img src="{{ asset('template/img/inner-pages/blog/4.png') }}" alt="cover" class="mil-scale-img" data-value-1="1" data-value-2="1.2">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-9 mil-p-50-80">
                            <h4 class="mil-mb-60">The obligations of Business it will Frequently</h4>
                            <p class="mil-text-m mil-soft mil-mb-30 mil-up">In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because</p>
                            <p class="mil-text-m mil-soft mil-mb-60 mil-up">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.</p>
                            <ul class="mil-pup-tags mil-mb-80 mil-up">
                                <li><a href="javascript:void(0)">search</a></li>
                                <li><a href="javascript:void(0)">virtual card</a></li>
                                <li><a href="javascript:void(0)">digital finance</a></li>
                                <li><a href="javascript:void(0)">transaction flexibility</a></li>
                            </ul>
                            <div class="mil-share-frame mil-mb-80 mil-up">
                                <h6>Share:</h6>
                                <ul class="mil-pup-share">
                                    <li><a href="javascript:void(0)"><i class="fab fa-facebook-f"></i>Facebook</a></li>
                                    <li><a href="javascript:void(0)"><i class="fab fa-twitter"></i>Twitter</a></li>
                                    <li><a href="javascript:void(0)"><i class="fab fa-linkedin-in"></i>Linkedin</a></li>
                                </ul>
                            </div>
                            <div class="mil-next-post">
                                <a href="{{ route('publikasi') }}" class="mil-descr mil-up">
                                    <p class="mil-text-m mil-soft mil-mb-15">Read next posts</p>
                                    <h5>How to Optimize Business Payments with Plax Business</h5>
                                </a>
                                <a href="{{ route('publikasi') }}" class="mil-cover mil-up">
                                    <img src="{{ asset('template/img/inner-pages/blog/3.png') }}" alt="cover">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-9">
                            <h4 class="mil-mb-60 mil-up">(48) Comments</h4>
                            <ul class="mil-comments mil-mb-80">
                                <li>
                                    <div class="mil-comment mil-up">
                                        <div class="mil-avatar"><img src="{{ asset('template/img/faces/1.jpg') }}" alt="user"></div>
                                        <div class="mil-comment-text">
                                            <h6 class="mil-mb-10">Samir Holm</h6>
                                            <p class="mil-text-xs mil-soft mil-mb-15">December 10, 2023 at 10:13</p>
                                            <p class="mil-text-s mil-soft">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth</p>
                                            <a href="javascript:void(0)" class="mil-reply">Reply</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="mil-comment mil-up">
                                        <div class="mil-avatar"><img src="{{ asset('template/img/faces/2.jpg') }}" alt="user"></div>
                                        <div class="mil-comment-text">
                                            <h6 class="mil-mb-10">Menphik Bakke</h6>
                                            <p class="mil-text-xs mil-soft mil-mb-15">December 10, 2023 at 10:13</p>
                                            <p class="mil-text-s mil-soft">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth</p>
                                            <a href="javascript:void(0)" class="mil-reply">Reply</a>
                                        </div>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="mil-comment mil-up">
                                                <div class="mil-avatar"><img src="{{ asset('template/img/faces/3.jpg') }}" alt="user"></div>
                                                <div class="mil-comment-text">
                                                    <h6 class="mil-mb-10">Zaida Andresen</h6>
                                                    <p class="mil-text-xs mil-soft mil-mb-15">December 10, 2023 at 10:13</p>
                                                    <p class="mil-text-s mil-soft">These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided.</p>
                                                    <a href="javascript:void(0)" class="mil-reply">Reply</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="mil-comment mil-up">
                                        <div class="mil-avatar"><img src="{{ asset('template/img/faces/4.png') }}" alt="user"></div>
                                        <div class="mil-comment-text">
                                            <h6 class="mil-mb-10">Amin Lien</h6>
                                            <p class="mil-text-xs mil-soft mil-mb-15">December 10, 2023 at 10:13</p>
                                            <p class="mil-text-s mil-soft">These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided.</p>
                                            <a href="javascript:void(0)" class="mil-reply">Reply</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="mil-comment mil-up">
                                        <div class="mil-avatar"><img src="{{ asset('template/img/faces/5.png') }}" alt="user"></div>
                                        <div class="mil-comment-text">
                                            <h6 class="mil-mb-10">Yamina Frediksen</h6>
                                            <p class="mil-text-xs mil-soft mil-mb-15">December 10, 2023 at 10:13</p>
                                            <p class="mil-text-s mil-soft">These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided.</p>
                                            <a href="javascript:void(0)" class="mil-reply">Reply</a>
                                        </div>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="mil-comment mil-up">
                                                <div class="mil-avatar"><img src="{{ asset('template/img/faces/1.jpg') }}" alt="user"></div>
                                                <div class="mil-comment-text">
                                                    <h6 class="mil-mb-10">Haidar Knudsen</h6>
                                                    <p class="mil-text-xs mil-soft mil-mb-15">December 10, 2023 at 10:13</p>
                                                    <p class="mil-text-s mil-soft">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth.</p>
                                                    <a href="javascript:void(0)" class="mil-reply">Reply</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mil-comment mil-up">
                                                <div class="mil-avatar"><img src="{{ asset('template/img/faces/6.png') }}" alt="user"></div>
                                                <div class="mil-comment-text">
                                                    <h6 class="mil-mb-10">Jane Boonboots</h6>
                                                    <p class="mil-text-xs mil-soft mil-mb-15">December 10, 2023 at 10:13</p>
                                                    <p class="mil-text-s mil-soft">Was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth.</p>
                                                    <a href="javascript:void(0)" class="mil-reply">Reply</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mil-comment mil-up">
                                                <div class="mil-avatar"><img src="{{ asset('template/img/faces/2.jpg') }}" alt="user"></div>
                                                <div class="mil-comment-text">
                                                    <h6 class="mil-mb-10">Amin Lien</h6>
                                                    <p class="mil-text-xs mil-soft mil-mb-15">December 10, 2023 at 10:13</p>
                                                    <p class="mil-text-s mil-soft">But I must explain to you how all this mistaken idea</p>
                                                    <a href="javascript:void(0)" class="mil-reply">Reply</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-9">
                            <h4 class="mil-mb-60 mil-up">Leave your comment</h4>
                            <form>
                                <div class="row">
                                    <div class="col-md-6 mil-mb-30">
                                        <input class="mil-input mil-up" placeholder="First name">
                                    </div>
                                    <div class="col-md-6 mil-mb-30">
                                        <input class="mil-input mil-up" placeholder="your e-mail">
                                    </div>
                                    <div class="col-xl-12 mil-mb-30">
                                        <input class="mil-input mil-up" placeholder="Your website/social profile">
                                    </div>
                                    <div class="col-xl-12 mil-mb-30 ">
                                        <textarea cols="30" rows="10" class="mil-up" placeholder="Write your comment here"></textarea>
                                    </div>
                                </div>
                                <div class="mil-checkbox-frame mil-mb-30 mil-up">
                                    <div class="mil-checkbox">
                                        <input type="checkbox" id="checkbox-1">
                                        <label for="checkbox-1"></label>
                                    </div>
                                    <p class="mil-text-xs mil-soft">I agree that the data submitted, collected and stored *</p>
                                </div>
                                <div class="mil-up">
                                    <button type="submit" class="mil-btn mil-m">Post Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- publication end -->
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



