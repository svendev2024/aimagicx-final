@extends('layouts.app')

@section('css')
	<link href="{{URL::asset('plugins/tippy/scale-extreme.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('plugins/tippy/material.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"> {{ __('Frontend Settings') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-globe mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Management') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Settings') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection
@section('content')					
	<div class="row">
		<div class="col-lg-6 col-md-12 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Setup Frontend Settings') }}</h3>
				</div>
				<div class="card-body">
				
					<form action="{{ route('admin.settings.frontend.store') }}" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="row">
							<div class="col-md-4 col-sm-12">									
								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Maintenance Mode') }}</h6>								
								<div class="form-group mb-4">
									<label class="custom-switch">
										<input type="checkbox" name="maintenance" class="custom-switch-input" @if ( config('frontend.maintenance')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Enable') }}</span>
									</label>
								</div> 
							</div>
						</div>
						
						<div class="row">

							<div class="col-md-4 col-sm-12">									
								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Frontend Page') }}</h6>								
								<div class="form-group mb-4">
									<label class="custom-switch">
										<input type="checkbox" name="frontend" class="custom-switch-input" @if ( config('frontend.frontend_page')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Show') }}</span>
									</label>
								</div> 
							</div>

							<div class="col-md-4 col-sm-12">									
								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Pricing Section') }}</h6>								
								<div class="form-group mb-4">
									<label class="custom-switch">
										<input type="checkbox" name="pricing" class="custom-switch-input" @if ( config('frontend.pricing_section')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Show') }}</span>
									</label>
								</div> 
							</div>

							<div class="col-md-4 col-sm-12">									
								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Contact Us Section') }}</h6>								
								<div class="form-group mb-4">
									<label class="custom-switch">
										<input type="checkbox" name="contact" class="custom-switch-input" @if ( config('frontend.contact_section')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Show') }}</span>
									</label>
								</div> 
							</div>

							<div class="col-md-4 col-sm-12">									
								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Features Section') }}</h6>								
								<div class="form-group mb-4">
									<label class="custom-switch">
										<input type="checkbox" name="features" class="custom-switch-input" @if ( config('frontend.features_section')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Show') }}</span>
									</label>
								</div> 
							</div>

							<div class="col-md-4 col-sm-12">									
								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Blogs Section') }}</h6>								
								<div class="form-group mb-4">
									<label class="custom-switch">
										<input type="checkbox" name="blogs" class="custom-switch-input" @if ( config('frontend.blogs_section')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Show') }}</span>
									</label>
								</div> 
							</div>

							<div class="col-md-4 col-sm-12">									
								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Reviews Section') }}</h6>								
								<div class="form-group mb-4">
									<label class="custom-switch">
										<input type="checkbox" name="reviews" class="custom-switch-input" @if ( config('frontend.reviews_section')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Show') }}</span>
									</label>
								</div> 
							</div>

							<div class="col-md-4 col-sm-12">									
								<h6 class="fs-12 font-weight-bold mb-4">{{ __('FAQ Section') }}</h6>								
								<div class="form-group mb-4">
									<label class="custom-switch">
										<input type="checkbox" name="faq" class="custom-switch-input" @if ( config('frontend.faq_section')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Show') }}</span>
									</label>
								</div> 
							</div>
						</div>

						<div class="card border-0 special-shadow mb-7">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="fa fa-link text-info fs-14 mr-2"></i>{{ __('Custom Landing Page URL') }}</h6>

								<div class="form-group">
									<label class="custom-switch">
										<input type="checkbox" name="enable-redirection" class="custom-switch-input" @if ( config('frontend.custom_url.status')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Enable') }}</span>
									</label>
								</div>

								<div class="row">
									<div class="col-md-12 col-sm-12">													
										<div class="input-box">								
											<h6>{{ __('Landing Page URL') }} <i class="ml-2 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="Set custom index url for all frontend pages. Ex: https://aws.amazon.com (Note: https:// - is required)"></i></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('url') is-danger @enderror" id="url" name="url" value="{{ config('frontend.custom_url.link') }}" autocomplete="off">
												@error('url')
													<p class="text-danger">{{ $errors->first('url') }}</p>
												@enderror
											</div> 
										</div> 
									</div>							
								</div>	
							</div>
						</div>

						<div class="card border-0 special-shadow mt-6 mb-6">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="fa-brands fa-html5 mr-2"></i>{{ __('Custom Frontend CSS and JS Files') }}</h6>

								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12">													
										<div class="input-box">								
											<h6>{{ __('CSS File Path') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('css') is-danger @enderror" id="css" name="css" value="{{ $files['css'] }}" autocomplete="off">
												@error('css')
													<p class="text-danger">{{ $errors->first('css') }}</p>
												@enderror
											</div> 
										</div> 
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12">
										<div class="input-box">	
											<h6>{{ __('JS File Path') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('js') is-danger @enderror" id="js" name="js" value="{{ $files['js'] }}" autocomplete="off">
												@error('js')
													<p class="text-danger">{{ $errors->first('js') }}</p>
												@enderror
											</div> 
										</div> 						
									</div>								
								</div>
	
							</div>
						</div>
						
						<div class="card border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="fa fa-user-secret mr-2"></i>{{ __('Footer Social Media Information') }}</h6>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">					
										<div class="input-box">								
											<h6><i class="fa-brands fa-twitter mr-2"></i>{{ __('Twitter') }} <span class="text-muted"></span></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('twitter') is-danger @enderror" id="twitter" name="twitter" value="{{ config('frontend.social_twitter') }}" autocomplete="off">
												@error('twitter')
													<p class="text-danger">{{ $errors->first('twitter') }}</p>
												@enderror
											</div> 
										</div> 
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">					
										<div class="input-box">								
											<h6><i class="fa-brands fa-facebook-f mr-2"></i>{{ __('Facebook') }} <span class="text-muted"></span></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('facebook') is-danger @enderror" id="facebook" name="facebook" value="{{ config('frontend.social_facebook') }}" autocomplete="off">
												@error('facebook')
													<p class="text-danger">{{ $errors->first('facebook') }}</p>
												@enderror
											</div> 
										</div> 
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">					
										<div class="input-box">								
											<h6><i class="fa-brands fa-linkedin-in mr-2"></i>{{ __('LinkedIn') }} <span class="text-muted"></span></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('linkedin') is-danger @enderror" id="linkedin" name="linkedin" value="{{ config('frontend.social_linkedin') }}" autocomplete="off">
												@error('linkedin')
													<p class="text-danger">{{ $errors->first('linkedin') }}</p>
												@enderror
											</div> 
										</div> 
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">					
										<div class="input-box">								
											<h6><i class="fa-brands fa-instagram mr-2"></i>{{ __('Instagram') }} <span class="text-muted"></span></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('instagram') is-danger @enderror" id="instagram" name="instagram" value="{{ config('frontend.social_instagram') }}" autocomplete="off">
												@error('instagram')
													<p class="text-danger">{{ $errors->first('instagram') }}</p>
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

@section('js')
	<script src="{{URL::asset('plugins/tippy/popper.min.js')}}"></script>
	<script src="{{URL::asset('plugins/tippy/tippy-bundle.umd.min.js')}}"></script>
	<script>
		$(function () {
		   tippy('[data-tippy-content]', {
			   animation: 'scale-extreme',
			   theme: 'material',
		   });
		});
   </script>
@endsection

