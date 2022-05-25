<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('paper') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('paper') }}/img/geotracking.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="token" content="{{ csrf_token() }}">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"> -->
    
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <!-- <link rel="canonical" href="https://www.creative-tim.com/product/paper-dashboard-laravel" /> -->

    <!--  Social tags      -->
    <!-- <meta name="keywords" content="design system, dashboard, bootstrap 4 dashboard, bootstrap 4 design, bootstrap 4 system, bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, paper, paper dashboard, creative tim, updivision, html dashboard, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap dashboard, responsive dashboard, laravel, laravel php, laravel php framework, free laravel admin template, free laravel admin, free laravel admin template + Front End + CRUD, crud laravel php, crud laravel, laravel backend admin dashboard"> -->
    <!-- <meta name="description" content="Start your development with a Bootstrap 4 Admin Dashboard built for Laravel Framework 5.5 and Up."> -->

    <!-- Schema.org markup for Google+ -->
    <!-- <meta itemprop="name" content="Paper Dashboard Laravel by Creative Tim"> -->
    <!-- <meta itemprop="description" content="Start your development with a Bootstrap 4 Admin Dashboard built for Laravel Framework 5.5 and Up."> -->
    <!-- <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/209/opt_pd_laravel_thumbnail.jpg"> -->

    <!-- Twitter Card data -->
    <!-- <meta name="twitter:card" content="product"> -->
    <!-- <meta name="twitter:site" content="@creativetim"> -->
    <!-- <meta name="twitter:title" content="Paper Dashboard Laravel by Creative Tim"> -->

    <!-- <meta name="twitter:description" content="Start your development with a Bootstrap 4 Admin Dashboard built for Laravel Framework 5.5 and Up."> -->
    <!-- <meta name="twitter:creator" content="@creativetim"> -->
    <!-- <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/209/opt_pd_laravel_thumbnail.jpg"> -->

    <!-- Open Graph data -->
    <!-- <meta property="fb:app_id" content="655968634437471"> -->
    <!-- <meta property="og:title" content="Paper Dashboard Laravel by Creative Tim" /> -->
    <!-- <meta property="og:type" content="article" /> -->
    <!-- <meta property="og:url" content="https://www.creative-tim.com/live/paper-dashboard-laravel" /> -->
    <!-- <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/209/opt_pd_laravel_thumbnail.jpg" /> -->
    <!-- <meta property="og:description" content="Start your development with a Bootstrap 4 Admin Dashboard built for Laravel Framework 5.5 and Up." /> -->
    <!-- <meta property="og:site_name" content="Creative Tim" /> -->

    <title>
        {{ __('GeoTracking') }}
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('paper') }}/demo/demo.css" rel="stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('styles')

</head>

<body >

    @auth()
    @include('layouts.page_templates.auth')
    @endauth

    @guest
    @include('layouts.page_templates.guest')
    @endguest

    <!--   Core JS Files   -->
    <script src="{{ asset('paper') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('paper') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('paper') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('paper') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
    <!-- Chart JS -->
    <script src="{{ asset('paper') }}/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('paper') }}/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('paper') }}/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
    {{--   APP.js --}}
    <script src="{{ asset('js') }}/app.js"></script>
    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('paper') }}/demo/demo.js"></script>
    <link href="{{ asset('css') }}/app.css" rel="stylesheet" />
    <style>
        .swal2-container {
            z-index: 10000;
        }
    </style>
    <!-- Sharrre libray -->
    <!-- <script src="../assets/demo/jquery.sharrre.js"></script> -->
    <script>
        $('.btn-filter').click(()=>$('.form-filter').toggle('slow'))
    </script>

    <script src="{{ asset('js') }}/script.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    @stack('scripts')

    @yield('js')


</body>

</html>
