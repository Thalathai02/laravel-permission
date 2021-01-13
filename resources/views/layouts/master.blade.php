<html>
    <head>
        <title>App Name - @yield('title')</title>
    </head>
    <body>
    
        @if ( Auth::user())
        @section('sidebar')
<<<<<<< HEAD

        <div class="sidebar">
            <ul>
            <li>
                <a href="{{ url('/home') }}">
                    <span class="icon"><i class="fas fa-home" aria-hidden="true"></i></span>
                    <span class="title">{{ __('Home') }}</span>
                </a>
            </li>   
            @if (Auth::user()->hasRole('Admin'))
            <li>
                <a href="/STD">
                    <span class="icon"><i class="fas fa-user-graduate" aria-hidden="true"></i></span>
                    <span class="title">{{ __('Student information') }}</span>
                </a>
            </li>
            <li>
                <a href="/User">
                    <span class="icon"><i class="fas fa-user" aria-hidden="true"></i></span>
                    <span class="title">{{ __('User information') }}</span>
                </a>
            </li>
            <li>
                <a href="/Teacher">
                    <span class="icon"><i class="fas fa-user-tie" aria-hidden="true"></i></span>
                    <span class="title">{{ __('Teacher information') }}</span>
                </a>
            </li>
            <li>
                <a href="/system">
                    <span class="icon"><i class="fas fa-tasks" aria-hidden="true"></i></span>
                    <span class="title">{{ __('system') }}</span>
                </a>
            </li>
            @endif
             @if (Auth::user()->hasRole('Tea'))
                    <a href="/project">{{ __('Projects') }}</a>
                    <a class="nav-link" href="">{{ __('Projects ที่รับผิดชอบ(ประะธาน)') }}</a>
                    <a class="nav-link" href="">{{ __('Projects ที่รับผิดชอบ(กรรมการ)') }}</a>
                    notification
                    <a class="nav-link" href="">{{ __('Notification') }}</a>
                @endif
                @if (Auth::user()->hasRole('Std'))
                    <a href="/project">{{ __('Projects') }}</a>
                    <a class="nav-link" href="">{{ __('Notification') }}</a>
                @endif
            <li>
                <a href="/project">
                    <span class="icon"><i class="fas fa-book" aria-hidden="true"></i></span>
                    <span class="title">{{ __('Projects') }}</span>
                </a>
            </li>
            </ul>
          </div>
          <div class="toggle" onclick="toggleMenu()"></div>
          <script type="text/javascript">
            function toggleMenu(){
                let sidebar = document.querySelector('.sidebar');
                let toggle = document.querySelector('.toggle');
                sidebar.classList.toggle('active');
                toggle.classList.toggle('active');
                }
                </script>
=======
        
        <div class="sidebar">
            <a class="nav-item" href="{{ url('/home') }}">{{ __('Home') }}</a>
            @if (Auth::user()->hasRole('Admin'))
                <a class="nav-link" href="/STD">{{ __('Student information') }}</a>
                <a class="nav-link" href="/User">{{ __('User information') }}</a>
                <a class="nav-link" href="/Teacher">{{ __('Teacher information') }}</a>
                <a class="nav-link" href="/system">{{ __('system') }}</a>
            @endif
            <a href="/project">{{ __('Projects') }}</a>
          </div>
>>>>>>> parent of 060ada9... เพิ่มรายงานความคืบหน้า
        @show
        <div class="content py-4">
            <main >
                @yield('content')
            </main>
        </div>
        @else
            <div class="py-4">
            <main >
                @yield('content')
                
            </main>
        </div>
        @endif
    </body>
</html>