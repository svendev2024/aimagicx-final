

<?php $__env->startSection('css'); ?>
	<!-- Sweet Alert CSS -->
	<link href="<?php echo e(URL::asset('plugins/sweetalert/sweetalert2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row mt-24">

		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card border-0 templates-nav-header">
				<div class="card-body">
					<div>
						<h3 class="card-title mb-3 ml-2 fs-20"><i class="fa-solid fa-microchip-ai mr-2 text-primary"></i><?php echo e(__('Templates')); ?></h3>
						<h6 class="text-muted mb-3 ml-2"><?php echo e(__('Seeking that perfect content? Look no further! Get ready to explore our fantastic lineup of templates')); ?></h6>
						<div class="search-template">
							<div class="input-box">								
								<div class="form-group">							    
									<input type="text" class="form-control" id="search-template" placeholder="<?php echo e(__('Search for your template...')); ?>">
								</div> 
							</div> 
						</div>
					</div>

					<div class="templates-nav-menu">
						<div class="template-nav-menu-inner">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item" role="presentation">
									<button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true"><?php echo e(__('All Templates')); ?></button>
								</li>
								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if(strtolower($category->name) != 'other'): ?>
										<li class="nav-item category-check" role="presentation">
											<button class="nav-link" id="<?php echo e($category->code); ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo e($category->code); ?>" type="button" role="tab" aria-controls="<?php echo e($category->code); ?>" aria-selected="false"><?php echo e(__($category->name)); ?></button>
										</li>
									<?php endif; ?>									
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if(strtolower($category->name) == 'other'): ?>
									<li class="nav-item category-check" role="presentation">
										<button class="nav-link" id="<?php echo e($category->code); ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo e($category->code); ?>" type="button" role="tab" aria-controls="<?php echo e($category->code); ?>" aria-selected="false"><?php echo e(__($category->name)); ?></button>
									</li>
								<?php endif; ?>									
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				
							</ul>
						</div>
					</div>					
				</div>
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="pt-2">
				<div class="favorite-templates-panel">

					<div class="tab-content" id="myTabContent">

						<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
							<div class="row" id="templates-panel">
								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if(strtolower($category->name) != 'other'): ?>
										<div class="col-12 templates-panel-group <?php if($loop->first): ?> <?php else: ?>  mt-3 <?php endif; ?>">
											<h6 class="fs-14 font-weight-bold text-muted"><?php echo e(__($category->name)); ?></h6>
											<h4 class="fs-12 text-muted"><?php echo e(__($category->description)); ?></h4>
										</div>						
									
										<?php $__currentLoopData = $favorite_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($template->group == $category->code): ?>
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="<?php echo e($template->template_code); ?>" <?php if($template->favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatus(this.id)"><i id="<?php echo e($template->template_code); ?>-icon" class="<?php if($template->favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
														<div class="temp card <?php if($template->package == 'professional'): ?> professional <?php elseif($template->package == 'premium'): ?> premium <?php elseif($template->favorite): ?> favorite <?php else: ?> border-0 <?php endif; ?>" id="<?php echo e($template->template_code); ?>-card " onclick="window.location.href='<?php echo e(url('user/templates/original-template')); ?>/<?php echo e($template->slug); ?>'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	<?php echo $template->icon; ?>												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font"><?php echo e(__($template->name)); ?></h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2"><?php echo e(__($template->description)); ?></p>
																</div>
																<?php if($template->package == 'professional'): ?> 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'free'): ?>
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'premium'): ?>
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->new): ?>
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></span>
																<?php endif; ?>	
															</div>
														</div>
													</div>							
												</div>
											<?php endif; ?>
											
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

										<?php $__currentLoopData = $favorite_custom_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($template->group == $category->code): ?>
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="<?php echo e($template->template_code); ?>" <?php if($template->favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatusCustom(this.id)"><i id="<?php echo e($template->template_code); ?>-icon" class="<?php if($template->favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
														<div class="temp card <?php if($template->package == 'professional'): ?> professional <?php elseif($template->package == 'premium'): ?> premium <?php elseif($template->favorite): ?> favorite <?php else: ?> border-0 <?php endif; ?>" id="<?php echo e($template->template_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/templates')); ?>/<?php echo e($template->slug); ?>/<?php echo e($template->template_code); ?>'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	<?php echo $template->icon; ?>												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font"><?php echo e(__($template->name)); ?></h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2"><?php echo e(__($template->description)); ?></p>
																</div>
																<?php if($template->package == 'professional'): ?> 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'free'): ?>
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'premium'): ?>
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->new): ?>
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></span>
																<?php endif; ?>	
															</div>
														</div>
													</div>							
												</div>
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
										<?php $__currentLoopData = $other_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($template->group == $category->code): ?>
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="<?php echo e($template->template_code); ?>" <?php if($template->favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatus(this.id)"><i id="<?php echo e($template->template_code); ?>-icon" class="<?php if($template->favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
														<div class="temp card <?php if($template->package == 'professional'): ?> professional <?php elseif($template->package == 'premium'): ?> premium <?php elseif($template->favorite): ?> favorite <?php else: ?> border-0 <?php endif; ?>" id="<?php echo e($template->template_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/templates/original-template')); ?>/<?php echo e($template->slug); ?>'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	<?php echo $template->icon; ?>												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font"><?php echo e(__($template->name)); ?></h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2"><?php echo e(__($template->description)); ?></p>
																</div>
																<?php if($template->package == 'professional'): ?> 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'free'): ?>
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'premium'): ?>
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->new): ?>
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></span>
																<?php endif; ?>		
															</div>
														</div>
													</div>							
												</div>
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
										
										<?php $__currentLoopData = $custom_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($template->group == $category->code): ?>
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="<?php echo e($template->template_code); ?>" <?php if($template->favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatusCustom(this.id)"><i id="<?php echo e($template->template_code); ?>-icon" class="<?php if($template->favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
														<div class="temp card <?php if($template->package == 'professional'): ?> professional <?php elseif($template->package == 'premium'): ?> premium <?php elseif($template->favorite): ?> favorite <?php else: ?> border-0 <?php endif; ?>" id="<?php echo e($template->template_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/templates')); ?>/<?php echo e($template->slug); ?>/<?php echo e($template->template_code); ?>'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	<?php echo $template->icon; ?>												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font"><?php echo e(__($template->name)); ?></h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2"><?php echo e(__($template->description)); ?></p>
																</div>
																<?php if($template->package == 'professional'): ?> 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'free'): ?>
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'premium'): ?>
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->new): ?>
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></span>
																<?php endif; ?>	
															</div>
														</div>
													</div>							
												</div>
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>	
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		

								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if(strtolower($category->name) == 'other'): ?>
										<div class="col-12 templates-panel-group <?php if($loop->first): ?> <?php else: ?>  mt-3 <?php endif; ?>">
											<h6 class="fs-14 font-weight-bold text-muted"><?php echo e(__($category->name)); ?></h6>
											<h4 class="fs-12 text-muted"><?php echo e(__($category->description)); ?></h4>
										</div>					
									
										<?php $__currentLoopData = $favorite_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($template->group == $category->code): ?>
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="<?php echo e($template->template_code); ?>" <?php if($template->favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatus(this.id)"><i id="<?php echo e($template->template_code); ?>-icon" class="<?php if($template->favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
														<div class="temp card <?php if($template->package == 'professional'): ?> professional <?php elseif($template->package == 'premium'): ?> premium <?php elseif($template->favorite): ?> favorite <?php else: ?> border-0 <?php endif; ?>" id="<?php echo e($template->template_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/templates/original-template')); ?>/<?php echo e($template->slug); ?>'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	<?php echo $template->icon; ?>												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font"><?php echo e(__($template->name)); ?></h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2"><?php echo e(__($template->description)); ?></p>
																</div>
																<?php if($template->package == 'professional'): ?> 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'free'): ?>
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'premium'): ?>
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->new): ?>
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></span>
																<?php endif; ?>	
															</div>
														</div>
													</div>							
												</div>
											<?php endif; ?>
											
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

										<?php $__currentLoopData = $favorite_custom_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($template->group == $category->code): ?>
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="<?php echo e($template->template_code); ?>" <?php if($template->favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatusCustom(this.id)"><i id="<?php echo e($template->template_code); ?>-icon" class="<?php if($template->favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
														<div class="temp card <?php if($template->package == 'professional'): ?> professional <?php elseif($template->package == 'premium'): ?> premium <?php elseif($template->favorite): ?> favorite <?php else: ?> border-0 <?php endif; ?>" id="<?php echo e($template->template_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/templates')); ?>/<?php echo e($template->slug); ?>/<?php echo e($template->template_code); ?>'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	<?php echo $template->icon; ?>												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font"><?php echo e(__($template->name)); ?></h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2"><?php echo e(__($template->description)); ?></p>
																</div>
																<?php if($template->package == 'professional'): ?> 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'free'): ?>
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'premium'): ?>
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->new): ?>
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></span>
																<?php endif; ?>	
															</div>
														</div>
													</div>							
												</div>
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
										<?php $__currentLoopData = $other_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($template->group == $category->code): ?>
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="<?php echo e($template->template_code); ?>" <?php if($template->favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatus(this.id)"><i id="<?php echo e($template->template_code); ?>-icon" class="<?php if($template->favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
														<div class="temp card <?php if($template->package == 'professional'): ?> professional <?php elseif($template->package == 'premium'): ?> premium <?php elseif($template->favorite): ?> favorite <?php else: ?> border-0 <?php endif; ?>" id="<?php echo e($template->template_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/templates/original-template')); ?>/<?php echo e($template->slug); ?>'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	<?php echo $template->icon; ?>												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font"><?php echo e(__($template->name)); ?></h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2"><?php echo e(__($template->description)); ?></p>
																</div>
																<?php if($template->package == 'professional'): ?> 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'free'): ?>
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'premium'): ?>
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->new): ?>
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></span>
																<?php endif; ?>	
															</div>
														</div>
													</div>							
												</div>
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
										
										<?php $__currentLoopData = $custom_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($template->group == $category->code): ?>
												<div class="col-lg-3 col-md-6 col-sm-12">
													<div class="template">
														<a id="<?php echo e($template->template_code); ?>" <?php if($template->favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatusCustom(this.id)"><i id="<?php echo e($template->template_code); ?>-icon" class="<?php if($template->favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
														<div class="temp card <?php if($template->package == 'professional'): ?> professional <?php elseif($template->package == 'premium'): ?> premium <?php elseif($template->favorite): ?> favorite <?php else: ?> border-0 <?php endif; ?>" id="<?php echo e($template->template_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/templates')); ?>/<?php echo e($template->slug); ?>/<?php echo e($template->template_code); ?>'">
															<div class="card-body pt-5">
																<div class="template-icon mb-4">
																	<?php echo $template->icon; ?>												
																</div>
																<div class="template-title">
																	<h6 class="mb-2 fs-15 number-font"><?php echo e(__($template->name)); ?></h6>
																</div>
																<div class="template-info">
																	<p class="fs-13 text-muted mb-2"><?php echo e(__($template->description)); ?></p>
																</div>
																<?php if($template->package == 'professional'): ?> 
																	<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'free'): ?>
																	<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->package == 'premium'): ?>
																	<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
																<?php elseif($template->new): ?>
																	<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></span>
																<?php endif; ?>	
															</div>
														</div>
													</div>							
												</div>
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>	
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
							</div>	
						</div>

						<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="tab-pane fade" id="<?php echo e($category->code); ?>" role="tabpanel" aria-labelledby="<?php echo e($category->code); ?>-tab">
								<div class="row" id="templates-panel">
									<?php $__currentLoopData = $favorite_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($template->group == $category->code): ?>
											<div class="col-lg-3 col-md-6 col-sm-12">
												<div class="template">
													<a id="<?php echo e($template->template_code); ?>" <?php if($template->favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatus(this.id)"><i id="<?php echo e($template->template_code); ?>-icon" class="<?php if($template->favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
													<div class="temp card <?php if($template->package == 'professional'): ?> professional <?php elseif($template->package == 'premium'): ?> premium <?php elseif($template->favorite): ?> favorite <?php else: ?> border-0 <?php endif; ?>" id="<?php echo e($template->template_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/templates/original-template')); ?>/<?php echo e($template->slug); ?>'">
														<div class="card-body pt-5">
															<div class="template-icon mb-4">
																<?php echo $template->icon; ?>												
															</div>
															<div class="template-title">
																<h6 class="mb-2 fs-15 number-font"><?php echo e(__($template->name)); ?></h6>
															</div>
															<div class="template-info">
																<p class="fs-13 text-muted mb-2"><?php echo e(__($template->description)); ?></p>
															</div>
															<?php if($template->package == 'professional'): ?> 
																<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
															<?php elseif($template->package == 'free'): ?>
																<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
															<?php elseif($template->package == 'premium'): ?>
																<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
															<?php elseif($template->new): ?>
																<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></span>
															<?php endif; ?>	
														</div>
													</div>
												</div>							
											</div>
										<?php endif; ?>									
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									<?php $__currentLoopData = $favorite_custom_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($template->group == $category->code): ?>
											<div class="col-lg-3 col-md-6 col-sm-12">
												<div class="template">
													<a id="<?php echo e($template->template_code); ?>" <?php if($template->favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatusCustom(this.id)"><i id="<?php echo e($template->template_code); ?>-icon" class="<?php if($template->favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
													<div class="temp card <?php if($template->package == 'professional'): ?> professional <?php elseif($template->package == 'premium'): ?> premium <?php elseif($template->favorite): ?> favorite <?php else: ?> border-0 <?php endif; ?>" id="<?php echo e($template->template_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/templates')); ?>/<?php echo e($template->slug); ?>/<?php echo e($template->template_code); ?>'">
														<div class="card-body pt-5">
															<div class="template-icon mb-4">
																<?php echo $template->icon; ?>												
															</div>
															<div class="template-title">
																<h6 class="mb-2 fs-15 number-font"><?php echo e(__($template->name)); ?></h6>
															</div>
															<div class="template-info">
																<p class="fs-13 text-muted mb-2"><?php echo e(__($template->description)); ?></p>
															</div>
															<?php if($template->package == 'professional'): ?> 
																<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
															<?php elseif($template->package == 'free'): ?>
																<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
															<?php elseif($template->package == 'premium'): ?>
																<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
															<?php elseif($template->new): ?>
																<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></span>
															<?php endif; ?>	
														</div>
													</div>
												</div>							
											</div>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
									<?php $__currentLoopData = $other_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($template->group == $category->code): ?>
											<div class="col-lg-3 col-md-6 col-sm-12">
												<div class="template">
													<a id="<?php echo e($template->template_code); ?>" <?php if($template->favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatus(this.id)"><i id="<?php echo e($template->template_code); ?>-icon" class="<?php if($template->favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
													<div class="temp card <?php if($template->package == 'professional'): ?> professional <?php elseif($template->package == 'premium'): ?> premium <?php elseif($template->favorite): ?> favorite <?php else: ?> border-0 <?php endif; ?>" id="<?php echo e($template->template_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/templates/original-template')); ?>/<?php echo e($template->slug); ?>'">
														<div class="card-body pt-5">
															<div class="template-icon mb-4">
																<?php echo $template->icon; ?>												
															</div>
															<div class="template-title">
																<h6 class="mb-2 fs-15 number-font"><?php echo e(__($template->name)); ?></h6>
															</div>
															<div class="template-info">
																<p class="fs-13 text-muted mb-2"><?php echo e(__($template->description)); ?></p>
															</div>
															<?php if($template->package == 'professional'): ?> 
																<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
															<?php elseif($template->package == 'free'): ?>
																<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
															<?php elseif($template->package == 'premium'): ?>
																<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
															<?php elseif($template->new): ?>
																<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></span>
															<?php endif; ?>	
														</div>
													</div>
												</div>							
											</div>	
										<?php endif; ?>									
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		

									<?php $__currentLoopData = $custom_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($template->group == $category->code): ?>
											<div class="col-lg-3 col-md-6 col-sm-12">
												<div class="template">
													<a id="<?php echo e($template->template_code); ?>" <?php if($template->favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatusCustom(this.id)"><i id="<?php echo e($template->template_code); ?>-icon" class="<?php if($template->favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
													<div class="temp card <?php if($template->package == 'professional'): ?> professional <?php elseif($template->package == 'premium'): ?> premium <?php elseif($template->favorite): ?> favorite <?php else: ?> border-0 <?php endif; ?>" id="<?php echo e($template->template_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/templates')); ?>/<?php echo e($template->slug); ?>/<?php echo e($template->template_code); ?>'">
														<div class="card-body pt-5">
															<div class="template-icon mb-4">
																<?php echo $template->icon; ?>												
															</div>
															<div class="template-title">
																<h6 class="mb-2 fs-15 number-font"><?php echo e(__($template->name)); ?></h6>
															</div>
															<div class="template-info">
																<p class="fs-13 text-muted mb-2"><?php echo e(__($template->description)); ?></p>
															</div>
															<?php if($template->package == 'professional'): ?> 
																<p class="fs-8 btn btn-pro mb-0"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-pro"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
															<?php elseif($template->package == 'free'): ?>
																<p class="fs-8 btn btn-free mb-0"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-free"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
															<?php elseif($template->package == 'premium'): ?>
																<p class="fs-8 btn btn-yellow mb-0"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?> <?php if($template->new): ?> <p class="fs-8 btn btn-new mb-0 btn-new-premium"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></p> <?php endif; ?></p> 
															<?php elseif($template->new): ?>
																<span class="fs-8 btn btn-new mb-0"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></span>
															<?php endif; ?>	
														</div>
													</div>
												</div>							
											</div>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
					

					</div>
									
				</div>
			</div>
		</div>

	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script src="<?php echo e(URL::asset('plugins/sweetalert/sweetalert2.all.min.js')); ?>"></script>
	<script>
		function favoriteStatus(id) {

			let icon, card;
			let formData = new FormData();
			formData.append("id", id);

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'post',
				url: 'dashboard/favorite',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if (data['status'] == 'success') {
						if (data['set']) {
							Swal.fire('<?php echo e(__('Template Removed from Favorites')); ?>', '<?php echo e(__('Selected template has been successfully removed from favorites')); ?>', 'success');
							icon = document.getElementById(id + '-icon');
							icon.classList.remove("fa-solid");
							icon.classList.remove("fa-stars");
							icon.classList.add("fa-regular");
							icon.classList.add("fa-star");

							card = document.getElementById(id + '-card');
							if(card.classList.contains("professional")) {
								// do nothing
							} else {
								card.classList.remove("favorite");
								card.classList.add('border-0');
							}							
						} else {
							Swal.fire('<?php echo e(__('Template Added to Favorites')); ?>', '<?php echo e(__('Selected template has been successfully added to favorites')); ?>', 'success');
							icon = document.getElementById(id + '-icon');
							icon.classList.remove("fa-regular");
							icon.classList.remove("fa-star");
							icon.classList.add("fa-solid");
							icon.classList.add("fa-stars");

							card = document.getElementById(id + '-card');
							if(card.classList.contains("professional")) {
								// do nothing
							} else {
								card.classList.add('favorite');
								card.classList.remove('border-0');
							}
						}
														
					} else {
						Swal.fire('<?php echo e(__('Favorite Setting Issue')); ?>', '<?php echo e(__('There as an issue with setting favorite status for this template')); ?>', 'warning');
					}      
				},
				error: function(data) {
					Swal.fire('Oops...','Something went wrong!', 'error')
				}
			})	
		}

		$(document).on('keyup', '#search-template', function () {

			$('#all-tab').click();

			var searchTerm = $(this).val().toLowerCase();
			$('#all #templates-panel').find('> div').each(function () {
				if ($(this).filter(function() {
					return $(this).find('h6').text().toLowerCase().indexOf(searchTerm) > -1;
				}).length > 0 || searchTerm.length < 1) {
					$(this).show();
				} else {
					$(this).hide();
					$('.templates-panel-group').hide();
				}
			});
		});

		$('.category-check').on('click', function (e) {
			e.preventDefault();
			$('#search-template').val('');
			$('.templates-panel-group').show();
			$('#all #templates-panel').find('> div').each(function () {
				$(this).show();
			});
		});

		function favoriteStatusCustom(id) {

			let icon, card;
			let formData = new FormData();
			formData.append("id", id);

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'post',
				url: 'dashboard/favoritecustom',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if (data['status'] == 'success') {
						if (data['set']) {
							Swal.fire('<?php echo e(__('Template Removed from Favorites')); ?>', '<?php echo e(__('Selected template has been successfully removed from favorites')); ?>', 'success');
							icon = document.getElementById(id + '-icon');
							icon.classList.remove("fa-solid");
							icon.classList.remove("fa-stars");
							icon.classList.add("fa-regular");
							icon.classList.add("fa-star");

							card = document.getElementById(id + '-card');
							if(card.classList.contains("professional")) {
								// do nothing
							} else {
								card.classList.remove("favorite");
								card.classList.add('border-0');
							}							
						} else {
							Swal.fire('<?php echo e(__('Template Added to Favorites')); ?>', '<?php echo e(__('Selected template has been successfully added to favorites')); ?>', 'success');
							icon = document.getElementById(id + '-icon');
							icon.classList.remove("fa-regular");
							icon.classList.remove("fa-star");
							icon.classList.add("fa-solid");
							icon.classList.add("fa-stars");

							card = document.getElementById(id + '-card');
							if(card.classList.contains("professional")) {
								// do nothing
							} else {
								card.classList.add('favorite');
								card.classList.remove('border-0');
							}
						}
														
					} else {
						Swal.fire('<?php echo e(__('Favorite Setting Issue')); ?>', '<?php echo e(__('There as an issue with setting favorite status for this template')); ?>', 'warning');
					}      
				},
				error: function(data) {
					Swal.fire('Oops...','Something went wrong!', 'error')
				}
			})
		}
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/user/templates/index.blade.php ENDPATH**/ ?>