@extends('_misc._layout')

@section('title')
  Авторизация на Zabor.kg
@stop

@section('meta')
<meta name="title" content="Авторизация на Zabor.kg" />
<meta name="description" content="Страница авторизации на Zabor.kg" />
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
                <span class="logo-icon"><i class="icon icon-search-1 ln-shadow-logo shape-0"></i> </span> BOOT<span>CLASSIFIED </span> </h2>
            </div>
            <div class="panel-body">
              <form action="{{url('login')}}" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="sender-email" class="control-label">Электронная почта:</label>
                  <div class="input-icon"> <i class="icon-user fa"></i>
                    <input name="email" id="sender-email" type="text"  placeholder="Электронная почта" class="form-control email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="user-pass"  class="control-label">Пароль:</label>
                  <div class="input-icon"> <i class="icon-lock fa"></i>
                    <input name="password" type="password"  class="form-control" placeholder="Пароль"  id="user-pass">
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary  btn-block">Подтвердить</button>
                </div>
              </form>
            </div>
            <div class="panel-footer">
              <p class="text-center pull-right"> <a href="{{url('password/email')}}"> Забыли пароль? </a> </p>
              <div style=" clear:both"></div>
            </div>
          </div>
          <div class="login-box-btm text-center">
            <p> Нет учётной записи? <br>
              <a href="{{route('register')}}"><strong>Зарегистрируйтесь !</strong> </a> </p>
          </div>
        
      </div>
    </div>
  </div>
</div>
  <!-- /.main-container -->
@stop