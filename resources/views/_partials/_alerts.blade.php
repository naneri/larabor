<script type="text/javascript">
	@if(session('message'))
		@foreach(session('message') as $key => $message)
			$.notify('{{$message}}', '{{$key}}');
		@endforeach
	@endif
</script>

