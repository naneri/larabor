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