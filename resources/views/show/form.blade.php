<div class="row">
  <div class="col-md-6 col-sm-12">
    <div class="mb-3">
      {{ Form::label('naziv') }}
      {{ Form::text('naziv', $show->naziv, ['class' => 'form-control' . ($errors->has('naziv') ? ' is-invalid' : ''), 'placeholder' => 'Naziv']) }}
      {!! $errors->first('naziv', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>

  <div class="col-md-3 col-sm-6">
    <div class="mb-3">
      {{ Form::label('Film') }}
      @include('movie.formelements.select',['name' => 'movie_id', 'value' => $show->movie_id, 'required' => true, 'nullable' => true])
      {!! $errors->first('movie_id', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>

  <div class="col-md-3 col-sm-6">
    <div class="mb-3">
      {{ Form::label('Dvorana') }}
      @include('hall.formelements.select',['name' => 'hall_id', 'value' => $show->hall_id, 'required' => true, 'nullable' => true])
      {!! $errors->first('hall_id', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-3 col-sm-6">
    <table class="table table-sm table-borderless" style="max-width:400px">
      <tr>
        <td width="110">{{ Form::label('Datum') }}</td>
        <td width="200"><label>Vrijeme održavanja</label></td>
      </tr>
      <tr>
        <td class="pe-1">
          @include('includes.formelements.datepicker',['name' => 'datum_odrzavanja', 'value' => $show->datum_i_vrijeme_odrzavanja, 'required' => true])
          {!! $errors->first('datum_odrzavanja', '<label class="error small form-text invalid-feedback">:message</label>') !!}
          {{--<small class="form-text d-block text-muted">Opis</small>--}}
        </td>
        <td class="pe-1">
          <div class="input-group">
            @include('includes.formelements.time',['name' => 'vrijeme_odrzavanja', 'value' => $show->datum_i_vrijeme_odrzavanja ? $show->datum_i_vrijeme_odrzavanja:null, 'required' => true])
            {!! $errors->first('vrijeme_odrzavanja', '<label class="error small form-text invalid-feedback">:message</label>') !!}
          </div>
        </td>
      </tr>
    </table>
  </div>

  <div class="col-md-2 col-sm-4">
    <div class="mb-3">
      {{ Form::label('trajanje') }}
      {{ Form::number('trajanje', $show->trajanje, ['class' => 'form-control' . ($errors->has('trajanje') ? ' is-invalid' : ''), 'min' => 1, 'style' => 'width:100px', 'placeholder' => 'min', 'required' => true, 'id' => 'trajanje']) }}
      {!! $errors->first('trajanje', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
      <small class="form-text d-block text-muted mb-3">
        Za trajanje unosite samo brojeve.
      </small>
    </div>
  </div>
</div>



<button type="submit" class="btn btn-success">Spremi</button>
<a href="{{ route('shows.index') }}" type="submit" class="btn ">Poništi</a>
