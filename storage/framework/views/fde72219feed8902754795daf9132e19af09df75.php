

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('View System Notification')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa-solid fa-message-exclamation mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.notifications')); ?>"> <?php echo e(__('Mass Notifications')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('View System Notification')); ?></a></li>
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
					<h3 class="card-title"><?php echo e(__('Notification')); ?> ID: <span class="text-info"><?php echo e($notification->id); ?></span></h3>
				</div>
				<div class="card-body pt-5">		

					<div class="row">
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Type')); ?>: </h6>
							<span class="fs-14"><?php if($notification->data['type'] == 'new-user'): ?>
													<?php echo e(__('New User')); ?>

												<?php elseif($notification->data['type'] == 'new-payment'): ?>
													<?php echo e(__('New Payment')); ?>

												<?php endif; ?> 												
							</span>
						</div>						
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Created On')); ?>: </h6>
							<span class="fs-14"><?php echo e(date_format($notification->created_at, 'd M Y H:i:s')); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Read On')); ?>: </h6>
							<span class="fs-14"><?php echo e(date_format($notification->read_at, 'd M Y H:i:s')); ?></span>
						</div>
					</div>

					<div class="row pt-5">
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('User Name')); ?>: </h6>
							<span class="fs-14"><?php echo e($notification->data['name']); ?></span>
						</div>						
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('User Email')); ?>: </h6>
							<span class="fs-14"><?php echo e($notification->data['email']); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Country')); ?>: </h6>
							<span class="fs-14"><?php echo e($notification->data['country']); ?></span>
						</div>
					</div>

					<div class="row pt-7">
						<div class="col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Subject')); ?>: </h6>
							<p class="fs-14 font-italic text-muted"><?php echo e($notification->data['subject']); ?></p>
						</div>
					</div>	

					<!-- SAVE CHANGES ACTION BUTTON -->
					<div class="border-0 text-right mb-2 mt-8">
						<a href="<?php echo e(route('admin.notifications.system')); ?>" class="btn btn-primary"><?php echo e(__('Return')); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/admin/notification/systemShow.blade.php ENDPATH**/ ?>