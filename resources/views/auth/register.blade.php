@extends('layouts.master')

@section('headertitle', 'REGISTRACIJA')

@section('content')
<div class="card login-card" style="margin:auto">
    <a class="btn btn-sm" href="{{ route('home') }}"><i class="align-middle fas fa-fw fa-times float-end"></i></a>
    <h3 class="card-header text-center"><i class="far fa-user"></i> Registracija {{-- {{ __('Register') }} --}}</h3>
    <div class="card-body">
      <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="form-group row mb-3">
              <label for="ime" class="col-md-4 col-form-label text-md-right">Ime {{-- {{ __('Name') }} --}}</label>

              <div class="col-md-6">
                <input id="ime" type="text" class="form-control @error('ime') is-invalid @enderror" name="ime" value="{{ old('ime') }}" placeholder="Unesite Vaše ime" required autocomplete="ime" autofocus>

                @error('ime')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
          </div>

          <div class="form-group row  mb-3">
            <label for="prezime" class="col-md-4 col-form-label text-md-right">Prezime {{-- {{ __('Surname') }} --}}</label>

            <div class="col-md-6">
              <input id="prezime" type="text" class="form-control @error('prezime') is-invalid @enderror" name="prezime" value="{{ old('prezime') }}" placeholder="Unesite Vaše prezime" required autocomplete="prezime" autofocus>

              @error('prezime')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>

          <div class="form-group row mb-3">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }} {{-- {{ __('E-Mail Address') }} --}}</label>

              <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Unesite Vašu E-mail adresu" required autocomplete="email">

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row mb-3">
              <label for="oib" class="col-md-4 col-form-label text-md-right">Osobni identifikacijski broj (OIB) {{-- {{ __('E-Mail Address') }} --}}</label>

              <div class="col-md-6">
                  <input id="oib" type="text" class="form-control @error('oib') is-invalid @enderror" name="oib" value="{{ old('oib') }}" placeholder="Unesite Vaš OIB" required autocomplete="oib">

                  @error('oib')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row mb-3">
              <label for="mobitel" class="col-md-4 col-form-label text-md-right">Broj mobitela {{-- {{ __('E-Mail Address') }} --}}</label>

              <div class="col-md-6">
                  <input id="mobitel" type="text" class="form-control @error('mobitel') is-invalid @enderror" name="mobitel" value="{{ old('mobitel') }}" placeholder="Unesite Vaš broj mobitela" required autocomplete="mobitel">

                  @error('mobitel')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row mb-3">
              <label for="dat_god_rodenja" class="col-md-4 col-form-label text-md-right">Datum i godina rođenja {{-- {{ __('E-Mail Address') }} --}}</label>

              <div class="col-md-6">
                  <input id="dat_god_rodenja" type="text" class="form-control @error('dat_god_rodenja') is-invalid @enderror" name="dat_god_rodenja" value="{{ old('dat_god_rodenja') }}" placeholder="Unesite Vaš datum i godinu rođenja" required autocomplete="dat_god_rodenja">

                  @error('dat_god_rodenja')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row mb-3">
              <label for="password" class="col-md-4 col-form-label text-md-right">Lozinka {{-- {{ __('Password') }} --}}</label>

              <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Unesite lozinku" required autocomplete="new-password">

                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row mb-3">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Potvrdi lozinku {{-- {{ __('Confirm Password') }} --}}</label>

              <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Potvrdite lozinku" required autocomplete="new-password">
              </div>
          </div>

          <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                      {{-- {{ __('Register') }} --}}
                      Registriraj se
                  </button>
              </div>
          </div>
      </form>
    </div>
</div>
@endsection
