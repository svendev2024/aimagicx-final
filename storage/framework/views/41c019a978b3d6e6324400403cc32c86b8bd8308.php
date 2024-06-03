

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Show Transaction Details')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa-solid fa-sack-dollar mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.finance.dashboard')); ?>"> <?php echo e(__('Finance Management')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.finance.transactions')); ?>"> <?php echo e(__('Transactions')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> <?php echo e(__('Show Transaction Details')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>						
	<div class="row">
		<div class="col-lg-6 col-md-6 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('Transaction')); ?> ID: <span class="text-info"><?php echo e($id->order_id); ?></span></h3>
				</div>
				<div class="card-body pt-5">		

					<div class="row">
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Transaction Date')); ?>: </h6>
							<span class="fs-14"><?php echo e(date_format($id->created_at, 'd M Y, H:i A')); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Total Price')); ?>: </h6>
							<span class="fs-14"><?php echo config('payment.default_system_currency_symbol'); ?><?php echo e(ucfirst($id->price)); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Payment Status')); ?>: </h6>
							<span class="fs-14"><?php echo e(ucfirst($id->status)); ?></span>
						</div>
					</div>

					<div class="row pt-5">
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Plan Name')); ?>: </h6>
							<span class="fs-14"><?php echo e(ucfirst($id->plan_name)); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Words Included')); ?>: </h6>
							<span class="fs-14"><?php echo e(number_format($id->words)); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Payment Gateway')); ?>: </h6>
							<span class="fs-14"><?php echo e($id->gateway); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12 pt-5">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Payment Frequency')); ?>: </h6>
							<span class="fs-14"><?php echo e(ucfirst($id->frequency)); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12 pt-5">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('User Name')); ?>: </h6>
							<span class="fs-14"><?php echo e($user->name); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12 pt-5">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('User Email')); ?>: </h6>
							<span class="fs-14"><?php echo e($user->email); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12 pt-5">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Country')); ?>: </h6>
							<span class="fs-14"><?php echo e($user->country); ?></span>
						</div>
					</div>	

					<div class="row pt-7">
						<div class="col-12">
							<a href="<?php echo e(route('user.payments.invoice.show', $id)); ?>" class="btn btn-primary w-110"><?php echo e(__('Get Invoice')); ?></a>						
						</div>
					</div>	

					<!-- SAVE CHANGES ACTION BUTTON -->
					<div class="border-0 text-right mb-2 mt-7">
						<a href="<?php echo e(route('admin.finance.transactions')); ?>" class="btn btn-primary"><?php echo e(__('Return')); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/admin/finance/transactions/show.blade.php ENDPATH**/ ?>