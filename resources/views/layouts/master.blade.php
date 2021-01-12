<html>

<head>
    <title>App Name - @yield('title')</title>
</head>

<body>

    @if (Auth::user())
        @section('sidebar')

            <div class="sidebar">
                <a class="nav-item" href="{{ url('/home') }}">{{ __('Home') }}</a>
                @if (Auth::user()->hasRole('Admin'))
                    <a class="nav-link" href="/STD">{{ __('Student information') }}</a>
                    <a class="nav-link" href="/User">{{ __('User information') }}</a>
                    <a class="nav-link" href="/Teacher">{{ __('Teacher information') }}</a>
                    <a class="nav-link" href="/system">{{ __('system') }}</a>
                    <a href="/project">{{ __('Projects') }}</a>
                    <a class="nav-link" href="">{{ __('Notification') }}</a>
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

            </div>
        @show
        <div class="content py-4">
            <main>
                @yield('content')
            </main>
        </div>
    @else
        <div class="py-4">
            <main>
                @yield('content')

            </main>
        </div>
    @endif
</body>

</html>
