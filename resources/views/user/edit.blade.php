@php
  $_user = auth()->user();
@endphp
@extends('layouts.master')

@section('headertitle','Uređivanje: '.Str::limit($user->puno_prezime_ime,200))
@section('activekorisnici','active')

@section('content')
<div class="col-12 col-xl-12">
  <div class="card card-default">
    <div class="card-body">
      <form method="POST" action="{{ route('users.update', $user->id) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf
        @include('user.form')
      </form>
    </div>
  </div>
</div>
@endsection
