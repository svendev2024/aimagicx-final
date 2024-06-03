@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('SMTP Settings') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-sliders mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ url('#') }}"> {{ __('General Settings') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ url('#') }}"> {{ __('SMTP Settings') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection
@section('content')					
	<div class="row">
		<div class="col-lg-5 col-md-12 col-xm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Setup SMTP Settings') }}</h3>
				</div>
				<div class="card-body">
									
					<form action="{{ route('admin.settings.smtp.store') }}" method="POST" enctype="multipart/form-data">
						@csrf				

						<div class="row">							
							<div class="col-12">
								<div class="input-box">								
									<h6>{{ __('SMTP Host') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('smtp-host') is-danger @enderror" id="smtp-host" name="smtp-host" placeholder="SMTP Host Name" value="{{ config('mail.mailers.smtp.host') }}" required>
										@error('smtp-host')
											<p class="text-danger">{{ $errors->first('smtp-host') }}</p>
										@enderror
									</div> 
								</div> 						
							</div>

							<div class="col-12">
								<div class="input-box">								
									<h6>{{ __('SMTP Port') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('smtp-port') is-danger @enderror" id="smtp-port" name="smtp-port" placeholder="SMTP Port Number" value="{{ config('mail.mailers.smtp.port') }}" required>
										@error('smtp-port')
											<p class="text-danger">{{ $errors->first('smtp-port') }}</p>
										@enderror
									</div> 
								</div> 						
							</div>

							<div class="col-12">
								<div class="input-box">								
									<h6>{{ __('SMTP Username') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('smtp-username') is-danger @enderror" id="smtp-username" name="smtp-username" placeholder="SMTP Username" value="{{ config('mail.mailers.smtp.username') }}" required>
										@error('smtp-username')
											<p class="text-danger">{{ $errors->first('smtp-username') }}</p>
										@enderror
									</div> 
								</div> 						
							</div>

							<div class="col-12">
								<div class="input-box">								
									<h6>{{ __('SMTP Password') }}</h6>
									<div class="form-group">							    
										<input type="password" class="form-control @error('smtp-password') is-danger @enderror" id="smtp-password" name="smtp-password" placeholder="SMTP Password" value="{{ config('mail.mailers.smtp.password') }}" required>
										@error('smtp-password')
											<p class="text-danger">{{ $errors->first('smtp-password') }}</p>
										@enderror
									</div> 
								</div> 						
							</div>

							<div class="col-12">
								<div class="input-box">								
									<h6>{{ __('Sender Email Address') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('smtp-from') is-danger @enderror" id="smtp-from" name="smtp-from" placeholder="Sender Email Address" value="{{ config('mail.from.address') }}" required>
										@error('smtp-from')
											<p class="text-danger">{{ $errors->first('smtp-from') }}</p>
										@enderror
									</div> 
								</div> 						
							</div>

							<div class="col-12">
								<div class="input-box">								
									<h6>{{ __('Sender Name') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('smtp-name') is-danger @enderror" id="smtp-name" name="smtp-name" placeholder="Sender Full Name" value="{{ config('mail.from.name') }}" required>
										@error('smtp-name')
											<p class="text-danger">{{ $errors->first('smtp-name') }}</p>
										@enderror
									</div> 
								</div> 						
							</div>

							<div class="col-12">							
								<div class="input-box">	
									<h6>{{ __('SMTP Encryption') }}</h6>
			  						<select id="smtp-encryption" name="smtp-encryption" data-placeholder="Select SMTP Encryption Type:">			
										<option value="tls" @if ( config('mail.mailers.smtp.encryption')  == 'tls') selected @endif>{{ __('TLS') }}</option>
										<option value="ssl" @if ( config('mail.mailers.smtp.encryption')  == 'ssl') selected @endif>{{ __('SSL') }}</option>
									</select>
								</div> 							
							</div>

						</div>

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<button href="#" type="button" class="btn btn-cancel mr-2" data-bs-toggle="modal" data-bs-target="#test-email">{{ __('Test') }}</button>
							<button type="submit" class="btn btn-primary">{{ __('Save') }}</button>							
						</div>				

					</form>					
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="test-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
		  	<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope"></i> {{ __('Send Test Email') }}</h4>
				  <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
				  </button>			        	
				</div>
				<form class="send-email" action="{{ route('admin.settings.smtp.test') }}" method="POST" enctype="multipart/form-data">
					@csrf

					<div class="modal-body pb-0 pt-0 pl-6 pr-6">

					  <!-- EMAIL ADDRESS -->
					  <div class="input-box">								
						  <h6>{{ __('To Email Address') }}</h6>
						  <div class="form-group">							    
							  <input type="text" class="form-control" class="email" name="email" id="email" placeholder="Enter Receiver's Email Address" required>
						  </div> 
					  </div> <!-- END EMAIL ADDRESS -->					  

					  <!-- SUBJECT -->
					  <div class="input-box">								
						  <h6>{{ __('Email Subject') }}</h6>
						  <div class="form-group">							    
							  <input type="text" class="form-control" class="subject" name="subject" id="subject" placeholder="Enter Subject"  required>
						  </div> 
					  </div> <!-- END SUBJECT -->

					  <!-- MESSAGE -->
					  <div class="input-box">								
						  <h6>{{ __('Email Message') }}</h6>
						  <div class="form-group">
							  <textarea class="form-control" class="message" name="message" id="message" rows="5" maxlength="500" placeholder="Enter Message" required></textarea>			
						  </div> 
					  </div> <!-- END MESSAGE -->
				   </div>

					<div class="modal-footer pr-6 pb-4">
					  <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
					  <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
					</div>

			  	</form>
		  	</div>
		</div>
  </div>
@endsection