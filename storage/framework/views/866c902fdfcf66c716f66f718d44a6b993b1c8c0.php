

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('New Payout Request')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('user.dashboard')); ?>"><i class="fa-solid fa-badge-dollar mr-2 fs-12"></i><?php echo e(__('User')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('user.referral')); ?>"> <?php echo e(__('Affiliate Program')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('user.referral.payout')); ?>"> <?php echo e(__('My Payouts')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('New Payout Request')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>	
	<div class="row">
		<div class="col-lg-4 col-md-12 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('Create New Payout Request')); ?></h3>
				</div>
				<div class="card-body">
					
					<form action="<?php echo e(route('user.referral.payout.store')); ?>" method="POST" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>				

						<h6 class="fs-12 mb-5 mt-3"><?php echo e(__('Minimum amount for all payout request is')); ?> <span class="font-weight-bold"><?php echo e(config('payment.referral.payment.threshold')); ?> <?php echo e(config('payment.default_currency')); ?></span></h6>
						
						<h6 class="fs-12 mb-6 mt-3"><?php echo e(__('Your current balance is')); ?>: <span class="font-weight-bold"><?php echo e(auth()->user()->balance); ?> <?php echo e(config('payment.default_currency')); ?></span></h6>
						
						<h6 class="fs-12 mb-6 mt-3"><?php echo e(__('Your preferred payout method is')); ?>: <span class="font-weight-bold"><?php if(auth()->user()->referral_payment_method == ''): ?> <?php echo e(__('Not Set')); ?> <span class="text-muted">(<?php echo e(__('Please configure it under My Gateway tab')); ?>)</span> <?php else: ?> <?php echo e(auth()->user()->referral_payment_method); ?><?php endif; ?></span></h6>

						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">								
								<div class="input-box">								
									<h6><?php echo e(__('Total request amount')); ?></h6>
									<div class="form-group">							    
										<input type="number" class="form-control <?php $__errorArgs = ['payout'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="payout" name="payout" value="<?php echo e(old('payout')); ?>">
									</div> 
									<?php $__errorArgs = ['payout'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<p class="text-danger"><?php echo e($errors->first('payout')); ?></p>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div> 
							</div>
						</div>
	

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<a href="<?php echo e(route('user.referral.payout')); ?>" class="btn btn-cancel mr-2"><?php echo e(__('Cancel')); ?></a>
							<button type="submit" class="btn btn-primary"><?php echo e(__('Create')); ?></button>							
						</div>				

					</form>

				</div>
			</div>

		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/user/referrals/payouts/create.blade.php ENDPATH**/ ?>