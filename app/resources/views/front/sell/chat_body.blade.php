<div class="row">
	@foreach($messages as $single_message)
		<div class="col-md-12">
			<p style="margin-top:1px">{{ $single_message->fromUser->name }}: {{ $single_message->content }}</p>
		</div>
	@endforeach
</div>