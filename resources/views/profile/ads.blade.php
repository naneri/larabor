@extends('_misc._layout')

@section('title')
  Мои объявления
@stop 

@section('content')
<div class="main-container">
    <div class="container">
      <div class="row">
        @include('profile._sidebar', ['page' => 'ads'])
        <!--/.page-sidebar-->
        
        <div id="items-app" class="col-sm-9 page-content">
          <div class="inner-box">
            <h2 class="title-2"><i class="icon-docs"></i> Мои объявления </h2>
            <div class="table">

              <table id="addManageTable" class="table table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true" >
                <thead>
                  <tr>
                    <th> Фотография </th>
                    <th data-sort-ignore="true"> Детали объявления </th>
                    <th class="hidden-xs" data-type="numeric" > Цена </th>
                    <th class="hidden-xs"> Управление </th>
                  </tr>
                </thead>
                <tbody>
                    <tr :class="{'bg-warning' : !isActual(item) , 'bg-danger' : !item.b_enabled}" v-for="item in items" track-by="pk_i_id">
                      <td style="width:14%" class="add-img-td">
                        <a :href="item.show_link">
                          <img class="thumbnail  img-responsive" :src="item.js_image" alt="img">
                        </a>
                      </td>
                      <td style="width:50%" class="ads-details-td">
                        <div>
                          <p>
                            <strong>
                              <a :href="item.show_link" title="Brend New Nexus 4">@{{item.description.s_title}}</a>
                            </strong>
                          </p>
                          <p class="hidden-xs">
                            <i class="fa fa-calendar"> </i>
                            @{{item.show_date}}  <i class="icon-eye"></i> @{{item.view_stats}}
                          </p>
                          <p style="color:#A93B3B">
                            <i  class="fa fa-calendar-times-o"> </i>
                            @{{item.show_expiration}}
                          </p>
                          <p class="visible-xs">
                            <strong>Цена:</strong>
                            <span v-show="item.i_price">
                              @{{item.i_price}} @{{item.currency.s_description}}
                            </span>
                            <span v-show="!item.i_price">не указана</span>
                          </p>
                        </div>
                      </td>
                      <td class="hidden-xs" style="width:24%" class="price-td">
                        <div>
                          <strong>
                            <span v-show="item.i_price || item.edit_price">
                              <span v-show="!item.edit_price"> 
                                @{{item.i_price}} @{{item.currency.s_description}}  
                                <a v-on:click="startEditPrice(item)"><i class="fa fa-pencil"></i></a>
                              </span>
                              <span v-show="item.edit_price" >
                                <div class="input-group">
                                  <input class="form-control profile-price-edit" v-on:keyup.enter="savePrice(item)" v-model="item.i_price">
                                  <div class="input-group-addon">
                                    <span>
                                      <a v-on:click="savePrice(item)">
                                        <i class="fa fa-check"></i>
                                      </a>
                                    </span>
                                  </div>
                                </div>
                                
                              </span>
                            </span>
                            <span v-show="!item.i_price && !item.edit_price">не указана</span>
                          </strong>
                        </div>
                      </td>
                      <td style="width:10%" class="hidden-xs action-td"><div>
                          <p><a :href="item.edit_link" class="btn btn-primary btn-xs"> <i class="fa fa-edit"></i> Редактировать </a></p>
                          <p> 
                            <a v-if="!item.recently_prolonged" v-on:click="prolongItem(item, $index)" class="btn btn-primary btn-xs"> 
                              <i class="fa fa-clock-o"></i> Продлить 
                            </a>
                            <a disabled v-if="item.recently_prolonged" class="btn btn-default btn-xs"> 
                              <i class="fa fa-clock-o"></i> Продлить 
                            </a>
                          </p>
                          <p>
                            <a v-on:click="deleteItem(item)" class="btn btn-danger btn-xs">
                                <i class=" fa fa-trash"></i> Удалить
                            </a>
                          </p>
                        </div>
                      </td>
                    </tr>
                </tbody>
              </table>
              <div class="pagination-bar text-center">
                <ul class="pagination">
                  <li v-if="page > 2">
                    <a v-on:click="getItems(1)" :disabled="true" aria-label="Previous">
                      <span aria-hidden="true" >&laquo;</span>
                    </a>
                  </li>
                  <li v-if="page > 1">
                    <a v-on:click="getItems(page-1)" :disabled="true"><</a>
                  </li>
                  <li>
                    <a>@{{page}}</a>
                  </li>
                  <li v-if="page < last_page">
                    <a v-on:click="getItems(page+1)">></a>
                  </li>
                  <li v-if="page < last_page - 1">
                    <a v-on:click="getItems(last_page)" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </div> 
            </div>
          </div>
        </div>
        <!--/.page-content--> 
      </div>
      <!--/.row--> 
    </div>
    <!--/.container--> 
  </div>
@stop

@section('scripts')
  <script>
    Vue.http.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';


    new Vue({
      el: '#items-app',
      data: {
        items : [],
        page: 1, 
        last_page : 1
      },
      ready: function(){
        this.getItems(this.page);
      },
      methods: {
        isActual: function(item){
          return new Date(item.dt_expiration) > new Date();
        },
        startEditPrice: function(item){
          Vue.set(item, 'edit_price', true);
        },
        savePrice: function(item){
          this.$http.put("{{url('api/item/updatePrice')}}/"+ item.pk_i_id, item).success(function(response){
              Vue.set(item, 'edit_price', false);
              item = response;
          }).error(function(res){
              toastr.error('Проблемы при сохранении цены');
          })
        },
        getItems: function(page){
          this.page = page;
          this.$http.get("{{url('api/user/items')}}", {page : page}).success(function(response){
                this.items = response.data;
                this.last_page = response.last_page;
            });
        },
        prolongItem: function(item, $index){
          this.$http.put("{{url('api/item/prolong')}}/" + item.pk_i_id, item).success(function(response){
              this.items.$set($index, response);
              toastr.success('Объявление продлено успешно');
          }).error(function(response){
              toastr.error('Проблемы при продлении');
          })
        },
        deleteItem: function(item){
          this.$http.delete("{{url('api/item/delete')}}/" + item.pk_i_id).success(function(){
            this.getItems(this.page);
          })
        }
      }
    });
  </script>
@stop