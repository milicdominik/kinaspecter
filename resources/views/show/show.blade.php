@php
  $_user = auth()->user();
@endphp
@extends('layouts.master')

@section('headertitle','Detalji predstave')
@section('activepredstave','active')

@section('content')
<div class="col-12 col-xl-12">
  <div class="card">
    <div class="card-header">
      <div class="float-end">
        <a class="btn btn-sm" href="{{ route('shows.index') }}"><i class="align-middle fas fa-fw fa-times"></i></a>
      </div>
      <h5 class="card-title">{{$show->naziv}}</h5>
    </div>
    <div class="card-body">

        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="mb-2">
                <h5>Naslov</h5>
                {{ $show->naziv }}
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="mb-2">
                <h5>Film</h5>
                <td>{{$show->movie->naslov}}</td>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>Dvorana</h5>
                {{ $show->hall->naziv }}
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>Datum održavanja</h5>
                <td>{{$show->display_date}}</td>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="mb-2">
                <h5>Vrijeme održavanja (od - do)</h5>
                <td>{{$show->display_time}}</td>
            </div>
          </div>
          <div class="col-md-2 col-sm-4">
            <div class="mb-2">
                <h5>Trajanje</h5>
                <td>{{$show->trajanje}}</td>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection
