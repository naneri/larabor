@extends('_misc._layout')

@section('title')
  {{$item->description->s_title}}
@stop

@section('meta')
<meta name="title" content="{!! stripForMeta($item->description->s_title)!!} - Zabor.kg"/>
<meta name="description" content="{{$item->category->description->s_name}} : {!! stripForMeta($item->description->s_description) !!}, - купить в Бишкеке и других городах Кыргызстана." />

<meta property="og:title" content="{!! stripForMeta($item->description->s_title) !!}" />
<meta property="og:description" content="{!! stripForMeta($item->description->s_description) !!}, {!! $item->category->description->s_name !!}" />
<meta property="og:image" content="{{
    isset($item->images[0]) ?
    asset($item->images[0]->imageUrl()) :
    asset(Config::get('zabor.item_no_image'))
     }}" />
@stop 


@section('content')
<div class="main-container">
    <div class="container">
      <ol class="breadcrumb pull-left">
        <li>
          <a href="{{url('/')}}"><i class="icon-home fa"></i></a>
        </li>
        <li>
          <a href="{{url('search?category=' . $item->category->pk_i_id)}}">{{$item->category->description->s_name}}</a></li>
        <li class="active">
          {{str_limit($item->description->s_title, 30)}} 
        </li>
      </ol>
    </div>
    <div class="container">
      @if(!$item->is_actual())
        <div class="alert alert-danger" role="alert">
          <p class='text-center'><b >Объявление устарело и больше не актуально</b></p>
        </div>
      @endif
      <div class="row">

        <div class="col-sm-9 page-content col-thin-right">
          <div class="inner inner-box ads-details-wrapper">
            <h2> 
              {{$item->description->s_title}} 
              @if($is_owner || (Auth::user() and Auth::user()->is_admin))
                <span class="pull-right">
                  <a href="{{route('item.edit', ['id' => $item->pk_i_id, 'code' => $code])}}"><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i> Редактировать</button></a>
                  <a href="{{route('item.prolong', ['id' => $item->pk_i_id, 'code' => $code])}}"><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-clock-o"></i> Продлить</button></a>
                  <a href="{{route('item.delete', ['id' => $item->pk_i_id, 'code' => $code, 'redirect' => 'origin'])}}"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Удалить</button></a>
                </span>
              @endif
            </h2>
            <span class="info-row"> 
            	<span class="date">
            		<i class=" icon-clock"> </i> {{$item->showPubDate()}}
                <i class=" icon-eye"> </i> {{$item->stats->sum('i_num_views')}}
            	</span>
            </span>
            <div class="ads-image">
              <h1 class="pricetag">
                @if(!is_null($item->i_price))
                  {{$item->formatedPrice()}} {{$item->currency->s_description}}
                @else
                  не указана
                @endif
              </h1>
              <ul class="bxslider">
              	@forelse($item->images as $image)
                <li><img src="{{asset($image->imageUrl())}}" alt="img" /></li>
                @empty
                <li><img src="{{asset(Config::get('zabor.item_no_image'))}}" alt="img" /></li>
                @endforelse
              </ul>
              <div id="bx-pager">
	            @forelse($item->images as $key => $image)
	                <a class="thumb-item-link" data-slide-index="{{$key}}" href=""><img src="{{asset($image->thumbnailUrl())}}" alt="img" /></a>
                @empty
                	<a class="thumb-item-link" data-slide-index="0" href=""><img src="{{asset(Config::get('zabor.item_no_image'))}}" alt="img" /></a>
                @endforelse
              </div>
            </div>
            <!--ads-image-->
            
            <div class="Ads-Details">
              <h5 class="list-title"><strong>Описание</strong></h5>
              <div class="row">
                <div class="ads-details-info col-md-8">
                	{!!nl2br(e($item->showDescription()))!!}
                </div>
                <div class="col-md-4">
                  @if($item->is_active())
                    <aside class="panel panel-body panel-details">
                      <ul>
                       @foreach($item->metas as $meta)
                        @if(!($meta->meta->e_type == 'URL' &&$meta->s_value == ''))
                        <li>
                          <p class=" no-margin "><strong>{{$meta->meta->s_name}}:</strong>

                              @if($meta->meta->e_type == 'CHECKBOX')
                                @if($meta->s_value == 1)
                                  <i style="color:green" class="fa fa-check"></i>
                                @else
                                  <i style="color:red" class="fa fa-close"></i>
                                @endif 
                              @elseif($meta->meta->e_type == 'URL')
                                <a rel="nofollow" href="{{$meta->s_value}}">{{$meta->s_value}}</a>
                              @else
                                {{$meta->s_value}}
                              @endif
                          </p>
                        </li>
                        @endif
                       @endforeach()
                        
                      </ul>
                    </aside>
                   
                  @endif
                </div>
              </div>
                <div class="content-footer text-left"> 
                  <div class="text-right">
                     <a class="btn btn-fb" target="_blank" href="http://www.facebook.com/sharer.php?u={{urlencode(route('item.show', [$item->pk_i_id]))}}"> 
                      <i class="fa fa-facebook"></i> Facebook
                     </a>
                     <a class="btn btn-danger" target="_blank" href="https://plus.google.com/share?url={{urlencode(route('item.show', [$item->pk_i_id]))}}"> 
                      <i class="fa fa-google-plus"></i> Google+
                     </a>
                     <a class="btn btn-tw" target="_blank" href="http://twitter.com/share?url={{urlencode(route('item.show', [$item->pk_i_id]))}}"> 
                      <i class="fa fa-twitter"></i> Twitter
                     </a>
                  </div>
                </div> 
            </div>
          </div>
          <!--/.ads-details-wrapper--> 
          
        </div>
        <!--/.page-content-->


        <div class="col-md-3  page-sidebar-right">
        @if($item->is_actual())
          <aside>
            <div class="panel sidebar-panel panel-contact-seller">
              <div class="panel-heading">
                <p class="text-center">Написать владельцу:</p>
              </div>
              <div class="panel-content user-info">
                @if(!Auth::user())
                  <div class="panel-body text-center">
                    <div class="seller-info">
                      <h3 class="no-margin"><a href="{{route('login')}}">Авторизуйтесь</a> чтобы написать пользователю</h3>
                    </div>
                  </div>
                @elseif(Auth::user()->pk_i_id == $item->fk_i_user_id)
                  <div class="panel-body text-center">
                    <div class="seller-info">
                      <h3 class="no-margin">Это ваше собственное объявление</h3>
                    </div>
                  </div>
                @else
                  <div class="panel-body text-center">
                    <div class="seller-info">
                      <h3 class="no-margin">
                        Владелец объявления:
                        @if(isset($item->user->pk_i_id))
                          <a href="{{ route('user.ads', $item->user->pk_i_id)}}">{{$item->user->s_name}}</a>
                        @else
                          нет данных
                        @endif
                      </h3>
                    </div>
                    <div class="user-ads-action"> 
                      <a href="#contactAdvertiser" data-toggle="modal" class="btn btn-success btn-block">
                        <i class=" icon-mail-2"></i> Отправить сообщение 
                      </a> 
                    </div>
                  </div>
                @endif
              </div>
            </div>
            <!--/.categories-list--> 
          </aside>
          @endif



          @if(!$related_items->isEmpty())
            <aside>
              <div class="panel sidebar-panel panel-contact-seller">
                <div class="panel-heading">
                  <p class="text-center">Похожие объявления:</p>
                </div>
                <div class="panel-content user-info">
                  @foreach($related_items as $item)
                    <div style="padding:5px">
                      <a href="{{route('item.show', $item->pk_i_id)}}">
                      <img style="margin-bottom:0px" class="img-responsive thumbnail center-block" src="{{asset($item->demo_image())}}" alt="">
                        <div class="text-center">
                          <h5 class="add-title">
                            {{$item->description->s_title}}
                            @if(!is_null($item->i_price))
                              - <span class="related-ads-price">
                                <b>{{$item->formatedPrice()}} {{$item->currency->s_description}}</b>
                                </span>
                            @endif
                          </h5>

                          <span class="info-row">
                            <span class="date"><i class="fa fa-calendar"> </i> {{$item->showPubDate()}} </span>
                            <span class="views"><i class="icon-eye"> {{$item->stats->sum('i_num_views')}}</i></span>
                            <br>
                          </span>
                        </div>
                      </a>
                    </div>
                    @if($item != $related_items->last()) <hr style="margin-bottom: 0px"> @endif
                  @endforeach
                </div>
              </div>

            </aside>
          @endif
                  <!-- Google ads-->
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- formoney -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-2797655075626618"
                 data-ad-slot="8760357985"
                 data-ad-format="auto"></ins>
            <script>
              (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            <!-- Google ads-->
        </div>



        <!--/.page-side-bar--> 
      </div>
    </div>
  </div>

@if(Auth::check())
<div class="modal fade" id="contactAdvertiser" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><i class=" icon-mail-2"></i> Написать владельцу </h4>
      </div>
      <form action="{{route('item.contact-owner')}}" method="POST" role="form">
        <div class="modal-body">
            {{ csrf_field() }}
            <input type="hidden" name="item_id" value="{{$item->pk_i_id}}">
            <div class="form-group">
              <label for="recipient-Phone-Number"  class="control-label">Номер Телефона <span class="text-muted">(необязательно)</span>:</label>
              <input type="text" name="phone" maxlength="60" class="form-control" id="recipient-Phone-Number">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">Сообщение:</label>
              <textarea class="form-control" id="message-text" rows="5" data-placement="top" name="text" data-trigger="manual"></textarea>
            </div>
            <div class="form-group">
              <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
          <button type="submit" class="btn btn-success pull-right">Отправить!</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif


@stop

@section('styles')
<link href="{{asset('assets/plugins/bxslider/jquery.bxslider.css')}}" rel="stylesheet" />
@stop

@section('scripts')
<script src="{{asset('assets/plugins/bxslider/jquery.bxslider.min.js')}}"></script> 
 <script>
   $(document).ready(function(){
     $('.bxslider').bxSlider({
       pagerCustom: '#bx-pager'
     });
   });
	</script> 
@stop