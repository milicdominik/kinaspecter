{{--
  Za mobitele (native time element)
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
<input type="time" name="{{$name}}" id="{{$id}}" class="{{$class}}" value="{{$value?$value->format('H:i'):''}}"{{$required?' required':''}}{!!isset($style)?' style="'.$style.'"':''!!}>
