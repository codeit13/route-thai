<div class="row">
	@foreach($messages as $single_message)
		<div class="col-md-12">
			@if($single_message->from_user == $current_user)
				<p style="margin-top:1px">You : {{ $single_message->content }}</p>
			@else
				<p style="margin-top:1px">{{ $single_message->toUser->name }}: {{ $single_message->content }}</p>
			@endif
		</div>
	@endforeach
</div>