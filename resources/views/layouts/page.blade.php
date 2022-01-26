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
    <link href="/res/lib/core/login.css?v={{md5(config('kina.version'))}}" rel="stylesheet">
    <link href="/res/lib/core/media.css?v={{md5(config('kina.version'))}}" rel="stylesheet">
    <link href="/res/lib/icheck/skins/square/blue.css" rel="stylesheet">
    @stack('head')
  </head>
  <body>
    <div class="wrapper">
      <div class="main">
      <main class="content">
        <div class="container-fluid pt-1">
          <div class="logotop"></div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Početna</a></li>
              @yield('breadchrumb')
            </ol>
          </nav>
          <div class="row">
						<div class="col-12">
              @yield('content')
						</div>
					</div>
        </div>
      </main>
      </div>{{--/.main--}}
    </div>
  </body>
</html>
