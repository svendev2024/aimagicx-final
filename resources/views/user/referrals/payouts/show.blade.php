@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('View Payout Request') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"><i class="fa-solid fa-badge-dollar mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('user.referral') }}"> {{ __('Affiliate Program') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('user.referral.payout') }}"> {{ __('Referral Payouts') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('View Payout Request') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<!-- SUPPORT REQUEST -->
	<div class="row">
		<div class="col-lg-5 col-md-5 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Payout Request') }} ID: <span class="text-info">{{ $id->request_id }}</h3>
				</div>
				<div class="card-body pt-5">									
							
						<div class="row">							
							<div class="col-lg-4 col-md-4 col-12">
								<h6 class="font-weight-bold mb-1">{{ __('Created Date') }}: </h6>
								<span class="fs-14">{{ $id->created_at }}</span>
							</div>
							<div class="col-lg-4 col-md-4 col-12">
								<h6 class="font-weight-bold mb-1">{{ __('Status') }}: </h6>
								<span class="fs-14">{{ ucfirst($id->status) }}</span>
							</div>							
							<div class="col-lg-4 col-md-4 col-12">
								<h6 class="font-weight-bold mb-1">{{ __('Last Updated') }}: </h6>
								<span class="fs-14">{{ $id->updated_at }}</span>
							</div>							
						</div>
						
						<div class="row mt-4">
							<div class="col-lg-4 col-md-4 col-12">
								<h6 class="font-weight-bold mb-1">{{ __('Payment Gateway') }}: </h6>
								<span class="fs-14">{{ $id->gateway }}</span>
							</div>
							<div class="col-lg-4 col-md-4 col-12">
								<h6 class="font-weight-bold mb-1">{{ __('Total Amount') }}: </h6>
								<span class="fs-14">{!! config('payment.default_system_currency_symbol') !!}{{ $id->total }} {{ config('payment.default_system_currency') }}</span>
							</div>							
						</div>		
						
						<div class="border-0 text-right mb-2 mt-8">
							<a href="{{ route('user.referral.payout') }}" class="btn btn-primary">{{ __('Return') }}</a>
						</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END SUPPORT REQUEST -->
@endsection

