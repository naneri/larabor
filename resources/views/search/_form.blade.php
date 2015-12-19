<form method="GET" action="{{url('search')}}" role="form" >
<input type="hidden" name="category" value="{{$searchParams['category'] or null}}">
<input type="hidden" name="orderBy" value="{{$searchParams['orderBy'] or 'dt_pub_date'}}">
<input type="hidden" name="orderType" value="{{$searchParams['orderBy'] or 'ASC'}}">

  <div class="locations-list  list-filter">
    <h5 class="list-title"><strong>Ваш поиск</strong></h5>
    <div class="form-group col-sm-12 no-padding">
      <input type="text" name="text" id="text" value="{{$searchParams['text'] or ''}}" class="form-control">
    </div>
    <div style="clear:both"></div>
  </div><!--/.list-filter-->

  <div class="locations-list  list-filter">
    <h5 class="list-title"><strong>Цена</strong></h5>
    <div class="form-group price-form">
      <div class="form-group col-sm-5 no-padding">
        <input type="text" name="minPrice" id="minPrice" value="{{$searchParams['minPrice'] or ''}}" class="form-control">
      </div>
      <div class="form-group col-sm-2 no-padding text-center"> 
       - 
      </div>
	    <div class="form-group col-sm-5 no-padding">
	        <input type="text" name="maxPrice" id="maxPrice" value="{{$searchParams['maxPrice'] or ''}}" class="form-control">
	    </div>
    </div>

    <div class="form-group">
      <div class="locations-list list-filter">
        <span class="uppercase">Валюта</span>
        <select name="currency" class="form-control">
          <option></option>  
          @foreach($currencies as $currency)
            <option value="{{$currency->pk_c_code}}" {{searchSelectedCurrency($currency, $searchParams)}}>
                {{$currency->s_description}}
              </option>
          @endforeach
        </select>
      </div>
    </div>
    <div style="clear:both"></div>
  </div><!--/.list-filter-->
  
  @if(!empty($metas))
    @foreach($metas as $meta)
      <div class="locations-list  list-filter">
        <h5 class="list-title"><strong>{{$meta->s_name}}</strong></h5>
        <ul class="browse-list list-unstyled long-list">
          @foreach(explode(',', $meta->s_options) as $option)
            <li> 
              <label class="radio-inline">
                <input name="meta[{{$meta->pk_i_id}}]" type="radio" value="{{$option}}" {{searchMetaSelected($meta, $option, $searchParams)}}>{{$option}}
              </label>
            </li>
          @endforeach
        </ul>
      </div>
    @endforeach
  @endif
  <div class="form-group col-sm-3 no-padding pull-right">
    <button class="btn btn-primary pull-right" type="submit">Искать</button>
  </div>
  
</form>