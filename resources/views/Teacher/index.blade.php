@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">Teacher information in Database</h3>
            <br />


            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            {{-- {!! Form::open(['action' => 'ImportExcel\ImportExcelController@show', 'method' => 'POST']) !!}
            <div class="form-group col">
                {!! Form::label('Search', 'ค้นหา', ['class' => 'form-group']) !!}
                {!! Form::text('Search', null, ['class' => 'form-group col-6']) !!}
                <input type="submit" value="ค้นหา" class="btn btn-primary  " name="" id="">
            </div>
            {!! Form::close() !!} --}}

            <a href="/Teacher/create" class="btn btn-primary my-2" align="left">เพิ่มข้อมูล</a>


            <br />
            <div class="mb-4">
              <div class="table-responsive table-striped">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">ชื่อ</th>
                        <th scope="col">อีเมล</th>
                        <th scope="col">เบอร์โทร</th>
                        <th scope="col">ดูข้อมูล</th>
                        <th scope="col">แก้ไข</th>
                        <th scope="col">ลบ</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $key =>$row)
                        <tr>
                            <td scope="row">{{ $key+1  }}</td>
                            <td>{{ $row->Title_name_Instructor }}{{ $row->name_Instructor }}</td>
                            <td>{{ $row->email_Instructor }}</td>
                            <td>{{ $row->phone_Instructor }}</td>
                            <td><a href="{{ route('Teacher.info_tea', $row->id) }}" class="btn btn-info">ดูข้อมูล</a></td>
                            <td><a href="{{ route('Teacher.edit', $row->id) }}" class="btn btn-success">แก้ไข</a></td>
                            <td>
                                <form action="{{ route('Teacher.destroy', $row->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <input type="submit" value="ลบ" data-name="{{ $row->name }}"
                                        class="btn btn-danger deleteForm">
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
        </div>
    </body>

    </html>

@endsection
