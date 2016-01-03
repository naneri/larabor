@extends('email._layout-mail')


@section('title')
	Поздравляем с регистрацией. 
@stop


@section('content')

<p>Активируйте свой аккаунт пройдя по ссылке.</p>
<!-- button -->
<table class="btn-primary" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td>
    <a href='{{url("account/activate/{$user->pk_i_id}/{$user->s_secret}")}}'>Активировать</a>
  </td>
</tr>
</table>
<!-- /button -->

@stop      