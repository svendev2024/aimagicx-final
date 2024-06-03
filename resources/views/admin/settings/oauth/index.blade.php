@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"> {{ __('OAuth Login') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-sliders mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('General Settings') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('OAuth Settings') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection
@section('content')					
	<div class="row">
		<div class="col-lg-8 col-md-12 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Setup OAuth Login') }}</h3>
				</div>
				<div class="card-body">
					
					<form action="{{ route('admin.settings.oauth.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						
						<div class="row">

							<div class="col-lg-6 col-md-6 col-sm-12 mt-2">
								<div class="input-box">	
									<h6>{{ __('Login via Social Media') }} <span class="text-muted">({{ __('OAuth') }})</span></h6>
			  						<select id="login-oauth" name="login-oauth" data-placeholder="{{ __('Login via Social Media') }}:">			
										<option value="enabled" @if ( config('settings.oauth_login')  == 'enabled') selected @endif>{{ __('Enabled') }}</option>
										<option value="disabled" @if ( config('settings.oauth_login')  == 'disabled') selected @endif>{{ __('Disabled') }}</option>
									</select>
								</div> 					
							</div>
						
						</div>


						<div class="card border-0 special-shadow">							
							<div class="card-body">
								<h6 class="fs-12 font-weight-bold mb-4"><i class="fs-13 mr-2 fa-brands fa-facebook-square"></i>{{ __('Facebook') }}</h6>
								
								<div class="form-group mb-4">
									<label class="custom-switch">
										<input type="checkbox" name="enable-facebook" class="custom-switch-input" @if ( config('services.facebook.enable')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Allow Facebook Login') }}</span>
									</label>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('Facebook API Key') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('facebook-key') is-danger @enderror" id="facebook-key" name="facebook-key" value="{{ config('services.facebook.client_id') }}" autocomplete="off">
												@error('facebook-key')
													<p class="text-danger">{{ $errors->first('facebook-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- SECRET ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('Facebook API Secret Key') }}</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control @error('facebook-secret-key') is-danger @enderror" id="facebook-secret-key" name="facebook-secret-key" value="{{ config('services.facebook.client_secret') }}" autocomplete="off">
												@error('facebook-secret-key')
													<p class="text-danger">{{ $errors->first('facebook-secret-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END SECRET ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('Fabook Redirect URL') }}</small></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('facebook-redirect') is-danger @enderror" id="facebook-redirect" name="facebook-redirect" value="{{ config('services.facebook.redirect') }}" autocomplete="off">
												@error('facebook-redirect')
													<p class="text-danger">{{ $errors->first('facebook-redirect') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>

								</div>
	
							</div>
						</div>	


						<div class="card border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="fs-13 mr-2 fa-brands fa-twitter-square"></i>{{ __('Twitter') }}</h6>

								<div class="form-group mb-4">
									<label class="custom-switch">
										<input type="checkbox" name="enable-twitter" class="custom-switch-input" @if ( config('services.twitter.enable')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Allow Twitter Login') }}</span>
									</label>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('Twitter API Key') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('twitter-key') is-danger @enderror" id="twitter-key" name="twitter-key" value="{{ config('services.twitter.client_id') }}" autocomplete="off">
												@error('twitter-key')
													<p class="text-danger">{{ $errors->first('twitter-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('Twitter API Secret Key') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('twitter-secret-key') is-danger @enderror" id="twitter-secret-key" name="twitter-secret-key" value="{{ config('services.twitter.client_secret') }}" autocomplete="off">
												@error('twitter-secret-key')
													<p class="text-danger">{{ $errors->first('twitter-secret-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('Twitter Redirect URL') }}</small></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('twitter-redirect') is-danger @enderror" id="twitter-redirect" name="twitter-redirect" value="{{ config('services.twitter.redirect') }}" autocomplete="off">
												@error('twitter-redirect')
													<p class="text-danger">{{ $errors->first('twitter-redirect') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>

								</div>
	
							</div>
						</div>


						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="fs-13 mr-2 fa-brands fa-google-plus-square"></i>{{ __('Google') }}</h6>

								<div class="form-group mb-4">
									<label class="custom-switch">
										<input type="checkbox" name="enable-google" class="custom-switch-input" @if ( config('services.google.enable')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Allow Google Login') }}</span>
									</label>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('Google API Key') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('google-key') is-danger @enderror" id="google-key" name="google-key" value="{{ config('services.google.client_id') }}" autocomplete="off">
												@error('google-key')
													<p class="text-danger">{{ $errors->first('google-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>		
									
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('Google API Secret Key') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('google-secret-key') is-danger @enderror" id="google-secret-key" name="google-secret-key" value="{{ config('services.google.client_secret') }}" autocomplete="off">
												@error('google-secret-key')
													<p class="text-danger">{{ $errors->first('google-secret-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<div class="input-box">								
											<h6>{{ __('Google Redirect URL') }}</small></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('google-redirect') is-danger @enderror" id="google-redirect" name="google-redirect" value="{{ config('services.google.redirect') }}" autocomplete="off">
												@error('google-redirect')
													<p class="text-danger">{{ $errors->first('google-redirect') }}</p>
												@enderror
											</div> 
										</div> 
									</div>
								</div>
	
							</div>
						</div>						


						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="fs-13 mr-2 fa-brands fa-linkedin-square"></i>{{ __('LinkedIn') }}</h6>

								<div class="form-group mb-4">
									<label class="custom-switch">
										<input type="checkbox" name="enable-linkedin" class="custom-switch-input" @if ( config('services.linkedin.enable')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Allow LinkedIn Login') }}</span>
									</label>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('LinkedIn API Key') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('linkedin-key') is-danger @enderror" id="linkedin-key" name="linkedin-key" value="{{ config('services.linkedin.client_id') }}" autocomplete="off">
												@error('linkedin-key')
													<p class="text-danger">{{ $errors->first('linkedin-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- SECRET ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('LinkedIn Secret Key') }}</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control @error('linkedin-secret-key') is-danger @enderror" id="linkedin-secret-key" name="linkedin-secret-key" value="{{ config('services.linkedin.client_secret') }}" autocomplete="off">
												@error('linkedin-secret-key')
													<p class="text-danger">{{ $errors->first('linkedin-secret-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END SECRET ACCESS KEY -->
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<div class="input-box">								
											<h6>{{ __('LinkedIn Redirect URL') }}</small></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('linkedin-redirect') is-danger @enderror" id="linkedin-redirect" name="linkedin-redirect" value="{{ config('services.linkedin.redirect') }}" autocomplete="off">
												@error('linkedin-redirect')
													<p class="text-danger">{{ $errors->first('linkedin-redirect') }}</p>
												@enderror
											</div> 
										</div> 
									</div>
								</div>
	
							</div>
						</div>

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<a href="{{ route('admin.dashboard') }}" class="btn btn-cancel mr-2">{{ __('Cancel') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('Save') }}</button>							
						</div>				

					</form>
					
				</div>
			</div>
		</div>
	</div>
@endsection