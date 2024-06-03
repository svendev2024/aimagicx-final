

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('View Plan')); ?></h4>
			<ol class="breadcrumb mb-2">
				<ol class="breadcrumb mb-2">
					<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa-solid fa-sack-dollar mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
					<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.finance.dashboard')); ?>"> <?php echo e(__('Finance Management')); ?></a></li>
					<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.finance.plans')); ?>"> <?php echo e(__('Subscription Plans')); ?></a></li>
					<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('Plan')); ?></a></li>
				</ol>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>						
	<div class="row">
		<div class="col-lg-6 col-md-6 col-xm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('Subscription Plan Name')); ?>: <span class="text-info"><?php echo e($id->plan_name); ?></span> </h3>
				</div>
				<div class="card-body p-0">
					<table class="table" id="database-backup">
						<tbody>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Plan Name')); ?></span><span><?php echo e(ucfirst($id->plan_name)); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5"><span class="font-weight-bold"><?php echo e(__('Plan Status')); ?></span><span class="cell-box plan-<?php echo e($id->status); ?>"><?php echo e(ucfirst($id->status)); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Payment Frequency')); ?></span><span class="cell-box payment-<?php echo e($id->payment_frequency); ?>"><?php echo e(ucfirst($id->payment_frequency)); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Price')); ?></span><span><?php echo e($id->price); ?> <?php echo e($id->currency); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('OpenAI Model for Text')); ?></span><span class="font-weight-bold"><?php echo e($id->model); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Paypal Plan ID')); ?></span><span><?php echo e($id->paypal_gateway_plan_id); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Stripe Plan ID')); ?></span><span><?php echo e($id->stripe_gateway_plan_id); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Razorpay Plan ID')); ?></span><span><?php echo e($id->razorpay_gateway_plan_id); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Paystack Plan ID')); ?></span><span><?php echo e($id->paystack_gateway_plan_id); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Words Included')); ?></span><span><?php echo e(number_format($id->words)); ?> <?php echo e(__(' words')); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Images Included')); ?></span><span><?php echo e(number_format($id->images)); ?> <?php echo e(__(' images')); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Characters Included')); ?></span><span><?php echo e(number_format($id->characters)); ?> <?php echo e(__(' characters')); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Minutes Included')); ?></span><span><?php echo e(number_format($id->minutes)); ?> <?php echo e(__(' minutes')); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Total Text Result Length')); ?></span><span><?php echo e(number_format($id->max_tokens)); ?> <?php echo e(__(' tokens')); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Supported Template Package')); ?></span><?php echo e(ucfirst($id->templates)); ?></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Supported Chat Package')); ?></span><?php echo e(ucfirst($id->chats)); ?></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Team Members')); ?></span><?php echo e($id->team_members); ?></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('AI Image Feature')); ?></span><?php if($id->image_feature): ?><i class="fa-solid fa-circle-check table-info-button green fs-20"></i><?php else: ?> <i class="fa-solid fa-circle-xmark red table-info-button fs-20"></i> <?php endif; ?></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('AI Voiceover Feature')); ?></span><?php if($id->voiceover_feature): ?><i class="fa-solid fa-circle-check table-info-button green fs-20"></i><?php else: ?> <i class="fa-solid fa-circle-xmark red table-info-button fs-20"></i> <?php endif; ?></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('AI Speech to Text Feature')); ?></span><?php if($id->transcribe_feature): ?><i class="fa-solid fa-circle-check table-info-button green fs-20"></i><?php else: ?> <i class="fa-solid fa-circle-xmark red table-info-button fs-20"></i> <?php endif; ?></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('AI Chat Feature')); ?></span><?php if($id->chat_feature): ?><i class="fa-solid fa-circle-check table-info-button green fs-20"></i><?php else: ?> <i class="fa-solid fa-circle-xmark red table-info-button fs-20"></i> <?php endif; ?></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('AI Code Feature')); ?></span><?php if($id->code_feature): ?><i class="fa-solid fa-circle-check table-info-button green fs-20"></i><?php else: ?> <i class="fa-solid fa-circle-xmark red table-info-button fs-20"></i> <?php endif; ?></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Free Plan')); ?></span><?php if($id->free): ?><i class="fa-solid fa-circle-check table-info-button green fs-20"></i><?php else: ?> <i class="fa-solid fa-circle-xmark red table-info-button fs-20"></i> <?php endif; ?></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Featured Plan')); ?></span><?php if($id->featured): ?><i class="fa-solid fa-circle-check table-info-button green fs-20"></i><?php else: ?> <i class="fa-solid fa-circle-xmark red table-info-button fs-20"></i> <?php endif; ?></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Primary Heading')); ?></span><span><?php echo e(ucfirst($id->primary_heading)); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Plan Features')); ?></span><span><?php echo e(ucfirst($id->plan_features)); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Created On')); ?></span><span><?php echo e(date_format($id->created_at, 'M d, Y H:i A')); ?></span></td></tr>
							<tr><td class="justify-content-between d-flex align-items-center pl-5 pr-5 pt-4 pb-4"><span class="font-weight-bold"><?php echo e(__('Last Updated On')); ?></span><span><?php echo e(date_format($id->updated_at, 'M d, Y H:i A')); ?></span></td></tr>
						</tbody>
					</table>		

					<!-- SAVE CHANGES ACTION BUTTON -->
					<div class="border-0 text-right mb-4 mr-4">
						<a href="<?php echo e(route('admin.finance.plans')); ?>" class="btn btn-cancel mr-2"><?php echo e(__('Return')); ?></a>
						<a href="<?php echo e(route('admin.finance.plan.edit', $id)); ?>" class="btn btn-primary"><?php echo e(__('Edit Plan')); ?></a>						
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/admin/finance/plans/show.blade.php ENDPATH**/ ?>