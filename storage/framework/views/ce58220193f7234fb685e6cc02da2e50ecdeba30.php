

<?php $__env->startSection('page-header'); ?>
	<!-- EDIT PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Activation')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-sliders mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('General Settings')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('Activation')); ?></a></li>
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
					<h3 class="card-title"><?php echo e(__('License Activation')); ?>: <?php if($notification): ?> <span class="text-success"><?php echo e(__('Activated')); ?></span> <?php else: ?> <span class="text-danger"><?php echo e(__('Not Activated')); ?></span><?php endif; ?></h3>
				</div>
				<div class="card-body">
					<form method="POST" action="<?php echo e(route('admin.settings.activation.store')); ?>" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>
						
						<div class="row">

							<div class="col-sm-12 col-md-12 mb-6">
								<div>
									<h6 class="fs-12 font-weight-bold"><?php echo e(__('Important')); ?>:</h6>
									<span class="fs-12 mb-2"><i class="mdi mdi-alert-circle mr-2 text-danger"></i><?php echo e(__('License is valid for only one installation and is strictly bounded with your domain name')); ?></span><br>
									<span class="fs-12 mb-2"><i class="mdi mdi-alert-circle mr-2 text-danger"></i><?php echo e(__('Upon change of your domain name, deactivate the license first')); ?></span><br>
									<span class="fs-12 mb-2"><i class="mdi mdi-alert-circle mr-2 text-danger"></i><?php echo e(__('Deactivation of license does not affect the integrity of your database at all')); ?></span><br>
									<span class="fs-12 mb-2"><i class="mdi mdi-alert-circle mr-2 text-danger"></i><?php echo e(__('If you will have any questions you can refer to the documentation or create a support ticket')); ?></span>
								</div>
							</div>

							<div class="col-sm-12 col-md-12">
								<div class="input-box">
									<div class="form-group">
										<label class="form-label fs-12"><?php echo e(__('Enter Activation License')); ?></label>
										<input type="text" class="form-control <?php $__errorArgs = ['license'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="license" value="<?php echo e($information['license']); ?>" required>
										<?php $__errorArgs = ['license'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('license')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>									
									</div>
								</div>
							</div>

							<div class="col-sm-12 col-md-12">
								<div class="input-box mb-1">
									<div class="form-group mb-1">
										<label class="form-label fs-12"><?php echo e(__('Enter Envato Username')); ?></label>
										<input type="text" class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="username" value="<?php echo e($information['username']); ?>" required>
										<?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('username')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>									
									</div>
								</div>
								<?php if($notification): ?> <span class="text-success fs-12"><?php echo e(__('Congratulations! Application Successfully Activated!')); ?></span> <?php else: ?> <span class="text-danger fs-12"><?php echo e(__('Application is Not Activated')); ?>.</span><?php endif; ?>
							</div>
						</div>
						<div class="card-footer border-0 text-right pb-2 pt-2 pr-0">							
							<a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-cancel mr-2"><?php echo e(__('Cancel')); ?></a>
							<?php if(!$notification): ?>
								<button type="submit" class="btn btn-primary"><?php echo e(__('Activate')); ?></button>						
							<?php else: ?>
								<a class="btn btn-primary" id="deactivateButton" data-toggle="modal" data-target="#deleteModal" href="" data-attr=<?php echo e(route("admin.settings.activation.remove")); ?>><?php echo e(__('Deactivate')); ?></a>
							<?php endif; ?>							
						</div>		
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!-- MODAL -->
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-circle-outline color-red"></i> <?php echo e(__('Confirm License Code Deletion')); ?></h4>
					<button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="deleteModalBody">
					<div>
						<!-- DELETE CONFIRMATION -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END MODAL -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script type="text/javascript">
		$(function () {

			"use strict";

			// DELETE CONFIRMATION MODAL
			$(document).on('click', '#deactivateButton', function(event) {
				event.preventDefault();
				let href = $(this).attr('data-attr');
				$.ajax({
					url: href
					, beforeSend: function() {
						$('#loader').show();
					},
					// return the result
					success: function(result) {
						$('#deleteModal').modal("show");
						$('#deleteModalBody').html(result).show();
					}
					, error: function(jqXHR, testStatus, error) {
						console.log(error);
						alert("Page " + href + " cannot open. Error:" + error);
						$('#loader').hide();
					}
					, timeout: 8000
				})
			});
	
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/admin/settings/activation/index.blade.php ENDPATH**/ ?>