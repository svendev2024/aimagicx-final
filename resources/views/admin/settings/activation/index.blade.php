@extends('layouts.app')

@section('page-header')
	<!-- EDIT PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('Activation') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-sliders mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('General Settings') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Activation') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')
	<div class="row">
		<div class="col-xl-5 col-lg-5 col-sm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title">{{__('License Activation') }}: @if ($notification) <span class="text-success">{{ __('Activated') }}</span> @else <span class="text-danger">{{ __('Not Activated') }}</span>@endif</h3>
				</div>
				<div class="card-body">
					<form method="POST" action="{{ route('admin.settings.activation.store') }}" enctype="multipart/form-data">
						@csrf
						
						<div class="row">

							<div class="col-sm-12 col-md-12 mb-6">
								<div>
									<h6 class="fs-12 font-weight-bold">{{ __('Important') }}:</h6>
									<span class="fs-12 mb-2"><i class="mdi mdi-alert-circle mr-2 text-danger"></i>{{ __('License is valid for only one installation and is strictly bounded with your domain name') }}</span><br>
									<span class="fs-12 mb-2"><i class="mdi mdi-alert-circle mr-2 text-danger"></i>{{ __('Upon change of your domain name, deactivate the license first') }}</span><br>
									<span class="fs-12 mb-2"><i class="mdi mdi-alert-circle mr-2 text-danger"></i>{{ __('Deactivation of license does not affect the integrity of your database at all') }}</span><br>
									<span class="fs-12 mb-2"><i class="mdi mdi-alert-circle mr-2 text-danger"></i>{{ __('If you will have any questions you can refer to the documentation or create a support ticket') }}</span>
								</div>
							</div>

							<div class="col-sm-12 col-md-12">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12">{{ __('Enter Activation License') }}</label>
										<input type="text" class="form-control @error('license') is-danger @enderror" name="license" value="{{ $information['license'] }}" required>
										@error('license')
											<p class="text-danger">{{ $errors->first('license') }}</p>
										@enderror									
									</div>
								</div>
							</div>

							<div class="col-sm-12 col-md-12">
								<div class="input-box mb-1">
									<div class="form-group mb-1">
										<label class="form-label fs-12">{{ __('Enter Envato Username') }}</label>
										<input type="text" class="form-control @error('username') is-danger @enderror" name="username" value="{{ $information['username'] }}" required>
										@error('username')
											<p class="text-danger">{{ $errors->first('username') }}</p>
										@enderror									
									</div>
								</div>
								@if ($notification) <span class="text-success fs-12">{{ __('Congratulations! Application Successfully Activated!') }}</span> @else <span class="text-danger fs-12">{{ __('Application is Not Activated') }}.</span>@endif
							</div>
						</div>
						<div class="card-footer border-0 text-right pb-2 pt-2 pr-0">							
							<a href="{{ route('admin.dashboard') }}" class="btn btn-cancel mr-2">{{ __('Cancel') }}</a>
							@if (!$notification)
								<button type="submit" class="btn btn-primary">{{ __('Activate') }}</button>						
							@else
								<a class="btn btn-primary" id="deactivateButton" data-toggle="modal" data-target="#deleteModal" href="" data-attr={{ route("admin.settings.activation.remove")}}>{{ __('Deactivate') }}</a>
							@endif							
						</div>		
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!-- MODAL -->
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-circle-outline color-red"></i> {{ __('Confirm License Code Deletion') }}</h4>
					<button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="deleteModalBody">
					<div>
						<!-- DELETE CONFIRMATION -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END MODAL -->
@endsection

@section('js')
	<script type="text/javascript">
		$(function () {

			"use strict";

			// DELETE CONFIRMATION MODAL
			$(document).on('click', '#deactivateButton', function(event) {
				event.preventDefault();
				let href = $(this).attr('data-attr');
				$.ajax({
					url: href
					, beforeSend: function() {
						$('#loader').show();
					},
					// return the result
					success: function(result) {
						$('#deleteModal').modal("show");
						$('#deleteModalBody').html(result).show();
					}
					, error: function(jqXHR, testStatus, error) {
						console.log(error);
						alert("Page " + href + " cannot open. Error:" + error);
						$('#loader').hide();
					}
					, timeout: 8000
				})
			});
	
		});
	</script>
@endsection
