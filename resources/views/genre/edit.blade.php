@extends('layouts.master')

@section('headertitle','Uređivanje: '.Str::limit($genre->naziv,200))
@section('activezanrovi','active')

@section('content')
<div class="col-12 col-xl-12">
  <div class="card card-default">
    <div class="card-body">
      <form method="POST" action="{{ route('genres.update', $genre->id) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf
        @include('genre.form')
      </form>
    </div>
  </div>
</div>
@endsection
