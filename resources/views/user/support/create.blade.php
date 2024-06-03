@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('New Support Request') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"><i class="fa-solid fa-messages-question mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('user.support') }}"> {{ __('Support Request') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ url('#') }}"> {{ __('Create Support Request') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<!-- SUPPORT REQUEST -->
	<div class="row">
		<div class="col-lg-9 col-md-9 col-sm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Create Support Request') }}</h3>
				</div>
				<div class="card-body pt-5">									
					<form id="" action="{{ route('user.support.store') }}" method="post" enctype="multipart/form-data">
						@csrf

						<div class="row">

							<div class="col-lg-6 col-md-6 col-sm-12">				
								<div class="input-box">	
									<h6>{{ __('Support Category') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<select id="support-category" name="category" data-placeholder="{{ __('Select Support Case') }}:">			
										<option value="General Inquiry" selected>{{ __('General Inquiry') }}</option>
										<option value="Technical Inquiry">{{ __('Technical Issue') }}</option>
										<option value="Billing Inquiry">{{ __('Billing Issue') }}</option>
										<option value="Improvement Idea">{{ __('Improvement Idea') }}</option>
										<option value="Feedback">{{ __('Feedback') }}</option>
									</select>
									@error('category')
										<p class="text-danger">{{ $errors->first('category') }}</p>
									@enderror	
								</div> 							
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12">						
								<div class="input-box">	
									<h6>{{ __('Support Priority') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<select id="support-priority" name="priority" data-placeholder="{{ __('Select Support Case Priority') }}:">			
										<option value="Low" selected>{{ __('Low') }}</option>
										<option value="Normal">{{ __('Normal') }}</option>
										<option value="High">{{ __('High') }}</option>
										<option value="Critical">{{ __('Critical') }}</option>
									</select>
									@error('priority')
										<p class="text-danger">{{ $errors->first('priority') }}</p>
									@enderror	
								</div>						
							</div>
						
						</div>

						<div class="row mt-2">							
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Subject') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="text" class="form-control" id="subject" name="subject" required>
									</div> 
									@error('subject')
										<p class="text-danger">{{ $errors->first('subject') }}</p>
									@enderror	
								</div> 						
							</div>
						</div>

						<div class="row mt-2">							
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">
									<div class="input-group file-browser">	
										<h6>{{ __('Attach File') }} <span class="text-muted fs-12">({{ __('JPG | JPEG | PNG') }})</h6>								
										<input type="text" class="form-control border-right-0 browse-file" placeholder="Include attachment file..." style="margin-right: 80px;" readonly>
										<label class="input-group-btn mt-4">
											<span class="btn btn-primary special-btn">
												{{ __('Browse') }} <input type="file" name="attachment" style="display: none;">
											</span>
										</label>
									</div>	
									@error('attachment')
										<p class="text-danger">{{ $errors->first('attachment') }}</p>
									@enderror
								</div> 						
							</div>
						</div>	

						<div class="row mt-2">
							<div class="col-lg-12 col-md-12 col-sm-12">	
								<div class="input-box">	
									<h6>{{ __('Support Message') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>							
									<textarea class="form-control" name="message" rows="10"></textarea>
									@error('message')
										<p class="text-danger">{{ $errors->first('message') }}</p>
									@enderror	
								</div>											
							</div>
						</div>

						<!-- ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<a href="{{ route('user.support') }}" class="btn btn-cancel mr-2">{{ __('Cancel') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('Send') }}</button>							
						</div>				

					</form>					
				</div>
			</div>
		</div>
	</div>
	<!-- END SUPPORT REQUEST -->
@endsection

@section('js')
	<script src="{{URL::asset('js/avatar.js')}}"></script>
@endsection
