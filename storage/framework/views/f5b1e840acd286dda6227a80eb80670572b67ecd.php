

<?php $__env->startSection('css'); ?>
	<!-- Data Table CSS -->
	<link href="<?php echo e(URL::asset('plugins/datatable/datatables.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('My Referrals')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('user.dashboard')); ?>"><i class="fa-solid fa-badge-dollar mr-2 fs-12"></i><?php echo e(__('User')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('user.referral')); ?>"> <?php echo e(__('Affiliate Program')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('My Referrals')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>	
	<div class="row">
		<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-body">
					<i class="mdi mdi-account-multiple-plus text-primary fs-45 float-right"></i>	
					<p class=" mb-3 fs-12 font-weight-bold mt-1"><?php echo e(__('Total Referred Users')); ?> <span class="text-muted">(<?php echo e(__('All Time')); ?>)</span></p>
					<h2 class="mb-0"><span class="number-font-chars"><?php echo e(number_format($total_users[0]['data'])); ?></span></h2>									
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
			<div class="card border-0">
				<div class="card-body">
					<i class="mdi mdi-basket-fill text-success fs-45 float-right"></i>	
					<p class=" mb-3 fs-12 font-weight-bold mt-1"><?php echo e(__('Total Earned Commission')); ?> <span class="text-muted">(<?php echo e(__('All Time')); ?>)</span></p>
					<h2 class="mb-0"><span class="number-font-chars"><?php echo config('payment.default_system_currency_symbol'); ?><?php echo e(number_format((float)$total_commission[0]['data'], 2, '.', '')); ?></span></h2>					
									
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('Earned Commissions')); ?> <span class="text-muted">(<?php echo e(__('All Time')); ?>)</span></h3>
				</div>
				<div class="card-body pt-2">
					<!-- SET DATATABLE -->
					<table id='paymentsReferralTable' class='table' width='100%'>
						<thead>
							<tr>
								<th width="10%" class="fs-10"><?php echo e(__('Purchase Date')); ?></th>
								<th width="12%" class="fs-10"><?php echo e(__('Order ID')); ?></th>																
								<th width="10%" class="fs-10"><?php echo e(__('Total Payment')); ?> (<?php echo e(config('payment.default_system_currency')); ?>)</th>																									
								<th width="10%" class="fs-10"><?php echo e(__('Commision Rate')); ?></th>																									
								<th width="7%" class="fs-10"><?php echo e(__('Earned Commissions')); ?> (<?php echo e(config('payment.default_system_currency')); ?>)</th>
							</tr>
						</thead>
					</table> <!-- END SET DATATABLE -->
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
				ajax: "<?php echo e(route('user.referral.referrals')); ?>",
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
						data: 'custom-payment',
						name: 'custom-payment',
						orderable: true,
						searchable: true
					},	
					{
						data: 'custom-rate',
						name: 'custom-rate',
						orderable: true,
						searchable: true
					},					
					{
						data: 'custom-commission',
						name: 'custom-commission',
						orderable: true,
						searchable: true
					},				

				]
			});

		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/user/referrals/referrals/index.blade.php ENDPATH**/ ?>