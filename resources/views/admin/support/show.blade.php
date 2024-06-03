@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('User Support Request') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa-solid fa-message-question mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.support') }}"> {{ __('Support Requests') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Support Request Details') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<!-- SUPPORT REQUEST -->
	<div class="row">
		<div class="col-lg-9 col-md-9 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header p-4 pl-5 block">
					<p class="card-title mb-4">{{ __('Ticket Subject') }}: <span class="text-info">{{ $ticket->subject }}</span></p>
					<p class="card-title">{{ __('Ticket') }} ID: <span class="text-info">{{ $ticket->ticket_id }}</span></p>
					<span class="cell-box fs-14 support-header support-{{ strtolower($ticket->status) }}">{{ $ticket->status }}</span>
				</div>
				<div class="card-body pt-5">	
					<div class="row">	
						<div class="background-color p-4" id="support-messages-box">
							@foreach ($messages as $message)
								@if ($message->role != 'admin')
									<div class="background-white support-message mb-5">
										<p class="font-weight-bold fs-11"><i class="fa-sharp fa-solid fa-calendar-clock mr-2"></i>{{ date_format($message->created_at, 'd M Y H:i A') }} <span>{{ __('Your Message') }}</span></p>
										<p class="fs-14 mb-1">{{ $message->message }}</p>
										@if ($message->attachment)
											<p class="font-weight-bold fs-11 mb-1">{{ __('Attachment') }}</p>
											<a class="font-weight-bold fs-11 text-primary" href="{{ URL::asset($message->attachment) }}">{{ __('View Attached Image') }}</a>
										@endif										
									</div>
								@else
									<div class="background-white support-message support-response mb-5">
										<p class="font-weight-bold fs-11"><i class="fa-sharp fa-solid fa-calendar-clock mr-2"></i>{{ date_format($message->created_at, 'd M Y H:i A') }} <span class="text-primary">{{ __('Admin Response') }}</span></p>
										<p class="fs-14 mb-1">{{ $message->message }}</p>
										@if ($message->attachment)
											<p class="font-weight-bold fs-11 mt-3 mb-1">{{ __('Attachment') }}</p>
											<a class="font-weight-bold fs-11 text-primary" href="{{ URL::asset($message->attachment) }}">{{ __('View Attached Image') }}</a>
										@endif	
									</div>
								@endif
								
							@endforeach						
						</div>
					</div>

					<form id="" action="{{ route('admin.support.response', ['ticket_id' => $ticket->ticket_id]) }}" method="post" enctype="multipart/form-data">
						@csrf

						<div class="row pt-5">
							<div class="col-lg-12 col-md-12 col-sm-12">				
								<div class="input-box">	
									<h6 class="font-weight-bold">{{ __('Ticket Status') }}: <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<select id="response-status" name="response-status" data-placeholder="{{ __('Select Ticket Status') }}:">			
										<option value="Pending" selected>{{ __('Pending') }}</option>
										<option value="Replied">{{ __('Replied') }}</option>
										<option value="Resolved">{{ __('Resolved') }}</option>										
										<option value="Closed">{{ __('Closed') }}</option>
									</select>
								</div> 							
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								
								<div class="input-box">
									<h6 class="font-weight-bold">{{ __('Response') }} : <span class="text-required"><i class="fa-solid fa-asterisk"></i></h6>
									<textarea class="form-control" name="message" id="reply" rows="6" placeholder="Enter your reply message here..."></textarea> 
								</div>	

								<div class="input-box">
									<h6 class="font-weight-bold">{{ __('Attach File') }}</h6>
									<div class="input-group file-browser">									
										<input type="text" class="form-control border-right-0 browse-file" placeholder="Include attachment file..." style="margin-right: 80px;" readonly>
										<label class="input-group-btn">
											<span class="btn btn-primary special-btn">
												{{ __('Browse') }} <input type="file" name="attachment" style="display: none;">
											</span>
										</label>
									</div>	
									<span class="text-muted fs-10">{{ __('JPG | JPEG | PNG | Max 5MB') }}</span>
									@error('attachment')
										<p class="text-danger">{{ $errors->first('attachment') }}</p>
									@enderror
								</div>					
							</div>

							<div class="col-12 text-center">
								<!-- SAVE CHANGES ACTION BUTTON -->
								<div class="border-0 mb-2">
									<a href="{{ route('admin.support') }}" class="btn btn-cancel mr-2">{{ __('Return') }}</a>
									<button type="submit" class="btn btn-primary">{{ __('Reply') }}</button>	
								</div>
							</div>							
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

