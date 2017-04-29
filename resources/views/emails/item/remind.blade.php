@extends('emails._layout-mail')


@section('title')
  Ваше объявление скоро устареет. Вы можете продлить его чтобы оно оставалось актуальным.
@stop


@section('content')
  Вы можете посмотреть объявление пройдя по ссылке. На странице вам доступны функции по продлению, редактированию и удалению объявления.
  <table class="btn-primary" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td>
        <a href="{{route('item.show', [$item->pk_i_id, $item->s_secret])}}">Перейти</a>
      </td>
    </tr>
  </table>
  <!-- /button -->
@stop
