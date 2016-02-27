@extends('admin._misc._admin-layout')

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
      <tr v-for="item in items">
        <td>@{{item.pk_i_id}}</td>
        <td>@{{item.description.s_title}}</td>
        <td>@{{item.dt_pub_date}}</td>
        <td>@{{count_stats(item.stats) == 0 ? '' : count_stats(item.stats) }}</td>
        <td>@{{ item.s_contact_email }}</td>
        <td></td>
      </tr>
      </tbody>
    </table>
  </div>
@stop

@section('scripts')
  <script src="{{asset('components/lodash/dist/lodash.min.js')}}"></script>
  <script src="{{asset('assets/js/vue.min.js')}}"></script>
  <script>
    new Vue({
      el: '#items-app',
      data: {
        items: JSON.parse({!! json_encode($items->toJson()) !!})
      },
      methods : {
        count_stats : function(stats){
          return _.sumBy(stats, 'i_num_views');
        }
      }
    })
  </script>
@stop



