{{ Form::label('Fotografija') }}
<div>
  {{ Form::file('fotografija',['accept' => '.jpg,.jpeg,.gif,.png', 'class' => 'form-control-file', 'multiple' => false, 'id' => 'fotografija' ])}}
</div>
{!! $errors->first('fotografije', '<label class="error small form-text invalid-feedback">:message</label>') !!}
<small class="form-text d-block text-muted">Učitajte novu fotografiju.</small>
