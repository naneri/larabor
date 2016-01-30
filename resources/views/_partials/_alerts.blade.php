<script type="text/javascript">
	@if(session('message'))
		@foreach(session('message') as $key => $message)
			toastr.{{$key}}('{{$message}}');
		@endforeach
	@endif
</script>

