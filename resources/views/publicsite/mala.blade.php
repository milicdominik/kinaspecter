@extends('layouts.publicsite.master')

@section('headertitle','Multiplex Cinestar Specter')
@section('headerp','Mala dvorana')
@section('MalaDvorana','active')

@section('content')
  <div class="content-area group section">
  			<div class="container">
  				<div class="row">
  					<div class="col col-md-8 push-down-sm">
              <div class="main-area">
                  <h2 class="mb-3">Mala dvorana</h2>
              </div>
              <div class="image-banner">
  							<img src="slike/dvorana.jpg" alt="Mala dvorana">

  							<div class="banner-description">
  								<p>Slika male dvorane</p>
  							</div>
  						</div>
  						<div class="image-banner">
  							<img src="slike/zagreb.jpg" alt="Mala dvorana">

  							<div class="banner-description">
  								<p>2. Slika male dvorane</p>
  							</div>
  						</div>
            </div>
            <div class="col col-md-4 sidebar">
                <h3>Mala kino dvorana</h3>
                <p>Mala kino dvorana sastoji se od 150 sjedećih mjesta. Opremljena je sa normalnim sjedalima te ljubavnim sjedalima. Sva sjedala su visoke kvalitete te udobna
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
