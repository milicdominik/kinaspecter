@extends('layouts.master')

@section('headertitle','Kreiraj žanr')
@section('activezanrovi','active')

@section('content')
<div class="col-12 col-xl-12">
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('genres.store') }}"  role="form" enctype="multipart/form-data">
                @csrf
                @include('genre.form')
            </form>
        </div>
    </div>
</div>
@endsection
