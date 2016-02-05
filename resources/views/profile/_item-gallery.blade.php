@foreach($items->chunk(4) as $item_list)
  <div class="text-center">
    @foreach($item_list as $item)
    <div class="col-md-3 col-sm-4 col-xs-6 user-item">
      <div class="thumbnail">
        <h1 class="pricetag"> 
          @if(!is_null($item->i_price))
            {{$item->formatedPrice()}} {{$item->currency->s_description}}
          @else
            не указана
          @endif
        </h1>
        <div>
          <a href='{{url("item/show/{$item->pk_i_id}")}}'>
            <img class="thumbnail" src="{{asset($item->demo_image())}}" alt="img">
          </a>
        </div>
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