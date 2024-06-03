@extends('layouts.app')

@section('css')
	<!-- Green Audio Player CSS -->
	<link href="{{ URL::asset('plugins/audio-player/green-audio-player.css') }}" rel="stylesheet" />
@endsection

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('View Result') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"><i class="fa-sharp fa-solid fa-waveform-lines mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('user.voiceover') }}"> {{ __('Voiceover Studio') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('View Result') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<div class="row">
		<div class="col-lg-6 col-md-6 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('View Voiceover Result') }}</h3>
				</div>
				<div class="card-body pt-5">		

					<div class="row">
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1">{{ __('Language') }}: </h6>
							<span class="fs-14">{{ $id->language }}</span>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1">{{ __('Voice Name') }}: </h6>
							<span class="fs-14">{{ $id->voice }}</span>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1">{{ __('Voice Engine') }}: </h6>
							<span class="fs-14">{{ ucfirst($id->voice_type) }}</span>
						</div>
					</div>

					<div class="row pt-5">
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1">{{ __('Characters Used') }}: </h6>
							<span class="fs-14">{{ $id->characters }}</span>
						</div>						
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1">{{ __('Gender') }}: </h6>
							<span class="fs-14">{{ $id->gender }}</span>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1">{{ __('Created On') }}: </h6>
							<span class="fs-14">{{ $id->created_at }}</span>
						</div>
						<div class="col-lg-4 col-md-4 col-12 pt-5">
							<h6 class="font-weight-bold mb-1">{{ __('Audio Format') }}: </h6>
							<span class="fs-14">{{ strtoupper($id->result_ext) }}</span>
						</div>
					</div>	

					<div class="row pt-7">
						<div class="col-12 mb-5">
							<h6 class="font-weight-bold mb-1">{{ __('Text Title') }}: </h6>
							<span class="fs-14">{{ $id->title }}</span>
						</div>
						<div class="col-12 mb-5">
							<h6 class="font-weight-bold mb-1">{{ __('Text Clean') }}: </h6>
							<span class="fs-14">{{ $id->text }}</span>
						</div>
						<div class="col-12">
							<h6 class="font-weight-bold mb-1">{{ __('Text With Effects (Raw)') }}: </h6>
							<span class="fs-14">{{ $id->text_raw }}</span>
						</div>
					</div>	

					<div class="row pt-7">
						<div class="col-12">
							<h6 class="font-weight-bold mb-3">{{ __('Audio Result') }}: </h6>
							<div id="user-result">																
								<div class="text-center user-result-player">
									<audio class="voice-audio">
										<source src="@if ($id->storage == 'local') {{ URL::asset($id->result_url) }} @else {{ $id->result_url }} @endif" type="audio/mpeg">
									</audio>	
								</div>								
							</div>
						</div>
					</div>

					<div class="row pt-4">
						<div class="col-12">
							<div class="actions-total text-right">
								<a href="mailto:?subject=Text Synthesize Result&body=@if($id->storage == 'local'){{URL::asset($id->result_url)}} @else {{$id->result_url}} @endif" class="btn actions-total-buttons" id="actions-email" data-toggle="tooltip" data-placement="top" title="Share via Email"><i class="fa fa-at"></i></a>
								<a href="https://www.facebook.com/sharer/sharer.php?u=@if($id->storage == 'local'){{URL::asset($id->result_url)}} @else {{$id->result_url}} @endif&t=Text Synthesize Result" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" class="btn actions-total-buttons" id="actions-facebook" data-toggle="tooltip" data-placement="top" title="Share in Facebook"><i class="fa-brands fa-facebook-f"></i></a>
								<a href="http://www.reddit.com/submit?url=@if($id->storage == 'local'){{URL::asset($id->result_url)}} @else {{$id->result_url}} @endif" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" class="btn actions-total-buttons" id="actions-reddit" data-toggle="tooltip" data-placement="top" title="Share in Reddit"><i class="fa-brands fa-reddit"></i></a>
								<a href="https://twitter.com/share?url=@if($id->storage == 'local'){{URL::asset($id->result_url)}} @else {{$id->result_url}} @endif&text=Text Synthesize Result" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" class="btn actions-total-buttons" id="actions-twitter" data-toggle="tooltip" data-placement="top" title="Share in Twitter"><i class="fa-brands fa-twitter"></i></a>
								<a href="" class="btn actions-total-buttons" id="actions-copy" data-link="@if($id->storage == 'local') {{ URL::asset($id->result_url) }} @else {{ $id->result_url }} @endif" data-toggle="tooltip" data-placement="top" title="Copy Download Link"><i class="fa fa-link"></i></a>	
							</div>
						</div>
					</div>

					<!-- SAVE CHANGES ACTION BUTTON -->
					<div class="border-0 text-right mb-2 mt-8">
						<a href="{{ route('user.voiceover') }}" class="btn btn-primary">{{ __('Return') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<!-- Link Share JS -->
	<script src="{{URL::asset('js/link-share.js')}}"></script>
	<!-- Green Audio Player JS -->
	<script src="{{ URL::asset('plugins/audio-player/green-audio-player.js') }}"></script>
	<script src="{{ URL::asset('js/audio-player.js') }}"></script>
@endsection
