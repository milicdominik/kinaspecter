<div class="modal-header">
  <h5 class="modal-title">@yield('modal_title','TITLE')</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
@yield('modal_formstart')
<div class="modal-body">
  @yield('modal_body','BODY')
</div>
<div class="modal-footer">
  @hasSection('modal_footer')
    @yield('modal_footer')
  @else
    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
    {{--<button type="button" class="btn btn-primary">Spremi</button>--}}
  @endif
</div>
@yield('modal_formend')
@stack('modal_javascript')
