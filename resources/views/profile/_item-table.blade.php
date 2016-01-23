<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
  <thead>
    <tr>
      <th> Photo </th>
      <th data-sort-ignore="true"> Adds Details </th>
      <th class="hidden-xs" data-type="numeric" > Price </th>
      <th> Option </th>
    </tr>
  </thead>
  <tbody>
    @foreach($items as $item)
    <tr>
      <td style="width:14%" class="add-img-td">
        <a href="{{url('item/show', [$item->pk_i_id])}}">
        @if(isset($item->lastImage))
        <img class="thumbnail  img-responsive" src="http://larabor.local/{{$item->lastImage->thumbnailUrl()}}" alt="img">
        @else
        <img class="thumbnail no-margin" src="http://zabor.kg/oc-content/themes/bender/images/no_photo.gif" alt="img">
        @endif
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
          <p class="visible-xs"> 
            <strong>Price:</strong>
            <span>
              @if(!is_null($item->i_price))
                {{$item->i_price}} {{$item->currency->s_description}}
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
              {{$item->i_price}} {{$item->currency->s_description}}
            @else
              не указана
            @endif
          </strong>
        </div>
      </td>
      <td style="width:10%" class="action-td"><div>
          <p><a class="btn btn-primary btn-xs"> <i class="fa fa-edit"></i> Редактировать </a></p>
          <p> <a class="btn btn-info btn-xs"> <i class="fa fa-clock-o"></i> Продлить </a></p>
          <p> <a class="btn btn-danger btn-xs"> <i class=" fa fa-trash"></i> Удалить </a></p>
        </div></td>
    </tr>
    @endforeach
  </tbody>
</table>