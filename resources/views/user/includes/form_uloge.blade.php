<a href="#" onclick="$('#uloge').toggleClass('hidden');$(this).addClass('hidden');return false;">Napredne opcije</a>

<div class="mb-3 hidden mt-2" id="uloge">
  <h5>Tip osobe</h5>
  <label class="form-check">
    <input class="form-check-input" type="radio" value="is_student" name="uloga_flag" {{$user->is_posjetitelj ?'checked':''}} />
    <span class="form-check-label">Posjetitelj</span>
  </label>
  <label class="form-check">
    <input class="form-check-input" type="radio" value="is_predavac" name="uloga_flag" {{!$user->is_posjetitelj ?'checked':''}} />
    <span class="form-check-label">Zaposlenik</span>
  </label>
  <label class="form-check">
    <input class="form-check-input" type="radio" value="is_none" name="uloga_flag" {{(!$user->is_posjetitelj && $user->is_administrator) ?'checked':''}} />
    <span class="form-check-label">Administrator</span>
  </label>
</div>
