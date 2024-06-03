

<?php $__env->startSection('css'); ?>
	<!-- Sweet Alert CSS -->
	<link href="<?php echo e(URL::asset('plugins/sweetalert/sweetalert2.min.css')); ?>" rel="stylesheet" />
	<!-- Data Table CSS -->
	<link href="<?php echo e(URL::asset('plugins/datatable/datatables.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Team Members')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('user.dashboard')); ?>"><i class="fa-solid fa-people-arrows mr-2 fs-12"></i><?php echo e(__('User')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('Team Members')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- USER PROFILE PAGE -->
	<div class="row">

		<div class="col-lg-12 col-md-12">
			<div class="card border-0">
				<div class="card-body pt-5 pb-5">
					<div class="row pl-2">
						<div class="col-lg-4 col-md-4 col-sm-12 text-center" id="user-dashboard-background">
							<?php if(!$member): ?>
								<h6 class="fs-12"><?php echo e(__('Members')); ?></h6>
								<h4 class="mb-2 mt-2 font-weight-800 fs-40"><?php echo e($count); ?></h4>
								<h6 class="fs-12"><?php echo e(__('Manage your team members and review their credit usage')); ?></h6>
								<h6 class="fs-12"><?php echo e(__('You can add up to ')); ?> <?php if(is_null(auth()->user()->plan_id)): ?> <?php echo e(config('settings.team_members_quantity_user')); ?> <?php else: ?> <?php echo e(auth()->user()->member_limit); ?> <?php endif; ?> <?php echo e(__('team members')); ?></h6>							
								<a href="<?php echo e(route('user.team.create')); ?>" class="btn btn-primary yellow mt-2"><?php echo e(__('Add Team Member')); ?></a>
							<?php else: ?>
								<h6 class="mt-7 font-weight-800 fs-14 align-middle"><?php echo e(__('You are already a team member of ')); ?> <span class="text-primary"><?php echo e($user_name); ?></span> <?php echo e(__('team')); ?></h6>
								<a href="#" id="leaveTeam" class="btn btn-primary yellow mt-2"><?php echo e(__('Leave the Team')); ?></a>
							<?php endif; ?>							
						</div>

						<div class="col-lg-8 col-md-8 col-sm-12">
							<div class="row">
								<div class="col-lg-4 col-md-6 col-sm-12">
									<div class="card overflow-hidden user-dashboard-special-box">
										<div class="card-body d-flex">
											<div class="usage-info w-100">
												<p class=" mb-3 fs-12 font-weight-bold"><?php echo e(__('Total Words Generated')); ?></p>
												<h2 class="mb-2 number-font fs-16"><?php echo e(number_format($data['words'])); ?> <span class="text-muted fs-16"><?php echo e(__('words')); ?></span></h2>
											</div>
											<div class="usage-icon text-right">
												<i class="fa-solid fa-microchip-ai"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-12">
									<div class="card overflow-hidden user-dashboard-special-box">
										<div class="card-body d-flex">
											<div class="usage-info w-100">
												<p class=" mb-3 fs-12 font-weight-bold"><?php echo e(__('Total Images Created')); ?></p>
												<h2 class="mb-2 number-font fs-16"><?php echo e(number_format($data['images'])); ?> <span class="text-muted fs-16"><?php echo e(__('images')); ?></span></h2>
											</div>
											<div class="usage-icon text-right">
												<i class="fa-solid fa-image-landscape"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-12">
									<div class="card overflow-hidden user-dashboard-special-box">
										<div class="card-body d-flex">
											<div class="usage-info w-100">
												<p class=" mb-3 fs-12 font-weight-bold"><?php echo e(__('Total Transcribe Tasks')); ?></p>
												<h2 class="mb-2 number-font fs-16"><?php echo e(number_format($data['transcribed'])); ?> <span class="text-muted fs-16"><?php echo e(__('audio files')); ?></span></h2>
											</div>
											<div class="usage-icon text-right">
												<i class="fa-sharp fa-solid fa-folder-music"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-12">
									<div class="card overflow-hidden user-dashboard-special-box">
										<div class="card-body d-flex">
											<div class="usage-info w-100">
												<p class=" mb-3 fs-12 font-weight-bold"><?php echo e(__('Total Voiceover Chars Used')); ?></p>
												<h2 class="mb-2 number-font fs-16"><?php echo e(number_format($data['chars'])); ?> <span class="text-muted fs-16"><?php echo e(__('characters')); ?></span></h2>
											</div>
											<div class="usage-icon text-right">
												<i class="fa-sharp fa-solid fa-waveform-lines"></i>
											</div>
										</div>
									</div>
								</div>	
								<div class="col-lg-4 col-md-6 col-sm-12">
									<div class="card overflow-hidden user-dashboard-special-box">
										<div class="card-body d-flex">
											<div class="usage-info w-100">
												<p class=" mb-3 fs-12 font-weight-bold"><?php echo e(__('Total Voiceover Tasks')); ?></p>
												<h2 class="mb-2 number-font fs-16"><?php echo e(number_format($data['synthesized'])); ?> <span class="text-muted fs-16"><?php echo e(__('tasks')); ?></span></h2>
											</div>
											<div class="usage-icon text-right">
												<i class="fa-sharp fa-solid fa-microphone-lines"></i>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-12">
									<div class="card overflow-hidden user-dashboard-special-box">
										<div class="card-body d-flex">
											<div class="usage-info w-100">
												<p class=" mb-3 fs-12 font-weight-bold"><?php echo e(__('Total Documents Saved')); ?></p>
												<h2 class="mb-2 number-font fs-16"><?php echo e(number_format($data['contents'])); ?> <span class="text-muted fs-16"><?php echo e(__('contents')); ?></span></h2>
											</div>
											<div class="usage-icon text-right">
												<i class="fa-solid fa-folder-bookmark"></i>
											</div>
										</div>
									</div>
								</div>						
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('My Team Members')); ?></h3>
				</div>
				<div class="card-body pt-2">
					<!-- BOX CONTENT -->
					<div class="box-content">
						
						<!-- DATATABLE -->
						<table id='listUsersTable' class='table listUsersTable' width='100%'>
								<thead>
									<tr>	
										<th width="15%"><?php echo e(__('User')); ?></th> 										
										<th width="7%"><?php echo e(__('Words Used')); ?></th>         	        	       	    						           	     	       	    						           	        	       	    						           	     	       	    						           	
										<th width="7%"><?php echo e(__('Images Used')); ?></th>         	        	       	    						           	     	       	    						           	        	       	    						           	     	       	    						           	
										<th width="7%"><?php echo e(__('Chars Used')); ?></th>         	        	       	    						           	     	       	    						           	        	       	    						           	     	       	    						           	
										<th width="7%"><?php echo e(__('Minutes Used')); ?></th>         	        	       	    						           	     	       	    						           	        	       	    						           	     	       	    						           	   
										<th width="5%"><?php echo e(__('Status')); ?></th> 						           	
										<th width="7%"><?php echo e(__('Added On')); ?></th> 							    						           								    						           	
										<?php if(!$member): ?><th width="7%"><?php echo e(__('Actions')); ?></th> <?php endif; ?>      	      	
									</tr>
								</thead>
						</table>
						<!-- END DATATABLE -->
						
					</div> <!-- END BOX CONTENT -->
				</div>
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-xm-12 mt-5">
			<div class="card border-0">
				<div class="card-header pt-4 border-0">
					<div class="mt-3">
						<h3 class="card-title mb-2"><i class="fa-solid fa-scroll-old mr-2 text-info"></i><?php echo e(__('Word Generation')); ?> <span class="text-muted">(<?php echo e(__('Current Year')); ?>)</span></h3>
						<h6 class="text-muted"><?php echo e(__('Monitor word generation closely')); ?></h6>
					</div>
				</div>
				<div class="card-body pt-2">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="">
								<canvas id="chart-words-yearly" class="h-330"></canvas>
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
	<script src="<?php echo e(URL::asset('plugins/sweetalert/sweetalert2.all.min.js')); ?>"></script>
	<script src="<?php echo e(URL::asset('plugins/datatable/datatables.min.js')); ?>"></script>
	<script>
		$(function() {
	
			'use strict';
			<?php if(!$member): ?>
				var table = $('#listUsersTable').DataTable({
					"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
					responsive: true,
					colReorder: true,
					"order": [[ 6, "desc" ]],
					language: {
						"emptyTable": "<?php echo e(__('You did not add any team members yet')); ?>",
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
					ajax: "<?php echo e(route('user.team.list')); ?>",
					columns: [
						{
							data: 'user',
							name: 'user',
							orderable: true,
							searchable: true
						},
						{
							data: 'words-used',
							name: 'words-used',
							orderable: true,
							searchable: true
						},
						{
							data: 'images-used',
							name: 'images-used',
							orderable: true,
							searchable: true
						},
						{
							data: 'chars-used',
							name: 'chars-used',
							orderable: true,
							searchable: true
						},
						{
							data: 'minutes-used',
							name: 'minutes-used',
							orderable: true,
							searchable: true
						},								
						{
							data: 'custom-status',
							name: 'custom-status',
							orderable: true,
							searchable: true
						},
						{
							data: 'created-on',
							name: 'created-on',
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
			<?php else: ?>
				var table = $('#listUsersTable').DataTable({
					"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
					responsive: true,
					colReorder: true,
					"order": [[ 6, "desc" ]],
					language: {
						"emptyTable": "<?php echo e(__('You did not add any team members yet')); ?>",
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
					ajax: "<?php echo e(route('user.team.list')); ?>",
					columns: [
						{
							data: 'user',
							name: 'user',
							orderable: true,
							searchable: true
						},
						{
							data: 'words-used',
							name: 'words-used',
							orderable: true,
							searchable: true
						},
						{
							data: 'images-used',
							name: 'images-used',
							orderable: true,
							searchable: true
						},
						{
							data: 'chars-used',
							name: 'chars-used',
							orderable: true,
							searchable: true
						},
						{
							data: 'minutes-used',
							name: 'minutes-used',
							orderable: true,
							searchable: true
						},								
						{
							data: 'custom-status',
							name: 'custom-status',
							orderable: true,
							searchable: true
						},
						{
							data: 'created-on',
							name: 'created-on',
							orderable: true,
							searchable: true
						},
					]
				});
			<?php endif; ?>
			


			// Total New User Analysis Chart
			let usageData = JSON.parse(`<?php echo $chart_data['team_usage']; ?>`);
			let usageDataset = Object.values(usageData);
			let delayed;

			let ctx = document.getElementById('chart-words-yearly');
			new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
					datasets: [{
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
							padding: 15,
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


			// DELETE CONFIRMATION 
			$(document).on('click', '.deleteUserButton', function(e) {

				e.preventDefault();

				Swal.fire({
					title: '<?php echo e(__('Confirm Team Member Removal')); ?>',
					text: '<?php echo e(__('Warning! This action will remove this user permanently from your team')); ?>',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: '<?php echo e(__('Remove')); ?>',
					reverseButtons: true,
				}).then((result) => {
					if (result.isConfirmed) {
						var formData = new FormData();
						formData.append("id", $(this).attr('id'));
						$.ajax({
							headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
							method: 'post',
							url: 'team/delete',
							data: formData,
							processData: false,
							contentType: false,
							success: function (data) {
								if (data == 'success') {
									Swal.fire('<?php echo e(__('Team Member Removed')); ?>', '<?php echo e(__('Team member has been successfully removed')); ?>', 'success');	
									$("#listUsersTable").DataTable().ajax.reload();								
								} else {
									Swal.fire('<?php echo e(__('Removal Failed')); ?>', '<?php echo e(__('There was an error while removing this team member')); ?>', 'error');
								}      
							},
							error: function(data) {
								Swal.fire({ type: 'error', title: 'Oops...', text: '<?php echo e(__("Something went wrong")); ?>!' })
							}
						})
					} 
				})
			});


			// LEAVE CONFIRMATION 
			$(document).on('click', '#leaveTeam', function(e) {

				e.preventDefault();

				Swal.fire({
					title: '<?php echo e(__('Confirm Team Leave')); ?>',
					text: '<?php echo e(__('Warning! This action will remove you from this team permanently')); ?>',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: '<?php echo e(__('Leave')); ?>',
					reverseButtons: true,
				}).then((result) => {
					if (result.isConfirmed) {
						var formData = new FormData();
						formData.append("id", $(this).attr('id'));
						$.ajax({
							headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
							method: 'post',
							url: 'team/leave',
							data: formData,
							processData: false,
							contentType: false,
							success: function (data) {
								if (data == 'success') {
									Swal.fire('<?php echo e(__('Confirmed')); ?>', '<?php echo e(__('You are no longer part of this team')); ?>', 'success');	
									$("#listUsersTable").DataTable().ajax.reload();								
								} else {
									Swal.fire('<?php echo e(__('Leave Failed')); ?>', '<?php echo e(__('There was an error while leaving this team')); ?>', 'error');
								}      
							},
							error: function(data) {
								Swal.fire({ type: 'error', title: 'Oops...', text: '<?php echo e(__("Something went wrong")); ?>!' })
							}
						})
					} 
				})
			});

		});


	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/user/team/index.blade.php ENDPATH**/ ?>