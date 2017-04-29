@extends('emails._layout-mail')


@section('title')
  К вашему обьявлению оставлен комментарий
@stop


@section('content')

  Перейдите на страницу обьявления чтобы прочитать.
  <table class="btn-primary" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td>
        <a href='{{route('item.show', ['item_id' => $comment->item_id])}}'>Перейти</a>
      </td>
    </tr>
  </table>
  <!-- /button -->

@stop