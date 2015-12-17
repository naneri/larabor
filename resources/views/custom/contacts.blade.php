@extends('_misc._layout')

@section('content')
	<div class="main-container">
    <div class="container">
      <div class="row clearfix">
          @include('_partials._errors')
          <div class="col-md-offset-2 col-md-8">
          	<div class="panel panel-default">
          		<div class="contact-form">
                <div class="panel-heading">
                	<h5 class="list-title gray">
                  	<strong>Напишите нам</strong>
                  </h5>
                </div>
                <div class="panel-body">
                	<form action="" class="form-horizontal" method="post">
	                    <fieldset>
													<div class="row">
                            <div class="col-sm-6">
	                            <div class="form-group">
                                <div class="col-md-12">
                                    <input id="name" name="name" type="text" placeholder="Ваше имя" class="form-control" value="{{@Auth::user()->s_name ?: ''}}">
                                </div>
	                            </div>
		                        </div>
                            <div class="col-sm-6">
	                            <div class="form-group">
		                            <div class="col-md-12">
		                                <input id="email" name="email" type="text" placeholder="Электронная почта" class="form-control" value="{{@Auth::user()->s_email ?: ''}}">
		                            </div>
			                        </div>
                            </div>
                        	</div>    
                         	<div class="row">
                            <div class="col-lg-12">
	                            <div class="form-group">
		                            <div class="col-md-12">
		                                <textarea class="form-control" id="message" name="message" placeholder="Введите ваше сообщение, мы постараемся ответить в течении двух дней" rows="7"></textarea>
		                            </div>
		                        </div>
	                            
	                            
	                          <div class="form-group pull-right">
	                            <div class="col-md-12 ">
	                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
	                            </div>
	                        </div>
                        </div>
	                    </fieldset>
                	</form>
                </div>    
               </div>
          	</div>
          </div>
      </div>
    </div>
  </div>
  <div style="height:100px"></div>
@stop