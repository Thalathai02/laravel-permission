@extends('layouts.app')
@section('content')
@if (Auth::user()->hasRole('Std'))

<div class="container">
    <div class="row g-2">
      <div class="col-6">
        <div class="p-3 border bg-light">Custom column padding</div>
      </div>
      <div class="col-6">
        <div class="p-3 border bg-light">Custom column padding</div>
      </div>
      <div class="col-6">
        <div class="p-3 border bg-light">Custom column padding</div>
      </div>
      <div class="col-6">
        <div class="p-3 border bg-light">Custom column padding</div>
      </div>
    </div>
  </div>
@endif
@endsection

