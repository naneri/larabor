<div class="col-md-8">
  <p>
    <b>Владелец обьявления:</b>
    @if(!$item->user)
      <span class="text-muted">Не указан</span>
    @else
      <a href="{{ route('user.ads', $item->user->pk_i_id)}}">{{$item->user->s_name}}</a>
    @endif
  </p>
  <p>
    {!!nl2br(e($item->showDescription()))!!}
  </p>
</div>
<div class="col-md-4">
  @if($item->is_active())
    <aside class="panel panel-body panel-details">
      <ul>
        @foreach($item->metas as $meta)
          @if(!($meta->meta->e_type == 'URL' &&$meta->s_value == ''))
            <li>
              <p class=" no-margin "><strong>{{$meta->meta->s_name}}:</strong>
                @if($meta->meta->e_type == 'CHECKBOX')
                  @if($meta->s_value == 1)
                    <i style="color:green" class="fa fa-check"></i>
                  @else
                    <i style="color:red" class="fa fa-close"></i>
                  @endif
                @elseif($meta->meta->e_type == 'URL')
                  <a rel="nofollow" href="{{$meta->s_value}}">{{$meta->s_value}}</a>
                @else
                  {{$meta->s_value}}
                @endif
              </p>
            </li>
          @endif
        @endforeach()
      </ul>
    </aside>
  @endif
</div>