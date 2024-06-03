
<?php $__env->startSection('css'); ?>
	<!-- Data Table CSS -->
	<link href="<?php echo e(URL::asset('plugins/datatable/datatables.min.css')); ?>" rel="stylesheet" />
	<!-- Sweet Alert CSS -->
	<link href="<?php echo e(URL::asset('plugins/sweetalert/sweetalert2.min.css')); ?>" rel="stylesheet" />
	<link href="<?php echo e(URL::asset('plugins/photoviewer/photoviewer.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<form id="openai-form" action="" method="post" enctype="multipart/form-data" class="mt-24">		
	<?php echo csrf_field(); ?>
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
									<h6 class="mt-1 ml-3 fs-16 number-font"><?php echo e(__('AI Image Generator')); ?></h6>
								</div>									
							</div>								
							<div class="template-info">
								<p class="fs-12 text-muted mb-4"><?php echo e(__('Turn any of your text into sophisticated image')); ?></p>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div class="text-left mb-4" id="balance-status">
								<span class="fs-11 text-muted pl-3"><i class="fa-sharp fa-solid fa-bolt-lightning mr-2 text-primary"></i><?php echo e(__('Your Balance is')); ?> <span class="font-weight-semibold" id="balance-number"><?php echo e(number_format(auth()->user()->available_images + auth()->user()->available_images_prepaid)); ?></span> <?php echo e(__('Images')); ?></span>
							</div>							
						</div>
						<div class="col-sm-12">								
							<div class="input-box">	
								<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Image Name')); ?>  <span class="text-muted">(<?php echo e(__('optional')); ?>)</span></h6>									
								<div class="form-group">						    
									<input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" value="<?php echo e(__('New Image')); ?>">
									<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<p class="text-danger"><?php echo e($errors->first('name')); ?></p>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div> 
							</div> 
						</div>

						<div class="col-sm-12">								
							<div class="input-box">	
								<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Image Description')); ?>  <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>									
								<div class="form-group">						    
									<textarea rows="5" cols="50" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="title" name="title" placeholder="<?php echo e(__('e.g. Spaceship flying to the moon')); ?>" required></textarea>
									<?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<p class="text-danger"><?php echo e($errors->first('title')); ?></p>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div> 
							</div> 
						</div>

						<div class="col-lg-12 col-md-12 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Artist Name')); ?></h6>
								<select id="artist" name="artist" data-placeholder="<?php echo e(__('Select Artist Name')); ?>">
									<option value='none' selected><?php echo e(__('None')); ?></option>																																																												
									<option value="Leonardo da Vinci (Renaissance)"><?php echo e(__('Leonardo da Vinci (Renaissance)')); ?></option>																																																																																																																																																																																	
									<option value="Vincent van Gogh (Impressionists and Neo-Impressionists)"><?php echo e(__('Vincent van Gogh (Impressionists and Neo-Impressionists)')); ?></option>																																																																																																																																																																																	
									<option value="Pablo Picasso (Cubism)"><?php echo e(__('Pablo Picasso (Cubism)')); ?></option>																																																																																																																																																																																	
									<option value="Salvador Dali (Surrealism)"><?php echo e(__('Salvador Dali (Surrealism)')); ?></option>																																																																																																																																																																																	
									<option value="Banksy (Street Art)"><?php echo e(__('Banksy (Street Art)')); ?></option>																																																																																																																																																																																	
									<option value="Takashi Murakami (Superflat)"><?php echo e(__('Takashi Murakami (Superflat)')); ?></option>																																																																																																																																																																																	
									<option value="George Condo (Artificial Realism)"><?php echo e(__('George Condo (Artificial Realism)')); ?></option>																																																																																																																																																																																	
									<option value="Tim Burton (Expressionism)"><?php echo e(__('Tim Burton (Expressionism)')); ?></option>																																																																																																																																																																																	
									<option value="Normal Rockwell (exaggerated realism)"><?php echo e(__('Normal Rockwell (Exaggerated Realism)')); ?></option>																																																																																																																																																																																	
									<option value="Andy Warhol (Pop Art)"><?php echo e(__('Andy Warhol (Pop Art)')); ?></option>																																																																																																																																																																																	
									<option value="Claude Monet (Impressionism-Nature)"><?php echo e(__('Claude Monet (Impressionism-Nature)')); ?></option>																																																																																																																																																																																	
									<option value="Robert Wyland (outdoor murals)"><?php echo e(__('Robert Wyland (Outdoor Murals)')); ?></option>																																																																																																																																																																																	
									<option value="Thomas Kinkade (luminism)"><?php echo e(__('Thomas Kinkade (Luminism)')); ?></option>																																																																																																																																																																																	
									<option value="Michelangelo (Fresco Art)"><?php echo e(__('Michelangelo (Fresco Art)')); ?></option>																																																																																																																																																																																	
									<option value="Johannes Vermeer (impressionist)"><?php echo e(__('Johannes Vermeer (Impressionist)')); ?></option>																																																																																																																																																																																	
									<option value="Gustav Klimt (fresco-secco)"><?php echo e(__('Gustav Klimt (Fresco-Secco)')); ?></option>																																																																																																																																																																																	
									<option value="Sandro Botticelli (egg tempera)"><?php echo e(__('Sandro Botticelli (Egg Tempera)')); ?></option>																																																																																																																																																																																	
									<option value="James Abbott (Impressionist)"><?php echo e(__('James Abbott (Impressionist)')); ?></option>																																																																																																																																																																																	
									<option value="McNeill Whistler (Realism)"><?php echo e(__('McNeill Whistler (Realism)')); ?></option>																																																																																																																																																																																	
									<option value="Jan van Eyck (Oil Panting)"><?php echo e(__('Jan van Eyck (Oil Panting)')); ?></option>																																																																																																																																																																																	
									<option value="Hieronymus Bosch (Flemish painting)"><?php echo e(__('Hieronymus Bosch (Flemish Painting)')); ?></option>																																																																																																																																																																																	
									<option value="Georges Seurat (pointillism)"><?php echo e(__('Georges Seurat (Pointillism)')); ?></option>																																																																																																																																																																																	
									<option value="Pieter Bruegel (Flemish Renaissance)"><?php echo e(__('Pieter Bruegel (Flemish Renaissance)')); ?></option>																																																																																																																																																																																	
									<option value="Diego Rodríguez (portraiture and scene painting)"><?php echo e(__('Diego Rodríguez (Portraiture and Scene Painting)')); ?></option>																																																																																																																																																																																	
									<option value="Silva Velázquez (Baroque)"><?php echo e(__('Silva Velázquez (Baroque)')); ?></option>																																																																																																																																																																																	
									<option value="John Bramblitt (impressionism Pop Art)"><?php echo e(__('John Bramblitt (impressionism Pop Art)')); ?></option>																																																																																																																																																																																	
									<option value="Beeple (3d art)"><?php echo e(__('Beeple (3D Art)')); ?></option>																																																																																																																																																																																	
									<option value="Sam Gilliam (Abstract)"><?php echo e(__('Sam Gilliam (Abstract)')); ?></option>																																																																																																																																																																																	
									<option value="Hayao Miyazaki (Anime)"><?php echo e(__('Hayao Miyazaki (Anime)')); ?></option>																																																																																																																																																																																
									<option value="datfootdive (Vaperwave)"><?php echo e(__('Datfootdive (Vaperwave)')); ?></option>																																																																																																																																																																																
									<option value="Keith Thompson (Steampunk)"><?php echo e(__('Keith Thompson (Steampunk)')); ?></option>																																																																																																																																																																																
									<option value="Johnny Silverhand (Cyberpunk)"><?php echo e(__('Johnny Silverhand (Cyberpunk)')); ?></option>																																																																																																																																																																																
								</select>
							</div>
						</div>

						<div class="col-lg-6 col-md-12 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Image Style')); ?></h6>
								<select id="style" name="style" data-placeholder="<?php echo e(__('Select Image Style')); ?>">
									<?php if(config('settings.image_vendor') == 'openai'): ?>
										<option value='none' selected><?php echo e(__('None')); ?></option>																																																												
										<option value='abstract'><?php echo e(__('Abstract')); ?></option>																																																												
										<option value='realistic'><?php echo e(__('Realistic')); ?></option>																																																												
										<option value='3d render'><?php echo e(__('3D Render')); ?></option>																																																												
										<option value='cartoon'><?php echo e(__('Cartoon')); ?></option>																																																												
										<option value='anime'><?php echo e(__('Anime')); ?></option>																																																												
										<option value='digital art'><?php echo e(__('Digital Art')); ?></option>
										<option value='modern'><?php echo e(__('Modern')); ?></option>																																																												
										<option value='art deco'><?php echo e(__('Art Deco')); ?></option>																																																												
										<option value='illustration'><?php echo e(__('Illustration')); ?></option>																																																												
										<option value='origami'><?php echo e(__('Origami')); ?></option>																																																												
										<option value='pixel art'><?php echo e(__('Pixel Art')); ?></option>																																																												
										<option value='retro'><?php echo e(__('Retro')); ?></option>																																																												
										<option value='photography'><?php echo e(__('Photography')); ?></option>																																																												
										<option value='line art'><?php echo e(__('Line Art')); ?></option>																																																												
										<option value='pop art'><?php echo e(__('Pop Art')); ?></option>																																																																																																																						
										<option value='vaporwave'><?php echo e(__('Vaporwave')); ?></option>																																																												
										<option value='pencil drawing'><?php echo e(__('Pencil Drawing')); ?></option>																																																												
										<option value='renaissance'><?php echo e(__('Renaissance')); ?></option>																																																												
										<option value='minimalism'><?php echo e(__('Minimalism')); ?></option>																																																																																																																							
										<option value='sticker'><?php echo e(__('Sticker')); ?></option>																																																																																																																							
										<option value='isometric'><?php echo e(__('Isometric')); ?></option>																																																																																																																							
										<option value='cyberpunk'><?php echo e(__('Cyberpunk')); ?></option>																																																																																																																							
										<option value='ballpoint pen drawing'><?php echo e(__('Ballpoint Pen Drawing')); ?></option>																																																																																																																																																																																																																																													
										<option value='steampunk'><?php echo e(__('Steampunk')); ?></option>																																																																																																																																																																																																																																													
										<option value='glitchcore'><?php echo e(__('Glitchcore')); ?></option>																																																																																																																																																																																																																																													
										<option value='bauhaus'><?php echo e(__('Bauhaus')); ?></option>																																																																																																																																																																																																																																													
										<option value='vector'><?php echo e(__('Vector')); ?></option>																																																																																																																																																																																																																																													
										<option value='low poly'><?php echo e(__('Low Poly')); ?></option>																																																																																																																																																																																																																																													
										<option value='ukiyo-e'><?php echo e(__('Ukiyo-e')); ?></option>																																																																																																																																																																																																																																													
										<option value='cubism'><?php echo e(__('Cubism')); ?></option>																																																																																																																																																																																																																																													
										<option value='contemporary'><?php echo e(__('Contemporary')); ?></option>																																																																																																																																																																																																																																													
										<option value='impressionism'><?php echo e(__('Impressionism')); ?></option>																																																																																																																																																																																																																																													
										<option value='pointilism'><?php echo e(__('Pointilism')); ?></option>	
									<?php else: ?>
										<option value='none' selected><?php echo e(__('None')); ?></option>																																																																																																																							
										<option value='3d-model'><?php echo e(__('3D Model')); ?></option>																																																																																																																							
										<option value='analog-film'><?php echo e(__('Analog Film')); ?></option>																																																																																																																							
										<option value='anime'><?php echo e(__('Anime')); ?></option>																																																																																																																							
										<option value='cinematic'><?php echo e(__('Cinematic')); ?></option>																																																																																																																																																																																																																																													
										<option value='comic-book'><?php echo e(__('Comic Book')); ?></option>																																																																																																																																																																																																																																													
										<option value='digital-art'><?php echo e(__('Digital Art')); ?></option>																																																																																																																																																																																																																																													
										<option value='enhance'><?php echo e(__('Enhance')); ?></option>																																																																																																																																																																																																																																													
										<option value='fantasy-art'><?php echo e(__('Fantasy Art')); ?></option>																																																																																																																																																																																																																																													
										<option value='isometric'><?php echo e(__('Isometric')); ?></option>																																																																																																																																																																																																																																													
										<option value='line-art'><?php echo e(__('Line Art')); ?></option>																																																																																																																																																																																																																																													
										<option value='low-poly'><?php echo e(__('Low Poly')); ?></option>																																																																																																																																																																																																																																													
										<option value='modeling-compound'><?php echo e(__('Modeling Compound')); ?></option>																																																																																																																																																																																																																																													
										<option value='neon-punk'><?php echo e(__('Neon Punk')); ?></option>																																																																																																																																																																																																																																													
										<option value='origami'><?php echo e(__('Origami')); ?></option>	
										<option value='photographic'><?php echo e(__('Photographic')); ?></option>	
										<option value='pixel-art'><?php echo e(__('Pixel Art')); ?></option>	
										<option value='tile-texture'><?php echo e(__('Tile Texture')); ?></option>	
									<?php endif; ?>
																																																																																																																																																																																																																																																					
								</select>
							</div>
						</div>

						<div class="col-lg-6 col-md-12 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Image Medium')); ?></h6>
								<select id="medium" name="medium" data-placeholder="<?php echo e(__('Select Image Medium')); ?>">
									<option value='none' selected><?php echo e(__('None')); ?></option>																																																												
									<option value='acrylic'><?php echo e(__('Acrylic')); ?></option>																																																																																																																																																																																		
									<option value='canvas'><?php echo e(__('Canvas')); ?></option>																																																																																																																																																																																		
									<option value='chalk'><?php echo e(__('Chalk')); ?></option>																																																																																																																																																																																		
									<option value='charcoal'><?php echo e(__('Charcoal')); ?></option>																																																																																																																																																																																		
									<option value='classic oil'><?php echo e(__('Classic Oil')); ?></option>																																																																																																																																																																																		
									<option value='crayon'><?php echo e(__('Crayon')); ?></option>																																																																																																																																																																																		
									<option value='glass'><?php echo e(__('Glass')); ?></option>																																																																																																																																																																																		
									<option value='ink'><?php echo e(__('Ink')); ?></option>																																																																																																																																																																																		
									<option value='paster'><?php echo e(__('Pastel')); ?></option>																																																																																																																																																																																		
									<option value='pencil'><?php echo e(__('Pencil')); ?></option>																																																																																																																																																																																		
									<option value='spray paint'><?php echo e(__('Spray Paint')); ?></option>																																																																																																																																																																																		
									<option value='watercolor'><?php echo e(__('Watercolor')); ?></option>																																																																																																																																																																																		
									<option value='wood panel'><?php echo e(__('Wood Panel')); ?></option>																																																																																																																																																																																		
								</select>
							</div>
						</div>

						<div class="col-lg-6 col-md-12 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Lighting Style')); ?></h6>
								<select id="lightning" name="lightning" data-placeholder="<?php echo e(__('Select Image Lighting Style')); ?>">
									<option value='none' selected><?php echo e(__('None')); ?></option>																																																												
									<option value="warm"><?php echo e(__('Warm')); ?></option>
                                    <option value="cold"><?php echo e(__('Cold')); ?></option>
                                    <option value="golden hour"><?php echo e(__('Golden Hour')); ?></option>
                                    <option value="blue hour"><?php echo e(__('Blue Hour')); ?></option>
                                    <option value="ambient"><?php echo e(__('Ambient')); ?></option>
                                    <option value="studio"><?php echo e(__('Studio')); ?></option>
                                    <option value="neon"><?php echo e(__('Neon')); ?></option>
                                    <option value="dramatic"><?php echo e(__('Dramatic')); ?></option>
                                    <option value="cinematic"><?php echo e(__('Cinematic')); ?></option>
                                    <option value="natural"><?php echo e(__('Natural')); ?></option>
                                    <option value="foggy"><?php echo e(__('Foggy')); ?></option>
                                    <option value="backlight"><?php echo e(__('Backlight')); ?></option>
                                    <option value="hard"><?php echo e(__('Hard')); ?></option>																																																																																																																																																																																		
                                    <option value="soft"><?php echo e(__('Soft')); ?></option>																																																																																																																																																																																		
                                    <option value="irivescent"><?php echo e(__('Irivescent')); ?></option>																																																																																																																																																																																		
                                    <option value="fluorescent"><?php echo e(__('Fluorescent')); ?></option>																																																																																																																																																																																		
                                    <option value="decorative"><?php echo e(__('Decorative')); ?></option>																																																																																																																																																																																		
                                    <option value="accent"><?php echo e(__('Accent')); ?></option>																																																																																																																																																																																		
                                    <option value="task"><?php echo e(__('Task')); ?></option>																																																																																																																																																																																		
                                    <option value="halogen"><?php echo e(__('Halogen')); ?></option>																																																																																																																																																																																		
                                    <option value="light emitting diode"><?php echo e(__('Light Emitting Diode (LED)')); ?></option>																																																																																																																																																																																		
								</select>
							</div>
						</div>

						<div class="col-lg-6 col-md-12 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Mood')); ?></h6>
								<select id="mood" name="mood" data-placeholder="<?php echo e(__('Select Image Mood')); ?>">
									<option value='none' selected><?php echo e(__('None')); ?></option>																																																												
									<option value='angry'><?php echo e(__('Angry')); ?></option>																																																																																																																																																																																		
									<option value='agressive'><?php echo e(__('Agressive')); ?></option>																																																																																																																																																																																		
									<option value='boring'><?php echo e(__('Boring')); ?></option>																																																																																																																																																																																		
									<option value='bright'><?php echo e(__('Bright')); ?></option>																																																																																																																																																																																		
									<option value='calm'><?php echo e(__('Calm')); ?></option>																																																																																																																																																																																		
									<option value='cheerful'><?php echo e(__('Cheerful')); ?></option>																																																																																																																																																																																		
									<option value='chilling'><?php echo e(__('Chilling')); ?></option>																																																																																																																																																																																		
									<option value='colorful'><?php echo e(__('Colorful')); ?></option>																																																																																																																																																																																		
									<option value='happy'><?php echo e(__('Happy')); ?></option>																																																																																																																																																																																		
									<option value='dark'><?php echo e(__('Dark')); ?></option>																																																																																																																																																																																		
									<option value='neutral'><?php echo e(__('Neutral')); ?></option>																																																																																																																																																																																		
									<option value='sad'><?php echo e(__('Sad')); ?></option>																																																																																																																																																																																		
									<option value='crying'><?php echo e(__('Crying')); ?></option>																																																																																																																																																																																		
									<option value='disappointed'><?php echo e(__('Disappointed')); ?></option>																																																																																																																																																																																		
									<option value='flirt'><?php echo e(__('Flirt')); ?></option>																																																																																																																																																																																		
								</select>
							</div>
						</div>

						<?php if(config('settings.image_vendor') == 'stable_diffusion'): ?>
							<div class="col-lg-6 col-md-12 col-sm-12">
								<div id="form-group">
									<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Image Diffusion Samples')); ?></h6>
									<select id="diffusion-samples" name="diffusion_samples" data-placeholder="<?php echo e(__('Set Image Diffusion Samples')); ?>">
										<option value='none' selected><?php echo e(__('Auto')); ?></option>																																																												
										<option value='DDIM'><?php echo e(__('DDIM')); ?></option>																																																																																																																																																																																		
										<option value='DDPM'><?php echo e(__('DDPM')); ?></option>																																																																																																																																																																																		
										<option value='K_DPMPP_2M'><?php echo e(__('K_DPMPP_2M')); ?></option>																																																																																																																																																																																		
										<option value='K_DPMPP_2S_ANCESTRAL'><?php echo e(__('K_DPMPP_2S_ANCESTRAL')); ?></option>																																																																																																																																																																																		
										<option value='K_DPM_2'><?php echo e(__('K_DPM_2')); ?></option>																																																																																																																																																																																		
										<option value='K_DPM_2_ANCESTRAL'><?php echo e(__('K_DPM_2_ANCESTRAL')); ?></option>																																																																																																																																																																																		
										<option value='K_EULER'><?php echo e(__('K_EULER')); ?></option>																																																																																																																																																																																		
										<option value='K_EULER_ANCESTRAL'><?php echo e(__('K_EULER_ANCESTRAL')); ?></option>																																																																																																																																																																																		
										<option value='K_HEUN'><?php echo e(__('K_HEUN')); ?></option>																																																																																																																																																																																		
										<option value='K_LMS'><?php echo e(__('K_LMS')); ?></option>																																																																																																																																																																																																																																																																																																																																																																				
									</select>
								</div>
							</div>		
							
							<div class="col-lg-6 col-md-12 col-sm-12">
								<div id="form-group">
									<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Clip Guidance Preset')); ?></h6>
									<select id="preset" name="preset" data-placeholder="<?php echo e(__('Set Clip Guidance Preset')); ?>">
										<option value='NONE' selected><?php echo e(__('None')); ?></option>																																																												
										<option value='FAST_BLUE'><?php echo e(__('FAST_BLUE')); ?></option>																																																																																																																																																																																		
										<option value='FAST_GREEN'><?php echo e(__('FAST_GREEN')); ?></option>																																																																																																																																																																																		
										<option value='SIMPLE'><?php echo e(__('SIMPLE')); ?></option>																																																																																																																																																																																		
										<option value='SLOW'><?php echo e(__('SLOW')); ?></option>																																																																																																																																																																																		
										<option value='SLOWER'><?php echo e(__('SLOWER')); ?></option>																																																																																																																																																																																		
										<option value='SLOWEST'><?php echo e(__('SLOWEST')); ?></option>																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																						
									</select>
								</div>
							</div>
						<?php endif; ?>
						
						<div class="col-lg-6 col-md-12 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Image Resolution')); ?> <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="<?php echo e(__('The image resolutoin of the generated images')); ?>"></i></h6>
								<select id="resolution" name="resolution" data-placeholder="<?php echo e(__('Set image resolution')); ?>">
									<?php if(config('settings.image_vendor') == 'openai'): ?>
										<option value='256x256' selected>[256x256] <?php echo e(__('Small Image')); ?></option>
										<option value='512x512'>[512x512] <?php echo e(__('Medium Image')); ?></option>																															
										<option value='1024x1024'>[1024x1024] <?php echo e(__('Large Image')); ?></option>	
									<?php endif; ?>
									<?php if(config('settings.image_vendor') == 'stable_diffusion'): ?>		
										<?php if(config('settings.image_stable_diffusion_engine') == 'stable-diffusion-v1-5'): ?>
											<option value='512x512' selected><?php echo e(__('Width')); ?> 512 x <?php echo e(__('Height')); ?> 512</option>
											<option value='768x768'><?php echo e(__('Width')); ?> 768 x <?php echo e(__('Height')); ?> 768</option>
										<?php elseif(config('settings.image_stable_diffusion_engine') == 'stable-diffusion-512-v2-1'): ?>
											<option value='768x512'><?php echo e(__('Width')); ?> 768 x <?php echo e(__('Height')); ?> 512</option>
											<option value='1024x512'><?php echo e(__('Width')); ?> 1024 x <?php echo e(__('Height')); ?> 512</option>
											<option value='512x512' selected><?php echo e(__('Width')); ?> 512 x <?php echo e(__('Height')); ?> 512</option>
											<option value='512x768'><?php echo e(__('Width')); ?> 512 x <?php echo e(__('Height')); ?> 768</option>
											<option value='512x1024'><?php echo e(__('Width')); ?> 512 x <?php echo e(__('Height')); ?> 1024</option>
										<?php elseif(config('settings.image_stable_diffusion_engine') == 'stable-diffusion-768-v2-1'): ?>
											<option value='1344x768'><?php echo e(__('Width')); ?> 1344 x <?php echo e(__('Height')); ?> 768</option>
											<option value='1152x768'><?php echo e(__('Width')); ?> 1152 x <?php echo e(__('Height')); ?> 768</option>
											<option value='1024x768'><?php echo e(__('Width')); ?> 1024 x <?php echo e(__('Height')); ?> 768</option>
											<option value='768x768' selected><?php echo e(__('Width')); ?> 768 x <?php echo e(__('Height')); ?> 768</option>
											<option value='768x1024'><?php echo e(__('Width')); ?> 768 x <?php echo e(__('Height')); ?> 1024</option>
											<option value='768x1152'><?php echo e(__('Width')); ?> 768 x <?php echo e(__('Height')); ?> 1152</option>
											<option value='768x1344'><?php echo e(__('Width')); ?> 768 x <?php echo e(__('Height')); ?> 1344</option>
										<?php elseif(config('settings.image_stable_diffusion_engine') == 'stable-diffusion-xl-beta-v2-2-2'): ?>
											<option value='896x512'><?php echo e(__('Width')); ?> 896 x <?php echo e(__('Height')); ?> 512</option>
											<option value='768x512'><?php echo e(__('Width')); ?> 768 x <?php echo e(__('Height')); ?> 512</option>
											<option value='512x512' selected><?php echo e(__('Width')); ?> 512 x <?php echo e(__('Height')); ?> 512</option>
											<option value='512x768'><?php echo e(__('Width')); ?> 512 x <?php echo e(__('Height')); ?> 768</option>	
											<option value='512x896'><?php echo e(__('Width')); ?> 512 x <?php echo e(__('Height')); ?> 896</option>	
										<?php elseif(config('settings.image_stable_diffusion_engine') == 'stable-diffusion-xl-1024-v0-9'): ?>
											<option value='1536x640'><?php echo e(__('Width')); ?> 1536 x <?php echo e(__('Height')); ?> 640</option>
											<option value='1344x768'><?php echo e(__('Width')); ?> 1344 x <?php echo e(__('Height')); ?> 768</option>
											<option value='1024x1024' selected><?php echo e(__('Width')); ?> 1024 x <?php echo e(__('Height')); ?> 1024</option>
											<option value='768x1344'><?php echo e(__('Width')); ?> 768 x <?php echo e(__('Height')); ?> 1344</option>
											<option value='640x1536'><?php echo e(__('Width')); ?> 640 x <?php echo e(__('Height')); ?> 1536</option>
										<?php endif; ?>								
									<?php endif; ?>																																																												
								</select>
							</div>
						</div>

						<div class="col-lg-6 col-md-12 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Number of Variations')); ?> <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="<?php echo e(__('The number of images to generate')); ?>"></i></h6>
								<select id="max-results" name="max_results" data-placeholder="<?php echo e(__('Set Number of Variants')); ?>">
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
								<span id="processing" class="processing-image"><img src="<?php echo e(URL::asset('/img/svgs/upgrade.svg')); ?>" alt=""></span>
								<button type="submit" name="submit" class="btn btn-primary  pl-7 pr-7 fs-11 pt-2 pb-2" id="generate"><?php echo e(__('Generate Image')); ?></button>
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
							<h3 class="card-title fs-16 mt-3 mb-4"><i class="fa-solid fa-image-landscape mr-4 text-success"></i><?php echo e(__("Generated Images")); ?></h3>							
						</div>	
									
					</div>
					<!-- SET DATATABLE -->
					<table id='resultsTable' class='table' width='100%'>
						<thead>
							<tr>
								<th width="20%"><?php echo e(__('Image')); ?></th> 
								<th width="5%"><?php echo e(__('Resolution')); ?></th>
								<th width="5%"><?php echo e(__('Created On')); ?></th> 								           								    						           	
								<th width="5%"><?php echo e(__('Actions')); ?></th>
							</tr>
						</thead>
				</table> <!-- END SET DATATABLE -->	
				</div>
			</div>
		</div>
	</div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(URL::asset('plugins/sweetalert/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/character-count/jquery-simple-txt-counter.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/datatable/datatables.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/photoviewer/photoviewer.min.js')); ?>"></script>
<script type="text/javascript">
	$(function () {

		"use strict";

		let table = $('#resultsTable').DataTable({
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
				responsive: true,
				colReorder: true,	
				"order": [[ 3, "desc" ]],	
				language: {
					"emptyTable": "<div><img id='no-results-img' src='<?php echo e(URL::asset('img/files/no-result.png')); ?>'><br><?php echo e(__('Looks like you do not have any images created yet')); ?></div>",
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
				ajax: "<?php echo e(route('user.images')); ?>",
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
						toastr.success('<?php echo e(__('Images were generated successfully')); ?>');		
						animateValue("balance-number", data['old'], data['current'], 2000);
						$("#resultsTable").DataTable().ajax.reload();	
					} else {						
						Swal.fire('<?php echo e(__('Image Generation Error')); ?>', data['message'], 'warning');
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
				title: '<?php echo e(__('Confirm Image Deletion')); ?>',
				text: '<?php echo e(__('It will permanently delete this image')); ?>',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: '<?php echo e(__('Delete')); ?>',
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
								Swal.fire('<?php echo e(__('Image Deleted')); ?>', '<?php echo e(__('Selected image has been successfully deleted')); ?>', 'success');	
								$("#resultsTable").DataTable().ajax.reload();								
							} else {
								Swal.fire('<?php echo e(__('Delete Failed')); ?>', '<?php echo e(__('There was an error while deleting this image')); ?>', 'error');
							}      
						},
						error: function(data) {
							Swal.fire('Oops...','<?php echo e(__('Something went wrong')); ?>!', 'error')
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
		let url = '<?php echo e(url('user/templates')); ?>/' + value;
		window.location.href=url;
	}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/user/images/index.blade.php ENDPATH**/ ?>