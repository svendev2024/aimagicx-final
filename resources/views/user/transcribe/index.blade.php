@extends('layouts.app')
@section('css')
	<!-- Sweet Alert CSS -->
	<link href="{{URL::asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" />
	<!-- RichText CSS -->
	<link href="{{URL::asset('plugins/richtext/richtext.min.css')}}" rel="stylesheet" />
	<!-- FilePond CSS -->
	<link href="{{URL::asset('plugins/filepond/filepond.css')}}" rel="stylesheet" />
	<!-- Green Audio Players CSS -->
	<link href="{{ URL::asset('plugins/audio-player/green-audio-player.css') }}" rel="stylesheet" />
@endsection

@section('content')

<form id="openai-form" action="" method="post" enctype="multipart/form-data" class="mt-24">		
	@csrf
	<div class="row">	
		<div class="col-lg-4 col-md-12 col-sm-12">
			<div class="card border-0" id="template-input">
				<div class="card-body p-5 pb-0">

					<div class="row">
						<div class="template-view">
							<div class="template-icon mb-2 d-flex">
								<div>
									<i class="fa-solid fa-folder-music blog-icon"></i>
								</div>
								<div>
									<h6 class="mt-1 ml-3 fs-16 number-font">{{ __('AI Speech to Text') }}</h6>
								</div>									
							</div>								
							<div class="template-info">
								<p class="fs-12 text-muted mb-4">{{ __('Transcribe your audio files and translate them to English') }}</p>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div class="text-left mb-5" id="balance-status">
								<span class="fs-11 text-muted pl-3"><i class="fa-sharp fa-solid fa-bolt-lightning mr-2 text-primary"></i>{{ __('Your Balance is') }} <span class="font-weight-semibold" id="balance-number">{{ number_format(auth()->user()->available_minutes + auth()->user()->available_minutes_prepaid) }}</span> {{ __('Minutes') }}</span>
							</div>							
						</div>	
						<div class="col-sm-12">								
							<!-- DRAG & DROP FILES -->
							<div class="select-file mb-4">
								<input type="file" name="filepond" id="filepond" class="filepond" required  />	
							</div>	
						</div>
						<div class="col-sm-12">								
							<div class="input-box">	
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Audio Description') }}  <span class="text-muted">({{ __('Optional') }})</span></h6>									
								<div class="form-group">						    
									<textarea rows="3" cols="10" type="text" class="form-control" id="description" name="description" placeholder="{{ __('Describe the speech from the file uploaded above to help the AI') }}"></textarea>
								</div> 
							</div> 
						</div>
						<div class="col-sm-12">
							<div class="form-group">	
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Audio Language') }} <span class="text-muted">({{ __('Optional') }})</span></h6>								
								<select id="language" name="language" data-placeholder="{{ __('Specify Audio language') }}">
									<option value="" selected> {{ __('Auto Detect') }}</option>							
									<option value="af" data-img="/img/flags/za.svg"> {{ __('Afrikaans') }}</option>							
									<option value="ar" data-img="/img/flags/ae.svg"> {{ __('Arabic') }}</option>							
									<option value="hy" data-img="/img/flags/am.svg"> {{ __('Armenian') }}</option>							
									<option value="az" data-img="/img/flags/az.svg"> {{ __('Azerbaijani') }}</option>							
									<option value="be" data-img="/img/flags/by.svg"> {{ __('Belarusian') }}</option>							
									<option value="bs" data-img="/img/flags/ba.svg"> {{ __('Bosnian') }}</option>							
									<option value="bg" data-img="/img/flags/bg.svg"> {{ __('Bulgarian') }}</option>							
									<option value="ca" data-img="/img/flags/es.svg"> {{ __('Catalan') }}</option>							
									<option value="zh" data-img="/img/flags/cn.svg"> {{ __('Chinese') }}</option>							
									<option value="hr" data-img="/img/flags/hr.svg"> {{ __('Croatian') }}</option>							
									<option value="cs" data-img="/img/flags/cz.svg"> {{ __('Czech') }}</option>							
									<option value="da" data-img="/img/flags/dk.svg"> {{ __('Danish') }}</option>							
									<option value="nl" data-img="/img/flags/nl.svg"> {{ __('Dutch') }}</option>							
									<option value="en" data-img="/img/flags/us.svg"> {{ __('English') }}</option>							
									<option value="et" data-img="/img/flags/ee.svg"> {{ __('Estonian') }}</option>							
									<option value="fi" data-img="/img/flags/fi.svg"> {{ __('Finnish') }}</option>							
									<option value="fr" data-img="/img/flags/fr.svg"> {{ __('French') }}</option>							
									<option value="gl" data-img="/img/flags/es.svg"> {{ __('Galician') }}</option>							
									<option value="de" data-img="/img/flags/de.svg"> {{ __('German') }}</option>							
									<option value="el" data-img="/img/flags/gr.svg"> {{ __('Greek') }}</option>							
									<option value="he" data-img="/img/flags/il.svg"> {{ __('Hebrew') }}</option>							
									<option value="hi" data-img="/img/flags/in.svg"> {{ __('Hindi') }}</option>							
									<option value="hu" data-img="/img/flags/hu.svg"> {{ __('Hungarian') }}</option>							
									<option value="is" data-img="/img/flags/is.svg"> {{ __('Icelandic') }}</option>							
									<option value="id" data-img="/img/flags/id.svg"> {{ __('Indonesian') }}</option>							
									<option value="it" data-img="/img/flags/it.svg"> {{ __('Italian') }}</option>							
									<option value="ja" data-img="/img/flags/jp.svg"> {{ __('Japanese') }}</option>							
									<option value="kn" data-img="/img/flags/in.svg"> {{ __('Kannada') }}</option>							
									<option value="kk" data-img="/img/flags/kz.svg"> {{ __('Kazakh') }}</option>							
									<option value="ko" data-img="/img/flags/kr.svg"> {{ __('Korean') }}</option>							
									<option value="lv" data-img="/img/flags/lv.svg"> {{ __('Latvian') }}</option>							
									<option value="lt" data-img="/img/flags/lt.svg"> {{ __('Lithuanian') }}</option>							
									<option value="mk" data-img="/img/flags/mk.svg"> {{ __('Macedonian') }}</option>							
									<option value="ms" data-img="/img/flags/my.svg"> {{ __('Malay') }}</option>							
									<option value="mr" data-img="/img/flags/in.svg"> {{ __('Marathi') }}</option>							
									<option value="mi" data-img="/img/flags/nz.svg"> {{ __('Maori') }}</option>							
									<option value="ne" data-img="/img/flags/np.svg"> {{ __('Nepali') }}</option>							
									<option value="no" data-img="/img/flags/no.svg"> {{ __('Norwegian') }}</option>							
									<option value="fa" data-img="/img/flags/ir.svg"> {{ __('Persian') }}</option>							
									<option value="pl" data-img="/img/flags/pl.svg"> {{ __('Polish') }}</option>							
									<option value="pt" data-img="/img/flags/pt.svg"> {{ __('Portuguese') }}</option>							
									<option value="ro" data-img="/img/flags/ro.svg"> {{ __('Romanian') }}</option>							
									<option value="ru" data-img="/img/flags/ru.svg"> {{ __('Russian') }}</option>							
									<option value="sr" data-img="/img/flags/rs.svg"> {{ __('Serbian') }}</option>							
									<option value="sk" data-img="/img/flags/sk.svg"> {{ __('Slovak') }}</option>							
									<option value="sl" data-img="/img/flags/si.svg"> {{ __('Slovenian') }}</option>							
									<option value="es" data-img="/img/flags/es.svg"> {{ __('Spanish') }}</option>							
									<option value="sw" data-img="/img/flags/ke.svg"> {{ __('Swahili') }}</option>							
									<option value="sv" data-img="/img/flags/se.svg"> {{ __('Swedish') }}</option>							
									<option value="tl" data-img="/img/flags/ph.svg"> {{ __('Tagalog') }}</option>							
									<option value="ta" data-img="/img/flags/in.svg"> {{ __('Tamil') }}</option>							
									<option value="th" data-img="/img/flags/th.svg"> {{ __('Thai') }}</option>							
									<option value="tr" data-img="/img/flags/tr.svg"> {{ __('Turkish') }}</option>							
									<option value="uk" data-img="/img/flags/ua.svg"> {{ __('Ukrainian') }}</option>							
									<option value="ur" data-img="/img/flags/in.svg"> {{ __('Urdu') }}</option>							
									<option value="vi" data-img="/img/flags/vn.svg"> {{ __('Vietnamese') }}</option>							
									<option value="cy" data-img="/img/flags/gb-wls.svg"> {{ __('Welsh') }}</option>							
								</select>
								@error('language')
									<p class="text-danger">{{ $errors->first('language') }}</p>
								@enderror	
							</div>
						</div>
						<div class="col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Task Type') }} <span class="text-muted">({{ __('Optional') }})</span></h6>
								<select id="creativity" name="task" data-placeholder="{{ __('Specify Task Type') }}">
									<option value='transcribe' selected>{{ __('Transcribe Audio File') }}</option>
									<option value='translate'> {{ __('Generate Transcription in English') }}</option>																																																													
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Workbook') }} <span class="text-muted">({{ __('Optional') }})</span></h6>
								<select id="project" name="project" data-placeholder="{{ __('Select Workbook Name') }}">	
									<option value="all"> {{ __('All Workbooks') }}</option>
									@foreach ($projects as $project)
										<option value="{{ $project->name }}" @if (strtolower(auth()->user()->project) == strtolower($project->name)) selected @endif> {{ ucfirst($project->name) }}</option>
									@endforeach											
								</select>
							</div>								
						</div>
					</div>						

					<div class="card-footer border-0 text-center p-0">
						<div class="w-100 pt-2 pb-2">
							<div class="text-center">
								<span id="processing" class="processing-image"><img src="{{ URL::asset('/img/svgs/upgrade.svg') }}" alt=""></span>
								<button type="submit" name="submit" class="btn btn-primary  pl-7 pr-7 fs-11 pt-2 pb-2" id="generate">{{ __('Transcribe') }}</button>
							</div>
						</div>							
					</div>	
			
				</div>
			</div>			
		</div>

		<div class="col-lg-8 col-md-12 col-sm-12">
			<div class="card border-0">
				<div class="card-body pb-2">
					<div class="row">						
						<div class="col-lg-4 col-md-12 col-sm-12">								
							<div class="input-box mb-2">								
								<div class="form-group">							    
									<input type="text" class="form-control @error('document') is-danger @enderror" id="document" name="document" value="{{ __('Audio File') }}">
									@error('document')
										<p class="text-danger">{{ $errors->first('document') }}</p>
									@enderror
								</div> 
							</div> 
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12">
							<div class="d-flex" id="template-buttons-group">	
								<div>
									<a id="export-word" class="template-button mr-2" onclick="exportWord();" href="#"><i class="fa-solid fa-file-word table-action-buttons table-action-buttons-big view-action-button" data-tippy-content="{{ __('Export as Word Document') }}"></i></a>
								</div>	
								<div>
									<a id="export-txt" class="template-button mr-2" onclick="exportTXT();" href="#"><i class="fa-solid fa-file-lines table-action-buttons table-action-buttons-big view-action-button" data-tippy-content="{{ __('Download as Text File') }}"></i></a>
								</div>	
								<div>
									<a id="copy-button" class="template-button mr-2" onclick="copyText();" href="#"><i class="fa-solid fa-copy table-action-buttons table-action-buttons-big edit-action-button" data-tippy-content="{{ __('Copy Transcript') }}"></i></a>
								</div>
								<div>
									<a id="save-button" class="template-button" onclick="return saveText(this);" href="#"><i class="fa-solid fa-floppy-disk-pen table-action-buttons table-action-buttons-big delete-action-button" data-tippy-content="{{ __('Save Transcript') }}"></i></a>
								</div>					
							</div>
						</div>
					</div>

					<div class="row">
						<div class="mt-5 text-center" id="waveform-box">      
							<div class="row">
								<div class="col-sm-12">
									<div id="waveform">
										<audio style="display:none" id="media-element" src="" type=""></audio>
									</div> 
									<div id="wave-timeline"></div>
								</div>
								<div class="col-sm-12">
									<div id="controls" class="mt-4 mb-3">
										<a id="backwardBtn" class="result-play result-play-sm mr-2"><i class="fa fa-backward"></i></a>
										<a id="playBtn" class="result-play result-play-sm mr-2"><i class="fa fa-play"></i></a>
										<a id="stopBtn" class="result-play result-play-sm mr-2"><i class="fa fa-stop"></i></a>
										<a id="forwardBtn" class="result-play result-play-sm mr-2"><i class="fa fa-forward"></i></a>														
									</div> 
								</div>
							</div>                                            
						</div>
					</div>
				</div>
			</div>

			<div class="card border-0" id="template-output-transcript">
				<div class="card-body">
					<div>						
						<div id="template-textarea">						
							<div class="form-control" name="content" rows="12" id="richtext"></div>
						</div>	

						<div id="generating-message" class="text-muted"><span>{{ __('Transcribe your audio file easily') }}</span></div>	

						<div id="generating-status" class="text-muted text-center">
							<p class="mb-2">{{ __('Transcribing the audio file, please wait') }}</p>
							<img src='{{ URL::asset("/img/svgs/code.svg") }}'>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection

@section('js')
<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
<script src="{{URL::asset('plugins/richtext/jquery.richtext.min.js')}}"></script>
<script src="{{URL::asset('plugins/character-count/jquery-simple-txt-counter.min.js')}}"></script>
<script src="{{URL::asset('js/export.js')}}"></script>
<!-- FilePond JS -->
<script src={{ URL::asset('plugins/filepond/filepond-plugin-file-validate-size.min.js') }}></script>
<script src={{ URL::asset('plugins/filepond/filepond-plugin-file-validate-type.min.js') }}></script>
<script src={{ URL::asset('plugins/filepond/filepond.min.js') }}></script>
<!-- Green Audio Players JS -->
<script src="{{ URL::asset('plugins/audio-player/green-audio-player.js') }}"></script>
<script src="{{ URL::asset('js/audio-player.js') }}"></script>
<script src="{{ URL::asset('js/wavesurfer.min.js') }}"></script>
<script src="{{ URL::asset('plugins/wavesurfer/wavesurfer.cursor.min.js') }}"></script>
<script src="{{ URL::asset('plugins/wavesurfer/wavesurfer.timeline.min.js') }}"></script>
<script type="text/javascript">

	$(function () {

		"use strict";
		
		$('#richtext').richText({

			// text formatting
			bold: true,
			italic: true,
			underline: true,

			// text alignment
			leftAlign: true,
			centerAlign: true,
			rightAlign: true,
			justify: true,

			// lists
			ol: true,
			ul: true,

			// title
			heading: true,

			// fonts
			fonts: true,
			fontList: [
				"Arial", 
				"Arial Black", 
				"Comic Sans MS", 
				"Courier New", 
				"Geneva", 
				"Georgia", 
				"Helvetica", 
				"Impact", 
				"Lucida Console", 
				"Tahoma", 
				"Times New Roman",
				"Verdana"
			],
			fontColor: true,
			fontSize: true,

			// uploads
			imageUpload: false,
			fileUpload: false,

			// media
			videoEmbed: false,

			// link
			urls: false,

			// tables
			table: false,

			// code
			removeStyles: false,
			code: false,

			// colors
			colors: [],

			// dropdowns
			fileHTML: '',
			imageHTML: '',

			// translations
			translations: {
				'title': 'Title',
				'white': 'White',
				'black': 'Black',
				'brown': 'Brown',
				'beige': 'Beige',
				'darkBlue': 'Dark Blue',
				'blue': 'Blue',
				'lightBlue': 'Light Blue',
				'darkRed': 'Dark Red',
				'red': 'Red',
				'darkGreen': 'Dark Green',
				'green': 'Green',
				'purple': 'Purple',
				'darkTurquois': 'Dark Turquois',
				'turquois': 'Turquois',
				'darkOrange': 'Dark Orange',
				'orange': 'Orange',
				'yellow': 'Yellow',
				'imageURL': 'Image URL',
				'fileURL': 'File URL',
				'linkText': 'Link text',
				'url': 'URL',
				'size': 'Size',
				'responsive': 'Responsive',
				'text': 'Text',
				'openIn': 'Open in',
				'sameTab': 'Same tab',
				'newTab': 'New tab',
				'align': 'Align',
				'left': 'Left',
				'center': 'Center',
				'right': 'Right',
				'rows': 'Rows',
				'columns': 'Columns',
				'add': 'Add',
				'pleaseEnterURL': 'Please enter an URL',
				'videoURLnotSupported': 'Video URL not supported',
				'pleaseSelectImage': 'Please select an image',
				'pleaseSelectFile': 'Please select a file',
				'bold': 'Bold',
				'italic': 'Italic',
				'underline': 'Underline',
				'alignLeft': 'Align left',
				'alignCenter': 'Align centered',
				'alignRight': 'Align right',
				'addOrderedList': 'Add ordered list',
				'addUnorderedList': 'Add unordered list',
				'addHeading': 'Add Heading/title',
				'addFont': 'Add font',
				'addFontColor': 'Add font color',
				'addFontSize' : 'Add font size',
				'addImage': 'Add image',
				'addVideo': 'Add video',
				'addFile': 'Add file',
				'addURL': 'Add URL',
				'addTable': 'Add table',
				'removeStyles': 'Remove styles',
				'code': 'Show HTML code',
				'undo': 'Undo',
				'redo': 'Redo',
				'close': 'Close'
			},
					
			// privacy
			youtubeCookies: false,

			// developer settings
			useSingleQuotes: false,
			height: 0,
			heightPercentage: 0,
			id: "",
			class: "",
			useParagraph: true,
			maxlength: 0,
			callback: undefined,
			useTabForNext: false
		});


		$(document).ready(function() {

			$('#description').simpleTxtCounter({
				maxLength: 500,
				countElem: '<div class="form-text"></div>',
				lineBreak: false,
			});

		});	
		
		// SUBMIT FORM
		$('#openai-form').on('submit', function(e) {

			e.preventDefault();

			var inputAudio = [];
  			var duration;

			if (pond.getFiles().length !== 0) {   
				pond.getFiles().forEach(function(file) {
				inputAudio.push(file);
				});
			}

			var audio = document.createElement('audio');
			var objectUrl = URL.createObjectURL(inputAudio[0].file);

			audio.src = objectUrl;
			audio.addEventListener('loadedmetadata', function(){
				duration = audio.duration;
			},false);

			var form = $(this);
			var formData = new FormData(this);

			setTimeout(function() {

				formData.append('audiofile', inputAudio[0].file);
				formData.append('audiolength', duration);

				$.ajax({
					headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
					method: 'POST',
					url: 'speech-to-text/process',
					data: formData,
					contentType: false,
					processData: false,
					cache: false,
					beforeSend: function() {
						$('#waveform-box').slideUp('slow')  
						document.getElementById("generating-message").style.display="none";				
						document.getElementById("generating-status").style.display="block";	
						document.getElementById("template-textarea").style.opacity=0.1;	
						$('#generate').html('');
						$('#generate').prop('disabled', true);
						$('#processing').show().clone().appendTo('#generate'); 
						$('#processing').hide();          
					},
					complete: function() {
						$('#generate').prop('disabled', false);
						document.getElementById("generating-status").style.display="none";	
						document.getElementById("template-textarea").style.opacity=1;
						$('#processing', '#generate').empty().remove();
						$('#processing').hide();
						$('#generate').html('Transcribe');            
					},
					success: function (data) {		

						if (data['status'] == 'success') {
							let id = document.querySelector('.richText-editor').id;
							let editor = document.getElementById(id);
					
							editor.innerHTML = data['text'];

							let save = document.getElementById('save-button');
							save.setAttribute('target', data['id']);

							$('#waveform-box').slideDown('slow')
							wavesurfer.load(data['url']);

							toastr.success('{{ __('Audio Transcript generated successfully') }}');
						
							animateValue("balance-number", data['old'], data['current'], 300);

							if (pond.getFiles().length != 0) {
								for (var j = 0; j <= pond.getFiles().length - 1; j++) {
									pond.removeFiles(pond.getFiles()[j].id);
								}
							}
						} else {						
							Swal.fire('{{ __('Transcribe Error') }}', data['message'], 'warning');
						}

					},
					error: function(data) {
						$('#waveform-box').slideUp('slow')  
						$('#generate').prop('disabled', false);
						$('#generate').html('Transcribe'); 
						console.log(data)

						if (pond.getFiles().length != 0) {
							for (var j = 0; j <= pond.getFiles().length - 1; j++) {
								pond.removeFiles(pond.getFiles()[j].id);
							}
						}
					}
				});

			}, 1000); 
		});
	});

	function animateValue(id, start, end, duration) {
		if (start === end) return;
		var range = end - start;
		var current = start;
		var increment = end > start? 1 : -1;
		var stepTime = Math.abs(Math.floor(duration / range));
		var obj = document.getElementById(id);
		var timer = setInterval(function() {
			current += increment;
			if (current > 0) {
				obj.innerHTML = current;
			} else {
				obj.innerHTML = 0;
			}
			
			if (current == end) {
				clearInterval(timer);
			}
		}, stepTime);
	}

	function saveText(event) {

		let textarea = document.querySelector('.richText-editor').innerHTML;
		let title = document.getElementById('document').value;


		if (!event.target) {
			toastr.warning('{{ __('You will need to transcribe audio first before saving') }}');
		} else {
			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'POST',
				url: '/user/speech-to-text/save',
				data: { 'id': event.target, 'text': textarea, 'title': title},
				success: function (data) {					
					if (data['status'] == 'success') {
						toastr.success('{{ __('Transcript has been successfully saved') }}');
					} else {						
						toastr.warning('{{ __('There was an issue while saving your transcript') }}');
					}
				},
				error: function(data) {
					toastr.warning('{{ __('There was an issue while saving your transcript') }}');
				}
			});

			return false;
		}

	}


	FilePond.registerPlugin(
		FilePondPluginFileValidateSize,
	);

	FilePond.setOptions({
		maxFileSize: 25 + 'MB',
		maxFiles: 1,
		labelIdle: "{{ __('Drag & Drop your audio file or') }} <span class=\"filepond--label-action\">{{ __('Browse') }}</span><br><span class='restrictions'><span class='restrictions-highlight'>.mp3, .mp4, .mpeg, .mpga, .m4a, .wav, .webm</span></span><br><span class='restrictions'><span class='text-muted'>{{ __('Max Audio Size') }}: " + 25 + "MB</span></span>",
		required: true,
		instantUpload:false,
		storeAsFile: true,
		labelFileProcessingError: (error) => {
		console.log(error);
		}
	
	});
	
	// CREATE FILEPOND INSTANCE
	let pond = FilePond.create(document.querySelector('.filepond'));

	let playBtn = document.getElementById('playBtn');
	let stopBtn = document.getElementById('stopBtn');
	let forwardBtn = document.getElementById('forwardBtn');
	let backwardBtn = document.getElementById('backwardBtn');
	let wave = document.getElementById('waveform');

	let wavesurfer = WaveSurfer.create({
		container: wave,
		waveColor: '#ff9d00',
		progressColor: '#1e1e2d',
		selectionColor: '#d0e9c6',
		backgroundColor: '#ffffff',
		barWidth: 2,
		barHeight: 4,
		barMinHeight: 1,
		height: 50,
		responsive: true,				
		barRadius: 1,
		fillParent: true,
		plugins: [
			WaveSurfer.timeline.create({
				container: "#wave-timeline",
				timeInterval: 1,
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

	playBtn.onclick = function(e) {
    e.preventDefault();

    wavesurfer.playPause();
		if (playBtn.innerHTML.includes('fa-play')) {
			playBtn.innerHTML = '<i class="fa fa-pause"></i>';
			playBtn.classList.add('isPlaying');
		} else {
			playBtn.innerHTML = '<i class="fa fa-play"></i>';
			playBtn.classList.remove('isPlaying');
		}
	}

	stopBtn.onclick = function(e) {
		e.preventDefault();

		wavesurfer.stop();	
		playBtn.innerHTML = '<i class="fa fa-play"></i>';
		playBtn.classList.remove('isPlaying');
	}

	forwardBtn.onclick = function(e) {
		e.preventDefault();
		
		wavesurfer.skipForward(3);	
	}

	backwardBtn.onclick = function(e) {
		e.preventDefault();

		wavesurfer.skipBackward(3);	
	}

	wavesurfer.on('finish', function() {
		playBtn.innerHTML = '<i class="fa fa-play"></i>';
		playBtn.classList.remove('isPlaying');
		wavesurfer.stop();	
	});

</script>
@endsection