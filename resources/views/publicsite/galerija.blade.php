@extends('layouts.publicsite.master')

@section('headertitle','Multiplex Cinestar Specter')
@section('headerp','Galerija slika')
@section('Galerija','active')

@section('content')
  <div class="content-area group section">
			<div class="container">
				<div class="row">
					<div class="col col-md-8 push-down-sm">
						<h2 class="mb-3">Galerija slika!</h2>
						<div class="thumbnails group">
							<a href="slike/hall.jpg" data-lightbox="gallery" data-title="This is a hall">
                                <img src="slike/hall-thumb.jpg" alt="Hall"></a>
							<a href="slike/hall2.jpg" data-lightbox="gallery"><img src="slike/hall2-thumb.jpg" alt="Hodnik"></a>
							<a href="slike/hall3.jpg" data-lightbox="gallery"><img src="slike/hall3-thumb.jpg" alt="Hodnik1"></a>
							<a href="slike/dvorana.jpg" data-lightbox="gallery"><img src="slike/dvorana-thumb.jpg" alt="Mala dvorana"></a>
							<a href="slike/dvorana2.jpg" data-lightbox="gallery"><img src="slike/dvorana2-thumb.jpg" alt="Velika dvorana"></a>
							<a href="slike/dvorana3.jpg" data-lightbox="gallery"><img src="slike/dvorana3-thumb.jpg" alt="Srednja dvorana"></a>
							<a href="slike/gold.jpg" data-lightbox="gallery"><img src="slike/gold-thumb.jpg" alt="Gold"></a>
							<a href="slike/gold2.jpg" data-lightbox="gallery"><img src="slike/gold2-thumb.jpg" alt="Gold1"></a>
							<a href="slike/VIP.jpg" data-lightbox="gallery"><img src="slike/VIP-thumb.jpg" alt="VIP"></a>
							<a href="slike/VIP2.jpg" data-lightbox="gallery"><img src="slike/VIP2-thumb.jpg" alt="VIP2"></a>
						</div>
					</div>
					<div class="col col-md-4 sidebar">
						<h3>Prostor i dvorane</h3>
						<p>
							Svi naši multiplex prostori te kino dvorane u bilo kojim gradovima identičnog su izgleda pošto je naša vizija prepoznatljivost brenda gdje god
							se nalazili.
						</p>
						<p>
							Ovdje možete pogledati kako izgleda naš glavni prostor, hodnik do dvorana, prostor za opuštanje
							te i same dvorane (VIP dvorana, Velika dvorana, Srednja dvorana, Mala dvorana).
						</p>
						<img class="logo" src="slike/Logo.png" class="Logo">
					</div>
				</div>
			</div>
		</div>
@endsection
