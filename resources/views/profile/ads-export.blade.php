@extends('_misc._layout')

@section('title')
  Экспорт объявлений
@stop

@section('content')
<div class="main-container">
    <div class="container">
        <div class="row">
        	@include('profile._sidebar', ['page' => 'ads-export'])

        	<div class="col-sm-9 page-content">
        		<div class="inner-box">
        			<h2 class="title-2"><i class="icon-attach-2"></i> Экспорт объявлений</h2>
        			<div>
        				<p><b><i class="fa fa-file-excel-o"></i> Excel:</b></p>
        				<div class="col-md-6">
        					@if($user->info['priceListUpdate']['updates'] < Config::get('zabor.export.updates'))
        					<a href="{{route('profile.generate-excel')}}">Сгенерировать заново</a>
        					<small>
        						(Лимит - {{Config::get('zabor.export.updates')}} попыток в день)
        					</small> 
        					@else
							<span data-toggle="tooltip" data-placement="top" 
							title="Вы достигли лимита по генерации прайс листов. Подождите до завтра." 
							style="color:blue">Невозможно сгенерировать</span>
        					@endif
        					<br>
    						<span>
        						<small>Дата генерации:  <i class="fa fa-calendar"></i> {{$user->info['priceListUpdate']['date'] or ''}}</small>
        					</span>
        				</div>
        				<div class="col-md-6">
        					<div class="pull-right">
	        					@if(!empty($user->info['priceListUpdate']['path']))
									<a target="_blank" class="btn btn-primary btn-sm" href="{{url($user->info['priceListUpdate']['path'])}}/price.xlsx">Скачать</a>
								@endif	
	        				</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
</div>
@stop