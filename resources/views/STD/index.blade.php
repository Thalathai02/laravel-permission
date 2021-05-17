@extends('layouts.app')
@section('content')

    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center">Import Student information in Database</h3>
            <br />


            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            {!! Form::open(['action' => 'ImportExcel\ImportExcelController@show', 'method' => 'POST']) !!}
            {{ csrf_field() }}
            
                <div class="row justify-content-md-center mb-4">
                    <div class="col-xl-1 col-lg-1">
                        {!! Form::label('Search', 'ค้นหา', ['class' => 'form ']) !!}
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        {!! Form::text('Search', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-xl-4 col-lg-4 ">
                        <button type="submit" class="btn btn-primary " name="submit_1" id="">ค้นหา</button>
                    </div>
                </div>

            {!! Form::close() !!}

            {!! Form::open(['action' => 'ImportExcel\ImportExcelController@import', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            {{ csrf_field() }}
           

                <div class="row justify-content-md-center">
                    <div class="col-xl-2 col-lg-2">
                        {!! Form::label('subject_id', 'ปีการศึกษา:') !!}
                    </div>
                    <div class="col-xl-2 col-lg-2">
                        {!! Form::select('subject', $term,  ['class' => 'md-6 form-select']) !!}
                    </div>
                    <div class="col-xl-2 col-lg-2">
                        <a href="/STD/term/create" class="btn btn-primary">เพิ่มปีการศึกษา</a>
                    </div>

                </div>
          
            <div class="row my-4">
                <div class="row justify-content-md-center" align="center">
                    <div class="col-xl-5 col-lg-5 my-2">
                        {!! Form::file($name ?? 'import_file', ['class' => 'form-control ']) !!}
                    </div>

                    <input align="center" type="submit" value="อัพโหลด" class="btn btn-primary my-2 col-xl-1 col-lg-1"
                        name="submit_2" id="">

                    <span>----- หรือ -----</span>

                    <a align="center" href="/STD/create" class="btn btn-primary my-2 col-xl-1 col-lg-1">เพิ่มข้อมูล</a>

                </div>
            </div>


            {!! Form::close() !!}

            <br />
            <div class="mb-4">
                <div class="table-responsive table-striped">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th scope="col">รหัส</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">อีเมล</th>
                            <th scope="col">เบอร์โทร</th>
                            <th scope="col">ปีการศึกษา</th>
                            <th scope="col">หมายเหตุ</th>
                            <th scope="col">ดูข้อมูล</th>
                            <th scope="col">แก้ไข</th>
                            <th scope="col">ลบ</th>
                        </tr>
                        <tbody>
                            {{-- {{ $data }} --}}
                            @if (!empty($data) && $data->count())
                                @foreach ($data as $row)
                                    <tr>
                                        <td scope="row">{{ $row->std_code }}</td>
                                        <td scope="row">{{ $row->name }}</td>
                                        <td scope="row">{{ $row->email }}</td>
                                        <td scope="row">{{ $row->phone }}</td>
                                        <td scope="row">{{ $row->year_term }}</td>
                                        <td scope="row">{{ $row->note }}</td>
                                        <td scope="row"><a href="{{ route('std.showinfo', $row->id) }}"
                                                class="btn btn-primary">ดูข้อมูล</a></td>
                                        <td scope="row"><a href="{{ route('STD.edit', $row->id) }}"
                                                class="btn btn-success">แก้ไข</a></td>
                                        <td scope="row">
                                            <form action="{{ route('STD.destroy', $row->id) }}" method="POST">
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
        <scripts>

        </scripts>
    </body>

    </html>

@endsection
