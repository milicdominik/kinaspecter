{{--
@param User $user
@param optional string $class
--}}
@php
$class = isset($class) ? ' '.$class:'';
@endphp
<div class="user border d-flex rounded p-1 overflow-hidden{{$class}}">
  <div>
    <div class="img-fluid user-avatar bg-gray" style="background-image:url('{{$user->avatar_url}}');width:40px;height:40px;margin:auto;"></div>
  </div>
  <div class="ps-2 text-truncate" style="line-height:40px">{{$user->puno_prezime_ime}}</div>
</div>
