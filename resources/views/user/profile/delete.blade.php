@extends('layouts.app')

@section('css')
	<!-- Telephone Input CSS -->
	<link href="{{URL::asset('plugins/telephoneinput/telephoneinput.css')}}" rel="stylesheet" >
@endsection

@section('page-header')
	<!-- EDIT PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('Delete Account') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"><i class="fa-solid fa-id-badge mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{route('user.profile')}}"> {{ __('My Profile') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Delete Account') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')
	<!-- EDIT USER PROFILE PAGE -->
	<div class="row">
		<div class="col-xl-3 col-lg-4 col-sm-12">
			<div class="card border-0" id="dashboard-background">
				<div class="widget-user-image overflow-hidden mx-auto mt-5"><img alt="User Avatar" class="rounded-circle" src="@if(auth()->user()->profile_photo_path){{ asset(auth()->user()->profile_photo_path) }} @else {{ URL::asset('img/users/avatar.jpg') }} @endif"></div>
				<div class="card-body text-center">
					<div>
						<h4 class="mb-1 mt-1 font-weight-bold text-primary fs-16">{{ auth()->user()->name }}</h4>
						<h6 class="fotn-weight-bold fs-12">{{ auth()->user()->job_role }}</h6>
					</div>
				</div>
				<div class="card-footer p-0">
					<div class="row">
						<div class="col-sm-12">
							<div class="text-center p-4">
								<div class="d-flex w-100">
									<div class="flex w-100">
										<div class="flex w-100">
											<h4 class="mb-3 mt-1 font-weight-800 text-primary fs-16">{{ App\Services\HelperService::userAvailableWords() }} / {{ App\Services\HelperService::userPlanTotalWords() }}</h4>
											<h6 class="fs-12">{{ __('Words Left') }}</h6>
										</div>
										<div class="flex w-100 mt-4">
											<h4 class="mb-3 mt-1 font-weight-800 text-primary fs-16">{{ App\Services\HelperService::userAvailableImages() }} / {{ App\Services\HelperService::userPlanTotalImages() }}</h4>
											<h6 class="fs-12">{{ __('Images Left') }}</h6>
										</div>
									</div>
									<div class="flex w-100">
										<div class="flex w-100">
											<h4 class="mb-3 mt-1 font-weight-800 text-primary fs-16">{{ App\Services\HelperService::userAvailableChars() }} / {{ App\Services\HelperService::userPlanTotalChars() }}</h4>
											<h6 class="fs-12">{{ __('Characters Left') }}</h6>
										</div>
										<div class="flex w-100 mt-4">
											<h4 class="mb-3 mt-1 font-weight-800 text-primary fs-16">{{ App\Services\HelperService::userAvailableMinutes() }} / {{ App\Services\HelperService::userPlanTotalMinutes() }}</h4>
											<h6 class="fs-12">{{ __('Minutes Left') }}</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer p-0">
					<div class="row" id="profile-pages">
						<div class="col-sm-12">
							<div class="text-center pt-4">
								<a href="{{ route('user.profile') }}" class="fs-13"><i class="fa fa-user-shield mr-1"></i> {{ __('View Profile') }}</a>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="text-center pt-3">
								<a href="{{ route('user.profile.defaults') }}" class="fs-13"><i class="fa-sharp fa-solid fa-sliders mr-1"></i> {{ __('Set Defaults') }}</a>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="text-center p-3 ">
								<a href="{{ route('user.security') }}" class="fs-13"><i class="fa fa-lock-hashtag mr-1"></i> {{ __('Change Password') }}</a>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="text-center pb-4">
								<a href="{{ route('user.security.2fa') }}" class="fs-13"><i class="fa fa-shield-check mr-1"></i> {{ __('2FA Authentication') }}</a>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="text-center pb-4">
								<a href="{{ route('user.profile.delete') }}" class="fs-13 text-primary"><i class="fa fa-user-xmark mr-1"></i> {{ __('Delete Account') }}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-9 col-lg-8 col-sm-12">
			<form method="POST" class="w-100" action="{{ route('user.profile.delete.account', [auth()->user()->id]) }}" enctype="multipart/form-data">
				@csrf

				<div class="card border-0">
					<div class="card-header">
						<h3 class="card-title"><i class="fa-sharp fa-solid fa-user-xmark mr-2 text-danger"></i>{{ __('Delete Account') }}</h3>
					</div>
					<div class="card-body pb-0">					
						<div class="row">
							<div class="col-sm-12">
								<h6 class="text-danger fs-13">{{ __('Warning') }}!</h6> <h6 class="fs-13">{{ __('This will fully delete all your account details, generated results and you will not be able to recover your account afterwards') }}</h6>
							</div>
						
							<div class="col-sm-12 mt-2">
								<div id="audio-format" role="radiogroup">
									<span  id="webm-format">							
										<div class="radio-control">
											<input type="checkbox" name="concent" class="input-control fs-13" id="concent">
											<label for="concent" class="label-control fs-13" id="concent-label">{{ __('I confirm that I would like to completely delete by account on this platform') }}</label>
										</div>	
									</span>										
								</div>
							</div>
							
						</div>
						<div class="card-footer border-0 text-center mb-2 pr-0">
							<button type="submit" class="btn btn-primary" style="background:red; border-color:red">{{ __('Yes, Delete My Account') }}</button>							
						</div>					
					</div>				
				</div>
			</form>
		</div>
	</div>
	<!-- EDIT USER PROFILE PAGE --> 
@endsection
