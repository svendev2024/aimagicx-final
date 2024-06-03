

<?php $__env->startSection('css'); ?>
	<!-- Data Table CSS -->
	<link href="<?php echo e(URL::asset('plugins/datatable/datatables.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Referral System')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa-solid fa-sack-dollar mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.finance.dashboard')); ?>"> <?php echo e(__('Finance Management')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('Referral System')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>	
	<div class="row">
		<div class="col-lg-4 col-md-12 col-sm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-body">
					<i class="mdi mdi-account-multiple-plus text-primary fs-45 float-right"></i>	
					<p class=" mb-3 fs-12 font-weight-bold mt-1"><?php echo e(__('Total Referred Users')); ?> <span class="text-muted">(<?php echo e(__('All Time')); ?>)</span></p>
					<h2 class="mb-0"><span class="number-font-chars"><?php echo e(number_format($total_users[0]['data'])); ?></span></h2>									
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-12 col-sm-12">
			<div class="card border-0">
				<div class="card-body">
					<i class="mdi mdi-basket-fill text-success fs-45 float-right"></i>	
					<p class=" mb-3 fs-12 font-weight-bold mt-1"><?php echo e(__('Total Referral Income')); ?> <span class="text-muted">(<?php echo e(__('All Time')); ?>)</span></p>
					<h2 class="mb-0"><span class="number-font-chars"><?php echo config('payment.default_system_currency_symbol'); ?><?php echo e(number_format((float)$total_income[0]['data'], 2, '.', '')); ?></span></h2>					
									
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-12 col-sm-12">
			<div class="card border-0">
				<div class="card-body">
					<i class="mdi mdi-basket-unfill fs-45 text-danger float-right"></i>	
					<p class=" mb-3 fs-12 font-weight-bold mt-1"><?php echo e(__('Total Referral Commission')); ?> <span class="text-muted">(<?php echo e(__('All Time')); ?>)</span></p>
					<h2 class="mb-0"><span class="number-font-chars"><?php echo config('payment.default_system_currency_symbol'); ?><?php echo e(number_format((float)$total_commission[0]['data'], 2, '.', '')); ?></span></h2>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-4 col-md-12 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('Setup Referral System')); ?></h3>
				</div>
				<div class="card-body">
					
					<form action="<?php echo e(route('admin.referral.settings.store')); ?>" method="POST" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>			
						
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<h6 class="fs-12 font-weight-bold mb-4"><?php echo e(__('User Referral System')); ?></h6>
									<label class="custom-switch">
										<input type="checkbox" name="enable-referral" class="custom-switch-input" <?php if(config('payment.referral.enabled')  == 'on'): ?> checked <?php endif; ?>>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description"><?php echo e(__('Enable')); ?></span>
									</label>
								</div>
							</div>							
						</div>						

						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="mdi mdi-account-check fs-18 referral-icon mr-2"></i><?php echo e(__('New Payment Referrals')); ?></h6>

								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12">			
										<div class="input-box">	
											<h6><?php echo e(__('Referral Policy')); ?></h6>
											  <select id="payment-option" name="policy" data-placeholder="Choose Referral Policy:">			
												<option value="first" <?php if(config('payment.referral.payment.policy')  == 'first'): ?> selected <?php endif; ?>><?php echo e(__('Only the First Purchase')); ?></option>
												<option value="all" <?php if(config('payment.referral.payment.policy')  == 'all'): ?> selected <?php endif; ?>><?php echo e(__('All Purchases')); ?></option>
											</select>
										</div> 						
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12">
										<!-- SECRET ACCESS KEY -->
										<div class="input-box">								
											<h6><?php echo e(__('Commission Rate (%)')); ?></h6> 
											<div class="form-group">							    
												<input type="number" class="form-control <?php $__errorArgs = ['commission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="commission" name="commission" value="<?php echo e(config('payment.referral.payment.commission')); ?>">
											</div> 
											<?php $__errorArgs = ['commission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('commission')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> <!-- END SECRET ACCESS KEY -->
									</div>	

									<div class="col-lg-12 col-md-12 col-sm-12">
										<!-- SECRET ACCESS KEY -->
										<div class="input-box">								
											<h6><?php echo e(__('Minimum Payout Threshold')); ?> (<?php echo e(config('payment.default_system_currency')); ?>)</h6> 
											<div class="form-group">							    
												<input type="number" class="form-control <?php $__errorArgs = ['threshold'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="threshold" name="threshold" value="<?php echo e(config('payment.referral.payment.threshold')); ?>">
											</div> 
											<?php $__errorArgs = ['threshold'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('threshold')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> <!-- END SECRET ACCESS KEY -->
									</div>
									
								</div>
	
							</div>
						</div>

						<h6 class="fs-12 font-weight-bold mb-4 mt-6"><i class="mdi mdi-account-location referral-icon fs-16 mr-2"></i><?php echo e(__('Referral Guidelines for Users')); ?></h6>

						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">								
								<div class="input-box">								
									<h6><?php echo e(__('Enter Referral Action Phrase')); ?></h6>
									<textarea class="form-control" name="referral_headline" id="referral_headline" rows="2"><?php echo e($referral['referral_headline']); ?></textarea> 
									<?php $__errorArgs = ['referral_headline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<p class="text-danger"><?php echo e($errors->first('referral_headline')); ?></p>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">								
								<div class="input-box">								
									<h6><?php echo e(__('Enter Step by Step Referral Guidelines')); ?></h6>
									<textarea class="form-control" name="referral_guideline" id="referral_guideline" rows="7"><?php echo e($referral['referral_guideline']); ?></textarea> 
									<?php $__errorArgs = ['referral_guideline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<p class="text-danger"><?php echo e($errors->first('referral_guideline')); ?></p>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>
							</div>
						</div>

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<a href="<?php echo e(route('admin.finance.dashboard')); ?>" class="btn btn-cancel mr-2"><?php echo e(__('Cancel')); ?></a>
							<button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>							
						</div>				

					</form>

				</div>
			</div>

		</div>

		<div class="col-lg-8 col-md-12 col-sm-12 no-gutters">
			<div class="col-sm-12">
				<div class="card overflow-hidden border-0">
					<div class="card-header">
						<h3 class="card-title"><?php echo e(__('Payment Referrals')); ?> <span class="text-muted">(<?php echo e(__('All Time')); ?>)</span></h3>
					</div>
					<div class="card-body pt-2">
						<!-- SET DATATABLE -->
						<table id='paymentsReferralTable' class='table' width='100%'>
							<thead>
								<tr>
									<th width="10%" class="fs-10"><?php echo e(__('Purchase Date')); ?></th>
									<th width="12%" class="fs-10"><?php echo e(__('Order ID')); ?></th>									
									<th width="10%" class="fs-10"><?php echo e(__('Referrer')); ?></th>								
									<th width="10%" class="fs-10"><?php echo e(__('Payment')); ?> (<?php echo e(config('payment.default_system_currency')); ?>)</th>																									
									<th width="7%" class="fs-10"><?php echo e(__('Commission')); ?> (<?php echo e(config('payment.default_system_currency')); ?>)</th>
									<th width="7%" class="fs-10"><?php echo e(__('Paid By')); ?></th>
									<th width="5%" class="fs-10"><?php echo e(__('Actions')); ?></th>
								</tr>
							</thead>
						</table> <!-- END SET DATATABLE -->
					</div>
				</div>
			</div>
	
			<div class="col-sm-12">
				<div class="card overflow-hidden border-0">
					<div class="card-header">
						<h3 class="card-title"><?php echo e(__('Top Referrers')); ?> <span class="text-muted">(<?php echo e(__('All Time')); ?>)</span></h3>
					</div>
					<div class="card-body pt-2">
						<!-- SET DATATABLE -->
						<table id='topReferralTable' class='table' width='100%'>
							<thead>
								<tr>
									<th width="10%" class="fs-10"><?php echo e(__('Referrer Name')); ?></th>
									<th width="10%" class="fs-10"><?php echo e(__('Referrer Email')); ?></th>								
									<th width="10%" class="fs-10"><?php echo e(__('Referral ID')); ?></th>	
									<th width="5%" class="fs-10"><?php echo e(__('Group')); ?></th>								
									<th width="5%" class="fs-10"><?php echo e(__('# of Users')); ?></th>																																
									<th width="10%" class="fs-10"><?php echo e(__('Total Commissions')); ?> (<?php echo e(config('payment.default_system_currency')); ?>)</th>
								</tr>
							</thead>
						</table> <!-- END SET DATATABLE -->
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<!-- Data Tables JS -->
	<script src="<?php echo e(URL::asset('plugins/datatable/datatables.min.js')); ?>"></script>
	<script type="text/javascript">
		$(function () {

			"use strict";

			// INITILIZE DATATABLE
			var table = $('#paymentsReferralTable').DataTable({
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
				responsive: true,
				colReorder: true,
				"order": [[ 0, "desc" ]],
				language: {
					search: "<i class='fa fa-search search-icon'></i>",
					lengthMenu: '_MENU_ ',
					paginate : {
						first    : '<i class="fa fa-angle-double-left"></i>',
						last     : '<i class="fa fa-angle-double-right"></i>',
						previous : '<i class="fa fa-angle-left"></i>',
						next     : '<i class="fa fa-angle-right"></i>'
					}
				},
				pagingType : 'full_numbers',
				processing: true,
				serverSide: true,
				ajax: "<?php echo e(route('admin.referral.settings')); ?>",
				columns: [{
						data: 'created-on',
						name: 'created-on',
						orderable: true,
						searchable: true
					},
					{
						data: 'order_id',
						name: 'order_id',
						orderable: true,
						searchable: true
					},
					{
						data: 'referrer_email',
						name: 'referrer_email',
						orderable: true,
						searchable: true
					},										
					{
						data: 'custom-payment',
						name: 'custom-payment',
						orderable: true,
						searchable: true
					},						
					{
						data: 'custom-commission',
						name: 'custom-commission',
						orderable: true,
						searchable: true
					},	
					{
						data: 'gateway',
						name: 'gateway',
						orderable: true,
						searchable: true
					},			
					{
						data: 'actions',
						name: 'actions',
						orderable: false,
						searchable: false
					},
				]
			});


			// INITILIZE DATATABLE
			var table2 = $('#topReferralTable').DataTable({
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
				responsive: true,
				colReorder: true,
				"order": [[ 4, "desc" ]],
				language: {
					search: "<i class='fa fa-search search-icon'></i>",
					lengthMenu: '_MENU_ ',
					paginate : {
						first    : '<i class="fa fa-angle-double-left"></i>',
						last     : '<i class="fa fa-angle-double-right"></i>',
						previous : '<i class="fa fa-angle-left"></i>',
						next     : '<i class="fa fa-angle-right"></i>'
					}
				},
				pagingType : 'full_numbers',
				processing: true,
				serverSide: true,
				ajax: "<?php echo e(route('admin.referral.top')); ?>",
				columns: [{
						data: 'name',
						name: 'name',
						orderable: true,
						searchable: true
					},
					{
						data: 'email',
						name: 'email',
						orderable: true,
						searchable: true
					},															
					{
						data: 'referral_id',
						name: 'referral_id',
						orderable: true,
						searchable: true
					},
					{
						data: 'custom-group',
						name: 'custom-group',
						orderable: true,
						searchable: true
					},						
					{
						data: 'total_referred',
						name: 'total_referred',
						orderable: true,
						searchable: true
					},			
					{
						data: 'custom_total_commission',
						name: 'custom_total_commission',
						orderable: false,
						searchable: false
					},
				]
			});

		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/admin/finance/referrals/index.blade.php ENDPATH**/ ?>