@extends('layouts.publicsite.master')

@section('headertitle','Multiplex Cinestar Specter')
@section('headerp','Srednja dvorana')
@section('SrednjaDvorana','active')

@section('content')
  <div class="content-area group section">
			<div class="container">
				<div class="row">
					<div class="col col-md-8 push-down-sm">
            <div class="main-area">
                <h2 class="mb-3">Srednja dvorana</h2>
            </div>
            <div class="image-banner">
							<img src="slike/dvorana2.jpg" alt="Srednja dvorana">

							<div class="banner-description">
								<p>Slika srednje dvorane</p>
							</div>
						</div>
						<div class="image-banner">
							<img src="slike/rijeka.jpg" alt="Srednja dvorana">

							<div class="banner-description">
								<p>2. Slika srednje dvorane</p>
							</div>
						</div>
          </div>
          <div class="col col-md-4 sidebar">
              <h3>Srednja kino dvorana</h3>
              <p>Srednja kino dvorana sastoji se od 250 sjedećih mjesta. Opremljena je sa normalnim sjedalima, ljubavnim sjedalima te VIP sjedalima. Sva sjedala su visoke kvalitete te udobna
                  za duže gledanje filma / predstave.
              </p>
						<div class="d-flex justify-content-center">
							<img class="logo" src="slike/Logo.png" class="Logo">
						</div>
          </div>
      </div>
  </div>
</div>
@endsection
