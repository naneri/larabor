@extends('_misc._layout')

@section('content')
<div class="main-container">
	<div class="container">
		<div class="row">
		    <div class="col-md-6 col-md-offset-3 text-center">
		      	<br>
		      	<h4><a href="{{url('/')}}">Zabor.kg</a> - доска бесплатных объявлений</h4>
		      	<p>
		      		<img src="{{asset('images/camera-404.png')}}" alt="">
		      	</p>
		      	<h2>
		      		<i class="fa fa-exclamation-triangle" style="color:red"></i>
		 			Страница не найдена <small>ошибка 404</small>
		 		</h2>
		 		<p>Данная страница не существует или была удалена</p>
		      	<p><small><a href="{{url('/')}}">Нажмите</a> чтобы перейти на главную страницу</small></p>
		    </div>

		  </div>
	</div>
</div>
@stop