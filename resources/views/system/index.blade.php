@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
 <body>
  <br />
  
  <div class="container">
   <h3 align="center">ระบบทั้งหมด</h3>
    <br />
   @if(count($errors) > 0)
    <div class="alert alert-danger">
     Upload Validation Error<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
   @endif

   @if($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
   
   <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">ชื่อ</th>
        <th scope="col">เวลาเปิดระบบ</th>
        <th scope="col">เวลาปิดระบบ</th>

      </tr>
    </thead>
    
        <tbody>
        @foreach ( $data as $row)
        {!! Form::open(['action' => ['systemController@update',$row->id],'method'=>'PUT']) !!}
          <tr>
            <td> ระบบนำเสนอหัวข้อ</td>
            <td>{!! Form::date('DatePropose',\Carbon\Carbon::parse($row->DatePropose),['class' => 'form-control']) !!}</td>
            <td>{!! Form::date('OutPropose',\Carbon\Carbon::parse($row->OutPropose),['class' => 'form-control']) !!}</td>
           
          </tr>
 
          <tr>
            <td> ระบบการตัดสินประเมินตอนนำเสนอ</td>
            <td>{!! Form::date('Datedecide',\Carbon\Carbon::parse($row->Datedecide),['class' => 'form-control']) !!}</td>
            <td>{!! Form::date('Outdecide',\Carbon\Carbon::parse($row->Outdecide),['class' => 'form-control']) !!}</td>
          </tr>

          <tr>
            <td> ระบบแสดงความคิดเห็น ของประธานและกรรมการ(ไม่แสดงตัว) ตอนนำเสนอหัวข้อ</td>
            <td>{!! Form::date('DateComment',\Carbon\Carbon::parse($row->DateComment),['class' => 'form-control']) !!}</td>
            <td>{!! Form::date('OutComment',\Carbon\Carbon::parse($row->OutComment),['class' => 'form-control']) !!}</td>
       
          </tr>

          <tr>
            <td>ระบบส่งเล่มโครงงาน</td>
            <td>{!! Form::date('DateSubmitProject',\Carbon\Carbon::parse($row->DateSubmitProject),['class' => 'form-control']) !!}</td>
            <td>{!! Form::date('OutSubmitProject',\Carbon\Carbon::parse($row->OutSubmitProject),['class' => 'form-control']) !!}</td>
          </tr>

          <tr>
            <td>ระบบกำหนดวันสอบ 50</td>
            <td>{!! Form::date('DateDue50 ',\Carbon\Carbon::parse($row->DateDue50 ),['class' => 'form-control']) !!}</td>
            <td>{!! Form::date('OutDue50 ',\Carbon\Carbon::parse($row->OutDue50 ),['class' => 'form-control']) !!}</td>
          </tr>

          <tr>
            <td>ระบบกำหนดวันสอบ 100</td>
            <td>{!! Form::date('DateDue100 ',\Carbon\Carbon::parse($row->DateDue100 ),['class' => 'form-control']) !!}</td>
            <td>{!! Form::date('OutDue100 ',\Carbon\Carbon::parse($row->OutDue100 ),['class' => 'form-control']) !!}</td>
            
          </tr>
          {{ $row->id }}<br>
          <p>ยืนยัน <input type="submit" value="ยืนยัน" data-name="" class="btn btn-danger"></p>
          
          {!! Form::close() !!}
          @endforeach
        </tbody>
      </table>
    
</div>
</body>
</html>

@endsection