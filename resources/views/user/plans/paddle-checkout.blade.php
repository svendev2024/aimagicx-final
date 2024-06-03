@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">Paddle Checkout</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-box-circle-check mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('user.plans') }}"> {{ __('Pricing Plans') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Paddle Checkout') }}</a></li>				
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')	
	<div class="row">
		<div class="col-md-6">
			<div class="card border-0 pt-2">
				<div class="card-body">			
					<div class="text-center">						
						<h6 class="mt-2"><span class="font-weight-bold">Paddle</span></h6>
						<p class="fs-12 mt-3">{{ __('You will be redirected to process your payment via Paddle Payment') }}.</p>
						<p class="fs-12 mt-3">{{ __('Plan name: ') }} <span class="font-weight-bold">{{ $plan_name }}</span></p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script src="https://cdn.paddle.com/paddle/paddle.js"></script>
	<script>
		Paddle.Setup(
			{
				vendor: {{ config('services.paddle.vendor_id') }},
				eventCallback: function(data) {
					if (data.event === "Checkout.Close") {
						window.location.href = '/user/payments/cancelled';
						return false;
					}
				}
			}
		);

		@if (config('services.paddle.sandbox') == true)
			Paddle.Environment.set('sandbox');
		@endif
		

		Paddle.Checkout.open({
			override: "{{ $redirect }}"
		});
	</script>
@endsection



