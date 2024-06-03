

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('My Account')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('user.dashboard')); ?>"><i class="fa-solid fa-id-badge mr-2 fs-12"></i><?php echo e(__('User')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('My Account')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- USER PROFILE PAGE -->
	<div class="row">

		<div class="col-xl-3 col-lg-3 col-md-12">
			<div class="card border-0" id="dashboard-background">
				<div class="widget-user-image overflow-hidden mx-auto mt-5"><img alt="User Avatar" class="rounded-circle" src="<?php if(auth()->user()->profile_photo_path): ?><?php echo e(asset(auth()->user()->profile_photo_path)); ?> <?php else: ?> <?php echo e(URL::asset('img/users/avatar.jpg')); ?> <?php endif; ?>"></div>
				<div class="card-body text-center">
					<div>
						<h4 class="mb-1 mt-1 text-primary font-weight-bold fs-16"><?php echo e(auth()->user()->name); ?></h4>
						<h6 class="font-weight-bold fs-12"><?php echo e(auth()->user()->job_role); ?></h6>
					</div>
				</div>
				<div class="card-footer p-0">
					<div class="row">
						<div class="col-sm-12">
							<div class="text-center p-4">
								<div class="d-flex w-100">
									<div class="flex w-100">
										<div class="flex w-100">
											<h4 class="mb-3 mt-1 font-weight-800 text-primary fs-16"><?php echo e(App\Services\HelperService::userAvailableWords()); ?> / <?php echo e(App\Services\HelperService::userPlanTotalWords()); ?></h4>
											<h6 class="fs-12"><?php echo e(__('Words Left')); ?></h6>
										</div>
										<div class="flex w-100 mt-4">
											<h4 class="mb-3 mt-1 font-weight-800 text-primary fs-16"><?php echo e(App\Services\HelperService::userAvailableImages()); ?> / <?php echo e(App\Services\HelperService::userPlanTotalImages()); ?></h4>
											<h6 class="fs-12"><?php echo e(__('Images Left')); ?></h6>
										</div>
									</div>
									<div class="flex w-100">
										<div class="flex w-100">
											<h4 class="mb-3 mt-1 font-weight-800 text-primary fs-16"><?php echo e(App\Services\HelperService::userAvailableChars()); ?> / <?php echo e(App\Services\HelperService::userPlanTotalChars()); ?></h4>
											<h6 class="fs-12"><?php echo e(__('Characters Left')); ?></h6>
										</div>
										<div class="flex w-100 mt-4">
											<h4 class="mb-3 mt-1 font-weight-800 text-primary fs-16"><?php echo e(App\Services\HelperService::userAvailableMinutes()); ?> / <?php echo e(App\Services\HelperService::userPlanTotalMinutes()); ?></h4>
											<h6 class="fs-12"><?php echo e(__('Minutes Left')); ?></h6>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer p-0">
					<div class="row" id="profile-pages">
						<div class="col-sm-12">
							<div class="text-center pt-4">
								<a href="<?php echo e(route('user.profile.edit')); ?>" class="fs-13"><i class="fa fa-calendar-lines-pen mr-1"></i> <?php echo e(__('Update Profile')); ?></a>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="text-center pt-3">
								<a href="<?php echo e(route('user.profile.defaults')); ?>" class="fs-13"><i class="fa-sharp fa-solid fa-sliders mr-1"></i> <?php echo e(__('Set Defaults')); ?></a>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="text-center p-3 ">
								<a href="<?php echo e(route('user.security')); ?>" class="fs-13"><i class="fa fa-lock-hashtag mr-1"></i> <?php echo e(__('Change Password')); ?></a>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="text-center pb-3">
								<a href="<?php echo e(route('user.security.2fa')); ?>" class="fs-13"><i class="fa fa-shield-check mr-1"></i> <?php echo e(__('2FA Authentication')); ?></a>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="text-center pb-4">
								<a href="<?php echo e(route('user.profile.delete')); ?>" class="fs-13"><i class="fa fa-user-xmark mr-1"></i> <?php echo e(__('Delete Account')); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card border-0">
				<div class="card-body">
					<h4 class="card-title mb-4 mt-1"><?php echo e(__('Personal Details')); ?></h4>
					<div class="table-responsive">
						<table class="table mb-0">
							<tbody>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Full Name')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->name); ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Email')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->email); ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Referral ID')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->referral_id); ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Job Role')); ?></span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->job_role); ?></td>
								</tr>								
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Company')); ?></span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->company); ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Website')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->website); ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('City')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->city); ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Country')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->country); ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Phone')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->phone_number); ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-9 col-lg-9 col-md-12">
			<div class="row">

				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="card overflow-hidden border-0">
								<div class="card-body d-flex">
									<div class="usage-info w-100">
										<p class=" mb-3 fs-12 font-weight-bold"><?php echo e(__('Documents Created')); ?></p>
										<h2 class="mb-2 number-font fs-20"><?php echo e(number_format($data['contents'])); ?> <span class="text-muted fs-18"><?php echo e(__('documents')); ?></span></h2>
									</div>
									<div class="usage-icon text-right">
										<i class="fa-solid fa-folder-grid"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="card overflow-hidden border-0">
								<div class="card-body d-flex">
									<div class="usage-info w-100">
										<p class=" mb-3 fs-12 font-weight-bold"><?php echo e(__('Words Generated')); ?></p>
										<h2 class="mb-2 number-font fs-20"><?php echo e(number_format($data['words'])); ?> <span class="text-muted fs-18"><?php echo e(__('words')); ?></span></h2>
									</div>
									<div class="usage-icon text-right">
										<i class="fa-solid fa-scroll-old"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="card overflow-hidden border-0">
								<div class="card-body d-flex">
									<div class="usage-info w-100">
										<p class=" mb-3 fs-12 font-weight-bold"><?php echo e(__('Images Created')); ?></p>
										<h2 class="mb-2 number-font fs-20"><?php echo e(number_format($data['images'])); ?> <span class="text-muted fs-18"><?php echo e(__('images')); ?></span></h2>
									</div>
									<div class="usage-icon text-right">
										<i class="fa-solid fa-image-landscape"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="card overflow-hidden border-0">
								<div class="card-body d-flex">
									<div class="usage-info w-100">
										<p class=" mb-3 fs-12 font-weight-bold"><?php echo e(__('Voiceover Tasks')); ?></p>
										<h2 class="mb-2 number-font fs-20"><?php echo e(number_format($data['synthesized'])); ?> <span class="text-muted fs-18"><?php echo e(__('tasks')); ?></span></h2>
									</div>
									<div class="usage-icon text-right">
										<i class="fa-sharp fa-solid fa-waveform-lines"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="card overflow-hidden border-0">
								<div class="card-body d-flex">
									<div class="usage-info w-100">
										<p class=" mb-3 fs-12 font-weight-bold"><?php echo e(__('Audio Transcribed')); ?></p>
										<h2 class="mb-2 number-font fs-20"><?php echo e(number_format($data['transcribed'])); ?> <span class="text-muted fs-18"><?php echo e(__('audio files')); ?></span></h2>
									</div>
									<div class="usage-icon text-right">
										<i class="fa-sharp fa-solid fa-folder-music"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-12">
							<div class="card overflow-hidden border-0">
								<div class="card-body d-flex">
									<div class="usage-info w-100">
										<p class=" mb-3 fs-12 font-weight-bold"><?php echo e(__('Codes Generated')); ?></p>
										<h2 class="mb-2 number-font fs-20"><?php echo e(number_format($data['codes'])); ?> <span class="text-muted fs-18"><?php echo e(__('codes')); ?></span></h2>
									</div>
									<div class="usage-icon text-right">
										<i class="fa-solid fa-square-code"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="card mb-5 border-0">
						<div class="card-header d-inline border-0">
							<div>
								<h3 class="card-title fs-16 mt-3 mb-4"><i class="fa-solid fa-box-open mr-4 text-info"></i><?php echo e(__('Subscription')); ?></h3>
							</div>
							<?php if($user_subscription == ''): ?>
								<div>
									<h3 class="card-title fs-24 font-weight-800"><?php echo e(__('Free Trial')); ?></h3>
								</div>
								<div class="mb-1">
									<span class="fs-12 text-muted"><?php echo e(__('No Subscription')); ?> / <?php echo config('payment.default_system_currency_symbol'); ?>0.00 <?php echo e(__('Per Month')); ?></span>
								</div>
							<?php else: ?>
								<div>
									<h3 class="card-title fs-24 font-weight-800"><?php if($user_subscription->payment_frequency == 'monthly'): ?> <?php echo e(__('Monthly Subscription')); ?> <?php elseif($user_subscription->payment_frequency == 'yearly'): ?> <?php echo e(__('Yearly Subscription')); ?> <?php else: ?> <?php echo e(__('Lifetime Subscription')); ?> <?php endif; ?></h3>
								</div>
								<div class="mb-1">
									<span class="fs-12 text-muted"><?php echo e($user_subscription->plan_name); ?> <?php echo e(__('Plan')); ?> / <?php echo config('payment.default_system_currency_symbol'); ?><?php echo e($user_subscription->price); ?> <?php if($user_subscription->payment_frequency == 'monthly'): ?> <?php echo e(__('Per Month')); ?> <?php elseif($user_subscription->payment_frequency == 'yearly'): ?> <?php echo e(__('Per Year')); ?> <?php else: ?> <?php echo e(__('One Time Payment')); ?> <?php endif; ?></span>
								</div>
							<?php endif; ?>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<?php if($user_subscription == ''): ?>
								<span class="fs-12 text-muted"><?php echo e(__('Total words available via subscription plan')); ?> <?php echo e(number_format(auth()->user()->available_words)); ?>.</span> <span class="fs-12 text-muted"><?php echo e(__('Total prepaid words available ')); ?> <?php echo e(number_format(auth()->user()->available_words_prepaid)); ?>. </span>
								<?php else: ?>
									<span class="fs-12 text-muted"><?php echo e(__('Total words available via subscription plan')); ?> <?php echo e(number_format(auth()->user()->available_words)); ?> <?php echo e(__('out of')); ?> <?php echo e(number_format(auth()->user()->total_words)); ?>. </span> <span class="fs-12 text-muted"><?php echo e(__('Total prepaid words available')); ?> <?php echo e(number_format(auth()->user()->available_words_prepaid)); ?>. </span>
								<?php endif; ?>
							</div>
							<div class="progress mb-4">
								<div class="progress-bar progress-bar-striped progress-bar-animated bg-warning subscription-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($progress['words']); ?>%"></div>
							</div>
							<?php if($subscription): ?> 
								<div class="mb-3">
									<?php if($user_subscription->payment_frequency == 'lifetime'): ?>
										<span class="fs-12 text-muted"><?php echo e(__('Subscription renewal date')); ?>: <?php echo e(__('Never')); ?></span>
									<?php else: ?>
										<span class="fs-12 text-muted"><?php echo e(__('Subscription renewal date')); ?>: <?php echo e($subscription->active_until); ?> </span>
									<?php endif; ?>									
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="card border-0">
						<div class="card-header d-inline border-0">
							<div>
								<h3 class="card-title fs-16 mt-3 mb-4"><i class="fa-solid fa-scroll-old mr-4 text-info"></i><?php echo e(__('Words & Images Generated')); ?> <span class="text-muted">(<?php echo e(__('Current Year')); ?>)</span></h3>
							</div>
						</div>
						<div class="card-body">
							<div class="chartjs-wrapper-demo">
								<canvas id="chart-user-usage" class="h-330"></canvas>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<!-- END USER PROFILE PAGE -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<!-- Chart JS -->
	<script src="<?php echo e(URL::asset('plugins/chart/chart.min.js')); ?>"></script>
	<script>
		$(function() {
	
			'use strict';

			let usageData = JSON.parse(`<?php echo $chart_data['word_usage']; ?>`);
			let usageDataset = Object.values(usageData);
			let usageData2 = JSON.parse(`<?php echo $chart_data['image_usage']; ?>`);
			let usageDataset2 = Object.values(usageData2);
			let delayed;

			let ctx = document.getElementById('chart-user-usage');
			new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
					datasets: [{
						label: '<?php echo e(__('Images Created')); ?>',
						data: usageDataset2,
						backgroundColor: '#FF9D00',
						borderWidth: 1,
						borderRadius: 20,
						barPercentage: 0.5,
						fill: true
					},{
						label: '<?php echo e(__('Words Generated')); ?>',
						data: usageDataset,
						backgroundColor: '#007bff',
						borderWidth: 1,
						borderRadius: 20,
						barPercentage: 0.5,
						fill: true
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false,
						labels: {
							display: false
						}
					},
					responsive: true,
					animation: {
						onComplete: () => {
							delayed = true;
						},
						delay: (context) => {
							let delay = 0;
							if (context.type === 'data' && context.mode === 'default' && !delayed) {
								delay = context.dataIndex * 50 + context.datasetIndex * 5;
							}
							return delay;
						},
					},
					scales: {
						y: {
							stacked: true,
							ticks: {
								beginAtZero: true,
								font: {
									size: 10
								},
								stepSize: 50000,
							},
							grid: {
								color: '#ebecf1',
								borderDash: [3, 2]                            
							}
						},
						x: {
							stacked: true,
							ticks: {
								font: {
									size: 10
								}
							},
							grid: {
								color: '#ebecf1',
								borderDash: [3, 2]                            
							}
						},
					},
					plugins: {
						tooltip: {
							cornerRadius: 10,
							xPadding: 10,
							yPadding: 10,
							backgroundColor: '#000000',
							titleColor: '#FF9D00',
							yAlign: 'bottom',
							xAlign: 'center',
						},
						legend: {
							position: 'bottom',
							labels: {
								boxWidth: 10,
								font: {
									size: 10
								}
							}
						}
					}
					
				}
			});
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/user/profile/index.blade.php ENDPATH**/ ?>