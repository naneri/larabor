@extends('admin._misc._admin-layout')

@section('content')
<div class="row" id="items-app">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Custom responsive table </h5>
                <div class="ibox-tools">
                    <a v-on:click="getItems(page)" class="refresh">
                        <i class="fa fa-refresh"></i>
                    </a>
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-4 m-b-xs">
                        <div class="btn-group">
                          <button v-on:click="getItems(page-1)"  :disabled="page < 2" class="btn btn-white btn-sm "><i class="fa fa-arrow-left"></i></button>
                          <button class="btn btn-white btn-sm">@{{page}}</button>
                          <button v-on:click="getItems(page+1)" :disabled="page == last_page" class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                 
                </div>
                <div  class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title </th>
                            <th>Views</th>
                            <th>Date</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr 
                            v-for="item in items" 
                            class="@{{item.b_enabled == 0 ? 'bg-danger' : ''}}" 
                            track-by="pk_i_id"
                        >
                            <td style="width:100px">
                              <img class="img-responsive" :src="item.js_image">
                            </td> 
                            <td><a :href="item.show_link">@{{item.description.s_title}}</a></td>
                            <td>@{{item.view_stats}}</td>
                            <td>@{{item.dt_pub_date}}</td>
                            <td>@{{item.s_contact_email}}</td>
                            <td>
                              <a v-on:click="activateItem(item)"><i class="fa-2x fa fa-rocket text-navy"></i></a> 
                              <a :href="item.edit_link"><i class="fa-2x fa fa-pencil text-navy"></i></a> 
                              <a v-on:click="blockItem(item)"><i class="fa-2x fa fa-times-circle text-danger"></i></a> 
                              <a v-on:click="deleteItem(item)"><i class="fa-2x fa fa-trash text-danger"></i></a>
                            </td>
                        </tr>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
  <script src="{{asset('components/lodash/dist/lodash.min.js')}}"></script>
  <script src="{{asset('assets/js/vue.min.js')}}"></script>
  <script src="{{asset('components/vue-resource/dist/vue-resource.min.js')}}"></script>
  <script>

    Vue.http.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

    new Vue({
      el: '#items-app',
      data: {
        items: [],
        page: 1,
        last_page: 1
      },
      ready: function(){
        this.getItems(this.page)
      },
      methods : {
        getItems: function(page){
          this.$http.get("{{url('admin/item/user-items')}}", {page : page}).success(function(response){
              this.items = response.data;
              this.page = response.current_page;
              this.last_page = response.last_page;
          })
        },
        deleteItem: function(item){
          this.$http.delete("{{url('admin/item/delete')}}/" + item.pk_i_id).success(function(){
            this.items.$remove(item);
          })
        }
      }
    })


  </script>
@stop