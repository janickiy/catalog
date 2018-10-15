<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Каталог сайтов | @yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="yandex-verification" content="4f86550c90840ae3" />

    <!-- #CSS Links -->
    <!-- Basic Styles -->

    {!! Html::style('css/bootstrap.min.css') !!}

    {!! Html::style('css/font-awesome.min.css') !!}

    @yield('css')

    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    <script type="text/javascript">
        var SITE_URL = "{{url('/')}}";
    </script>

    <style>

        html,
        body {
            overflow-x: hidden; /* Prevent scroll on narrow devices */
        }

        body {
            padding-top: 56px;
        }

        @media (max-width: 767.98px) {
            .offcanvas-collapse {
                position: fixed;
                top: 56px; /* Height of navbar */
                bottom: 0;
                width: 100%;
                padding-right: 1rem;
                padding-left: 1rem;
                overflow-y: auto;
                background-color: var(--gray-dark);
                transition: -webkit-transform .3s ease-in-out;
                transition: transform .3s ease-in-out;
                transition: transform .3s ease-in-out, -webkit-transform .3s ease-in-out;
                -webkit-transform: translateX(100%);
                transform: translateX(100%);
            }

            .offcanvas-collapse.open {
                -webkit-transform: translateX(-1rem);
                transform: translateX(-1rem); /* Account for horizontal padding on navbar */
            }
        }


        .nav-scroller .nav {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: nowrap;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            color: rgba(255, 255, 255, .75);
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .nav-underline .nav-link {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: .875rem;
            color: var(--secondary);
        }

        .nav-underline .nav-link:hover {
            color: var(--blue);
        }

        .nav-underline .active {
            font-weight: 500;
            color: var(--gray-dark);
        }


        .border-bottom {
            border-bottom: 1px solid #e5e5e5;
        }

        .box-shadow {
            box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
        }


    </style>

</head>

<body>
<div class="wrap">
    <nav id="w1" class="navbar-inverse navbar-fixed-top navbar">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">My Application</a></div>
            <div id="w1-collapse" class="collapse navbar-collapse">
                <ul id="w2" class="navbar-nav navbar-right nav">
                    <li class="active"><a href="{{  URL::route('index') }}">Главная</a></li>
                    <li><a href="{{ URL::route('rules') }}">Правила каталога</a></li>
                    <li><a href="{{ URL::route('contact') }}">Обратная связь</a></li>
                    <li style="top: 9px; padding-left: 20px">
                        <span>
                            <a class="btn btn-success" href="{{ URL::route('addurl') }}">Добавить сайт</a>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        @yield('content')

    </div>
</div>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="{!! asset('js/libs/jquery-3.2.1.min.js') !!}"><\/script>');
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="{!! asset('js/libs/jquery-ui.min.js') !!}"><\/script>');
    }
</script>

@yield('js')

</body>
</html>