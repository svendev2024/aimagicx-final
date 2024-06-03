@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"> {{ __('Appearance Settings') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-globe mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Management') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('SEO & Logos') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection
@section('content')					
	<div class="row">
		<div class="col-lg-5 col-md-12 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Setup Appearance Settings') }}</h3>
				</div>
				<div class="card-body">
				
					<form action="{{ route('admin.settings.appearance.store') }}" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="row">
							<div class="col-md-6 col-sm-12">									
								<div class="input-box">								
									<h6>{{ __('SEO Title') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('title') is-danger @enderror" id="title" name="title" value="{{ $information['title'] }}" autocomplete="off">
										@error('title')
											<p class="text-danger">{{ $errors->first('title') }}</p>
										@enderror
									</div> 
								</div> 
							</div>	

							<div class="col-md-6 col-sm-12">									
								<div class="input-box">								
									<h6>{{ __('SEO Author') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('author') is-danger @enderror" id="author" name="author" value="{{ $information['author'] }}" autocomplete="off">
										@error('author')
											<p class="text-danger">{{ $errors->first('author') }}</p>
										@enderror
									</div> 
								</div> 
							</div>

							<div class="col-md-12 col-sm-12">									
								<div class="input-box">								
									<h6>{{ __('SEO Keywords') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('keywords') is-danger @enderror" id="keywords" name="keywords" value="{{ $information['keywords'] }}" autocomplete="off">
										@error('keywords')
											<p class="text-danger">{{ $errors->first('keywords') }}</p>
										@enderror
									</div> 
								</div> 
							</div>
							
							<div class="col-md-12 col-sm-12">									
								<div class="input-box">								
									<h6>{{ __('SEO Description') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('description') is-danger @enderror" id="description" name="description" value="{{ $information['description'] }}" autocomplete="off">
										@error('description')
											<p class="text-danger">{{ $errors->first('description') }}</p>
										@enderror
									</div> 
								</div> 
							</div>							
						
						</div>
						
						<div class="card border-0 special-shadow">
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Primary Logo') }}</h6>

								<div class="row">

									<div class="col-sm-12 col-md-6">
										<div class="input-box border">
											<img src="{{ URL::asset('img/brand/logo.png') }}" alt="Main Logo">
										</div>
									</div>

									<div class="col-sm-12 col-md-6">
										<div class="input-box">
											<label class="form-label fs-12">{{ __('Select Logo') }} <span class="text-muted">({{ __('Recommended Size') }})</span></label>
											<div class="input-group file-browser">									
												<input type="text" class="form-control border-right-0 browse-file" placeholder="240px by 70px PNG image" readonly>
												<label class="input-group-btn">
													<span class="btn btn-primary special-btn">
														{{ __('Browse') }} <input type="file" name="main_logo" style="display: none;">
													</span>
												</label>
											</div>
											@error('main_logo')
												<p class="text-danger">{{ $errors->first('main_logo') }}</p>
											@enderror
										</div>
									</div>					

								</div>
							</div>
						</div>

						<div class="card border-0 special-shadow">
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Footer Logo') }}</h6>

								<div class="row">

									<div class="col-sm-12 col-md-6">
										<div class="input-box border bg-dark">
											<img src="{{ URL::asset('img/brand/logo-white.png') }}" alt="Footer Logo">
										</div>
									</div>

									<div class="col-sm-12 col-md-6">
										<div class="input-box">
											<label class="form-label fs-12">{{ __('Select Logo') }} <span class="text-muted">({{ __('Recommended Size') }})</span></label>
											<div class="input-group file-browser">									
												<input type="text" class="form-control border-right-0 browse-file" placeholder="240px by 70px PNG image" readonly>
												<label class="input-group-btn">
													<span class="btn btn-primary special-btn">
														{{ __('Browse') }} <input type="file" name="footer_logo" style="display: none;">
													</span>
												</label>
											</div>
											@error('footer_logo')
												<p class="text-danger">{{ $errors->first('footer_logo') }}</p>
											@enderror
										</div>
									</div>					

								</div>
							</div>
						</div>

						<div class="card border-0 special-shadow">
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Secondary Minimized Logo') }}</h6>

								<div class="row">

									<div class="col-sm-12 col-md-6">
										<div class="input-box">
											<img src="{{ URL::asset('img/brand/favicon.png') }}" class="border" alt="Main Logo">
										</div>
									</div>

									<div class="col-sm-12 col-md-6">
										<div class="input-box">
											<label class="form-label fs-12">{{ __('Select Logo') }} <span class="text-muted">({{ __('Recommended Size') }})</span></label>
											<div class="input-group file-browser">									
												<input type="text" class="form-control border-right-0 browse-file" placeholder="68px by 68px PNG Image" readonly>
												<label class="input-group-btn">
													<span class="btn btn-primary special-btn">
														{{ __('Browse') }} <input type="file" name="minimized_logo" style="display: none;">
													</span>
												</label>
											</div>
											@error('minimized_logo')
												<p class="text-danger">{{ $errors->first('minimized_logo') }}</p>
											@enderror
										</div>
									</div>					

								</div>
							</div>
						</div>

						<div class="card border-0 special-shadow">
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Favicon') }}</h6>

								<div class="row">

									<div class="col-sm-12 col-md-6">
										<div class="input-box">
											<img src="{{ URL::asset('img/brand/favicon.ico') }}" class="border w-20 mt-3" alt="Favicon Logo">
										</div>
									</div>

									<div class="col-sm-12 col-md-6">
										<div class="input-box">
											<label class="form-label fs-12">{{ __('Select Favicon') }} <span class="text-muted">({{ __('Recommended Size') }})</span></label>
											<div class="input-group file-browser">									
												<input type="text" class="form-control border-right-0 browse-file" placeholder="32px by 32px ICO Format" readonly>
												<label class="input-group-btn">
													<span class="btn btn-primary special-btn">
														{{ __('Browse') }} <input type="file" name="favicon_logo" style="display: none;">
													</span>
												</label>
											</div>
											@error('favicon_logo')
												<p class="text-danger">{{ $errors->first('favicon_logo') }}</p>
											@enderror
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
