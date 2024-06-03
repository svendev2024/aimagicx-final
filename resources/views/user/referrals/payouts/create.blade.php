@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('New Payout Request') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"><i class="fa-solid fa-badge-dollar mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('user.referral') }}"> {{ __('Affiliate Program') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('user.referral.payout') }}"> {{ __('My Payouts') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('New Payout Request') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection
@section('content')	
	<div class="row">
		<div class="col-lg-4 col-md-12 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Create New Payout Request') }}</h3>
				</div>
				<div class="card-body">
					
					<form action="{{ route('user.referral.payout.store') }}" method="POST" enctype="multipart/form-data">
						@csrf				

						<h6 class="fs-12 mb-5 mt-3">{{ __('Minimum amount for all payout request is') }} <span class="font-weight-bold">{{ config('payment.referral.payment.threshold') }} {{ config('payment.default_currency') }}</span></h6>
						
						<h6 class="fs-12 mb-6 mt-3">{{ __('Your current balance is') }}: <span class="font-weight-bold">{{ auth()->user()->balance }} {{ config('payment.default_currency') }}</span></h6>
						
						<h6 class="fs-12 mb-6 mt-3">{{ __('Your preferred payout method is') }}: <span class="font-weight-bold">@if (auth()->user()->referral_payment_method == '') {{ __('Not Set') }} <span class="text-muted">({{ __('Please configure it under My Gateway tab') }})</span> @else {{ auth()->user()->referral_payment_method }}@endif</span></h6>

						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">								
								<div class="input-box">								
									<h6>{{ __('Total request amount') }}</h6>
									<div class="form-group">							    
										<input type="number" class="form-control @error('payout') is-danger @enderror" id="payout" name="payout" value="{{ old('payout') }}">
									</div> 
									@error('payout')
										<p class="text-danger">{{ $errors->first('payout') }}</p>
									@enderror
								</div> 
							</div>
						</div>
	

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<a href="{{ route('user.referral.payout') }}" class="btn btn-cancel mr-2">{{ __('Cancel') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('Create') }}</button>							
						</div>				

					</form>

				</div>
			</div>

		</div>
	</div>
@endsection
