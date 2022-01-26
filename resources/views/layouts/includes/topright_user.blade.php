<ul class="navbar-nav ms-auto">
{{--<li class="nav-item dropdown active">
    <a class="nav-link dropdown-toggle position-relative" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
      <i class="align-middle fas fa-envelope-open"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
      <div class="dropdown-menu-header">
        <div class="position-relative">
          4 New Messages
        </div>
      </div>
      <div class="list-group">
        <a href="#" class="list-group-item">
          <div class="row g-0 align-items-center">
            <div class="col-2">
              <img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Michelle Bilodeau">
            </div>
            <div class="col-10 ps-2">
              <div class="text-dark">Michelle Bilodeau</div>
              <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
              <div class="text-muted small mt-1">5m ago</div>
            </div>
          </div>
        </a>
        <a href="#" class="list-group-item">
          <div class="row g-0 align-items-center">
            <div class="col-2">
              <img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Kathie Burton">
            </div>
            <div class="col-10 ps-2">
              <div class="text-dark">Kathie Burton</div>
              <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
              <div class="text-muted small mt-1">30m ago</div>
            </div>
          </div>
        </a>
        <a href="#" class="list-group-item">
          <div class="row g-0 align-items-center">
            <div class="col-2">
              <img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="Alexander Groves">
            </div>
            <div class="col-10 ps-2">
              <div class="text-dark">Alexander Groves</div>
              <div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
              <div class="text-muted small mt-1">2h ago</div>
            </div>
          </div>
        </a>
        <a href="#" class="list-group-item">
          <div class="row g-0 align-items-center">
            <div class="col-2">
              <img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Daisy Seger">
            </div>
            <div class="col-10 ps-2">
              <div class="text-dark">Daisy Seger</div>
              <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
              <div class="text-muted small mt-1">5h ago</div>
            </div>
          </div>
        </a>
      </div>
      <div class="dropdown-menu-footer">
        <a href="#" class="text-muted">Show all messages</a>
      </div>
    </div>
  </li>--}}
  <li class="nav-item dropdown ms-lg-2">
    <a class="nav-link dropdown-toggle position-relative" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
      <i class="align-middle fas fa-bell"></i>
      <span class="indicator hidden"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
      <div class="dropdown-menu-header">
        0 novih obavijesti
      </div>
      <div class="list-group">
        {{--<a href="#" class="list-group-item">
          <div class="row g-0 align-items-center">
            <div class="col-2">
              <i class="ms-1 text-danger fas fa-fw fa-bell"></i>
            </div>
            <div class="col-10">
              <div class="text-dark">Update completed</div>
              <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
              <div class="text-muted small mt-1">2h ago</div>
            </div>
          </div>
        </a>
        <a href="#" class="list-group-item">
          <div class="row g-0 align-items-center">
            <div class="col-2">
              <i class="ms-1 text-warning fas fa-fw fa-envelope-open"></i>
            </div>
            <div class="col-10">
              <div class="text-dark">Lorem ipsum</div>
              <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
              <div class="text-muted small mt-1">6h ago</div>
            </div>
          </div>
        </a>
        <a href="#" class="list-group-item">
          <div class="row g-0 align-items-center">
            <div class="col-2">
              <i class="ms-1 text-primary fas fa-fw fa-building"></i>
            </div>
            <div class="col-10">
              <div class="text-dark">Login from 192.186.1.1</div>
              <div class="text-muted small mt-1">8h ago</div>
            </div>
          </div>
        </a>
        <a href="#" class="list-group-item">
          <div class="row g-0 align-items-center">
            <div class="col-2">
              <i class="ms-1 text-success fas fa-fw fa-bell-slash"></i>
            </div>
            <div class="col-10">
              <div class="text-dark">New connection</div>
              <div class="text-muted small mt-1">Anna accepted your request.</div>
              <div class="text-muted small mt-1">12h ago</div>
            </div>
          </div>
        </a>--}}
      </div>
      {{--<div class="dropdown-menu-footer">
        <a href="#" class="text-muted">Pokaži sve</a>
      </div>--}}
    </div>
  </li>
  <li class="nav-item dropdown ms-lg-2">
    <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
      <i class="align-middle fas fa-cog"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
      <a class="dropdown-item" href="{{ route('profile.show',$_user) }}"><i class="align-middle me-1 fas fa-fw fa-user"></i> Moj profil</a>
    @if($_user->is_administracija)
      @if($_user->hasAdminAccess())
        {{-- <a class="dropdown-item text-danger" href="{{route('user.adminaccess.leave')}}"><i class="align-middle me-1 fas fa-fw fa-cogs"></i> Admin izlaz <i class="fas fa-sign-out-alt"></i></a> --}}
      @else
      <a class="dropdown-item text-danger" href="#" onclick="return adminaccessmodal(this);"><i class="align-middle me-1 fas fa-fw fa-cogs"></i> Admin</a>
      @endif
    @endif
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();return false;"><i class="align-middle me-1 fas fa-sign-out-alt"></i> Izlaz</a>
    </div>
  </li>
</ul>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
