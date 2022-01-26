<div class="row">
  <div class="col-md-4 col-sm-8">
    <div class="mb-3">
      {{ Form::label('ime') }}
      {{ Form::text('ime', $user->ime, ['class' => 'form-control' . ($errors->has('ime') ? ' is-invalid' : ''), 'placeholder' => 'Ime', 'required' => true]) }}
      {!! $errors->first('ime', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>
  <div class="col-md-4 col-sm-8">
    <div class="mb-3">
      {{ Form::label('prezime') }}
      {{ Form::text('prezime', $user->prezime, ['class' => 'form-control' . ($errors->has('prezime') ? ' is-invalid' : ''), 'placeholder' => 'Prezime', 'required' => true]) }}
      {!! $errors->first('prezime', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>
  <div class="col-md-4 col-sm-8">
    <div class="mb-3">
      <label for="email">E-mail adresa</label>
      {{ Form::email('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'required' => true, 'autocomplete' => 'off', 'autocorrect' => 'off', 'readonly' => true, 'onfocus' => "this.removeAttribute('readonly');"]) }}
      {!! $errors->first('email', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3 col-sm-6">
    <div class="mb-3">
      <label for="oib">OIB</label>
      {{ Form::text('oib', $user->oib, ['class' => 'form-control' . ($errors->has('oib') ? ' is-invalid' : ''),'id' =>'oib', 'required' => true, 'minlength' => 11, 'maxlength' => 11]) }}
      {!! $errors->first('oib', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>
  <div class="col-md-3 col-sm-6">
    <div class="mb-3">
      <label for="mobitel">Kontakt broj (mobitel)</label>
      {{ Form::text('mobitel', $user->mobitel, ['class' => 'form-control' . ($errors->has('mobitel') ? ' is-invalid' : ''), 'required' => true, 'minlength' => 11, 'maxlength' => 11]) }}
      {!! $errors->first('mobitel', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      <small class="form-text d-block text-muted">Mobitel ili telefon (385998004521)</small>
    </div>
  </div>
  <div class="col-md-2 col-sm-4">
    <table class="table table-sm table-borderless" style="max-width:400px">
      <tr>
        <td width="110">{{ Form::label('Datum i godina rođenja') }}</td>
      </tr>
      <tr>
        <td class="pe-1">
          @include('includes.formelements.datepicker',['name' => 'dat_god_rodenja', 'value' => $user->dat_god_rodenja, 'required' => true])
          {!! $errors->first('dat_god_rodenja', '<label class="error small form-text invalid-feedback">:message</label>') !!}
          {{--<small class="form-text d-block text-muted">Opis</small>--}}
        </td>
      </tr>
    </table>
  </div>
</div>

@if($_user->is_administracija)
  <div class="row">
    <div class="col-md-3 col-sm-6">
      <h5 class="mb-4">Dodatne informacije</h5>
      <div class="mb-3">
        <label>{{ Form::checkbox('is_administracija', 1, $user->is_administracija,['class' => 'icheck']) }} Administrator</label>
        {!! $errors->first('is_administracija', '<label class="error small form-text invalid-feedback">:message</label>') !!}
        <small class="form-text d-block text-muted">Daje administratorska prava ovoj osobi na ovoj aplikaciji (oprez)</small>
      </div>
      <div class="mb-3">
        <label>{{ Form::checkbox('is_posjetitelj', 1, $user->is_posjetitelj,['class' => 'icheck']) }} Posjetitelj</label>
        {!! $errors->first('is_posjetitelj', '<label class="error small form-text invalid-feedback">:message</label>') !!}
        <small class="form-text d-block text-muted">Označite ako je ova osoba posjetitelj</small>
      </div>
    </div>
  </div>
@endif

@if(!$_user->is_administracija && $_user->is_posjetitelj)
  <div id="lozinka">
    @if($_user->exists)
      <h5>Promjeni lozinku</h5>
      <small class="form-text d-block text-muted mb-3">Lozinka mora sadržavati minimalno 6 znakova</small>
    @else
      <h5 class="mb-0">Ručno postavljanje lozinke</h5>
      <small class="form-text d-block text-muted mb-3">Lozinka mora sadržavati minimalno 6 znakova</small>
    @endif
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <div class="mb-3">
          {{ Form::label('Lozinka') }}
          {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Lozinka', 'autocomplete' => 'off']) }}
          {!! $errors->first('password', '<label class="error small form-text invalid-feedback">:message</label>') !!}
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="mb-3">
          {{ Form::label('Ponovi lozinku') }}
          {{ Form::password('password_confirmation', ['class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''), 'placeholder' => 'Ponovi lozinku', 'autocomplete' => 'off']) }}
          {!! $errors->first('password_confirmation', '<label class="error small form-text invalid-feedback">:message</label>') !!}
          {{--<small class="form-text d-block text-muted">Opis</small>--}}
        </div>
      </div>
  </div>
@endif

<button type="submit" class="btn btn-success">Spremi</button>
<a href="{{ route('users.index') }}" type="submit" class="btn ">Poništi</a>
