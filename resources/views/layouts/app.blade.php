<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>@yield('title', ($siteSettings?->site_name ?? 'Portal Pilrek Unmul'))</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="HandheldFriendly" content="true">
    <meta name="author" content="bslthemes" />

    <!-- switzer font css -->
    <link rel="stylesheet" href="{{ asset('template/fonts/css/switzer.css') }}" type="text/css" media="all">
    <!-- font awesome css -->
    <link rel="stylesheet" href="{{ asset('template/fonts/css/font-awesome.min.css') }}" type="text/css" media="all">
    <!-- bootstrap grid css -->
    <link rel="stylesheet" href="{{ asset('template/css/plugins/bootstrap-grid.css') }}" type="text/css" media="all">
    <!-- swiper css -->
    <link rel="stylesheet" href="{{ asset('template/css/plugins/swiper.min.css') }}" type="text/css" media="all">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('template/css/plugins/magnific-popup.css') }}" type="text/css" media="all">
    <!-- plax css -->
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}" type="text/css" media="all">

    <style>
        .mil-preloader {
            background: #145843;
            perspective: 1100px;
        }

        .mil-preloader:before {
            display: none;
        }

        .mil-preloader .mil-load {
            width: 94px;
            height: 94px;
            display: block;
            position: relative;
            background: url('{{ asset('unmul.png') }}') center/contain no-repeat;
            transform-style: preserve-3d;
            animation: pilrek-logo-side-spin 2.4s linear infinite;
            filter: drop-shadow(0 16px 20px rgba(4, 18, 14, 0.42));
        }

        .mil-preloader .mil-load:before {
            display: none;
        }

        .mil-preloader .mil-load:after {
            display: none;
        }

        .mil-preloader p {
            display: none;
        }

        @keyframes pilrek-logo-side-spin {
            from {
                transform: rotateY(0deg);
            }
            to {
                transform: rotateY(360deg);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .mil-preloader .mil-load,
            .mil-preloader .mil-load:before,
            .mil-preloader .mil-load:after {
                animation: none;
            }
        }
    </style>

    <!-- Favicon -->
    @php
        $faviconPath = asset('unmul.png');
    @endphp
    <link rel="shortcut icon" href="{{ $faviconPath }}" type="image/png">
    <link rel="icon" href="{{ $faviconPath }}" type="image/png">
</head>

<body>
    @yield('content')

    <!-- jquery js -->
    <script src="{{ asset('template/js/plugins/jquery.min.js') }}"></script>

    <!-- swiper js -->
    <script src="{{ asset('template/js/plugins/swiper.min.js') }}"></script>
    <!-- gsap js -->
    <script src="{{ asset('template/js/plugins/gsap.min.js') }}"></script>
    <!-- scroll smoother -->
    <script src="{{ asset('template/js/plugins/ScrollSmoother.min.js') }}"></script>
    <!-- scroll trigger js -->
    <script src="{{ asset('template/js/plugins/ScrollTrigger.min.js') }}"></script>
    <!-- scroll to js -->
    <script src="{{ asset('template/js/plugins/ScrollTo.min.js') }}"></script>
    <!-- magnific -->
    <script src="{{ asset('template/js/plugins/magnific-popup.js') }}"></script>
    <!-- plax js -->
    <script src="{{ asset('template/js/main.js') }}"></script>
</body>

</html>
