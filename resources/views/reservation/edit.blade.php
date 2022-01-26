@extends('layouts.master')

@section('headertitle','Uređivanje: '.Str::limit($show->naziv,200))
@section('activepredstave','active')

@section('content')
<div class="col-12 col-xl-12">
  <div class="card card-default">
    <div class="card-body">
      <form method="POST" action="{{ route('shows.update', $show->id) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf
        @include('show.form')
      </form>
    </div>
  </div>
</div>
@endsection
