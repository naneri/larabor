@extends('_misc._layout')

@section('title')
  Объявления пользователя {{$user->s_name}}
@stop

@section('meta')
<meta name="title" content="Объявления пользователя {{$user->s_name}} на Zabor.kg" />
<meta name="description" content="Объявления и информация пользователя {{$user->s_name}} - адрес, телефон, дополнительная информация" />
@stop

@section('content')
<div class="main-container">
  <div class="container">
    <div class="row well info-box">
      <div class="">
        <div class="col-md-2 col-xs-6">
          <img src="{{asset('images/user_default.gif')}}">
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