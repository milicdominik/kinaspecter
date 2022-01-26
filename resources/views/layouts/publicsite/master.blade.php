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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="/css/kina.css" rel="stylesheet">
    <link href="/css/lightbox.css" rel="stylesheet">

    <script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript" src="/js/cycle2.js"></script>
    <script type="text/javascript" src="/js/declarativeToggle.js"></script>
    <script type="text/javascript" src="/js/lightbox.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('head')
  </head>
  <body>
    {{--<div class="splash active"><div class="splash-icon"></div></div>--}}
    <header class="section">
    			<div class="container">
    				<a class="btn btn-info float-right btn-sm" href="{{route('login')}}" role="button">Prijavi se</a>
    				<h1>@yield('headertitle', 'TITLE PLACEHOLDER')</h1>
    				<p class="hide-small">@yield('headerp', 'TITLE PLACEHOLDER')</p>
  	        @include('layouts.publicsite.includes.sidebar')

            @yield('content')

    <script>
    //moment.locale('{{ config('app.locale') }}')
    </script>
    @yield('javascript_ondemand')
    @stack('javascript')
    {{--low priority stack javascript2--}}
    @stack('javascript2')

    <footer>
    		<p>&copy; 2022 - Radno vrijeme: pon-ned od 10h do 00h.</p>
    </footer>
  </body>
</html>
