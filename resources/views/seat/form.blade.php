<div class="row">
  <div class="col-md-2 col-sm-4">
    <div class="mb-3">
      {{ Form::label('naziv') }}
      {{ Form::text('naziv', $seat->naziv, ['class' => 'form-control' . ($errors->has('naziv') ? ' is-invalid' : ''), 'placeholder' => 'Naziv']) }}
      {!! $errors->first('naziv', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>

  <div class="col-md-3 col-sm-6">
    <div class="mb-3">
      {{ Form::label('dvorana') }}
      @include('hall.formelements.select',['name' => 'hall_id', 'value' => $seat->hall_id, 'required' => true, 'nullable' => true])
      {!! $errors->first('hall_id', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>
</div>

<button type="submit" class="btn btn-success">Spremi</button>
<a href="{{ route('seats.index') }}" type="submit" class="btn ">Poništi</a>
