

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Subscription Plans')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('user.dashboard')); ?>"><i class="fa-solid fa-box-circle-check mr-2 fs-12"></i><?php echo e(__('User')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('user.plans')); ?>"> <?php echo e(__('Pricing Plans')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>	
	<div class="card border-0 pt-2">
		<div class="card-body">			
			
			<?php if($monthly || $yearly || $prepaid || $lifetime): ?>

				<div class="tab-menu-heading text-center">
					<div class="tabs-menu dark-theme-target" >								
						<ul class="nav">
							<?php if($prepaid): ?>						
								<li><a href="#prepaid" class="<?php if(!$monthly && !$yearly && $prepaid && !$lifetime): ?> active <?php else: ?> '' <?php endif; ?>" data-bs-toggle="tab"> <?php echo e(__('Prepaid Plans')); ?></a></li>
							<?php endif; ?>							
							<?php if($monthly): ?>
								<li><a href="#monthly_plans" class="<?php if(($monthly && $prepaid && $yearly) || ($monthly && !$prepaid && !$yearly) || ($monthly && $prepaid && !$yearly) || ($monthly && !$prepaid && $yearly)): ?> active <?php else: ?> '' <?php endif; ?>" data-bs-toggle="tab"> <?php echo e(__('Monthly Plans')); ?></a></li>
							<?php endif; ?>	
							<?php if($yearly): ?>
								<li><a href="#yearly_plans" class="<?php if((!$monthly && !$prepaid && $yearly && !$lifetime) || (!$monthly && $prepaid && $yearly && !$lifetime) || (!$monthly && $prepaid && $yearly && $lifetime)): ?>  active <?php else: ?> '' <?php endif; ?>" data-bs-toggle="tab"> <?php echo e(__('Yearly Plans')); ?></a></li>
							<?php endif; ?>
							<?php if($lifetime): ?>
								<li><a href="#lifetime" class="<?php if((!$monthly && !$yearly && !$prepaid &&  $lifetime) || (!$monthly && !$yearly && $prepaid &&  $lifetime)): ?> active <?php else: ?> '' <?php endif; ?>" data-bs-toggle="tab"> <?php echo e(__('Lifetime Plans')); ?></a></li>
							<?php endif; ?>								
						</ul>
					</div>
				</div>

			

				<div class="tabs-menu-body">
					<div class="tab-content">

						<?php if($prepaid): ?>
							<div class="tab-pane <?php if((!$monthly && $prepaid) && (!$yearly && $prepaid)): ?> active <?php else: ?> '' <?php endif; ?>" id="prepaid">

								<?php if($prepaids->count()): ?>

									<h6 class="font-weight-normal fs-12 text-center mb-6"><?php echo e(__('Top up your subscription with more credits or start with Prepaid Plans credits only')); ?></h6>
									
									<div class="row justify-content-md-center">
									
										<?php $__currentLoopData = $prepaids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prepaid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>																			
											<div class="col-lg-3 col-md-6 col-sm-12 flexroom">
												<div class="price-card pl-3 pr-3 pt-2 mb-7">
													<div class="card border-0 p-4 pl-5">
														<div class="plan prepaid-plan">
															<div class="plan-title"><?php echo e(__($prepaid->plan_name)); ?> <span class="prepaid-currency-sign"><?php echo e($prepaid->currency); ?></span><span class="plan-cost"><?php if(config('payment.decimal_points') == 'allow'): ?> <?php echo e(number_format((float)$prepaid->price, 2)); ?> <?php else: ?> <?php echo e(number_format($prepaid->price)); ?> <?php endif; ?></span><span class="prepaid-currency-sign"><?php echo config('payment.default_system_currency_symbol'); ?></span></div>
																<p class="fs-12 mt-2 mb-0"><?php echo e(__('Words Included')); ?>: <span class="ml-2 font-weight-bold text-primary"><?php echo e(number_format($prepaid->words)); ?></span></p>
																<p class="fs-12 mt-2 mb-0"><?php echo e(__('Images Included')); ?>: <span class="ml-2 font-weight-bold text-primary"><?php echo e(number_format($prepaid->images)); ?></span></p>																								
																<p class="fs-12 mt-2 mb-0"><?php echo e(__('Characters Included')); ?>: <span class="ml-2 font-weight-bold text-primary"><?php echo e(number_format($prepaid->characters)); ?></span></p>																								
																<p class="fs-12 mt-2 mb-4"><?php echo e(__('Minutes Included')); ?>: <span class="ml-2 font-weight-bold text-primary"><?php echo e(number_format($prepaid->minutes)); ?></span></p>																								
															<div class="text-center action-button mt-2 mb-2">
																<a href="<?php echo e(route('user.prepaid.checkout', ['type' => 'prepaid', 'id' => $prepaid->id])); ?>" class="btn btn-cancel"><?php echo e(__('Purchase')); ?></a> 
															</div>
														</div>							
													</div>	
												</div>							
											</div>										
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>						

									</div>

								<?php else: ?>
									<div class="row text-center">
										<div class="col-sm-12 mt-6 mb-6">
											<h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No Prepaid plans were set yet')); ?></h6>
										</div>
									</div>
								<?php endif; ?>

							</div>			
						<?php endif; ?>	

						<?php if($monthly): ?>	
							<div class="tab-pane <?php if(($monthly && $prepaid) || ($monthly && !$prepaid) || ($monthly && !$yearly)): ?> active <?php else: ?> '' <?php endif; ?>" id="monthly_plans">

								<?php if($monthly_subscriptions->count()): ?>		
									
									<h6 class="font-weight-normal fs-12 text-center mb-6"><?php echo e(__('Subscribe to our Monthly Subscription Plans and enjoy ton of benefits')); ?></h6>

									<div class="row justify-content-md-center">

										<?php $__currentLoopData = $monthly_subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>																			
											<div class="col-lg-3 col-md-6 col-sm-12 flexroom">
												<div class="pl-6 pr-6 pt-2 mb-7 prices-responsive">
													<div class="card border-0 p-4 pl-5 pr-5 pt-7 price-card <?php if($subscription->featured): ?> price-card-border <?php endif; ?>">
														<?php if($subscription->featured): ?>
															<span class="plan-featured"><?php echo e(__('Most Popular')); ?></span>
														<?php endif; ?>
														<div class="plan">			
															<div class="plan-title text-center"><?php echo e(__($subscription->plan_name)); ?></div>		
															<p class="fs-12 text-center mb-3"><?php echo e(__($subscription->primary_heading)); ?></p>																					
															<p class="plan-cost text-center mb-0"><span class="plan-currency-sign"></span><?php echo config('payment.default_system_currency_symbol'); ?> <?php if(config('payment.decimal_points') == 'allow'): ?> <?php echo e(number_format((float)$subscription->price, 2)); ?> <?php else: ?> <?php echo e(number_format($subscription->price)); ?> <?php endif; ?></p>
															<p class="fs-12 text-center mb-3"><?php echo e($subscription->currency); ?> / <?php echo e(__('Month')); ?></p>
															<div class="text-center action-button mt-2 mb-5">
																<?php if(auth()->user()->plan_id == $subscription->id): ?>
																	<button type="button" class="btn btn-cancel"><?php echo e(__('Subscribed')); ?></button> 
																<?php else: ?>
																	<a href="<?php echo e(route('user.plan.subscribe', $subscription->id)); ?>" class="btn btn-primary"><?php echo e(__('Subscribe Now')); ?></a>
																<?php endif; ?>															
															</div>
															<p class="fs-12 text-center mb-3"><?php echo e(__($subscription->secondary_heading )); ?></p>																	
															<ul class="fs-12 pl-3">														
																<?php $__currentLoopData = (explode(',', $subscription->plan_features)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																	<?php if($feature): ?>
																		<li><i class="fa-solid fa-circle-small fs-10 text-muted"></i> <?php echo e(__($feature)); ?></li>
																	<?php endif; ?>																
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>															
															</ul>																
														</div>					
													</div>	
												</div>							
											</div>										
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									</div>	
								
								<?php else: ?>
									<div class="row text-center">
										<div class="col-sm-12 mt-6 mb-6">
											<h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No Subscriptions plans were set yet')); ?></h6>
										</div>
									</div>
								<?php endif; ?>					
							</div>	
						<?php endif; ?>	
						
						<?php if($yearly): ?>	
							<div class="tab-pane <?php if(($yearly && $prepaid) && ($yearly && !$prepaid) && ($yearly && !$monthly)): ?> active <?php else: ?> '' <?php endif; ?>" id="yearly_plans">

								<?php if($yearly_subscriptions->count()): ?>		
									
									<h6 class="font-weight-normal fs-12 text-center mb-6"><?php echo e(__('Subscribe to our Yearly Subscription Plans and enjoy ton of benefits')); ?></h6>

									<div class="row justify-content-md-center">

										<?php $__currentLoopData = $yearly_subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>																			
											<div class="col-lg-3 col-md-6 col-sm-12 flexroom">
												<div class="pl-6 pr-6 pt-2 mb-7 prices-responsive">
													<div class="card border-0 p-4 pl-5 pr-5 pt-7 price-card <?php if($subscription->featured): ?> price-card-border <?php endif; ?>">
														<?php if($subscription->featured): ?>
															<span class="plan-featured"><?php echo e(__('Most Popular')); ?></span>
														<?php endif; ?>
														<div class="plan">			
															<div class="plan-title text-center"><?php echo e(__($subscription->plan_name)); ?></div>		
															<p class="fs-12 text-center mb-3"><?php echo e(__($subscription->primary_heading)); ?></p>																					
															<p class="plan-cost text-center mb-0"><span class="plan-currency-sign"></span><?php echo config('payment.default_system_currency_symbol'); ?> <?php if(config('payment.decimal_points') == 'allow'): ?> <?php echo e(number_format((float)$subscription->price, 2)); ?> <?php else: ?> <?php echo e(number_format($subscription->price)); ?> <?php endif; ?></p>
															<p class="fs-12 text-center mb-3"><?php echo e($subscription->currency); ?> / <?php echo e(__('Year')); ?></p>
															<div class="text-center action-button mt-2 mb-4">
																<?php if(auth()->user()->plan_id == $subscription->id): ?>
																	<button type="button" class="btn btn-cancel"><?php echo e(__('Subscribed')); ?></button> 
																<?php else: ?>
																	<a href="<?php echo e(route('user.plan.subscribe', $subscription->id)); ?>" class="btn btn-primary"><?php echo e(__('Subscribe Now')); ?></a>
																<?php endif; ?>															
															</div>
															<p class="fs-12 text-center mb-3"><?php echo e(__($subscription->secondary_heading)); ?></p>																	
															<ul class="fs-12 pl-3">														
																<?php $__currentLoopData = (explode(',', $subscription->plan_features)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																	<?php if($feature): ?>
																		<li><i class="fa-solid fa-circle-small fs-10 text-muted"></i> <?php echo e(__($feature)); ?></li>
																	<?php endif; ?>																
																<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>															
															</ul>																
														</div>					
													</div>	
												</div>							
											</div>										
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									</div>	
								
								<?php else: ?>
									<div class="row text-center">
										<div class="col-sm-12 mt-6 mb-6">
											<h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No Subscriptions plans were set yet')); ?></h6>
										</div>
									</div>
								<?php endif; ?>					
							</div>
						<?php endif; ?>	
						
						<?php if($lifetime): ?>
							<div class="tab-pane <?php if((!$monthly && $lifetime) && (!$yearly && $lifetime)): ?> active <?php else: ?> '' <?php endif; ?>" id="lifetime">

								<?php if($lifetime_subscriptions->count()): ?>

									<h6 class="font-weight-normal fs-12 text-center mb-6"><?php echo e(__('Sign up and enjoy Lifetime Plans')); ?></h6>
									
									<div class="row justify-content-md-center">
									
										<?php $__currentLoopData = $lifetime_subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>																			
												<div class="col-lg-3 col-md-6 col-sm-12 flexroom">
													<div class="pl-6 pr-6 pt-2 mb-7 prices-responsive">
														<div class="card border-0 p-4 pl-5 pr-5 pt-7 price-card <?php if($subscription->featured): ?> price-card-border <?php endif; ?>">
															<?php if($subscription->featured): ?>
																<span class="plan-featured"><?php echo e(__('Most Popular')); ?></span>
															<?php endif; ?>
															<div class="plan">			
																<div class="plan-title text-center"><?php echo e(__($subscription->plan_name)); ?></div>		
																<p class="fs-12 text-center mb-3"><?php echo e(__($subscription->primary_heading)); ?></p>																					
																<p class="plan-cost text-center mb-0"><span class="plan-currency-sign"></span><?php echo config('payment.default_system_currency_symbol'); ?><?php echo e(number_format((float)$subscription->price, 2)); ?></p>
																<p class="fs-12 text-center mb-3"><?php echo e($subscription->currency); ?> / <?php echo e(__('Lifetime')); ?></p>
																<div class="text-center action-button mt-2 mb-4">
																	<?php if(auth()->user()->plan_id == $subscription->id): ?>
																		<button type="button" class="btn btn-cancel"><?php echo e(__('Subscribed')); ?></button> 
																	<?php else: ?>
																		<a href="<?php echo e(route('user.prepaid.checkout', ['type' => 'lifetime', 'id' => $subscription->id])); ?>" class="btn btn-primary"><?php echo e(__('Subscribe Now')); ?></a>
																	<?php endif; ?>															
																</div>
																<p class="fs-12 text-center mb-3"><?php echo e(__($subscription->secondary_heading)); ?></p>																	
																<ul class="fs-12 pl-3">														
																	<?php $__currentLoopData = (explode(',', $subscription->plan_features)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																		<?php if($feature): ?>
																			<li><i class="fa-solid fa-circle-small fs-10 text-muted"></i> <?php echo e(__($feature)); ?></li>
																		<?php endif; ?>																
																	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>															
																</ul>																
															</div>					
														</div>	
													</div>							
												</div>										
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>					

									</div>

								<?php else: ?>
									<div class="row text-center">
										<div class="col-sm-12 mt-6 mb-6">
											<h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No lifetime plans were set yet')); ?></h6>
										</div>
									</div>
								<?php endif; ?>

							</div>	
						<?php endif; ?>	
					</div>
				</div>
			
			<?php else: ?>
				<div class="row text-center">
					<div class="col-sm-12 mt-6 mb-6">
						<h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No Subscriptions or Prepaid plans were set yet')); ?></h6>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/user/plans/index.blade.php ENDPATH**/ ?>