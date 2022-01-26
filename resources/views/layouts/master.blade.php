@php
$_user = auth()->user();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <meta name="description" content="{{config('app.short_title')}} — {{config('app.name')}}">
    <meta name="author" content="Dominik Milić">
    <title>{{config('app.name')}} — {{config('app.short_title')}}</title>

    <link rel="shortcut icon" type="image/png" href="/slike/favicon.ico">
		<link rel="icon" type="image/png" href="/slike/favicon.ico">

    <link href="/res/spark/css/modern.css" rel="stylesheet">
    <link href="/res/lib/core/css.css?v={{md5(config('kina.version'))}}" rel="stylesheet">
    <link href="/res/lib/core/media.css?v={{md5(config('kina.version'))}}" rel="stylesheet">
    <link href="/res/lib/icheck/skins/square/blue.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('head')
  </head>
  <body>
    {{--<div class="splash active"><div class="splash-icon"></div></div>--}}
    <div class="wrapper">
      <nav id="sidebar" class="sidebar">
  			<a class="sidebar-brand" href="/">
  				<svg>
  					<use xlink:href="#icon-ef6739d1" xmlns:xlink="http://www.w3.org/1999/xlink"></use>
  				</svg>
  				{{config('app.short_title')}}
  			</a>
  			<div class="sidebar-content">
  	      @include('layouts.includes.sidebar')
  			</div>
  		</nav>

      <div class="main">
        <nav class="navbar navbar-expand navbar-theme">
				<a class="sidebar-toggle d-flex me-2">
					<i class="hamburger align-self-center"></i>
				</a>

				<form class="d-none d-sm-inline-block">
          @auth
					<!--<input class="form-control form-control-lite" type="text" placeholder="Pretraga...">-->
          @endauth
				</form>

				<div class="navbar-collapse collapse">
          @auth
            @include('layouts.includes.topright_user')
          @else
            @include('layouts.includes.topright_guest')
          @endauth
				</div>

			</nav>{{--/ end top nabvar --}}

      <main class="content">
        <div class="container-fluid">

          <div class="header @yield('headerclass')">
						<h1 class="header-title">
							@yield('headertitle', 'TITLE PLACEHOLDER')
						</h1>
            @hasSection('headersubtitle')
              <p class="header-subtitle">
              @yield('headersubtitle')
              </p>
            @endif
            @hasSection('breadchrumb')
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  {{--<li class="breadcrumb-item active"><a href="dashboard-default.html">Dashboard</a></li>--}}
                  @yield('breadchrumb')
                </ol>
              </nav>
            @endif
					</div>
          <div class="row">
            @yield('content')
          </div>
        </div>
      </main>

      </div>{{--/.main--}}


    </div>
    <svg width="0" height="0" style="position:absolute" xmlns="http://www.w3.org/2000/svg">
      <symbol id="icon-ef6739d1" viewBox="0 0 87.129 87.129" id=".7671302402618265" xmlns="http://www.w3.org/2000/svg">
       <g fill="#fff">
       <path d="M43.564 55.433c.361 0 .723-.092 1.047-.277l17.562-9.997v14.62c-3.671 1.572-8.789 2.662-14.309 3.022a2.116 2.116 0 0 0 .275 4.224c5.281-.345 10.133-1.287 14.033-2.698v7.184a2.113 2.113 0 0 0-1.634 2.056v7.435c0 1.17.947 2.117 2.116 2.117.662 0 1.246-.31 1.634-.786.389.476.973.786 1.635.786a2.116 2.116 0 0 0 2.116-2.117v-7.435a2.115 2.115 0 0 0-1.635-2.057V41.185c0-.761-.408-1.463-1.068-1.839L45.2 27.883a2.116 2.116 0 1 0-2.095 3.678l17.199 9.79-16.74 9.529L6.395 29.722 43.564 8.563l20.675 11.769a2.118 2.118 0 0 0 2.094-3.679L44.611 4.288a2.116 2.116 0 0 0-2.094 0L1.069 27.883a2.118 2.118 0 0 0 0 3.678l41.448 23.595c.325.184.686.277 1.047.277zM86.059 27.883l-12.047-6.859a2.116 2.116 0 1 0-2.095 3.678l8.816 5.02-6.328 3.602a2.117 2.117 0 0 0 2.095 3.68l9.559-5.441a2.117 2.117 0 0 0 0-3.68zM17.576 48.875a2.116 2.116 0 0 0-2.116 2.117v4.171c0 4.777 5.464 8.68 14.991 10.71a2.112 2.112 0 0 0 2.511-1.629 2.117 2.117 0 0 0-1.63-2.511c-7.642-1.627-11.641-4.537-11.641-6.569v-4.171a2.115 2.115 0 0 0-2.115-2.118z"/>
       <path d="M37.054 63.279a2.137 2.137 0 0 0-.621 1.496c0 .558.227 1.1.621 1.496.396.395.938.621 1.496.621a2.124 2.124 0 0 0 2.116-2.117c0-.557-.226-1.101-.621-1.496-.783-.783-2.208-.783-2.991 0z"/>
       </g>
       </symbol>
  	</svg>

    <div aria-live="polite" aria-atomic="true">
      <div class="toast-container position-fixed bottom-0 end-0 p-3 fixed" id="toast-container" style="z-index:1100">
        <!-- toasts are created dynamically -->
      </div>
      <div class="toast-container position-fixed p-3 top-0 start-50 translate-middle-x" id="toast-container-top">
        <!-- toasts are created dynamically -->
      </div>
    </div>

    @stack('modals')
    <div class="modal fade" id="modalconfirm" tabindex="-1" aria-labelledby="modalconfirmlabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Upozorenje</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
          </div>
          <div class="modal-body">...</div>
          <div class="modal-footer">
            <a href="#" id="modalconfirm_confirmbtn" class="confirm btn btn-primary">Potvrdi</a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Poništi</button>
          </div>
        </div>
      </div>
    </div>
    <script>
    //moment.locale('{{ config('app.locale') }}')
    </script>
    <script src="/res/spark/js/app.js"></script>
    <script src="/res/lib/icheck/icheck.min.js"></script>
    <script src="/res/lib/core/js.js?v={{md5(config('kina.version'))}}"></script>
    <script src="/res/lib/core/geolocation.js?v={{md5(config('kina.version'))}}"></script>
    <script src="/res/lib/ratyfa/jquery.raty-fa.js"></script>
    <script src="/res/lib/circleprogress/dist/jquery.circle-progress.js"></script>
    @yield('javascript_ondemand')
    @stack('javascript')
    {{--low priority stack javascript2--}}
    @stack('javascript2')
    @if ($smsg = Session::get('success'))
      <script>$(function(){showToast(false,'{{ $smsg }}', 'green','topcenter')})</script>
    @endif
    @if ($smsg = Session::get('error'))
      {{--<script>$(function(){showToast('{{__('netcom.Error')}}','{{ $smsg }}', 'red','topcenter')})</script>--}}
      <script>$(function(){showToast(false,'{{ $smsg }}', 'red','topcenter')})</script>
    @endif
    @if ($smsg = Session::get('info'))
      <script>$(function(){showToast('{{__('kina.Information')}}','{{ $smsg }}', 'blue','topcenter')})</script>
    @endif

    @if ($errors->any())
      {{-- validation errors --}}
      @foreach ($errors->all() as $error)
          <script>$(function(){showToast(false,'{{ $error }}<br />', 'red','topcenter')})</script>
      @endforeach
    @endif
  </body>
</html>
