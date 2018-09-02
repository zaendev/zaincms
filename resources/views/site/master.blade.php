<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ empty($meta['description']) ? $config->seo : $meta['description'] }}">
    <meta name="keywords" content="{{ empty($meta['keyword']) ? $config->keyword : $meta['keyword']}}">
    <meta name="author" content="{{ $config->author }}">
    <title>{{ empty($meta['title']) ? $config->site_title : $meta['title']}}</title>
    {{--<link rel="icon" href="../../../../favicon.ico">--}}

    <link href="{{ url('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/css/jssocials.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/css/jssocials-theme-flat.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/css/responsive.css') }}" rel="stylesheet">

    <script src="{{ url('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ url('frontend/js/jssocials.min.js') }}"></script>

</head>

<body>

<nav class="navbar bg-white navbar-expand-lg navbar-light fixed-top header_nav" id="maindiv">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="{{ url('/') }}">ZAINCMS</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
            <ul class="d-sm-block navbar-nav mr-auto col-md-6">
                <form action="{{ url('search') }}" method="get">
                    <div class="input-group stylish-input-search">
                        <input type="text" name="search" class="form-control" placeholder="Search">
                        <span class="input-group-addon">
                            <button type="submit">
                                <span class="fa fa-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}"> Home <span class="sr-only">(current)</span></a>
                </li>
                @if(isset($dataMenu))
                    @foreach($dataMenu as $m)
                        @if(array_key_exists('childs', $m))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $m->title }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach($m->childs as $s)
                                        <a class="dropdown-item" href="{{ url($s->slug) }}">{{ $s->title }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url($m->slug) }}">{{ $m->title }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</nav>

<main role="main">

    @yield('content')

    <!-- FOOTER -->
        <footer>
            <div class="container">
                <p>&copy; 2018 - {{ date('Y') .' '. $config->site_title }}</p>
            </div>
        </footer>

</main>

<script src="{{ url('frontend/js/popper.min.js') }}"></script>
<script src="{{ url('frontend/js/bootstrap.min.js') }}"></script>
</body>
</html>
