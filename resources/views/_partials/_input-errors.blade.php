@foreach ($errors->get($error_name) as $error)
  <p class="checkbox help-block">
    <small>{{$error}}</small>
  </p>
@endforeach