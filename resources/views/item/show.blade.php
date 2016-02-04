@extends('_misc._layout')

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
      <div class="row">

        <div class="col-sm-9 page-content col-thin-right">
          <div class="inner inner-box ads-details-wrapper">
            <h2> 
              {{str_limit($item->description->s_title, 50)}} 
              @if($is_owner)
              <span class="pull-right">
                <a href="{{route('item.edit', ['id' => $item->pk_i_id, 'code' => $code])}}"><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"></i> Редактировать</button></a>
                <a href="{{route('item.prolong', ['id' => $item->pk_i_id, 'code' => $code])}}"><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-clock-o"></i> Продлить</button></a>
                <a href="{{route('item.delete', ['id' => $item->pk_i_id, 'code' => $code, 'redirect' => 'origin'])}}"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Удалить</button></a>
              </span>
              @endif
            </h2>
            <span class="info-row"> 
            	<span class="date">
            		<i class=" icon-clock"> </i> {{$item->dt_pub_date}} 
            	</span>  
            </span>
            <div class="ads-image">
              <h1 class="pricetag"> {{$item->i_price or ''}} {{$item->currency->s_description or 'не указана'}}</h1>
              <ul class="bxslider">
              	@forelse($item->images as $image)
                <li><img src="{{asset($image->imageUrl())}}" alt="img" /></li>
                @empty
                <li><img src="http://zabor.kg/oc-content/themes/bender/images/no_photo.gif" alt="img" /></li>
                @endforelse
              </ul>
              <div id="bx-pager">
	            @forelse($item->images as $key => $image)
	                <a class="thumb-item-link" data-slide-index="{{$key}}" href=""><img src="{{asset($image->thumbnailUrl())}}" alt="img" /></a>
                @empty
                	<a class="thumb-item-link" data-slide-index="0" href=""><img src="http://zabor.kg/oc-content/themes/bender/images/no_photo.gif" alt="img" /></a>
                @endforelse
              </div>
            </div>
            <!--ads-image-->
            
            <div class="Ads-Details">
              <h5 class="list-title"><strong>Описание</strong></h5>
              <div class="row">
                <div class="ads-details-info col-md-8">
                	{{$item->description->s_description}}
                </div>
                <div class="col-md-4">
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
                            @else
                                {{$meta->s_value}}
                            @endif
                        </p>
                      </li>
                      @endif
                     @endforeach()
                      
                    </ul>
                  </aside>
                </div>
              </div>
          <!--     <div class="content-footer text-left"> 
            <div class="text-right">
              <a href=""><i class=" icon-facebook ln-shadow shape-4"></i> </a>
              <a href=""><i class="icon-googleplus-rect ln-shadow shape-6"></i> </a>
              <a href=""><i class="icon-twitter-bird ln-shadow shape-3"></i></a>
            </div>
          </div> -->
            </div>
          </div>
          <!--/.ads-details-wrapper--> 
          
        </div>
        <!--/.page-content-->
        
        @if($item->is_actual())
        <div class="col-sm-3  page-sidebar-right">
          <aside>
            <div class="panel sidebar-panel panel-contact-seller">
              <div class="panel-heading">
                <p class="text-center">Написать:</p>
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
        </div>
        @endif

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
<link href="{{url('assets/plugins/bxslider/jquery.bxslider.css')}}" rel="stylesheet" />
@stop

@section('scripts')
<script src="{{url('assets/plugins/bxslider/jquery.bxslider.min.js')}}"></script> 
 <script>
	$('.bxslider').bxSlider({
	  pagerCustom: '#bx-pager'
	});
	</script> 
@stop