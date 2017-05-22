<div v-for="comment in comments">
  <div class="panel panel-default">
    <div class="panel-heading" v-bind:id="'comment-' + comment.id">
      <small class="text-muted">@{{ comment.created_at }}</small>
    </div>
    <div class="panel-body">
      @{{comment.text}} <br>
      <span v-if="comment.user.s_name">
        <a href="{{url('user/ads')}}/@{{ comment.user.pk_i_id }}">
          <small>@{{ comment.user.s_name}}</small>
        </a>
      </span>
      <span v-else>
        <small>Анонимный пользователь</small>
      </span>
    </div>
  </div>
</div>
<div class="text-center">
  <v-paginator
          :resource.sync="comments"
          v-ref:vpaginator resource_url="{{route('api.item.comments', $item->pk_i_id)}}">
  </v-paginator>
</div>
<br>
@if(Auth::user() || $is_owner)
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="form-group">
        <label for="text">Текст</label>
        <textarea v-model="newComment.text" name="text" class="form-control" id="text" cols="30" rows="5"></textarea>
      </div>
      <button v-on:click.prevent="addComment(newComment)" class="btn btn-primary">
        Отправить
      </button>
    </div>
  </div>
@else
  <div class="panel panel-default  panel-contact-seller">
    <div class="panel-heading">
      <p class="text-center">Написать владельцу:</p>
    </div>
    <div class="panel-body">
      <div class="seller-info">
        <h3 class="no-margin"><a href="{{route('login')}}">Авторизуйтесь</a> чтобы написать пользователю</h3>
      </div>
    </div>
  </div>
@endif