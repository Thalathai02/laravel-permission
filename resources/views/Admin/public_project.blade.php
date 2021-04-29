@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <div class="container">
            <h3 align="center" class="my-4">ระบบ</h3>
            @if (Auth::user()->hasRole('Admin'))

               

            @endif



        </div>
    </body>

    </html>

@endsection
