@extends('layouts.empty')

@section('content')
  <div class="card login-card" style="margin:auto">
      <a class="btn btn-sm" href="{{ route('naslovna') }}"><i class="align-middle fas fa-fw fa-times float-end"></i></a>
      <h3 class="card-header text-center">Cinestar Specter Prijava</h3>
      <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row">
              <div class=" mb-3 input-group">
                {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label> --}}
                <div class="login-input-group-text">
                    <i class="far fa-user"></i>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail" required autocomplete="email" autofocus>
                </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
            </div>

            <div class="form-group row">
              <div class=" mb-3 input-group">
                {{-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> --}}
                <div class="login-input-group-text">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Lozinka" required autocomplete="current-password">
                </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 col-6">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            Zapamti me {{-- {{ __('Remember Me') }} --}}
                        </label>
                    </div>
                </div>

                <div class="col-md-12 mb-3 password-reset-link">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{-- {{ __('Forgot Your Password?') }} --}}
                            Zaboravili ste lozinku?
                        </a>
                    @endif
                </div>

                <div class="col-md-12 col-12">
                    <button type="submit" class="btn btn-primary">
                      {{-- {{ __('Login') }} --}}
                      Prijava
                    </button>
                </div>

                <div class="col-md-12 mb-3 pt-3 text-center">
                    @if (Route::has('register'))
                      Niste član?
                      <a href="{{ route('register') }}">
                        Registrirajte se sada
                      </a>
                    @endif
                </div>

                <div class="col-md-12 col-12 pt-4 small text-center">
                  Sva prava pridržana &copy; {{\date('Y')}} {{config('app.short_title')}}
                  <div>
                    <a href="{{route('politika_privatnosti')}}">Politika privatnosti</a>
                  </div>
                {{--<div>
                    by Cinestar Specter
                  </div>--}}
                </div>

            </div>
        </form>
      </div>
  </div>

@endsection
