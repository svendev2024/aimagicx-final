@extends('layouts.app')
@section('css')
	<!-- Data Table CSS -->
	<link href="{{URL::asset('plugins/datatable/datatables.min.css')}}" rel="stylesheet" />
	<!-- Sweet Alert CSS -->
	<link href="{{URL::asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('plugins/photoviewer/photoviewer.min.css')}}" rel="stylesheet" />
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
									<i class="fa-solid fa-image green-icon"></i>
								</div>
								<div>
									<h6 class="mt-1 ml-3 fs-16 number-font">{{ __('AI Image Generator') }}</h6>
								</div>									
							</div>								
							<div class="template-info">
								<p class="fs-12 text-muted mb-4">{{ __('Turn any of your text into sophisticated image') }}</p>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div class="text-left mb-4" id="balance-status">
								<span class="fs-11 text-muted pl-3"><i class="fa-sharp fa-solid fa-bolt-lightning mr-2 text-primary"></i>{{ __('Your Balance is') }} <span class="font-weight-semibold" id="balance-number">{{ number_format(auth()->user()->available_images + auth()->user()->available_images_prepaid) }}</span> {{ __('Images') }}</span>
							</div>							
						</div>
						<div class="col-sm-12">								
							<div class="input-box">	
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Image Name') }}  <span class="text-muted">({{ __('optional') }})</span></h6>									
								<div class="form-group">						    
									<input type="text" class="form-control @error('name') is-danger @enderror" id="name" name="name" value="{{ __('New Image') }}">
									@error('name')
										<p class="text-danger">{{ $errors->first('name') }}</p>
									@enderror
								</div> 
							</div> 
						</div>

						<div class="col-sm-12">								
							<div class="input-box">	
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Image Description') }}  <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>									
								<div class="form-group">						    
									<textarea rows="5" cols="50" class="form-control @error('title') is-danger @enderror" id="title" name="title" placeholder="{{ __('e.g. Spaceship flying to the moon') }}" required></textarea>
									@error('title')
										<p class="text-danger">{{ $errors->first('title') }}</p>
									@enderror
								</div> 
							</div> 
						</div>

						<div class="col-lg-12 col-md-12 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Artist Name') }}</h6>
								<select id="artist" name="artist" data-placeholder="{{ __('Select Artist Name') }}">
									<option value='none' selected>{{ __('None') }}</option>																																																												
									<option value="Leonardo da Vinci (Renaissance)">{{ __('Leonardo da Vinci (Renaissance)') }}</option>																																																																																																																																																																																	
									<option value="Vincent van Gogh (Impressionists and Neo-Impressionists)">{{ __('Vincent van Gogh (Impressionists and Neo-Impressionists)') }}</option>																																																																																																																																																																																	
									<option value="Pablo Picasso (Cubism)">{{ __('Pablo Picasso (Cubism)') }}</option>																																																																																																																																																																																	
									<option value="Salvador Dali (Surrealism)">{{ __('Salvador Dali (Surrealism)') }}</option>																																																																																																																																																																																	
									<option value="Banksy (Street Art)">{{ __('Banksy (Street Art)') }}</option>																																																																																																																																																																																	
									<option value="Takashi Murakami (Superflat)">{{ __('Takashi Murakami (Superflat)') }}</option>																																																																																																																																																																																	
									<option value="George Condo (Artificial Realism)">{{ __('George Condo (Artificial Realism)') }}</option>																																																																																																																																																																																	
									<option value="Tim Burton (Expressionism)">{{ __('Tim Burton (Expressionism)') }}</option>																																																																																																																																																																																	
									<option value="Normal Rockwell (exaggerated realism)">{{ __('Normal Rockwell (Exaggerated Realism)') }}</option>																																																																																																																																																																																	
									<option value="Andy Warhol (Pop Art)">{{ __('Andy Warhol (Pop Art)') }}</option>																																																																																																																																																																																	
									<option value="Claude Monet (Impressionism-Nature)">{{ __('Claude Monet (Impressionism-Nature)') }}</option>																																																																																																																																																																																	
									<option value="Robert Wyland (outdoor murals)">{{ __('Robert Wyland (Outdoor Murals)') }}</option>																																																																																																																																																																																	
									<option value="Thomas Kinkade (luminism)">{{ __('Thomas Kinkade (Luminism)') }}</option>																																																																																																																																																																																	
									<option value="Michelangelo (Fresco Art)">{{ __('Michelangelo (Fresco Art)') }}</option>																																																																																																																																																																																	
									<option value="Johannes Vermeer (impressionist)">{{ __('Johannes Vermeer (Impressionist)') }}</option>																																																																																																																																																																																	
									<option value="Gustav Klimt (fresco-secco)">{{ __('Gustav Klimt (Fresco-Secco)') }}</option>																																																																																																																																																																																	
									<option value="Sandro Botticelli (egg tempera)">{{ __('Sandro Botticelli (Egg Tempera)') }}</option>																																																																																																																																																																																	
									<option value="James Abbott (Impressionist)">{{ __('James Abbott (Impressionist)') }}</option>																																																																																																																																																																																	
									<option value="McNeill Whistler (Realism)">{{ __('McNeill Whistler (Realism)') }}</option>																																																																																																																																																																																	
									<option value="Jan van Eyck (Oil Panting)">{{ __('Jan van Eyck (Oil Panting)') }}</option>																																																																																																																																																																																	
									<option value="Hieronymus Bosch (Flemish painting)">{{ __('Hieronymus Bosch (Flemish Painting)') }}</option>																																																																																																																																																																																	
									<option value="Georges Seurat (pointillism)">{{ __('Georges Seurat (Pointillism)') }}</option>																																																																																																																																																																																	
									<option value="Pieter Bruegel (Flemish Renaissance)">{{ __('Pieter Bruegel (Flemish Renaissance)') }}</option>																																																																																																																																																																																	
									<option value="Diego Rodríguez (portraiture and scene painting)">{{ __('Diego Rodríguez (Portraiture and Scene Painting)') }}</option>																																																																																																																																																																																	
									<option value="Silva Velázquez (Baroque)">{{ __('Silva Velázquez (Baroque)') }}</option>																																																																																																																																																																																	
									<option value="John Bramblitt (impressionism Pop Art)">{{ __('John Bramblitt (impressionism Pop Art)') }}</option>																																																																																																																																																																																	
									<option value="Beeple (3d art)">{{ __('Beeple (3D Art)') }}</option>																																																																																																																																																																																	
									<option value="Sam Gilliam (Abstract)">{{ __('Sam Gilliam (Abstract)') }}</option>																																																																																																																																																																																	
									<option value="Hayao Miyazaki (Anime)">{{ __('Hayao Miyazaki (Anime)') }}</option>																																																																																																																																																																																
									<option value="datfootdive (Vaperwave)">{{ __('Datfootdive (Vaperwave)') }}</option>																																																																																																																																																																																
									<option value="Keith Thompson (Steampunk)">{{ __('Keith Thompson (Steampunk)') }}</option>																																																																																																																																																																																
									<option value="Johnny Silverhand (Cyberpunk)">{{ __('Johnny Silverhand (Cyberpunk)') }}</option>																																																																																																																																																																																
								</select>
							</div>
						</div>

						<div class="col-lg-6 col-md-12 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Image Style') }}</h6>
								<select id="style" name="style" data-placeholder="{{ __('Select Image Style') }}">
									@if (config('settings.image_vendor') == 'openai')
										<option value='none' selected>{{ __('None') }}</option>																																																												
										<option value='abstract'>{{ __('Abstract') }}</option>																																																												
										<option value='realistic'>{{ __('Realistic') }}</option>																																																												
										<option value='3d render'>{{ __('3D Render') }}</option>																																																												
										<option value='cartoon'>{{ __('Cartoon') }}</option>																																																												
										<option value='anime'>{{ __('Anime') }}</option>																																																												
										<option value='digital art'>{{ __('Digital Art') }}</option>
										<option value='modern'>{{ __('Modern') }}</option>																																																												
										<option value='art deco'>{{ __('Art Deco') }}</option>																																																												
										<option value='illustration'>{{ __('Illustration') }}</option>																																																												
										<option value='origami'>{{ __('Origami') }}</option>																																																												
										<option value='pixel art'>{{ __('Pixel Art') }}</option>																																																												
										<option value='retro'>{{ __('Retro') }}</option>																																																												
										<option value='photography'>{{ __('Photography') }}</option>																																																												
										<option value='line art'>{{ __('Line Art') }}</option>																																																												
										<option value='pop art'>{{ __('Pop Art') }}</option>																																																																																																																						
										<option value='vaporwave'>{{ __('Vaporwave') }}</option>																																																												
										<option value='pencil drawing'>{{ __('Pencil Drawing') }}</option>																																																												
										<option value='renaissance'>{{ __('Renaissance') }}</option>																																																												
										<option value='minimalism'>{{ __('Minimalism') }}</option>																																																																																																																							
										<option value='sticker'>{{ __('Sticker') }}</option>																																																																																																																							
										<option value='isometric'>{{ __('Isometric') }}</option>																																																																																																																							
										<option value='cyberpunk'>{{ __('Cyberpunk') }}</option>																																																																																																																							
										<option value='ballpoint pen drawing'>{{ __('Ballpoint Pen Drawing') }}</option>																																																																																																																																																																																																																																													
										<option value='steampunk'>{{ __('Steampunk') }}</option>																																																																																																																																																																																																																																													
										<option value='glitchcore'>{{ __('Glitchcore') }}</option>																																																																																																																																																																																																																																													
										<option value='bauhaus'>{{ __('Bauhaus') }}</option>																																																																																																																																																																																																																																													
										<option value='vector'>{{ __('Vector') }}</option>																																																																																																																																																																																																																																													
										<option value='low poly'>{{ __('Low Poly') }}</option>																																																																																																																																																																																																																																													
										<option value='ukiyo-e'>{{ __('Ukiyo-e') }}</option>																																																																																																																																																																																																																																													
										<option value='cubism'>{{ __('Cubism') }}</option>																																																																																																																																																																																																																																													
										<option value='contemporary'>{{ __('Contemporary') }}</option>																																																																																																																																																																																																																																													
										<option value='impressionism'>{{ __('Impressionism') }}</option>																																																																																																																																																																																																																																													
										<option value='pointilism'>{{ __('Pointilism') }}</option>	
									@else
										<option value='none' selected>{{ __('None') }}</option>																																																																																																																							
										<option value='3d-model'>{{ __('3D Model') }}</option>																																																																																																																							
										<option value='analog-film'>{{ __('Analog Film') }}</option>																																																																																																																							
										<option value='anime'>{{ __('Anime') }}</option>																																																																																																																							
										<option value='cinematic'>{{ __('Cinematic') }}</option>																																																																																																																																																																																																																																													
										<option value='comic-book'>{{ __('Comic Book') }}</option>																																																																																																																																																																																																																																													
										<option value='digital-art'>{{ __('Digital Art') }}</option>																																																																																																																																																																																																																																													
										<option value='enhance'>{{ __('Enhance') }}</option>																																																																																																																																																																																																																																													
										<option value='fantasy-art'>{{ __('Fantasy Art') }}</option>																																																																																																																																																																																																																																													
										<option value='isometric'>{{ __('Isometric') }}</option>																																																																																																																																																																																																																																													
										<option value='line-art'>{{ __('Line Art') }}</option>																																																																																																																																																																																																																																													
										<option value='low-poly'>{{ __('Low Poly') }}</option>																																																																																																																																																																																																																																													
										<option value='modeling-compound'>{{ __('Modeling Compound') }}</option>																																																																																																																																																																																																																																													
										<option value='neon-punk'>{{ __('Neon Punk') }}</option>																																																																																																																																																																																																																																													
										<option value='origami'>{{ __('Origami') }}</option>	
										<option value='photographic'>{{ __('Photographic') }}</option>	
										<option value='pixel-art'>{{ __('Pixel Art') }}</option>	
										<option value='tile-texture'>{{ __('Tile Texture') }}</option>	
									@endif
																																																																																																																																																																																																																																																					
								</select>
							</div>
						</div>

						<div class="col-lg-6 col-md-12 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Image Medium') }}</h6>
								<select id="medium" name="medium" data-placeholder="{{ __('Select Image Medium') }}">
									<option value='none' selected>{{ __('None') }}</option>																																																												
									<option value='acrylic'>{{ __('Acrylic') }}</option>																																																																																																																																																																																		
									<option value='canvas'>{{ __('Canvas') }}</option>																																																																																																																																																																																		
									<option value='chalk'>{{ __('Chalk') }}</option>																																																																																																																																																																																		
									<option value='charcoal'>{{ __('Charcoal') }}</option>																																																																																																																																																																																		
									<option value='classic oil'>{{ __('Classic Oil') }}</option>																																																																																																																																																																																		
									<option value='crayon'>{{ __('Crayon') }}</option>																																																																																																																																																																																		
									<option value='glass'>{{ __('Glass') }}</option>																																																																																																																																																																																		
									<option value='ink'>{{ __('Ink') }}</option>																																																																																																																																																																																		
									<option value='paster'>{{ __('Pastel') }}</option>																																																																																																																																																																																		
									<option value='pencil'>{{ __('Pencil') }}</option>																																																																																																																																																																																		
									<option value='spray paint'>{{ __('Spray Paint') }}</option>																																																																																																																																																																																		
									<option value='watercolor'>{{ __('Watercolor') }}</option>																																																																																																																																																																																		
									<option value='wood panel'>{{ __('Wood Panel') }}</option>																																																																																																																																																																																		
								</select>
							</div>
						</div>

						<div class="col-lg-6 col-md-12 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Lighting Style') }}</h6>
								<select id="lightning" name="lightning" data-placeholder="{{ __('Select Image Lighting Style') }}">
									<option value='none' selected>{{ __('None') }}</option>																																																												
									<option value="warm">{{ __('Warm') }}</option>
                                    <option value="cold">{{ __('Cold') }}</option>
                                    <option value="golden hour">{{ __('Golden Hour') }}</option>
                                    <option value="blue hour">{{ __('Blue Hour') }}</option>
                                    <option value="ambient">{{ __('Ambient') }}</option>
                                    <option value="studio">{{ __('Studio') }}</option>
                                    <option value="neon">{{ __('Neon') }}</option>
                                    <option value="dramatic">{{ __('Dramatic') }}</option>
                                    <option value="cinematic">{{ __('Cinematic') }}</option>
                                    <option value="natural">{{ __('Natural') }}</option>
                                    <option value="foggy">{{ __('Foggy') }}</option>
                                    <option value="backlight">{{ __('Backlight') }}</option>
                                    <option value="hard">{{ __('Hard') }}</option>																																																																																																																																																																																		
                                    <option value="soft">{{ __('Soft') }}</option>																																																																																																																																																																																		
                                    <option value="irivescent">{{ __('Irivescent') }}</option>																																																																																																																																																																																		
                                    <option value="fluorescent">{{ __('Fluorescent') }}</option>																																																																																																																																																																																		
                                    <option value="decorative">{{ __('Decorative') }}</option>																																																																																																																																																																																		
                                    <option value="accent">{{ __('Accent') }}</option>																																																																																																																																																																																		
                                    <option value="task">{{ __('Task') }}</option>																																																																																																																																																																																		
                                    <option value="halogen">{{ __('Halogen') }}</option>																																																																																																																																																																																		
                                    <option value="light emitting diode">{{ __('Light Emitting Diode (LED)') }}</option>																																																																																																																																																																																		
								</select>
							</div>
						</div>

						<div class="col-lg-6 col-md-12 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Mood') }}</h6>
								<select id="mood" name="mood" data-placeholder="{{ __('Select Image Mood') }}">
									<option value='none' selected>{{ __('None') }}</option>																																																												
									<option value='angry'>{{ __('Angry') }}</option>																																																																																																																																																																																		
									<option value='agressive'>{{ __('Agressive') }}</option>																																																																																																																																																																																		
									<option value='boring'>{{ __('Boring') }}</option>																																																																																																																																																																																		
									<option value='bright'>{{ __('Bright') }}</option>																																																																																																																																																																																		
									<option value='calm'>{{ __('Calm') }}</option>																																																																																																																																																																																		
									<option value='cheerful'>{{ __('Cheerful') }}</option>																																																																																																																																																																																		
									<option value='chilling'>{{ __('Chilling') }}</option>																																																																																																																																																																																		
									<option value='colorful'>{{ __('Colorful') }}</option>																																																																																																																																																																																		
									<option value='happy'>{{ __('Happy') }}</option>																																																																																																																																																																																		
									<option value='dark'>{{ __('Dark') }}</option>																																																																																																																																																																																		
									<option value='neutral'>{{ __('Neutral') }}</option>																																																																																																																																																																																		
									<option value='sad'>{{ __('Sad') }}</option>																																																																																																																																																																																		
									<option value='crying'>{{ __('Crying') }}</option>																																																																																																																																																																																		
									<option value='disappointed'>{{ __('Disappointed') }}</option>																																																																																																																																																																																		
									<option value='flirt'>{{ __('Flirt') }}</option>																																																																																																																																																																																		
								</select>
							</div>
						</div>

						@if (config('settings.image_vendor') == 'stable_diffusion')
							<div class="col-lg-6 col-md-12 col-sm-12">
								<div id="form-group">
									<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Image Diffusion Samples') }}</h6>
									<select id="diffusion-samples" name="diffusion_samples" data-placeholder="{{ __('Set Image Diffusion Samples') }}">
										<option value='none' selected>{{ __('Auto') }}</option>																																																												
										<option value='DDIM'>{{ __('DDIM') }}</option>																																																																																																																																																																																		
										<option value='DDPM'>{{ __('DDPM') }}</option>																																																																																																																																																																																		
										<option value='K_DPMPP_2M'>{{ __('K_DPMPP_2M') }}</option>																																																																																																																																																																																		
										<option value='K_DPMPP_2S_ANCESTRAL'>{{ __('K_DPMPP_2S_ANCESTRAL') }}</option>																																																																																																																																																																																		
										<option value='K_DPM_2'>{{ __('K_DPM_2') }}</option>																																																																																																																																																																																		
										<option value='K_DPM_2_ANCESTRAL'>{{ __('K_DPM_2_ANCESTRAL') }}</option>																																																																																																																																																																																		
										<option value='K_EULER'>{{ __('K_EULER') }}</option>																																																																																																																																																																																		
										<option value='K_EULER_ANCESTRAL'>{{ __('K_EULER_ANCESTRAL') }}</option>																																																																																																																																																																																		
										<option value='K_HEUN'>{{ __('K_HEUN') }}</option>																																																																																																																																																																																		
										<option value='K_LMS'>{{ __('K_LMS') }}</option>																																																																																																																																																																																																																																																																																																																																																																				
									</select>
								</div>
							</div>		
							
							<div class="col-lg-6 col-md-12 col-sm-12">
								<div id="form-group">
									<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Clip Guidance Preset') }}</h6>
									<select id="preset" name="preset" data-placeholder="{{ __('Set Clip Guidance Preset') }}">
										<option value='NONE' selected>{{ __('None') }}</option>																																																												
										<option value='FAST_BLUE'>{{ __('FAST_BLUE') }}</option>																																																																																																																																																																																		
										<option value='FAST_GREEN'>{{ __('FAST_GREEN') }}</option>																																																																																																																																																																																		
										<option value='SIMPLE'>{{ __('SIMPLE') }}</option>																																																																																																																																																																																		
										<option value='SLOW'>{{ __('SLOW') }}</option>																																																																																																																																																																																		
										<option value='SLOWER'>{{ __('SLOWER') }}</option>																																																																																																																																																																																		
										<option value='SLOWEST'>{{ __('SLOWEST') }}</option>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																						
									</select>
								</div>
							</div>
						@endif
						
						<div class="col-lg-6 col-md-12 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Image Resolution') }} <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="{{ __('The image resolutoin of the generated images') }}"></i></h6>
								<select id="resolution" name="resolution" data-placeholder="{{ __('Set image resolution') }}">
									@if (config('settings.image_vendor') == 'openai')
										<option value='256x256' selected>[256x256] {{ __('Small Image') }}</option>
										<option value='512x512'>[512x512] {{ __('Medium Image') }}</option>																															
										<option value='1024x1024'>[1024x1024] {{ __('Large Image') }}</option>	
									@endif
									@if (config('settings.image_vendor') == 'stable_diffusion')		
										@if (config('settings.image_stable_diffusion_engine') == 'stable-diffusion-v1-5')
											<option value='512x512' selected>{{ __('Width') }} 512 x {{ __('Height') }} 512</option>
											<option value='768x768'>{{ __('Width') }} 768 x {{ __('Height') }} 768</option>
										@elseif (config('settings.image_stable_diffusion_engine') == 'stable-diffusion-512-v2-1')
											<option value='768x512'>{{ __('Width') }} 768 x {{ __('Height') }} 512</option>
											<option value='1024x512'>{{ __('Width') }} 1024 x {{ __('Height') }} 512</option>
											<option value='512x512' selected>{{ __('Width') }} 512 x {{ __('Height') }} 512</option>
											<option value='512x768'>{{ __('Width') }} 512 x {{ __('Height') }} 768</option>
											<option value='512x1024'>{{ __('Width') }} 512 x {{ __('Height') }} 1024</option>
										@elseif (config('settings.image_stable_diffusion_engine') == 'stable-diffusion-768-v2-1')
											<option value='1344x768'>{{ __('Width') }} 1344 x {{ __('Height') }} 768</option>
											<option value='1152x768'>{{ __('Width') }} 1152 x {{ __('Height') }} 768</option>
											<option value='1024x768'>{{ __('Width') }} 1024 x {{ __('Height') }} 768</option>
											<option value='768x768' selected>{{ __('Width') }} 768 x {{ __('Height') }} 768</option>
											<option value='768x1024'>{{ __('Width') }} 768 x {{ __('Height') }} 1024</option>
											<option value='768x1152'>{{ __('Width') }} 768 x {{ __('Height') }} 1152</option>
											<option value='768x1344'>{{ __('Width') }} 768 x {{ __('Height') }} 1344</option>
										@elseif (config('settings.image_stable_diffusion_engine') == 'stable-diffusion-xl-beta-v2-2-2')
											<option value='896x512'>{{ __('Width') }} 896 x {{ __('Height') }} 512</option>
											<option value='768x512'>{{ __('Width') }} 768 x {{ __('Height') }} 512</option>
											<option value='512x512' selected>{{ __('Width') }} 512 x {{ __('Height') }} 512</option>
											<option value='512x768'>{{ __('Width') }} 512 x {{ __('Height') }} 768</option>	
											<option value='512x896'>{{ __('Width') }} 512 x {{ __('Height') }} 896</option>	
										@elseif (config('settings.image_stable_diffusion_engine') == 'stable-diffusion-xl-1024-v0-9')
											<option value='1536x640'>{{ __('Width') }} 1536 x {{ __('Height') }} 640</option>
											<option value='1344x768'>{{ __('Width') }} 1344 x {{ __('Height') }} 768</option>
											<option value='1024x1024' selected>{{ __('Width') }} 1024 x {{ __('Height') }} 1024</option>
											<option value='768x1344'>{{ __('Width') }} 768 x {{ __('Height') }} 1344</option>
											<option value='640x1536'>{{ __('Width') }} 640 x {{ __('Height') }} 1536</option>
										@endif								
									@endif																																																												
								</select>
							</div>
						</div>

						<div class="col-lg-6 col-md-12 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Number of Variations') }} <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="{{ __('The number of images to generate') }}"></i></h6>
								<select id="max-results" name="max_results" data-placeholder="{{ __('Set Number of Variants') }}">
									<option value=1 selected>1</option>
									<option value=2>2</option>																															
									<option value=3>3</option>																															
									<option value=4>4</option>																															
									<option value=5>5</option>																															
									<option value=6>6</option>																															
									<option value=7>7</option>																															
									<option value=8>8</option>																															
									<option value=9>9</option>																															
									<option value=10>10</option>																															
								</select>
							</div>
						</div>
					</div>						

					<div class="card-footer border-0 text-center p-0">
						<div class="w-100 pt-2 pb-2">
							<div class="text-center">
								<span id="processing" class="processing-image"><img src="{{ URL::asset('/img/svgs/upgrade.svg') }}" alt=""></span>
								<button type="submit" name="submit" class="btn btn-primary  pl-7 pr-7 fs-11 pt-2 pb-2" id="generate">{{ __('Generate Image') }}</button>
							</div>
						</div>							
					</div>	
			
				</div>
			</div>			
		</div>

		<div class="col-lg-8 col-md-12 col-sm-12">
			<div class="card border-0">
				<div class="card-body">
					<div class="d-flex">
						<div class="w-100">
							<h3 class="card-title fs-16 mt-3 mb-4"><i class="fa-solid fa-image-landscape mr-4 text-success"></i>{{ __("Generated Images") }}</h3>							
						</div>	
									
					</div>
					<!-- SET DATATABLE -->
					<table id='resultsTable' class='table' width='100%'>
						<thead>
							<tr>
								<th width="20%">{{ __('Image') }}</th> 
								<th width="5%">{{ __('Resolution') }}</th>
								<th width="5%">{{ __('Created On') }}</th> 								           								    						           	
								<th width="5%">{{ __('Actions') }}</th>
							</tr>
						</thead>
				</table> <!-- END SET DATATABLE -->	
				</div>
			</div>
		</div>
	</div>
</form>
@endsection

@section('js')
<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
<script src="{{URL::asset('plugins/character-count/jquery-simple-txt-counter.min.js')}}"></script>
<script src="{{URL::asset('plugins/datatable/datatables.min.js')}}"></script>
<script src="{{URL::asset('plugins/photoviewer/photoviewer.min.js')}}"></script>
<script type="text/javascript">
	$(function () {

		"use strict";

		let table = $('#resultsTable').DataTable({
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
				responsive: true,
				colReorder: true,	
				"order": [[ 3, "desc" ]],	
				language: {
					"emptyTable": "<div><img id='no-results-img' src='{{ URL::asset('img/files/no-result.png') }}'><br>{{ __('Looks like you do not have any images created yet') }}</div>",
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
				ajax: "{{ route('user.images') }}",
				columns: [
					{
						data: 'custom-image',
						name: 'custom-image',
						orderable: true,
						searchable: true
					},
					{
						data: 'resolution',
						name: 'resolution',
						orderable: true,
						searchable: true
					},
					{
						data: 'created-on',
						name: 'created-on',
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


		$(document).ready(function() {

			$('#title').simpleTxtCounter({
				maxLength: 3000,
				countElem: '<div class="form-text"></div>',
				lineBreak: false,
			});

		});	


		$(document).on('click', '.file-name', function(e) {

			"use strict";

			e.preventDefault();

			var id = $(this).attr("id");

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'post',
				url: 'images/view',
				data:{
					id: id,
				},
				success:function(data) {   

					var items = [{src: data['url']}];

					var viewer = new PhotoViewer(items, {
						
						footerToolbar: [
							'zoomIn','zoomOut','fullscreen','actualSize',
							'customButton'
						],
						customButtons: {
							customButton: {
							text: '<i class="fas fa-cloud-download-alt" ></i>',
							title: 'Download Image',
							click: function (context, e) {
								getFile(data['url']);
							}
							}
						}

					});
				
				}

			});

		});


		// SUBMIT FORM
		$('#openai-form').on('submit', function(e) {

			e.preventDefault();

			let form = $(this);

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'POST',
				url: 'images/process',
				data: form.serialize(),
				beforeSend: function() {
					$('#generate').html('');
					$('#generate').prop('disabled', true);
					$('#processing').show().clone().appendTo('#generate'); 
					$('#processing').hide();          
				},
				complete: function() {
					$('#generate').prop('disabled', false);
					$('#processing', '#generate').empty().remove();
					$('#processing').hide();
					$('#generate').html('Generate Image');            
				},
				success: function (data) {		
						
					if (data['status'] == 'success') {			
						toastr.success('{{ __('Images were generated successfully') }}');		
						animateValue("balance-number", data['old'], data['current'], 2000);
						$("#resultsTable").DataTable().ajax.reload();	
					} else {						
						Swal.fire('{{ __('Image Generation Error') }}', data['message'], 'warning');
					}
				},
				error: function(data) {
					$('#generate').prop('disabled', false);
            		$('#generate').html('Generate Image'); 
					console.log(data)
				}
			});
		});


		// DELETE SYNTHESIZE RESULT
		$(document).on('click', '.deleteResultButton', function(e) {

			e.preventDefault();

			Swal.fire({
				title: '{{ __('Confirm Image Deletion') }}',
				text: '{{ __('It will permanently delete this image') }}',
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
						url: 'images/delete',
						data: formData,
						processData: false,
						contentType: false,
						success: function (data) {
							if (data['status'] == 'success') {
								Swal.fire('{{ __('Image Deleted') }}', '{{ __('Selected image has been successfully deleted') }}', 'success');	
								$("#resultsTable").DataTable().ajax.reload();								
							} else {
								Swal.fire('{{ __('Delete Failed') }}', '{{ __('There was an error while deleting this image') }}', 'error');
							}      
						},
						error: function(data) {
							Swal.fire('Oops...','{{ __('Something went wrong') }}!', 'error')
						}
					})
				} 
			})
		});
	});

	function getFile(uri) {
		//window.open(data,'_blank');
		// window.location.href = data;
		var link = document.createElement("a");
            link.href = uri;
            link.setAttribute("download", "download");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            delete link;
		return false;
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

</script>
@endsection