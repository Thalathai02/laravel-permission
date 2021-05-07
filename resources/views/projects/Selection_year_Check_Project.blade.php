@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html>

    <body>
        <br />

        <div class="container">
            <h3 align="center" class="mb-4">Check Projects</h3>
           
                 <!-- Modal -->
                 {!! Form::open(['action' => 'CheckProjectController@index', 'method' => 'get', 'enctype' => 'multipart/form-data'])!!}
                 {{ csrf_field() }}
                 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                     aria-labelledby="staticBackdropLabel" aria-hidden="true">
                     <div class="modal-dialog">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="staticBackdropLabel">เลือกปีการศึกษา</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                             </div>
                             <div class="modal-body">
                                 
                                 {!! Form::select('subject', $term, ['class' => 'md-6']) !!}
                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ออก</button>
                                 <button type="submit" class="btn btn-primary">เลือก</button>
                             </div>
                         </div>
                     </div>
                 </div>
                 {!! Form::close() !!}
                 
     
             </div>
             <script>
                 $(document).ready(function() {
                     $("#staticBackdrop").modal('show');
                 });
             </script>
    </body>

    </html>

@endsection
