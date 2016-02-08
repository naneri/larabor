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
                  @include('_partials._alerts')
                  <form method="POST" action="{{url('password/email')}}" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="sender-email" class="control-label">Электронная почта:</label>
                      <div class="input-icon"> <i class="icon-user fa"></i>
                       <input id="sender-email" type="text"  placeholder="Электронная почта" class="form-control email" name="email" value="{{ old('email') }}">
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