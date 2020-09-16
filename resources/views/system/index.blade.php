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
            <th scope="col">ลำดับ</th>
            <th scope="col">ชื่อระบบ</th>
            <th scope="col">กำหนดวันปิดระบบ</th>
            <th scope="col">เปิด/ปิดระบบ</th>
            <th scope="col">ยืนยัน</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>1</th>
            <td>ระบบเสนอหัวข้อ</td>
          <td>{!! Form::date('dataopen', \Carbon\Carbon::now()) !!}</td>
            <td>{!! Form::select('openform', ['0' => 'ปิด', '1' => 'เปิด']) !!}</td>
            <td><a href="" class="btn btn-success">ยืนยัน</a></td>
          </tr>
                <tr>
                <th>2</th>
                <td>ระบบการตัดสินประเมินตอนนำเสนอ</td>
                <td>{!! Form::date('dataopen', \Carbon\Carbon::now()) !!}</td>
                <td>{!! Form::select('openform', ['0' => 'ปิด', '1' => 'เปิด']) !!}</td>
                <td><a href="" class="btn btn-success">ยืนยัน</a></td>
                </tr>
                <tr>
                        <th>3</th>
                        <td>ระบบแสดงความคิดเห็นอาจารย์/ประเมิน</td>
                        <td>{!! Form::date('dataopen', \Carbon\Carbon::now()) !!}</td>
                        <td>{!! Form::select('openform', ['0' => 'ปิด', '1' => 'เปิด']) !!}</td>
                        <td><a href="" class="btn btn-success">ยืนยัน</a></td>
                        </tr>
                        <th>4</th>
                        <td> </td>
                        <td>{!! Form::date('dataopen', \Carbon\Carbon::now()) !!}</td>
                        <td>{!! Form::select('openform', ['0' => 'ปิด', '1' => 'เปิด']) !!}</td>
                        <td><a href="" class="btn btn-success">ยืนยัน</a></td>
                        </tr>
        </tbody>
      </table>
    
</div>
</body>
</html>

@endsection