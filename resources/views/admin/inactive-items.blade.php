@extends('admin._misc._admin-layout')

@section('content')
	<div class="container">
		<table class="table table-responsive">
			<thead>
				<tr>
					<th>Image</th>
					<th><a href="?&order_param=pk_i_id">ID</a></th>
					<th>Title</th>
					<th><a href="?&order_param=dt_pub_date">Pub. Date</a></th>
					<th>Views</th>
					<th>Contact</th>
				</tr>	
			</thead>
			<tbody>
				@foreach($items as $item)
				<tr 
					data-toggle="tooltip" 
					title="{{@$item->description->s_description}} | {{@$item->formatedPrice()}} {{@$item->fk_c_currency_code}}"
					@if($item->b_enabled == 0)
						class="danger"
					@endif
					>
					<th style="width:50px"><img src="{{asset($item->demo_image())}}" class="img-responsive" alt=""></th>
					<th>{{@$item->pk_i_id}}</th>
					<th> 
						<a href="{{route('item.show',[$item->pk_i_id, $item->s_secret])}}">{{str_limit(@$item->description->s_title, 30)}}</a> 
					</th>
					<th>{{@$item->dt_pub_date}}</th>
					<th>{{@$item->stats->sum('i_num_views')}}</th>
					<th class="custom-tools">
						{{@$item->s_contact_email}}
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="fa fa-wrench"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
            	<li><a onclick="activateItem({{$item->pk_i_id}})">Activate</a></li>
              <li><a class="item_delete_button" onclick="blockItem({{$item->pk_i_id}})" href="#">Block item</a></li>
              <li><a class="item_delete_button" onclick="deleteItem({{$item->pk_i_id}})" href="#">Delete item</a></li>
              
            </ul>
					</th>
				
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="center-block">
			<?php echo $items->appends(array('order_param' => $order_param))->render(); ?>
		</div>
	</div>

	
@stop

@section('scripts')
<script type="text/javascript">
		
		$.ajaxSetup({
		    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
		});

		function activateItem(item_id)
		{
			$.get('{{url("admin/item/activate")}}',
				{id : item_id})
			.done(function(){
				location.reload();
			})
		}

		function blockItem(item_id)
		{
			$.post('{{url("admin/item/block")}}', 
				{id : item_id})
			.done(function(){
				location.reload();
			})
		}

		function deleteItem(item_id)
		{
			$.post('{{url("admin/item/delete")}}', 
				{id : item_id})
			.done(function(){
				location.reload();
			})
		}

</script>
@stop

