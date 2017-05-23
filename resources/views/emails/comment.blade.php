@extends('emails._layout-mail')


@section('title')
  К вашему обьявлению <i>"{{str_limit($item->description->s_title, 30)}}"</i> оставлен комментарий
@stop


@section('content')
  <b>Текст комментария:</b>
  <p>
    <i>"{{$comment->text}}"</i>
  </p>

  <b>Перейдите на страницу обьявления чтобы ответить.</b>
  <table class="btn-primary" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td>
        @if($item->fk_i_user_id)
          <a href='{{route('item.show', ['item_id' => $comment->item_id])}}'>Перейти</a>
        @else
          <a href='{{route('item.show', ['item_id' => $comment->item_id, 'code' => $item->s_secret])}}'>Перейти</a>
        @endif
      </td>
    </tr>
  </table>
  <!-- /button -->

@stop