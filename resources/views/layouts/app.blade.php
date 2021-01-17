<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bonus.js') }}" defer></script>
    <script src="{{ asset('js/Project.js') }}" defer></script>
    <script src="{{ asset('js/login.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css" integrity="sha512-kJ30H6g4NGhWopgdseRb8wTsyllFUYIx3hiUwmGAkgA9B/JbzUBDQVr2VVlWGde6sdBVOG7oU8AL35ORDuMm8g==" crossorigin="anonymous" />
  <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


</head>
<style>
img {
  border-radius: 50%;
}
</style>
<body>
    
    <div id="app">
        <br><br>
        <nav class="navbar navbar-expand-md fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="layouts/" alt="" style="width:50px;height:40px;">
                    {{ config('', 'CSMJUPROJECT') }}
                    
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            
                        @else
                       
                            <li class="nav-item dropdown">
                            @if (Auth::user()->hasRole('Std'))
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}{{__(' (student)')}} <span class="caret"></span>
                                </a>
                                @endif
                                @if (Auth::user()->hasRole('Admin'))
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}{{__(' (Administration)')}} <span class="caret"></span>
                                </a>
                                @endif
                                @if (Auth::user()->hasRole('Tea'))
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}{{__(' (instructor)')}} <span class="caret"></span>
                                </a>
                                @endif

                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->hasRole('Std'))
                                    <a class="dropdown-item" href="{{route('User.edit', Auth::user()->id)}}">
                                        {{ __('จัดการผู้ใช้') }}
                                    </a>
                                    <a class="dropdown-item" href="{{route('STD.edit', Auth::user()->reg_std_id)}}">
                                        {{ __('จัดการข้อมูลการติดต่อ') }}
                                    </a>
                                    @endif
                                    @if (Auth::user()->hasRole('Tea'))
                                    <a class="dropdown-item" href="{{route('User.edit', Auth::user()->id)}}">
                                        {{ __('จัดการผู้ใช้') }}
                                    </a>
                                    <a class="dropdown-item" href="{{route('Teacher.edit', Auth::user()->reg_tea_id)}}">
                                        {{ __('จัดการข้อมูลการติดต่อ') }}
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                                    
                                        <li class="dropdown">
                                        <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i>(<b>2</b>)</a>
                                        <ul class="dropdown-menu notify-drop">
                                          <div class="notify-drop-title">
                                              <div class="row">
                                                  <div class="col-md-6 col-sm-6 col-xs-6">Message(<b>2</b>)</div>
                                                  <div class="col-md-6 col-sm-6 col-xs-6 text-right"><a href="" class="rIcon allRead" data-tooltip="tooltip" data-placement="bottom" title="tümü okundu."><i class="fa fa-dot-circle-o"></i></a></div>
                                              </div>
                                          </div>
                                          <!-- end notify title -->
                                          <!-- notify content -->
                                          <div class="drop-content">
                                              <li>
                                                  <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                                  <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a href="">Ahmet</a> yorumladı. <a href="">click</a> <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                                                  <hr>
                                                  <p class="time">time</p>
                                                  </div>
                                              </li>
                                              <li>
                                                  <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                                  <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a href="">Ahmet</a> yorumladı. <a href="">click</a> <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                                                  <p>Lorem ipsum sit dolor amet consilium.</p>
                                                  <p class="time">time</p>
                                                  </div>
                                              </li>
                                              <li>
                                                  <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                                  <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a href="">Ahmet</a> yorumladı. <a href="">click</a> <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                                                  <p>Lorem ipsum sit dolor amet consilium.</p>
                                                  <p class="time">time</p>
                                                  </div>
                                              </li>
                                              <li>
                                                  <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                                  <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a href="">Ahmet</a> yorumladı. <a href="">click</a> <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                                                  <p>Lorem ipsum sit dolor amet consilium.</p>
                                                  <p class="time">time</p>
                                                  </div>
                                              </li>
                                              <li>
                                                  <div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                                  <div class="col-md-9 col-sm-9 col-xs-9 pd-l0"><a href="">Ahmet</a> yorumladı. <a href="">click</a> <a href="" class="rIcon"><i class="fa fa-dot-circle-o"></i></a>
                                                  <p>Lorem ipsum sit dolor amet consilium.</p>
                                                  <p class="time">time</p>
                                                  </div>
                                              </li>
                                          </div>
                                          <div class="notify-drop-footer text-center">
                                              <a href=""><i class="fa fa-eye"></i> See</a>
                                          </div>
                                        </ul>
                                      </li>
                                    
                                   

                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @extends('layouts.master')
    </div>
</body>
</html>
