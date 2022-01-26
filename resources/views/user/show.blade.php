@php
  $_user = auth()->user();
@endphp
@extends('layouts.master')

@section('headertitle','Detalji korisnika')
@section('activekorisnici','active')

@section('content')
<div class="col-12 col-xl-12">
  <div class="card">
    <div class="card-header">
      <div class="float-end">
        <a class="btn btn-sm" href="{{ route('users.index') }}"><i class="align-middle fas fa-fw fa-times"></i></a>
      </div>
      <h5 class="card-title">
        @if($user->is_administracija)
          <i class="align-middle me-2 fas fa-user-shield"></i>
        @elseif($user->is_posjetitelj)
          <i class="align-middle me-2 fas fa-users"></i>
        @else
        <i class="align-middle me-2 fas fa-user-tie"></i>
        @endif{{$user->puno_prezime_ime}}
        @if(!$user->is_posjetitelj)
        <span class="badge bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Zaposlenik">Z</span>
      @endif
      @if($user->is_administracija)
        <span class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Administrator">A</span>
      @endif</h5>
    </div>
    <div class="card-body">

        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>Korisničko ime</h5>
                {{ $user->name }}
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>Ime</h5>
                {{ $user->ime }}
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>Prezime</h5>
                <td>{{$user->prezime}}</td>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>E-mail</h5>
                <td>{{$user->email}}</td>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>OIB</h5>
                <td>{{$user->oib}}</td>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>Mobitel</h5>
                <td>{{$user->mobitel}}</td>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>Datum i godina rođenja</h5>
                {{ $user->display_date}}
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>Status</h5>
                {{ config('privilegije.zaposlenik')[$user->is_posjetitelj] }}
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>Administrator</h5>
                {{ config('privilegije.administrator')[$user->is_administracija] }}
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection
