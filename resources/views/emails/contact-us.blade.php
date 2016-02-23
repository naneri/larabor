@extends('emails._layout-mail')


@section('title')
	Пользователь оставил сообщение
@stop


@section('content')
	<p><b>Имя</b>: @{{$data['name']}}</p>
	<p><b>Email</b>: @{{$data['email']}}</p><br>
	<p><b>Сообщение</b>: @{{$data['message']}}</p>
@stop 