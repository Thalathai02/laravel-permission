<html>
    <head>
        <title>App Name - @yield('title')</title>
    </head>
    <body>
        @if ( Auth::user())
        @section('sidebar')
        <div class="sidebar">
            <a class="nav-item" href="{{ url('/home') }}">{{ __('Home') }}</a>
            @if (Auth::user()->hasRole('Admin'))
            <li class="nav-item">
                <a class="nav-link" href="/STD">{{ __('Student information') }}</a>
            </li>
            @endif
          </div>
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