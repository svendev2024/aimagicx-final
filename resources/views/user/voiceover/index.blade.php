@extends('layouts.app')
@section('css')
	<!-- Data Table CSS -->
	<link href="{{URL::asset('plugins/datatable/datatables.min.css')}}" rel="stylesheet" />
	<!-- Green Audio Players CSS -->
	<link href="{{ URL::asset('plugins/audio-player/green-audio-player.css') }}" rel="stylesheet" />
	<!-- Sweet Alert CSS -->
	<link href="{{URL::asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
	<div class="row mt-24">
		<div class="col-lg-12 col-md-12 col-xm-12">
			<div class="card border-0">
				<div class="card-header pt-4 border-0" id="voiceover-character-counter-top">
					<h3 class="card-title"><i class="fa-sharp fa-solid fa-waveform-lines mr-4 text-info"></i>{{ __('AI Voiceover Studio') }} </h3>
					<span class="fs-11 text-muted pl-3" id="voiceover-character-counter"><i class="fa-sharp fa-solid fa-bolt-lightning mr-2 text-primary"></i>{{ __('Your Balance is') }} <span class="font-weight-semibold" id="balance-number">{{ number_format(auth()->user()->available_chars + auth()->user()->available_chars_prepaid) }}</span> {{ __('Characters') }}</span>
				</div>
				<div class="card-body pt-2 pl-7 pr-7 pb-4" id="tts-body-minify">
				
						<form id="synthesize-text-form" action="{{ route('user.voiceover.synthesize') }}" listen="{{ route('user.voiceover.listen') }}" method="POST" enctype="multipart/form-data">
							@csrf

							<div class="row" id="tts-awselect">
								<div class="col-md-3 col-sm-12">
									<div class="form-group">									
										<select id="languages" name="language" data-placeholder="{{ __('Pick Your Language') }}:" data-callback="language_select">	
											@foreach ($languages as $language)
												<option value="{{ $language->language_code }}" data-img="{{ URL::asset($language->language_flag) }}" @if (auth()->user()->default_voiceover_language == $language->language_code) selected @endif> {{ $language->language }}</option>
											@endforeach											
										</select>
									</div>
								</div>

								<div class="col-md-3 col-sm-12">
									<div class="row">
										<div class="col-md-10 col-sm-10 pr-0" id="voice-minify">
											<div class="form-group">									
												<select id="voices" name="voice" data-placeholder="{{ __('Choose Your Voice') }}:" data-callback="voice_select">
													@foreach ($voices as $voice)
														<option value="{{ $voice->voice_id }}" 
															id="{{ $voice->voice_id }}"
															data-img="{{ URL::asset($voice->avatar_url) }}"
															data-id="{{ $voice->voice_id }}" 
															data-lang="{{ $voice->language_code }}" 
															data-type="{{ $voice->voice_type }}"
															data-gender="{{ $voice->gender }}"	
															data-voice="{{ $voice->voice }}"	
															data-url="{{ URL::asset($voice->sample_url) }}"																							
															@if (auth()->user()->default_voiceover_voice == $voice->voice_id) selected @endif
															data-class="@if (auth()->user()->default_voiceover_language !== $voice->language_code) remove-voice @endif"> 
															{{ $voice->voice }} 														
														</option>
													@endforeach									
												</select>
											</div>
										</div>
										<div class="col-md-2 col-sm-2" id="preview-box">
											<button class="btn btn-special create-project" type="button" onclick="previewPlay(this)" src="" type="audio/mpeg" id="preview" data-tippy-content="{{ __('Preview Selected Voice') }}"><i class="fa-solid fa-volume-high"></i></button>
										</div>
									</div>									
								</div>

								<div class="col-md-3 col-sm-12">
									<div class="input-box mb-0" id="textarea-box">
										<input type="text" class="form-control" name="title" id="title"  value="{{ __('New Audio') }}">
									</div>
								</div>

								<div class="col-md-3 col-sm-12">
									<div class="form-group">
										<select id="project" name="project" data-placeholder="{{ __('Select Workbook Name') }}">	
											<option value="all"> {{ __('All Workbooks') }}</option>
											@foreach ($projects as $project)
												<option value="{{ $project->name }}" @if (strtolower(auth()->user()->project) == strtolower($project->name)) selected @endif> {{ ucfirst($project->name) }}</option>
											@endforeach											
										</select>
									</div>								
								</div>
							</div>


							<div class="row mb-4">
								<div class="col-md-3 col-sm-12">
									<div id="audio-format" role="radiogroup">
										<span  id="mp3-format">
											<div class="radio-control">
												<input type="radio" name="format" class="input-control" id="mp3" value="mp3" checked>
												<label for="mp3" class="label-control">MP3</label>
											</div>	
										</span>
										<span  id="wav-format">
											<div class="radio-control">
												<input type="radio" name="format" class="input-control" id="wav" value="wav">
												<label for="wav" class="label-control" id="wav-label">WAV</label>
											</div>
										</span>
										<span  id="ogg-format">							
											<div class="radio-control">
												<input type="radio" name="format" class="input-control" id="ogg" value="ogg">
												<label for="ogg" class="label-control" id="ogg-label">OGG</label>
											</div>	
										</span>	
										<span  id="webm-format">							
											<div class="radio-control">
												<input type="radio" name="format" class="input-control" id="webm" value="webm">
												<label for="webm" class="label-control" id="webm-label">WEBM</label>
											</div>	
										</span>										
									</div>
								</div>
							</div>


							@if (config('settings.voiceover_ssml_effect') == 'enable')
								<div class="row mb-6">
									<div class="col-md col-sm-12 special-buttons" id="style-box">
										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="speakingStyle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{ __('Speaking Style') }}
											</button>
											<div class="dropdown-menu" aria-labelledby="speakingStyle">
												<button style="display: none" class="dropdown-item" type="button" id="newscast-formal">{{ __('Newscaster Formal') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="newscast-casual">{{ __('Newscast Casual') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="narration-professional">{{ __('Narration Professional') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="customerservice">{{ __('Customer Service') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="chat">{{ __('Chat') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="cheerful">{{ __('Cheerful') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="empathetic">{{ __('Empathetic') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="assistant">{{ __('Assistant') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="newscast">{{ __('Newscast') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="calm">{{ __('Calm') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="sad">{{ __('Sad') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="angry">{{ __('Angry') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="fearful">{{ __('Fearful') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="disgruntled">{{ __('Disgruntled') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="serious">{{ __('Serious') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="depressed">{{ __('Depressed') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="embarrassed">{{ __('Embarrassed') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="affectionate">{{ __('Affectionate') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="gentle">{{ __('Gentle') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="lyrical">{{ __('Lyrical') }}</button>
											</div>
										</div>
									</div>

									<div class="col-md col-sm-12 special-buttons" id="effect-box">
										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="voiceEffects" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{ __('Voice Effects') }}
											</button>
											<div class="dropdown-menu" aria-labelledby="voiceEffects">
												<button class="dropdown-item" type="button" id="soft_effect">{{ __('Speak Softly') }}</button>
												<button class="dropdown-item" type="button" id="breathing_effect">{{ __('Sound of Breathing') }}</button>
												<button class="dropdown-item" type="button" id="whispered_effect">{{ __('Whispered') }}</button>
												<button class="dropdown-item" type="button" id="drc_effect">{{ __('DRC Effect') }}</button>
												<button class="dropdown-item" type="button" id="controlling_timbre">{{ __('Controlling Timbre') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="newscaster_effect">{{ __('Newscaster') }}</button>
											</div>
										</div>
									</div>

									<div class="col-md col-sm-12 special-buttons" id="sayas-box">
										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="sayAs" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{ __('Say as') }}
											</button>
											<div class="dropdown-menu" aria-labelledby="sayAs">
												<button class="dropdown-item" type="button" id="characters_sayas">{{ __('Characters') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="verbatim_sayas">{{ __('Verbatim') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="bleep_sayas">{{ __('Bleep') }}</button>
												<button class="dropdown-item" type="button" id="cardinal_sayas">{{ __('Cardinal') }}</button>
												<button class="dropdown-item" type="button" id="ordinal_sayas">{{ __('Ordinal') }}</button>
												<button class="dropdown-item" type="button" id="digits_sayas">{{ __('Digits') }}</button>
												<button class="dropdown-item" type="button" id="fraction_sayas">{{ __('Fraction') }}</button>
												<button class="dropdown-item" type="button" id="unit_sayas">{{ __('Unit') }}</button>
												<button class="dropdown-item" type="button" id="time_sayas">{{ __('Time') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="gcp_time_sayas">{{ __('Time') }}</button>
												<button class="dropdown-item" type="button" id="address_sayas">{{ __('Address') }}</button>
												<button class="dropdown-item" type="button" id="expletive_sayas">{{ __('Beep Out') }}</button>
												<button style="display: none" class="dropdown-item" type="button" id="telephone_sayas">{{ __('Telephone') }}</button>
											</div>
										</div>
									</div>

									<div class="col-md col-sm-12 special-buttons" id="emphasis-box">
										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="emphasis" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{ __('Emphasis') }}
											</button>
											<div class="dropdown-menu" aria-labelledby="emphasis">
												<button class="dropdown-item" type="button" id="reduced_emphasis">{{ __('Reduced') }}</button>
												<button class="dropdown-item" type="button" id="moderate_emphasis">{{ __('Moderate') }}</button>
												<button class="dropdown-item" type="button" id="strong_emphasis">{{ __('Strong') }}</button>
											</div>
										</div>
									</div>

									<div class="col-md col-sm-12 special-buttons" id="volume-box">
										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="volume" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{ __('Volume') }}
											</button>
											<div class="dropdown-menu" aria-labelledby="volume">
												<button class="dropdown-item" type="button" id="silent_volume">{{ __('Silent') }}</button>
												<button class="dropdown-item" type="button" id="x_soft_volume">{{ __('x-Soft') }}</button>
												<button class="dropdown-item" type="button" id="soft_volume">{{ __('Soft') }}</button>
												<button class="dropdown-item" type="button" id="medium_volume">{{ __('Medium') }}</button>
												<button class="dropdown-item" type="button" id="loud_volume">{{ __('Loud') }}</button>
												<button class="dropdown-item" type="button" id="x_loud_volume">{{ __('x-Loud') }}</button>
											</div>
										</div>
									</div>

									<div class="col-md col-sm-12 special-buttons" id="speed-box">
										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="speed" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{ __('Speed') }}
											</button>
												<div class="dropdown-menu" aria-labelledby="speed">
												<button class="dropdown-item" type="button" id="x_slow_speed">{{ __('x-Slow') }}</button>
												<button class="dropdown-item" type="button" id="slow_speed">{{ __('Slow') }}</button>
												<button class="dropdown-item" type="button" id="medium_speed">{{ __('Medium') }}</button>
												<button class="dropdown-item" type="button" id="fast_speed">{{ __('Fast') }}</button>
												<button class="dropdown-item" type="button" id="x_fast_speed">{{ __('x-Fast') }}</button>
											</div>
										</div>
									</div>

									<div class="col-md col-sm-12 special-buttons" id="pitch-box">
										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="pitch" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{ __('Pitch') }}
											</button>
												<div class="dropdown-menu" aria-labelledby="pitch">
												<button class="dropdown-item" type="button" id="x_low_pitch">{{ __('x-Low') }}</button>
												<button class="dropdown-item" type="button" id="low_pitch">{{ __('Low') }}</button>
												<button class="dropdown-item" type="button" id="medium_pitch">{{ __('Medium') }}</button>
												<button class="dropdown-item" type="button" id="high_pitch">{{ __('High') }}</button>
												<button class="dropdown-item" type="button" id="x_high_pitch">{{ __('x-High') }}</button>
											</div>
										</div>
									</div>

									<div class="col-md col-sm-12 special-buttons" id="pause-box">
										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="pause" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{ __('Pauses') }}
											</button>
											<div class="dropdown-menu" aria-labelledby="pause">
												<button class="dropdown-item" type="button" id="zero_pause">{{ __('0 second') }}</button>
												<button class="dropdown-item" type="button" id="one_pause">{{ __('1 second') }}</button>
												<button class="dropdown-item" type="button" id="two_pause">{{ __('2 seconds') }}</button>
												<button class="dropdown-item" type="button" id="three_pause">{{ __('3 seconds') }}</button>
												<button class="dropdown-item" type="button" id="four_pause">{{ __('4 seconds') }}</button>
												<button class="dropdown-item" type="button" id="five_pause">{{ __('5 seconds') }}</button>
												<button class="dropdown-item" type="button" id="six_pause">{{ __('6 seconds') }}</button>
												<button class="dropdown-item" type="button" id="seven_pause">{{ __('7 seconds') }}</button>
												<button class="dropdown-item" type="button" id="eight_pause">{{ __('8 seconds') }}</button>
												<button class="dropdown-item" type="button" id="nine_pause">{{ __('9 seconds') }}</button>
												<button class="dropdown-item" type="button" id="ten_pause">{{ __('10 seconds') }}</button>
												<button class="dropdown-item" type="button" id="paragraph_pause">{{ __('Paragraph') }}</button>
												<button class="dropdown-item" type="button" id="sentence_pause">{{ __('Sentence') }}</button>
											</div>
										</div>
									</div>

									<div class="col-md col-sm-12 special-buttons" id="azurepause-box">
										<div class="dropdown">
											<button class="btn btn-special dropdown-toggle" type="button" id="azurePause" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{ __('Pauses') }}
											</button>
											<div class="dropdown-menu" aria-labelledby="azurePause">
												<button class="dropdown-item" type="button" id="azure_zero_pause">{{ __('0 second') }}</button>
												<button class="dropdown-item" type="button" id="azure_one_pause">{{ __('1 second') }}</button>
												<button class="dropdown-item" type="button" id="azure_two_pause">{{ __('2 seconds') }}</button>
												<button class="dropdown-item" type="button" id="azure_three_pause">{{ __('3 seconds') }}</button>
												<button class="dropdown-item" type="button" id="azure_four_pause">{{ __('4 seconds') }}</button>
												<button class="dropdown-item" type="button" id="azure_five_pause">{{ __('5 seconds') }}</button>
												<button class="dropdown-item" type="button" id="azure_paragraph_pause">{{ __('Paragraph') }}</button>
												<button class="dropdown-item" type="button" id="azure_sentence_pause">{{ __('Sentence') }}</button>
											</div>
										</div>
									</div>

									<div class="col-md col-sm-12 special-buttons" id="sub-box">
										<div class="dropdown">
											<button class="btn btn-special" type="button" id="sub">{{ __('Replace') }}</button>											
										</div>
									</div>
								</div>
							@endif							


							<div class="row">
								<div class="col-md-12">
									<div id="textarea-outer-box" class="p-2">
										<label class="input-label">
											<span class="input-label-content input-label-main">{{ __('Text to Speech') }}</span>
										</label>
										<div id="textarea-container">
											<div id="textarea-row-box">
												<div class="textarea-row" id="maintextarea">
													<div class="textarea-voice">
														<div class="ml-1 mt-1 voicee"><img src="" id="ZZZOOOVVVIMG"  data-tippy-content=""></div>
													</div>
													<div class="textarea-text">
														<textarea class="form-control textarea" name="textarea[]" id="ZZZOOOVVVZ" data-voice="" onkeyup="countCharacters();" onmousedown="mouseDown(this);" rows="1" placeholder="{{ __('Enter your text here to synthesize') }}..." maxlength="5000"></textarea>
													</div>
													<div class="textarea-actions">
														<div class="textarea-buttons">
															<button class="btn buttons synthesizeText" id="ZZZOOOVVVL" onclick="listenRow(this); return false;" data-tippy-content="{{ __('Listen Text') }}" ><i class="fa-solid fa-message-music"></i></button>
															<button class="btn buttons addPause" id="ZZZOOOVVVP" onclick="addPause(this); return false;" data-tippy-content="{{ __('Add Pause After Text') }}"><i class="fa-regular fa-hourglass-clock"></i></button>
															<button type="button" class="btn buttons deleteText" id="ZZZOOOVVVDEL" onclick="deleteRow(this); return false;" data-tippy-content="{{ __('Delete This Text Block') }}"><i class="fa-solid fa-trash"></i></button>
														</div>
													</div>
												</div>
											</div>
											<div class="textarea-add text-center mt-2">
												<button class="btn" id="addTextRow" data-tippy-content="{{ __('Add New Text Block') }}"><i class="fa-solid fa-layer-plus"></i></button>
											</div>
										</div>
										<div id="textarea-settings">								
											<div class="character-counter">
												<span id="total-characters">0 {{ __('characters') }}, 1 {{ __('line') }}</span>
											</div>
	
											<div class="clear-button">
												<button type="button" id="delete-all-lines">{{ __('Delete All Lines') }}</button>
												<button type="button" id="clear-effects">{{ __('Clear Effects') }}</button>
												<button type="button" id="clear-text">{{ __('Clear Text') }}</button>
											</div>
										</div>
									</div>
								</div>
							</div>			
							
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
											<button id="backwardBtn" class="result-play result-play-sm mr-2"><i class="fa fa-backward"></i></button>
											<button id="playBtn" class="result-play result-play-sm mr-2"><i class="fa fa-play"></i></button>
											<button id="stopBtn" class="result-play result-play-sm mr-2"><i class="fa fa-stop"></i></button>
											<button id="forwardBtn" class="result-play result-play-sm mr-2"><i class="fa fa-forward"></i></button>							
											<a id="downloadBtn" class="result-play result-play-sm" href="" download><i class="fa fa-download"></i></a>						
										</div> 
									</div>
								</div>                                            
							</div>

							<div class="card-footer border-0 text-center mt-3">
								<span id="processing"><img src="{{ URL::asset('/img/svgs/processing.svg') }}" alt=""></span>
								<button type="button" class="btn btn-primary main-action-button mr-2" id="listen-text">{{ __('Listen') }}</button>
								<button type="submit" class="btn btn-primary main-action-button" id="synthesize-text">{{ __('Synthesize') }}</button>								
							</div>							

						</form>
					
				</div>
			</div>
		</div>
	</div>

	<div class="row mt-4" id="results-header">
		<div class="col-lg-12 col-md-12 col-xm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('AI Voiceover Results') }} <span class="text-muted">({{ __('Current Day') }})</span></h3>
				</div>
				<div class="card-body pt-2">
					<!-- SET DATATABLE -->
					<table id='resultTable' class='table' width='100%'>
							<thead>
								<tr>
									<th width="3%"></th>
									<th width="10%">{{ __('Created On') }}</th> 
									<th width="8%">{{ __('Language') }}</th>
									<th width="7%">{{ __('Voice') }}</th>
									<th width="7%">{{ __('Gender') }}</th>		
									<th width="4%"><i class="fa fa-music fs-14"></i></th>							
									<th width="4%"><i class="fa fa-cloud-download fs-14"></i></th>								
									<th width="5%">{{ __('Format') }}</th>																	           	
									<th width="5%">{{ __('Chars') }}</th>																	           	
									<th width="9%">{{ __('Workbook') }}</th>     						           	
									<th width="5%">{{ __('Actions') }}</th>
								</tr>
							</thead>
					</table> <!-- END SET DATATABLE -->
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
	<!-- Green Audio Players JS -->
	<script src="{{ URL::asset('plugins/audio-player/green-audio-player.js') }}"></script>
	<script src="{{ URL::asset('js/audio-player.js') }}"></script>
	<script src="{{ URL::asset('js/wavesurfer.min.js') }}"></script>
	<script src="{{ URL::asset('plugins/wavesurfer/wavesurfer.cursor.min.js') }}"></script>
	<script src="{{ URL::asset('plugins/wavesurfer/wavesurfer.timeline.min.js') }}"></script>
	<!-- Data Tables JS -->
	<script src="{{URL::asset('plugins/datatable/datatables.min.js')}}"></script>
	<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
	<script src="{{URL::asset('js/dashboard.js')}}"></script>
	<script type="text/javascript">
		$(function () {

			"use strict";

			$('#add-project').on('click', function() {
				$('#projectModal').modal('show');
			});
			
			function format(d) {
				// `d` is the original data object for the row
				return '<div class="slider">'+
							'<table class="details-table">'+
								'<tr>'+
									'<td class="details-title" width="10%">Title:</td>'+
									'<td>'+ ((d.title == null) ? '' : d.title) +'</td>'+
								'</tr>'+
								'<tr>'+
									'<td class="details-title" width="10%">Text Clean:</td>'+
									'<td>'+ d.text +'</td>'+
								'</tr>'+
								'<tr>'+
									'<td class="details-title" width="10%">Text Raw:</td>'+
									'<td>'+ d.text_raw +'</td>'+
								'</tr>'+
								'<tr>'+
									'<td class="details-result" width="10%">Synthesized Result:</td>'+
									'<td><audio controls preload="none">' +
										'<source src="'+ d.result +'" type="'+ d.audio_type +'">' +
									'</audio></td>'+
								'</tr>'+
							'</table>'+
						'</div>';
			}


			var table = $('#resultTable').DataTable({
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
				responsive: {
					details: {type: 'column'}
				},
				colReorder: true,
				language: {
					"emptyTable": "<div><img id='no-results-img' src='{{ URL::asset('img/files/no-result.png') }}'><br>{{ __('No synthesized text results yet') }}</div>",
					search: "<i class='fa fa-search search-icon'></i>",
					lengthMenu: '_MENU_ ',
					paginate : {
						first    : '<i class="fa fa-angle-double-left"></i>',
						last     : '<i class="fa fa-angle-double-right"></i>',
						previous : '<i class="fa fa-angle-left"></i>',
						next     : '<i class="fa fa-angle-right"></i>'
					}
				},
				pagingType : 'full_numbers',
				processing: true,
				serverSide: true,
				ajax: "{{ route('user.voiceover') }}",
				columns: [{
						"className":      'details-control',
						"orderable":      false,
						"searchable":     false,
						"data":           null,
						"defaultContent": ''
					},
					{
						data: 'created-on',
						name: 'created-on',
						orderable: true,
						searchable: true
					},																		
					{
						data: 'custom-language',
						name: 'custom-language',
						orderable: true,
						searchable: true
					},
					{
						data: 'voice',
						name: 'voice',
						orderable: true,
						searchable: true
					},
					{
						data: 'gender',
						name: 'gender',
						orderable: true,
						searchable: true
					},	
					{
						data: 'single',
						name: 'single',
						orderable: true,
						searchable: true
					},				
					{
						data: 'download',
						name: 'download',
						orderable: true,
						searchable: true
					},	
					{
						data: 'result_ext',
						name: 'result_ext',
						orderable: true,
						searchable: true
					},		
					{
						data: 'characters',
						name: 'characters',
						orderable: true,
						searchable: true
					},	
					{
						data: 'project',
						name: 'project',
						orderable: true,
						searchable: true
					},				
					{
						data: 'actions',
						name: 'actions',
						orderable: false,
						searchable: false
					},
				]
			});
			

			$('#resultTable tbody').on('click', 'td.details-control', function () {
				var tr = $(this).closest('tr');
				var row = table.row( tr );
		
				if ( row.child.isShown() ) {
					// This row is already open - close it
					$('div.slider', row.child()).slideUp( function () {
						row.child.hide();
						tr.removeClass('shown');
					} );
				}
				else {
					// Open this row
					row.child( format(row.data()), 'no-padding' ).show();
					tr.addClass('shown');
		
					$('div.slider', row.child()).slideDown();
				}
			});


			let user_voice = "{{ auth()->user()->default_voiceover_voice }}";
			voice_select(user_voice);


			// DELETE SYNTHESIZE RESULT
			$(document).on('click', '.deleteResultButton', function(e) {

				e.preventDefault();

				Swal.fire({
					title: '{{ __('Confirm Result Deletion') }}',
					text: '{{ __('It will permanently delete this synthesize result') }}',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: '{{ __('Delete') }}',
					reverseButtons: true,
				}).then((result) => {
					if (result.isConfirmed) {
						var formData = new FormData();
						formData.append("id", $(this).attr('id'));
						$.ajax({
							headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
							method: 'post',
							url: 'text-to-speech/delete',
							data: formData,
							processData: false,
							contentType: false,
							success: function (data) {
								if (data == 'success') {
									Swal.fire('{{ __('Result Deleted') }}', '{{ __('Synthesize result has been successfully deleted') }}', 'success');	
									$("#resultTable").DataTable().ajax.reload();								
								} else {
									Swal.fire('{{ __('Delete Failed') }}', '{{ __('There was an error while deleting this result') }}', 'error');
								}      
							},
							error: function(data) {
								Swal.fire({ type: 'error', title: 'Oops...', text: 'Something went wrong!' })
							}
						})
					} 
				})
			});

		});		
	</script>
@endsection