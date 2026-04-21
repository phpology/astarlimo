@if(session('flash_message_error'))
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{!! session('flash_message_error') !!}</strong>
	</div>
@endif

@if($errors->any())
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<ul class="mb-0">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

@if(session('flash_message_success'))
	<div class="alert alert-fill alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{!! session('flash_message_success') !!}</strong>
	</div>
@endif
