

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Bank Transfer Checkout')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('user.dashboard')); ?>"><i class="fa-solid fa-box-circle-check mr-2 fs-12"></i><?php echo e(__('User')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('user.plans')); ?>"> <?php echo e(__('Pricing Plans')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('Bank Transfer Checkout')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>	
	<div class="row">
		<div class="col-md-6">
			<div class="card border-0 pt-2">
				<div class="card-body">			
					<div class="text-center">
						<i class="mdi mdi-approval fs-45 text-info mb-4"></i>
						<h4 class="checkout-success"><?php echo e(__('Almost There')); ?>!</h4>
						<div class="text-center mb-6">
							<p class="mt-5 fs-14"><?php echo e(__('You have successfully placed order for ')); ?> <span class="text-info font-weight-bold"><?php echo e($id->plan_name); ?></span> <?php echo e(__('plan')); ?>.</p>
							<p class="fs-14"><?php echo e(__('After successful payment, your plan will be activated. To keep your plan active in coming month, please provide payments by the end of each month (prepaid plans are charged once)')); ?>.</p>
							<p class="fs-14"><?php echo e(__('Please provide payment to our bank requisites below. Use Order ID number as payment reference')); ?>.</p>	
							<p class="text-muted fs-12 mb-4"><?php echo e(__('Order ID')); ?>: <span class="font-weight-bold text-primary"><?php echo e($orderID); ?></span></p>
							<p class="text-muted fs-12 mb-4"><?php echo e(__('Total Payment Due')); ?>: <span class="font-weight-bold text-primary"><?php echo e(number_format((float)$total_value, 2, '.', '')); ?> <?php echo e($currency); ?></span></p>
							<pre class="text-muted fs-12 mb-4"><?php echo e($bank['bank_requisites']); ?></pre>
						</div>						
						<div class="text-center pt-2 pb-4">
							<a href="<?php echo e(route('user.payments.invoice.transfer', $orderID)); ?>" id="invoice-button" class="btn btn-primary pl-6 pr-6 mr-2"><?php echo e(__('Get Bank Requisites')); ?></a>
							<a href="<?php echo e(route('user.dashboard')); ?>" id="payment-button" class="btn btn-primary pl-6 pr-6"><?php echo e(__('My Dashboard')); ?></a>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/user/plans/banktransfer-success.blade.php ENDPATH**/ ?>