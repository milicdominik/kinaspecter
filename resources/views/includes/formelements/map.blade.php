{{--
  @param array $names, lat and long input names
  @param array values - [<name1> => <value2>, <name2> => <value2> ]
--}}

<div id="map_{{$names[0].$names[1]}}_contents_map">
  <iframe class="rounded" scrolling="no" src="/res/formelements/map/select.html?#lat={{$values[0]}}&amp;lng={{$values[1]}}&amp;id={{$names[0].$names[1]}}" width="100%" height="250" frameborder="0"></iframe>
</div>
<div id="map_{{$names[0].$names[1]}}_contents_manual">
  <div class="mb-3">
    {{ Form::label('Latitude') }}
    {{ Form::text($names[0], $predavaonica->lat, ['class' => 'form-control' . ($errors->has($names[0]) ? ' is-invalid' : ''),'id' => $names[0].$names[1].$names[0]]) }}
    {!! $errors->first($names[0], '<label class="error small form-text invalid-feedback">:message</label>') !!}
    {{--<small class="form-text d-block text-muted">Opis</small>--}}
  </div>
  <div class="mb-3">
    {{ Form::label('Longitude') }}
    {{ Form::text($names[1], $predavaonica->lng, ['class' => 'form-control' . ($errors->has($names[1]) ? ' is-invalid' : ''),'id' => $names[0].$names[1].$names[1]]) }}
    {!! $errors->first($names[1], '<label class="error small form-text invalid-feedback">:message</label>') !!}
    {{--<small class="form-text d-block text-muted">Opis</small>--}}
  </div>
</div>



@push('javascript')
<script>
  function formelements_map_select_{{$names[0].$names[1]}}(e){
    //if (e.origin !== "https://xy.com") return;
    var id = e.data.id; //<formelementid>-<inputpartid>
    if(id === undefined) return;
    $("#"+id.replace('-',' #')+'{{$names[0]}}').val(e.data.lat);
    $("#"+id.replace('-',' #')+'{{$names[1]}}').val(e.data.lng);
  }
  window.addEventListener("message",formelements_map_select_{{$names[0].$names[1]}},false);
</script>
@endpush
