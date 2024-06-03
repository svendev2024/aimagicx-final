

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('My Payment Gateway')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('user.dashboard')); ?>"><i class="fa-solid fa-badge-dollar mr-2 fs-12"></i><?php echo e(__('User')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('user.referral')); ?>"> <?php echo e(__('Affiliate Program')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('My Payment Gateway')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>	
	<div class="row">
		<div class="col-lg-4 col-md-12 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-body p-6">
					<h3 class="card-title fs-20 text-center"><?php echo e(__('My Payment Gateway')); ?></h3>
					<p class="fs-12 text-center"><?php echo e(__('Select your preferred payment method to receive commissions')); ?>.</p>

					<form action="<?php echo e(route('user.referral.gateway.store')); ?>" method="POST" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>				

							<div class="row mb-6 mt-4">
								<div class="col-md-12 col-sm-12">
									<div id="storage-type-radio" role="radiogroup">
										<div class="radio-control">
											<input type="radio" name="payment_method" class="input-control" id="PayPal" value="PayPal" <?php if($user->referral_payment_method == 'PayPal'): ?> checked <?php endif; ?> style="vertical-align: middle;">
											<label for="PayPal" class="label-control fs-12">PayPal</label>
										</div>	
										<span  id="option-bank">
											<div class="radio-control">
												<input type="radio" name="payment_method" class="input-control" id="BankTransfer" value="BankTransfer" <?php if($user->referral_payment_method == 'BankTransfer'): ?> checked <?php endif; ?> style="vertical-align: middle;">
												<label for="BankTransfer" class="label-control fs-12"><?php echo e(__('Bank Transfer')); ?></label>
											</div>
										</span>									
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">								
									<div class="input-box">								
										<h6><?php echo e(__('Enter your PayPal ID')); ?></h6>
										<div class="form-group">							    
											<input type="text" class="form-control <?php $__errorArgs = ['paypal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="paypal" name="paypal" value="<?php echo e($user->referral_paypal); ?>">
										</div> 
										<?php $__errorArgs = ['paypal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('paypal')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="input-box">								
										<h6><?php echo e(__('Enter your Bank Account Requisites')); ?></h6> 
										<textarea class="form-control" name="bank_requisites" id="bank_requisites" rows="7" placeholder="Bank Name: 
Account Name/Full Name:
Account Number/IBAN:
BIC/Swift:
Routing Number:"><?php echo e($user->referral_bank_requisites); ?></textarea>
										<?php $__errorArgs = ['bank_requisites'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('bank_requisites')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div>	

								<!-- SAVE CHANGES ACTION BUTTON -->
								<div class="row w-100">
									<div class="col-md-12">
										<div class="border-0 text-right mt-1">
											<a href="<?php echo e(route('user.referral')); ?>" class="btn btn-cancel mr-2"><?php echo e(__('Return')); ?></a>
											<button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>							
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


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/user/referrals/gateway/index.blade.php ENDPATH**/ ?>