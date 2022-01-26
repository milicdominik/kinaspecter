{{--
  @param string name - form name
  @param nullable string value - tekst
  @param boolean required
  @param nullable $placeholder
  @see https://quilljs.com/
  TODO IMAGE UPLOAD CONTROLLER
  @param optional $ckeditor_noinit - ako je true nece loadati ckeditor pa se mora rucno povuc po zelji (funkcija je ispod)
--}}
@php
  $ckeditor_noinit = isset($ckeditor_noinit) && $ckeditor_noinit ? true:false;
@endphp
{{ Form::textarea($name, $value, ['required' => false,'id' => $name.'_editor_hidden_input','class' => 'hidden', 'spellcheck' => 'false']) }}
@if($ckeditor_noinit)
  <a href="#" id="{{$name}}_editor_loaderlink" onclick="ncx_initckeditor_{{$name.'_editor_hidden_input'}}();return false" class="m-2 p-4 text-center border border-2 d-block text-muted" style="border-style:dashed !important">
    <h5 class="m-0">Klik za učitavanje editora teksta</h5>
  </a>
@endif
{{--<textarea name="{{$name}}" id="{{$name}}_editor_hidden_input" class="hidden">{{$value}}</textarea>--}}
@section('javascript_ondemand')
  <script src="/res/lib/ckeditor5/build/ckeditor.js?v={{md5(config('kina.version'))}}"></script>
@endsection
@push('javascript2')
<script>
var ncx_initckeditor_{{$name.'_editor_hidden_input'}}_loaded = false;
function ncx_initckeditor_{{$name.'_editor_hidden_input'}}()
{
  if(ncx_initckeditor_{{$name.'_editor_hidden_input'}}_loaded)
    return;
  $("#{{$name}}_editor_loaderlink").remove();
  ncx_initckeditor_{{$name.'_editor_hidden_input'}}_loaded = true;


  ClassicEditor.create( document.querySelector('#{{$name}}_editor_hidden_input'),
  {
    //plugins: [ Image],
    //plugins: [ SimpleUploadAdapter ],
    simpleUpload: {
        // The URL that the images are uploaded to.
        uploadUrl: '{{route('upload.ckeditor')}}',

        // Enable the XMLHttpRequest.withCredentials property.
        withCredentials: true,

        // Headers sent along with the XMLHttpRequest to the upload server.
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
            //,Authorization: 'Bearer <JSON Web Token>'
        }
    },
    licenseKey: '',
  }
)
  .then( editor => {
      //disable browser spellcheck
      editor.editing.view.change( writer => { writer.setAttribute( 'spellcheck', 'false', editor.editing.view.document.getRoot() ); } );
  })
  .catch( error => {
      console.error( error );
  });
}
@if(!$ckeditor_noinit)
  $(function(){
    ncx_initckeditor_{{$name.'_editor_hidden_input'}}()
  });
@endif
</script>
@endpush
