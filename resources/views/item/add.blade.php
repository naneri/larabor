@extends('_misc._layout')


@section('content')
<div class="main-container" ng-app="itemApp">
    <div class="container" ng-controller="ItemAddController as item">
      <div class="row">
        <div class="col-md-9 page-content">
          <div class="inner-box category-content">
            <h2 class="title-2 uppercase"><strong> <i class="icon-docs"></i> Подать Объявление</strong> </h2>
            @include('_partials._alerts')
            <div class="row">
              <div class="col-sm-12">
                <form enctype="multipart/form-data" action="{{url('item/add')}}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                  <fieldset>


                    <!-- Select Basic -->
                    <div class="form-group">
                      <label class="col-md-3 control-label" >Категория</label>
                      <div class="col-md-8">
                        <select name="category[]" id="category-group category-select" class="form-control category-select" ng-model="mainCategory" ng-change="categoryChange(mainCategory)">
                          <option ng-repeat="category in mainCategories" value="@{{category.pk_i_id}}">@{{category.description.s_name}}
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group" ng-show="subCategories.length">
                      <label class="col-md-3 control-label"></label>
                      <div class="col-md-8">
                        <select 
                          name="category[]" 
                          id="category-group category-select" 
                          class="form-control category-select" 
                          ng-model="subCategory" 
                          ng-change="subCategoryChange(subCategory)"
                        >
                          <option 
                            ng-repeat="category in subCategories" 
                            value="@{{category.pk_i_id}}">
                            @{{category.description.s_name}}
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group" ng-show="subSubCategories.length">
                      <label class="col-md-3 control-label" ></label>
                      <div class="col-md-8">
                        <select 
                          name="category[]" 
                          id="category-group category-select" 
                          class="form-control category-select" 
                          ng-model="subSubCategory"
                          ng-change=""
                        >
                          <option 
                            ng-repeat="category in subSubCategories" value="@{{category.pk_i_id}}">
                              @{{category.description.s_name}}
                          </option>
                        </select>
                      </div>
                    </div>
                    
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="title">Название</label>
                      <div class="col-md-8">
                        <input id="Adtitle" name="title" placeholder="Ad title" class="form-control input-md" required="" type="text"> </div>
                    </div>
                    
                    <!-- Textarea -->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="textarea">Описание</label>
                      <div class="col-md-8">
                        <textarea class="form-control" id="textarea" name="description" placeholder="Describe what makes your ad unique"></textarea>
                      </div>
                    </div>
                    
                    <!-- Prepended text-->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="price">Price</label>
                      <div class="col-md-4">
                          <input id="Price" name="price" class="form-control" placeholder="placeholder" type="text">
                      </div>
                      <div class="col-md-4">
                        <div data-toggle="buttons">
                          @foreach($currencies as $currency)
                            <label class="btn btn-info
                              {{$currency->pk_c_code == 'KGS' ? 'active' : ''}}">
                              <input type="radio" name="currency" id="option2" value='{{$currency->pk_c_code}}' autocomplete="off"
                              {{$currency->pk_c_code == 'KGS' ? 'checked' : ''}}>
                              {{$currency->s_description}}
                            </label>
                          @endforeach
                        </div>
                      </div>
                    </div>
                    
                    <!-- photo -->
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="textarea"> Picture </label>
                      <div class="col-md-8">
                        @for($i=0; $i<5; $i++)
                          <div class="mb10">
                            <input id="input-upload-img1" type="file" class="file" name="pictures[]" data-preview-file-type="text">
                          </div>
                        @endfor
                        <p class="help-block">Add up to 5 photos. Use a real image of your product, not catalogs.</p>
                      </div>
                    </div>
                    <div class="content-subheading"> <i class="icon-user fa"></i> <strong>Seller information</strong> </div>

                    <!-- Appended checkbox -->
                    @if(!Auth::check())
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="seller-email"> Seller Email</label>
                      <div class="col-md-8">
                        <input id="seller-email" name="seller-email" class="form-control" placeholder="Email" required="" type="text">
                      </div>
                    </div>
                    @endif

                    <div ng-show="drawMeta" ng-repeat="meta in drawMeta">
                      <div class="form-group">
                        <label class="col-md-3 control-label" for="seller-email">@{{meta.s_name}}</label>
                        <div class="col-md-8" ng-switch="meta.e_type">
                          <input ng-switch-when="TEXT" name="meta[@{{meta.pk_i_id}}]" class="form-control" type="text">
                          <input ng-switch-when="URL" name="meta[@{{meta.pk_i_id}}]" class="form-control" type="text">
                          <div ng-switch-when="CHECKBOX" class="checkbox">
                            <label>
                              <input name="meta[@{{meta.pk_i_id}}]" type="checkbox" value="1">
                            </label>
                          </div>
                          <select ng-switch-when="DROPDOWN" name="meta[@{{meta.pk_i_id}}]" class="form-control">
                            <option ng-repeat="option in meta.options_list "value="@{{option}}">@{{option}}</option>
                          </select>
                          <div ng-switch-when="RADIO">
                            <label ng-repeat="option in meta.options_list" class="radio-inline">
                              <input class="radio-inline" name="meta[@{{meta.pk_i_id}}]" id="radios-1" value="@{{option}}" type="radio"> @{{option}}
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    
                    
                    <!-- Button  -->
                    <div class="form-group">
                      <label class="col-md-3 control-label"></label>
                      <div class="col-md-8"> 
                        <button type="submit" id="button1id" class="btn btn-primary btn-lg">
                          Submit
                        </button> 
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.page-content -->
        
        <div class="col-md-3 reg-sidebar">
          <div class="reg-sidebar-inner text-center">
            <div class="promo-text-box"> <i class=" icon-picture fa fa-4x icon-color-1"></i>
              <h3><strong>Post a Free Classified</strong></h3>
              <p> Post your free online classified ads with us. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>
            
            <div class="panel sidebar-panel">
              <div class="panel-heading uppercase"><small><strong>How to sell quickly?</strong></small></div>
              <div class="panel-content">
                <div class="panel-body text-left">
                  <ul class="list-check">
                    <li> Use a brief title and  description of the item  </li>
                    <li> Make sure you post in the correct category</li>
                    <li> Add nice photos to your ad</li>
                    <li> Put a reasonable price</li>
                    <li> Check the item before publish</li>

                  </ul>
                </div>
              </div>
            </div>
            
            
          </div>
        </div><!--/.reg-sidebar-->
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container --> 
  </div>
@stop

@section('scripts')
<script type="text/javascript" src="{{asset('assets/js/angular.min.js')}}"></script>
<script>
  var itemApp = angular.module('itemApp', []);

  itemApp.controller('ItemAddController', ['$window','$scope', '$http',function($window, $scope, $http){

      $scope.meta = null;
      $scope.drawMeta = null;
      $scope.categoryList = $window.categories;

      $scope.mainCategories =  _.where($scope.categoryList, {'fk_i_parent_id' : null});

      $scope.categoryChange = function(mainCategory){
        $scope.meta = null;
        $scope.drawMeta = null;

        $scope.subCategories = _.where($scope.categoryList, {'fk_i_parent_id' : mainCategory})

        $scope.subSubCategories = null;
      }

      /**
       * [subCategoryChange description]
       * @param  {[type]} subCategory_id [description]
       * @return {[type]}                [description]
       */
      $scope.subCategoryChange = function(subCategory_id){
        $scope.meta = subCategory_id;
        $scope.drawMeta = null;
        $http.get('http://larabor.local/api/category_meta/' + subCategory_id).success(function(data){
          
          if($scope.meta == subCategory_id){

            $scope.drawMeta = data;
          }
        });
        $scope.subSubCategories = _.where($scope.categoryList, {'fk_i_parent_id' : subCategory_id})
      }

      /**
       * [sub_subCategoryChange description]
       * @param  {[type]} sub_subCategory_id [description]
       * @return {[type]}                    [description]
       */
      $scope.sub_subCategoryChange = function(sub_subCategory_id){
        $scope.meta = sub_subCategory_id;
        $scope.drawMeta = null;

        $http.get('http://larabor.local/api/category_meta/' + sub_subCategory_id).success(function(data){
          
          if($scope.meta == sub_subCategory_id){
            $scope.drawMeta = data;
          }
        });
      }

  }]);

</script>
@stop