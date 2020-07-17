@if (($message = Session::get('message_warning'))
|| ($message = Session::get('message_success'))
|| ($message = Session::get('message_danger')))

<div class="alert 
	@if(Session::get('message_warning')) alert-warning 
	@elseif(Session::get('message_success')) alert-success 
	@elseif(Session::get('message_danger')) alert-danger 
	@endif alert-dismissible fade show">
	{{ $message }}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

@endif