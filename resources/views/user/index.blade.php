@php
  $_user = auth()->user();
@endphp
@extends('layouts.master')

@section('headertitle','Popis korisnika')
@section('activekorisnici','active')

@section('content')
  <div class="col-12 col-xl-12">
    <div class="card">
      <div class="card-header">
        <div class="float-end">
        @if($_user->canmodel('create','User'))
           <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Kreiraj korisnika</a>
        @endif
        </div>
        <h5 class="card-title">Popis korisnika</h5>
        {{--<div class="card-subtitle">PODNASLOV</div>--}}
      </div>
      <div class="card-body">
        <form method="GET" action="{{ route('users.index') }}" role="form">
          <div class="d-flex">
            <div class="pe-2" style="line-height:1.75rem">Filtriraj:</div>
            {{ Form::text('prezime', $request->input('prezime'), ['class' => 'form-control', 'placeholder' => 'Prezime'])}}
            <div class="pe-2"></div>
            {{ Form::text('ime', $request->input('ime'), ['class' => 'form-control', 'placeholder' => 'Ime'])}}
            <div class="pe-2"></div>
            {{ Form::text('oib', $request->input('oib'), ['class' => 'form-control', 'placeholder' => 'OIB'])}}
            <div class="pe-2"></div>

            <div><button type="submit" class="btn btn-light">Filtriraj</button></div>
          </div>
        </form>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-hover table-sm">
          <thead class="thead">
            <tr>
										<th>@sortablelink('prezime','Prezime i ime')</th>
                    <th>E-mail adresa</th>
                    <th>OIB</th>
                    <th>Broj mobitela</th>
                    <th>@sortablelink('dat_god_rodenja', 'Datum i godina rođenja')</th>
                    @if($_user->hasAdminAccess())
                      <th>Status</th>
                      <th>Administrator</th>
                    @endif
                    <th width="60"></th>
            </tr>
          </thead>
          <tbody>
          @foreach ($users as $user)
            <tr>
              <td>
              @if($_user->canmodel('edit','User',$user))
                <a class="btn btn-sm" href="{{ route('users.edit',$user) }}" title="Uredi"><i class="fas fa-pen"></i></a>
              @endif
              @include('user.components.avatar_and_link',['user' => $user])
              @if(!$user->is_posjetitelj)
                <span class="badge bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Zaposlenik">Z</span>
              @endif
              @if($user->is_administracija)
                <span class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Administrator">A</span>
              @endif
             </td>
             <td><a href="mailto:{{$user->email}}"><i class="far fa-envelope"></i></a> {{ $user->email }}</td>
             <td>{{ $user->oib }}</td>
             <td>{{ $user->mobitel }}</td>
             <td>{{ $user->display_date}}</td>
             @if($_user->hasAdminAccess())
               <td>{{ config('privilegije.zaposlenik')[$user->is_posjetitelj] }}</td>
               <td>{{ config('privilegije.administrator')[$user->is_administracija] }}</td>
             @endif
              @if($_user->canmodel('delete','User',$user))
              <td>
                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm" id="del_{{$user->id}}" onclick="return kina_confirm(this,'Brisati korisnika?',true)" title="Obriši"><i class="fas fa-fw fa-trash"></i></button>
                </form>
              </td>
              @endif
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {!! $users->appends(\Request::except('page'))->render() !!}
  </div>
@endsection
