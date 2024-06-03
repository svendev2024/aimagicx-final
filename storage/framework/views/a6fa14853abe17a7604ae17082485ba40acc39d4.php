

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Registration Settings')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-sliders mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('General Settings')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('Registration Settings')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>					
	<div class="row">
		<div class="col-lg-5 col-md-12 col-xm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('Setup Registration Settings')); ?></h3>
				</div>
				<div class="card-body">
					
					<form action="<?php echo e(route('admin.settings.registration.store')); ?>" method="POST" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>				

						<div class="row">

							<div class="col-12">							
								<div class="input-box">	
									<h6><?php echo e(__('New User Registration')); ?></h6>
			  						<select id="registration" name="registration" data-placeholder="<?php echo e(__('Select Registration Option')); ?>:">			
										<option value="enabled" <?php if( config('settings.registration')  == 'enabled'): ?> selected <?php endif; ?>><?php echo e(__('Enabled')); ?></option>
										<option value="disabled" <?php if( config('settings.registration')  == 'disabled'): ?> selected <?php endif; ?>><?php echo e(__('Disabled')); ?></option>
									</select>
								</div> 						
							</div>

							<div class="col-12">							
								<div class="input-box">	
									<h6><?php echo e(__('New User Email Verification')); ?></h6>
			  						<select id="email-verification" name="email-verification" data-placeholder="<?php echo e(__('Select Email Verification Option')); ?>:">			
										<option value="enabled" <?php if( config('settings.email_verification')  == 'enabled'): ?> selected <?php endif; ?>><?php echo e(__('Enabled')); ?></option>
										<option value="disabled" <?php if( config('settings.email_verification')  == 'disabled'): ?> selected <?php endif; ?>><?php echo e(__('Disabled')); ?></option>
									</select>
								</div> 						
							</div>

							<div class="col-12">							
								<div class="input-box">	
									<h6><?php echo e(__('Default Country')); ?></h6>
			  						<select id="user-country" name="country" data-placeholder="<?php echo e(__('Select Default User Country')); ?>:">			
										<?php $__currentLoopData = config('countries'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($value); ?>" <?php if(config('settings.default_country') == $value): ?> selected <?php endif; ?>><?php echo e($value); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div> 						
							</div>

						</div>

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<button type="submit" class="btn btn-primary mr-2"><?php echo e(__('Save')); ?></button>							
						</div>				

					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/admin/settings/registration/index.blade.php ENDPATH**/ ?>