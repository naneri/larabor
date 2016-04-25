<html>
	<meta charset="UTF-8">
	<table>
		<thead>
			<tr>
				<td>Название</td>
				<td>Цена</td>
				<td>Ссылка на описание</td>
			</tr>
		</thead>
		<tbody>
			@foreach($items as $category => $items)
				<tr>
					<td colspan="4">
						<b>{{$category}}</b>
					</td>
				</tr>
				@foreach($items as $item)
					<tr>
						<td>{{$item['name']}}</td>
						<td>{{$item['price']}} {{$item['currency']}}</td>
						<td><a href="{{route('item.show', $item['id'])}}">URL</a></td>
					</tr>
				@endforeach
			@endforeach
		</tbody>
	</table>
</html>