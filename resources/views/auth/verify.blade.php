@extends('layouts.empty')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Potvrdi svoju Email adresu {{-- {{ __('Verify Your Email Address') }} --}}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{-- {{ __('A fresh verification link has been sent to your email address.') }} --}}
                            Novi link za potvrdu Email adrese je poslan na vašu email adresu.
                        </div>
                    @endif

                    {{-- {{ __('Before proceeding, please check your email for a verification link.') }} --}}
                    Prije nastavka molimo provjerite da li ste dobili link za potvrdu adrese na svoj email.
                    {{-- {{ __('If you did not receive the email') }} --}}
                    Ako niste dobili email,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Kliknite ovdje kako bi poslali ponovo {{-- {{ __('click here to request another') }} --}}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
