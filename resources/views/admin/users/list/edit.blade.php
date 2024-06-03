@extends('layouts.app')

@section('css')
	<!-- Telephone Input CSS -->
	<link href="{{URL::asset('plugins/telephoneinput/telephoneinput.css')}}" rel="stylesheet" >
@endsection

@section('page-header')
	<!-- EDIT PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('Edit User Information') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-id-badge mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.user.dashboard') }}"> {{ __('User Management') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.user.list') }}">{{ __('User List') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> {{ __('Edit User') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')
	<!-- EDIT USER PROFILE PAGE -->
	<div class="row">
		<div class="col-xl-9 col-lg-8 col-sm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Edit User Information') }}</h3>
				</div>
				<div class="card-body pb-0">
					<form method="POST" action="{{ route('admin.user.update', [$user->id]) }}" enctype="multipart/form-data">
						@method('PUT')
						@csrf
						<div class="row">
							<div class="col-sm-6 col-md-6">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12">{{ __('Full Name') }}</label>
										<input type="text" class="form-control @error('name') is-danger @enderror" name="name" value="{{ $user->name }}">
										@error('name')
											<p class="text-danger">{{ $errors->first('name') }}</p>
										@enderror									
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12">{{ __('Email Address') }}</label>
										<input type="email" class="form-control @error('email') is-danger @enderror" name="email" value="{{ $user->email }}">
										@error('email')
											<p class="text-danger">{{ $errors->first('email') }}</p>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12">{{ __('Job Role') }}</label>
										<input type="text" class="form-control @error('job_role') is-danger @enderror" name="job_role" value="{{ $user->job_role }}">
										@error('job_role')
											<p class="text-danger">{{ $errors->first('job_role') }}</p>
										@enderror
									</div>
								</div>
							</div>						
							<div class="col-sm-6 col-md-6">
								<div class="input-box">
									<div class="form-group">								
										<label class="form-label fs-12">{{ __('Phone Number') }}</label>
										<input type="tel" class="fs-12 form-control @error('phone_number') is-danger @enderror" id="phone-number" name="phone_number" value="{{ $user->phone_number }}">
										@error('phone_number')
											<p class="text-danger">{{ $errors->first('phone_number') }}</p>
										@enderror
									</div>
								</div>
							</div>			
							<div class="col-sm-6 col-md-6">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12">{{ __('Company Name') }}</label>
										<input type="text" class="form-control @error('company') is-danger @enderror" name="company" value="{{ $user->company }}">
										@error('company')
											<p class="text-danger">{{ $errors->first('company') }}</p>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12">{{ __('Company Website') }}</label>
										<input type="text" class="form-control @error('website') is-danger @enderror" name="website" value="{{ $user->website }}">
										@error('website')
											<p class="text-danger">{{ $errors->first('website') }}</p>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12">{{ __('Address Line') }}</label>
										<input type="text" class="form-control @error('address') is-danger @enderror" name="address" value="{{ $user->address }}">
										@error('address')
											<p class="text-danger">{{ $errors->first('address') }}</p>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-4">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12">{{ __('City') }}</label>
										<input type="text" class="form-control @error('city') is-danger @enderror" name="city" value="{{ $user->city }}">
										@error('city')
											<p class="text-danger">{{ $errors->first('city') }}</p>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12">{{ __('Postal Code') }}</label>
										<input type="text" class="form-control @error('postal_code') is-danger @enderror" name="postal_code" value="{{ $user->postal_code }}">
										@error('postal_code')
											<p class="text-danger">{{ $errors->first('postal_code') }}</p>
										@enderror
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label class="form-label fs-12">{{ __('Country') }}</label>
									<select id="user-country" name="country" data-placeholder="Select Your Country:">	
										@foreach(config('countries') as $value)
											<option value="{{ $value }}" @if($user->country == $value) selected @endif>{{ $value }}</option>
										@endforeach										
									</select>
									@error('country')
										<p class="text-danger">{{ $errors->first('country') }}</p>
									@enderror
								</div>
							</div>
						</div>
						<div class="card-footer border-0 text-right mb-2 pr-0">							
							<a href="{{ route('admin.user.list') }}" class="btn btn-cancel mr-2">{{ __('Return') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
						</div>
					</form>
				</div>				
			</div>
		</div>
		<div class="col-xl-3 col-lg-4 col-sm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Edit User Settings') }}</h3>
				</div>
				<div class="card-body">
					<form method="POST" action="{{ route('admin.user.change', [$user->id]) }}" enctype="multipart/form-data">
						@method('PUT')
						@csrf
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<div class="form-group">
									<label class="form-label fs-12">{{ __('User Status') }}</label>
									<select id="user-status" name="status" data-placeholder="{{ __('Select User Status') }}">	
										<option value="pending" {{ ($user->status == 'pending') ? 'selected' : '' }}>{{ __('Pending') }}</option>
										<option value="active" {{ ($user->status == 'active') ? 'selected' : '' }}>{{ __('Active') }}</option>
										<option value="suspended" {{ ($user->status == 'suspended') ? 'selected' : '' }}>{{ __('Suspended') }}</option>
										<option value="deactivated" {{ ($user->status == 'deactivated') ? 'selected' : '' }}>{{ __('Deactivated') }}</option>																		
									</select>
									@error('status')
										<p class="text-danger">{{ $errors->first('status') }}</p>
									@enderror
								</div>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="form-group">
									<label class="form-label fs-12">{{ __('User Group') }}</label>
									<select id="user-group" name="group" data-placeholder="{{ __('Select User Group') }}">	
										<option value="user" {{ ($user->group == 'user') ? 'selected' : '' }}>{{ __('User') }}</option>
										<option value="subscriber" {{ ($user->group == 'subscriber') ? 'selected' : '' }}>{{ __('Subscriber') }}</option>
										<option value="admin" {{ ($user->group == 'admin') ? 'selected' : '' }}>{{ __('Administrator') }}</option>																		
									</select>
									@error('group')
										<p class="text-danger">{{ $errors->first('group') }}</p>
									@enderror
								</div>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="form-group">
									<label class="form-label fs-12">{{ __('2FA Authentication') }}</label>
									<select id="2fa-status" name="twoFactor_status" data-placeholder="{{ __('Disable 2FA Authentication') }}">	
										<option value=1 {{ ($user->google2fa_enabled == true) ? 'selected' : '' }}>{{ __('Enabled') }}</option>
										<option value=0 {{ ($user->google2fa_enabled == false) ? 'selected' : '' }}>{{ __('Disabled') }}</option>																		
									</select>
									@error('group')
										<p class="text-danger">{{ $errors->first('group') }}</p>
									@enderror
								</div>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12">{{ __('New Password') }}</label>
										<input type="password" class="form-control @error('new-password') is-danger @enderror" name="password">
										@error('password')
											<p class="text-danger">{{ $errors->first('password') }}</p>
										@enderror									
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-12">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12">{{ __('Confirm New Password') }}</label>
										<input type="password" class="form-control @error('password_confirmation') is-danger @enderror" name="password_confirmation">
										@error('password_confirmation')
											<p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
										@enderror									
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer border-0 text-right pb-0 pr-0">							
							<a href="{{ route('admin.user.list') }}" class="btn btn-cancel mr-2">{{ __('Return') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('Change') }}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- EDIT USER PROFILE PAGE -->
@endsection

@section('js')
	<!-- Telephone Input JS -->
	<script src="{{URL::asset('plugins/telephoneinput/telephoneinput.js')}}"></script>
	<script>
		$(function() {
			"use strict";
			
			$("#phone-number").intlTelInput();
		});
	</script>
@endsection