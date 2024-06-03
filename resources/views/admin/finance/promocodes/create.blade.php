@extends('layouts.app')

@section('css')
	<!-- Datepicker CSS -->
	<link href="{{URL::asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7"> 
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('New Promocode') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-sack-dollar mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.finance.dashboard') }}"> {{ __('Finance Management') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.finance.promocodes') }}"> {{ __('Promocodes') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('New Promocode') }}</a></li>
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
					<h3 class="card-title">{{ __('Create New Promocode') }}</h3>
				</div>
				<div class="card-body pt-5">									
					<form action="{{ route('admin.finance.promocodes.store') }}" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="row">

							<div class="col-lg-6 col-md-6 col-sm-12">				
								<div class="input-box">	
									<h6>{{ __('Promocode Name') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="text" class="form-control" id="promo-name" name="promo-name" value="{{ old('promo-name') }}" required>
									</div>
									@error('promo-name')
										<p class="text-danger">{{ $errors->first('promo-name') }}</p>
									@enderror
								</div> 							
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12">						
								<div class="input-box">	
									<h6>{{ __('Status') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<select id="promo-status" name="status" data-placeholder="{{ __('Select Promocode Status') }}:">			
										<option value="valid" selected>{{ __('Valid') }}</option>
										<option value="invalid">{{ __('Invalid') }}</option>
									</select>
									@error('status')
										<p class="text-danger">{{ $errors->first('status') }}</p>
									@enderror	
								</div>						
							</div>
						
						</div>

						<div class="row mt-2">							
							<div class="col-lg-6 col-md-6col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Promo Type') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<select id="promo-type" name="promo-type" data-placeholder="{{ __('Select Promocode Type') }}:">			
										<option value="percentage" selected>{{ __('Percentage Discount') }}</option>
										<option value="fixed">{{ __('Fixed Discount') }}</option>
									</select> 
									@error('promo-type')
										<p class="text-danger">{{ $errors->first('promo-type') }}</p>
									@enderror
								</div> 						
							</div>

							<div class="col-lg-6 col-md-6col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Discount Value') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount') }}" required>
									</div> 
									@error('discount')
										<p class="text-danger">{{ $errors->first('discount') }}</p>
									@enderror
								</div> 						
							</div>

							<div class="col-lg-6 col-md-6col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Single Usage') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Create only 1 promocode or many others by specifying in the Quantities field') }}"></i></h6>
									<select id="promo-usage" name="usage" data-placeholder="{{ __('Select Promocode Usage') }}:" data-callback="singleUsageCheck">			
										<option value=0 selected>{{ __('False') }}</option>
										<option value=1>{{ __('True') }}</option>
									</select> 
									@error('usage')
										<p class="text-danger">{{ $errors->first('usage') }}</p>
									@enderror
								</div> 						
							</div>

							<div class="col-lg-6 col-md-6col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Usage Quantity') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}">
									</div> 
									@error('quantity')
										<p class="text-danger">{{ $errors->first('quantity') }}</p>
									@enderror
								</div> 						
							</div>

							<div class="col-lg-6 col-md-6col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Multi Usage by the same User') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Allow or Deny the same promocode usage by the same user multiple times') }}"></i></h6>
									<select id="languages" name="multi_use" data-placeholder="{{ __('Set Multi Usage by the same User') }}:">			
										<option value=1>{{ __('Allow') }}</option>
										<option value=0 selected>{{ __('Deny') }}</option>
									</select> 
									@error('usage')
										<p class="text-danger">{{ $errors->first('usage') }}</p>
									@enderror
								</div> 						
							</div>

							<div class="col-lg-6 col-md-6col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Valid Until') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group" id="datepicker-container">							    
										<input type="text" class="form-control" placeholder="YYYY-MM-DD" id="valid-until" name="valid-until" value="{{ old('valid-until') }}" required>
									</div> 
									@error('valid-until')
										<p class="text-danger">{{ $errors->first('valid-until') }}</p>
									@enderror
								</div> 						
							</div>
						</div>


						<!-- ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-4">
							<a href="{{ route('admin.finance.promocodes') }}" class="btn btn-cancel mr-2">{{ __('Cancel') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('Create') }}</button>							
						</div>				

					</form>					
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<!-- Bootstrap Datepicker JS -->
	<script src="{{URL::asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>	
	<script>
		$(function(){

			'use strict';

			$('#datepicker-container input').datepicker({
				autoclose: true,
				todayHighlight: true,
				toggleActive: true,
				format: 'yyyy-mm-dd',
				orientation: "bottom"
			});			
		});

		function singleUsageCheck(value) {

			"use strict";
			console.log(value)

			if (value == 0) {
				document.getElementById('quantity').disabled = false;
			} else {
				document.getElementById('quantity').disabled = true;
			}
		}
	</script>
@endsection
