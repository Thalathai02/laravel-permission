<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <!-- Styles -->
        <style type="text/css">
            body {
                font-family: 'Open Sans', Arial, sans-serif;
                font-weight: 600;
                margin: 0;
                padding: 0;
            }
            .wrapper{
                background: url(img/maejo.png)
                no-repeat center center;
                min-height: 30rem;
            }
            nav{
                width: 100%;
                height: 50px;
                background-color: #2E86C1;
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
            img{
                width: 3.5%;
                height: 80%;
                margin-left: 1rem;
                margin-top: 0.3%;
                border-radius: 10%;
            }
            nav ul li:hover{
                background-color: coral;
                color: #000;
                font-weight: bold;
                font-size: 1.2rem;
            }
            .content {
                text-align: right;
            }

            .title {
                font-size: 80px;
            }
            .welcome-section {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                background-color: whitesmoke;
                overflow: hidden;
            }
            .welcome-section .content-wrap {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate3d(-50%, -50%, 0);
            }
            .welcome-section .content-wrap .fly-in-text {
                list-style: none;
            }
            .welcome-section .content-wrap .fly-in-text li {
                display: inline-block;
                margin-right: 0px;
                font-size: 5em;
                color: #2E86C1;
                opacity: 1;
                transition: all 2s ease;
            }
            .welcome-section .content-wrap .fly-in-text li:last-child {
                margin-right: 0;
            }
            .welcome-section .content-wrap .enter-button {
                display: block;
                text-align: center;
                font-size: 1em;
                text-decoration: none;
                text-transform: uppercase;
                color: #8E44AD;
                opacity: 1;
                transition: all 1s ease 2s;
            }
            
            .welcome-section.content-hidden .content-wrap .fly-in-text li { opacity: 0; }
            .welcome-section.content-hidden .content-wrap .fly-in-text li:nth-child(1) { transform: translate3d(-100px, 0, 0); }
            .welcome-section.content-hidden .content-wrap .fly-in-text li:nth-child(2) { transform: translate3d(0, -25px, 0); }
            .welcome-section.content-hidden .content-wrap .fly-in-text li:nth-child(3) { transform: translate3d(0, -50px, 0); }
            .welcome-section.content-hidden .content-wrap .fly-in-text li:nth-child(4) { transform: translate3d(0, -75px, 0); }
            .welcome-section.content-hidden .content-wrap .fly-in-text li:nth-child(5) { transform: translate3d(0, -100px, 0); }
            .welcome-section.content-hidden .content-wrap .fly-in-text li:nth-child(6) { transform: translate3d(0, -125px, 0); }
            .welcome-section.content-hidden .content-wrap .fly-in-text li:nth-child(7) { transform: translate3d(100px, 0, 0); }
            .welcome-section.content-hidden .content-wrap .fly-in-text li:nth-child(8) { transform: translate3d(-100px, 0, 0); }
            .welcome-section.content-hidden .content-wrap .fly-in-text li:nth-child(9) { transform: translate3d(0, 25px, 0); }
            .welcome-section.content-hidden .content-wrap .fly-in-text li:nth-child(10) { transform: translate3d(0, 50px, 0); }
            .welcome-section.content-hidden .content-wrap .fly-in-text li:nth-child(11) { transform: translate3d(0, 75px, 0); }
            .welcome-section.content-hidden .content-wrap .fly-in-text li:nth-child(12) { transform: translate3d(100px, 0, 0); }

            .welcome-section.content-hidden .content-wrap .enter-button { opacity: 0; transform: translate3d(0, -30px, 0); }
            
            @media (min-width: 800px) {
                .welcome-section .content-wrap .fly-in-text li { font-size: 8em; }
                .welcome-section .content-wrap .enter-button { font-size: 1.5em; }
            }
            
            
            
        </style>
    </head>
    <body>
        <div class="wrapper">
            <!--Navigation-->
            
            <div class="flex-center position-ref full-height">
                
                <div class="welcome-section content-hidden">
                    <nav>
                        <img src="https://lh3.googleusercontent.com/proxy/SEhODiDYqfOytekVmskPNjsdq8aYI9yD0fdNrMCj7XyQKoqs0JcmO96OlIjfs8OgbibLbIXlaXqois5zng" class="img" alt="logo">
                        <ul>
                            <li><a href="#">HOME</a></li>
                            <li><a href="#">ABOUT</a></li>
                            <li><a href="#">EVENTS</a></li>
                            <li><a href="#">GALLERY</a></li>
                            <li><a href="#">CONTANT</a></li>
                            <li><a href="#">BLOG</a></li>
                        </ul>
                    </nav>
                    <div class="content-wrap">
                        
                        <ul class="fly-in-text">
                            <li>W</li>
                            <li>E</li>
                            <li>L</li>
                            <li>C</li>
                            <li>O</li>
                            <li>M</li>
                            <li>E</li>
                            <li>C</li>
                            <li>S</li>
                            <li>M</li>
                            <li>J</li>
                            <li>U</li>
                        </ul>
                        
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
                 </div>
            </div>

        </div>


        <script src="js/app.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript">
            $(function() {
                
                var welcomeSection = $('.welcome-section'),
                    enterButton = welcomeSection.find('.enter-button');
                
                setTimeout(function() {
                    welcomeSection.removeClass('content-hidden');
                }, 500);
                
                enterButton.on('click', function() {
                    e.preventDefault();
                    welcomeSection.addClass('content-hidden').fadeOut();
                });
                
                
            })();  
        </script>
    </body>
</html>