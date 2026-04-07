<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>@yield('title', 'Plax - Finance & Fintech')</title>
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

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('template/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('template/favicon.ico') }}" type="image/x-icon">
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