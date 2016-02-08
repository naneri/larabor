@extends('_misc._layout')

@section('title')
  Восстановление пароля на Zabor.kg
@stop 

@section('meta')
<meta name="title" content="Восстановление пароля на Zabor.kg" />
<meta name="description" content="Страница восстановления пароля на Zabor.kg" />
@stop

@section('content')
<div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-sm-5 login-box">
            <div class="panel panel-default">
                <div class="panel-intro text-center">
                  <h2 class="logo-title"> 
                    <!-- Original Logo will be placed here  --> 
                    ВОССТАНОВЛЕНИЕ ПАРОЛЯ </h2>
                </div>
                <div class="panel-body">
                  @include('_partials._errors', compact('errors'))
                  <form method="POST" action="{{url('password/reset')}}" role="form">
                    {{ csrf_field() }}
                    <input type="hidden" name="email" value="{{$email}}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                      <label for="sender-email" class="control-label">Новый пароль:</label>
                      <div>
                       <input id="sender-email" type="password" name="password" class="form-control email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="sender-email" class="control-label">Повторите пароль:</label>
                      <div>
                       <input id="sender-email" type="password" name="password_confirmation" class="form-control email">
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary  btn-block">Подтвердить</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
<!-- /.main-container -->
@stop