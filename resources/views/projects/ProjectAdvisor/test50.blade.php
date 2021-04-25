@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>
    @if (!isset($data_reject_test))

        <body>
            <br />
            <div class="container">
                <h3 align="center">ประเมินการสอบ 50</h3>
                {{-- {{$datas}} --}}
                {!! Form::open(['action' => ['projectControllers@comment_test50_Datas', $datas[0]->id], 'method' => 'POST']) !!}
                <div class="my-2">
                    {!! Form::label('name_th', 'ชื่อโปรเจค(ภาษาไทย)') !!}
                    {!! Form::text('Project_name_thai', $datas[0]->name_th, ['readonly', 'class' => 'form-control col-xl-6 col-lg-6']) !!}
                </div>
                <div class="my-4">
                    {!! Form::label('name_eg', 'ชื่อโปรเจค(ภาษาอังกฤษ)') !!}
                    {!! Form::text('Project_name_eg', $datas[0]->name_en, ['readonly', 'class' => 'form-control col-xl-6 col-lg-6']) !!}
                </div>
                <div class="my-2 row-1">
                    {!! Form::label('reg_std1', 'รหัสนักศึกษาคนที่ 1') !!}
                    <div class="row">
                        <div class="col-xl-3 col-lg-3">

                            <a target="_blank" href="{{ route('std.showinfo', $datas_std[0]->id_reg_Std) }}">
                                {!! Form::text('reg_std1', $datas_std[0]->std_code, ['readonly', 'class' => 'form-control ']) !!}</a>
                        </div>
                        <div class="col-xl-3 col-lg-3">
                            <a target="_blank" href="{{ route('std.showinfo', $datas_std[0]->id_reg_Std) }}">
                                {!! Form::text('reg_std1_name', $datas_std[0]->name, ['readonly', 'class' => 'form-control']) !!}</a>
                        </div>
                        <div class="col-xl-3 col-lg-3">
                            {!! Form::text('reg_std1_Phone', $datas_std[0]->phone, ['readonly', 'class' => 'form-control ']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            {!! Form::label('point_reg_std1', 'ลงคะแนนให้นักศึกษาคนที่ 1 (เต็ม 30)') !!}
                        </div>
                        <div class="col-xl-3 col-lg-3">
                            {!! Form::range('point_reg_std1', null, ['class' => 'form-range ']) !!}
                            <div id="output_point_reg_std1"></div>
                            <script>
                                var slider = document.getElementById("point_reg_std1");
                                var output = document.getElementById("output_point_reg_std1");
                                output.innerHTML = slider.value; // Display the default slider value

                                // Update the current slider value (each time you drag the slider handle)
                                slider.oninput = function() {
                                    output.innerHTML = this.value;
                                }

                            </script>

                        </div>
                    </div>
                </div>


                @if (!empty($datas_std[1]->name))
                    <div class="my-4">
                        {!! Form::label('reg_std2', 'รหัสนักศึกษาคนที่ 2') !!}
                        <div class="row">
                            <div class="col-xl-3 col-lg-3">
                                <a target="_blank" href="{{ route('std.showinfo', $datas_std[1]->id_reg_Std) }}">
                                    {!! Form::text('reg_std2', $datas_std[1]->std_code, ['readonly', 'class' => 'form-control']) !!}</a>
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                <a target="_blank" href="{{ route('std.showinfo', $datas_std[1]->id_reg_Std) }}">
                                    {!! Form::text('reg_std2_name', $datas_std[1]->name, ['readonly', 'class' => 'form-control']) !!}</a>
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                {!! Form::text('reg_std2_Phone', $datas_std[1]->phone, ['readonly', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                {!! Form::label('point_reg_std2', 'ลงคะแนนให้นักศึกษาคนที่ 2 (เต็ม 30)') !!}
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                {!! Form::range('point_reg_std2', null, ['class' => 'form-range ']) !!}
                                <div id="output_point_reg_std2"></div>
                                <script>
                                    var slider = document.getElementById("point_reg_std2");
                                    var output2 = document.getElementById("output_point_reg_std2");
                                    output2.innerHTML = slider.value; // Display the default slider value

                                    // Update the current slider value (each time you drag the slider handle)
                                    slider.oninput = function() {
                                        output2.innerHTML = this.value;
                                    }

                                </script>
                            </div>
                        </div>
                    </div>

                @endif
                @if (!empty($datas_std[2]->name))
                    <div class="my-4">
                        {!! Form::label('reg_std3', 'รหัสนักศึกษาคนที่ 3 ') !!}
                        <div class="row">
                            <div class="col-xl-3 col-lg-3">
                                <a target="_blank" href="{{ route('std.showinfo', $datas_std[2]->id_reg_Std) }}">
                                    {!! Form::text('reg_std3', $datas_std[2]->std_code, ['readonly', 'class' => 'form-control']) !!}</a>
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                <a target="_blank" href="{{ route('std.showinfo', $datas_std[2]->id_reg_Std) }}">
                                    {!! Form::text('reg_std3_name', $datas_std[2]->name, ['readonly', 'class' => 'form-control']) !!}</a>
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                {!! Form::text('reg_std3_Phone', $datas_std[2]->phone, ['readonly', 'class' => 'form-control']) !!}
                            </div>

                            <div class="row">
                                <div>
                                    {!! Form::label('point_reg_std3', 'ลงคะแนนให้นักศึกษาคนที่ 3 (เต็ม 30)') !!}
                                </div>
                                <div class="col-xl-3 col-lg-3">
                                    {!! Form::range('point_reg_std3', null, ['class' => 'form-range ']) !!}
                                    <div id="output_point_reg_std3"></div>
                                    <script>
                                        var slider = document.getElementById("point_reg_std3");
                                        var output3 = document.getElementById("output_point_reg_std3");
                                        output3.innerHTML = slider.value; // Display the default slider value

                                        // Update the current slider value (each time you drag the slider handle)
                                        slider.oninput = function() {
                                            output3.innerHTML = this.value;
                                        }

                                    </script>
                                </div>
                            </div>
                        </div>
                @endif
                <div class="my4">
                    {!! Form::label('date_test50', 'จะขอสอบ 50 % ในวันที่ ') !!}
                    {!! Form::text('date_test50', formatDateThai($tableTest50_id->date_test50), ['readonly', 'class' => 'form-control col-xl-5 col-lg-5']) !!}

                </div>
                <div class="my4">
                    {!! Form::label('date_test50', 'เวลา ') !!}
                    {!! Form::text('date_test50_time', formatDateThai_time($tableTest50_id->date_test50), ['readonly', 'class' => 'form-control col-xl-5 col-lg-5']) !!}

                </div>

                <div class="my-4">
                    {!! Form::label('room_test50', 'ห้องสอบ ') !!}
                    {!! Form::text('room_test50', $tableTest50_id->room_test50, ['readonly', 'class' => 'form-control col-xl-5 col-lg-5']) !!}
                </div>
                <div class="my-4">
                    {!! Form::label('selecttopic', 'กรุณาเลือก ') !!}
                    {!! Form::select('selecttopic', ['1' => 'ผ่าน', '2' => 'ไม่ผ่าน'], '1', ['class' => 'form-select col-xl-5 col-lg-5']) !!}


                </div>
                <div class="my-4">
                    {!! Form::label('commemt', 'ความคิดเห็น') !!}
                    {!! Form::textarea('commemt', '', ['class' => 'form-control col-xl-8 col-lg-8']) !!}
                </div>

                <div class="my-2">
                    <a class="btn btn-success btn-icon-split" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">ยืนยัน</span>
                    </a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">สอบ 50</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{-- <p>หากเลือกบันทึกข้อมูล จะสามารถกลับมาแก้ไขประเมินได้</p> --}}
                                <p>ถ้าเลือก ผ่าน จะไม่สามารถแก้ไขได้</p>
                                <p>หากเลือก ไม่ผ่าน สามารถกลับมาแก้ไขได้</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </body>
    @elseif (isset($data_reject_test))

        <body>
            <br />
            <div class="container">
                <h3 align="center">ประเมินการสอบ 50</h3>
                {{-- {{$datas}} --}}
                {!! Form::open(['action' => ['projectControllers@comment_test50_Datas', $datas[0]->id], 'method' => 'POST']) !!}
                <div class="my-2">
                    {!! Form::label('name_th', 'ชื่อโปรเจค(ภาษาไทย)') !!}
                    {!! Form::text('Project_name_thai', $datas[0]->name_th, ['readonly', 'class' => 'form-control col-xl-6 col-lg-6']) !!}
                </div>
                <div class="my-4">
                    {!! Form::label('name_eg', 'ชื่อโปรเจค(ภาษาอังกฤษ)') !!}
                    {!! Form::text('Project_name_eg', $datas[0]->name_en, ['readonly', 'class' => 'form-control col-xl-6 col-lg-6']) !!}
                </div>
                <div class="my-2 row-1">
                    {!! Form::label('reg_std1', 'รหัสนักศึกษาคนที่ 1') !!}
                    <div class="row">
                        <div class="col-xl-3 col-lg-3">

                            <a target="_blank" href="{{ route('std.showinfo', $datas_std[0]->id_reg_Std) }}">
                                {!! Form::text('reg_std1', $datas_std[0]->std_code, ['readonly', 'class' => 'form-control ']) !!}</a>
                        </div>
                        <div class="col-xl-3 col-lg-3">
                            <a target="_blank" href="{{ route('std.showinfo', $datas_std[0]->id_reg_Std) }}">
                                {!! Form::text('reg_std1_name', $datas_std[0]->name, ['readonly', 'class' => 'form-control']) !!}</a>
                        </div>
                        <div class="col-xl-3 col-lg-3">
                            {!! Form::text('reg_std1_Phone', $datas_std[0]->phone, ['readonly', 'class' => 'form-control ']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            {!! Form::label('point_reg_std1', 'ลงคะแนนให้นักศึกษาคนที่ 1 (เต็ม 30)') !!}
                        </div>
                        <div class="col-xl-3 col-lg-3">
                            {!! Form::range('point_reg_std1', $point_test50[0]->point_test50, ['class' => 'form-range ']) !!}
                            <div id="output_point_reg_std1"></div>
                            <script>
                                var slider = document.getElementById("point_reg_std1");
                                var output = document.getElementById("output_point_reg_std1");
                                output.innerHTML = slider.value; // Display the default slider value

                                // Update the current slider value (each time you drag the slider handle)
                                slider.oninput = function() {
                                    output.innerHTML = this.value;
                                }

                            </script>

                        </div>
                    </div>
                </div>


                @if (!empty($datas_std[1]->name))
                    <div class="my-4">
                        {!! Form::label('reg_std2', 'รหัสนักศึกษาคนที่ 2') !!}
                        <div class="row">
                            <div class="col-xl-3 col-lg-3">
                                <a target="_blank" href="{{ route('std.showinfo', $datas_std[1]->id_reg_Std) }}">
                                    {!! Form::text('reg_std2', $datas_std[1]->std_code, ['readonly', 'class' => 'form-control']) !!}</a>
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                <a target="_blank" href="{{ route('std.showinfo', $datas_std[1]->id_reg_Std) }}">
                                    {!! Form::text('reg_std2_name', $datas_std[1]->name, ['readonly', 'class' => 'form-control']) !!}</a>
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                {!! Form::text('reg_std2_Phone', $datas_std[1]->phone, ['readonly', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                {!! Form::label('point_reg_std2', 'ลงคะแนนให้นักศึกษาคนที่ 2 (เต็ม 30)') !!}
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                {!! Form::range('point_reg_std2', $point_test50[1]->point_test50, ['class' => 'form-range ']) !!}
                                <div id="output_point_reg_std2"></div>
                                <script>
                                    var slider = document.getElementById("point_reg_std2");
                                    var output2 = document.getElementById("output_point_reg_std2");
                                    output2.innerHTML = slider.value; // Display the default slider value

                                    // Update the current slider value (each time you drag the slider handle)
                                    slider.oninput = function() {
                                        output2.innerHTML = this.value;
                                    }

                                </script>
                            </div>
                        </div>
                    </div>

                @endif
                @if (!empty($datas_std[2]->name))
                    <div class="my-4">
                        {!! Form::label('reg_std3', 'รหัสนักศึกษาคนที่ 3 ') !!}
                        <div class="row">
                            <div class="col-xl-3 col-lg-3">
                                <a target="_blank" href="{{ route('std.showinfo', $datas_std[2]->id_reg_Std) }}">
                                    {!! Form::text('reg_std3', $datas_std[2]->std_code, ['readonly', 'class' => 'form-control']) !!}</a>
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                <a target="_blank" href="{{ route('std.showinfo', $datas_std[2]->id_reg_Std) }}">
                                    {!! Form::text('reg_std3_name', $datas_std[2]->name, ['readonly', 'class' => 'form-control']) !!}</a>
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                {!! Form::text('reg_std3_Phone', $datas_std[2]->phone, ['readonly', 'class' => 'form-control']) !!}
                            </div>

                            <div class="row">
                                <div>
                                    {!! Form::label('point_reg_std3', 'ลงคะแนนให้นักศึกษาคนที่ 3 (เต็ม 30)') !!}
                                </div>
                                <div class="col-xl-3 col-lg-3">
                                    {!! Form::range('point_reg_std3', $point_test50[2]->point_test50, ['class' => 'form-range ']) !!}
                                    <div id="output_point_reg_std3"></div>
                                    <script>
                                        var slider = document.getElementById("point_reg_std3");
                                        var output3 = document.getElementById("output_point_reg_std3");
                                        output3.innerHTML = slider.value; // Display the default slider value

                                        // Update the current slider value (each time you drag the slider handle)
                                        slider.oninput = function() {
                                            output3.innerHTML = this.value;
                                        }

                                    </script>
                                </div>
                            </div>
                        </div>
                @endif
                <div class="my4">
                    {!! Form::label('date_test50', 'จะขอสอบ 50 % ในวันที่ ') !!}
                    {!! Form::text('date_test50', formatDateThai($tableTest50_id->date_test50), ['readonly', 'class' => 'form-control col-xl-5 col-lg-5']) !!}

                </div>
                <div class="my4">
                    {!! Form::label('date_test50', 'เวลา ') !!}
                    {!! Form::text('date_test50_time', formatDateThai_time($tableTest50_id->date_test50), ['readonly', 'class' => 'form-control col-xl-5 col-lg-5']) !!}

                </div>

                <div class="my-4">
                    {!! Form::label('room_test50', 'ห้องสอบ ') !!}
                    {!! Form::text('room_test50', $tableTest50_id->room_test50, ['readonly', 'class' => 'form-control col-xl-5 col-lg-5']) !!}
                </div>
                <div class="my-4">
                    {!! Form::label('selecttopic', 'กรุณาเลือก ') !!}
                    {!! Form::select('selecttopic', ['1' => 'ผ่าน', '2' => 'ไม่ผ่าน'], '1', ['class' => 'form-select col-xl-5 col-lg-5']) !!}


                </div>
                <div class="my-4">
                    {!! Form::label('commemt', 'ความคิดเห็น') !!}
                    {!! Form::textarea('commemt', $data_reject_test->text_comemt_test50, ['class' => 'form-control col-xl-8 col-lg-8']) !!}
                </div>

                <div class="my-2">
                    <a class="btn btn-success btn-icon-split" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">ยืนยัน</span>
                    </a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">สอบ 50</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{-- <p>หากเลือกบันทึกข้อมูล จะสามารถกลับมาแก้ไขประเมินได้</p> --}}
                                <p>ถ้าเลือก ผ่าน จะไม่สามารถแก้ไขได้</p>
                                <p>หากเลือก ไม่ผ่าน สามารถกลับมาแก้ไขได้</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </body>
    @endif

    </html>

@endsection
