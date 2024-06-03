

<?php $__env->startSection('page-header'); ?>
	<!-- EDIT PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Upgrade Software')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-sliders mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('General Settings')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('Upgrade Software')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(config('app.name')); ?> <?php echo e(__('Software Upgrade')); ?></h3>
				</div>
				<div class="card-body">
					<form id="upgrade-form" method="POST" action="<?php echo e(route('admin.settings.upgrade.start', ['update_id' => $latest_version['update_id'], 'version' => $latest_version['version']])); ?>" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>
						
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<h6 class="fs-14 mt-2"><?php echo e(__('Current Installed Software Version')); ?>: <span class="text-info font-weight-bold"><?php echo e($current_version); ?></span></h6>								
								<?php if($latest_version['status']): ?>
									<div id="not-installed-info">
										<h6 class="mt-4"><?php echo e(__('New')); ?><span class="text-info font-weight-bold"> <?php echo e($latest_version['version']); ?> </span> <?php echo e(__('version is available for download')); ?>.</h6>
										<h6><span class="text-danger fs-14 font-weight-bold"><?php echo e(__('Warning!')); ?> </span><?php echo e(__('Always backup your database and script files before any upgrade')); ?>.</h6>
									</div>
									<div id="installed-info">
										<h6 class="text-success fs-14 font-weight-bold mt-4"><?php echo e(config('app.name')); ?> <?php echo e(__('was successfully updated to the latest version')); ?>!</h6>
									</div>
								<?php else: ?>
									<h6 class="text-success fs-14 font-weight-bold mt-4 mb-5"><?php echo e(__('You have the latest version installed')); ?>!</h6>
								<?php endif; ?>
								<p class="fs-14"><span class="text-danger fs-14 font-weight-bold"><?php echo e(__('Important')); ?>:</span> <?php echo e(__('Allways follow the instructions in the Update tab of the documentation before and after every update for additional required manual steps')); ?> - <a class="font-weight-bold text-primary" target="_blank" href="https://openaidavinci.textract.ai/public/documentation/"><?php echo e(__('Documentation Link')); ?></a></p>
							</div>
						</div>
						<div class="card-footer text-center border-0 pb-2 pt-5">		
							<span id="processing"><img src="<?php echo e(URL::asset('/img/svgs/upgrade.svg')); ?>" alt=""></span>												
							<button id="upgrade" type="button" class="btn btn-primary"><?php if($latest_version['status']): ?> <?php echo e(__('Download & Install Upgrade')); ?> <?php else: ?>	<?php echo e(__('Check New Version')); ?> <?php endif; ?></button>						
						</div>		
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script src="<?php echo e(URL::asset('js/upgrade.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/admin/settings/upgrade/index.blade.php ENDPATH**/ ?>