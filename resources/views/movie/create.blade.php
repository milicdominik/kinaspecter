@php
  $_user = auth()->user();
@endphp
@extends('layouts.master')

@section('headertitle','Kreiraj film')
@section('activefilmovi','active')

@section('content')
<div class="col-12 col-xl-12">
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('movies.store') }}"  role="form" enctype="multipart/form-data">
                @csrf
                @include('movie.form')
            </form>
        </div>
    </div>
</div>
@endsection
