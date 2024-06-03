
<?php $__env->startSection('css'); ?>
	<!-- Sweet Alert CSS -->
	<link href="<?php echo e(URL::asset('plugins/sweetalert/sweetalert2.min.css')); ?>" rel="stylesheet" />
	<!-- RichText CSS -->
	<link href="<?php echo e(URL::asset('plugins/richtext/richtext.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<form id="openai-form" action="" method="post" enctype="multipart/form-data" class="mt-24"> 		
	<?php echo csrf_field(); ?>
	<div class="row">	
		<div class="col-lg-4 col-md-12 col-sm-12">
			<div class="card border-0" id="template-input">
				<div class="card-body p-5 pb-0">

					<div class="row">
						<div class="template-view">
							<div class="template-icon mb-2 d-flex">
								<div>
									<?php echo $template->icon; ?>

								</div>
								<div>
									<h6 class="mt-1 ml-3 fs-16 number-font"><?php echo e(__($template->name)); ?> 										
										<?php if($template->package == 'professional'): ?> 
											<span class="fs-8 btn btn-pro ml-2"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?> </span> 
										<?php elseif($template->package == 'free'): ?>
											<span class="fs-8 btn btn-free ml-2"><i class="fa-sharp fa-solid fa-gift mr-2"></i><?php echo e(__('Free')); ?> </span> 
										<?php elseif($template->package == 'premium'): ?>
											<span class="fs-8 btn btn-yellow ml-2"><i class="fa-sharp fa-solid fa-gem mr-2"></i><?php echo e(__('Premium')); ?> </span> 
										<?php elseif($template->new): ?>
											<span class="fs-8 btn btn-new ml-2"><i class="fa-sharp fa-solid fa-sparkles mr-2"></i><?php echo e(__('New')); ?></span>
										<?php endif; ?>	
									</h6>
								</div>
								<div>
									<a id="<?php echo e($template->template_code); ?>" <?php if($favorite): ?> data-tippy-content="<?php echo e(__('Remove from favorite')); ?>" <?php else: ?> data-tippy-content="<?php echo e(__('Select as favorite')); ?>" <?php endif; ?> onclick="favoriteStatus(this.id)"><i id="<?php echo e($template->template_code); ?>-icon" class="<?php if($favorite): ?> fa-solid fa-stars <?php else: ?> fa-regular fa-star <?php endif; ?> star"></i></a>
								</div>									
							</div>								
							<div class="template-info">
								<p class="fs-12 text-muted mb-4"><?php echo e(__($template->description)); ?></p>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div class="text-left mb-4" id="balance-status">
								<span class="fs-11 text-muted pl-3"><i class="fa-sharp fa-solid fa-bolt-lightning mr-2 text-primary"></i><?php echo e(__('Your Balance is')); ?> <span class="font-weight-semibold" id="balance-number"><?php echo e(number_format(auth()->user()->available_words + auth()->user()->available_words_prepaid)); ?></span> <?php echo e(__('Words')); ?></span>
							</div>							
						</div>											
						<div class="col-sm-12">
							<div class="form-group">	
								<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Language')); ?></h6>								
								<select id="language" name="language" data-placeholder="<?php echo e(__('Select input language')); ?>">		
									<?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($language->language_code); ?>" data-img="<?php echo e(URL::asset($language->language_flag)); ?>" <?php if(config('settings.default_language') == $language->language_code): ?> selected <?php endif; ?>> <?php echo e($language->language); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>									
								</select>
								<?php $__errorArgs = ['language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<p class="text-danger"><?php echo e($errors->first('language')); ?></p>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>	
							</div>
						</div>

						<?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-sm-12">								
								<div class="input-box">	
									<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__($value['name'])); ?> <?php if($value['code'] == 'keywords'): ?> <span class="text-muted font-weight-normal">(<?php echo e(__('comma seperated')); ?>)</span> <?php endif; ?> <?php if($value['required']): ?> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span> <?php endif; ?></h6>									
									<?php if($value['code'] == 'title'): ?>
										<span id="title-length" style="display:none"><?php echo e($value['length']); ?></span>
									<?php elseif($value['code'] == 'keywords'): ?>
										<span id="keywords-length" style="display:none"><?php echo e($value['length']); ?></span>
									<?php elseif($value['code'] == 'audience'): ?>
										<span id="audience-length" style="display:none"><?php echo e($value['length']); ?></span>
									<?php elseif($value['code'] == 'description'): ?>
										<span id="description-length" style="display:none"><?php echo e($value['length']); ?></span>
									<?php elseif($value['code'] == 'post'): ?>
										<span id="post-length" style="display:none"><?php echo e($value['length']); ?></span>
									<?php endif; ?>
									<div class="form-group">						  
										<?php if($value['input'] == 'input'): ?>
											<input type="text" class="form-control" id="<?php echo e($value['code']); ?>" name="<?php echo e($value['code']); ?>" placeholder="<?php echo e(__($value['placeholder'])); ?>" <?php if($value['required']): ?> required <?php endif; ?>>
										<?php else: ?>
											<?php if($value['code'] == 'keywords'): ?>
												<textarea type="text" rows=2 class="form-control" id="<?php echo e($value['code']); ?>" name="<?php echo e($value['code']); ?>" placeholder="<?php echo e(__($value['placeholder'])); ?>" <?php if($value['required']): ?> required <?php endif; ?>></textarea>
											<?php else: ?>
												<textarea type="text" rows=5 class="form-control" id="<?php echo e($value['code']); ?>" name="<?php echo e($value['code']); ?>" placeholder="<?php echo e(__($value['placeholder'])); ?>" <?php if($value['required']): ?> required <?php endif; ?>></textarea>
											<?php endif; ?>
										<?php endif; ?>  
									</div> 
								</div> 
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Creativity')); ?> <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="<?php echo e(__('Increase or decrease the creativity level to get various results')); ?>"></i></h6>
								<select id="creativity" name="creativity" data-placeholder="<?php echo e(__('Select creativity level')); ?>">
									<option value=0 <?php if(config('settings.creativity_default_state') == 'low'): ?> selected <?php endif; ?>><?php echo e(__('Low')); ?></option>
									<option value=0.5 <?php if(config('settings.creativity_default_state') == 'average'): ?> selected <?php endif; ?>> <?php echo e(__('Average')); ?></option>																															
									<option value=1 <?php if(config('settings.creativity_default_state') == 'high'): ?> selected <?php endif; ?>> <?php echo e(__('High')); ?></option>																															
								</select>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Tone of Voice')); ?> <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="<?php echo e(__('Set result tone of the text as needed')); ?>"></i></h6>
								<select id="tone" name="tone" data-placeholder="<?php echo e(__('Select tone of voice')); ?>">
									<option value="none" <?php if(config('settings.tone_default_state') == 'none'): ?> selected <?php endif; ?>><?php echo e(__('Default')); ?></option>
									<option value="funny" <?php if(config('settings.tone_default_state') == 'funny'): ?> selected <?php endif; ?>><?php echo e(__('Funny')); ?></option>
									<option value="casual" <?php if(config('settings.tone_default_state') == 'casual'): ?> selected <?php endif; ?>> <?php echo e(__('Casual')); ?></option>																															
									<option value="excited" <?php if(config('settings.tone_default_state') == 'excited'): ?> selected <?php endif; ?>> <?php echo e(__('Excited')); ?></option>																															
									<option value="professional" <?php if(config('settings.tone_default_state') == 'professional'): ?> selected <?php endif; ?>> <?php echo e(__('Professional')); ?></option>																															
									<option value="witty" <?php if(config('settings.tone_default_state') == 'witty'): ?> selected <?php endif; ?>> <?php echo e(__('Witty')); ?></option>																															
									<option value="sarcastic" <?php if(config('settings.tone_default_state') == 'sarcastic'): ?> selected <?php endif; ?>> <?php echo e(__('Sarcastic')); ?></option>																															
									<option value="feminine" <?php if(config('settings.tone_default_state') == 'feminine'): ?> selected <?php endif; ?>> <?php echo e(__('Feminine')); ?></option>																															
									<option value="masculine" <?php if(config('settings.tone_default_state') == 'masculine'): ?> selected <?php endif; ?>> <?php echo e(__('Masculine')); ?></option>																															
									<option value="bold" <?php if(config('settings.tone_default_state') == 'bold'): ?> selected <?php endif; ?>> <?php echo e(__('Bold')); ?></option>																															
									<option value="dramatic" <?php if(config('settings.tone_default_state') == 'dramatic'): ?> selected <?php endif; ?>> <?php echo e(__('Dramatic')); ?></option>																															
									<option value="grumpy" <?php if(config('settings.tone_default_state') == 'grumpy'): ?> selected <?php endif; ?>> <?php echo e(__('Grumpy')); ?></option>																															
									<option value="secretive" <?php if(config('settings.tone_default_state') == 'secretive'): ?> selected <?php endif; ?>> <?php echo e(__('Secretive')); ?></option>																															
								</select>
							</div>
						</div>

												
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div id="form-group">
								<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Number of Results')); ?> <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="<?php echo e(__('Maximum supported results is 5')); ?>"></i></h6>
								<select id="max-results" name="max_results" data-placeholder="<?php echo e(__('Set max number of results')); ?>">
									<option value=1 selected>1</option>
									<option value=2>2</option>																															
									<option value=3>3</option>																															
									<option value=4>4</option>																															
									<option value=5>5</option>																															
								</select>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12">								
							<div class="input-box">								
								<h6 class="fs-11 mb-2 font-weight-semibold"><?php echo e(__('Max Result Length')); ?> <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="<?php echo e(__('Maximum words for each generated text result')); ?>. <?php echo e(__('Maximum allowed length is ')); ?><?php echo e($limit); ?>"></i></h6>
								<div class="form-group">							    
									<input type="number" class="form-control <?php $__errorArgs = ['words'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="words" name="words" placeholder="e.g. 100" max="<?php echo e($limit); ?>" value="<?php echo e($limit); ?>">
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
					</div>						

					<div class="card-footer border-0 text-center p-0">						
						<div class="w-100 pt-2 pb-2">
							<div class="text-center">
								<span id="processing" class="processing-image"><img src="<?php echo e(URL::asset('/img/svgs/upgrade.svg')); ?>" alt=""></span>
								<button type="submit" name="submit" class="btn btn-primary  pl-7 pr-7 fs-11 pt-2 pb-2" id="generate"><?php echo e(__('Generate Text')); ?></button>
							</div>
						</div>							
					</div>	
					
					<input type="hidden" name="template" value="<?php echo e($template->template_code); ?>">
			
				</div>
			</div>			
		</div>

		<div class="col-lg-8 col-md-12 col-sm-12">
			<div class="card border-0" id="template-output">
				<div class="card-body">
					<div class="row">						
						<div class="col-lg-4 col-md-12 col-sm-12">								
							<div class="input-box mb-2">								
								<div class="form-group">							    
									<input type="text" class="form-control <?php $__errorArgs = ['document'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="document" name="document" value="<?php echo e(__('New Document')); ?>">
									<?php $__errorArgs = ['document'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<p class="text-danger"><?php echo e($errors->first('document')); ?></p>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div> 
							</div> 
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12">
							<div class="form-group">
								<select id="project" name="project" data-placeholder="<?php echo e(__('Select Workbook Name')); ?>">	
									<option value="all"> <?php echo e(__('All Workbooks')); ?></option>
									<?php $__currentLoopData = $workbooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workbook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($workbook->name); ?>" <?php if(strtolower(auth()->user()->workbook) == strtolower($workbook->name)): ?> selected <?php endif; ?>> <?php echo e(ucfirst($workbook->name)); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>											
								</select>
							</div>
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12">
							<div class="d-flex" id="template-buttons-group">	
								<div>
									<a id="export-word" class="template-button mr-2" onclick="exportWord();" href="#"><i class="fa-solid fa-file-word table-action-buttons table-action-buttons-big view-action-button" data-tippy-content="<?php echo e(__('Export as Word Document')); ?>"></i></a>
								</div>	
								<div>
									<a id="export-pdf" class="template-button mr-2" onclick="exportPDF();" href="#"><i class="fa-solid fa-file-pdf table-action-buttons table-action-buttons-big view-action-button" data-tippy-content="<?php echo e(__('Export as PDF Document')); ?>"></i></a>
								</div>	
								<div>
									<a id="export-txt" class="template-button mr-2" onclick="exportTXT();" href="#"><i class="fa-solid fa-file-lines table-action-buttons table-action-buttons-big view-action-button" data-tippy-content="<?php echo e(__('Export as Text Document')); ?>"></i></a>
								</div>	
								<div>
									<a id="copy-button" class="template-button mr-2" onclick="copyText();" href="#"><i class="fa-solid fa-copy table-action-buttons table-action-buttons-big edit-action-button" data-tippy-content="<?php echo e(__('Copy Text')); ?>"></i></a>
								</div>
								<div>
									<a id="save-button" class="template-button" onclick="return saveText(this);" href="#"><i class="fa-solid fa-floppy-disk-pen table-action-buttons table-action-buttons-big delete-action-button" data-tippy-content="<?php echo e(__('Save Document')); ?>"></i></a>
								</div>					
							</div>
						</div>

					</div>
					<div>						
						<div id="template-textarea">						
							<div class="form-control" name="content" rows="12" id="richtext"></div>
							<?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
								<p class="text-danger"><?php echo e($errors->first('content')); ?></p>
							<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>	

						</div>									
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(URL::asset('plugins/sweetalert/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/character-count/jquery-simple-txt-counter.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('js/export.js')); ?>"></script>
<!-- RichText JS -->
<script src="<?php echo e(URL::asset('plugins/richtext/jquery.richtext.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/pdf/html2canvas.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/pdf/jspdf.umd.min.js')); ?>"></script>
<script type="text/javascript">
	$(function () {

		"use strict";

		$('#richtext').richText({

			// text formatting
			bold: true,
			italic: true,
			underline: true,

			// text alignment
			leftAlign: true,
			centerAlign: true,
			rightAlign: true,
			justify: true,

			// lists
			ol: true,
			ul: true,

			// title
			heading: true,

			// fonts
			fonts: true,
			fontList: [
				"Arial", 
				"Arial Black", 
				"Comic Sans MS", 
				"Courier New", 
				"Geneva", 
				"Georgia", 
				"Helvetica", 
				"Impact", 
				"Lucida Console", 
				"Tahoma", 
				"Times New Roman",
				"Verdana"
			],
			fontColor: true,
			fontSize: true,

			// uploads
			imageUpload: false,
			fileUpload: false,

			// media
			videoEmbed: false,

			// link
			urls: true,

			// tables
			table: false,

			// code
			removeStyles: false,
			code: false,

			// colors
			colors: [],

			// dropdowns
			fileHTML: '',
			imageHTML: '',

			// translations
			translations: {
				'title': 'Title',
				'white': 'White',
				'black': 'Black',
				'brown': 'Brown',
				'beige': 'Beige',
				'darkBlue': 'Dark Blue',
				'blue': 'Blue',
				'lightBlue': 'Light Blue',
				'darkRed': 'Dark Red',
				'red': 'Red',
				'darkGreen': 'Dark Green',
				'green': 'Green',
				'purple': 'Purple',
				'darkTurquois': 'Dark Turquois',
				'turquois': 'Turquois',
				'darkOrange': 'Dark Orange',
				'orange': 'Orange',
				'yellow': 'Yellow',
				'imageURL': 'Image URL',
				'fileURL': 'File URL',
				'linkText': 'Link text',
				'url': 'URL',
				'size': 'Size',
				'responsive': 'Responsive',
				'text': 'Text',
				'openIn': 'Open in',
				'sameTab': 'Same tab',
				'newTab': 'New tab',
				'align': 'Align',
				'left': 'Left',
				'center': 'Center',
				'right': 'Right',
				'rows': 'Rows',
				'columns': 'Columns',
				'add': 'Add',
				'pleaseEnterURL': 'Please enter an URL',
				'videoURLnotSupported': 'Video URL not supported',
				'pleaseSelectImage': 'Please select an image',
				'pleaseSelectFile': 'Please select a file',
				'bold': 'Bold',
				'italic': 'Italic',
				'underline': 'Underline',
				'alignLeft': 'Align left',
				'alignCenter': 'Align centered',
				'alignRight': 'Align right',
				'addOrderedList': 'Add ordered list',
				'addUnorderedList': 'Add unordered list',
				'addHeading': 'Add Heading/title',
				'addFont': 'Add font',
				'addFontColor': 'Add font color',
				'addFontSize' : 'Add font size',
				'addImage': 'Add image',
				'addVideo': 'Add video',
				'addFile': 'Add file',
				'addURL': 'Add URL',
				'addTable': 'Add table',
				'removeStyles': 'Remove styles',
				'code': 'Show HTML code',
				'undo': 'Undo',
				'redo': 'Redo',
				'close': 'Close'
			},
					
			// privacy
			youtubeCookies: false,

			// developer settings
			useSingleQuotes: false,
			height: 0,
			heightPercentage: 0,
			id: "",
			class: "",
			useParagraph: true,
			maxlength: 0,
			callback: undefined,
			useTabForNext: false
		});

		const contentSection = document.getElementById('template-textarea');

		$(document).ready(function() {

			if (document.getElementById('title')) {
				let value = document.getElementById('title-length').innerHTML;
				$('#title').simpleTxtCounter({
					maxLength: value,
					countElem: '<div class="form-text"></div>',
					lineBreak: false,
				});
			} 

			if (document.getElementById('keywords')) {
				let value = document.getElementById('keywords-length').innerHTML;
				$('#keywords').simpleTxtCounter({
					maxLength: value,
					countElem: '<div class="form-text"></div>',
					lineBreak: false,
				});
			} 

			if (document.getElementById('audience')) {
				let value = document.getElementById('audience-length').innerHTML;
				$('#audience').simpleTxtCounter({
					maxLength: value,
					countElem: '<div class="form-text"></div>',
					lineBreak: false,
				});
			} 

			if (document.getElementById('description')) {
				let value = document.getElementById('description-length').innerHTML;
				$('#description').simpleTxtCounter({
					maxLength: value,
					countElem: '<div class="form-text"></div>',
					lineBreak: false,
				});
			} 

			if (document.getElementById('post')) {
				let value = document.getElementById('post-length').innerHTML;
				$('#post').simpleTxtCounter({
					maxLength: value,
					countElem: '<div class="form-text"></div>',
					lineBreak: false,
				});
			} 
			
		});	


		// SUBMIT FORM
		$('#openai-form').on('submit', function(e) {

			e.preventDefault();

			let form = $(this);

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'POST',
				url: 'generate',
				data: form.serialize(),
				beforeSend: function() {
					$('#generate').html('');
					$('#generate').prop('disabled', true);
					$('#processing').show().clone().appendTo('#generate'); 
					$('#processing').hide();          
				},			
				success: function (data) {	

					if (data['status'] == 'error') {
						
						Swal.fire('<?php echo e(__('Text Generation Error')); ?>', data['message'], 'warning');
						$('#generate').prop('disabled', false);
						$('#processing', '#generate').empty().remove();
						$('#processing').hide();
						$('#generate').html('<?php echo e(__('Generate Text')); ?>'); 

					} else {					
						const eventSource = new EventSource( "/user/templates/original-template/process?content_id=" + data.id+"&max_results=" + data.max_results + "&max_words=" + data.max_words + "&temperature=" + data.temperature);
						const response = document.getElementById('richtext');
						let id = document.querySelector('.richText-editor').id;
						let editor = document.getElementById(id);
						let save = document.getElementById('save-button');
						save.setAttribute('target', data['id']);

						eventSource.onmessage = function (e) {
		
							if ( e.data == '[DONE]' ) {	
								eventSource.close();
								editor.innerHTML += '<br><br>';
								$('#generate').prop('disabled', false);
								$('#processing', '#generate').empty().remove();
								$('#processing').hide();
								$('#generate').html('<?php echo e(__('Generate Text')); ?>');  
								
							} else {

								let stream = e.data
								if ( stream && stream !== '[DONE]') {
									editor.innerHTML += stream;
								}

								editor.scrollTop += 100;
							}
							
						};
						eventSource.onerror = function (e) {
							console.log(e);
						};
					}
				},
				
				error: function(data) {
					$('#generate').prop('disabled', false);
            		$('#generate').html('<?php echo e(__('Generate Text')); ?>'); 
					console.log(data)
				}
			});	
			
		});
	});

	function nl2br (str, is_xhtml) {
     	var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
     	return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
  	} 

	function favoriteStatus(id) {

		let icon, card;
		let formData = new FormData();
		formData.append("id", id);

		$.ajax({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			method: 'post',
			url: 'favorite',
			data: formData,
			processData: false,
			contentType: false,
			success: function (data) {

				if (data['status'] == 'success') {
					if (data['set']) {
						Swal.fire('<?php echo e(__('Template Removed from Favorites')); ?>', '<?php echo e(__('Selected template has been successfully removed from favorites')); ?>', 'success');
						icon = document.getElementById(id + '-icon');
						icon.classList.remove("fa-solid");
						icon.classList.remove("fa-stars");
						icon.classList.add("fa-regular");
						icon.classList.add("fa-star");			
					} else {
						Swal.fire('<?php echo e(__('Template Added to Favorites')); ?>', '<?php echo e(__('Selected template has been successfully added to favorites')); ?>', 'success');
						icon = document.getElementById(id + '-icon');
						icon.classList.remove("fa-regular");
						icon.classList.remove("fa-star");
						icon.classList.add("fa-solid");
						icon.classList.add("fa-stars");
					}
													
				} else {
					Swal.fire('<?php echo e(__('Favorite Setting Issue')); ?>', '<?php echo e(__('There as an issue with setting favorite status for this template')); ?>', 'warning');
				}      
			},
			error: function(data) {
				Swal.fire('Oops...','Something went wrong!', 'error')
			}
		})
	}

	function animateValue(id, start, end, duration) {
		if (start === end) return;
		var range = end - start;
		var current = start;
		var increment = end > start? 1 : -1;
		var stepTime = Math.abs(Math.floor(duration / range));
		var obj = document.getElementById(id);
		var timer = setInterval(function() {
			current += increment;
			obj.innerHTML = current;
			if (current == end) {
				clearInterval(timer);
			}
		}, stepTime);
	}

	function changeTemplate(value) {
		let url = '<?php echo e(url('user/templates')); ?>/' + value;
		window.location.href=url;
	}

	function saveText(event) {

		//let textarea = document.querySelector('.richText-editor').textContent;
		let textarea = document.querySelector('.richText-editor').innerHTML;
		let title = document.getElementById('document').value;
		let workbook = document.getElementById('project').value;


		if (!event.target) {
			toastr.warning('<?php echo e(__('You will need to generate AI text first before saving your changes')); ?>');
		} else {
			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'POST',
				url: '/user/templates/save',
				data: { 'id': event.target, 'text': textarea, 'title': title, 'workbook': workbook },
				success: function (data) {					
					if (data['status'] == 'success') {
						toastr.success('<?php echo e(__('Changes have been successfully saved')); ?>');
					} else {						
						toastr.warning('<?php echo e(__('There was an issue while saving your changes')); ?>');
					}
				},
				error: function(data) {
					toastr.warning('<?php echo e(__('There was an issue while saving your changes')); ?>');
				}
			});

			return false;
		}
		
	}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/user/templates/original-template.blade.php ENDPATH**/ ?>