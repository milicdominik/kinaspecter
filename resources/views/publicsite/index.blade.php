@extends('layouts.publicsite.master')

@section('headertitle','Multiplex Cinestar Specter')
@section('headerp','Dobrodošli na web stranicu Multiplex Cinestara Specter!')
@section('Naslovna','active')

@section('content')
  <div class="content-area group section">
			<div class="container">
				<div class="row">
					<div class="col col-md-8 push-down-sm">
						<h2 class="mb-3">Nalazimo se u gradovima: </h2>
						<div class="row boxes">
							<div class="col col-sm-6 col-lg-3">
								<div class="box-a">
									<p>Rijeka</p>
								</div>
							</div>
							<div class="col col-sm-6 col-lg-3">
								<div class="box-a">
									<p>Zagreb</p>
								</div>
							</div>
							<div class="col col-sm-6 col-lg-3">
								<div class="box-a">
									<p>Split</p>
								</div>
							</div>
							<div class="col col-sm-6 col-lg-3">
								<div class="box-a">
									<p>Osijek</p>
								</div>
							</div>
						</div>
						<img src="slike/star.png" class="star">
					</div>
					<div class="col col-md-4 sidebar">
						<h3>Specter – najveći i vodeći u Hrvatskoj</h3>
						<p>
							Danas, Specter grupa u Hrvatskoj (Rijeka, Zagreb, Osijek, Split) ubraja 4 CineStar multipleks kina, 16 kino dvorana i preko 3.200 sjedala,
							što s očekivanih gotovo 4,5 milijuna prodanih ulaznica godišnje čini CineStar najvećim i najuspješnijim kinoprikazivačem u regiji.
						</p>

						<p>
							Osim toga, među najbolje svjetske kino operatere svrstava ga i opremljenost dvorana najsuvremenijim tehnologijama u skladu s posljednjim svjetskim trendovima i
							standardima te činjenica da je Spectre ekskluzivno publici ponudio najsuperiornije kino-formate IMAX i 4DX te je u svoja kina uveo digitalnu 3D tehnologiju,
							eXtreme dvorane, Auro 11.1 3D zvuk, 4K tehnologiju. Multipleksi CineStar Specter potpuno su digitalizirana kina.
						</p>

						<p>
							Multiplex Cinestar Spectre Rijeka, najveće je kino u Hrvatskoj, opremljeno najsuvremenijom tehnologijom, laserskim projektorima,
							a u revolucionarnoj 4DX™ dvorani posjetitelji mogu doživjeti film u četiri dimenzije s čak 15 posebnih efekata.
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col col-md-8 push-down-sm">
						<div class="cycle-slideshow" data-cycle-slides=".slide" data-cycle-pause-on-hover="true">

							<span class="cycle-prev">&laquo;</span>
							<span class="cycle-next">&raquo;</span>

							<span class="cycle-pager"></span>

							<div class="slide">
								<img src="slike/rijeka.jpg" alt="Rijeka">
								<div class="slide-text">
									<h3>Rijeka</h3>
									<p>Slika Multiplex Cinestara Spectre u Rijeci. <a href="dvorana2.html" class="btn-a">Idi na dvoranu!</a> </p>
								</div>
							</div>
							<div class="slide">
								<img src="slike/zagreb.jpg" alt="Zagreb">
								<div class="slide-text">
									<h3>Zagreb</h3>
									<p>Slika Multiplex Cinestara Spectre u Zagrebu.</p>
								</div>
							</div>
							<div class="slide">
								<img src="slike/split.jpg" alt="Split">
								<div class="slide-text">
									<h3>Split</h3>
									<p>Slika Multiplex Cinestara Spectre u Splitu.</p>
								</div>
							</div>
							<div class="slide">
								<img src="slike/osijek.jpg" alt="Osijek">
								<div class="slide-text">
									<h3>Osijek</h3>
									<p>Slika Multiplex Cinestara Spectre u Osijeku.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col col-md-4 sidebar">
						<div class="d-flex justify-content-center">
							<img src="slike/Logo.png" alt="Logo">
						</div>
					</div>
				</div>
			</div>
		</div>
  @endsection
