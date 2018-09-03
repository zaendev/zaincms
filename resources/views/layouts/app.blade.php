<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $meta['description'] }}">
    <meta name="keywords" content="{{ $meta['keyword'] }}">
    <meta name="author" content="{{ Auth::user()->name }}">
    <title>{{ $meta['title'] }}</title>

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.nestable.js') }}"></script>
    <script src="{{ asset('admin/plugins/ckeditor/ckeditor.js') }}"></script>

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
              <li class="nav-item d-none d-sm-inline-block">
                  <a class="nav-link" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('admz') }}" class="brand-link text-center">
                {{--<img src="#" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"--}}
                     {{--style="opacity: .8">--}}
                <span class="brand-text font-weight-light">ZAIN</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        {{--<img src="#" class="img-circle elevation-2" alt="User Image">--}}
                    </div>
                    <div class="info">
                        <a href="{{ url('/') }}" class="d-block">{{ Auth::check() ? Auth::user()->name:'' }}</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item has-treeview">
                            <a href="{{ url('admz') }}" class="nav-link {{ empty(Request::segment(2)) ? 'active':'' }}">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview {{ Request::segment(2) == 'post' ? 'menu-open':'' }}">
                            <a href="#" class="nav-link {{ Request::segment(2) == 'post' ? 'active':'' }}">
                                <i class="nav-icon fa fa-edit"></i>
                                <p>
                                    Post
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: {{ Request::segment(2) == 'post' ? 'block':'' }}">
                                <li class="nav-item">
                                    <a href="{{ url('admz/post') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Post</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admz/category/post') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Category</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ url('admz/page') }}" class="nav-link {{ Request::segment(2) == 'page' ? 'active':'' }}">
                                <i class="nav-icon fa fa-file-o"></i>
                                <p>
                                    Page
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ url('admz/menu') }}" class="nav-link {{ Request::segment(2) == 'menu' ? 'active':'' }}">
                                <i class="nav-icon fa fa-th"></i>
                                <p>
                                    Menu
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ url('admz/slide') }}" class="nav-link {{ Request::segment(2) == 'slide' ? 'active':'' }}">
                                <i class="nav-icon fa fa-image"></i>
                                <p>
                                    Slide
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ url('admz/config') }}" class="nav-link {{ Request::segment(2) == 'config' ? 'active':'' }}">
                                <i class="nav-icon fa fa-gears"></i>
                                <p>
                                    Config
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">

            @yield('content')

        </div>  
        
        <footer class="main-footer">
            <strong>Copyright &copy; 2018-2018 <a href="https://share.web.id"> ZAIN</a>.</strong> All rights reserved. Beta 1
        </footer>
        
    </div>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('admin/js/custom.js') }}"></script>

</body>
</html>
