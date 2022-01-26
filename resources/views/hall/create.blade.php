@extends('layouts.master')

@section('headertitle','Kreiraj dvoranu')
@section('activedvorane','active')

@section('content')
<div class="col-12 col-xl-12">
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('halls.store') }}"  role="form" enctype="multipart/form-data">
                @csrf
                @include('hall.form')
            </form>
        </div>
    </div>
</div>
@endsection
