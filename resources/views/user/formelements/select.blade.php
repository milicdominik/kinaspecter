{{--
  @param string name - form name
  @param nullable Carbon value - vrijednost
  @param boolean required
--}}
@php
$_values = App\Models\User::select('id','name')->get()->pluck('name','id');
$nullable = isset($nullable) ? $nullable:false;
$placeholder = isset($placeholder) ? $placeholder:'Odaberi korisnika...';
if($nullable)
  $_values = array_replace(['' => $placeholder],$_values->toArray());
$id = isset($id) ? $id:\str_replace(['[',']','-'],'_',$name);
$disabled = isset($disabled) ? $disabled:false;
@endphp

@if(!$disabled)
  {{Form::select($name,$_values,$value,['class' => 'form-control select2' . ($errors->has($name) ? ' is-invalid' : ''), 'data-bs-toggle' => 'select2', 'required' => $required, 'id' => $id])}}
@else
  {{Form::select($name,$_values,$value,['class' => 'form-control select2' . ($errors->has($name) ? ' is-invalid' : ''), 'data-bs-toggle' => 'select2', 'required' => $required, 'id' => $id, 'disabled'])}}
@endif

@push('javascript')
<script>
  $(function(){
    $('select[name="{{$name}}"]').select2({}).on('select2:open',function(e){
      $(".select2-search__field[aria-controls='select2-" + e.target.id + "-results']").each(function (k,v) {v.focus()})
    })
  })
</script>
@endpush
