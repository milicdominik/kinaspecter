{{--
  @param string name - form name
  @param nullable Carbon value - vrijednost
  @param boolean required
  @param optional $style - style attribute contents
  @see https://igorescobar.github.io/jQuery-Mask-Plugin/docs.html
--}}
@php
$id = isset($id) ? $id:\str_replace(['[',']','-'],'_',$name);
$class = isset($class) ? 'form-control '.$class:'form-control';
$class = $class.($errors->has($name) ? ' is-invalid' : '');
@endphp
<input type="text" name="{{$name}}" id="{{$id}}" class="{{$class}}" data-totalminutes="" data-minutes="" data-hours="" data-mask="00:00" placeholder="hh:mm" value="{{$value?$value->format('H:i'):''}}"{{$required?' required':''}}{!!isset($style)?' style="'.$style.'"':''!!}>
@push('javascript')
<script>
$(function(){
    $("#{{$id}}").focusout(function(){
      var str = $(this).val();
      var result = str;
      if(str.length == 4) result = str+'0';
      if(str.length == 3) result = str+'00';
      if(str.length == 2) result = str+':00';
      if(str.length == 1) result = '0'+str+':00';
      $(this).val(result);
      var cleanval = $(this).cleanVal();
      if(parseInt(cleanval) > 2359)
        $(this).val('');
      else {
        //set data-minutes and data-hours attributes to DOM
        var newval_parts = result.split(":");
        var h = parseInt(newval_parts[0]);
        var m = parseInt(newval_parts[1]);
        var tm = (h*60) + m;
        $(this).data('hours',h);
        $(this).data('minutes',m);
        $(this).data('totalminutes',tm);
      }
    });
})
</script>
@endpush
