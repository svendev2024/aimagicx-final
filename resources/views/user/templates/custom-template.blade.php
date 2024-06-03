@extends('layouts.app')
@section('css')
	<!-- Sweet Alert CSS -->
	<link href="{{URL::asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" />
	<!-- RichText CSS -->
	<link href="{{URL::asset('plugins/richtext/richtext.min.css')}}" rel="stylesheet" />
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
									{!! $template->icon !!}
								</div>
								<div>
									<h6 class="mt-1 ml-3 fs-16 number-font">{{ __($template->name) }} 										
										@if($template->package == 'professional') 
											<span class="fs-8 btn btn-pro ml-2"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }} </span> 
										@elseif($template->package == 'free')
											<span class="fs-8 btn btn-free ml-2"><i class="fa-sharp fa-solid fa-gift mr-2"></i>{{ __('Free') }} </span> 
										@elseif($template->package == 'premium')
											<span class="fs-8 btn btn-yellow ml-2"><i class="fa-sharp fa-solid fa-gem mr-2"></i>{{ __('Premium') }} </span> 
										@elseif($template->new)
											<span class="fs-8 btn btn-new ml-2"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i>{{ __('New') }}</span>
										@endif	
									</h6>
								</div>
								<div>
									<a id="{{ $template->template_code }}" @if($favorite) data-tippy-content="{{ __('Remove from favorite') }}" @else data-tippy-content="{{ __('Select as favorite') }}" @endif onclick="favoriteStatus(this.id)"><i id="{{ $template->template_code }}-icon" class="@if($favorite) fa-solid fa-stars @else fa-regular fa-star @endif star"></i></a>
								</div>									
							</div>								
							<div class="template-info">
								<p class="fs-12 text-muted mb-4">{{ __($template->description) }}</p>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div class="text-left mb-4" id="balance-status">
								<span class="fs-11 text-muted pl-3"><i class="fa-sharp fa-solid fa-bolt-lightning mr-2 text-primary"></i>{{ __('Your Balance is') }} <span class="font-weight-semibold" id="balance-number">{{ number_format(auth()->user()->available_words + auth()->user()->available_words_prepaid) }}</span> {{ __('Words') }}</span>
							</div>							
						</div>											
						<div class="col-sm-12">
							<div class="form-group">	
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Language') }}</h6>								
								<select id="language" name="language" data-placeholder="{{ __('Select input language') }}">		
									@foreach ($languages as $language)
										<option value="{{ $language->language_code }}" data-img="{{ URL::asset($language->language_flag) }}" @if (config('settings.default_language') == $language->language_code) selected @endif> {{ $language->language }}</option>
									@endforeach									
								</select>
								@error('language')
									<p class="text-danger">{{ $errors->first('language') }}</p>
								@enderror	
							</div>
						</div>

						@foreach ($template->fields as $value)
							<div class="col-sm-12">								
								<div class="input-box">	
									<h6 class="fs-11 mb-2 font-weight-semibold">{{ __($value['name']) }}</h6>									
									<div class="form-group">						  
										@if ($value['input'] == 'input')
											<input type="text" class="form-control" id="{{ $value['code'] }}" name="{{ $value['code'] }}" placeholder="{{ __($value['placeholder']) }}">
										@else
											<textarea type="text" rows=5 class="form-control" id="{{ $value['code'] }}" name="{{ $value['code'] }}" placeholder="{{ __($value['placeholder']) }}"></textarea>
										@endif  

									</div> 
								</div> 
							</div>
						@endforeach

						@if ($template->tone)
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div id="form-group">
									<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Creativity') }} <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="{{ __('Increase or decrease the creativity level to get various results') }}"></i></h6>
									<select id="creativity" name="creativity" data-placeholder="{{ __('Select creativity level') }}">
										<option value=0 @if (config('settings.creativity_default_state') == 'low') selected @endif>{{ __('Low') }}</option>
										<option value=0.5 @if (config('settings.creativity_default_state') == 'average') selected @endif> {{ __('Average') }}</option>																															
										<option value=1 @if (config('settings.creativity_default_state') == 'high') selected @endif> {{ __('High') }}</option>																															
									</select>
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12">
								<div id="form-group">
									<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Tone of Voice') }} <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="{{ __('Set result tone of the text as needed') }}"></i></h6>
									<select id="tone" name="tone" data-placeholder="{{ __('Select tone of voice') }}">
										<option value="funny" @if (config('settings.tone_default_state') == 'funny') selected @endif>{{ __('Funny') }}</option>
										<option value="casual" @if (config('settings.tone_default_state') == 'casual') selected @endif> {{ __('Casual') }}</option>																															
										<option value="excited" @if (config('settings.tone_default_state') == 'excited') selected @endif> {{ __('Excited') }}</option>																															
										<option value="professional" @if (config('settings.tone_default_state') == 'professional') selected @endif> {{ __('Professional') }}</option>																															
										<option value="witty" @if (config('settings.tone_default_state') == 'witty') selected @endif> {{ __('Witty') }}</option>																															
										<option value="sarcastic" @if (config('settings.tone_default_state') == 'sarcastic') selected @endif> {{ __('Sarcastic') }}</option>																															
										<option value="feminine" @if (config('settings.tone_default_state') == 'feminine') selected @endif> {{ __('Feminine') }}</option>																															
										<option value="masculine" @if (config('settings.tone_default_state') == 'masculine') selected @endif> {{ __('Masculine') }}</option>																															
										<option value="bold" @if (config('settings.tone_default_state') == 'bold') selected @endif> {{ __('Bold') }}</option>																															
										<option value="dramatic" @if (config('settings.tone_default_state') == 'dramatic') selected @endif> {{ __('Dramatic') }}</option>																															
										<option value="grumpy" @if (config('settings.tone_default_state') == 'grumpy') selected @endif> {{ __('Grumpy') }}</option>																															
										<option value="secretive" @if (config('settings.tone_default_state') == 'secretive') selected @endif> {{ __('Secretive') }}</option>																															
									</select>
								</div>
							</div>
						@else
							<div class="col-sm-12">
								<div id="form-group">
									<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Creativity') }} <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="{{ __('Increase or decrease the creativity level to get various results') }}"></i></h6>
									<select id="creativity" name="creativity" data-placeholder="{{ __('Select creativity level') }}">
										<option value=0 @if (config('settings.creativity_default_state') == 'low') selected @endif>{{ __('Low') }}</option>
										<option value=0.5 @if (config('settings.creativity_default_state') == 'average') selected @endif> {{ __('Average') }}</option>																															
										<option value=1 @if (config('settings.creativity_default_state') == 'high') selected @endif> {{ __('High') }}</option>																															
									</select>
								</div>
							</div>
						@endif
						
						
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Number of Results') }} <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="{{ __('Maximum supported results is 5') }}"></i></h6>
								<select id="max-results" name="max_results" data-placeholder="{{ __('Set max number of results') }}">
									<option value=1 selected>1</option>
									<option value=2>2</option>																															
									<option value=3>3</option>																															
									<option value=4>4</option>																															
									<option value=5>5</option>																															
								</select>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12">								
							<div class="input-box">								
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Max Result Length') }} <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="{{ __('Maximum words for each generated text result') }}. {{ __('Maximum allowed length is ') }}{{ $limit }}"></i></h6>
								<div class="form-group">							    
									<input type="number" class="form-control @error('words') is-danger @enderror" id="words" name="words" placeholder="e.g. 100" max="{{ $limit }}" value="{{ $limit }}">
									@error('words')
										<p class="text-danger">{{ $errors->first('words') }}</p>
									@enderror
								</div> 
							</div> 
						</div>
					</div>						

					<div class="card-footer border-0 text-center p-0">						
						<div class="w-100 pt-2 pb-2">
							<div class="text-center">
								<span id="processing" class="processing-image"><img src="{{ URL::asset('/img/svgs/upgrade.svg') }}" alt=""></span>
								<button type="submit" name="submit" class="btn btn-primary  pl-7 pr-7 fs-11 pt-2 pb-2" id="generate">{{ __('Generate Text') }}</button>
							</div>
						</div>							
					</div>	
					
					<input type="hidden" name="template" value="{{ $template->template_code }}">
			
				</div>
			</div>			
		</div>

		<div class="col-lg-8 col-md-12 col-sm-12">
			<div class="card border-0" id="template-output">
				<div class="card-body">
					<div class="row">						
						<div class="col-lg-4 col-md-12 col-sm-12">								
							<div class="input-box mb-2">								
								<div class="form-group">							    
									<input type="text" class="form-control @error('document') is-danger @enderror" id="document" name="document" value="{{ __('New Document') }}">
									@error('document')
										<p class="text-danger">{{ $errors->first('document') }}</p>
									@enderror
								</div> 
							</div> 
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12">
							<div class="form-group">
								<select id="project" name="project" data-placeholder="{{ __('Select Workbook Name') }}">	
									<option value="all"> {{ __('All Workbooks') }}</option>
									@foreach ($workbooks as $workbook)
										<option value="{{ $workbook->name }}" @if (strtolower(auth()->user()->workbook) == strtolower($workbook->name)) selected @endif> {{ ucfirst($workbook->name) }}</option>
									@endforeach											
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12">
							<div class="d-flex" id="template-buttons-group">	
								<div>
									<a id="export-word" class="template-button mr-2" onclick="exportWord();" href="#"><i class="fa-solid fa-file-word table-action-buttons table-action-buttons-big view-action-button" data-tippy-content="{{ __('Export as Word Document') }}"></i></a>
								</div>	
								<div>
									<a id="export-pdf" class="template-button mr-2" onclick="exportPDF();" href="#"><i class="fa-solid fa-file-pdf table-action-buttons table-action-buttons-big view-action-button" data-tippy-content="{{ __('Export as PDF Document') }}"></i></a>
								</div>	
								<div>
									<a id="export-txt" class="template-button mr-2" onclick="exportTXT();" href="#"><i class="fa-solid fa-file-lines table-action-buttons table-action-buttons-big view-action-button" data-tippy-content="{{ __('Export as Text Document') }}"></i></a>
								</div>	
								<div>
									<a id="copy-button" class="template-button mr-2" onclick="copyText();" href="#"><i class="fa-solid fa-copy table-action-buttons table-action-buttons-big edit-action-button" data-tippy-content="{{ __('Copy Text') }}"></i></a>
								</div>
								<div>
									<a id="save-button" class="template-button" onclick="return saveText(this);" href="#"><i class="fa-solid fa-floppy-disk-pen table-action-buttons table-action-buttons-big delete-action-button" data-tippy-content="{{ __('Save Document') }}"></i></a>
								</div>					
							</div>
						</div>

					</div>
					<div>						
						<div id="template-textarea">						
							<div class="form-control" name="content" rows="12" id="richtext"></div>
							@error('content')
								<p class="text-danger">{{ $errors->first('content') }}</p>
							@enderror	
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
<script src="{{URL::asset('plugins/character-count/jquery-simple-txt-counter.min.js')}}"></script>
<script src="{{URL::asset('js/export.js')}}"></script>
<!-- RichText JS -->
<script src="{{URL::asset('plugins/richtext/jquery.richtext.min.js')}}"></script>
<script src="{{URL::asset('plugins/pdf/html2canvas.min.js')}}"></script>
<script src="{{URL::asset('plugins/pdf/jspdf.umd.min.js')}}"></script>
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
			urls: true,

			// tables
			table: true,

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
		

		// SUBMIT FORM
		$('#openai-form').on('submit', function(e) {

			e.preventDefault();

			let form = $(this);

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'POST',
				url: 'customGenerate',
				data: form.serialize(),
				beforeSend: function() {
					$('#generate').html('');
					$('#generate').prop('disabled', true);
					$('#processing').show().clone().appendTo('#generate'); 
					$('#processing').hide();          
				},			
				success: function (data) {	

					if (data['status'] == 'error') {
						
						Swal.fire('{{ __('Text Generation Error') }}', data['message'], 'warning');
						$('#generate').prop('disabled', false);
						$('#processing', '#generate').empty().remove();
						$('#processing').hide();
						$('#generate').html('{{ __('Generate Text') }}'); 

					} else {
					
						const eventSource = new EventSource( "/user/templates/original-template/process?content_id=" + data.id+"&max_results=" + data.max_results + "&max_words=" + data.max_words + "&temperature=" + data.temperature);
						const response = document.getElementById('richtext');
						let id = document.querySelector('.richText-editor').id;
						let editor = document.getElementById(id);
						let save = document.getElementById('save-button');
						save.setAttribute('target', data['id']);

						eventSource.onmessage = function (e) {
		
							if ( e.data == '[DONE]' ) {	
								eventSource.close();
								editor.innerHTML += '<br><br>';
								$('#generate').prop('disabled', false);
								$('#processing', '#generate').empty().remove();
								$('#processing').hide();
								$('#generate').html('{{ __('Generate Text') }}');  
								
							} else {

								let stream = e.data
								if ( stream && stream !== '[DONE]') {
									editor.innerHTML += stream;
								}

								editor.scrollTop += 100;
							}
							
						};
						eventSource.onerror = function (e) {
							console.log(e);
						};
					}
				},

				error: function(data) {
					$('#generate').prop('disabled', false);
            		$('#generate').html('Generate Text'); 
					console.log(data)
				}
			});
		});
	});

	function nl2br (str, is_xhtml) {
     	var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
     	return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
  	} 

	function favoriteStatus(id) {

		let icon, card;
		let formData = new FormData();
		formData.append("id", id);

		$.ajax({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			method: 'post',
			url: 'favorite',
			data: formData,
			processData: false,
			contentType: false,
			success: function (data) {

				if (data['status'] == 'success') {
					if (data['set']) {
						Swal.fire('{{ __('Template Removed from Favorites') }}', '{{ __('Selected template has been successfully removed from favorites') }}', 'success');
						icon = document.getElementById(id + '-icon');
						icon.classList.remove("fa-solid");
						icon.classList.remove("fa-stars");
						icon.classList.add("fa-regular");
						icon.classList.add("fa-star");			
					} else {
						Swal.fire('{{ __('Template Added to Favorites') }}', '{{ __('Selected template has been successfully added to favorites') }}', 'success');
						icon = document.getElementById(id + '-icon');
						icon.classList.remove("fa-regular");
						icon.classList.remove("fa-star");
						icon.classList.add("fa-solid");
						icon.classList.add("fa-stars");
					}
													
				} else {
					Swal.fire('{{ __('Favorite Setting Issue') }}', '{{ __('There as an issue with setting favorite status for this template') }}', 'warning');
				}      
			},
			error: function(data) {
				Swal.fire('Oops...','Something went wrong!', 'error')
			}
		})
	}

	function animateValue(id, start, end, duration) {
		if (start === end) return;
		var range = end - start;
		var current = start;
		var increment = end > start? 1 : -1;
		var stepTime = Math.abs(Math.floor(duration / range));
		var obj = document.getElementById(id);
		var timer = setInterval(function() {
			current += increment;
			obj.innerHTML = current;
			if (current == end) {
				clearInterval(timer);
			}
		}, stepTime);
	}

	function changeTemplate(value) {
		let url = '{{ url('user/templates') }}/' + value;
		window.location.href=url;
	}

	function saveText(event) {

		//let textarea = document.querySelector('.richText-editor').textContent;
		let textarea = document.querySelector('.richText-editor').innerHTML;
		let title = document.getElementById('document').value;
		let workbook = document.getElementById('project').value;


		if (!event.target) {
			toastr.warning('{{ __('You will need to generate AI text first before saving your changes') }}');
		} else {
			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'POST',
				url: '/user/templates/save',
				data: { 'id': event.target, 'text': textarea, 'title': title, 'workbook': workbook },
				success: function (data) {					
					if (data['status'] == 'success') {
						toastr.success('{{ __('Changes have been successfully saved') }}');
					} else {						
						toastr.warning('{{ __('There was an issue while saving your changes') }}');
					}
				},
				error: function(data) {
					toastr.warning('{{ __('There was an issue while saving your changes') }}');
				}
			});

			return false;
		}
		
	}

</script>
@endsection