@extends('layouts.publicsite.master')

@section('headertitle','Multiplex Cinestar Specter')
@section('headerp','Kino dvorane')
@section('Dvorane','active')

@section('content')
  <div class="content-area group section">
			<div class="container">
                <div class="main-area">
                    <h2 class="mb-3">Kino dvorane</h2>
                    <p>Kina Multiplex Cinestar Specter raspolažu sa 4 dvorane (Mala, Srednja, Velika te VIP dvorana).</p>
                </div>
                <div class="fixed-size-container">
                    <div class="fixed-size">Mala</div>
                    <div class="fixed-size">Srednja</div>
                    <div class="fixed-size">Velika</div>
                    <div class="fixed-size">VIP</div>
                </div>
				<div class="d-flex justify-content-center">
					<img class="logo" src="slike/Logo.png" class="Logo">
				</div>
      </div>
	</div>
@endsection
