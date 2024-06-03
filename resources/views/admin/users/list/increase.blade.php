@extends('layouts.app')

@section('page-header')
	<!-- EDIT PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('Increase Words & Images') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-id-badge mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.user.dashboard') }}"> {{ __('User Management') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.user.list') }}">{{ __('User List') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> {{ __('Increase Words & Images') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')
	<div class="row">
		<div class="col-xl-6 col-lg-6 col-sm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Add Words & Images') }}</h3>
				</div>
				<div class="card-body">
					<form method="POST" action="{{ route('admin.user.increase', [$user->id]) }}" enctype="multipart/form-data">
						@csrf
						
						<div class="row">

							<div class="col-sm-12 col-md-12 mt-2">
								<div>
									<p class="fs-12 font-weight-800 mb-2">{{ __('Full Name') }}: <span class="font-weight-normal ml-2">{{ $user->name }}</span></p>
									<p class="fs-12 font-weight-800 mb-2">{{ __('Email Address') }}: <span class="font-weight-normal ml-2">{{ $user->email }}</span></p>
									<p class="fs-12 font-weight-800 mb-2">{{ __('User Group') }}: <span class="font-weight-normal ml-2">{{ ucfirst($user->group) }}</span></p>
									<p class="fs-12 font-weight-800 mb-2">{{ __('Current Total Available Words') }}: <span class="font-weight-normal ml-2">{{ number_format($user->available_words + $user->available_words_prepaid) }}</span></p>
									<p class="fs-12 font-weight-800 mb-2">{{ __('Current Total Available Images') }}: <span class="font-weight-normal ml-2">{{ number_format($user->available_images + $user->available_images_prepaid) }}</span></p>
									<p class="fs-12 font-weight-800 mb-2">{{ __('Current Total Available Characters') }}: <span class="font-weight-normal ml-2">{{ number_format($user->available_chars + $user->available_chars_prepaid) }}</span></p>
									<p class="fs-12 font-weight-800 mb-2">{{ __('Current Total Available Minutes') }}: <span class="font-weight-normal ml-2">{{ number_format($user->available_minutes + $user->available_minutes_prepaid) }}</span></p>
								</div>
							</div>

							<div class="col-sm-12 col-md-12 mt-3">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12 font-weight-800"><i class="fa-solid fa-scroll-old mr-2 text-info"></i>{{ __('Type word quantity to add') }}</label>
										<input type="number" class="form-control @error('words') is-danger @enderror" value=0 name="words">
										@error('words')
											<p class="text-danger">{{ $errors->first('words') }}</p>
										@enderror									
									</div>
								</div>
							</div>

							<div class="col-sm-12 col-md-12 mt-3">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12 font-weight-800"><i class="fa-solid fa-image mr-2 text-info"></i>{{ __('Type image quantity to add for AI Image feature') }}</label>
										<input type="number" class="form-control @error('images') is-danger @enderror" value=0 name="images">
										@error('images')
											<p class="text-danger">{{ $errors->first('images') }}</p>
										@enderror									
									</div>
								</div>
							</div>

							<div class="col-sm-12 col-md-12 mt-3">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12 font-weight-800"><i class="fa-solid fa-image mr-2 text-info"></i>{{ __('Type character quantity to add for AI Voiceover feature') }}</label>
										<input type="number" class="form-control @error('chars') is-danger @enderror" value=0 name="chars">
										@error('chars')
											<p class="text-danger">{{ $errors->first('chars') }}</p>
										@enderror									
									</div>
								</div>
							</div>

							<div class="col-sm-12 col-md-12 mt-3">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12 font-weight-800"><i class="fa-solid fa-image mr-2 text-info"></i>{{ __('Type minutes quantity to add for AI Speech To Text feature') }}</label>
										<input type="number" class="form-control @error('minutes') is-danger @enderror" value=0 name="minutes">
										@error('minutes')
											<p class="text-danger">{{ $errors->first('minutes') }}</p>
										@enderror									
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer border-0 text-right pb-0 pr-0">							
							<a href="{{ route('admin.user.list') }}" class="btn btn-cancel mr-2">{{ __('Return') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
