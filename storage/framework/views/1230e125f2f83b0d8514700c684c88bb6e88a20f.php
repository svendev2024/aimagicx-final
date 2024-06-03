

<?php $__env->startSection('page-header'); ?>
	<!-- EDIT PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Clear Cache')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-sliders mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('General Settings')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('Clear Cache')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-xl-5 col-lg-5 col-sm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('Clear Cache')); ?></h3>
				</div>
				<div class="card-body">
					<form id="clear-cache" method="POST" action="<?php echo e(route('admin.settings.clear.cache')); ?>" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>
						
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<h6 class="fs-14 mt-2"><?php echo e(__('Clear all application cache files')); ?></h6>
							</div>
						</div>
						<div class="card-footer text-center border-0 pb-2 pt-5">													
							<button id="upgrade" type="submit" class="btn btn-primary"><?php echo e(__('Clear Cache')); ?></button>						
						</div>		
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-5 col-lg-5 col-sm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('Generate Symlink')); ?></h3>
				</div>
				<div class="card-body">
					<form id="clear-symlink" method="POST" action="<?php echo e(route('admin.settings.clear.symlink')); ?>" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>
						
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<h6 class="fs-14 mt-2"><?php echo e(__('Generate symlink file for image results in public folder')); ?></h6>
							</div>
						</div>
						<div class="card-footer text-center border-0 pb-2 pt-5">													
							<button id="upgrade" type="submit" class="btn btn-primary"><?php echo e(__('Generate Symlink')); ?></button>						
						</div>		
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/admin/settings/clear/index.blade.php ENDPATH**/ ?>