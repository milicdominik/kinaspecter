{{--
  @param User $user
  @param optional $linkparams
  @param optional $user_url
  @param optional $zoomeffect - default true
--}}
@php
  $linkparams = isset($linkparams) ? ' '.$linkparams:'';
  $user_url = (isset($user_url)) ? $user_url:route('users.show',$user->id);        //route('profile.show',$user) umjesto moje route
  $zoomeffect = isset($zoomeffect) ? $zoomeffect:true;
@endphp
<span class="d-inline-block user user-inline">

    @if(empty($user_url) || $user_url == 'none' )
      <span class="rounded-circle avatar{{$zoomeffect?' zoom':''}}" style="background-image:url('{{$user->avatar_url}}')"></span>
      <span class="user-name"{!!$linkparams!!}>{{ $user->puno_prezime_ime }}</span>
    @else
      <a href="#" onclick="return zoomavatar('{{$user->puno_prezime_ime}}','{{$user->avatar_url}}')" class="rounded-circle avatar{{$zoomeffect?' zoom':''}}" style="background-image:url('{{$user->avatar_url}}')"></a>
      <a href="{{$user_url}}" class="user-name"{{$linkparams}}>{{ $user->puno_prezime_ime }}</a>
    @endif
</span>
