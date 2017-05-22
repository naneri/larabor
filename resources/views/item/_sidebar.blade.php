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