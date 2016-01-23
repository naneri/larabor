@extends('_misc._layout')

@section('content')
<div class="main-container">
    <div class="container">
      <div class="row">
        @include('profile._sidebar', ['page' => 'main'])
        <!--/.page-sidebar-->
        
        <div class="col-sm-9 page-content">
         
          <div class="inner-box">
            <div id="accordion" class="panel-group">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"> <a href="#collapseB1"  data-toggle="collapse"> Мои данные </a> </h4>
                </div>
                <div class="panel-collapse collapse in" id="collapseB1">
                  <div class="panel-body">
                    <form method="POST" class="form-horizontal" action="{{route('profile.update')}}" role="form">
                    {{ csrf_field() }}
                      <div class="form-group {{zbCheckError($errors->first('name'))}}">
                        <label  class="col-sm-3 control-label">Имя</label>
                        <div class="col-sm-9">
                          <input type="text" name="name" class="form-control"  value="{{!is_null(old('name')) ? old('name') : $user->s_name}}">
                          @foreach ($errors->get('name') as $error)
                            <p class="checkbox help-block">
                              <small>{{$error}}</small>
                            </p>
                          @endforeach
                        </div>
                      </div>
                      <div class="form-group {{zbCheckError($errors->first('phone'))}}">
                        <label  class="col-sm-3 control-label">Телефон</label>
                        <div class="col-sm-9">
                          <input type="text" name="phone" class="form-control" value="{{!is_null(old('phone')) ? old('phone') : $user->s_phone_land}}">
                          @foreach ($errors->get('phone') as $error)
                            <p class="checkbox help-block">
                              <small>{{$error}}</small>
                            </p>
                          @endforeach
                        </div>
                      </div>
                      <div class="form-group {{zbCheckError($errors->first('address'))}}">
                        <label  class="col-sm-3 control-label">Адрес</label>
                        <div class="col-sm-9">
                          <input type="text" name="address" class="form-control"  value="{{!is_null(old('address')) ? old('address') : $user->s_address}}">
                          @foreach ($errors->get('address') as $error)
                            <p class="checkbox help-block">
                              <small>{{$error}}</small>
                            </p>
                          @endforeach
                        </div>
                      </div>
                      <div class="form-group {{zbCheckError($errors->first('description'))}}">
                        <label  class="col-sm-3 control-label">Описание</label>
                        <div class="col-sm-9">
                          <textarea name="description" class="form-control" rows="7">{{!is_null(old('description')) ? old('description') : $user->description->s_info}}</textarea>
                          @foreach ($errors->get('description') as $error)
                            <p class="checkbox help-block">
                              <small>{{$error}}</small>
                            </p>
                          @endforeach
                        </div>
                      </div>

                     
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9"> </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-success">Сохранить</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"> <a href="#collapseB2"  data-toggle="collapse">Изменения пароля </a> </h4>
                </div>
                <div class="panel-collapse collapse-in" id="collapseB2">
                  <div class="panel-body">
                    <form method="POST" action="{{route('profile.update-pass')}}" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                      <div class="form-group {{zbCheckError($errors->first('old-pass'))}}">
                        <label  class="col-sm-3 control-label">Старый пароль</label>
                        <div class="col-sm-9">
                          <input name="old-pass" type="password" class="form-control"  placeholder="">
                          @foreach ($errors->get('old-pass') as $error)
                            <p class="checkbox help-block">
                              <small>{{$error}}</small>
                            </p>
                          @endforeach
                        </div>
                      </div>
                      <div class="form-group {{zbCheckError($errors->first('new-pass'))}}">
                        <label  class="col-sm-3 control-label">Новый пароль</label>
                        <div class="col-sm-9">
                          <input name="new-pass" type="password" class="form-control"  placeholder="">
                          @foreach ($errors->get('new-pass') as $error)
                            <p class="checkbox help-block">
                              <small>{{$error}}</small>
                            </p>
                          @endforeach
                        </div>
                      </div>
                      <div class="form-group {{zbCheckError($errors->first('new-pass-repeat'))}}">
                        <label  class="col-sm-3 control-label">Повторите новый пароль</label>
                        <div class="col-sm-9">
                          <input name="new-pass-repeat" type="password" class="form-control"  placeholder="">
                          @foreach ($errors->get('new-pass-repeat') as $error)
                            <p class="checkbox help-block">
                              <small>{{$error}}</small>
                            </p>
                          @endforeach
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-success">Сохранить</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--/.row-box End--> 
            
          </div>
        </div>
        <!--/.page-content--> 
      </div>
      <!--/.row--> 
    </div>
    <!--/.container--> 
  </div>
@stop