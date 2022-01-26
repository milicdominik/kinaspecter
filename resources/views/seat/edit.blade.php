@extends('layouts.master')

@section('headertitle','Uređivanje: '.Str::limit($seat->naziv,200). ' sjedišta ('.$seat->hall->naziv.')')
@section('activesjedista','active')

@section('content')
<div class="col-12 col-xl-12">
  <div class="card card-default">
    <div class="card-body">
      <form method="POST" action="{{ route('seats.update', $seat->id) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf
        @include('seat.form')
      </form>
    </div>
  </div>
</div>
@endsection
