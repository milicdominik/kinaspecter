@php
  $_user = auth()->user();
@endphp
@extends('layouts.master')

@section('headertitle','Detalji sjedišta')
@section('activesjedista','active')

@section('content')
<div class="col-12 col-xl-12">
  <div class="card">
    <div class="card-header">
      <div class="float-end">
        <a class="btn btn-sm" href="{{ route('seats.index') }}"><i class="align-middle fas fa-fw fa-times"></i></a>
      </div>
      <h5 class="card-title">{{$seat->naziv}}</h5>
    </div>
    <div class="card-body">

        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="mb-2">
                <h5>Naziv</h5>
                {{ $seat->naziv }}
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="mb-2">
                <h5>Dvorana</h5>
                <td>{{$seat->hall->naziv}}</td>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection
