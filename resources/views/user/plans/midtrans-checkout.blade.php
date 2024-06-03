@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">Midtrans Checkout</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-box-circle-check mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('user.plans') }}"> {{ __('Pricing Plans') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Midtrans Checkout') }}</a></li>				
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
						<h6 class="mt-2"><span class="font-weight-bold">Midtrans</span></h6>
						<p class="fs-12 mt-3">{{ __('Click Pay Now button to complete the payment process via Midtrans Payment') }}.</p>
						<p class="fs-12 mt-3">{{ __('Plan name: ') }} <span class="font-weight-bold">{{ $id->plan_name }}</span>.</p>
	
							<div id="dropin-container"></div>
	
						<button type="button" id="midtrans" class="btn btn-primary mb-4 mt-2">{{ __('Pay Now') }}</button>		
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script type="text/javascript" @if(config('services.midtrans.production')) src="https://app.midtrans.com/snap/snap.js" @else src="https://app.sandbox.midtrans.com/snap/snap.js" @endif data-client-key="{{config('services.midtrans.client_key')}}"></script>
	<script type="text/javascript">

       // For example trigger on button clicked, or any time you need
	   var payButton = document.getElementById('midtrans');
        payButton.addEventListener('click', function () {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{$snapToken}}', {
                onSuccess: function (result) {
                    //window.location.href = '/user/payments/approved'
                    console.log(result);
                },
                onPending: function (result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function (result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function () {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });

	</script>
@endsection



