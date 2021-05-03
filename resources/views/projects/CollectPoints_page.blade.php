@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <div class="container">
            <h3 align="center" class="my-4">รายชื่อโครงการที่รอให้คะแนน</h3>
            @if (Auth::user()->hasRole('Admin'))
                <div class="mb-4">
                    <div class="table-responsive table-striped">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">ลำดับโครงงาน</th>
                                    <th scope="col">ชื่อโครงงาน(ภาษาไทย)</th>
                                    <th scope="col">ชื่อโครงงาน(ภาษาอังกฤษ)</th>
                                    <th scope="col">เลือก</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($datas))
                               
                                @foreach ($datas as $key=>$row)
                                    @if ($row->status == 'Successfully')
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $row->name_th }}</td>
                                            <td>{{ $row->name_en }}</td>
                                            <td><a href="{{ route('projectControllers.collectPointsForm', $row->id) }}"
                                                    class="btn btn-info">เลือก</a>
                                            </td>                                           
                                        </tr>
                                    @endif
                                @endforeach
                                @else

                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif



        </div>
    </body>

    </html>

@endsection
