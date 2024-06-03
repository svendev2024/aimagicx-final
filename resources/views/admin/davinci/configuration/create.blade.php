@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('Store New API Key') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-microchip-ai mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.davinci.dashboard') }}"> {{ __('Davinci Management') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="#"> {{ __('Davinci Settings') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> {{ __('Store API Keys') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<div class="row">
		<div class="col-lg-6 col-md-12 col-sm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Store New API Key') }}</h3>
				</div>
				<div class="card-body pt-5">									
					<form id="" action="{{ route('admin.davinci.configs.keys.store') }}" method="post" enctype="multipart/form-data">
						@csrf

						<div class="row mt-2">							
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="input-box mb-0">								
									<h6>{{ __('AI Engine') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<select id="chats" name="engine" data-placeholder="{{ __('Select AI Engine') }}">
										<option value="openai" selected>{{ __('OpenAI') }}</option>
										<option value="stable_diffusion">{{ __('Stable Diffusion') }}</option>																																																																																																									
									</select>
								</div> 
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('API Key') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="text" class="form-control" name="api_key" value="{{ old('api_key') }}" required>
									</div> 
									@error('api_key')
										<p class="text-danger">{{ $errors->first('api_key') }}</p>
									@enderror	
								</div> 						
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="input-box">
									<h6>{{ __('Status') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<select id="templates-user" name="status" data-placeholder="{{ __('Set API Key Status') }}">
										<option value=1 selected>{{ __('Active') }}</option>	
										<option value=0>{{ __('Deactive') }}</option>																																									
									</select>
								</div>
							</div>	
						</div>

						<!-- ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<a href="{{ route('admin.davinci.configs.keys') }}" class="btn btn-cancel mr-2">{{ __('Cancel') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('Create') }}</button>							
						</div>				

					</form>					
				</div>
			</div>
		</div>
	</div>
@endsection

