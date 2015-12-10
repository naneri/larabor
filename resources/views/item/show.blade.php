@extends('_misc._layout')

@section('content')
<div class="main-container">
    <div class="container">
      <ol class="breadcrumb pull-left">
        <li><a href="{{url('/')}}"><i class="icon-home fa"></i></a></li>
        <li><a href="sub-category-sub-location.html">{{$item->category->description->s_name}}</a></li>
        <li class="active">{{$item->description->s_title}}</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 page-content col-thin-right">
          <div class="inner inner-box ads-details-wrapper">
            <h2> {{$item->description->s_title}} </h2>
            <span class="info-row"> 
            	<span class="date">
            		<i class=" icon-clock"> </i> {{$item->dt_pub_date}} 
            	</span>  
            </span>
            <div class="ads-image">
              <h1 class="pricetag"> {{$item->i_price or ''}} {{$item->currency->s_description or 'не указана'}}</h1>
              <ul class="bxslider">
              	@forelse($item->images as $image)
                <li><img src="http://zabor.kg/{{$image->imageUrl()}}" alt="img" /></li>
                @empty
                <li><img src="http://zabor.kg/oc-content/themes/bender/images/no_photo.gif" alt="img" /></li>
                @endforelse
              </ul>
              <div id="bx-pager">
	            @forelse($item->images as $key => $image)
	                <a class="thumb-item-link" data-slide-index="{{$key}}" href=""><img src="http://zabor.kg/{{$image->imageThumbUrl()}}" alt="img" /></a>
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
              <div class="content-footer text-left"> 
                <div class="text-right">
                  <a href=""><i class=" icon-facebook ln-shadow shape-4"></i> </a>
                  <a href=""><i class="icon-googleplus-rect ln-shadow shape-6"></i> </a>
                  <a href=""><i class="icon-twitter-bird ln-shadow shape-3"></i></a>
                </div>
              </div>
            </div>
          </div>
          <!--/.ads-details-wrapper--> 
          
        </div>
        <!--/.page-content-->
        
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
                      <h3 class="no-margin">Авторизуйтесь чтобы написать пользователю</h3>
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
                      <h3 class="no-margin">Richard Aki</h3>
                      <p>Location: <strong>New York</strong></p>
                      <p> Joined: <strong>12 Mar 2009</strong></p>
                    </div>
                    <div class="user-ads-action"> <a href="#contactAdvertiser" data-toggle="modal" class="btn   btn-default btn-block"><i class=" icon-mail-2"></i> Send a message </a> <a class="btn  btn-info btn-block"><i class=" icon-phone-1"></i> 01680 531 352 </a> </div>
                  </div>
                @endif
              </div>
            </div>
           
            <!--/.categories-list--> 
          </aside>
        </div>
        <!--/.page-side-bar--> 
      </div>
    </div>
  </div>

 
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