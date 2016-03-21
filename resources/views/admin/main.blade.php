@extends('admin._misc._admin-layout')

@section('content')
	<div class="row">
		<div class="col-lg-6">
			<div class="col-lg-6">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Monthly custom ads</h5>
					</div>
					<div class="ibox-content">
						<h1 class="no-margins">{{$items_posted}}</h1>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Current active custom ads</h5>
					</div>
					<div class="ibox-content">
						<h1 class="no-margins">{{$item_active}}</h1>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Custom ads in PC</h5>
					</div>
					<div class="ibox-content">
						<h1 class="no-margins">{{$pc_stat}}</h1>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Custom ads in Phones</h5>
					</div>
					<div class="ibox-content">
						<h1 class="no-margins">{{$phone_stat}}</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Top Sellers</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<table class="table table-hover no-margins">
						<thead>
						<tr>
							<th>Email</th>
							<th>Ads</th>
							<th>Name</th>
						</tr>
						</thead>
						<tbody>
						@foreach($top_sellers as $seller)
							<tr>
								<td><small>{{@$seller->user->s_email}}</small></td>
								<td>{{@$seller->item_count}}</td>
								<td><a href="{{route('user.ads', [$seller->user->pk_i_id])}}">{{@$seller->user->s_name}}</a></td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop