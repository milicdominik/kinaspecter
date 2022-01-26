@extends('layouts.master')

@section('headertitle','Cinestar Specter')
@section('breadchrumb')
<li class="breadcrumb-item active"><a href="/">Dobrodošli</a></li>
@endsection
@section('activedash','active')

@section('content')
  <div class="col-xl-6 col-xxl-5 d-flex">
    <div class="w-100">
			<div class="row">
        <div class="card">
          <div class="card-header">
									<h5 class="card-title">Kino dvorane Specter</h5>
								</div>
          <div class="card-body">
            <div class="mb-0 mt-0 text-muted">
              Zaposlenik ste.<br />
              Ako mislite da je ovo greška javite se nadležnim osobama.<br /><br />
            @if(auth()->user()->is_administracija)
              <a class="btn btn-warning" href="#" onclick="return adminaccessmodal(this);"><i class="align-middle me-1 fas fa-fw fa-cogs"></i> Admin</a>
            @endif
              <a class="btn btn-primary" href="/logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();return false;">Izlaz</a>
            </div>
          </div>
        </div>
			</div>
		</div>
  </div>
  <div class="col-xl-6 col-xxl-7 d-flex"></div>
@endsection
