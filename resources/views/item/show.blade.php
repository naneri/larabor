@extends('_misc._layout')

@section('title')
  {{$item->description->s_title}}
@stop

@section('meta')
  <meta name="item-url" content="{{url('api/item/'.$item->pk_i_id.'/comments')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
            @include('item._header')
            
            <div class="Ads-Details">
              <div class="row">
                <ul class="nav nav-tabs">
                  <li role="presentation" class="active">
                    <a href="#main" aria-controls="main" role="tab" data-toggle="tab">Информация</a>
                  </li>
                  <li role="presentation">
                    <a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Комментарии</a>
                  </li>
                </ul>
              </div>
              <div class="row">
                <div class="tab-content">
                  <div role="tabpanel" id="main" class="active fade in tab-pane ads-details-info">
                    @include('item._description')
                  </div>
                  <div role="tabpanel" id="comments" class="fade in tab-pane ads-details-info">
                    @include('item._comments')
                  </div>
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
          @include('item._sidebar')
        </div>

        <!--/.page-side-bar--> 
      </div>
    </div>
  </div>

@if(Auth::check())
<div class="modal fade" id="contactAdvertiser" tabindex="-1" role="dialog">
  @include('item._modal')
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

<script src="{{asset('assets/js/vuejs-paginator.min.js')}}"></script>
<script src="{{asset('app/show-item.js')}}"></script>
@stop