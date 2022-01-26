{{--
  @param string name - form name
  @param nullable Carbon value - vrijednost
  @param boolean required
  @see http://www.daterangepicker.com/
--}}
@php
$id = isset($id) ? $id:\str_replace(['[',']','-'],'_',$name);
$class = isset($class) ? 'form-control '.$class:'form-control';
$class = $class.($errors->has($name) ? ' is-invalid' : '');
$placeholder = isset($placeholder) ?$placeholder:'';
@endphp
{{ Form::text($name, $value?$value->format(config('kina.datetime_date')):null, ['class' => $class, 'required' => $required,'id' => $id, 'placeholder' => $placeholder]) }}

@push('javascript')
<script>
  $(function(){
    $('input[name="{{$name}}"]').daterangepicker({
        autoUpdateInput: {{$value?'true':'false'}},
				singleDatePicker: true,
				showDropdowns: true,
        timePicker24Hour: true,
        locale: {
          format: '{{config('kina.datetime_format_js')}}',
          cancelLabel: 'Očisti',
          applyLabel: 'Potvrdi',
          firstDay: 1,
          daysOfWeek: [
            "Ned",
            "Pon",
            "Uto",
            "Sri",
            "Čet",
            "Pet",
            "Sub"
          ],
          monthNames: [
           "Siječanj",
           "Veljača",
           "Ožujak",
           "Travanje",
           "Svibanj",
           "Lipanj",
           "Srpanj",
           "Kolovoz",
           "Rujan",
           "Listopad",
           "Studeni",
           "Prosinac"
         ],
        }
			});
      @if(!$value)
      $('input[name="{{$name}}"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('{{config('kina.datetime_format_js')}}'));
      });


      @endif
      $('input[name="{{$name}}"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });
  })
</script>
@endpush
