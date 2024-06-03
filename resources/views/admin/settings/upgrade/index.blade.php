@extends('layouts.app')

@section('page-header')
	<!-- EDIT PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('Upgrade Software') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-sliders mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('General Settings') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Upgrade Software') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title">{{ config('app.name') }} {{ __('Software Upgrade') }}</h3>
				</div>
				<div class="card-body">
					<form id="upgrade-form" method="POST" action="{{ route('admin.settings.upgrade.start', ['update_id' => $latest_version['update_id'], 'version' => $latest_version['version']]) }}" enctype="multipart/form-data">
						@csrf
						
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<h6 class="fs-14 mt-2">{{ __('Current Installed Software Version') }}: <span class="text-info font-weight-bold">{{ $current_version }}</span></h6>								
								@if ($latest_version['status'])
									<div id="not-installed-info">
										<h6 class="mt-4">{{ __('New') }}<span class="text-info font-weight-bold"> {{ $latest_version['version'] }} </span> {{ __('version is available for download') }}.</h6>
										<h6><span class="text-danger fs-14 font-weight-bold">{{ __('Warning!') }} </span>{{ __('Always backup your database and script files before any upgrade') }}.</h6>
									</div>
									<div id="installed-info">
										<h6 class="text-success fs-14 font-weight-bold mt-4">{{ config('app.name') }} {{ __('was successfully updated to the latest version') }}!</h6>
									</div>
								@else
									<h6 class="text-success fs-14 font-weight-bold mt-4 mb-5">{{ __('You have the latest version installed') }}!</h6>
								@endif
								<p class="fs-14"><span class="text-danger fs-14 font-weight-bold">{{ __('Important') }}:</span> {{ __('Allways follow the instructions in the Update tab of the documentation before and after every update for additional required manual steps') }} - <a class="font-weight-bold text-primary" target="_blank" href="https://openaidavinci.textract.ai/public/documentation/">{{ __('Documentation Link') }}</a></p>
							</div>
						</div>
						<div class="card-footer text-center border-0 pb-2 pt-5">		
							<span id="processing"><img src="{{ URL::asset('/img/svgs/upgrade.svg') }}" alt=""></span>												
							<button id="upgrade" type="button" class="btn btn-primary">@if ($latest_version['status']) {{ __('Download & Install Upgrade') }} @else	{{ __('Check New Version') }} @endif</button>						
						</div>		
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script src="{{URL::asset('js/upgrade.js')}}"></script>
@endsection
