

<?php $__env->startSection('page-header'); ?>
	<!-- EDIT PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Increase Words & Images')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa-solid fa-id-badge mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.user.dashboard')); ?>"> <?php echo e(__('User Management')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.user.list')); ?>"><?php echo e(__('User List')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> <?php echo e(__('Increase Words & Images')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col-xl-6 col-lg-6 col-sm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('Add Words & Images')); ?></h3>
				</div>
				<div class="card-body">
					<form method="POST" action="<?php echo e(route('admin.user.increase', [$user->id])); ?>" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>
						
						<div class="row">

							<div class="col-sm-12 col-md-12 mt-2">
								<div>
									<p class="fs-12 font-weight-800 mb-2"><?php echo e(__('Full Name')); ?>: <span class="font-weight-normal ml-2"><?php echo e($user->name); ?></span></p>
									<p class="fs-12 font-weight-800 mb-2"><?php echo e(__('Email Address')); ?>: <span class="font-weight-normal ml-2"><?php echo e($user->email); ?></span></p>
									<p class="fs-12 font-weight-800 mb-2"><?php echo e(__('User Group')); ?>: <span class="font-weight-normal ml-2"><?php echo e(ucfirst($user->group)); ?></span></p>
									<p class="fs-12 font-weight-800 mb-2"><?php echo e(__('Current Total Available Words')); ?>: <span class="font-weight-normal ml-2"><?php echo e(number_format($user->available_words + $user->available_words_prepaid)); ?></span></p>
									<p class="fs-12 font-weight-800 mb-2"><?php echo e(__('Current Total Available Images')); ?>: <span class="font-weight-normal ml-2"><?php echo e(number_format($user->available_images + $user->available_images_prepaid)); ?></span></p>
									<p class="fs-12 font-weight-800 mb-2"><?php echo e(__('Current Total Available Characters')); ?>: <span class="font-weight-normal ml-2"><?php echo e(number_format($user->available_chars + $user->available_chars_prepaid)); ?></span></p>
									<p class="fs-12 font-weight-800 mb-2"><?php echo e(__('Current Total Available Minutes')); ?>: <span class="font-weight-normal ml-2"><?php echo e(number_format($user->available_minutes + $user->available_minutes_prepaid)); ?></span></p>
								</div>
							</div>

							<div class="col-sm-12 col-md-12 mt-3">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12 font-weight-800"><i class="fa-solid fa-scroll-old mr-2 text-info"></i><?php echo e(__('Type word quantity to add')); ?></label>
										<input type="number" class="form-control <?php $__errorArgs = ['words'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value=0 name="words">
										<?php $__errorArgs = ['words'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('words')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>									
									</div>
								</div>
							</div>

							<div class="col-sm-12 col-md-12 mt-3">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12 font-weight-800"><i class="fa-solid fa-image mr-2 text-info"></i><?php echo e(__('Type image quantity to add for AI Image feature')); ?></label>
										<input type="number" class="form-control <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value=0 name="images">
										<?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('images')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>									
									</div>
								</div>
							</div>

							<div class="col-sm-12 col-md-12 mt-3">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12 font-weight-800"><i class="fa-solid fa-image mr-2 text-info"></i><?php echo e(__('Type character quantity to add for AI Voiceover feature')); ?></label>
										<input type="number" class="form-control <?php $__errorArgs = ['chars'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value=0 name="chars">
										<?php $__errorArgs = ['chars'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('chars')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>									
									</div>
								</div>
							</div>

							<div class="col-sm-12 col-md-12 mt-3">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12 font-weight-800"><i class="fa-solid fa-image mr-2 text-info"></i><?php echo e(__('Type minutes quantity to add for AI Speech To Text feature')); ?></label>
										<input type="number" class="form-control <?php $__errorArgs = ['minutes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value=0 name="minutes">
										<?php $__errorArgs = ['minutes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('minutes')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>									
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer border-0 text-right pb-0 pr-0">							
							<a href="<?php echo e(route('admin.user.list')); ?>" class="btn btn-cancel mr-2"><?php echo e(__('Return')); ?></a>
							<button type="submit" class="btn btn-primary"><?php echo e(__('Add')); ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/admin/users/list/increase.blade.php ENDPATH**/ ?>