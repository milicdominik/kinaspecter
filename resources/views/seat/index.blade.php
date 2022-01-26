@php
  $_user = auth()->user();
@endphp
@extends('layouts.master')

@section('headertitle','Popis sjedišta')
@section('activesjedista','active')

@section('content')
  <div class="col-12 col-xl-12">
    <div class="card">
      <div class="card-header">
        <div class="float-end">
        @if($_user->canmodel('create','Seat'))
           <a href="{{ route('seats.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Kreiraj sjedište</a>
        @endif
        </div>
        <h5 class="card-title">Popis sjedišta</h5>
        {{--<div class="card-subtitle">PODNASLOV</div>--}}
      </div>
      <div class="card-body">
        <form method="GET" action="{{ route('seats.index') }}" role="form">
          <div class="d-flex col-md-4 col-sm-8">
            <div class="pe-2" style="line-height:1.75rem">Filtriraj:</div>
            <div class="d-flex col-md-2 col-sm-4">
              {{ Form::text('naziv', $request->input('naziv'), ['class' => 'form-control', 'placeholder' => 'Naziv'])}}
            </div>
            <div class="pe-2"></div>
            @include('hall.formelements.select',['name' => 'hall_id', 'value' =>$request->input('hall_id') ? $request->input('hall_id'):null, 'required' => false, 'nullable' => true])
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
                    <th>@sortablelink('hall_id', 'Dvorana')</th>
                    <th width="60"></th>
            </tr>
          </thead>
          <tbody>
          @foreach ($seats as $seat)
            <tr>
              <td>
              @if($_user->canmodel('edit','Seat',$seat))
                <a class="btn btn-sm" href="{{ route('seats.edit',$seat) }}" title="Uredi"><i class="fas fa-pen"></i></a>
              @endif
              <a href="{{route('seats.show',$seat->id)}}">{{$seat->naziv}}</a>
             </td>
             <td>
               {{$seat->hall->naziv}}
             </td>
              @if($_user->canmodel('delete','Seat',$seat))
              <td>
                <form action="{{ route('seats.destroy',$seat->id) }}" method="POST">
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
    {!! $seats->appends(\Request::except('page'))->render() !!}
  </div>
@endsection
