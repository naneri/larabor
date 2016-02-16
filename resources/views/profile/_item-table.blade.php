<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
  <thead>
    <tr>
      <th> Фотография </th>
      <th data-sort-ignore="true"> Детали объявления </th>
      <th class="hidden-xs" data-type="numeric" > Цена </th>
      <th class="hidden-xs"> Управление </th>
    </tr>
  </thead>
  <tbody>
    @foreach($items as $item)
    <tr>
      <td style="width:14%" class="add-img-td">
        <a href="{{url('item/show', [$item->pk_i_id])}}">
          <img class="thumbnail  img-responsive" src="{{asset($item->demo_image())}}" alt="img">
        </a>
      </td>
      <td style="width:58%" class="ads-details-td">
        <div>
          <p>
            <strong> 
              <a href="{{url('item/show', [$item->pk_i_id])}}" title="Brend New Nexus 4">{{$item->description->s_title or ''}}</a> 
            </strong>
          </p>
          <p class="hidden-xs"> 
            <i class="fa fa-calendar"> </i>
            {{$item->dt_pub_date or null}}  <i class="icon-eye"></i> {{$item->stats->sum('i_num_views')}}
          </p>
          <p style="color:#A93B3B">
            <i  class="fa fa-calendar-times-o"> </i>
            {{$item->dt_expiration or null}}
          </p>
          <p class="visible-xs"> 
            <strong>Price:</strong>
            <span>
              @if(!is_null($item->i_price))
                {{$item->formatedPrice()}} {{$item->currency->s_description}}
              @else
                не указана
              @endif
            </span>
          </p>
        </div>
      </td>
      <td class="hidden-xs" style="width:16%" class="price-td">
        <div>
          <strong> 
            @if(!is_null($item->i_price))
              {{$item->formatedPrice()}} {{$item->currency->s_description}}
            @else
              не указана
            @endif
          </strong>
        </div>
      </td>
      <td style="width:10%" class="hidden-xs action-td"><div>
          <p><a href="{{route('item.edit', $item->pk_i_id)}}" class="btn btn-primary btn-xs"> <i class="fa fa-edit"></i> Редактировать </a></p>
          <p> <a href="{{route('item.prolong', $item->pk_i_id)}}" class="btn btn-info btn-xs"> <i class="fa fa-clock-o"></i> Продлить </a></p>
          <p> 
            <a href="{{route('item.delete', $item->pk_i_id)}}" class="btn btn-danger btn-xs"> 
                <i class=" fa fa-trash"></i> Удалить 
            </a>
          </p>
        </div></td>
    </tr>
    @endforeach
  </tbody>
</table>