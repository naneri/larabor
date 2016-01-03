@foreach($items as $item)
	<div class="item-list">
      <div class="col-sm-2 no-padding photobox">
        <div class="add-image">  
          <a href='{{url("item/{$item->pk_i_id}")}}'>
            @if(isset($item->lastImage))
            <img class="thumbnail no-margin" src="http://larabor.local/{{$item->lastImage->thumbnailUrl()}}" alt="img">
            @else
            <img class="thumbnail no-margin" src="http://zabor.kg/oc-content/themes/bender/images/no_photo.gif" alt="img">
            @endif
          </a> 
        </div>
      </div>
      <!--/.photobox-->
      <div class="col-sm-7 add-desc-box">
        <div class="add-details">
          <h5 class="add-title"> <a href='{{url("item/show/{$item->pk_i_id}")}}'> {{$item->description->s_title or ''}}  </a> </h5>
          <span class="info-row"> 
            <span class="date"><i class="icon-clock"> </i> {{$item->dt_pub_date or null}} </span> 
            <span class="views"><i class="icon-eye"> {{$item->stats->sum('i_num_views')}}</i></span><br>
            <span class="category">{{$item->category->description->s_name or null}}</span>
            <br>
          </span> </div>
      </div>
      <!--/.add-desc-box-->
      <div class="col-sm-3 text-right  price-box">
        <h2 class="item-price">
          @if(!is_null($item->i_price))
            {{$item->i_price}} {{$item->currency->s_description}}
          @else
            не указана
          @endif
        </h2>
       
        </div>
      <!--/.add-desc-box--> 
    </div>
@endforeach