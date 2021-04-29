@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <div class="container">
            <h3 align="center" class="my-4">บันทึกผลคะแนนเป็นรายบุคคล</h3>
            @if (Auth::user()->hasRole('Admin'))

                @if (isset($datas))
                    {!! Form::open(['action' => 'CheckProjectController@SendGrade', 'method' => 'POST ', 'enctype' => 'multipart/form-data']) !!}
                    @foreach ($datas as $key => $rows)
                        <div class="mb-4">
                            <div class="table-responsive table-striped">
                                <h4> {{ $rows[0]->year_term }} </h4>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col">รหัสนักศึกษา</th>
                                            <th scope="col">ชื่อนักศึกษา</th>
                                            <th scope="col">เกรดที่ได้</th>
                                            <th scope="col">ปีการศึกษา</th>
                                            <th scope="col">เลือก</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rows as $key => $row)
                                            <tr>
                                                <th scope="row">{{ $row->std_code }}</th>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->grade }}</td>
                                                <td>{{ $row->year_term }}</td>
                                                <td>{!! Form::checkbox('code_id[]', $row->id,$row->name) !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class=" row justify-content-md-center">
                            <div class="form-group col-xl-4 col-lg-4">
                                <a data-toggle="modal" data-target="#exampleModal" class="my-2 form-control btn btn-primary ">
                                    <span class="text">พิมพ์เอกสาร</span>
                                </a>
                            </div>
                        </div>

                        <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">คุณต้องการให้โครงการ
                                    ไม่ผ่านหรือไม่ ?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    {!! Form::label('note', 'บันทึกอาจารย์ผู้สอน') !!}
                                    {!! Form::text('note', null, ['class' => 'form-control']) !!}
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                <button type="submit" class="btn btn-danger">ยืนยัน</button>

                            </div>
                        </div>
                    </div>
                </div>
                    @endforeach
                    
                    {!! Form::close() !!}

                @else
                    <tr>
                        <td colspan="10">There are no data.</td>
                    </tr>
                @endif

            @endif



        </div>
    </body>

    </html>

@endsection
