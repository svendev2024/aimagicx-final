@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('Davinci Settings') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-microchip-ai mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.davinci.dashboard') }}"> {{ __('Davinci Management') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> {{ __('Davinci Settings') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection
@section('content')					
	<div class="row">
		<div class="col-lg-10 col-md-12 col-xm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title"><i class="fa-sharp fa-solid fa-sliders mr-2 text-primary"></i>{{ __('Setup Davinci Settings') }}</h3>
				</div>
				<div class="card-body">
				
					<form action="{{ route('admin.davinci.configs.store') }}" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="row">							

							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="input-box">	
									<h6>{{ __('Default OpenAI Model') }} <span class="text-muted">({{ __('For Admin Group') }})</span><span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
										  <select id="default-model-admin" name="default-model-admin" data-placeholder="{{ __('Select Default Model') }}:">			
										<option value="text-ada-001" @if ( config('settings.default_model_admin')  == 'text-ada-001') selected @endif>{{ __('Ada') }} ({{ __('GPT 3') }})</option>
										<option value="text-babbage-001" @if ( config('settings.default_model_admin')  == 'text-babbage-001') selected @endif>{{ __('Babbage') }} ({{ __('GPT 3') }})</option>
										<option value="text-curie-001" @if ( config('settings.default_model_admin')  == 'text-curie-001') selected @endif>{{ __('Curie') }} ({{ __('GPT 3') }})</option>
										<option value="text-davinci-003" @if ( config('settings.default_model_admin')  == 'text-davinci-003') selected @endif>{{ __('Davinci') }} ({{ __('GPT 3') }})</option>
										<option value="gpt-3.5-turbo" @if ( config('settings.default_model_admin')  == 'gpt-3.5-turbo') selected @endif>{{ __('GPT 3.5 Turbo') }}</option>
										<option value="gpt-3.5-turbo-16k" @if ( config('settings.default_model_admin')  == 'gpt-3.5-turbo-16k') selected @endif>{{ __('GPT 3.5 Turbo') }} ({{ __('16K') }})</option>
										<option value="gpt-4" @if ( config('settings.default_model_admin')  == 'gpt-4') selected @endif>{{ __('GPT 4') }} ({{ __('8K') }})</option>
										<option value="gpt-4-32k" @if ( config('settings.default_model_admin')  == 'gpt-4-32k') selected @endif>{{ __('GPT 4') }} ({{ __('32K') }})</option>
									</select>
								</div>								
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="input-box">	
									<h6>{{ __('Default Language') }} <span class="text-muted">({{ __('For All Groups') }})</span><span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
										  <select id="language" name="language" data-placeholder="{{ __('Select Default Language') }}:">	
											@foreach ($languages as $language)
												<option value="{{ $language->language_code }}" data-img="{{ URL::asset($language->language_flag) }}" @if (config('settings.default_language') == $language->language_code) selected @endif> {{ $language->language }}</option>
											@endforeach
									</select>
								</div>								
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="input-box">
									<h6>{{ __('Tone of Voice Default State') }} <span class="text-muted">({{ __('For All Groups') }})</span> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
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
										<option value="gumpy" @if (config('settings.tone_default_state') == 'gumpy') selected @endif> {{ __('Gumpy') }}</option>																															
										<option value="secretive" @if (config('settings.tone_default_state') == 'secretive') selected @endif> {{ __('Secretive') }}</option>																															
									</select>
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="input-box">
									<h6>{{ __('Creativity Default State') }} <span class="text-muted">({{ __('For All Groups') }})</span> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<select id="creativity" name="creativity" data-placeholder="{{ __('Select creativity state') }}">
										<option value="low" @if (config('settings.creativity_default_state') == 'low') selected @endif>{{ __('Low') }}</option>
										<option value="average" @if (config('settings.creativity_default_state') == 'average') selected @endif> {{ __('Average') }}</option>																															
										<option value="high" @if (config('settings.creativity_default_state') == 'high') selected @endif> {{ __('High') }}</option>																																																													
									</select>
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="input-box">
									<h6>{{ __('Templates Access') }} <span class="text-muted">({{ __('For Admin Group') }})</span> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<select id="templates-admin" name="templates-admin" data-placeholder="{{ __('Set Templates Access') }}">
										<option value="all" @if (config('settings.templates_access_admin') == 'all') selected @endif>{{ __('All Templates') }}</option>
										<option value="free" @if (config('settings.templates_access_admin') == 'free') selected @endif>{{ __('Only Free Templates') }}</option>
										<option value="standard" @if (config('settings.templates_access_admin') == 'standard') selected @endif> {{ __('Up to Standard Templates') }}</option>
										<option value="professional" @if (config('settings.templates_access_admin') == 'professional') selected @endif> {{ __('Up to Professional Templates') }}</option>																																		
										<option value="premium" @if (config('settings.templates_access_admin') == 'premium') selected @endif> {{ __('Up to Premium Templates') }} ({{ __('All') }})</option>																																																																																																									
									</select>
								</div>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="input-box">	
									<h6>{{ __('Team Members Feature') }} <span class="text-muted">({{ __('For All Groups') }})</span></h6>
									<select id="team-members-feature" name="team-members-feature" data-placeholder="{{ __('Enable/Disable Team Members Feature') }}">			
										<option value="enable" @if ( config('settings.team_members_feature')  == 'enable') selected @endif>{{ __('Enable') }}</option>
										<option value="disable" @if ( config('settings.team_members_feature')  == 'disable') selected @endif>{{ __('Disable') }}</option>
									</select>
								</div> 						
							</div>							

							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="input-box">
									<h6>{{ __('AI Code Feature') }} <span class="text-muted">({{ __('For User & Subscriber Groups') }})</span> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<select id="code-feature-user" name="code-feature-user" data-placeholder="{{ __('Set AI Code Creation Permission') }}">
										<option value='allow' @if (config('settings.code_feature_user') == 'allow') selected @endif>{{ __('Allow') }}</option>
										<option value='deny' @if (config('settings.code_feature_user') == 'deny') selected @endif> {{ __('Deny') }}</option>																															
									</select>
								</div>
							</div>											

							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="input-box">
									<h6>{{ __('AI Chat Feature') }} <span class="text-muted">({{ __('For User & Subscriber Groups') }})</span> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<select id="chat-feature-user" name="chat-feature-user" data-placeholder="{{ __('Set Chat Permission') }}">
										<option value='allow' @if (config('settings.chat_feature_user') == 'allow') selected @endif>{{ __('Allow') }}</option>
										<option value='deny' @if (config('settings.chat_feature_user') == 'deny') selected @endif> {{ __('Deny') }}</option>																															
									</select>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="input-box">	
									<h6>{{ __('Maximum Result Length') }} <span class="text-muted">({{ __('In Words') }}) ({{ __('For Admin Group') }})</span><span class="text-required"><i class="fa-solid fa-asterisk"></i></span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('OpenAI has a hard limit based on Token limits for each model. Refer to OpenAI documentation to learn more. As a recommended by OpenAI, max result length is capped at 1500 words.') }}"></i></h6>
									<input type="number" class="form-control @error('max-results-admin') is-danger @enderror" id="max-results-admin" name="max-results-admin" placeholder="Ex: 10" value="{{ config('settings.max_results_limit_admin') }}" required>
									@error('max-results-admin')
										<p class="text-danger">{{ $errors->first('max-results-admin') }}</p>
									@enderror
								</div>								
							</div>
						</div>


						<div class="card border-0 special-shadow mb-7">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="fa fa-gift text-info fs-14 mr-2"></i>{{ __('Free Trial Options') }} <span class="text-muted">({{ __('User Group Only') }})</span></h6>

								<div class="row">			
									
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">	
											<h6>{{ __('Default Templates OpenAI Model') }} <span class="text-muted">({{ __('For User Group') }})</span><span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
											<select id="default-model-user" name="default-model-user" data-placeholder="{{ __('Select Default Model') }}:">			
												<option value="text-ada-001" @if ( config('settings.default_model_user')  == 'text-ada-001') selected @endif>{{ __('Ada') }} ({{ __('GPT 3') }})</option>
												<option value="text-babbage-001" @if ( config('settings.default_model_user')  == 'text-babbage-001') selected @endif>{{ __('Babbage') }} ({{ __('GPT 3') }})</option>
												<option value="text-curie-001" @if ( config('settings.default_model_user')  == 'text-curie-001') selected @endif>{{ __('Curie') }} ({{ __('GPT 3') }})</option>
												<option value="text-davinci-003" @if ( config('settings.default_model_user')  == 'text-davinci-003') selected @endif>{{ __('Davinci') }} ({{ __('GPT 3') }})</option>
												<option value="gpt-3.5-turbo" @if ( config('settings.default_model_user')  == 'gpt-3.5-turbo') selected @endif>{{ __('GPT 3.5 Turbo') }}</option>
												<option value="gpt-3.5-turbo-16k" @if ( config('settings.default_model_user')  == 'gpt-3.5-turbo-16k') selected @endif>{{ __('GPT 3.5 Turbo') }} ({{ __('16K') }})</option>
												<option value="gpt-4" @if ( config('settings.default_model_user')  == 'gpt-4') selected @endif>{{ __('GPT 4') }} ({{ __('8K') }})</option>
												<option value="gpt-4-32k" @if ( config('settings.default_model_user')  == 'gpt-4-32k') selected @endif>{{ __('GPT 4') }} ({{ __('32K') }})</option>
											</select>
										</div>								
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">
											<h6>{{ __('Templates Access') }} <span class="text-muted">({{ __('For User Group') }})</span> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
											<select id="templates-user" name="templates-user" data-placeholder="{{ __('Set Templates Access') }}">
												<option value="all" @if (config('settings.templates_access_user') == 'all') selected @endif>{{ __('All Templates') }}</option>	
												<option value="free" @if (config('settings.templates_access_user') == 'free') selected @endif>{{ __('Only Free Templates') }}</option>																																									
												<option value="standard" @if (config('settings.templates_access_user') == 'standard') selected @endif> {{ __('Up to Standard Templates') }}</option>	
												<option value="professional" @if (config('settings.templates_access_user') == 'professional') selected @endif> {{ __('Up to Professional Templates') }}</option>	
												<option value="premium" @if (config('settings.templates_access_user') == 'premium') selected @endif> {{ __('Up to Premium Templates') }} ({{ __('All') }})</option>																																																													
											</select>
										</div>
									</div>				
									
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">
											<h6>{{ __('AI Chat Package Type Access') }} <span class="text-muted">({{ __('For User Group') }})</span> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
											<select id="chats" name="chat-user" data-placeholder="{{ __('Set AI Chat Package Type Access') }}">
												<option value="all" @if (config('settings.chats_access_user') == 'all') selected @endif>{{ __('All Chat Types') }}</option>
												<option value="free" @if (config('settings.chats_access_user') == 'free') selected @endif>{{ __('Only Free Chat Types') }}</option>
												<option value="standard" @if (config('settings.chats_access_user') == 'standard') selected @endif> {{ __('Up to Standard Chat Types') }}</option>
												<option value="professional" @if (config('settings.chats_access_user') == 'professional') selected @endif> {{ __('Up to Professional Chat Types') }}</option>																																		
												<option value="premium" @if (config('settings.chats_access_user') == 'premium') selected @endif> {{ __('Up to Premium Chat Types') }}</option>																																																																																																									
											</select>
										</div>
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>{{ __('Number of Words as a Gift upon Registration') }} <span class="text-muted">({{ __('One Time') }})<span class="text-required"><i class="fa-solid fa-asterisk"></i></span> </span></h6>
											<div class="form-group">							    
												<input type="number" class="form-control @error('free-tier-words') is-danger @enderror" id="free-tier-words" name="free-tier-words" placeholder="Ex: 1000" value="{{ config('settings.free_tier_words') }}" required>
												@error('free-tier-words')
													<p class="text-danger">{{ $errors->first('free-tier-words') }}</p>
												@enderror
											</div> 
										</div>							
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>{{ __('Number of Images as a Gift upon Registration') }} <span class="text-muted">({{ __('One Time') }})<span class="text-required"><i class="fa-solid fa-asterisk"></i></span> </span></h6>
											<div class="form-group">							    
												<input type="number" class="form-control @error('free-tier-images') is-danger @enderror" id="free-tier-images" name="free-tier-images" placeholder="Ex: 1000" value="{{ config('settings.free_tier_images') }}" required>
												@error('free-tier-images')
													<p class="text-danger">{{ $errors->first('free-tier-images') }}</p>
												@enderror
											</div> 
										</div>							
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>{{ __('Number of Characters for AI Voiceover as a Gift upon Registration') }} <span class="text-muted">({{ __('One Time') }})<span class="text-required"><i class="fa-solid fa-asterisk"></i></span> </span></h6>
											<div class="form-group">							    
												<input type="number" class="form-control @error('set-free-chars') is-danger @enderror" id="set-free-chars" name="set-free-chars" placeholder="Ex: 1000" value="{{ config('settings.voiceover_welcome_chars') }}" required>
												@error('set-free-chars')
													<p class="text-danger">{{ $errors->first('set-free-chars') }}</p>
												@enderror
											</div> 
										</div>							
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>{{ __('Number of Minutes for AI Speech to Text as a Gift upon Registration') }} <span class="text-muted">({{ __('One Time') }})<span class="text-required"><i class="fa-solid fa-asterisk"></i></span> </span></h6>
											<div class="form-group">							    
												<input type="number" class="form-control @error('set-free-minutes') is-danger @enderror" id="set-free-minutes" name="set-free-minutes" placeholder="Ex: 1000" value="{{ config('settings.whisper_welcome_minutes') }}" required>
												@error('set-free-minutes')
													<p class="text-danger">{{ $errors->first('set-free-minutes') }}</p>
												@enderror
											</div> 
										</div>							
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">	
											<h6>{{ __('Maximum Result Length') }} <span class="text-muted">({{ __('In Words') }})</span><span class="text-required"><i class="fa-solid fa-asterisk"></i></span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('OpenAI has a hard limit based on Token limits for each model. Refer to OpenAI documentation to learn more. As a recommended by OpenAI, max result length is capped at 1500 words.') }}"></i></h6>
											<input type="number" class="form-control @error('max-results-user') is-danger @enderror" id="max-results-user" name="max-results-user" placeholder="Ex: 10" value="{{ config('settings.max_results_limit_user') }}" required>
											@error('max-results-user')
												<p class="text-danger">{{ $errors->first('max-results-user') }}</p>
											@enderror
										</div>								
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">	
											<h6>{{ __('Team Members Quantity') }} <span class="text-muted">({{ __('For User Group') }})</span> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
											<input type="number" class="form-control @error('team-members-quantity') is-danger @enderror" id="team-members-quantity" name="team-members-quantity" placeholder="Ex: 5" value="{{ config('settings.team_members_quantity_user') }}">
										</div> 						
									</div>
									
								</div>	
							</div>
						</div>

						<div class="card border-0 special-shadow mb-7">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="fa-sharp fa-solid fa-sliders text-info fs-14 mr-2"></i>{{ __('Miscellaneous') }}</h6>

								<div class="row">
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12">	
											<div class="input-box">	
												<h6>{{ __('Sensitive Words Filter') }} <span class="text-muted">({{ __('Comma Seperated') }})</span></h6>							
												<textarea class="form-control" name="words-filter" rows="6" id="words-filter">{{ $settings->value }}</textarea>	
											</div>											
										</div>
									</div>							
								</div>
	
							</div>
						</div>

						<div class="card border-0 special-shadow mb-7">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="fa-sharp fa-solid fa-camera-viewfinder text-info fs-14 mr-2"></i>{{ __('AI Image Settings') }} <span class="text-muted">({{ __('For All Groups') }})</span></h6>

								<div class="row">

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">
											<h6>{{ __('AI Image Service Vendor') }} </h6>
											<select id="image-vendor" name="image-vendor" data-placeholder="{{ __('Set AI Image Service Vendor') }}">
												<option value='openai' @if (config('settings.image_vendor') == 'openai') selected @endif>{{ __('OpenAI') }}</option>
												<option value='stable_diffusion' @if (config('settings.image_vendor') == 'stable_diffusion') selected @endif> {{ __('Stable Diffision') }}</option>																															
											</select>
										</div>
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">
											<h6>{{ __('AI Image Feature') }} <span class="text-muted">({{ __('For User & Subscriber Groups') }})</span> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
											<select id="image-feature-user" name="image-feature-user" data-placeholder="{{ __('Set AI Image Creation Permission') }}">
												<option value='allow' @if (config('settings.image_feature_user') == 'allow') selected @endif>{{ __('Allow') }}</option>
												<option value='deny' @if (config('settings.image_feature_user') == 'deny') selected @endif> {{ __('Deny') }}</option>																															
											</select>
										</div>
									</div>
		
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">	
											<h6>{{ __('Default Storage for AI Images') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
												  <select id="storage" name="default-storage" data-placeholder="{{ __('Set Default Storage for AI Images') }}:">			
												<option value="local" @if ( config('settings.default_storage')  == 'local') selected @endif>{{ __('Local Server') }}</option>
												<option value="aws" @if ( config('settings.default_storage')  == 'aws') selected @endif>{{ __('Amazon Web Services') }}</option>
												<option value="wasabi" @if ( config('settings.default_storage')  == 'wasabi') selected @endif>{{ __('Wasabi Cloud') }}</option>
											</select>
										</div>								
									</div>
		
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">	
											<h6>{{ __('Delete AI Image Results After') }} <span class="text-muted">({{ __('In Days') }}) ({{ __('For All Groups') }})</span><span class="text-required"><i class="fa-solid fa-asterisk"></i></span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Default days after which generated AI Images will be deleted, use 0 for never delete. Subscribers can overwrite this baed on their subscription plans') }}"></i></h6>
											<input type="number" class="form-control @error('default-duration') is-danger @enderror" id="default-duration" name="default-duration" value="{{ config('settings.default_duration') }}" required>
											@error('default-duration')
												<p class="text-danger">{{ $errors->first('default-duration') }}</p>
											@enderror
										</div>								
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">
											<h6>{{ __('Stable Diffusion Engine ID') }} </h6>
											<select id="stable-diffusion-engine" name="stable-diffusion-engine" data-placeholder="{{ __('Set Stable Diffusion Engine ID') }}">
												<option value='stable-diffusion-v1-5' @if (config('settings.image_stable_diffusion_engine') == 'stable-diffusion-v1-5') selected @endif>{{ __('Stable Diffusion v1.5') }}</option>
												<option value='stable-diffusion-512-v2-1' @if (config('settings.image_stable_diffusion_engine') == 'stable-diffusion-512-v2-1') selected @endif> {{ __('Stable Diffusion v2.1') }}</option>																															
												<option value='stable-diffusion-768-v2-1' @if (config('settings.image_stable_diffusion_engine') == 'stable-diffusion-768-v2-1') selected @endif> {{ __('Stable Diffusion v2.1-768') }}</option>																															
												<option value='stable-diffusion-xl-beta-v2-2-2' @if (config('settings.image_stable_diffusion_engine') == 'stable-diffusion-xl-beta-v2-2-2') selected @endif> {{ __('Stable Diffusion v2.2.2-XL Beta') }}</option>																															
												<option value='stable-diffusion-xl-1024-v0-9' @if (config('settings.image_stable_diffusion_engine') == 'stable-diffusion-xl-1024-v0-9') selected @endif> {{ __('SDXL v0.9') }}</option>
												
											</select>
										</div>
									</div>
		
								</div>		
							</div>
						</div>

						<div class="card border-0 special-shadow mb-7">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="fa-sharp fa-solid fa-waveform-lines text-info fs-14 mr-2"></i>{{ __('AI Voiceover Settings') }} <span class="text-muted">({{ __('For All Groups') }})</span></h6>

								<div class="row">

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">
											<h6>{{ __('AI Voiceover Feature') }} <span class="text-muted">({{ __('For User & Subscriber Groups') }})</span> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
											<select id="voiceover-feature-user" name="voiceover-feature-user" data-placeholder="{{ __('Set AI Voiceover Permission') }}">
												<option value='allow' @if (config('settings.voiceover_feature_user') == 'allow') selected @endif>{{ __('Allow') }}</option>
												<option value='deny' @if (config('settings.voiceover_feature_user') == 'deny') selected @endif> {{ __('Deny') }}</option>																															
											</select>
										</div>
									</div>	

									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- EFFECTS -->
										<div class="input-box">	
											<h6>{{ __('SSML Effects') }}</h6>
											  <select id="set-ssml-effects" name="set-ssml-effects" data-placeholder="{{ __('Configure SSML Effects') }}">			
												<option value="enable" @if ( config('settings.voiceover_ssml_effect')  == 'enable') selected @endif>{{ __('Enable All') }}</option>
												<option value="disable" @if ( config('settings.voiceover_ssml_effect')  == 'disable') selected @endif>{{ __('Disable All') }}</option>
											</select>
										</div> <!-- END EFFECTS -->							
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- LANGUAGE -->
										<div class="input-box">	
											<h6>{{ __('Default Language') }}</h6>
											  <select id="languages" name="language" data-placeholder="{{ __('Select Default Language') }}" data-callback="language_select">			
												@foreach ($voiceover_languages as $language)
													<option value="{{ $language->language_code }}" data-img="{{ URL::asset($language->language_flag) }}" @if (config('settings.voiceover_default_language') == $language->language_code) selected @endif> {{ $language->language }}</option>
												@endforeach
											</select>
										</div> <!-- END LANGUAGE -->							
									</div>
		
									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- VOICE -->
										<div class="input-box">	
											<h6>{{ __('Default Voice') }}</h6>
											  <select id="voices" name="voice" data-placeholder="{{ __('Select Default Voice') }}" data-callback="default_voice">			
												@foreach ($voices as $voice)
													<option value="{{ $voice->voice_id }}" 	
														data-img="{{ URL::asset($voice->avatar_url) }}"										
														data-id="{{ $voice->voice_id }}" 
														data-lang="{{ $voice->language_code }}" 
														data-type="{{ $voice->voice_type }}"
														data-gender="{{ $voice->gender }}"
														@if (config('settings.voiceover_default_voice') == $voice->voice_id) selected @endif
														data-class="@if (config('settings.voiceover_default_language') !== $voice->language_code) remove-voice @endif"> 
														{{ $voice->voice }}  														
													</option>
												@endforeach
											</select>
										</div> <!-- END VOICE -->							
									</div>
																	
									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- MAX CHARACTERS -->
										<div class="input-box">								
											<h6>{{ __('Maximum Total Characters Synthesize Limit') }} <i class="ml-2 fa fa-info info-notification" data-tippy-content="{{ __('Maximum supported characters per single synthesize task can be up to 100000 characters. Each voice (textarea) has a limitation of up to 5000 characters, and you can combine up to 20 voices in a single task (20 voices x 5000 textarea limit = 100000)') }}."></i></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('set-max-chars') is-danger @enderror" id="set-max-chars" name="set-max-chars" placeholder="Ex: 3000" value="{{ config('settings.voiceover_max_chars_limit') }}">
												@error('set-max-chars')
													<p class="text-danger">{{ $errors->first('set-max-chars') }}</p>
												@enderror
											</div> 
										</div> <!-- END MAX CHARACTERS -->							
									</div>
		
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>{{ __('Maximum Concurrent Voices Limit') }} <i class="ml-2 fa fa-info info-notification" data-tippy-content="{{ __('You can mix up to 20 different voices in a single synthesize task. Each voice can synthesize up to 5000 characters, total characters can not exceed the limit set by Maximum Characters Synthesize Limit field.') }}"></i></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('set-max-voices') is-danger @enderror" id="set-max-voices" name="set-max-voices" placeholder="Ex: 5" value="{{ config('settings.voiceover_max_voice_limit') }}">
												@error('set-max-voices')
													<p class="text-danger">{{ $errors->first('set-max-voices') }}</p>
												@enderror
											</div> 
										</div>							
									</div>	
									
									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- STORAGE OPTION -->
										<div class="input-box">	
											<h6>{{ __('Default Storage for AI Voiceovers') }}</h6>
											  <select id="set-storage-option" name="set-storage-option" data-placeholder="{{ __('Select Default Storage for AI Voiceover') }}">			
												<option value="local" @if ( config('settings.voiceover_default_storage')  == 'local') selected @endif>{{ __('Local Server Storage') }}</option>
												<option value="aws" @if ( config('settings.voiceover_default_storage')  == 'aws') selected @endif>Amazon Web Services</option>
												<option value="wasabi" @if ( config('settings.voiceover_default_storage')  == 'wasabi') selected @endif>Wasabi Cloud</option>
											</select>
										</div> <!-- END STORAGE OPTION -->							
									</div>
		
									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- STORAGE OPTION -->
										<div class="input-box">	
											<h6>{{ __('Delete AI Voiceover Result After') }} <span class="text-muted">({{ __('In Days') }}) ({{ __('For All Groups') }})</span><span class="text-required"><i class="fa-solid fa-asterisk"></i></span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Default days after which generated AI Voiceovers will be deleted, use 0 for never delete. Subscribers can overwrite this baed on their subscription plans') }}"></i></h6>
											<input type="number" class="form-control @error('voiceover-default-duration') is-danger @enderror" id="voiceover-default-duration" name="voiceover-default-duration" value="{{ config('settings.voiceover_default_duration') }}">
											@error('voiceover-default-duration')
												<p class="text-danger">{{ $errors->first('voiceover-default-duration') }}</p>
											@enderror
										</div> <!-- END STORAGE OPTION -->							
									</div>
		
								</div>		
							</div>
						</div>

						<div class="card border-0 special-shadow mb-7">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="fa-sharp fa-solid fa-folder-music text-info fs-14 mr-2"></i>{{ __('AI Speech to Text Settings') }} <span class="text-muted">({{ __('For All Groups') }})</span></h6>

								<div class="row">

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">
											<h6>{{ __('AI Speech to Text Feature') }} <span class="text-muted">({{ __('For User & Subscriber Groups') }})</span> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
											<select id="whisper-feature-user" name="whisper-feature-user" data-placeholder="{{ __('Set AI Speech to Text Permission') }}">
												<option value='allow' @if (config('settings.whisper_feature_user') == 'allow') selected @endif>{{ __('Allow') }}</option>
												<option value='deny' @if (config('settings.whisper_feature_user') == 'deny') selected @endif> {{ __('Deny') }}</option>																															
											</select>
										</div>
									</div>
																	
									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- MAX CHARACTERS -->
										<div class="input-box">								
											<h6>{{ __('Maximum Allowed Audio File Size') }} <i class="ml-2 fa fa-info info-notification" data-tippy-content="{{ __('OpenAI supports audio files only up to 25MB') }}."></i></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('set-max-audio-size') is-danger @enderror" id="set-max-audio-size" name="set-max-audio-size" placeholder="Ex: 25" value="{{ config('settings.whisper_max_audio_size') }}">
												@error('set-max-audio-size')
													<p class="text-danger">{{ $errors->first('set-max-audio-size') }}</p>
												@enderror
											</div> 
										</div> <!-- END MAX CHARACTERS -->							
									</div>
		
									
									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- STORAGE OPTION -->
										<div class="input-box">	
											<h6>{{ __('Default Storage for AI Speech to Text') }}</h6>
											  <select id="set-whisper-storage-option" name="set-whisper-storage-option" data-placeholder="{{ __('Select Default Storage for AI Speech to Text') }}">			
												<option value="local" @if ( config('settings.whisper_default_storage')  == 'local') selected @endif>{{ __('Local Server Storage') }}</option>
												<option value="aws" @if ( config('settings.whisper_default_storage')  == 'aws') selected @endif>Amazon Web Services</option>
												<option value="wasabi" @if ( config('settings.whisper_default_storage')  == 'wasabi') selected @endif>Wasabi Cloud</option>
											</select>
										</div> <!-- END STORAGE OPTION -->							
									</div>
		
									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- STORAGE OPTION -->
										<div class="input-box">	
											<h6>{{ __('Delete AI Speech to Text Result After') }} <span class="text-muted">({{ __('In Days') }}) ({{ __('For All Groups') }})</span><span class="text-required"><i class="fa-solid fa-asterisk"></i></span><i class="ml-3 text-dark fs-13 fa-solid fa-circle-info" data-tippy-content="{{ __('Default days after which transcribed AI Speech to Text will be deleted, use 0 for never delete. Subscribers can overwrite this baed on their subscription plans') }}"></i></h6>
											<input type="number" class="form-control @error('whisper-default-duration') is-danger @enderror" id="whisper-default-duration" name="whisper-default-duration" value="{{ config('settings.whisper_default_duration') }}">
											@error('whisper-default-duration')
												<p class="text-danger">{{ $errors->first('whisper-default-duration') }}</p>
											@enderror
										</div> <!-- END STORAGE OPTION -->							
									</div>								
								</div>		
							</div>
						</div>

						<div class="card border-0 special-shadow mb-7">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><img src="{{URL::asset('img/csp/openai-sm.png')}}" class="fw-2 mr-2" alt="">{{ __('OpenAI') }}</h6>

								<div class="row">
									<div class="col-lg-12 col-md-6 col-sm-12">
										<div class="row">								
											<div class="col-md-6 col-sm-12">
												<div class="input-box mb-0">								
													<h6>{{ __('OpenAI Secret Key') }} <span class="text-muted">({{ __('Main API Key') }})</span> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<div class="form-group">							    
														<input type="text" class="form-control @error('secret-key') is-danger @enderror" id="secret-key" name="secret-key" value="{{ config('services.openai.key') }}" autocomplete="off">
														@error('secret-key')
															<p class="text-danger">{{ $errors->first('secret-key') }}</p>
														@enderror
													</div> 												
												</div> 
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="input-box mb-0">								
													<h6>{{ __('Openai API Key Usage Model') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<select id="openai-key-usage" class="mb-0" name="openai-key-usage" data-placeholder="{{ __('Set API Key Usage Model') }}">
														<option value="main" @if (config('settings.openai_key_usage') == 'main') selected @endif>{{ __('Only Main API Key') }}</option>
														<option value="random" @if (config('settings.openai_key_usage') == 'random') selected @endif>{{ __('Random API Key') }}</option>																																																																																																									
													</select>
												</div> 
											</div>
										</div>
										<a href="{{ route('admin.davinci.configs.keys') }}" class="btn btn-primary mt-3">{{ __('Store additional OpenAI API Keys') }}</a>
									</div>							
								</div>
	
							</div>
						</div>		

						<div class="card border-0 special-shadow mb-7">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><img src="{{URL::asset('img/csp/stability-sm.png')}}" class="fw-2 mr-2" alt="">{{ __('Stable Diffusion') }}</h6>

								<div class="row">
									<div class="col-lg-12 col-md-6 col-sm-12 no-gutters">
										<div class="row">							
											<div class="col-md-6 col-sm-12">
												<div class="input-box mb-0">								
													<h6>{{ __('Stable Diffusion API Key') }} <span class="text-muted">({{ __('Main API Key') }})</span><span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<div class="form-group">							    
														<input type="text" class="form-control @error('stable-diffusion-key') is-danger @enderror" id="stable-diffusion-key" name="stable-diffusion-key" value="{{ config('services.stable_diffusion.key') }}" autocomplete="off">
														@error('stable-diffusion-key')
															<p class="text-danger">{{ $errors->first('stable-diffusion-key') }}</p>
														@enderror												
													</div> 
												</div> 
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="input-box mb-0">								
													<h6>{{ __('SD API Key Usage Model') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
													<select id="sd-key-usage" class="mb-0" name="sd-key-usage" data-placeholder="{{ __('Set API Key Usage Model') }}">
														<option value="main" @if (config('settings.sd_key_usage') == 'main') selected @endif>{{ __('Only Main API Key') }}</option>
														<option value="random" @if (config('settings.sd_key_usage') == 'random') selected @endif>{{ __('Random API Key') }}</option>																																																																																																									
													</select>
												</div> 
											</div>
										</div>
										<a href="{{ route('admin.davinci.configs.keys') }}" class="btn btn-primary mt-3">{{ __('Store additional SD API Keys') }}</a>
									</div>							
								</div>
	
							</div>
						</div>	
						
						<div class="card border-0 special-shadow mb-7">							
							<div class="card-body">
								<h6 class="fs-12 font-weight-bold mb-4"><img src="{{URL::asset('img/csp/aws-sm.png')}}" class="fw-2 mr-2" alt="">{{ __('Amazon Web Services') }}</h6>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('AWS Access Key') }}  <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('set-aws-access-key') is-danger @enderror" id="aws-access-key" name="set-aws-access-key" value="{{ config('services.aws.key') }}" autocomplete="off">
												@error('set-aws-access-key')
													<p class="text-danger">{{ $errors->first('set-aws-access-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- SECRET ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('AWS Secret Access Key') }}  <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6> 
											<div class="form-group">							    
												<input type="text" class="form-control @error('set-aws-secret-access-key') is-danger @enderror" id="aws-secret-access-key" name="set-aws-secret-access-key" value="{{ config('services.aws.secret') }}" autocomplete="off">
												@error('set-aws-secret-access-key')
													<p class="text-danger">{{ $errors->first('set-aws-secret-access-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END SECRET ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('Amazon S3 Bucket Name') }}  <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('set-aws-bucket') is-danger @enderror" id="aws-bucket" name="set-aws-bucket" value="{{ config('services.aws.bucket') }}" autocomplete="off">
												@error('set-aws-bucket')
													<p class="text-danger">{{ $errors->first('set-aws-bucket') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- AWS REGION -->
										<div class="input-box">	
											<h6>{{ __('Set AWS Region') }}  <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
											<select id="set-aws-region" name="set-aws-region" data-placeholder="Select Default AWS Region:">			
												<option value="us-east-1" @if ( config('services.aws.region')  == 'us-east-1') selected @endif>{{ __('US East (N. Virginia) us-east-1') }}</option>
												<option value="us-east-2" @if ( config('services.aws.region')  == 'us-east-2') selected @endif>{{ __('US East (Ohio) us-east-2') }}</option>
												<option value="us-west-1" @if ( config('services.aws.region')  == 'us-west-1') selected @endif>{{ __('US West (N. California) us-west-1') }}</option>
												<option value="us-west-2" @if ( config('services.aws.region')  == 'us-west-2') selected @endif>{{ __('US West (Oregon) us-west-2') }}</option>
												<option value="ap-east-1" @if ( config('services.aws.region')  == 'ap-east-1') selected @endif>{{ __('Asia Pacific (Hong Kong) ap-east-1') }}</option>
												<option value="ap-south-1" @if ( config('services.aws.region')  == 'ap-south-1') selected @endif>{{ __('Asia Pacific (Mumbai) ap-south-1') }}</option>
												<option value="ap-northeast-3" @if ( config('services.aws.region')  == 'ap-northeast-3') selected @endif>{{ __('Asia Pacific (Osaka) ap-northeast-3') }}</option>
												<option value="ap-northeast-2" @if ( config('services.aws.region')  == 'ap-northeast-2') selected @endif>{{ __('Asia Pacific (Seoul) ap-northeast-2') }}</option>
												<option value="ap-southeast-1" @if ( config('services.aws.region')  == 'ap-southeast-1') selected @endif>{{ __('Asia Pacific (Singapore) ap-southeast-1') }}</option>
												<option value="ap-southeast-2" @if ( config('services.aws.region')  == 'ap-southeast-2') selected @endif>{{ __('Asia Pacific (Sydney) ap-southeast-2') }}</option>
												<option value="ap-northeast-1" @if ( config('services.aws.region')  == 'ap-northeast-1') selected @endif>{{ __('Asia Pacific (Tokyo) ap-northeast-1') }}</option>
												<option value="ap-northeast-1" @if ( config('services.aws.region')  == 'ap-northeast-1') selected @endif>{{ __('Asia Pacific (Hyderabad) ap-south-2') }}</option>
												<option value="ap-northeast-1" @if ( config('services.aws.region')  == 'ap-northeast-1') selected @endif>{{ __('Asia Pacific (Jakarta) ap-southeast-3') }}</option>
												<option value="eu-central-1" @if ( config('services.aws.region')  == 'eu-central-1') selected @endif>{{ __('Europe (Frankfurt) eu-central-1') }}</option>
												<option value="eu-central-1" @if ( config('services.aws.region')  == 'eu-central-1') selected @endif>{{ __('Europe (Zurich) eu-central-2') }}</option>
												<option value="eu-west-1" @if ( config('services.aws.region')  == 'eu-west-1') selected @endif>{{ __('Europe (Ireland) eu-west-1') }}</option>
												<option value="eu-west-2" @if ( config('services.aws.region')  == 'eu-west-2') selected @endif>{{ __('Europe (London) eu-west-2') }}</option>
												<option value="eu-south-1" @if ( config('services.aws.region')  == 'eu-south-1') selected @endif>{{ __('Europe (Milan) eu-south-1') }}</option>
												<option value="eu-south-1" @if ( config('services.aws.region')  == 'eu-south-1') selected @endif>{{ __('Europe (Spain) eu-south-2') }}</option>
												<option value="eu-west-3" @if ( config('services.aws.region')  == 'eu-west-3') selected @endif>{{ __('Europe (Paris) eu-west-3') }}</option>
												<option value="eu-north-1" @if ( config('services.aws.region')  == 'eu-north-1') selected @endif>{{ __('Europe (Stockholm) eu-north-1') }}</option>
												<option value="me-south-1" @if ( config('services.aws.region')  == 'me-south-1') selected @endif>{{ __('Middle East (Bahrain) me-south-1') }}</option>
												<option value="me-south-1" @if ( config('services.aws.region')  == 'me-south-1') selected @endif>{{ __('Middle East (UAE) me-central-1') }}</option>
												<option value="sa-east-1" @if ( config('services.aws.region')  == 'sa-east-1') selected @endif>{{ __('South America (São Paulo) sa-east-1') }}</option>
												<option value="ca-central-1" @if ( config('services.aws.region')  == 'ca-central-1') selected @endif>{{ __('Canada (Central) ca-central-1') }}</option>
												<option value="af-south-1" @if ( config('services.aws.region')  == 'af-south-1') selected @endif>{{ __('Africa (Cape Town) af-south-1') }}</option>
											</select>
										</div> <!-- END AWS REGION -->									
									</div>									
		
								</div>
	
							</div>
						</div>	

						<div class="card border-0 special-shadow mb-7">							
							<div class="card-body">
								<h6 class="fs-12 font-weight-bold mb-4"><img src="{{URL::asset('img/csp/wasabi-sm.png')}}" class="fw-2 mr-2" alt="">{{ __('Wasabi Cloud Storage') }}</h6>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('Wasabi Access Key') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('set-wasabi-access-key') is-danger @enderror" id="wasabi-access-key" name="set-wasabi-access-key" value="{{ config('services.wasabi.key') }}" autocomplete="off">
												@error('set-wasabi-access-key')
													<p class="text-danger">{{ $errors->first('set-wasabi-access-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- SECRET ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('Wasabi Secret Access Key') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6> 
											<div class="form-group">							    
												<input type="text" class="form-control @error('set-wasabi-secret-access-key') is-danger @enderror" id="wasabi-secret-access-key" name="set-wasabi-secret-access-key" value="{{ config('services.wasabi.secret') }}" autocomplete="off">
												@error('set-wasabi-secret-access-key')
													<p class="text-danger">{{ $errors->first('set-wasabi-secret-access-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END SECRET ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('Wasabi Bucket Name') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('set-wasabi-bucket') is-danger @enderror" id="wasabi-bucket" name="set-wasabi-bucket" value="{{ config('services.wasabi.bucket') }}" autocomplete="off">
												@error('set-wasabi-bucket')
													<p class="text-danger">{{ $errors->first('set-wasabi-bucket') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- AWS REGION -->
										<div class="input-box">	
											<h6>{{ __('Set Wasabi Region') }}  <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
											  <select id="set-wasabi-region" name="set-wasabi-region" data-placeholder="Select Default Wasabi Region:">			
												<option value="us-west-1" @if ( config('services.wasabi.region')  == 'us-west-1') selected @endif>{{ __('US Oregon us-west-1') }}</option>
												<option value="us-central-1" @if ( config('services.wasabi.region')  == 'us-central-1') selected @endif>{{ __('US Texas us-central-1') }}</option>
												<option value="us-east-1" @if ( config('services.wasabi.region')  == 'us-east-1') selected @endif>{{ __('US N.Virginia us-east-1') }}</option>
												<option value="us-east-2" @if ( config('services.wasabi.region')  == 'us-east-2') selected @endif>{{ __('US N.Virginia us-east-2') }}</option>
												<option value="ap-northeast-1" @if ( config('services.wasabi.region')  == 'ap-northeast-1') selected @endif>{{ __('Asia Pacific Tokyo ap-northeast-1') }}</option>
												<option value="ap-northeast-2" @if ( config('services.wasabi.region')  == 'ap-northeast-2') selected @endif>{{ __('Asia Pacific Osaka ap-northeast-2') }}</option>
												<option value="ap-sotheast-1" @if ( config('services.wasabi.region')  == 'ap-sotheast-1') selected @endif>{{ __('Asia Pacific Singapore ap-sotheast-1') }}</option>
												<option value="ap-southeast-2" @if ( config('services.wasabi.region')  == 'ap-southeast-2') selected @endif>{{ __('Asia Pacific Sydney ap-southeast-2') }}</option>
												<option value="ca-central-1" @if ( config('services.wasabi.region')  == 'ca-central-1') selected @endif>{{ __('Canada Toronto ca-central-1') }}</option>
												<option value="eu-central-1" @if ( config('services.wasabi.region')  == 'eu-central-1') selected @endif>{{ __('Europe Amsterdam eu-central-1') }}</option>
												<option value="eu-central-2" @if ( config('services.wasabi.region')  == 'eu-central-2') selected @endif>{{ __('Europe Frankfurt eu-central-2') }}</option>
												<option value="eu-west-1" @if ( config('services.wasabi.region')  == 'eu-west-1') selected @endif>{{ __('Europe London eu-west-1') }}</option>
												<option value="eu-west-2" @if ( config('services.wasabi.region')  == 'eu-west-2') selected @endif>{{ __('Europe Paris eu-west-2') }}</option>
											</select>
										</div> <!-- END AWS REGION -->									
									</div>								
		
								</div>
	
							</div>
						</div>

						<div class="card border-0 special-shadow mb-7">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><img src="{{URL::asset('img/csp/azure-sm.png')}}" class="fw-2 mr-2" alt="">{{ __('Azure Voiceover Settings') }}</h6>

								<div class="form-group">
									<label class="custom-switch">
										<input type="checkbox" name="enable-azure" class="custom-switch-input" @if ( config('settings.enable.azure')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Activate Azure Voices') }}</span>
									</label>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('Azure Key') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('set-azure-key') is-danger @enderror" id="set-azure-key" name="set-azure-key" value="{{ config('services.azure.key') }}" autocomplete="off">
												@error('set-azure-key')
													<p class="text-danger">{{ $errors->first('set-azure-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- AZURE REGION -->
										<div class="input-box">	
											<h6>{{ __('Azure Region') }}</h6>
											  <select id="set-azure-region" name="set-azure-region" data-placeholder="Select Azure Region:">			
												<option value="australiaeast" @if ( config('services.azure.region')  == 'australiaeast') selected @endif>Australia East (australiaeast)</option>
												<option value="brazilsouth" @if ( config('services.azure.region')  == 'brazilsouth') selected @endif>Brazil South (brazilsouth)</option>
												<option value="canadacentral" @if ( config('services.azure.region')  == 'canadacentral') selected @endif>Canada Central (canadacentral)</option>
												<option value="centralus" @if ( config('services.azure.region')  == 'centralus') selected @endif>Central US (centralus)</option>
												<option value="eastasia" @if ( config('services.azure.region')  == 'eastasia') selected @endif>East Asia (eastasia)</option>
												<option value="eastus" @if ( config('services.azure.region')  == 'eastus') selected @endif>East US (eastus)</option>
												<option value="eastus2" @if ( config('services.azure.region')  == 'eastus2') selected @endif>East US 2 (eastus2)</option>
												<option value="francecentral" @if ( config('services.azure.region')  == 'francecentral') selected @endif>France Central (francecentral)</option>
												<option value="centralindia" @if ( config('services.azure.region')  == 'centralindia') selected @endif>India Central (centralindia)</option>
												<option value="japaneast" @if ( config('services.azure.region')  == 'japaneast') selected @endif>Japan East (japaneast)</option>
												<option value="japanwest" @if ( config('services.azure.region')  == 'japanwest') selected @endif>Japan West (japanwest)</option>
												<option value="koreacentral" @if ( config('services.azure.region')  == 'koreacentral') selected @endif>Korea Central (koreacentral)</option>
												<option value="northcentralus" @if ( config('services.azure.region')  == 'northcentralus') selected @endif>North Central US (northcentralus)</option>
												<option value="northeurope" @if ( config('services.azure.region')  == 'northeurope') selected @endif>North Europe (northeurope)</option>
												<option value="southcentralus" @if ( config('services.azure.region')  == 'southcentralus') selected @endif>South Central US (southcentralus)</option>
												<option value="southeastasia" @if ( config('services.azure.region')  == 'southeastasia') selected @endif>Southeast Asia (southeastasia)</option>
												<option value="uksouth" @if ( config('services.azure.region')  == 'uksouth') selected @endif>UK South (uksouth)</option>
												<option value="westcentralus" @if ( config('services.azure.region')  == 'westcentralus') selected @endif>West Central US (westcentralus)</option>
												<option value="westeurope" @if ( config('services.azure.region')  == 'westeurope') selected @endif>West Europe (westeurope)</option>
												<option value="westus" @if ( config('services.azure.region')  == 'westus') selected @endif>West US (westus)</option>
												<option value="westus2" @if ( config('services.azure.region')  == 'westus2') selected @endif>West US 2 (westus2)</option>
											</select>
										</div> <!-- END AZURE REGION -->									
									</div>

								</div>
	
							</div>
						</div>

						<div class="card border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><img src="{{URL::asset('img/csp/gcp-sm.png')}}" class="fw-2 mr-2" alt="">{{ __('GCP Voiceover Settings') }}</h6>

								<div class="form-group">
									<label class="custom-switch">
										<input type="checkbox" name="enable-gcp" class="custom-switch-input" @if ( config('settings.enable.gcp')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Activate GCP Voices') }}</span>
									</label>
								</div>

								<div class="row">
									<div class="col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>{{ __('GCP Configuration File Path') }}<i class="ml-2 fa fa-info info-notification" data-tippy-content="{{ __('Absolute path of your GCP Json file in your hosting. Make sure there are no spaces in the path name') }}."></i></h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('gcp-configuration-path') is-danger @enderror" id="gcp-configuration-path" name="gcp-configuration-path" value="{{ config('services.gcp.key_path') }}" autocomplete="off">
												@error('gcp-configuration-path')
													<p class="text-danger">{{ $errors->first('gcp-configuration-path') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>								
								</div>
	
							</div>
						</div>	

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<a href="{{ route('admin.davinci.dashboard') }}" class="btn btn-cancel mr-2">{{ __('Cancel') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('Save') }}</button>							
						</div>				

					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script src="{{URL::asset('js/admin-config.js')}}"></script>
@endsection