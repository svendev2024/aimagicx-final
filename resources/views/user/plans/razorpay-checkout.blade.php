@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">Razorpay Checkout</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-box-circle-check mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('user.plans') }}"> {{ __('Pricing Plans') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Razorpay Checkout') }}</a></li>
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
						<h6 class="mt-2"><span class="font-weight-bold">Razorpay</span></h6>
						<p class="fs-12 mt-3">{{ __('Click Pay Now button to complete the payment process via Razorpay Payment') }}.</p>
						<p class="fs-12 mt-3">{{ __('Plan name: ') }} <span class="font-weight-bold">{{ $id->plan_name }}</span>.</p>
						<button type="button" id="razorpay" class="btn btn-primary mb-4 mt-2">{{ __('Pay Now') }}</button>		
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<script>

		var entity = "{{ $order->entity }}";

		if ( entity == 'order') {
			var options = {
				"key": "{{ config('services.razorpay.key_id') }}", // Enter the Key ID generated from the Dashboard
				"amount": "{{ $amount }}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
				"currency": "{{ $currency }}",
				"name": "{{ config('app.name') }}",
				"description": "Subscription Plan",
				"image": "{{ URL::asset('img/brand/favicon.png') }}",
				"order_id": "{{ $order->id }}", 
				"callback_url": "{{ route('user.payments.approved.razorpay') }}",
				"prefill": {
					"name": "{{ $name }}",
					"email": "{{ $email }}",
				},
			};
		} else {
			var options = {
				"key": "{{ config('services.razorpay.key_id') }}", // Enter the Key ID generated from the Dashboard
				"subscription_id": "{{ $order->id }}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
				"name": "{{ config('app.name') }}",
				"description": "Subscription Plan",
				"image": "{{ URL::asset('img/brand/favicon.png') }}",
				"callback_url": "{{ route('user.payments.subscription.razorpay', ['plan_id' => $id->id]) }}",
				"prefill": {
					"name": "{{ $name }}",
					"email": "{{ $email }}",
				},
			};
		}
		
		var rzp = new Razorpay(options);
		document.getElementById('razorpay').onclick = function(e){
			rzp.open();
			e.preventDefault();
		}
	</script>
@endsection



