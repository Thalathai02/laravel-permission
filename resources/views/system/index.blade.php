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
        <th scope="col">ระบบเปิด/ปิด</th>
        <th scope="col">ยืนยัน</th>

      </tr>
    </thead>
    
        <tbody>
          @foreach ($data as $row )
          <tr>
            <td>{{ $row->name }}</td>
            <td>{!! Form::date('date',\Carbon\Carbon::parse($row->dateTime),['class' => 'form-control']) !!}</td>
            <td>{!! Form::date('date',\Carbon\Carbon::parse($row->dateOut),['class' => 'form-control']) !!}</td>
            <td>{!! Form::select('openform' ,['0' => 'ปิด', '1' => 'เปิด']) !!}</td>
            <td><a class="btn btn-success">ยืนยัน</a></td>
           
          </tr>
          @endforeach
        </tbody>
      </table>
    
</div>
</body>
</html>

@endsection