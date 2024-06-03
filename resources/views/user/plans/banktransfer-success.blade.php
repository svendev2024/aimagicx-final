@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('Bank Transfer Checkout') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-box-circle-check mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('user.plans') }}"> {{ __('Pricing Plans') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Bank Transfer Checkout') }}</a></li>
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
						<i class="mdi mdi-approval fs-45 text-info mb-4"></i>
						<h4 class="checkout-success">{{ __('Almost There') }}!</h4>
						<div class="text-center mb-6">
							<p class="mt-5 fs-14">{{ __('You have successfully placed order for ') }} <span class="text-info font-weight-bold">{{ $id->plan_name }}</span> {{ __('plan') }}.</p>
							<p class="fs-14">{{ __('After successful payment, your plan will be activated. To keep your plan active in coming month, please provide payments by the end of each month (prepaid plans are charged once)') }}.</p>
							<p class="fs-14">{{ __('Please provide payment to our bank requisites below. Use Order ID number as payment reference') }}.</p>	
							<p class="text-muted fs-12 mb-4">{{ __('Order ID') }}: <span class="font-weight-bold text-primary">{{ $orderID }}</span></p>
							<p class="text-muted fs-12 mb-4">{{ __('Total Payment Due') }}: <span class="font-weight-bold text-primary">{{ number_format((float)$total_value, 2, '.', '') }} {{ $currency }}</span></p>
							<pre class="text-muted fs-12 mb-4">{{ $bank['bank_requisites'] }}</pre>
						</div>						
						<div class="text-center pt-2 pb-4">
							<a href="{{ route('user.payments.invoice.transfer', $orderID) }}" id="invoice-button" class="btn btn-primary pl-6 pr-6 mr-2">{{ __('Get Bank Requisites') }}</a>
							<a href="{{ route('user.dashboard') }}" id="payment-button" class="btn btn-primary pl-6 pr-6">{{ __('My Dashboard') }}</a>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection



