@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <div class="container">
            <h3 align="center" class="my-4">แบบฟอร์มให้คะแนน</h3>
            @if (Auth::user()->hasRole('Admin'))
                <div class="mb-4">
                    {{-- {{$datas_std}} --}}
                    <div class="table-responsive table-striped">
                        <table class="table table-bordered table-striped " id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th scope="col">นักศึกษา</th>
                                <th scope="col" colspan="3" >สอบ 50% <br>(เต็ม 30)</th>
                                <th scope="col">สอบ50% ฐานนิยม </th>
                                <th scope="col">คะแนนฝึกงาน</th>
                                <th scope="col">สอบในเวลา</th>
                                <th scope="col" colspan="3" >สอบ100%<br>(เต็ม 40)</th>
                                <th scope="col">สอบ100% ฐานนิยม</th>
                                <th scope="col">เสนอผลงานวิชาการ</th>
                                <th scope="col">คะแนนรวม</th>
                                <th scope="col">เกรด</th>
                                <th scope="col">เลือก</th>
                            </tr>
                            <tbody >
                                <tr>
                                    <th scope="row"></th>
                                    <th scope="row">#1</th>
                                    <th scope="row">#2</th>
                                    <th scope="row">#3</th>
                                    <th scope="row">(30)</th>
                                    <th scope="row">(10)</th>
                                    <th scope="row">(5)</th>
                                    <th scope="row">#1</th>
                                    <th scope="row">#2</th>
                                    <th scope="row">#3</th>
                                    <th scope="row">(40)</th>
                                    <th scope="row">(15)</th>
                                    <th scope="row">(100)</th>
                                    <th scope="row"></th>
                                    <th scope="row"></th>
                                </tr>
                            </tbody>
                            <tbody >
                                {{-- {{$datas_std["6004101301"]}} --}}
                                @if (!empty($datas_std) && $datas_std->count())
                                @foreach ($datas_std as $row)
                                <tr>
                                    <td scope="row">{{$row[0][0]->nick_name}}<br> {{substr($row[0][0]->std_code,-3)}}</td>
                                    <td scope="row">{{$row[0][0]->point_test50}}</td>
                                    <td scope="row">{{$row[1][0]->point_test50}}</td>
                                    <td scope="row">{{$row[2][0]->point_test50}}</td>
                                    <td scope="row">{{$test50 = $row[0][0]->point_test50+$row[1][0]->point_test50+$row[2][0]->point_test50}}</td>
                                    <td>{!! Form::number('Internship_score', null, [ 'class' => 'form-control ']) !!}</td>
                                    <td>{!! Form::number('Test_in_time', null, [ 'class' => 'form-control ']) !!}</td>
                                    <td scope="row">{{$row[0][1]->point_test100}}</td>
                                    <td scope="row">{{$row[1][1]->point_test100}}</td>
                                    <td scope="row">{{$row[2][1]->point_test100}}</td>
                                    <td scope="row">{{$test100 = $row[0][1]->point_test100+$row[1][1]->point_test100+$row[2][1]->point_test100}}</td>
                                    <td> {!! Form::number('presentations', null, [ 'class' => 'form-control ']) !!}</td>
                                    <td scope="row">{{$test50+ $test100}}</td>
                                    <td scope="row">-</td>
                                    <th>{!! Form::checkbox('category_id', 35) !!}</th>
                                </tr>
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
                        {{-- {{$datas_instructor}} --}}
                        @foreach ($datas_instructor as $key =>$item)
                            <p class="col-xl-4 col-lg-4">#{{{$key+1 .' '.$item->Title_name_Instructor.$item->name_Instructor}}}</p>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </body>

    </html>

@endsection
