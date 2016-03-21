@extends('_misc._layout')

@section('title', 'Служба поддержки Zabor.kg')

@section('meta')
<meta name="title" content="Служба поддержки Zabor.kg" />
<meta name="description" content="Форма обратной связи с администрацией Zabor.kg" />
@show

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
                  <p>Дорогие пользователи!</p>
                  <p>Вы можете воспользоваться данной формой контактов для связи с администрацией. Возникли вопросы по функционалу? Нашли ошибку в работе сайта? Или у вас есть идеи и предложения? Не стесняйтесь и напишите нам! </p>
                	<form class="form-horizontal" method="post">
	                    <fieldset>
												{{ csrf_field() }}
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
@stop