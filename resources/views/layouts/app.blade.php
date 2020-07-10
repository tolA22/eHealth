<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>  

    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mycss.css') }}" rel="stylesheet">

    <!-- datatable -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">   -->
        <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <a class="navbar-brand" href="{{ url('/') }}">
            <div class="container">
                    <img src="{{ asset('images/logo.png') }}" width="55" height="30" class="d-inline-block align-top" alt="">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <!-- dropdown for patients and doctors -->
                        <li class="nav-item">
                            <a class="d-none d-md-block btn btn-outline-primary " href="{{route('login')}}" role="button"  aria-haspopup="true" aria-expanded="false">
                            Login
                            </a>
                            <a class=" d-md-none text-primary navlink " href="{{route('login')}}" role="button"  aria-haspopup="true" aria-expanded="false">
                            Login
                            </a>
                            
                        </li>
                        <li class="ml-md-2 nav-item">
                            <a class="d-none d-md-block btn btn-outline-success" href="{{route('register')}}"  role="button"  aria-haspopup="true" aria-expanded="false">
                            Register
                            </a>
                            <a class="d-md-none text-success navlink " href="{{route('register')}}"  role="button"  aria-haspopup="true" aria-expanded="false">
                            Register
                            </a>
                        </li>
                
                        
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('schedule_modal')
        @yield('schedule_create')
        @yield('doctor_modal')

        <!-- <main class="py-4"> -->
            @yield('content')
        <!-- </main> -->
    </div>
    <script>
  $(document).ready(function() {
      console.log("here");
    //   $.noConflict();
        $('#table').DataTable(
            {
                              url:'/schedule/all'
                          }
        );
    }
 );
 </script>
</body>
</html>
