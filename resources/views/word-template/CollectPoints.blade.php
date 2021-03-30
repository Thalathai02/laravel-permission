@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <div class="container">
            <h3 align="center" class="my-4">แบบฟอร์มให้คะแนน</h3>
            @if (Auth::user()->hasRole('Admin'))

                <form action="{{ route('projectControllers.wordExport_CollectPoints', $datas[0]->id) }}" method="POST">
                    @csrf @method('POST')
                    <div class="mb-4">
                        {{-- {{$datas_std}} --}}
                        <div class="table-responsive table-striped">
                            <table class="table table-bordered table-striped " id="dataTable" width="100%" cellspacing="0">
                                <tr>
                                    <th scope="col">นักศึกษา</th>
                                    <th scope="col">สอบ50% ฐานนิยม </th>
                                    <th scope="col">คะแนนฝึกงาน</th>
                                    <th scope="col">สอบในเวลา</th>
                                    <th scope="col">สอบ100% ฐานนิยม</th>
                                    <th scope="col">เสนอผลงานวิชาการ</th>
                                    <th scope="col">คะแนนรวม</th>
                                    <th scope="col">เกรด</th>
                                    <th scope="col">เลือก</th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <th scope="row">(30)</th>
                                        <th scope="row">(10)</th>
                                        <th scope="row">(5)</th>
                                        <th scope="row">(40)</th>
                                        <th scope="row">(15)</th>
                                        <th scope="row">(100)</th>
                                        <th scope="row"></th>
                                        <th scope="row"></th>
                                    </tr>
                                </tbody>
                                <tbody>
                                    {{-- {{$datas_std["6004101301"]}} --}}
                                    @if (!empty($datas_std) && $datas_std->count())
                                        @foreach ($datas_std as $row)
                                            <tr>
                                                <td scope="row">{{ $row[0][0]->nick_name }}<br>
                                                    {{ substr($row[0][0]->std_code, -3) }}</td>
                                                {{-- <td scope="row">{{$row[0][0]->point_test50}}</td>
                                    <td scope="row">{{$row[1][0]->point_test50}}</td>
                                    <td scope="row">{{$row[2][0]->point_test50}}</td> --}}
                                                {{-- <td scope="row">{{$test50 = ($row[0][0]->point_test50+$row[1][0]->point_test50+$row[2][0]->point_test50)/3}}</td> --}}
                                                <td>{!! Form::label('test50', $test50 = round(($row[0][0]->point_test50 + $row[1][0]->point_test50 + $row[2][0]->point_test50) / 3)) !!}</td>
                                                <td>{!! Form::number('Internship_score[]', null, ['class' => 'form-control ','id'=>'test']) !!}</td>
                                                <td>{!! Form::number('Test_in_time[]', null, ['class' => 'form-control ']) !!}</td>
                                                {{-- <td scope="row">{{$row[0][1]->point_test100}}</td>
                                    <td scope="row">{{$row[1][1]->point_test100}}</td>
                                    <td scope="row">{{$row[2][1]->point_test100}}</td> --}}
                                                <td>{!! Form::label('test100', $test100 = round(($row[0][1]->point_test100 + $row[1][1]->point_test100 + $row[2][1]->point_test100) / 3)) !!}</td>
                                                {{-- <td scope="row">{{$test100 = ($row[0][1]->point_test100+$row[1][1]->point_test100+$row[2][1]->point_test100)/3}}</td> --}}
                                                <td> {!! Form::number('presentations[]', null, ['class' => 'form-control ']) !!}</td>
                                                <td scope="row">{{ $test50 + $test100 }}</td>
                                                <td scope="row">-</td>
                                                <th>{!! Form::checkbox('code_id[]', $row[0][0]->std_code) !!}</th>
                                            </tr>
                                            <script>
                                                console.log({{$test100}});
                                            </script>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="15">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-lg-4">
                                {{-- <a href="" class="btn btn-success">ยืนยันการลงคะแนน</a> --}}
                                <input type="submit" value="ยืนยันการลงคะแนน" data-name="" class="btn btn-danger">
                            </div>
                        </div>
                    </div>
                </form>
               
            @endif
        </div>
       
    </body>


    </html>

@endsection
