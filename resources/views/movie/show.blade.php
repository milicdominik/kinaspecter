@php
  $_user = auth()->user();
@endphp
@extends('layouts.master')

@section('headertitle','Detalji filma')
@section('activefilmovi','active')

@section('content')
<div class="col-12 col-xl-12">
  <div class="card">
    <div class="card-header">
      <div class="float-end">
        <a class="btn btn-sm" href="{{ route('movies.index') }}"><i class="align-middle fas fa-fw fa-times"></i></a>
      </div>
      <h5 class="card-title">{{$movie->naslov}}</h5>
    </div>
    <div class="card-body">

        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="mb-2">
                <h5>Naslov</h5>
                {{ $movie->naslov }}
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="mb-2">
                <h5>Redatelj</h5>
                <td>{{$movie->redatelj}}</td>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>Žanr</h5>
                {{ $movie->genre->naziv }}
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>Godina izlaska</h5>
                <td>{{$movie->godina_izlaska}}</td>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>Trajanje</h5>
                <td>{{$movie->trajanje}}</td>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="mb-2">
                <h5>Uloge</h5>
                {{ $movie->uloge }}
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="mb-2">
                <h5>Opis</h5>
                <td>{!!$movie->opis!!}</td>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection
