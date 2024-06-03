@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('My Payment Gateway') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"><i class="fa-solid fa-badge-dollar mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('user.referral') }}"> {{ __('Affiliate Program') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('My Payment Gateway') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')	
	<div class="row">
		<div class="col-lg-4 col-md-12 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-body p-6">
					<h3 class="card-title fs-20 text-center">{{ __('My Payment Gateway') }}</h3>
					<p class="fs-12 text-center">{{ __('Select your preferred payment method to receive commissions') }}.</p>

					<form action="{{ route('user.referral.gateway.store') }}" method="POST" enctype="multipart/form-data">
						@csrf				

							<div class="row mb-6 mt-4">
								<div class="col-md-12 col-sm-12">
									<div id="storage-type-radio" role="radiogroup">
										<div class="radio-control">
											<input type="radio" name="payment_method" class="input-control" id="PayPal" value="PayPal" @if ($user->referral_payment_method == 'PayPal') checked @endif style="vertical-align: middle;">
											<label for="PayPal" class="label-control fs-12">PayPal</label>
										</div>	
										<span  id="option-bank">
											<div class="radio-control">
												<input type="radio" name="payment_method" class="input-control" id="BankTransfer" value="BankTransfer" @if ($user->referral_payment_method == 'BankTransfer') checked @endif style="vertical-align: middle;">
												<label for="BankTransfer" class="label-control fs-12">{{ __('Bank Transfer') }}</label>
											</div>
										</span>									
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">								
									<div class="input-box">								
										<h6>{{ __('Enter your PayPal ID') }}</h6>
										<div class="form-group">							    
											<input type="text" class="form-control @error('paypal') is-danger @enderror" id="paypal" name="paypal" value="{{ $user->referral_paypal }}">
										</div> 
										@error('paypal')
											<p class="text-danger">{{ $errors->first('paypal') }}</p>
										@enderror
									</div> 
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="input-box">								
										<h6>{{ __('Enter your Bank Account Requisites') }}</h6> 
										<textarea class="form-control" name="bank_requisites" id="bank_requisites" rows="7" placeholder="Bank Name: 
Account Name/Full Name:
Account Number/IBAN:
BIC/Swift:
Routing Number:">{{ $user->referral_bank_requisites }}</textarea>
										@error('bank_requisites')
											<p class="text-danger">{{ $errors->first('bank_requisites') }}</p>
										@enderror
									</div> 
								</div>	

								<!-- SAVE CHANGES ACTION BUTTON -->
								<div class="row w-100">
									<div class="col-md-12">
										<div class="border-0 text-right mt-1">
											<a href="{{ route('user.referral') }}" class="btn btn-cancel mr-2">{{ __('Return') }}</a>
											<button type="submit" class="btn btn-primary">{{ __('Save') }}</button>							
										</div>
									</div>
								</div>
							</div>

					</form>

				</div>
			</div>
		</div>

	</div>
@endsection

