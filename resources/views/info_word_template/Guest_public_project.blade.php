<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CSMJU PROJECT</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/bonus.js') }}" defer></script>
    <script src="{{ asset('js/Project.js') }}" defer></script>
    {{-- <script src="{{ asset('js/login.js') }}" defer></script> --}}
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css"
        integrity="sha512-kJ30H6g4NGhWopgdseRb8wTsyllFUYIx3hiUwmGAkgA9B/JbzUBDQVr2VVlWGde6sdBVOG7oU8AL35ORDuMm8g=="
        crossorigin="anonymous" />
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body>


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

            <nav class="main-nav navbar navbar-expand-md navbar-light fixed-top bg-light ">
                <a href="/"><img src="{{ asset('css/assets/images/ezgif.com-gif-maker.gif') }}"
                        style="width: 50%;"></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    @if (Route::has('login'))
                        @auth
                            <a class="nav-link" href="{{ url('/home') }}">Dashboard</a>
                        @else
                            <a class="nav-link" href="{{ route('login') }}">Sign in</a>
                        @endauth
                    @endif

                </div>
            </nav>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->


    <!-- ***** Welcome Area Start ***** -->

    <main>
        <br><br><br><br><br><br>
        <div class="mt-8">
            <div class="container ">

                <div class="form-group">
                    {!! Form::open(['action' => 'PublicProjectController@search_Guest_public_projec', 'method' => 'POST']) !!}
                    <div class="row ">
                        {{ csrf_field() }}
                        <div class="col-1">
                            {!! Form::label('search', 'ค้นหา') !!}
                        </div>
                        <div class="col-4">
                            {!! Form::text('search', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-2">
                            <input type="submit" value="ค้นหา" class="btn btn-primary" name="submit_1" id="">
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                @if (isset($project))

                    @foreach ($project as $key => $row)
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">{{ $row->name_th }}</h6>
                                <h6 class="m-0 font-weight-bold text-primary">{{ $row->name_en }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="">
                                    </div>
                                    <div class="col">
                                        <p>{{ \Illuminate\Support\Str::limit($row->abstract_th, $limit = 200, $end = '...') }}
                                        </p>
                                        <p><strong>รหัสโครงงาน : </strong>{{ $row->number_project }}</p>
                                        <p><strong> สถานะ : </strong>{{ $row->status }}</p>
                                        <p><strong>คำสำคัญ : </strong>{{ $row->keyword_th }}</p>
                                        <p><strong>Keywords : </strong>{{ $row->keyword_eng }}</p>

                                        <a target="_blank" rel="nofollow"
                                            href="{{ route('PublicProject.view_public_projec', $row->id) }}">ดูเอกสาร
                                            &rarr;</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {!! $project->links() !!}
                @else
                    <p>There are no data.</p>
                @endif


            </div>
        </div>
    </main>




    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; CSMJU 2020</span>
            </div>
        </div>
    </footer>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Bootstrap core JavaScript-->
    <script href="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script href="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script href="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    {{-- <script href="{{ asset("js/sb-admin-2.min.js") }}"></script> --}}

    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


</body>

</html>
