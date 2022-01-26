@php
  $_user = auth()->user();
@endphp
@extends('layouts.master')

@section('headertitle','Popis žanrova')
@section('activezanrovi','active')

@section('content')
  <div class="col-12 col-xl-12">
    <div class="card">
      <div class="card-header">
        <div class="float-end">
        @if($_user->canmodel('create','Genre'))
           <a href="{{ route('genres.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Kreiraj žanr</a>
        @endif
        </div>
        <h5 class="card-title">Popis žanrova</h5>
        {{--<div class="card-subtitle">PODNASLOV</div>--}}
      </div>
      <div class="card-body">
        <form method="GET" action="{{ route('genres.index') }}" role="form">
          <div class="d-flex col-md-4 col-sm-8">
            <div class="pe-2" style="line-height:1.75rem">Filtriraj:</div>
            {{ Form::text('naziv', $request->input('naziv'), ['class' => 'form-control', 'placeholder' => 'Naziv'])}}
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
                    <th width="60"></th>
            </tr>
          </thead>
          <tbody>
          @foreach ($genres as $genre)
            <tr>
              <td>
              @if($_user->canmodel('edit','Genre',$genre))
                <a class="btn btn-sm" href="{{ route('genres.edit',$genre) }}" title="Uredi"><i class="fas fa-pen"></i></a>
              @endif
              <a href="{{route('genres.show',$genre->id)}}">{{$genre->naziv}}</a>
             </td>
              @if($_user->canmodel('delete','Genre',$genre))
              <td>
                <form action="{{ route('genres.destroy',$genre->id) }}" method="POST">
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
    {!! $genres->appends(\Request::except('page'))->render() !!}
  </div>
@endsection
