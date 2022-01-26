@auth
<div class="sidebar-user">
  <img src="{{$_user->avatar_url}}" class="img-fluid rounded-circle mb-2 zoom zoom-sm" alt="Avatar" />
  <a class="fw-bold d-block text-dark" href="{{route('profile.show',$_user)}}">{{$_user->puno_prezime_ime}}</a>
  <small>
    {{implode(', ',$_user->uloge)}}
  </small>
</div>


<ul class="sidebar-nav">
  {{--<li class="sidebar-header">
    Main
  </li>--}}

  @if(!$_user->is_posjetitelj && $_user->hasAdminAccess())
    <li class="sidebar-item @yield('activedashadmin')">
      <a class="sidebar-link" href="/dash">        {{-- href="/dash/administracija" --}}
        <i class="align-middle me-2 fa-fw fas fa-tachometer-alt text-danger"></i> <span class="align-middle">Admin. nadzorna ploča</span>
      </a>
    </li>
    <li class="sidebar-item @yield('activedash')">
      <a class="sidebar-link" href="/dash">
        <i class="align-middle me-2 fa-fw fas fa-tachometer-alt"></i> <span class="align-middle">Nadzorna ploča</span>
      </a>
    </li>
  @else
    <li class="sidebar-item @yield('activedash') @yield('activedashadmin')">
      <a class="sidebar-link" href="/dash">
        <i class="align-middle me-2 fa-fw fas fa-tachometer-alt"></i> <span class="align-middle">Nadzorna ploča</span>
      </a>
    </li>
  @endif

    {{--<li class="sidebar-item @yield('activepregledsatnicekalendar')">
    		<a class="sidebar-link" href="{{route('pregledsatnice.kalendar',$_akg)}}">
    			<i class="align-middle me-2 far fa-fw fa-calendar-alt"></i> <span class="align-middle">Kalendar</span>
    		</a>
    	</li>--}}

  @if(!$_user->hasAdminAccess() && $_user->is_posjetitelj)
    <li class="sidebar-item @yield('activekorisnici')">
      <a class="sidebar-link" href="{{route('users.index')}}">
        <i class="align-middle me-2 fas fa-users"></i> <span class="align-middle">Korisnici</span>
      </a>
    </li>

    <li class="sidebar-item">
      <a data-bs-target="#predstave" data-bs-toggle="collapse" class="sidebar-link collapsed">
        <i class="align-middle me-2 fa-fw fas fa-film"></i> <span class="align-middle">Predstave</span>
      </a>
      <ul id="predstave" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
        <li class="sidebar-item @yield('activepredstave')"><a class="sidebar-link" href="{{route('shows.index')}}">Predstave</a></li>
      </ul>
    </li>

    <li class="sidebar-item @yield('activerezervacije')">
      <a class="sidebar-link" href="{{route('reservations.index')}}">
        <i class="align-middle me-2 fas fa-book"></i> <span class="align-middle">Rezervacije</span>
      </a>
    </li>
  @endif

  @if(($_user->hasAdminAccess() && !$_user->is_posjetitelj) || (!$_user->hasAdminAccess() && !$_user->is_posjetitelj))
  <li class="sidebar-item @yield('activekorisnici')">
    <a class="sidebar-link" href="{{route('users.index')}}">
      <i class="align-middle me-2 fas fa-users"></i> <span class="align-middle">Korisnici</span>
    </a>
  </li>

  <li class="sidebar-item">
    <a data-bs-target="#dvorane" data-bs-toggle="collapse" class="sidebar-link collapsed">
      <i class="align-middle me-2 fa-fw fas fa-university"></i> <span class="align-middle">Dvorane i sjedišta</span>
    </a>
    <ul id="dvorane" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#dvorane">
      <li class="sidebar-item @yield('activesjedista')"><a class="sidebar-link" href="{{route('seats.index')}}">Sjedišta</a></li>
      <li class="sidebar-item @yield('activedvorane')"><a class="sidebar-link" href="{{route('halls.index')}}">Dvorane</a></li>
    </ul>
  </li>


  <li class="sidebar-item">
    <a data-bs-target="#predstave" data-bs-toggle="collapse" class="sidebar-link collapsed">
      <i class="align-middle me-2 fa-fw fas fa-film"></i> <span class="align-middle">Predstave</span>
    </a>
    <ul id="predstave" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
      <li class="sidebar-item @yield('activezanrovi')"><a class="sidebar-link" href="{{route('genres.index')}}">Žanrovi</a></li>
      <li class="sidebar-item @yield('activefilmovi')"><a class="sidebar-link" href="{{route('movies.index')}}">Filmovi</a></li>
      <li class="sidebar-item @yield('activepredstave')"><a class="sidebar-link" href="{{route('shows.index')}}">Predstave</a></li>
    </ul>
  </li>
  {{--<li class="sidebar-header">Administracija</li>--}}
  <li class="sidebar-item @yield('activerezervacije')">
    <a class="sidebar-link" href="{{route('reservations.index')}}">
      <i class="align-middle me-2 fas fa-book"></i> <span class="align-middle">Rezervacije</span>
    </a>
  </li>
@endif
<li class="sidebar-item @yield('activestranica')">
  <a class="sidebar-link" href="{{route('naslovna')}}">
    <i class="align-middle me-2 fas fa-share"></i> <span class="align-middle">Web stranica</span>
  </a>
</li>

  <li>
    <div class="text-center text-muted small mt-3" title="Last build date {{config('kina.version_build_date')}} by Cinestar Specter">
      Specter v{{config('kina.version')}} &copy; {{\date('Y')}}
      <div>
        <a href="{{route('politika_privatnosti')}}">Politika privatnosti</a>
      </div>
{{--
      <div class="hidden">

        <a href="#" onclick="ncxgeo_startTracking();return false">GeoTest</a>
        <div>
          T: <span id="ts"></span><br />
          La: <span id="la"></span><br />
          Lo: <span id="lo"></span><br />
          ACC: <span id="acc"></span><br />
          Al: <span id="al"></span><br />
          AlACC: <span id="al_acc"></span><br />
          <a href="#" id="map" target="_blank">MAP</a>
        </div>
      </div>
--}}
    </div>
  </li>


</ul>
@endauth
