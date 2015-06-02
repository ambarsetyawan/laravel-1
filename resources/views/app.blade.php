<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @yield('header')
    <link href="{{ asset('/public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/css/fonts.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('/public/css/font-awesome.min.css') }}" rel='stylesheet' type='text/css'>
    <link rel="icon" href="{{ asset('/public/images/icon.png') }}" type="image/png" sizes="16x16">
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/')}}">IntEr-gRouP</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    @if (Auth::user() && Auth::user())
                        <li><a href="{{ url('/post/create') }}">Create a new post</a></li>
                    @endif
                </ul>
                @if (Auth::user() && Auth::user())
                    <form class="navbar-form navbar-left" role="search" action="javascript:search();">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search" id="text_search" value="{{isset($keyword) ? $keyword:""}}">
                        </div>
                        <button type="button" class="btn btn-default" id="search">Search</button>
                    </form>
                @endif

                <ul class="nav navbar-nav navbar-right">
                    <!-- <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">3</span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="">You have 10 notifications</li>
                            <li><a href="{{ url('/user/logout') }}">Tran Van Moi like your post</a></li>
                            <li><a href="{{ url('/user/setting') }}">Seven Moi like your post</a></li>
                            <li><a href="{{ url('/user/setting') }}">Seven Moi like your post</a></li>
                            <li><a href="{{ url('/user/setting') }}">Seven Moi like your post</a></li>
                            <li><a href="{{ url('/user/setting') }}">Seven Moi like your post</a></li>
                            <li><a href="{{ url('/user/setting') }}">Seven Moi like your post</a></li>
                            <li><a href="{{ url('/user/setting') }}">Seven Moi like your post</a></li>
                        </ul>
                    </li> -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/user/login') }}">Login</a></li>
                        <li><a href="{{ url('/user/register') }}">Register</a></li>
                    @else
                        <li><a href="{{url('/user/profile')}}">
                            <img src="{{Session::get('url_image_auth')}}" class="avatar-user">
                            {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">▼</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/user/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                                <li><a href="{{ url('/user/setting') }}"><i class="fa fa-gear fa-fw"></i> Setting</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div id="content">
        @yield('content')
    </div>
    <div id="footer">
        Creator: Tran Van Moi</br>
        Mulodo Viet Nam Co,.Ltd,
    </div>
    <!-- Scripts -->
    <script src="{{asset('/public/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/public/js/jemotion.js')}}"></script>
    <script src="{{asset('/public/js/search.js')}}"></script>
    <script type="text/javascript">
        @if(Request::is('user/profile/*') || Request::is('user/view/*') || Request::is('home/*'))
            current_url = "{{Request::url()}}"
        @else
            current_url = "{{url('home')}}"
        @endif
    </script>
</body>
</html>