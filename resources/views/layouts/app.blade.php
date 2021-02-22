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
    {{-- <script src="{{ asset('js/login.js') }}" defer></script> --}}
    <script src="{{ asset('js/sb-admin-2.min.js')}}" ></script>
    <script src="{{ asset('js/sb-admin-2.js') }}" ></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css" integrity="sha512-kJ30H6g4NGhWopgdseRb8wTsyllFUYIx3hiUwmGAkgA9B/JbzUBDQVr2VVlWGde6sdBVOG7oU8AL35ORDuMm8g==" crossorigin="anonymous" />
  <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Custom fonts for this template-->
    <link href="{{ asset("vendor/fontawesome-free/css/all.min.css") }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
   
    <body id="page-top">
       @if (Auth::user())  
        
        <!-- Page Wrapper -->
        <div id="wrapper">
    
         <!-- Sidebar -->
         <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
             <!-- Sidebar - Brand -->
             <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                 <div class="sidebar-brand-icon rotate-n-15">
                     <i class="fas fa-laugh-wink"></i>
                 </div>
                 <div class="sidebar-brand-text mx-3">Csmju Project </div>
             </a>
    
             <!-- Divider -->
             <hr class="sidebar-divider my-0">
    
             <!-- Nav Item - Dashboard -->
             <li class="nav-item active">
                 <a class="nav-link" href="{{ url('/home') }}">
                     <i class="fas fa-fw fa-tachometer-alt"></i>
                     <span>Dashboard</span></a>
             </li>
             @if (Auth::user()->hasRole('Admin'))
             <!-- Divider -->
             <hr class="sidebar-divider">
    
             <!-- Heading -->
             <div class="sidebar-heading">
                Administrator
             </div>
    
             <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item">
                 <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                     aria-expanded="true" aria-controls="collapseTwo">
                     <i class="fas fa-fw fa-cog"></i>
                     <span>จัดการผู้ใช้</span>
                 </a>
                 <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                         <h6 class="collapse-header">รายชื่อ:</h6>
                         <a class="collapse-item" href="/STD">{{ __('Student information') }}</a>
                         <a class="collapse-item" href="/User">{{ __('User information') }}</a>
                         <a class="collapse-item"href="/Teacher">{{ __('Teacher information') }}</a>
                     </div>
                 </div>
             </li>
    
             <!-- Nav Item - Utilities Collapse Menu -->
             <li class="nav-item">
                 <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                     aria-expanded="true" aria-controls="collapseUtilities">
                     <i class="fas fa-fw fa-wrench"></i>
                     <span>System</span>
                 </a>
                 <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                     data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                         <h6 class="collapse-header">Custom system:</h6>
                         <a class="collapse-item" href="/system">{{ __('system') }}</a>
                         
                     </div>
                 </div>
             </li>
           
             <!-- Divider -->
             <hr class="sidebar-divider">
            
             <!-- Heading -->
             <div class="sidebar-heading">
                จัดการโปรเจด
             </div>
             
             <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item">
                 <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                     aria-expanded="true" aria-controls="collapsePages">
                     <i class="fas fa-fw fa-folder"></i>
                     <span>โปรเจค</span>
                 </a>
                 <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                         <h6 class="collapse-header">Login Screens:</h6>
                         <a class="collapse-item" href="/project">{{ __('โปรเจด') }}</a>
                         <a class="collapse-item" href="/projects/into_project">เพิ่มโปรเจค</a>
                         <a class="collapse-item" href="/Check_Project">ตรวจโปรเจค</a>
                         
                     </div>
                 </div>
             </li>
             
            @endif
            @if (Auth::user()->hasRole('Std'))
        
            <!-- Divider -->
            <hr class="sidebar-divider">
           
            <!-- Heading -->
            <div class="sidebar-heading">
               จัดการโปรเจด
            </div>
            
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>โปรเจค</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="/project">{{ __('โปรเจด') }}</a>
                        
                    </div>
                </div>
            </li>
           @endif
           @if (Auth::user()->hasRole('Tea'))
        
            <!-- Divider -->
            <hr class="sidebar-divider">
           
            <!-- Heading -->
            <div class="sidebar-heading">
               จัดการโปรเจด
            </div>
            
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>โปรเจค</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="/project">{{ __('โปรเจด') }}</a> 
                        <h6 class="collapse-header">Project Advisor:</h6> 
                        <a class="collapse-item" href="/president">{{ __('โปรเจดที่เป็นประธาน') }}</a>  
                        <a class="collapse-item" href="/director">{{ __('โปรเจดที่เป็นกรรมการ') }}</a>   
                        <a class="collapse-item" href="/comment_test50">{{ __('ประเมินสอบ 50') }}</a> 
                        <a class="collapse-item" href="">{{ __('ประเมินสอบ 100') }}</a>                   
                    </div>
                </div>
            </li>
           
           @endif
             <!-- Divider -->
             <hr class="sidebar-divider d-none d-md-block">
            
             <!-- Sidebar Toggler (Sidebar) -->
             <div class="text-center d-none d-md-inline">
                 <button class="rounded-circle border-0" id="sidebarToggle"></button>
             </div>
    
            
    
         </ul>
         <!-- End of Sidebar -->
    
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
    
             <!-- Main Content -->
             <div id="content">
    
                 <!-- Topbar -->
                 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    
                     <!-- Sidebar Toggle (Topbar) -->
                     <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                         <i class="fa fa-bars"></i>
                     </button>
    
                   
                     <!-- Topbar Navbar -->
                     <ul class="navbar-nav ml-auto">
    
                   
    
                         

                         @if (Auth::user()->hasRole('Std'))
                         {{-- {{ count(Auth::user()->notifications)}} --}}
                         <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                @if( count(Auth::user()->unreadNotifications) !== 0)
                                    <span class="badge badge-danger badge-counter">+{{ count(Auth::user()->unreadNotifications)}}</span>
                                 @else
                                 @endif
                            </a>
                            
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                @foreach(Auth::user()->unreadNotifications as $key => $value)                      
                                {{-- <a href="">{{$value->data['read_notification']}}</a> --}}                                             
                                     <a class="dropdown-item d-flex align-items-center" href="{!! route('InfoWordTemplate.checkForm',['form'=>$value->data['form'],'formId'=>$value->data['form_id'],'id_Notifications'=>$value->id]) !!}">
                                         <div class="mr-3">
                                             <div class="icon-circle bg-primary">
                                                 <i class="fas fa-file-alt text-white"></i>
                                             </div>
                                         </div>
                                         <div>
                                             <div class="small text-gray-500">{{$value->created_at}}</div>
                                             <span class="font-weight-bold">{{$value->data['userseed']['name']}} <br>
                                            </span>
                                            <span class="font-weight">
                                                {{$value->data['Title_form']}}
                                            </span>
                                         </div>
                                     </a>
                                     @endforeach
                                <a class="dropdown-item text-center small text-gray-500" href="{!! route('index.index') !!}" >Show All Alerts</a>
                            </div>
                        </li>
                         @endif
                        
                         @if (Auth::user()->hasRole('Admin'))
                         {{-- {{ count(Auth::user()->notifications)}} --}}
                
                         <!-- Nav Item - Alerts -->
                         <li class="nav-item dropdown no-arrow mx-1">
                             <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-bell fa-fw"></i>
                                 <!-- Counter - Alerts -->
                                 @if( count(Auth::user()->unreadNotifications) !== 0)
                                 <span class="badge badge-danger badge-counter">+{{ count(Auth::user()->unreadNotifications)}}</span>
                              @else
                             @endif
                             </a>
                             <!-- Dropdown - Alerts -->
                             <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="alertsDropdown">
                                 <h6 class="dropdown-header">
                                     Alerts Center
                                 </h6>
                                 @foreach(Auth::user()->unreadNotifications as $key => $value)                      
                            {{-- <a href="">{{$value->data['read_notification']}}</a> --}}                                             
                                 <a class="dropdown-item d-flex align-items-center"  href="{!! route('InfoWordTemplate.checkForm',['form'=>$value->data['form'],'formId'=>$value->data['form_id'],'id_Notifications'=>$value->id]) !!}">
                                     <div class="mr-3">
                                         <div class="icon-circle bg-primary">
                                             <i class="fas fa-file-alt text-white"></i>
                                         </div>
                                     </div>
                                     <div>
                                         <div class="small text-gray-500">{{$value->created_at}}</div>
                                         <span class="font-weight-bold">{{$value->data['userseed']['name']}} <br>
                                        </span>
                                        <span class="font-weight">
                                            {{$value->data['Title_form']}}
                                        </span>
                                     </div>
                                 </a>
                                 @endforeach
                                 <a class="dropdown-item text-center small text-gray-500" href="{!! route('index.index') !!}" >Show All Alerts</a>
                             </div>
                         </li>
                         @endif
                         @if (Auth::user()->hasRole('Tea'))
                         {{-- {{ count(Auth::user()->notifications)}} --}}
                         
                         <!-- Nav Item - Alerts -->
                         <li class="nav-item dropdown no-arrow mx-1">
                             <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-bell fa-fw"></i>
                                 <!-- Counter - Alerts -->
                                 @if( count(Auth::user()->unreadNotifications) !== 0)
                                 <span class="badge badge-danger badge-counter">+{{ count(Auth::user()->unreadNotifications)}}</span>
                              @else
                             @endif
                             </a>
                             
                             <!-- Dropdown - Alerts -->
                             <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="alertsDropdown">
                                 <h6 class="dropdown-header">
                                     Alerts Center
                                 </h6>
                                 @foreach(Auth::user()->unreadNotifications as $key => $value)                      
                            {{-- <a href="">{{$value->data['read_notification']}}</a> --}}                                             
                                 <a class="dropdown-item d-flex align-items-center" href="{!! route('InfoWordTemplate.checkForm',['form'=>$value->data['form'],'formId'=>$value->data['form_id'],'id_Notifications'=>$value->id]) !!}">
                                     <div class="mr-3">
                                         <div class="icon-circle bg-primary">
                                             <i class="fas fa-file-alt text-white"></i>
                                         </div>
                                     </div>
                                     <div>
                                         <div class="small text-gray-500">{{$value->created_at}}</div>
                                         <span class="font-weight-bold">{{$value->data['userseed']['name']}} <br>
                                        </span>
                                        <span class="font-weight">
                                            {{$value->data['Title_form']}}
                                        </span>
                                     </div>
                                 </a>
                                 @endforeach
                                 <a class="dropdown-item text-center small text-gray-500" href="{!! route('index.index') !!}" >Show All Alerts</a>
                             </div>
                         </li>
                         @endif
    
                         <div class="topbar-divider d-none d-sm-block"></div>
                         @if (Auth::user()->hasRole('Admin'))
                         <!-- Nav Item - User Information -->
                         <li class="nav-item dropdown no-arrow">
                             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->name }}{{__(' (Administration)')}}</span>
                                 <img class="img-profile rounded-circle"
                                 src="{{ asset("img/undraw_profile.svg")}}">
                             </a>
                             <!-- Dropdown - User Information -->
                             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdown">
                                
                                 <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                  {{ __('Logout') }}
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                             </div>
                         </li>
                         @endif
                         @if (Auth::user()->hasRole('Std'))
                         <!-- Nav Item - User Information -->
                         <li class="nav-item dropdown no-arrow">
                             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}{{__(' (student)')}}</span>
                                 <img class="img-profile rounded-circle"
                                 src="{{ asset("img/undraw_profile.svg")}}">
                             </a>
                             <!-- Dropdown - User Information -->
                             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdown">
                                 <a class="dropdown-item" href="{{route('User.edit', Auth::user()->id)}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('จัดการผู้ใช้') }}
                                </a>
                                <a class="dropdown-item"  href="{{route('STD.edit', Auth::user()->reg_std_id)}}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('จัดการข้อมูลการติดต่อ') }}
                                </a>
                                 <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                  {{ __('Logout') }}
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                             </div>
                         </li>
                         @endif
                         @if (Auth::user()->hasRole('Tea'))
                         <!-- Nav Item - User Information -->
                         <li class="nav-item dropdown no-arrow">
                             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}{{__(' (instructor)')}}</span>
                                 <img class="img-profile rounded-circle"
                                 src="{{ asset("img/undraw_profile.svg")}}">
                             </a>
                             <!-- Dropdown - User Information -->
                             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdown">
                                 <a class="dropdown-item" href="{{route('User.edit', Auth::user()->id)}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('จัดการผู้ใช้') }}
                                </a>
                                <a class="dropdown-item"  href="{{route('Teacher.edit', Auth::user()->reg_tea_id)}}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('จัดการข้อมูลการติดต่อ') }}
                                </a>
                                 <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                  {{ __('Logout') }}
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                             </div>
                         </li>
                         @endif
                     </ul>
    
                 </nav>
                 <!-- End of Topbar -->
    
                 <!-- Begin Page Content -->
                 <div class="container-fluid">
                     <div class="content py-4">
                         <main>
                            @if (count($errors) > 0)
                            <div aria-live="polite" aria-atomic="true" class="position-relative ">
                                <!-- Position it: -->
                                <!-- - `.toast-container` for spacing between toasts -->
                                <!-- - `.position-absolute`, `top-0` & `end-0` to position the toasts in the upper right corner -->
                                <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
                                <div class="toast-container position-absolute top-0 end-0 p-3">
                       
                                    <!-- Then put toasts within -->
                                    <div class="toast alert alert-danger" role="alert" aria-live="assertive" aria-atomic="true">
                                        <div class="toast-header">
                                            <span class="icon"><i class="fas fa-user-tie" aria-hidden="true"></i></span>
                                            <strong class="me-auto danger">Error</strong>
                                            <small class="text-muted">just now</small>
                                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                        </div>
                                        <div class="toast-body">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </div>
                                    </div>
                       
                                </div>
                            </div>
                        @endif
                             @yield('content')
                         </main>
                     </div>
    
                 </div>
                 <!-- /.container-fluid -->
    
             </div>
             <!-- End of Main Content -->
    
             <!-- Footer -->
             <footer class="sticky-footer bg-white">
                 <div class="container my-auto">
                     <div class="copyright text-center my-auto">
                         <span>Copyright &copy; CSMJU 2020</span>
                     </div>
                 </div>
             </footer>
             <!-- End of Footer -->
    
         </div>
         <!-- End of Content Wrapper -->
    
     </div>
     <!-- End of Page Wrapper -->
    
     <!-- Scroll to Top Button-->
     <a class="scroll-to-top rounded" href="#page-top">
         <i class="fas fa-angle-up"></i>
     </a>
    
     <!-- Logout Modal-->
     <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                     <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>
                 <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                 <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                     <a class="btn btn-primary" href="login.html">Logout</a>
                 </div>
             </div>
         </div>
     </div>
     @else
        <div class="py-4">
            <main>
                @yield('content')
            </main>
        </div>
     @endif
 
<script>
 $(document).ready(function() {
     $('.toast').toast('show');
 });

</script>
<link href="{{ asset("vendor/fontawesome-free/css/all.min.css") }}" rel="stylesheet" type="text/css">
   <!-- Bootstrap core JavaScript-->
   <script href="{{ asset("vendor/jquery/jquery.min.js") }}"></script>
   <script href="{{ asset("vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>

   <!-- Core plugin JavaScript-->
   <script href="{{ asset("vendor/jquery-easing/jquery.easing.min.js") }}"></script>

   <!-- Custom scripts for all pages-->
   {{-- <script href="{{ asset("js/sb-admin-2.min.js") }}"></script> --}}
  
   <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sb-admin-2.min.js')}}" ></script>
    <script src="{{ asset('js/sb-admin-2.js') }}" ></script>
    </body>
   
</html>
