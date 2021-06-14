<div class="row">
	@foreach($messages as $single_message)
		<div class="col-md-12">
			<p style="margin-top:1px">{{ $single_message->from_user->name }}: {{ $single_message->content }}</p>
		</div>
	@endforeach
</div>