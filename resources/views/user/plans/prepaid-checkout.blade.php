@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('Secure Checkout') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-box-circle-check mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('user.plans') }}"> {{ __('Pricing Plans') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('One Time Payment Checkout') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')	
	<div class="row">
		<div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">
			<div class="card border-0 pt-2">
				<div class="card-body">	
					
					<form id="payment-form" action="{{ route('user.payments.pay.prepaid', ['type' => $type, 'id' => $id]) }}" promocode="{{ route('user.payments.promocodes.prepaid', $id) }}" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="row">
							<div class="col-md-6 col-sm-12 pr-4">
								<div class="checkout-wrapper-box pb-0">									

										<p class="checkout-title mt-2"><i class="fa-solid fa-lock-hashtag text-success mr-2"></i>{{ __('Secure Checkout') }}</p>

										<div class="divider mb-5">
											<div class="divider-text text-muted">
												<small>{{ __('Select Payment Option') }}</small>
											</div>
										</div>

										<div class="form-group" id="toggler">					
													
											<div class="text-center">
												<div class="btn-group btn-group-toggle w-100" data-toggle='buttons'>
													<div class="row w-100">
														@foreach ($payment_platforms as $payment_platform)													
															<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">															
																<label class="gateway btn rounded p-0" href="#{{ $payment_platform->name }}Collapse" data-bs-toggle="collapse">
																	<input type="radio" class="gateway-radio" name="payment_platform" value="{{ $payment_platform->id }}" required>
																	<img src="{{ URL::asset($payment_platform->image) }}" 
																		 class="@if ($payment_platform->name == 'Paystack' || $payment_platform->name == 'Razorpay' || $payment_platform->name == 'PayPal') payment-image
																		 @elseif ($payment_platform->name == 'Braintree') payment-image-braintree
																		 @elseif ($payment_platform->name == 'Mollie') payment-image-mollie
																		 @elseif ($payment_platform->name == 'Coinbase') payment-image-coinbase
																		 @elseif ($payment_platform->name == 'Stripe') payment-image-stripe
																		 @endif" alt="{{ $payment_platform->name }}">
																</label>
															</div>										
														@endforeach		
													</div>							
												</div>
											</div>
											
											@foreach ($payment_platforms as $payment_platform)
												@if ($payment_platform->name !== 'BankTransfer')
													<div id="{{ $payment_platform->name }}Collapse" class="collapse" data-bs-parent="#toggler">
														@includeIf('components.'.strtolower($payment_platform->name).'-collapse')
													</div>
												@else
													<div id="{{ $payment_platform->name }}Collapse" class="collapse" data-bs-parent="#toggler">
														<div class="text-center pb-2">
															<p class="text-muted fs-12 mb-4">{{ $bank['bank_instructions'] }}</p>
															<p class="text-muted fs-12 mb-4">Order ID: <span class="font-weight-bold text-primary">{{ $bank_order_id }}</span></p>
															<pre class="text-muted fs-12 mb-4">{{ $bank['bank_requisites'] }}</pre>															
														</div>
													</div>																										
												@endif
											@endforeach
										</div>

										<input type="hidden" name="value" id="hidden_value" value="{{ $total_value }}">
										<input type="hidden" name="currency" value="{{ $currency }}">

								</div>
							</div>

							<div class="col-md-6 col-sm-12 pl-4">
								<div class="checkout-wrapper-box">

									<p class="checkout-title mt-2"><i class="fa fa-archive mr-2"></i>{{ __('Plan Name') }}: <span class="text-info">{{ $id->plan_name }} ({{ ucfirst($id->payment_frequency) . ' Plan'}})</span></p>

									<div class="divider mb-4">
										<div class="divider-text text-muted">
											<small>{{ __('Purchase Summary') }}</small>
										</div>
									</div>

									<div>
										<p class="fs-12 p-family">{{ __('Subtotal') }} <span class="checkout-cost">{!! config('payment.default_system_currency_symbol') !!} @if (config('payment.decimal_points') == 'allow') {{ number_format((float)$id->price, 2, '.', '') }} @else {{ number_format($id->price) }} @endif</span></p>
										<p class="fs-12 p-family">{{ __('Taxes') }} <span class="text-muted">({{ config('payment.payment_tax') }}%)</span><span class="checkout-cost">{!! config('payment.default_system_currency_symbol') !!} @if (config('payment.decimal_points') == 'allow') {{ number_format((float)$tax_value, 2, '.', '') }} @else {{ number_format($tax_value) }} @endif</span></p>
									</div>

									<div class="divider mb-5">
										<div class="divider-text text-muted">
											<small>{{ __('Total') }}</small>
										</div>
									</div>

									<input type="hidden" name="type" value="{{ $type }}">

									<div class="input-box mb-5">
										<div class="input-group">								
											<input type="text" class="form-control border-right-0 promocode-field" name="promo_code" placeholder="{{ __('Promocode') }}">
											<label class="input-group-btn">
												<a class="btn btn-primary" id="prepaid-promocode-apply">{{ __('Apply') }}</a>
											</label>											
										</div>
										<span id="promocode-error" class="d-none fs-12 text-danger"></span>
									</div>

									<div id="voucher-result" class="d-none">
										<p class="fs-12 p-family">{{ __('Discount Applied') }} </span><span class="checkout-cost"><span id="total_discount"></span></span></p>
									</div>
									
									<div>
										<p class="fs-12 p-family">{{ __('Total Payment') }} </span><span class="checkout-cost text-info">{!! config('payment.default_system_currency_symbol') !!}<span id="total_payment"> @if (config('payment.decimal_points') == 'allow') {{ number_format((float)$total_value, 2, '.', '') }} @else {{ number_format($total_value) }} @endif</span> {{ $currency }}</span></p>
									</div>

									<div class="text-center pt-4 pb-1">
										<button type="submit" id="payment-button" class="btn btn-primary pl-6 pr-6 mb-1">{{ __('Checkout Now') }}</button>
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





