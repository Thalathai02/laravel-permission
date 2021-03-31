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
                        <div class="table-responsive table-striped mb-4">
                            @foreach ($datas_std as $key => $row_data)
                                {{-- <h3>ปีการศึกษา {{$row_data[0][0]->nick_name}}</h3> --}}
                                <table class="table table-bordered table-striped " id="dataTable" width="100%"
                                    cellspacing="0">
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

                                    <tbody class="searchTable">
                                        {{-- {{$datas_std["6004101301"]}} --}}
                                        @if (!empty($datas_std) && $datas_std->count())
                                            @foreach ($row_data as $key => $row)
                                                <tr>
                                                    <td scope="row">{{ $row[0][0]->nick_name }}<br>
                                                        {{ substr($row[0][0]->std_code, -3) }}</td>
                                                    {{-- <td scope="row">{{ $row[0][0]->point_test50 }}</td>
                                                <td scope="row">{{ $row[1][0]->point_test50 }}</td>
                                                <td scope="row">{{ $row[2][0]->point_test50 }}</td> --}}
                                                    {{-- <td scope="row">{{$test50 = ($row[0][0]->point_test50+$row[1][0]->point_test50+$row[2][0]->point_test50)/3}}</td> --}}
                                                    <td>{!! Form::number('test50[]', $test50 = round(($row[0][0]->point_test50 + $row[1][0]->point_test50 + $row[2][0]->point_test50) / 3), ['id' => 'test50', 'readonly', 'class' => 'test50 form-control ']) !!}</td>
                                                    <td>{!! Form::number('Internship_score[]', null, ['class' => 'form-control Internship_score']) !!}</td>
                                                    <td>{!! Form::number('Test_in_time[]', null, ['class' => 'form-control Test_in_time']) !!}</td>
                                                    {{-- <td scope="row">{{ $row[0][1]->point_test100 }}</td>
                                                <td scope="row">{{ $row[1][1]->point_test100 }}</td>
                                                <td scope="row">{{ $row[2][1]->point_test100 }}</td> --}}
                                                    <td>{!! Form::number('test100[]', $test100 = round(($row[0][1]->point_test100 + $row[1][1]->point_test100 + $row[2][1]->point_test100) / 3), ['readonly', 'class' => 'test100 form-control ']) !!}</td>
                                                    {{-- <td scope="row">{{$test100 = ($row[0][1]->point_test100+$row[1][1]->point_test100+$row[2][1]->point_test100)/3}}</td> --}}
                                                    <td> {!! Form::number('presentations[]', null, ['class' => 'form-control presentations']) !!}</td>
                                                    <td scope="row"><div class="net-profit"></td>
                                                    <td scope="row"><div class="grade"></div> </td>
                                                    <th>{!! Form::checkbox('code_id[]', $row[0][0]->std_code) !!}</th>
                                                </tr>

                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="15">There are no data.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            @endforeach
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
        <script>
            $('.test50, .Internship_score , .Test_in_time , .test100 ,.presentations').on('blur', function(e) {
                var row = $(this).closest('tr');
                var Internship_score = $('.Internship_score', row),
                    test50 = $('.test50', row),
                    Test_in_time = $('.Test_in_time', row),
                    test100 = $('.test100', row),
                    presentations = $('.presentations', row),
                    grade = $('.grade',row),
                    net_profit = $('.net-profit', row);


                Internship_score = Number(Internship_score.val());
                test50 = Number(test50.val());
                Test_in_time = Number(Test_in_time.val());
                test100 = Number(test100.val());
                presentations = Number(presentations.val());


                if (!isNaN(test50) && !isNaN(Internship_score)) {
                    net_profit.text((test50 + Internship_score + Test_in_time + test100 + presentations));
                    
                }
                var go = Number(test50 + Internship_score + Test_in_time + test100 + presentations);
                if(go >= 80){
                    grade.text('A');
                }
                else if (go >=75){
                    grade.text('B+');
                }
                else if (go >=70){
                    grade.text('B');
                }
                else if (go >=65 ){
                    grade.text('c+');
                }
                else if (go >=60 ){
                    grade.text('c');
                }
            });

        </script>
    </body>


    </html>

@endsection
