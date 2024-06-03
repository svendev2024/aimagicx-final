

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('SMTP Settings')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-sliders mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('General Settings')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('SMTP Settings')); ?></a></li>
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
					<h3 class="card-title"><?php echo e(__('Setup SMTP Settings')); ?></h3>
				</div>
				<div class="card-body">
									
					<form action="<?php echo e(route('admin.settings.smtp.store')); ?>" method="POST" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>				

						<div class="row">							
							<div class="col-12">
								<div class="input-box">								
									<h6><?php echo e(__('SMTP Host')); ?></h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['smtp-host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="smtp-host" name="smtp-host" placeholder="SMTP Host Name" value="<?php echo e(config('mail.mailers.smtp.host')); ?>" required>
										<?php $__errorArgs = ['smtp-host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('smtp-host')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 						
							</div>

							<div class="col-12">
								<div class="input-box">								
									<h6><?php echo e(__('SMTP Port')); ?></h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['smtp-port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="smtp-port" name="smtp-port" placeholder="SMTP Port Number" value="<?php echo e(config('mail.mailers.smtp.port')); ?>" required>
										<?php $__errorArgs = ['smtp-port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('smtp-port')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 						
							</div>

							<div class="col-12">
								<div class="input-box">								
									<h6><?php echo e(__('SMTP Username')); ?></h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['smtp-username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="smtp-username" name="smtp-username" placeholder="SMTP Username" value="<?php echo e(config('mail.mailers.smtp.username')); ?>" required>
										<?php $__errorArgs = ['smtp-username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('smtp-username')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 						
							</div>

							<div class="col-12">
								<div class="input-box">								
									<h6><?php echo e(__('SMTP Password')); ?></h6>
									<div class="form-group">							    
										<input type="password" class="form-control <?php $__errorArgs = ['smtp-password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="smtp-password" name="smtp-password" placeholder="SMTP Password" value="<?php echo e(config('mail.mailers.smtp.password')); ?>" required>
										<?php $__errorArgs = ['smtp-password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('smtp-password')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 						
							</div>

							<div class="col-12">
								<div class="input-box">								
									<h6><?php echo e(__('Sender Email Address')); ?></h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['smtp-from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="smtp-from" name="smtp-from" placeholder="Sender Email Address" value="<?php echo e(config('mail.from.address')); ?>" required>
										<?php $__errorArgs = ['smtp-from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('smtp-from')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 						
							</div>

							<div class="col-12">
								<div class="input-box">								
									<h6><?php echo e(__('Sender Name')); ?></h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['smtp-name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="smtp-name" name="smtp-name" placeholder="Sender Full Name" value="<?php echo e(config('mail.from.name')); ?>" required>
										<?php $__errorArgs = ['smtp-name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('smtp-name')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 						
							</div>

							<div class="col-12">							
								<div class="input-box">	
									<h6><?php echo e(__('SMTP Encryption')); ?></h6>
			  						<select id="smtp-encryption" name="smtp-encryption" data-placeholder="Select SMTP Encryption Type:">			
										<option value="tls" <?php if( config('mail.mailers.smtp.encryption')  == 'tls'): ?> selected <?php endif; ?>><?php echo e(__('TLS')); ?></option>
										<option value="ssl" <?php if( config('mail.mailers.smtp.encryption')  == 'ssl'): ?> selected <?php endif; ?>><?php echo e(__('SSL')); ?></option>
									</select>
								</div> 							
							</div>

						</div>

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<button href="#" type="button" class="btn btn-cancel mr-2" data-bs-toggle="modal" data-bs-target="#test-email"><?php echo e(__('Test')); ?></button>
							<button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>							
						</div>				

					</form>					
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="test-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
		  	<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope"></i> <?php echo e(__('Send Test Email')); ?></h4>
				  <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
				  </button>			        	
				</div>
				<form class="send-email" action="<?php echo e(route('admin.settings.smtp.test')); ?>" method="POST" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>

					<div class="modal-body pb-0 pt-0 pl-6 pr-6">

					  <!-- EMAIL ADDRESS -->
					  <div class="input-box">								
						  <h6><?php echo e(__('To Email Address')); ?></h6>
						  <div class="form-group">							    
							  <input type="text" class="form-control" class="email" name="email" id="email" placeholder="Enter Receiver's Email Address" required>
						  </div> 
					  </div> <!-- END EMAIL ADDRESS -->					  

					  <!-- SUBJECT -->
					  <div class="input-box">								
						  <h6><?php echo e(__('Email Subject')); ?></h6>
						  <div class="form-group">							    
							  <input type="text" class="form-control" class="subject" name="subject" id="subject" placeholder="Enter Subject"  required>
						  </div> 
					  </div> <!-- END SUBJECT -->

					  <!-- MESSAGE -->
					  <div class="input-box">								
						  <h6><?php echo e(__('Email Message')); ?></h6>
						  <div class="form-group">
							  <textarea class="form-control" class="message" name="message" id="message" rows="5" maxlength="500" placeholder="Enter Message" required></textarea>			
						  </div> 
					  </div> <!-- END MESSAGE -->
				   </div>

					<div class="modal-footer pr-6 pb-4">
					  <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
					  <button type="submit" class="btn btn-primary"><?php echo e(__('Send')); ?></button>
					</div>

			  	</form>
		  	</div>
		</div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/admin/settings/smtp/index.blade.php ENDPATH**/ ?>