@php
  $_user = auth()->user();
@endphp
@extends('layouts.master')

@section('headertitle','Detalji dvorane')
@section('activedvorane','active')

@section('content')
<div class="col-12 col-xl-12">
  <div class="card">
    <div class="card-header">
      <div class="float-end">
        <a class="btn btn-sm" href="{{ route('halls.index') }}"><i class="align-middle fas fa-fw fa-times"></i></a>
      </div>
      <h5 class="card-title">{{$hall->naziv}}</h5>
    </div>
    <div class="card-body">

        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="mb-2">
                <h5>Naziv</h5>
                {{ $hall->naziv }}
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection
