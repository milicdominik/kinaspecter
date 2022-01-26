@extends('layouts.master')

@section('headertitle','Kreiraj sjedište')
@section('activesjedista','active')

@section('content')
<div class="col-12 col-xl-12">
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('seats.store') }}"  role="form" enctype="multipart/form-data">
                @csrf
                @include('seat.form')
            </form>
        </div>
    </div>
</div>
@endsection
