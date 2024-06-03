@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('Subscription Plans') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-box-circle-check mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('user.plans') }}"> {{ __('Pricing Plans') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')	
	<div class="card border-0 pt-2">
		<div class="card-body">			
			
			@if ($monthly || $yearly || $prepaid || $lifetime)

				<div class="tab-menu-heading text-center">
					<div class="tabs-menu dark-theme-target" >								
						<ul class="nav">
							@if ($prepaid)						
								<li><a href="#prepaid" class="@if (!$monthly && !$yearly && $prepaid && !$lifetime) active @else '' @endif" data-bs-toggle="tab"> {{ __('Prepaid Plans') }}</a></li>
							@endif							
							@if ($monthly)
								<li><a href="#monthly_plans" class="@if (($monthly && $prepaid && $yearly) || ($monthly && !$prepaid && !$yearly) || ($monthly && $prepaid && !$yearly) || ($monthly && !$prepaid && $yearly)) active @else '' @endif" data-bs-toggle="tab"> {{ __('Monthly Plans') }}</a></li>
							@endif	
							@if ($yearly)
								<li><a href="#yearly_plans" class="@if ((!$monthly && !$prepaid && $yearly && !$lifetime) || (!$monthly && $prepaid && $yearly && !$lifetime) || (!$monthly && $prepaid && $yearly && $lifetime))  active @else '' @endif" data-bs-toggle="tab"> {{ __('Yearly Plans') }}</a></li>
							@endif
							@if ($lifetime)
								<li><a href="#lifetime" class="@if ((!$monthly && !$yearly && !$prepaid &&  $lifetime) || (!$monthly && !$yearly && $prepaid &&  $lifetime)) active @else '' @endif" data-bs-toggle="tab"> {{ __('Lifetime Plans') }}</a></li>
							@endif								
						</ul>
					</div>
				</div>

			

				<div class="tabs-menu-body">
					<div class="tab-content">

						@if ($prepaid)
							<div class="tab-pane @if ((!$monthly && $prepaid) && (!$yearly && $prepaid)) active @else '' @endif" id="prepaid">

								@if ($prepaids->count())

									<h6 class="font-weight-normal fs-12 text-center mb-6">{{ __('Top up your subscription with more credits or start with Prepaid Plans credits only') }}</h6>
									
									<div class="row justify-content-md-center">
									
										@foreach ( $prepaids as $prepaid )																			
											<div class="col-lg-3 col-md-6 col-sm-12 flexroom">
												<div class="price-card pl-3 pr-3 pt-2 mb-7">
													<div class="card border-0 p-4 pl-5">
														<div class="plan prepaid-plan">
															<div class="plan-title">{{ __($prepaid->plan_name) }} <span class="prepaid-currency-sign">{{ $prepaid->currency }}</span><span class="plan-cost">@if (config('payment.decimal_points') == 'allow') {{ number_format((float)$prepaid->price, 2) }} @else {{ number_format($prepaid->price) }} @endif</span><span class="prepaid-currency-sign">{!! config('payment.default_system_currency_symbol') !!}</span></div>
																<p class="fs-12 mt-2 mb-0">{{ __('Words Included') }}: <span class="ml-2 font-weight-bold text-primary">{{ number_format($prepaid->words) }}</span></p>
																<p class="fs-12 mt-2 mb-0">{{ __('Images Included') }}: <span class="ml-2 font-weight-bold text-primary">{{ number_format($prepaid->images) }}</span></p>																								
																<p class="fs-12 mt-2 mb-0">{{ __('Characters Included') }}: <span class="ml-2 font-weight-bold text-primary">{{ number_format($prepaid->characters) }}</span></p>																								
																<p class="fs-12 mt-2 mb-4">{{ __('Minutes Included') }}: <span class="ml-2 font-weight-bold text-primary">{{ number_format($prepaid->minutes) }}</span></p>																								
															<div class="text-center action-button mt-2 mb-2">
																<a href="{{ route('user.prepaid.checkout', ['type' => 'prepaid', 'id' => $prepaid->id]) }}" class="btn btn-cancel">{{ __('Purchase') }}</a> 
															</div>
														</div>							
													</div>	
												</div>							
											</div>										
										@endforeach						

									</div>

								@else
									<div class="row text-center">
										<div class="col-sm-12 mt-6 mb-6">
											<h6 class="fs-12 font-weight-bold text-center">{{ __('No Prepaid plans were set yet') }}</h6>
										</div>
									</div>
								@endif

							</div>			
						@endif	

						@if ($monthly)	
							<div class="tab-pane @if (($monthly && $prepaid) || ($monthly && !$prepaid) || ($monthly && !$yearly)) active @else '' @endif" id="monthly_plans">

								@if ($monthly_subscriptions->count())		
									
									<h6 class="font-weight-normal fs-12 text-center mb-6">{{ __('Subscribe to our Monthly Subscription Plans and enjoy ton of benefits') }}</h6>

									<div class="row justify-content-md-center">

										@foreach ( $monthly_subscriptions as $subscription )																			
											<div class="col-lg-3 col-md-6 col-sm-12 flexroom">
												<div class="pl-6 pr-6 pt-2 mb-7 prices-responsive">
													<div class="card border-0 p-4 pl-5 pr-5 pt-7 price-card @if ($subscription->featured) price-card-border @endif">
														@if ($subscription->featured)
															<span class="plan-featured">{{ __('Most Popular') }}</span>
														@endif
														<div class="plan">			
															<div class="plan-title text-center">{{ __($subscription->plan_name) }}</div>		
															<p class="fs-12 text-center mb-3">{{ __($subscription->primary_heading) }}</p>																					
															<p class="plan-cost text-center mb-0"><span class="plan-currency-sign"></span>{!! config('payment.default_system_currency_symbol') !!} @if (config('payment.decimal_points') == 'allow') {{ number_format((float)$subscription->price, 2) }} @else {{ number_format($subscription->price) }} @endif</p>
															<p class="fs-12 text-center mb-3">{{ $subscription->currency }} / {{ __('Month') }}</p>
															<div class="text-center action-button mt-2 mb-5">
																@if (auth()->user()->plan_id == $subscription->id)
																	<button type="button" class="btn btn-cancel">{{ __('Subscribed') }}</button> 
																@else
																	<a href="{{ route('user.plan.subscribe', $subscription->id) }}" class="btn btn-primary">{{ __('Subscribe Now') }}</a>
																@endif															
															</div>
															<p class="fs-12 text-center mb-3">{{ __($subscription->secondary_heading )}}</p>																	
															<ul class="fs-12 pl-3">														
																@foreach ( (explode(',', $subscription->plan_features)) as $feature )
																	@if ($feature)
																		<li><i class="fa-solid fa-circle-small fs-10 text-muted"></i> {{ __($feature) }}</li>
																	@endif																
																@endforeach															
															</ul>																
														</div>					
													</div>	
												</div>							
											</div>										
										@endforeach

									</div>	
								
								@else
									<div class="row text-center">
										<div class="col-sm-12 mt-6 mb-6">
											<h6 class="fs-12 font-weight-bold text-center">{{ __('No Subscriptions plans were set yet') }}</h6>
										</div>
									</div>
								@endif					
							</div>	
						@endif	
						
						@if ($yearly)	
							<div class="tab-pane @if (($yearly && $prepaid) && ($yearly && !$prepaid) && ($yearly && !$monthly)) active @else '' @endif" id="yearly_plans">

								@if ($yearly_subscriptions->count())		
									
									<h6 class="font-weight-normal fs-12 text-center mb-6">{{ __('Subscribe to our Yearly Subscription Plans and enjoy ton of benefits') }}</h6>

									<div class="row justify-content-md-center">

										@foreach ( $yearly_subscriptions as $subscription )																			
											<div class="col-lg-3 col-md-6 col-sm-12 flexroom">
												<div class="pl-6 pr-6 pt-2 mb-7 prices-responsive">
													<div class="card border-0 p-4 pl-5 pr-5 pt-7 price-card @if ($subscription->featured) price-card-border @endif">
														@if ($subscription->featured)
															<span class="plan-featured">{{ __('Most Popular') }}</span>
														@endif
														<div class="plan">			
															<div class="plan-title text-center">{{ __($subscription->plan_name) }}</div>		
															<p class="fs-12 text-center mb-3">{{ __($subscription->primary_heading) }}</p>																					
															<p class="plan-cost text-center mb-0"><span class="plan-currency-sign"></span>{!! config('payment.default_system_currency_symbol') !!} @if (config('payment.decimal_points') == 'allow') {{ number_format((float)$subscription->price, 2) }} @else {{ number_format($subscription->price) }} @endif</p>
															<p class="fs-12 text-center mb-3">{{ $subscription->currency }} / {{ __('Year') }}</p>
															<div class="text-center action-button mt-2 mb-4">
																@if (auth()->user()->plan_id == $subscription->id)
																	<button type="button" class="btn btn-cancel">{{ __('Subscribed') }}</button> 
																@else
																	<a href="{{ route('user.plan.subscribe', $subscription->id) }}" class="btn btn-primary">{{ __('Subscribe Now') }}</a>
																@endif															
															</div>
															<p class="fs-12 text-center mb-3">{{ __($subscription->secondary_heading) }}</p>																	
															<ul class="fs-12 pl-3">														
																@foreach ( (explode(',', $subscription->plan_features)) as $feature )
																	@if ($feature)
																		<li><i class="fa-solid fa-circle-small fs-10 text-muted"></i> {{ __($feature) }}</li>
																	@endif																
																@endforeach															
															</ul>																
														</div>					
													</div>	
												</div>							
											</div>										
										@endforeach

									</div>	
								
								@else
									<div class="row text-center">
										<div class="col-sm-12 mt-6 mb-6">
											<h6 class="fs-12 font-weight-bold text-center">{{ __('No Subscriptions plans were set yet') }}</h6>
										</div>
									</div>
								@endif					
							</div>
						@endif	
						
						@if ($lifetime)
							<div class="tab-pane @if ((!$monthly && $lifetime) && (!$yearly && $lifetime)) active @else '' @endif" id="lifetime">

								@if ($lifetime_subscriptions->count())

									<h6 class="font-weight-normal fs-12 text-center mb-6">{{ __('Sign up and enjoy Lifetime Plans') }}</h6>
									
									<div class="row justify-content-md-center">
									
										@foreach ( $lifetime_subscriptions as $subscription )																			
												<div class="col-lg-3 col-md-6 col-sm-12 flexroom">
													<div class="pl-6 pr-6 pt-2 mb-7 prices-responsive">
														<div class="card border-0 p-4 pl-5 pr-5 pt-7 price-card @if ($subscription->featured) price-card-border @endif">
															@if ($subscription->featured)
																<span class="plan-featured">{{ __('Most Popular') }}</span>
															@endif
															<div class="plan">			
																<div class="plan-title text-center">{{ __($subscription->plan_name) }}</div>		
																<p class="fs-12 text-center mb-3">{{ __($subscription->primary_heading) }}</p>																					
																<p class="plan-cost text-center mb-0"><span class="plan-currency-sign"></span>{!! config('payment.default_system_currency_symbol') !!}{{ number_format((float)$subscription->price, 2) }}</p>
																<p class="fs-12 text-center mb-3">{{ $subscription->currency }} / {{ __('Lifetime') }}</p>
																<div class="text-center action-button mt-2 mb-4">
																	@if (auth()->user()->plan_id == $subscription->id)
																		<button type="button" class="btn btn-cancel">{{ __('Subscribed') }}</button> 
																	@else
																		<a href="{{ route('user.prepaid.checkout', ['type' => 'lifetime', 'id' => $subscription->id]) }}" class="btn btn-primary">{{ __('Subscribe Now') }}</a>
																	@endif															
																</div>
																<p class="fs-12 text-center mb-3">{{ __($subscription->secondary_heading) }}</p>																	
																<ul class="fs-12 pl-3">														
																	@foreach ( (explode(',', $subscription->plan_features)) as $feature )
																		@if ($feature)
																			<li><i class="fa-solid fa-circle-small fs-10 text-muted"></i> {{ __($feature) }}</li>
																		@endif																
																	@endforeach															
																</ul>																
															</div>					
														</div>	
													</div>							
												</div>										
											@endforeach					

									</div>

								@else
									<div class="row text-center">
										<div class="col-sm-12 mt-6 mb-6">
											<h6 class="fs-12 font-weight-bold text-center">{{ __('No lifetime plans were set yet') }}</h6>
										</div>
									</div>
								@endif

							</div>	
						@endif	
					</div>
				</div>
			
			@else
				<div class="row text-center">
					<div class="col-sm-12 mt-6 mb-6">
						<h6 class="fs-12 font-weight-bold text-center">{{ __('No Subscriptions or Prepaid plans were set yet') }}</h6>
					</div>
				</div>
			@endif

		</div>
	</div>
@endsection


