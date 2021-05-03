<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CSMJU PROJECT</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Additional CSS Files -->
    <link href="{{ asset('css/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/assets/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/assets/css/templatemo-art-factory.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/assets/css/owl-carousel.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');

        .content {
            text-align: center;
            color: #fff
        }

        .title {
            font-size: 75px;
        }

        .gg {
            font-family: 'Bebas Neue', cursive;
            color: orangered;

        }

        h1 {
            display: block;
            font-size: 2em;
            margin-top: 0.67em;
            margin-bottom: 0.67em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
            color: whitesmoke;
            font-family: 'Poppins', sans-serif;
            text-shadow: 2px 2px #8E44AD;
        }

        h3 {
            display: block;
            font-size: 1.25em;
            margin-top: 1em;
            margin-bottom: 1em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
            color: whitesmoke;
            font-family: 'Chakra Petch', sans-serif;
            text-shadow: 2px 2px #8E44AD;

        }

        .right {
            text-align: right;
            float: right;
        }

        .left {
            text-align: left;
            float: left;
        }

        i {
            color: whitesmoke;
        }

    </style>
    {{-- <style type="text/css">
            body {
                font-family: 'Open Sans', Arial, sans-serif;
                font-weight: 600;
                margin: 0;
                padding: 0;
            }

            nav{
                width: 100%;
                height: 50px;
                background: rgb(2,0,36);
                background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 0%, rgba(0,212,255,1) 90%);
                line-height: 50px
            }
            nav ul{
                float: right;
                margin: 0;
                margin-right: 1.9rem;
            }
            nav ul li{
                list-style-type: none;
                display: inline-block;
            }
            nav ul li a{
                text-decoration: none;
                color: #fff;
                padding: 20px;
            }

            nav ul li:hover{
                background-color: coral;
                color: #000;
                font-weight: bold;
                font-size: 1.2rem;
            }
            .content {
                text-align: center;
                
            }

            .title {
                font-size: 30px;
            }



            
            
            
        </style> --}}


</head>

<body>

    {{-- <div class="wrapper">
            <!--Navigation-->    
            <div class="flex-center position-ref full-height">
                    <nav>
                        <div class="content-wrap">
                
                            @if (Route::has('login'))
                            <div class="top-right links">
                                @auth
                                <div class="content">
                                    <div class="title m-b-md">
                                        <a href="{{ url('/home') }}">HOME</a>
                                    </div>
                                </div>
                                @else
                                    <div class="content">
                                        <div class="title m-b-md">
                                                <a href="{{ route('login') }}">LOGIN</a>
                                        </div>
                                    </div>
                                @endauth
                            </div>
                            @endif
                            
                        </div>
                    </nav>

                 </div>
            </div>

        </div> --}}


    {{-- <script src="js/app.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> --}}

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">

            <nav class="main-nav navbar navbar-expand-md navbar-light fixed-top bg-white ">
                <a href="/"><img src="{{ asset('css/assets/images/ezgif.com-gif-maker.gif') }}"
                        style="width: 50%;"></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active scroll-to-section">
                            <a class="nav-link" href="#welcome">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item scroll-to-section">
                            <a class="nav-link" href="#about">about</a>
                        </li>
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item scroll-to-section">
                                    <a class="nav-link" href="{{ url('/home') }}">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item scroll-to-section">
                                    <a class="nav-link" href="{{ route('login') }}">Sign in</a>
                                </li>
                            @endauth
                        @endif
                        <li class="nav-item scroll-to-section">
                            <a class="nav-link" href="#contact-us">Contact Us</a>
                        </li>

                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->



    <!-- ***** Welcome Area Start ***** -->
    <div class="welcome-area mt-1" id="welcome">

        <!-- ***** Header Text Start ***** -->
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="left-text col-lg-6 col-md-6 col-sm-12 col-xs-12"
                        data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">

                        <h1>WELCOME TO<strong> CSMJU PROJECT</strong></h1>
                        <a href="#about" class="main-button-slider">Find Out More</a>
                    </div>

                    <div class="col-sm" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                        <div class="text-center row">
                            <div class="col"><img src="{{ asset('css/assets/images/logo.gif') }}" class="float-none"
                                    alt="" style="float:left;width:300px;">
                            </div>
                            <div class="col"> <img src="{{ asset('css/assets/images/mju.png') }}" class="float-none"
                                    alt="" style="float:right;width:180px;">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>



    <section class="section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <img src="{{ asset('css/assets/images/left-image.png') }}"
                        class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
                <div class="right-text col-lg-5 col-md-12 col-sm-12 mobile-top-fix">
                    <div class="left-heading">
                        <h5>ระบบจัดการโปรเจค
                            <br> สาขาวิทยาการคอมพิวเตอร์
                        </h5>
                    </div>
                    <div class="left-text">
                        <p>
                            {{-- <a href="#">last updated on 20 August 2019 </a> --}}
                            ระบบนี้จัดทำขึ้นมาเพื่ออำนวยความสะดวกให้แก่อาจารย์ได้ใช้ในการตัดสินหรือแสดงความคิดเห็นแก่โปรเจคของนักศึกษา
                            และ
                            นักศึกษาได้ใช้งานในการส่งงานเอกสารผ่านระบบโปรเจคหรือเป็นแหล่งค้นคว้าหาโปรเจคของรุ่นที่ผ่านมาเพื่อเป็นแนวทางในการทำโปรเจคต่อไป<br><br>
                        </p>
                        {{-- <a href="#about2" class="main-button">Discover More</a> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="hr"></div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <section class="section" id="contact-us">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4 fw_light m_bottom_30">

                    </div>
                    <div class="col-sm-8 m_bottom_30">
                        <h5 class="color_dark m_bottom_20 fw_light">Contact Us</h5>
                        <div class="container-fluid">
                            <div class="row">
                                <ul class="col-xs-12 col-sm-6 fw_light w_break">
                                    <li class="m_bottom_8">
                                        <div class="not-fixed-table" style="vertical-align: top;">
                                            <div class="body">
                                                <div class="row">
                                                    <div class="cell" style="padding-right: 1rem;">
                                                        
                                                           
                                                        
                                                    </div>
                                                    <div class="cell" style="word-break: break-word;">
                                                        <i class="far fa-phone" style="color:red" aria-hidden="true"></i>  +6653873890-3
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="m_bottom_8">
                                        <div class="not-fixed-table" style="vertical-align: top;">
                                            <div class="body">
                                                <div class="row">
                                                    <div class="cell" style="padding-right: 1rem;">
                                                        <div class="icon_wrap_size_1 color_pink circle f_left"><i
                                                                class="icon-mail-alt"></i></div>
                                                    </div>
                                                    <div class="cell" style="word-break: break-word;">
                                                        <i class="far fa-envelope" style="color:red" aria-hidden="true"></i>  Fax: +6653873898
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="m_bottom_8">
                                        <div class="not-fixed-table" style="vertical-align: top;">
                                            <div class="body">
                                                <div class="row">
                                                    <div class="cell" style="padding-right: 1rem;">
                                                        <div class="icon_wrap_size_1 color_pink circle f_left"><i
                                                                class="icon-skype"></i></div>
                                                    </div>
                                                    <div class="cell" style="word-break: break-word;">
                                                        สาขาวิชาวิทยาการคอมพิวเตอร์ คณะวิทยาศาสตร์</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="col-xs-12 col-sm-6 fw_light w_break">
                                    <li class="m_bottom_8">
                                        <div class="not-fixed-table" style="vertical-align: top;">
                                            <div class="body">
                                                <div class="row">
                                                    <div class="cell" style="padding-right: 1rem;">
                                                        <div class="icon_wrap_size_1 color_pink circle f_left"><i
                                                                class="icon-location"></i></div>
                                                    </div>
                                                    <div class="cell" style="word-break: break-word;">
                                                        <i class="fa fa-map-marker" style="color:red" aria-hidden="true"></i>
                                                        มหาวิทยาลัยแม่โจ้<br>63 หมู่ 4 ต.หนองหาร อ.สันทราย จ.เชียงใหม่
                                                        50290<br><br>
                                                        <a href="https://www.google.com/maps/place/%E0%B8%AA%E0%B8%B2%E0%B8%82%E0%B8%B2%E0%B8%A7%E0%B8%B4%E0%B8%97%E0%B8%A2%E0%B8%B2%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%84%E0%B8%AD%E0%B8%A1%E0%B8%9E%E0%B8%B4%E0%B8%A7%E0%B9%80%E0%B8%95%E0%B8%AD%E0%B8%A3%E0%B9%8C/@18.8959443,99.0108007,17z/data=!3m1!4b1!4m5!3m4!1s0x30da234aca979f93:0xb01d3d9375066a7a!8m2!3d18.8959392!4d99.0129894"
                                                            target="_blank"
                                                            class="button_type_2 color_dark r_corners tr_all color_pink_hover d_inline_m fs_medium t_md_align_c w_break">
                                                            Open in Google Maps
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>

    <!-- jQuery -->
    <script src="{{ asset('js/assets/js/jquery-2.1.0.min.js') }}" defer></script>

    <!-- Bootstrap -->
    <script src="{{ asset('js/assets/js/popper.js') }}" defer></script>
    <script src="{{ asset('js/assets/js/bootstrap.min.js') }}" defer></script>

    <!-- Plugins -->
    <script src="{{ asset('js/assets/js/owl-carousel.js') }}" defer></script>
    <script src="{{ asset('js/assets/js/scrollreveal.min.js') }}" defer></script>
    <script src="{{ asset('js/assets/js/waypoints.min.js') }}" defer></script>
    <script src="{{ asset('js/assets/js/jquery.counterup.min.js') }}" defer></script>
    <script src="{{ asset('js/assets/js/imgfix.min.js') }}" defer></script>

    <!-- Global Init -->
    <script src="{{ asset('js/assets/js/custom.js') }}" defer></script>

</body>

</html>
