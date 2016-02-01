Здравствуйте, 

вам отправили сообщение по вашему объявлению: <a href="{{route('item.show', $item->pk_i_id)}}">{{$item->description->s_title}}</a>

Имя: {{Auth::user()->s_name}}
Телефон: {{$phone}}
Сообщение: {{$text}}