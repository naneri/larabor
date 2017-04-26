@extends('_misc._layout')

@section('title')
  Мои данные
@stop

@section('content')
  <div class="main-container">
    <div class="container">
      <div class="row">
      @include('profile._sidebar', ['page' => 'notifications'])
      <!--/.page-sidebar-->

        <div class="col-sm-9 page-content">

          <div class="inner-box">
            <div id="accordion" class="panel-group">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"> <a href="#collapseB1"  data-toggle="collapse"> Уведомления </a> </h4>
                </div>
                <div class="panel-collapse collapse in" id="collapseB1">
                  <div class="panel-body">
                    <form method="POST" class="form-horizontal" action="{{route('profile.notifications.update')}}" role="form">
                      {{ csrf_field() }}
                      {{method_field('put')}}
                      <div class="form-group {{zbCheckError($errors->first('comment'))}}">
                        <div class="col-sm-11 col-sm-offset-1">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="comment" value="1"
                               @if(
                                old(
                                  'comment',
                                  isset($user->data->comment_notification) ?
                                  $user->data->comment_notification :
                                  1
                                )
                               )
                                  checked
                               @endif
                              >
                              <b>Новые комментарии</b>
                              <small class="text-muted">(отправлять уведомления на почту о новых комментариях к объявлениям)</small>
                            </label>
                          </div>
                          @include('_partials._input-errors', ['error_name' => 'comment'])
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