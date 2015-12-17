<div class="categories-list  list-filter">
    <ul class="list-unstyled">
      @if($cat_ancestors == null)	
		@foreach($cat_children as $category)
		<li><a href="{{url('search?category='.$category->pk_i_id)}}"><span class="title">{{$category->description->s_name}}</span></a></li>
		@endforeach
      @else
      <li>
      	<a href="{{url('search')}}">
      		<span class="title">Все категории</span>
      	</a>
      </li>
      <li>
        <a href="{{url('search?category='.$cat_ancestors[0]->pk_i_id)}}">
          <span class="title {{count($cat_ancestors) == 1 ? 'bold' : ''}}">
            {{$cat_ancestors[0]->description->s_name}}
          </span>
        </a>
        <ul class=" list-unstyled long-list">
          @if(count($cat_ancestors) == 1)
            @foreach($cat_children as $category)
              <li><a href="{{url('search?category='.$category->pk_i_id)}}"><span class="title">{{$category->description->s_name}}</span></a></li>
            @endforeach
          @elseif(count($cat_ancestors) > 1)
            <li><a href="{{url('search?category='.$cat_ancestors[1]->pk_i_id)}}"><span class="title {{count($cat_ancestors) == 2 ? 'bold' : ''}}">{{$cat_ancestors[1]->description->s_name}}</span></a>
              <ul class="list-unstyled long-list">
                @if(count($cat_ancestors) == 2)
                  @foreach($cat_children as $category)
                    <li><a href="{{url('search?category='.$category->pk_i_id)}}"><span class="title">{{$category->description->s_name}}</span></a></li>
                  @endforeach
                @elseif(count($cat_ancestors) > 2)  
                  <li><a href="{{url('search?category='.$cat_ancestors[2]->pk_i_id)}}">
                  <span class="title {{count($cat_ancestors) == 3 ? 'bold' : ''}}">
                    {{$cat_ancestors[2]->description->s_name}}
                  </span>
                  </a>
                  </li>
                @endif
              </ul>
            </li>
          @endif
        </ul>
      </li>
      @endif
    </ul>
</div>