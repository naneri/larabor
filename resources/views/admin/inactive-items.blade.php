@extends('admin._misc._admin-layout')

@section('meta')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
  <div id="items-app"  class="container">
    <table class="table table-responsive">
      <thead>
      <tr>
        <th><a href="?&order_param=pk_i_id">ID</a></th>
        <th>Title</th>
        <th><a href="?&order_param=dt_pub_date">Pub. Date</a></th>
        <th>Views</th>
        <th>Contact</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="item in items" track-by="pk_i_id">
        <td>@{{item.pk_i_id}}</td>
        <td>@{{item.description.s_title}}</td>
        <td>@{{item.dt_pub_date}}</td>
        <td>@{{count_stats(item.stats) == 0 ? '' : count_stats(item.stats) }}</td>
        <td>@{{ item.s_contact_email }}</td>
        <td class="custom-tools">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-wrench"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a >Activate</a></li>
						<li><a>Block item</a></li>
						<li><a @click="delete_item(item)">Delete item</a></li>

					</ul>
				</td>
      </tr>
      </tbody>
    </table>
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
        items: JSON.parse({!! json_encode($items->toJson()) !!})
      },
      methods : {
        count_stats : function(stats){
          return _.sumBy(stats, 'i_num_views');
        },
        delete_item: function(item){
          this.$http.delete("{{url('admin/item/delete')}}/" + item.pk_i_id).success(function(){
            this.items.$remove(item);
          })
        }
      }
    })


  </script>
@stop



