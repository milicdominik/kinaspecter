@extends('layouts.master')

@section('headertitle','Kreiraj predstavu')
@section('activepredstave','active')

@section('content')
<div class="col-12 col-xl-12">
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('shows.store') }}"  role="form" enctype="multipart/form-data">
                @csrf
                @include('show.form')
            </form>
        </div>
    </div>
</div>
@endsection
