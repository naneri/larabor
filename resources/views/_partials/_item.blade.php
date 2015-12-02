@foreach($items as $item)
	<div class="item-list">
      <div class="col-sm-2 no-padding photobox">
        <div class="add-image">  
          <a href="ads-details.html">
            <img class="thumbnail no-margin" src="images/item/FreeGreatPicture.com-46404-google-drops-nexus-4-by-100-offers-15-day-price-protection-refund.jpg" alt="img">
          </a> 
        </div>
      </div>
      <!--/.photobox-->
      <div class="col-sm-7 add-desc-box">
        <div class="add-details">
          <h5 class="add-title"> <a href="ads-details.html"> {{$item->description->s_title or ''}}  </a> </h5>
          <span class="info-row"> 
            <span class="date"><i class="icon-clock"> </i> {{$item->dt_pub_date}} </span> - <span class="category">{{$item->category->description->s_name}} </span>
          </span> </div>
      </div>
      <!--/.add-desc-box-->
      <div class="col-sm-3 text-right  price-box">
        <h2 class="item-price">{{$item->i_price or ''}} {{$item->currency->s_description or 'не указана'}}
        </h2>
        <a class="btn btn-default  btn-sm make-favorite"> <i class="fa fa-heart"></i> <span>Save</span> </a> </div>
      <!--/.add-desc-box--> 
    </div>
@endforeach