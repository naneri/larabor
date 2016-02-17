@extends('admin._misc._admin-layout')

@section('content')
	<div class="row">
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Monthly custom ads</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">{{$items_posted}}</h1>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Current active custom ads</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">{{$item_active}}</h1>
				</div>
			</div>
		</div>
	</div>
@stop