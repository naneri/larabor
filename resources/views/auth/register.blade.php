@extends('_misc._layout')

@section('content')
<div class="main-container">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 page-content">
          <div class="inner-box category-content">
            <h2 class="title-2"> <i class="icon-user-add"></i> Create your account, Its free </h2>
            <div class="row">
              <div class="col-sm-12">
                <form method="POST" action="{{url('register')}}" class="form-horizontal">
                  <fieldset>
                    {{ csrf_field() }}
                    <!-- Text input-->
                    <div class="form-group required
                       @if($errors->first('username'))
                        has-error
                      @endif
                    ">
                      <label class="col-md-4 control-label" >Логин <sup>*</sup></label>
                      <div class="col-md-6">
                        <input  
                        name="username" 
                        placeholder="First Name" 
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
                    
   

                    <div class="form-group required
                      @if($errors->first('email'))
                        has-error
                      @endif
                    ">
                      <label for="inputEmail3" class="col-md-4 control-label">Почта <sup>*</sup></label>
                      <div class="col-md-6">
                        <input name="email" type="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{old('email')}}">
                        @foreach ($errors->get('email') as $error)
                          <p class="checkbox help-block">
                            {{$error}}
                          </p>
                        @endforeach
                      </div>
                    </div>
                    <div class="form-group required
                      @if($errors->first('password'))
                        has-error
                      @endif
                    ">
                      <label for="inputPassword3" class="col-md-4 control-label">Пароль </label>
                      <div class="col-md-6">
                        <input name="password" type="password" class="form-control" id="inputPassword3" placeholder="Password">
                        <p class="help-block">At least 6 characters</p>
                      </div>
                    </div>
                    <div class="form-group required">
                      <label for="inputPassword3" class="col-md-4 control-label">Подтвердите пароль </label>
                      <div class="col-md-6">
                        <input name="pass2" type="password" class="form-control" id="inputPassword3" placeholder="Password">
                      
                      </div>
                    </div>
                    <div class="form-group">
                      <label  class="col-md-4 control-label"></label>
                      <div class="col-md-8">
                       
                        <div style="clear:both"></div>
                        <button class="btn btn-primary" type="submit">Register</button> </div>
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