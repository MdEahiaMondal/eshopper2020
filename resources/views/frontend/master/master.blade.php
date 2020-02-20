<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href=" {{ asset('frontend/') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href=" {{ asset('frontend/') }}/css/font-awesome.min.css" rel="stylesheet">
    <link href=" {{ asset('frontend/') }}/css/prettyPhoto.css" rel="stylesheet">
    <link href=" {{ asset('frontend/') }}/css/price-range.css" rel="stylesheet">
    <link href=" {{ asset('frontend/') }}/css/animate.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="{{ asset('backend/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href=" {{ asset('frontend/') }}/css/main.css" rel="stylesheet">
    <link href=" {{ asset('frontend/') }}/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src=" {{ asset('frontend/') }}/js/html5shiv.js"></script>
    <script src=" {{ asset('frontend/') }}/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

    @stack('css')

</head><!--/head-->

<body>

@include('frontend.component.header');

@yield('sidebar')


@yield('content')


@include('frontend.component.footer');

<script src="{{ asset('frontend/') }}/js/jquery.js"></script>
<script src="{{ asset('frontend/') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('frontend/') }}/js/jquery.scrollUp.min.js"></script>
<script src="{{ asset('frontend/') }}/js/price-range.js"></script>
<script src="{{ asset('frontend/') }}/js/jquery.prettyPhoto.js"></script>
<!-- Toastr -->
<script src="{{ asset('backend/js/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('frontend/') }}/js/main.js"></script>

{{--toastr message--}}
<script>
    $(function () {

        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 2500
        };

        @if(session('success'))
        toastr.success('{{ session('success') }}');
        @endif

        @if(session('error'))
        toastr.error('{{ session('error') }}');
        @endif

        @if(session('warning'))
        toastr.warning('{{ session('warning') }}');
        @endif
    });
</script>



@stack('script')
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e4aa9bb5d3dcd05"></script>

</body>
</html>
