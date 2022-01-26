@php
  $_user = auth()->user();
@endphp
@extends('layouts.master')

@section('headertitle','Uređivanje: '.Str::limit($movie->naslov,200))
@section('activefilmovi','active')

@section('content')
<div class="col-12 col-xl-12">
  <div class="card card-default">
    <div class="card-body">
      <form method="POST" action="{{ route('movies.update', $movie->id) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf
        @include('movie.form')
      </form>
    </div>
  </div>
</div>
@endsection
