@extends('layouts.app')

@section('css')
	<!-- Sweet Alert CSS -->
	<link href="{{URL::asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" />
	<!-- RichText CSS -->
	<link href="{{URL::asset('plugins/richtext/richtext.min.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('View Document') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"><i class="fa-solid fa-folder-bookmark mr-2 fs-12"></i>{{ __('User') }}</a></li>
			<li class="breadcrumb-item" aria-current="page"><a href="{{route('user.documents')}}"> {{ __('Documents') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ url('#') }}"> {{ __('View Document') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<div class="row">
		<div class="col-lg-7 col-md-12 col-sm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-body">		

					<div class="d-flex mb-3">
						<div class="w-100">
							<h3 class="card-title fs-16 mt-3 mb-4"><i class="fa-solid fa-scroll mr-4 text-info"></i>{{ __("Generated Text") }}</h3>							
						</div>	
						<div>
							<a id="export-word" class="template-button mr-1" onclick="exportWord();" href="#" data-tippy-content="{{ __('Export as Word Document') }}"><i class="fa-solid fa-file-word table-action-buttons view-action-button"></i></a>
						</div>	
						<div>
							<a id="export-pdf" class="template-button mr-1" onclick="exportPDF();" href="#" data-tippy-content="{{ __('Export as PDF Document') }}"><i class="fa-solid fa-file-pdf table-action-buttons view-action-button"></i></a>
						</div>	
						<div>
							<a id="copy-button" class="template-button mr-1" onclick="copyText();" href="#" data-tippy-content="{{ __('Copy Text') }}"><i class="fa-solid fa-copy table-action-buttons edit-action-button"></i></a>
						</div>
						<div>
							<a id="save-button" class="template-button" target="{{ $id->id }}" onclick="return saveText(this);" href="#" data-tippy-content="{{ __('Save Changes') }}"><i class="fa-solid fa-floppy-disk-pen table-action-buttons delete-action-button"></i></a>
						</div>					
					</div>

					<div class="row">						
						<div class="col-lg-6 col-md-12 col-sm-12">								
							<div class="input-box mb-2">								
								<div class="form-group">							    
									<input type="text" class="form-control @error('document') is-danger @enderror" id="document" name="document" value="{{ $id->title }}">
									@error('document')
										<p class="text-danger">{{ $errors->first('document') }}</p>
									@enderror
								</div> 
							</div> 
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12">
								<div class="form-group">
									<select id="project" name="project" data-placeholder="{{ __('Select Workbook Name') }}">	
										<option value="all"> {{ __('All Workbooks') }}</option>
										@foreach ($workbooks as $workbook)
											<option value="{{ $workbook->name }}" @if (strtolower(auth()->user()->workbook) == strtolower($workbook->name)) selected @endif> {{ ucfirst($workbook->name) }}</option>
										@endforeach											
									</select>
								</div>
							</div>
						</div>
					</div>
					<div>						
						<div id="template-textarea" class="pl-4 pr-4">						
							<div class="form-control" name="content" rows="12" id="richtext">{!! $id->result_text !!}</div>
							@error('content')
								<p class="text-danger">{{ $errors->first('content') }}</p>
							@enderror	
						</div>									
					</div>


					<!-- SAVE CHANGES ACTION BUTTON -->
					<div class="border-0 text-right mb-4 mr-4">
						<a href="{{ route('user.documents') }}" class="btn btn-primary">{{ __('Return') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
<script src="{{URL::asset('plugins/character-count/jquery-simple-txt-counter.min.js')}}"></script>
<script src="{{URL::asset('js/export.js')}}"></script>
<!-- RichText JS -->
<script src="{{URL::asset('plugins/richtext/jquery.richtext.min.js')}}"></script>
<script src="{{URL::asset('plugins/pdf/html2canvas.min.js')}}"></script>
<script src="{{URL::asset('plugins/pdf/jspdf.umd.min.js')}}"></script>
<script type="text/javascript">
	$(function () {

		"use strict";

		$('#add-project').on('click', function() {
			$('#projectModal').modal('show');
		});

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
			table: true,

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

	});

	function saveText(event) {

		let textarea = document.querySelector('.richText-editor').innerHTML;
		let title = document.getElementById('document').value;
		let workbook = document.getElementById('project').value;

		$.ajax({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			method: 'POST',
			url: '/user/templates/save',
			data: { 'id': event.target, 'text': textarea, 'title': title, 'workbook': workbook },
			success: function (data) {					
				if (data['status'] == 'success') {
					toastr.success('Changes have been successfully saved');
				} else {						
					toastr.warning('There was an issue while saving your changes');
				}
			},
			error: function(data) {
				toastr.warning('There was an issue while saving your changes');
			}
		});

		return false;	
		
	}

</script>
@endsection
