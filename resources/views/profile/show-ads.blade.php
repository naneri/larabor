@extends('_misc._layout')

@section('content')
<div class="main-container">
  <div class="container">
    <div class="row well info-box">
      <div class="">
        <div class="col-md-2 col-xs-6">
          <img src="http://zabor.kg/oc-content/themes/bender/images/user_default.gif">
        </div>
        <div class="col-md-10 col-xs-6">
          <h2>{{$user->s_name}}</h2>
          @if(!empty($user->s_address))
            <p><i class="fa fa-building fa-fw"></i>{{$user->s_address}}</p>
          @endif
          @if(!empty($user->s_phone_land))
            <p><i class="fa fa-phone-square fa-fw"></i>{{$user->s_phone_land}}</p>
          @endif 
          @if(!empty($user->description->s_info))
            <p><i class="fa fa-info-circle fa-fw"></i>{{$user->description->s_info}}</p>
          @endif
        </div>
      </div>
    </div>
    <div class="row">
      @foreach($items->chunk(4) as $item_list)
        <div class="text-center">
          @foreach($item_list as $item)
          <div class="col-md-3 col-sm-4 col-xs-6 user-item">
            <div class="thumbnail">
              <h1 class="pricetag"> {{$item->i_price or ''}} {{$item->currency->s_description or 'не указана'}}</h1>
              <a href='{{url("item/show/{$item->pk_i_id}")}}'>
                @if(isset($item->lastImage))
                <img class="thumbnail" src="http://larabor.local/{{$item->lastImage->thumbnailUrl()}}" alt="img">
                @else
                <img class="thumbnail" src="http://zabor.kg/oc-content/themes/bender/images/no_photo.gif" alt="img">
                @endif
              </a>
              <div class="caption">
                <h3>{{str_limit($item->description->s_title, 50)}}</h3>
                <p class="text-left">
                  <span class="info-row"> 
                    <span class="category">{{str_limit($item->category->description->s_name, 27)}}</span>
                  </span> 
                </p>
                <p class="text-right">
                  <a href='{{url("item/show/{$item->pk_i_id}")}}' class="btn btn-info">Подробнее</a>
                </p>
              </div>
            </div>
          </div>
          @endforeach  
        </div>
      @endforeach
    </div>
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