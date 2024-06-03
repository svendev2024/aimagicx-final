

<?php $__env->startSection('css'); ?>
	<!-- Data Table CSS -->
	<link href="<?php echo e(URL::asset('plugins/datatable/datatables.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>
 
<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Activity Monitoring')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa-solid fa-user-shield mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.user.dashboard')); ?>"> <?php echo e(__('User Management')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> <?php echo e(__('Activity Monitoring')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>						
	<div class="row">
		<div class="col-lg-12 col-md-12 col-xm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('User Activity Monitoring')); ?></h3>
				</div>				
				<div class="card-body pt-0">
					<table class="table table-hover" id="database-backup">
						<thead>
							<tr role="row">
							<th class="fs-12 font-weight-700 border-top-0"><?php echo e(__('User Email')); ?></th>
							<th class="fs-12 font-weight-700 border-top-0"><?php echo e(__('User Group')); ?></th>
							<th class="fs-12 font-weight-700 border-top-0"><?php echo e(__('IP Address')); ?></th>
							<th class="fs-12 font-weight-700 border-top-0"><?php echo e(__('Connection')); ?></th>
							<th class="fs-12 font-weight-700 border-top-0"><?php echo e(__('Last Activity')); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
							<td><?php echo e($data->email); ?></td>
							<td><span class="cell-box user-group-<?php echo e($data->group); ?>"><?php echo e(ucfirst($data->group)); ?></span></td>
							<td><?php echo e($data->ip_address); ?></td>
							<td><?php echo e($data->user_agent); ?></td>
							<td><?php echo e(\Carbon\Carbon::createFromTimestamp($data->last_activity, '+01:00')->diffForHumans()); ?></td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>			
				</div>				  
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<!-- Data Tables JS -->
	<script src="<?php echo e(URL::asset('plugins/datatable/datatables.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/admin/users/activity/index.blade.php ENDPATH**/ ?>