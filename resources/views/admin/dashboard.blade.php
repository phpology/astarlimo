@extends('layouts.adminlayout')

@section('content')

<div class="nk-content p-0">
	<div class="container-fluid">
		<div class="nk-content-inner">
			<div class="nk-content-body">
				<div class="nk-block-head nk-block-head-sm pt-3">
					<div class="nk-block-between">
						<div class="nk-block-head-content">
							<h3 class="nk-block-title page-title">Dashboard</h3>
						</div>
					</div>
				</div>
				<div class="nk-block">
					@include('layouts.error')

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<p>Welcome back, <strong>{{ $user->firstname }} {{ $user->lastname }}</strong>.</p>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection
