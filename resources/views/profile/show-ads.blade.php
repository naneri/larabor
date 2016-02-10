@extends('_misc._layout')

@section('title')
  Объявления пользователя {{$user->s_name}}
@stop

@section('meta')
<meta name="title" content="Объявления пользователя {{$user->s_name}} на Zabor.kg" />
<meta name="description" content="Объявления и информация пользователя {{$user->s_name}} - адрес, телефон, дополнительная информация" />

<meta property="og:title" content="Объявления пользователя {{$user->s_name}} на Zabor.kg" />
<meta property="og:description" content="Объявления и информация пользователя {{$user->s_name}} - адрес, телефон, дополнительная информация" />
<meta property="og:image" content="{{asset('images/user_default.gif')}}" />
@stop

@section('content')
<div class="main-container">
  <div class="container">
    <div class="row well info-box">
      <div class="row info-box-main">
        <div class="col-md-2 col-xs-6 ">
          <img class="center-block" src="{{asset('images/user_default.gif')}}">
        </div>
        <div class="col-md-10 col-xs-6">
          <h2>{{$user->s_name}}</h2>
            <p><i class="fa fa-building fa-fw"></i>
              @if(!empty($user->s_address))
                {{$user->s_address}}
              @else
                <span class="text-muted"><small>нет данных</small></span>
              @endif
            </p>
            <p>
              <i class="fa fa-phone-square fa-fw"></i>
                @if(!empty($user->s_phone_land))
                  {{$user->s_phone_land}}
                @else
                  <span class="text-muted"><small>нет данных</small></span>
                @endif 
            </p>
         
            <p><i class="fa fa-info-circle fa-fw"></i>
              @if(!empty($user->description->s_info))
                {{$user->description->s_info}}
              @else
                <span class="text-muted"><small>нет данных</small></span>
              @endif
            </p>
        </div>
      </div>
      <div class="row text-right info-box-footer hidden-xs">
        <span><b>Поделиться:</b></span>
        <a target="_blank" href="http://www.facebook.com/sharer.php?u={{urlencode(route('user.ads', [$user->pk_i_id]))}}"> 
          <span class="label label-primary"><i class="fa fa-facebook"></i> Facebook</span>
         </a>
        <a target="_blank" target="_blank" href="https://plus.google.com/share?url={{urlencode(route('user.ads', [$user->pk_i_id]))}}"> 
          <span class="label label-danger"><i class="fa fa-google-plus"></i> Google+</span>
         </a>
        <a target="_blank" href="http://twitter.com/share?url={{urlencode(route('user.ads', [$user->pk_i_id]))}}"> 
          <span class="label label-info"><i class="fa fa-twitter"></i> Twitter</span>
        </a>
      </div>
    </div>
  
    
    @if($items->isEmpty())
      <div class="row">
        <p><h2 class="text-center text-muted">Нет объявлений...</h2></p>
      </div>
    @else
      @foreach($items->chunk(4) as $chunk)
        <div class="row">
          @include('profile._item-gallery', compact('chunk'))
        </div>
      @endforeach
    @endif
    
  <div class="row">
    <div class="pagination-bar text-center">
      <ul class="pagination">
        {!! $items->render()!!}
      </ul>
    </div>
  </div>
</div>
</div>

@stop