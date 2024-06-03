

<?php $__env->startSection('css'); ?>
	<!-- Sweet Alert CSS -->
	<link href="<?php echo e(URL::asset('plugins/sweetalert/sweetalert2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div class="row mt-24">
		<div id="chat-search-panel">
			<h3 class="card-title mb-3 ml-2 fs-20"><i class="fa-solid fa-message-captions mr-2 text-primary"></i><?php echo e(__('AI Chat Assistants')); ?></h3>
			<h6 class="text-muted mb-3 ml-2"><?php echo e(__('Find your AI assistant quickly! Get ready to explore our fantastic lineup of AI chat assitants')); ?></h6>
			<div class="search-template">
				<div class="input-box">								
					<div class="form-group">							    
						<input type="text" class="form-control" id="search-template" placeholder="<?php echo e(__('Search for your AI assistant...')); ?>">
					</div> 
				</div> 
			</div>
		</div>
	</div>

	<div class="row" id="templates-panel">

		<?php $__currentLoopData = $favorite_chats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-lg-3 col-md-6 col-sm-12" id="<?php echo e($chat->chat_code); ?>">
				<div class="chat-boxes text-center">
					<a id="<?php echo e($chat->chat_code); ?>" <?php if($chat->favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatus(this.id)"><i id="<?php echo e($chat->chat_code); ?>-icon" class="<?php if($chat->favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
					<?php if($chat->category == 'professional'): ?> 
						<p class="fs-8 btn btn-pro"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?></p> 
					<?php elseif($chat->category == 'free'): ?>
						<p class="fs-8 btn btn-free"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?></p> 
					<?php elseif($chat->category == 'premium'): ?>
						<p class="fs-8 btn btn-yellow"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?></p> 
					<?php endif; ?>
					<div class="card <?php if($chat->category == 'professional'): ?> professional <?php elseif($chat->category == 'premium'): ?> premium <?php elseif($chat->favorite): ?> favorite <?php else: ?> border-0 <?php endif; ?>" id="<?php echo e($chat->chat_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/chats')); ?>/<?php echo e($chat->chat_code); ?>'">
						<div class="card-body pt-3">
							<div class="widget-user-image overflow-hidden mx-auto mt-3 mb-4"><img alt="User Avatar" class="rounded-circle" src="<?php echo e(URL::asset($chat->logo)); ?>"></div>
							<div class="template-title">
								<h6 class="mb-2 fs-15 number-font"><?php echo e(__($chat->name)); ?></h6>
							</div>
							<div class="template-info">
								<p class="fs-13 text-muted mb-2"><?php echo e(__($chat->sub_name)); ?></p>
							</div>							
						</div>
					</div>
				</div>							
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php $__currentLoopData = $other_chats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-lg-3 col-md-6 col-sm-12" id="<?php echo e($chat->chat_code); ?>">
				<div class="chat-boxes text-center">
					<a id="<?php echo e($chat->chat_code); ?>" <?php if($chat->favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatus(this.id)"><i id="<?php echo e($chat->chat_code); ?>-icon" class="<?php if($chat->favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
					<?php if($chat->category == 'professional'): ?> 
						<p class="fs-8 btn btn-pro"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?></p> 
					<?php elseif($chat->category == 'free'): ?>
						<p class="fs-8 btn btn-free"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?></p> 
					<?php elseif($chat->category == 'premium'): ?>
						<p class="fs-8 btn btn-yellow"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?></p> 
					<?php endif; ?>
					<div class="card <?php if($chat->category == 'professional'): ?> professional <?php elseif($chat->category == 'premium'): ?> premium <?php elseif($chat->favorite): ?> favorite <?php else: ?> border-0 <?php endif; ?>" id="<?php echo e($chat->chat_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/chats')); ?>/<?php echo e($chat->chat_code); ?>'">
						<div class="card-body pt-3">
							<div class="widget-user-image overflow-hidden mx-auto mt-3 mb-4"><img alt="User Avatar" class="rounded-circle" src="<?php echo e(URL::asset($chat->logo)); ?>"></div>
							<div class="template-title">
								<h6 class="mb-2 fs-15 number-font"><?php echo e(__($chat->name)); ?></h6>
							</div>
							<div class="template-info">
								<p class="fs-13 text-muted mb-2"><?php echo e(__($chat->sub_name)); ?></p>
							</div>							
						</div>
					</div>
				</div>							
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<script src="<?php echo e(URL::asset('plugins/sweetalert/sweetalert2.all.min.js')); ?>"></script>
	<script>
		function favoriteStatus(id) {

			let icon, card;
			let formData = new FormData();
			formData.append("id", id);

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'post',
				url: 'chat/favorite',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if (data['status'] == 'success') {
						if (data['set']) {
							Swal.fire('<?php echo e(__('Chat Bot Removed from Favorites')); ?>', '<?php echo e(__('Selected chat bot has been successfully removed from favorites')); ?>', 'success');
							icon = document.getElementById(id + '-icon');
							icon.classList.remove("fa-solid");
							icon.classList.remove("fa-stars");
							icon.classList.add("fa-regular");
							icon.classList.add("fa-star");

							card = document.getElementById(id + '-card');
							if(card.classList.contains("professional")) {
								// do nothing
							} else {
								card.classList.remove("favorite");
								card.classList.add('border-0');
							}							
						} else {
							Swal.fire('<?php echo e(__('Chat Bot Added to Favorites')); ?>', '<?php echo e(__('Selected chat bot has been successfully added to favorites')); ?>', 'success');
							icon = document.getElementById(id + '-icon');
							icon.classList.remove("fa-regular");
							icon.classList.remove("fa-star");
							icon.classList.add("fa-solid");
							icon.classList.add("fa-stars");

							card = document.getElementById(id + '-card');
							if(card.classList.contains("professional")) {
								// do nothing
							} else {
								card.classList.add('favorite');
								card.classList.remove('border-0');
							}
						}
														
					} else {
						Swal.fire('<?php echo e(__('Favorite Setting Issue')); ?>', '<?php echo e(__('There as an issue with setting favorite status for this chat bot')); ?>', 'warning');
					}      
				},
				error: function(data) {
					Swal.fire('Oops...','Something went wrong!', 'error')
				}
			})
		}

		function favoriteStatusCustom(id) {

			let icon, card;
			let formData = new FormData();
			formData.append("id", id);

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'post',
				url: 'chat/favoritecustom',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if (data['status'] == 'success') {
						if (data['set']) {
							Swal.fire('<?php echo e(__('Chat Bot Removed from Favorites')); ?>', '<?php echo e(__('Selected chat bot has been successfully removed from favorites')); ?>', 'success');
							icon = document.getElementById(id + '-icon');
							icon.classList.remove("fa-solid");
							icon.classList.remove("fa-stars");
							icon.classList.add("fa-regular");
							icon.classList.add("fa-star");

							card = document.getElementById(id + '-card');
							if(card.classList.contains("professional")) {
								// do nothing
							} else {
								card.classList.remove("favorite");
								card.classList.add('border-0');
							}							
						} else {
							Swal.fire('<?php echo e(__('Chat Bot Added to Favorites')); ?>', '<?php echo e(__('Selected chat bot has been successfully added to favorites')); ?>', 'success');
							icon = document.getElementById(id + '-icon');
							icon.classList.remove("fa-regular");
							icon.classList.remove("fa-star");
							icon.classList.add("fa-solid");
							icon.classList.add("fa-stars");

							card = document.getElementById(id + '-card');
							if(card.classList.contains("professional")) {
								// do nothing
							} else {
								card.classList.add('favorite');
								card.classList.remove('border-0');
							}
						}
														
					} else {
						Swal.fire('<?php echo e(__('Favorite Setting Issue')); ?>', '<?php echo e(__('There as an issue with setting favorite status for this chat bot')); ?>', 'warning');
					}      
				},
				error: function(data) {
					Swal.fire('Oops...','Something went wrong!', 'error')
				}
			})
		}

		function changeChat(value) {
			let url = '<?php echo e(url('user/chats')); ?>/' + value;
			window.location.href=url;
		}

		$(document).on('keyup', '#search-template', function () {

			var searchTerm = $(this).val().toLowerCase();
			$('#templates-panel').find('> div').each(function () {
				if ($(this).filter(function() {
					return (($(this).find('h6').text().toLowerCase().indexOf(searchTerm) > -1) || ($(this).find('p').text().toLowerCase().indexOf(searchTerm) > -1));
				}).length > 0 || searchTerm.length < 1) {
					$(this).show();
				} else {
					$(this).hide();
				}
			});
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/user/chat/index.blade.php ENDPATH**/ ?>