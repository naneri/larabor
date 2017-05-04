@extends('admin._misc._admin-layout')

@section('content')
  <div class="row" >
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Custom responsive table </h5>
          <div class="ibox-tools">
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
          <div  class="table-responsive">
            <table class="table">
              <thead>
              <tr>
                <th>Date</th>
                <th>Owner</th>
                <th>Item</th>
                <th>Text</th>
              </tr>
              </thead>
              <tbody>
              @foreach($comments as $comment)
                 <tr>
                   <td>{{$comment->created_at}}</td>
                   <td>
                     <a href="{{route('user.ads', ['id' => $comment->user_id])}}">
                       {{$comment->user->s_name}}
                     </a>
                   </td>
                   <td>
                     <a href="{{route('item.show', ['id' => $comment->item_id])}}">
                       {{$comment->item->pk_i_id}}
                     </a>
                   </td>
                   <td>{{str_limit($comment->text, 200)}}</td>
                 </tr>
               @endforeach
              </tbody>
            </table>
            <div class="text-center">
              {{$comments->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection