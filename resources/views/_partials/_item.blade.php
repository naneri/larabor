@foreach($items as $item)
	<div class="item-list">
      <div class="col-sm-2 no-padding photobox">
        <div class="add-image">  
          <a href='{{url("item/show/{$item->pk_i_id}")}}'>
            <img class="thumbnail no-margin" src="{{asset($item->demo_image())}}" alt="img">
          </a> 
        </div>
      </div>
      <!--/.photobox-->
      <div class="col-sm-7 add-desc-box">
        <div class="add-details">
          <h5 class="add-title"> <a href='{{url("item/show/{$item->pk_i_id}")}}'> {{$item->description->s_title or ''}}  </a> </h5>
          <span class="info-row"> 
            <span class="date"><i class="fa fa-calendar"> </i> {{$item->showPubDate()}} </span> 
            <span class="views"><i class="icon-eye"> {{$item->view_stats}}</i></span><br>
            <span class="category">{{$item->category->description->s_name or null}}</span>
            <br>
          </span> 
        </div>
      </div>
      <!--/.add-desc-box-->
      <div class="col-sm-3 text-right  price-box">
        <h2 class="item-price">
          @if(!is_null($item->i_price))
            {{$item->formatedPrice()}} {{$item->currency->s_description}}
          @else
            не указана
          @endif
        </h2>
       
        </div>
      <!--/.add-desc-box--> 
    </div>
@endforeach