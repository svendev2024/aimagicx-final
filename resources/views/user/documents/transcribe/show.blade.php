@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('View Result') }}</h4>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"><i class="fa-solid fa-folder-bookmark mr-2 fs-12"></i>{{ __('AI Panel') }}</a></li>
				<li class="breadcrumb-item"><a href="{{route('user.documents')}}"> {{ __('Documents') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('All Transcripts') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ url('#') }}"> {{ __('View Result') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="card border-0">
				<div class="card-header">
					<span id="" class="text-muted card-title-inner text-left">{{ __('Task Type') }}: <span class="text-info">{{ $task_type }}</span></span>
					<span id="create-category" class="card-title-inner text-muted">{{ __('File Name') }}: <span class="text-info">{{ $id->file_name }}</span></span>
				</div>
				<div class="card-body pt-5 pb-5">
					<div class="row">
						<div class="col-sm-12">
							<div id="waveform"></div>
							<div id="wave-timeline"></div>
						</div>
						<div class="col-sm-12 text-center">
							<div id="controls" class="mt-5">
								<img src="{{ URL::asset('/img/svgs/controls/unmute.svg') }}" class="control-button-left mr-2" id="muteBtn" alt="">
								<img src="{{ URL::asset('/img/svgs/controls/left.svg') }}" class="control-button mr-2" id="backwardBtn" alt="">
								<img src="{{ URL::asset('/img/svgs/controls/play.svg') }}" class="control-button mr-2" id="playBtn" alt="">
								<img src="{{ URL::asset('/img/svgs/controls/stop.svg') }}" class="control-button mr-2" id="stopBtn" alt="">
								<img src="{{ URL::asset('/img/svgs/controls/right.svg') }}" class="control-button mr-2" id="forwardBtn" alt="">

								<button data-toggle="tooltip" data-placement="top" title="Download Transcript Results" class="btn btn-primary control-button-right" id="download-now">{{ __('Download') }}</button>	
								<a href="{{ route('user.documents.transcripts') }}" class="btn btn-primary pl-5 pr-5 mr-2 control-button-right">{{ __('Return') }}</a>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-sm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-body pt-4 pb-5">
					<h6 class="mb-3 fs-12 text-primary font-weight-bold">{{ $id->speech_type }}</h6>
					<div class="row">
						<div class="col-sm-12">
							<div class="outer-box">
								<table id="transcript-table" class="table table-hover">
									<thead>
									  <tr>
										<th scope="col" class="transcript-table-column" width="20%">{{ __('Timeframe') }}</th>
										<th scope="col" class="transcript-table-column" width="80%">{{ __('Transcript') }}</th>
									  </tr>
									</thead>
									<tbody>
										<tr><td><span class="text-muted ml-3 fs-10 font-weight-bold">{{ $time }}</span> <br> <span class="text-muted ml-3 fs-10 font-weight-bold">{{ $id->words }} {{ __('words') }}</span></td><td> <span id="transcript-result"></span> </td></tr>
									</tbody>
								</table>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script src="{{ URL::asset('plugins/wavesurfer/wavesurfer.js') }}"></script>
	<script src="{{ URL::asset('plugins/wavesurfer/wavesurfer.cursor.min.js') }}"></script>
	<script src="{{ URL::asset('plugins/wavesurfer/wavesurfer.timeline.min.js') }}"></script>
	<script type="text/javascript">
		let final_text;
		$(function() {

			"use strict";

			 let playBtn = document.getElementById('playBtn');
			 let stopBtn = document.getElementById('stopBtn');
			 let forwardBtn = document.getElementById('forwardBtn');
			 let backwardBtn = document.getElementById('backwardBtn');
			 let muteBtn = document.getElementById('muteBtn');
			 let settingsBtn = document.getElementById('settingsBtn');

			 let wavesurfer = WaveSurfer.create({
				container: '#waveform',
				waveColor: '#ff9d00',
				progressColor: '#1e1e2d',
				selectionColor: '#d0e9c6',
				backgroundColor: '#F5F9FC',
				barWidth: 2,
				barHeight: 1.7,
				barMinHeight: 1,
				height: 100,
				responsive: true,				
				barRadius: 1,
				plugins: [
					WaveSurfer.timeline.create({
						container: "#wave-timeline"
					}),
					WaveSurfer.cursor.create({
						showTime: true,
						opacity: 1,
						customShowTimeStyle: {
							'background-color': '#000',
							color: '#fff',
							padding: '2px',
							'font-size': '10px'
						}
					}),
				]
			});

			let url = JSON.parse(`<?php echo $data['url']; ?>`);
			wavesurfer.load(url);

			playBtn.onclick = function() {
				wavesurfer.playPause();
				if (playBtn.src.includes('play.svg')) {
					playBtn.src = '/img/svgs/controls/pause.svg';
				} else {
					playBtn.src = '/img/svgs/controls/play.svg';
				}
			}

			stopBtn.onclick = function() {
				wavesurfer.stop();	
				playBtn.src = '/img/svgs/controls/play.svg';
			}

			forwardBtn.onclick = function() {
				wavesurfer.skipForward(5);	
			}

			backwardBtn.onclick = function() {
				wavesurfer.skipBackward(5);	
			}

			muteBtn.onclick = function() {
				wavesurfer.toggleMute();
				if (muteBtn.src.includes('unmute.svg')) {
					muteBtn.src = '/img/svgs/controls/mute.svg';
				} else {
					muteBtn.src = '/img/svgs/controls/unmute.svg';
				}	
			}

			wavesurfer.on('finish', function() {
				playBtn.src = '/img/svgs/controls/play.svg';
				wavesurfer.stop();	
			});

			final_text = JSON.parse(`<?php echo $data['text']; ?>`);
			$('#transcript-result').text(final_text);
			 
		});

		
		$('#download-now').on('click', function(e) {

			e.preventDefault();

			let d = new Date();
			let date = ("0" + d.getDate()).slice(-2) + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" + d.getFullYear();

			let text = final_text;
			let blob = new Blob([text], { type: "text/plain"});
			let anchor = document.createElement("a");
			anchor.download = date + "-transcribe-result.txt";
			anchor.href = window.URL.createObjectURL(blob);
			anchor.target ="_blank";
			anchor.style.display = "none"; // just to be safe!
			document.body.appendChild(anchor);
			anchor.click();
			document.body.removeChild(anchor);

		});
	</script>
@endsection
