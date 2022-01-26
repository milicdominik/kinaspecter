<div class="row">
  <div class="col-md-6 col-sm-12">
    <div class="mb-3">
      {{ Form::label('naziv') }}
      {{ Form::text('naziv', $hall->naziv, ['class' => 'form-control' . ($errors->has('naziv') ? ' is-invalid' : ''), 'placeholder' => 'Naziv']) }}
      {!! $errors->first('naziv', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>
</div>

<button type="submit" class="btn btn-success">Spremi</button>
<a href="{{ route('halls.index') }}" type="submit" class="btn ">Poništi</a>
