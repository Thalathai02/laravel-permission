<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

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
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="#" class="logo">Computer Science

                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#welcome" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#about">About</a></li>

                            @if (Route::has('login'))
                                @auth
                                    <li class="scroll-to-section"> <a href="{{ url('/home') }}">Dashboard</a></li>
                                @else
                                    <li class="scroll-to-section"> <a href="{{ route('login') }}">LOGIN</a></li>
                                @endauth
                            @endif




                            {{-- @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                            <div class="content">
                                <div class="title m-b-md">
                                    <a href="{{ url('/home') }} " class="gg">HOME</a>
                                </div>
                            </div>
                            @else
                                <div class="content">
                                    <div class="title m-b-md">
                                            <a href="{{ route('login') }}" class="gg">LOGIN</a>
                                    </div>
                                </div>
                            @endauth
                        </div>
                        @endif --}}


                            {{-- <li class="scroll-to-section"><a href="#services">Services</a></li>
                        <li class="scroll-to-section"><a href="#frequently-question">Frequently Questions</a></li>
                        <li class="submenu">
                            <a href="javascript:;">Drop Down</a>
                            <ul>
                                <li><a href="">About Us</a></li>
                                <li><a href="">Features</a></li>
                                <li><a href="">FAQ's</a></li>
                                <li><a href="">Blog</a></li>
                            </ul>
                        </li> --}}
                            <li class="scroll-to-section"><a href="#contact-us">Contact Us</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->


    <!-- ***** Welcome Area Start ***** -->
    <div class="welcome-area" id="welcome">

        <!-- ***** Header Text Start ***** -->
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="left-text col-lg-6 col-md-6 col-sm-12 col-xs-12"
                        data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                        <h1>WELCOME TO<strong> CSMJU PROJECT</strong>

                        </h1>

                        {{-- <p>......</p> --}}
                        <a href="#about" class="main-button-slider">Find Out More</a>
                    </div>

                    <div class="col-sm" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                        <img src="{{ asset('css/assets/images/logo.gif') }}" class="float-left" alt=""
                            style="float:left;width:300px;">
                        <img src="{{ asset('css/assets/images/mju.png') }}" class="float-right" alt=""
                            style="float:left;width:180px;">

                    </div>
                </div>
            </div>
        </div>
        <!-- ***** Header Text End ***** -->
    </div>
    <!-- ***** Welcome Area End ***** -->


    <!-- ***** Features Big Item Start ***** -->
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
    <!-- ***** Features Big Item End ***** -->


    <!-- ***** Features Big Item Start ***** -->
    {{-- <section class="section" id="about2">
    <div class="container">
        <div class="row">
            <div class="left-text col-lg-5 col-md-12 col-sm-12 mobile-bottom-fix">
                <div class="left-heading">
                    <h5>Curabitur aliquam eget tellus id porta</h5>
                </div>
                <p>Proin justo sapien, posuere suscipit tortor in, fermentum mattis elit. Aenean in feugiat purus.</p>
                <ul>
                    <li>
                        <img src="{{ asset('css/assets/images/about-icon-01.png') }}" alt="">
                        <div class="text">
                            <h6>Nulla ultricies risus quis risus</h6>
                            <p>You can use this website template for commercial or non-commercial purposes.</p>
                        </div>
                    </li>
                    <li>
                        <img src="{{ asset('css/assets/images/about-icon-02.png') }}" alt="">
                        <div class="text">
                            <h6>Donec consequat commodo purus</h6>
                            <p>You have no right to re-distribute this template as a downloadable ZIP file on any website.</p>
                        </div>
                    </li>
                    <li>
                        <img src="{{ asset('css/assets/images/about-icon-03.png') }}" alt="">
                        <div class="text">
                            <h6>Sed placerat sollicitudin mauris</h6>
                            <p>If you have any question or comment, please <a rel="nofollow" href="https://templatemo.com/contact">contact</a> us on TemplateMo.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="right-image col-lg-7 col-md-12 col-sm-12 mobile-bottom-fix-big" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                <img src="{{ asset('css/assets/images/right-image.png') }}" class="rounded img-fluid d-block mx-auto" alt="App">
            </div>
        </div>
    </div>
</section> --}}
    <!-- ***** Features Big Item End ***** -->


    <!-- ***** Features Small Start ***** -->
    {{-- <section class="section" id="services">
    <div class="container">
        <div class="row">
            <div class="owl-carousel owl-theme">
                <div class="item service-item">
                    <div class="icon">
                        <i><img src="{{ asset('css/assets/images/service-icon-01.png') }}" alt=""></i>
                    </div>
                    <h5 class="service-title">First Box Service</h5>
                    <p>Aenean vulputate massa sed neque consectetur, ac fringilla quam aliquet. Sed a enim nec eros tempor cursus at id libero.</p>
                    <a href="#" class="main-button">Read More</a>
                </div>
                <div class="item service-item">
                    <div class="icon">
                        <i><img src="{{ asset('css/assets/images/service-icon-02.png') }}" alt=""></i>
                    </div>
                    <h5 class="service-title">Second Box Title</h5>
                    <p>Pellentesque vitae urna ut nisi viverra tristique quis at dolor. In non sodales dolor, id egestas quam. Aliquam erat volutpat. </p>
                    <a href="#" class="main-button">Discover More</a>
                </div>
                <div class="item service-item">
                    <div class="icon">
                        <i><img src="{{ asset('assets/images/service-icon-03.png') }}" alt=""></i>
                    </div>
                    <h5 class="service-title">Third Title Box</h5>
                    <p>Quisque finibus libero augue, in ultrices quam dictum id. Aliquam quis tellus sit amet urna tincidunt bibendum.</p>
                    <a href="#" class="main-button">More Detail</a>
                </div>
                <div class="item service-item">
                    <div class="icon">
                        <i><img src="{{ asset('css/assets/images/service-icon-02.png') }}" alt=""></i>
                    </div>
                    <h5 class="service-title">Fourth Service Box</h5>
                    <p>Fusce sollicitudin feugiat risus, tempus faucibus arcu blandit nec. Duis auctor dolor eu scelerisque vestibulum.</p>
                    <a href="#" class="main-button">Read More</a>
                </div>
                <div class="item service-item">
                    <div class="icon">
                        <i><img src="{{ asset('css/assets/images/service-icon-01.png') }}" alt=""></i>
                    </div>
                    <h5 class="service-title">Fifth Service Title</h5>
                    <p>Curabitur aliquam eget tellus id porta. Proin justo sapien, posuere suscipit tortor in, fermentum mattis elit.</p>
                    <a href="#" class="main-button">Discover</a>
                </div>
                <div class="item service-item">
                    <div class="icon">
                        <i><img src="{{ asset('css/assets/images/service-icon-03.png') }}" alt=""></i>
                    </div>
                    <h5 class="service-title">Sixth Box Title</h5>
                    <p>Ut nibh velit, aliquam vitae pellentesque nec, convallis vitae lacus. Aliquam porttitor urna ut pellentesque.</p>
                    <a href="#" class="main-button">Detail</a>
                </div>
                <div class="item service-item">
                    <div class="icon">
                        <i><img src="{{ asset('css/assets/images/service-icon-01.png') }}" alt=""></i>
                    </div>
                    <h5 class="service-title">Seventh Title Box</h5>
                    <p>Sed a consequat velit. Morbi lectus sapien, vestibulum et sapien sit amet, ultrices malesuada odio. Donec non quam.</p>
                    <a href="#" class="main-button">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section> --}}
    <!-- ***** Features Small End ***** -->


    <!-- ***** Frequently Question Start ***** -->
    {{-- <section class="section" id="frequently-question">
    <div class="container">
        <!-- ***** Section Title Start ***** -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Frequently Asked Questions</h2>
                </div>
            </div>
            <div class="offset-lg-3 col-lg-6">
                <div class="section-heading">
                    <p>Vivamus venenatis eu mi ac mattis. Maecenas ut elementum sapien. Nunc euismod risus ac lobortis congue. Sed erat quam.</p>
                </div>
            </div>
        </div>
        <!-- ***** Section Title End ***** -->

        <div class="row">
            <div class="left-text col-lg-6 col-md-6 col-sm-12">
                <h5>Class aptent taciti sociosqu ad litora torquent per conubia</h5>
                <div class="accordion-text">
                    <p>Curabitur placerat diam in risus lobortis, laoreet porttitor est elementum. Nulla ultricies risus quis risus scelerisque, a aliquam tellus maximus. Cras pretium nulla ac convallis iaculis. Aenean bibendum erat vitae odio sodales, in facilisis tellus volutpat.</p>
                    <p>Sed lobortis pellentesque magna ac congue. Suspendisse quis molestie magna, id eleifend ex. Ut mollis ultricies diam nec dictum. Morbi commodo hendrerit mi vel vulputate. Proin non tincidunt dui. Lorem ipsum dolor sit amet.</p>
                    <span>Email: <a href="#">email@company.com</a><br></span>
                    <a href="#contact-us" class="main-button">Contact Us</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="accordions is-first-expanded">
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>First Common Question</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Duis vulputate porttitor urna sit amet pretium. Phasellus sed pulvinar eros, condimentum consequat ex. Suspendisse potenti.
                                <br><br>
                                Pellentesque maximus lorem sed elit imperdiet mattis. Duis posuere mauris ut eros rutrum sodales. Aliquam erat volutpat.</p>
                            </div>
                        </div>
                    </article>
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>Second Question Answer</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Sed odio elit, cursus sed consequat at, rutrum eget augue. Cras ac eros iaculis, tempor quam sit amet, scelerisque mi. Quisque eu risus eget nunc porttitor vestibulum at a ante.
                                <br><br>
                                Praesent ut placerat turpis, vel pellentesque dolor. Sed rutrum eleifend tortor, eu luctus orci sagittis in. In blandit fringilla mollis.</p>
                            </div>
                        </div>
                    </article>
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>Third Answer for you</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Proin feugiat ante ut vulputate rutrum. Nam quis erat turpis. Nullam maximus pharetra lorem, eu condimentum est iaculis ut. Pellentesque mattis ultrices dignissim. 
                                <br><br>
                                Etiam et enim finibus, feugiat massa efficitur, finibus sapien. Sed cursus lacus quis arcu scelerisque, eget ornare risus maximus. Aenean non lectus id odio rhoncus pharetra.</p>
                            </div>
                        </div>
                    </article>
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>Fourth Question Asked</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Phasellus eu purus ornare, eleifend orci nec, egestas nulla. Sed sed aliquet sapien. Proin placerat, ipsum eu posuere blandit, tellus quam consectetur nisi, id sollicitudin diam ex at nisi.
                                <br><br>
                                Aenean fermentum eget turpis egestas semper. Sed finibus mollis venenatis. Praesent at sem in massa iaculis pharetra.</p>
                            </div>
                        </div>
                    </article>
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>Fifth Ever Question</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Quisque aliquet ipsum ut magna rhoncus, euismod lacinia elit rhoncus. Sed sapien elit, mollis ut ultricies quis, fermentum nec ante.
                                <br><br>
                                Sed nec ex nec tortor fermentum sollicitudin id ut ligula. Ut sagittis rutrum lectus, non sagittis ante euismod eu. </p>
                            </div>
                        </div>
                    </article>
                    <article class="accordion">
                        <div class="accordion-head">
                            <span>Sixth Sense Question</span>
                            <span class="icon">
                                <i class="icon fa fa-chevron-right"></i>
                            </span>
                        </div>
                        <div class="accordion-body">
                            <div class="content">
                                <p>Suspendisse potenti. Ut dapibus leo ut massa vulputate semper. Pellentesque maximus lorem sed elit imperdiet mattis. Duis posuere mauris ut eros rutrum sodales. Aliquam erat volutpat.</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section> --}}
    <!-- ***** Frequently Question End ***** -->


    <!-- ***** Contact Us Start ***** -->
    <section class="section" id="contact-us">
        <div class="container-fluid">
            <div class="row">
                <!-- ***** Contact Map Start ***** -->
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div id="map">
                        <!-- How to change your own map point
                       1. Go to Google Maps
                       2. Click on your location point
                       3. Click "Share" and choose "Embed map" tab
                       4. Copy only URL and paste it within the src="" field below
                -->

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7549.563268478465!2d99.0099707270447!3d18.896766158054884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da239a4f2aedb7%3A0x610f3e722c9e2fa6!2sCSMJU%20Studio!5e0!3m2!1sth!2sth!4v1610471012281!5m2!1sth!2sth"
                            width="100%" height="500px" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
                <!-- ***** Contact Map End ***** -->

                <!-- ***** Contact Form Start ***** -->
                <div class="col-lg-6 col-md-6 col-sm-12">

                    <div class="contact-form">
                        <form id="contact" action="" method="post">
                            <h1>Contact</h1>
                            <div class="row">


                                <div class="col-md-6 col-sm-12">
                                    <fieldset>
                                        {{-- <input name="name" type="text" id="name" placeholder="Full Name" required="" class="contact-field"> --}}
                                        <h3>
                                            <i class="fas fa-phone-alt"></i>
                                            +6653873890-3
                                        </h3>
                                    </fieldset>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <fieldset>
                                        <h3>
                                            <i class="fas fa-envelope"></i>
                                            Fax: +6653873898
                                        </h3>
                                        {{-- <input name="email" type="text" id="email" placeholder="E-mail" required="" class="contact-field"> --}}
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <h3 class="left">
                                            <i class="far fa-copyright"></i>
                                            สาขาวิทยาการคอมพิวเตอร์ คณะวิทยาศาสตร์
                                        </h3>
                                        {{-- <textarea name="message" rows="6" id="message" placeholder="Your Message" required="" class="contact-field"></textarea> --}}
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <h3 class="left">
                                            <i class="fas fa-map-marker-alt"></i>
                                            มหาวิทยาลัยแม่โจ้
                                            <br>
                                            &nbsp;&nbsp; 63 หมู่ 4 ต.หนองหาร อ.สันทราย จ.เชียงใหม่ 50290
                                        </h3>
                                        {{-- <button type="submit" id="form-submit" class="main-button">Send It</button> --}}
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- ***** Contact Form End ***** -->
            </div>
        </div>
    </section>
    <!-- ***** Contact Us End ***** -->


    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <p class="copyright">Copyright &copy; 2021 CSMJU COMPANY


                </div>
                <div class="col-lg-5 col-md-12 col-sm-12">
                    <ul class="social">
                        <li><a href="https://www.facebook.com/comscience.mju"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                        {{-- <li><a href="#"><i class="fa fa-rss"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
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
