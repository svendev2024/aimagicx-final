

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Secure Checkout')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('user.dashboard')); ?>"><i class="fa-solid fa-box-circle-check mr-2 fs-12"></i><?php echo e(__('User')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('user.plans')); ?>"> <?php echo e(__('Pricing Plans')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('Subscription Plan Checkout')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>	
	<div class="row">
		<div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">
			<div class="card border-0 pt-2">
				<div class="card-body">	
					
					<form id="payment-form" action="<?php echo e(route('user.payments.pay', $id)); ?>" method="POST" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>

						<div class="row">
							<div class="col-md-6 col-sm-12 pr-4">
								<div class="checkout-wrapper-box pb-0">							

									<p class="checkout-title mt-2"><i class="fa-solid fa-lock-hashtag mr-2 text-success"></i><?php echo e(__('Secure Checkout')); ?></p>

									<div class="divider mb-5">
										<div class="divider-text text-muted">
											<small><?php echo e(__('Select Payment Option')); ?></small>
										</div>
									</div>

									<div class="form-group" id="toggler">
										<div class="text-center">
											<div class="btn-group btn-group-toggle w-100" data-toggle='buttons'>
												<div class="row w-100">
													<?php $__currentLoopData = $payment_platforms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
															<label class="gateway btn rounded p-0" href="#<?php echo e($payment_platform->name); ?>Collapse" data-bs-toggle="collapse">
																<input type="radio" class="gateway-radio" name="payment_platform" value="<?php echo e($payment_platform->id); ?>" required>
																<img src="<?php echo e(URL::asset($payment_platform->image)); ?>" 
																class="<?php if($payment_platform->name == 'Paystack' || $payment_platform->name == 'Razorpay' || $payment_platform->name == 'PayPal'): ?> payment-image	
																<?php elseif($payment_platform->name == 'Braintree'): ?> payment-image-braintree
																<?php elseif($payment_platform->name == 'Mollie'): ?> payment-image-mollie
																<?php elseif($payment_platform->name == 'Stripe'): ?> payment-image-stripe	
																<?php endif; ?>" alt="<?php echo e($payment_platform->name); ?>">
															</label>	
														</div>									
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		
												</div>							
											</div>
										</div>

										<?php $__currentLoopData = $payment_platforms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($payment_platform->name !== 'BankTransfer'): ?>
												<div id="<?php echo e($payment_platform->name); ?>Collapse" class="collapse" data-bs-parent="#toggler">
													<?php if ($__env->exists('components.'.strtolower($payment_platform->name).'-collapse')) echo $__env->make('components.'.strtolower($payment_platform->name).'-collapse', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
												</div>
											<?php else: ?>
												<div id="<?php echo e($payment_platform->name); ?>Collapse" class="collapse" data-bs-parent="#toggler">
													<div class="text-center pb-2">
														<p class="text-muted fs-12 mb-4"><?php echo e($bank['bank_instructions']); ?></p>
														<p class="text-muted fs-12 mb-4">Order ID: <span class="font-weight-bold text-primary"><?php echo e($bank_order_id); ?></span></p>
														<pre class="text-muted fs-12 mb-4"><?php echo e($bank['bank_requisites']); ?></pre>															
													</div>
												</div>																										
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>

									<input type="hidden" name="value" value="<?php echo e($total_value); ?>">
									<input type="hidden" name="currency" value="<?php echo e($currency); ?>">																															
									
								</div>
							</div>

							<div class="col-md-6 col-sm-12 pl-4">
								<div class="checkout-wrapper-box">

									<p class="checkout-title mt-2"><i class="fa fa-archive mr-2"></i><?php echo e(__('Plan Name')); ?>: <span class="text-info"><?php echo e($id->plan_name); ?> (<?php echo e(ucfirst($id->payment_frequency) . ' Plan'); ?>)</span></p>

									<div class="divider mb-4">
										<div class="divider-text text-muted">
											<small><?php echo e(__('Purchase Summary')); ?></small>
										</div>
									</div>

									<div>
										<p class="fs-12 p-family"><?php echo e(__('Subtotal')); ?> <span class="checkout-cost"><?php echo config('payment.default_system_currency_symbol'); ?> <?php if(config('payment.decimal_points') == 'allow'): ?> <?php echo e(number_format((float)$id->price, 2, '.', '')); ?> <?php else: ?> <?php echo e(number_format($id->price)); ?> <?php endif; ?></span></p>
										<p class="fs-12 p-family"><?php echo e(__('Taxes')); ?> <span class="text-muted">(<?php echo e(config('payment.payment_tax')); ?>%)</span><span class="checkout-cost"><?php echo config('payment.default_system_currency_symbol'); ?> <?php if(config('payment.decimal_points') == 'allow'): ?> <?php echo e(number_format((float)$tax_value, 2, '.', '')); ?> <?php else: ?> <?php echo e(number_format($tax_value)); ?> <?php endif; ?></span></p>
									</div>

									<div class="divider mb-5">
										<div class="divider-text text-muted">
											<small><?php echo e(__('Total')); ?></small>
										</div>
									</div>

									<div>
										<p class="fs-12 p-family"><?php echo e(__('Total Payment')); ?> </span><span class="checkout-cost text-info"><?php echo config('payment.default_system_currency_symbol'); ?><span id="total_payment"> <?php if(config('payment.decimal_points') == 'allow'): ?> <?php echo e(number_format((float)$total_value, 2, '.', '')); ?> <?php else: ?> <?php echo e(number_format($total_value)); ?> <?php endif; ?></span> <?php echo e($currency); ?></span></p>
									</div>

									<div class="text-center pt-4 pb-1">
									    
										<button type="submit" id="payment-button" class="btn btn-primary pl-6 pr-6 mb-1"><?php echo e(__('Checkout Now')); ?></button>
									</div>

								</div>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/user/plans/subscribe-checkout.blade.php ENDPATH**/ ?>