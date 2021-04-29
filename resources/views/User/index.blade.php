@extends('layouts.app')
@section('content')

    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">User information in Laravel</h3>
            <br />


            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            {!! Form::open(['action' => 'UserController@show', 'method' => 'POST']) !!}
            {{ csrf_field() }}
            <div class="form-group col">
                {!! Form::label('Search', 'ค้นหา', ['class' => 'form-group']) !!}
                {!! Form::text('Search', null, ['class' => 'form-group col-6']) !!}
                <input type="submit" value="ค้นหา" class="btn btn-primary  " name="" id="">
            </div>
            {!! Form::close() !!}
            <br />
            <div class="mb-4">
                <div class="table-responsive table-striped">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">User</th>
                                <th scope="col">ชื่อ</th>
                                <th scope="col">อีเมล</th>
                                <th scope="col">แก้ไข</th>
                                <th scope="col">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($data) && $data->count())
                                @foreach ($data as $row)
                                    <tr>
                                        <td scope="row">{{ $row->username }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td><a href="{{ route('User.edit', $row->id) }}" class="btn btn-success">แก้ไข</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('User.destroy', $row->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <input type="submit" value="ลบ" data-name="{{ $row->name }}"
                                                    class="btn btn-danger deleteForm">
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">There are no data.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {!! $data->links() !!}
                </div>
            </div>
        </div>
    </body>

    </html>

@endsection
