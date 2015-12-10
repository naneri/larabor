@if(session('message'))
	@foreach(session('message') as $key => $message)
		<div class="alert alert-{{$key}} alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  {{$message}}
		</div>
	@endforeach
@endif
	