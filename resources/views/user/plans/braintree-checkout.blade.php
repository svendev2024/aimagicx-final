@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">Braintree Checkout</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-box-circle-check mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('user.plans') }}"> {{ __('Pricing Plans') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Braintree Checkout') }}</a></li>				
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
						<h6 class="mt-2"><span class="font-weight-bold">Braintree</span></h6>
						<p class="fs-12 mt-3">{{ __('Click Pay Now button to complete the payment process via Braintree Payment') }}.</p>
						<p class="fs-12 mt-3">{{ __('Plan name: ') }} <span class="font-weight-bold">{{ $id->plan_name }}</span>.</p>
	
							<div id="dropin-container"></div>
	
						<button type="button" id="braintree" class="btn btn-primary mb-4 mt-2">{{ __('Pay Now') }}</button>		
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script src="https://js.braintreegateway.com/web/dropin/1.31.2/js/dropin.min.js"></script>
	<script type="text/javascript">
	    var submitButton = document.querySelector('#braintree');

        braintree.dropin.create({
        authorization: "{{ $clientToken }}",
        container: '#dropin-container'
        }, function (err, dropinInstance) {
            submitButton.addEventListener('click', function () {
                dropinInstance.requestPaymentMethod(function (err, payload) {
                	$.get('{{ route('user.payments.approved') }}', {payload}, function (data) {				
						if (data.result.success) {
							var url = '{{ route("user.payments.approved.braintree", ['plan' => 'X_plan','order' => 'X_order']) }}';
							url = url.replace('X_plan', data.plan);
							url = url.replace('X_order', data.order_id);
							window.location.href = url;
						} else {
							alert('Payment failed, contact support or try again.');
						}
					}, 'json');
                });
            });

            if (dropinInstance.isPaymentMethodRequestable()) {
                // This will be true if you generated the client token
                // with a customer ID and there is a saved payment method
                // available to tokenize with that customer.
                submitButton.removeAttribute('disabled');
            }

            dropinInstance.on('paymentMethodRequestable', function (event) {
                console.log(event.type); // The type of Payment Method, e.g 'CreditCard', 'PayPalAccount'.
                console.log(event.paymentMethodIsSelected); // true if a customer has selected a payment method when paymentMethodRequestable fires

                submitButton.removeAttribute('disabled');
            });

            dropinInstance.on('noPaymentMethodRequestable', function () {
                submitButton.setAttribute('disabled', true);
            });
        });
	</script>
@endsection



