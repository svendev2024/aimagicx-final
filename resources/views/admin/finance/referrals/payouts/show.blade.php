@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('View Request') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa-solid fa-sack-dollar mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.finance.dashboard') }}"> {{ __('Finance Management') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.referral.payouts') }}"> {{ __('Referral Payouts') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('View Request') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<div class="row">
		<div class="col-lg-6 col-md-6 col-xm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Request') }} ID: <span class="text-info">{{ $id->request_id }}</span></h3>
				</div>
				<div class="card-body pt-5">	
					
					<form action="{{ route('admin.referral.payouts.update', $id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')

						<div class="row">
							<div class="col-lg-4 col-md-4 col-12">
								<h6 class="font-weight-bold mb-1">{{ __('Request Date') }}: </h6>
								<span class="fs-14">{{ $id->created_at }}</span>
							</div>
							<div class="col-lg-4 col-md-4 col-12">
								<h6 class="font-weight-bold mb-1">{{ __('User Email') }}: </h6>
								<span class="fs-14">{{ $user->email }}</span>
							</div>
							<div class="col-lg-4 col-md-4 col-12">
								<h6 class="font-weight-bold mb-1">{{ __('Request Amount') }} ({{ config('payment.default_system_currency') }}): </h6>
								<span class="fs-14">{!! config('payment.default_system_currency_symbol') !!}{{ $id->total }}</span>
							</div>
						</div>

						<div class="row pt-5">
							<div class="col-lg-4 col-md-4 col-12">
								<h6 class="font-weight-bold mb-1">{{ __('Preferred Payment Gateway') }}: </h6>
								<span class="fs-14">{{ $id->gateway }}</span>
							</div>
							<div class="col-lg-4 col-md-4 col-12">
								<h6 class="font-weight-bold mb-1">{{ __('PayPal ID') }}: </h6>
								<span class="fs-14">{{ $user->referral_paypal }}</span>
							</div>
							<div class="col-lg-4 col-md-4 col-12">
								<h6 class="font-weight-bold mb-1">{{ __('Bank Requisites') }}: </h6>
								<span class="fs-14">{{ $user->referral_bank_requisites }}</span>
							</div>
						</div>	

						<div class="row pt-7">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<h6 class="font-weight-bold mb-3">{{ __('Payout Status') }} <span class="text-muted">({{ __('Required') }})</span></h6>						
								<div class="input-box">										
									<select id="notification-action" name="status" data-placeholder="{{ __('Select Payment Request Status') }}:">			
										<option value="processing" @if ($id->status == 'processing') selected @endif>{{ __('Processing') }}</option>
										<option value="completed" @if ($id->status == 'completed') selected @endif>{{ __('Completed') }}</option>
										<option value="declined" @if ($id->status == 'declined') selected @endif>{{ __('Declined') }}</option>
										<option value="cancelled" @if ($id->status == 'cancelled') selected @endif>{{ __('Cancelled') }}</option>
									</select>
									@error('status')
										<p class="text-danger">{{ $errors->first('status') }}</p>
									@enderror	
								</div>						
							</div>
						</div>
						
						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-7">
							<a href="{{ route('admin.referral.payouts') }}" class="btn btn-cancel mr-2">{{ __('Return') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('Update') }}</button>	
						</div>

					</form>

				</div>
			</div>
		</div>
	</div>
@endsection


