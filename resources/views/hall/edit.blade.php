@extends('layouts.master')

@section('headertitle','Uređivanje: '.Str::limit($hall->naziv,200))
@section('activedvorane','active')

@section('content')
<div class="col-12 col-xl-12">
  <div class="card card-default">
    <div class="card-body">
      <form method="POST" action="{{ route('halls.update', $hall->id) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf
        @include('hall.form')
      </form>
    </div>
  </div>
</div>
@endsection
