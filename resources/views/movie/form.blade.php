<div class="row">
  <div class="col-md-6 col-sm-12">
    <div class="mb-3">
      {{ Form::label('naslov') }}
      {{ Form::text('naslov', $movie->naslov, ['class' => 'form-control' . ($errors->has('naslov') ? ' is-invalid' : ''), 'placeholder' => 'Naslov']) }}
      {!! $errors->first('naslov', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>

  <div class="col-md-6 col-sm-12">
    <div class="mb-3">
      {{ Form::label('redatelj') }}
      {{ Form::text('redatelj', $movie->redatelj, ['class' => 'form-control' . ($errors->has('redatelj') ? ' is-invalid' : ''), 'placeholder' => 'Redatelj']) }}
      {!! $errors->first('redatelj', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 col-sm-12">
    <div class="mb-3">
      {{ Form::label('uloge') }}
      {{ Form::textarea('uloge', $movie->uloge, ['class' => 'form-control' . ($errors->has('uloge') ? ' is-invalid' : ''), 'rows' => 2]) }}
      {!! $errors->first('uloge', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>

  <div class="col-md-3 col-sm-6">
    <div class="mb-3">
      {{ Form::label('žanr') }}
      @include('genre.formelements.select',['name' => 'genre_id', 'value' => $movie->genre_id, 'required' => true, 'nullable' => true])
      {!! $errors->first('genre_id', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
    @if($_user->canmodel('create','Genre'))
       <a href="{{ route('genres.create') }}" class="btn btn-primary btn-sm float-end"><i class="fas fa-plus"></i> Kreiraj žanr</a>
    @endif
  </div>

  <div class="col-md-1 col-sm-2">
    <div class="mb-3">
      {{ Form::label('trajanje') }}
      {{ Form::number('trajanje', $movie->trajanje, ['class' => 'form-control' . ($errors->has('trajanje') ? ' is-invalid' : ''), 'min' => 1, 'style' => 'width:100px', 'placeholder' => 'min', 'required' => true, 'id' => 'trajanje']) }}
      {!! $errors->first('trajanje', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>

  <div class="col-md-1 col-sm-2">
    <div class="mb-3">
      {{ Form::label('godina izlaska') }}
      {{ Form::number('godina_izlaska', $movie->godina_izlaska, ['class' => 'form-control' . ($errors->has('godina_izlaska') ? ' is-invalid' : ''), 'min' => 2022, 'style' => 'width:100px', 'placeholder' => 'godina', 'required' => true, 'id' => 'godina_izlaska']) }}
      {!! $errors->first('godina_izlaska', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="mb-3">
      {{ Form::label('opis') }}
      @include('includes.formelements.wysiwyg',['name' => 'opis', 'value' => $movie->opis, 'required' => true, 'ckeditor_noinit' => false])
      {!! $errors->first('opis', '<label class="error small form-text invalid-feedback">:message</label>') !!}
      {{--<small class="form-text d-block text-muted">Opis</small>--}}
    </div>
  </div>
</div>

  <small class="form-text d-block text-muted mb-3">
    *Za trajanje i godinu izlaska filma unosite samo brojeve (npr. 180 ili 2022).
  </small>

<button type="submit" class="btn btn-success">Spremi</button>
<a href="{{ route('movies.index') }}" type="submit" class="btn ">Poništi</a>
