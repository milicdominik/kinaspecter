@php
  $_user = auth()->user();
@endphp
@extends('layouts.master')

@section('headertitle','Kreiraj korisnika')
@section('activekorisnici','active')

@section('content')
<div class="col-12 col-xl-12">
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}"  role="form" enctype="multipart/form-data">
                @csrf
                @include('user.form')
            </form>
        </div>
    </div>
</div>
@endsection
