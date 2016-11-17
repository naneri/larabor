@extends('_misc._layout')

@section('title')
  Регистрация на Zabor.kg
@stop

@section('meta')
<meta name="title" content="Регистрация на Zabor.kg" />
<meta name="description" content="Страница регистрации на Zabor.kg" />
@stop

@section('content')
<div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 page-content">
          <div class="inner-box category-content">
            <h2 class="title-2"> <i class="icon-user-add"></i> Создайте учётную запись </h2>
            <div class="row">
              <div class="col-sm-12">
                <form method="POST" action="{{url('register')}}" class="form-horizontal">
                  <fieldset>
                    {{ csrf_field() }}
                    <!-- Text input-->
                    <div class="form-group 
                       @if($errors->first('username'))
                        has-error
                      @endif
                    ">
                      <label class="col-md-4 control-label" >Логин</label>
                      <div class="col-md-6">
                        <input  
                        name="username" 
                        class="form-control input-md" 
                        required="" 
                        type="text" 
                        value="{{old('username')}}">
                        @foreach ($errors->get('username') as $error)
                          <p class="checkbox help-block">
                            {{$error}}
                          </p>
                        @endforeach
                      </div>
                    </div>
                    
   

                    <div class="form-group 
                      @if($errors->first('email'))
                        has-error
                      @endif
                    ">
                      <label for="inputEmail3" class="col-md-4 control-label">Почта</label>
                      <div class="col-md-6">
                        <input name="email" type="email" class="form-control" id="inputEmail3" value="{{old('email')}}">
                        @if($errors->has('email'))
                          <p class="checkbox help-block">
                            @if(!is_null(session('user')))
                              @if(session('user')->b_active == 0)
                                Учётная запись с данной почтой не была активирована,вы можете <a href="{{route('reactivate', session('user')->s_email)}}">запросить повторную активацию</a>
                              @else
                                Учётная запись с данной почтой уже существует. Если вы забыли пароль, вы может восстановить пройдя
                                <a href="{{route('reset.password')}}">по ссылке</a>
                              @endif
                            @else
                              @foreach ($errors->get('email') as $error)
                                  {{$error}}
                              @endforeach
                            @endif
                          </p>
                        @endif
                      </div>
                    </div>
                    <div class="form-group
                      @if($errors->first('password'))
                        has-error
                      @endif
                    ">
                      <label for="inputPassword3" class="col-md-4 control-label">
                        Пароль
                        <p class="text-muted"><small>(минимум 8 символов)</small></p>
                      </label>

                      <div class="col-md-6">
                        <input name="password" type="password" class="form-control" id="inputPassword3">
                        @foreach ($errors->get('password') as $error)
                          <p class="help-block">{{$error}}</p>
                        @endforeach
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="inputPassword3" class="col-md-4 control-label">Подтвердите пароль </label>
                      <div class="col-md-6">
                        <input name="password_confirmation" type="password" class="form-control" id="inputPassword3" >
                      
                      </div>
                    </div>
                    <div class="form-group">
                      <label  class="col-md-4 control-label"></label>
                      <div class="col-md-8">
                       
                        <div style="clear:both"></div>
                        <button class="btn btn-primary" type="submit">Зарегистрироваться</button> </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.page-content -->
        
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.main-container -->
@stop