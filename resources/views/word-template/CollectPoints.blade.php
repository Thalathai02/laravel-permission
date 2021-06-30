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
                                        <th scope="col" colspan="3">สอบ 50% <br>(เต็ม 30)</th>
                                        <th scope="col">สอบ50% ฐานนิยม </th>
                                        <th scope="col">คะแนนฝึกงาน</th>
                                        <th scope="col">สอบในเวลา</th>
                                        <th scope="col" colspan="3">สอบ100%<br>(เต็ม 40)</th>
                                        <th scope="col">สอบ100% ฐานนิยม</th>
                                        <th scope="col">เสนอผลงานวิชาการ</th>
                                        <th scope="col">คะแนนรวม</th>
                                        <th scope="col">เกรด</th>
                                        <th scope="col">เลือก</th>
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">#1</th>
                                            <th scope="col">#2</th>
                                            <th scope="col">#3</th>
                                            <th scope="col">({{$data_subject->test50}})</th>
                                            <th scope="col">({{$data_subject->Internship_score}})</th>
                                            <th scope="col">({{$data_subject->Test_in_time}})</th>
                                            <th scope="col">#1</th>
                                            <th scope="col">#2</th>
                                            <th scope="col">#3</th>
                                            <th scope="col">({{$data_subject->test100}})</th>
                                            <th scope="col">({{$data_subject->presentations}})</th>
                                            <th scope="col">({{$data_subject->test50 + $data_subject->Internship_score +$data_subject->Test_in_time +$data_subject->test100 +$data_subject->presentations}})</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </tbody>

                                    <tbody class="searchTable">
                                        {{$data_subject}}

                                        @if ($have_CollectPoints != '[]')
                                            @if (!empty($datas_std) && $datas_std->count())
                                                @foreach ($row_data as $key => $row)
                                                    <tr>
                                                        @foreach ($have_CollectPoints as $key => $CollectPoints)
                                                            {{-- {{ $CollectPoints->reg_id_collect_points }} --}}
                                                            {{-- {{ $row[0][0]->id }} --}}
                                                            @if ($CollectPoints != null)
                                                                @if ($CollectPoints->reg_id_collect_points == $row[0][0]->id)
                                                                    <td scope="col">{{ $row[0][0]->nick_name }}<br>
                                                                        {{ substr($row[0][0]->std_code, -3) }}</td>
                                                                    <td scope="col">{{ $row[0][0]->point_test50 }}</td>
                                                                    <td scope="col">{{ $row[1][0]->point_test50 }}</td>
                                                                    <td scope="col">{{ $row[2][0]->point_test50 }}</td>
                                                                    {{-- = round(($row[0][0]->point_test50 + $row[1][0]->point_test50 + $row[2][0]->point_test50) / 3) --}}
                                                                    <td scope="col">{!! Form::number('test50[]', $CollectPoints->test50_collect_points, ['id' => 'test50', 'class' => 'test50 form-control', 'step' => '0.01']) !!}</td>
                                                                    <td scope="col">{!! Form::number('Internship_score[]', $row[0][0]->Internship_score, ['readonly', 'class' => 'form-control Internship_score', 'step' => '0.01']) !!}</td>
                                                                    <td scope="col">{!! Form::number('Test_in_time[]', $CollectPoints->Test_in_time, ['class' => 'form-control Test_in_time', 'step' => '0.01']) !!}</td>
                                                                    <td scope="col">{{ $row[0][1]->point_test100 }}</td>
                                                                    <td scope="col">{{ $row[1][1]->point_test100 }}</td>
                                                                    <td scope="col">{{ $row[2][1]->point_test100 }}</td>
                                                                    {{-- round(($row[0][1]->point_test100 + $row[1][1]->point_test100 + $row[2][1]->point_test100) / 3) --}}
                                                                    <td scope="col">{!! Form::number('test100[]', $CollectPoints->test100_collect_points, ['class' => 'test100 form-control ', 'step' => '0.01']) !!}</td>
                                                                    {{-- <td scope="row">{{$test100 = ($row[0][1]->point_test100+$row[1][1]->point_test100+$row[2][1]->point_test100)/3}}</td> --}}
                                                                    <td scope="col"> {!! Form::number('presentations[]', $CollectPoints->presentations, ['class' => 'form-control presentations', 'step' => '0.01']) !!}</td>
                                                                    <td scope="col">
                                                                        <div class="net-profit">
                                                                    </td>
                                                                    <td scope="col">
                                                                        <div class="grade"></div>
                                                                    </td>
                                                                    <th>{!! Form::checkbox('code_id[]', $row[0][0]->std_code, true) !!}</th>
                                                                    @break
                                                                @endif

                                                            @elseif ($CollectPoints == null)
                                                                <td scope="col">{{ $row[0][0]->nick_name }}<br>
                                                                    {{ substr($row[0][0]->std_code, -3) }}</td>
                                                                <td scope="col">{{ $row[0][0]->point_test50 }}</td>
                                                                <td scope="col">{{ $row[1][0]->point_test50 }}</td>
                                                                <td scope="col">{{ $row[2][0]->point_test50 }}</td>
                                                                {{-- = round(($row[0][0]->point_test50 + $row[1][0]->point_test50 + $row[2][0]->point_test50) / 3) --}}
                                                                <td scope="col">{!! Form::number('test50[]', $test50 = null, ['id' => 'test50', 'class' => 'test50 form-control', 'step' => '0.01']) !!}</td>
                                                                <td scope="col">{!! Form::number('Internship_score[]', $row[0][0]->Internship_score, ['readonly', 'class' => 'form-control Internship_score', 'step' => '0.01']) !!}</td>
                                                                <td scope="col">{!! Form::number('Test_in_time[]', null, ['class' => 'form-control Test_in_time', 'step' => '0.01']) !!}</td>
                                                                <td scope="col">{{ $row[0][1]->point_test100 }}</td>
                                                                <td scope="col">{{ $row[1][1]->point_test100 }}</td>
                                                                <td scope="col">{{ $row[2][1]->point_test100 }}</td>
                                                                {{-- round(($row[0][1]->point_test100 + $row[1][1]->point_test100 + $row[2][1]->point_test100) / 3) --}}
                                                                <td scope="col">{!! Form::number('test100[]', $test100 = null, ['class' => 'test100 form-control ', 'step' => '0.01']) !!}</td>
                                                                {{-- <td scope="row">{{$test100 = ($row[0][1]->point_test100+$row[1][1]->point_test100+$row[2][1]->point_test100)/3}}</td> --}}
                                                                <td scope="col"> {!! Form::number('presentations[]', null, ['class' => 'form-control presentations', 'step' => '0.01']) !!}</td>
                                                                <td scope="col">
                                                                    <div class="net-profit">
                                                                </td>
                                                                <td scope="col">
                                                                    <div class="grade"></div>
                                                                </td>
                                                                <th>{!! Form::checkbox('code_id[]', $row[0][0]->std_code, true) !!}</th>
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="15">There are no data.</td>
                                                </tr>
                                            @endif
                                        @endif
                                    </tbody>
                                </table>
                            @endforeach
                            {{-- {{$datas_instructor}} --}}


                        </div>
                        <div class="row mb-4">
                            @foreach ($datas_instructor as $key => $row)
                                <div class="col-xl col-lg">
                                    {{-- {{ $row->Is_director}} --}}
                                    @if ($row->Is_director == 0)
                                        <p>#1 {{ $row->Title_name_Instructor . $row->name_Instructor }}</p>
                                    @elseif($row->Is_director == 1)
                                        <p>#2 {{ $row->Title_name_Instructor . $row->name_Instructor }}</p>
                                    @elseif($row->Is_director == 2)
                                        <p>#3 {{ $row->Title_name_Instructor . $row->name_Instructor }}</p>
                                    @endif
                                </div>
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
                    grade = $('.grade', row),
                    net_profit = $('.net-profit', row);


                Internship_score = Number(Internship_score.val());
                test50 = Number(test50.val());
                Test_in_time = Number(Test_in_time.val());
                test100 = Number(test100.val());
                presentations = Number(presentations.val());


                if (!isNaN(test50) && !isNaN(Internship_score)) {
                    net_profit.text((test50 + Internship_score + Test_in_time + test100 + presentations).toFixed(
                        2));

                }
                var go = Number(test50 + Internship_score + Test_in_time + test100 + presentations);
                if (go >= 80) {
                    grade.text('A');
                } else if (go >= 75) {
                    grade.text('B+');
                } else if (go >= 70) {
                    grade.text('B');
                } else if (go >= 65) {
                    grade.text('C+');
                } else if (go >= 60) {
                    grade.text('C');
                } else if (go >= 55) {
                    grade.text('D+');
                } else if (go >= 50) {
                    grade.text('D');
                }
            });

        </script>
    </body>


    </html>

@endsection
