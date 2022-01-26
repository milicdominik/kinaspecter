@php
  $_user = auth()->user();
@endphp
@extends('layouts.master')

@section('headertitle','Popis predstava')
@section('activepredstave','active')

@section('content')
  <div class="col-12 col-xl-12">
    <div class="card">
      <div class="card-header">
        <div class="float-end">
        @if($_user->canmodel('create','Show'))
           <a href="{{ route('shows.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Kreiraj predstavu</a>
        @endif
        </div>
        <h5 class="card-title">Popis predstava</h5>
        {{--<div class="card-subtitle">PODNASLOV</div>--}}
      </div>
      <div class="card-body">
        <form method="GET" action="{{ route('shows.index') }}" role="form">
          <div class="d-flex col-md-12 col-sm-12">
            <div class="pe-2" style="line-height:1.75rem">Filtriraj:</div>
            <div class="d-flex col-md-4 col-sm-8">
              {{ Form::text('naziv', $request->input('naziv'), ['class' => 'form-control', 'placeholder' => 'Naziv'])}}
            </div>
            <div class="pe-2"></div>
            <div class="d-flex col-md-3 col-sm-6">
              @include('hall.formelements.select',['name' => 'hall_id', 'value' => $request->input('hall_id') ? $request->input('hall_id'):null, 'required' => false, 'nullable' => true])
            </div>
            <div class="pe-2"></div>
            <div class="d-flex col-md-2 col-sm-3">
              @include('includes.formelements.datepicker',['name' => 'datum_odrzavanja', 'value' => $request->input('datum_odrzavanja') ? $request->input('datum_odrzavanja'):null, 'required' => false])
              @include('includes.formelements.time',['name' => 'vrijeme_odrzavanja', 'value' => $request->input('vrijeme_odrzavanja') ? $request->input('vrijeme_odrzavanja'):null, 'required' => false])
            </div>
            <div class="pe-2"></div>

            <div><button type="submit" class="btn btn-light">Filtriraj</button></div>
          </div>
        </form>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-hover table-sm">
          <thead class="thead">
            <tr>
										<th>@sortablelink('naziv', 'Naziv')</th>
                    <th>Film</th>
                    <th>@sortablelink('hall_id', 'Dvorana')</th>
                    <th>@sortablelink('datum_i_vrijeme_odrzavanja', 'Datum održavanja')</th>
                    <th>Početak - Kraj</th>
                    <th>@sortablelink('trajanje', 'Trajanje')</th>
                    <th width="60"></th>
            </tr>
          </thead>
          <tbody>
          @foreach ($shows as $show)
            <tr>
              <td>
              @if($_user->canmodel('edit','Show',$show))
                <a class="btn btn-sm" href="{{ route('shows.edit',$show) }}" title="Uredi"><i class="fas fa-pen"></i></a>
              @endif
              <a href="{{route('shows.show',$show->id)}}">{{$show->naziv}}</a>
             </td>
             <td>{{$show->movie->naslov}}</td>
             <td>{{$show->hall->naziv}}</td>
             <td>{{$show->display_date}}</td>
             <td>{{$show->display_time}}</td>
             <td>{{$show->trajanje}}</td>
              @if($_user->canmodel('delete','Show',$show))
              <td>
                <form action="{{ route('shows.destroy',$show->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm" title="Obriši"><i class="fas fa-fw fa-trash"></i></button>
                </form>
              </td>
              @endif
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {!! $shows->appends(\Request::except('page'))->render() !!}
  </div>
@endsection
