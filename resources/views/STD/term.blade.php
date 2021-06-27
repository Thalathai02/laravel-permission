@extends('layouts.app')
@section('content')
    <div class="container">

        {!! Form::open(['action' => 'subjects@store', 'method' => 'POST']) !!}
        <div class="row">
            <div class="form-group col-4">
                {!! Form::label('year', 'ปีการศึกษา') !!}
                {{ Form::selectYear('year', 2561, 2570) }}
            </div>
            <div class="form-group col">
                {!! Form::label('term', 'เทอมการศึกษา') !!}
                {!! Form::select('term', ['1' => '1', '2' => '2'], '1') !!}
            </div>
        </div>
        <hr>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">การกรองคะแนนเต็ม</h1>
        </div>
        <div class="row my-4">
            <div class="col-6">
                {!! Form::label('text_test', 'คะเเนนเต็มการสอบ 50%') !!}
                {!! Form::number('test50', null, ['class' => 'form-control test50']) !!}
            </div>
            <div class="col-6">
                {!! Form::label('text_test', 'คะเเนนเต็มการสอบ 100%') !!}
                {!! Form::number('test100', null, ['class' => 'form-control test100']) !!}
            </div>
        </div>

        <div class="row my-4">
            <div class="col-6">
                {!! Form::label('text_test', 'คะแนนเสนอผลงานวิชาการ') !!}
                {!! Form::number('presentations', null, ['class' => 'form-control presentations']) !!}
            </div>
            <div class="col-6">
                {!! Form::label('text_test', 'คะเเนนสอบในเวลา') !!}
                {!! Form::number('Test_in_time', null, ['class' => 'form-control Test_in_time']) !!}
            </div>
        </div>

        <div class="row my-4">
            <div class="col-6">
                {!! Form::label('text_test', 'คะแนนฝึกงาน') !!}
                {!! Form::number('Internship_score', null, ['class' => 'form-control Internship_score']) !!}
            </div>
        </div>

        <div class="row my-4">
            <div class="col-6">
                {!! Form::label('text_test', 'คะแนนรวม') !!}
            <div class="net-profit"></div>
        </div>
        </div>
        <input type="submit" value="บันทึก" class="btn btn-primary row-1 " name="" id="">
        <a href="/STD" class="btn btn-success row-2">กลับ</a>
        {!! Form::close() !!}
    </div>
    <script>
        $('.test50, .Internship_score , .Test_in_time , .test100 ,.presentations').on('blur', function(e) {

            var Internship_score = $('.Internship_score'),
                test50 = $('.test50'),
                Test_in_time = $('.Test_in_time'),
                test100 = $('.test100'),
                presentations = $('.presentations'),
                net_profit = $('.net-profit');


            Internship_score = Number(Internship_score.val());
            test50 = Number(test50.val());
            Test_in_time = Number(Test_in_time.val());
            test100 = Number(test100.val());
            presentations = Number(presentations.val());


            if (!isNaN(test50) && !isNaN(Internship_score)) {
                net_profit.text((test50 + Internship_score + Test_in_time + test100 + presentations));
            }
        });

    </script>
@endsection
