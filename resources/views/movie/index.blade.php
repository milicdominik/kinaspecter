@php
  $_user = auth()->user();
@endphp
@extends('layouts.master')

@section('headertitle','Popis filmova')
@section('activefilmovi','active')

@section('content')
  <div class="col-12 col-xl-12">
    <div class="card">
      <div class="card-header">
        <div class="float-end">
        @if($_user->canmodel('create','Movie'))
           <a href="{{ route('movies.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Kreiraj film</a>
        @endif
        </div>
        <h5 class="card-title">Popis filmova</h5>
        {{--<div class="card-subtitle">PODNASLOV</div>--}}
      </div>
      <div class="card-body">
        <form method="GET" action="{{ route('movies.index') }}" role="form">
          <div class="d-flex col-md-12 col-sm-12">
            <div class="pe-2" style="line-height:1.75rem">Filtriraj:</div>
            <div class="d-flex col-md-4 col-sm-8">
              {{ Form::text('naslov', $request->input('naslov'), ['class' => 'form-control', 'placeholder' => 'Naslov'])}}
            </div>
            <div class="pe-2"></div>
            <div class="d-flex col-md-3 col-sm-6">
              {{ Form::text('redatelj', $request->input('redatelj'), ['class' => 'form-control', 'placeholder' => 'Redatelj'])}}
            </div>
            <div class="pe-2"></div>
            <div class="d-flex col-md-3 col-sm-6">
              @include('genre.formelements.select',['name' => 'genre_id', 'value' => $request->input('genre_id') ? $request->input('genre_id'):null, 'required' => false, 'nullable' => true])
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
										<th width="200">@sortablelink('naslov', 'Naslov')</th>
                    <th>@sortablelink('redatelj', 'Redatelj')</th>
                    <th>@sortablelink('genre_id', 'Žanr')</th>
                    <th width="80">@sortablelink('trajanje', 'Trajanje')</th>
                    <th width="80">@sortablelink('godina_izlaska', 'Godina izlaska')</th>
                    <th>Uloge</th>
                    <th>Opis</th>
                    <th width="60"></th>
            </tr>
          </thead>
          <tbody>
          @foreach ($movies as $movie)
            <tr>
              <td>
              @if($_user->canmodel('edit','Movie',$movie))
                <a class="btn btn-sm" href="{{ route('movies.edit',$movie) }}" title="Uredi"><i class="fas fa-pen"></i></a>
              @endif
              <a href="{{route('movies.show',$movie->id)}}">{{$movie->naslov}}</a>
             </td>
             <td>{{$movie->redatelj}}</td>
             <td>{{$movie->genre->naziv}}</td>
             <td>{{$movie->trajanje}}</td>
             <td>{{$movie->godina_izlaska}}</td>
             <td>{{$movie->uloge}}</td>
             <td>{!!Str::limit($movie->opis)!!}</td>
              @if($_user->canmodel('delete','Movie',$movie))
              <td>
                <form action="{{ route('movies.destroy',$movie->id) }}" method="POST">
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
    {!! $movies->appends(\Request::except('page'))->render() !!}
  </div>
@endsection
