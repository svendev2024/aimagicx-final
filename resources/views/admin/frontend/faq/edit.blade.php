@extends('layouts.app')

@section('css')
	<!-- RichText CSS -->
	<link href="{{URL::asset('plugins/richtext/richtext.min.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('Edit FAQ Answer') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-globe mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('Frontend Management') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.settings.faq') }}"> {{ __('FAQs Manager') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Edit FAQ Answer') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<!-- SUPPORT REQUEST -->
	<div class="row">
		<div class="col-lg-8 col-md-8 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Edit FAQ Answer') }}</h3>
				</div>
				<div class="card-body pt-5">									
					<form id="" action="{{ route('admin.settings.faq.update', [$id->id]) }}" method="POST" enctype="multipart/form-data">
						@method('PUT')
						@csrf

						<div class="row mt-2">							
							<div class="col-lg-12 col-md-12 col-sm-12">							
								<div class="input-box">								
									<h6>{{ __('Question') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="text" class="form-control" id="question" name="question" value="{{ $id->question }}" required>
									</div> 
									@error('question')
										<p class="text-danger">{{ $errors->first('question') }}</p>
									@enderror	
								</div> 						
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12">							
								<div class="input-box">	
									<h6>{{ __('FAQ Status') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
			  						<select id="smtp-encryption" name="status" data-placeholder="FAQ Status:">			
										<option value="visible" @if ($id->status == 'visible') selected @endif>{{ __('Visible') }}</option>
										<option value="hidden" @if ($id->status == 'hidden') selected @endif>{{ __('Hidden') }}</option>
									</select>
								</div> 							
							</div>

						</div>

						<div class="row mt-2">
							<div class="col-lg-12 col-md-12 col-sm-12">	
								<div class="input-box">	
									<h6>{{ __('Answer') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>							
									<textarea class="form-control" name="answer" rows="12" id="richtext" required>{{ $id->answer }}</textarea>
									@error('answer')
										<p class="text-danger">{{ $errors->first('answer') }}</p>
									@enderror	
								</div>											
							</div>
						</div>

						<!-- ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<a href="{{ route('admin.settings.faq') }}" class="btn btn-cancel mr-2">{{ __('Cancel') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('Update') }}</button>							
						</div>				

					</form>					
				</div>
			</div>
		</div>
	</div>
	<!-- END SUPPORT REQUEST -->
@endsection

@section('js')
	<!-- RichText JS -->
	<script src="{{URL::asset('plugins/richtext/jquery.richtext.min.js')}}"></script>
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
				removeStyles: true,
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
				useParagraph: false,
				maxlength: 0,
				callback: undefined,
				useTabForNext: false
			});

		});
	</script>
@endsection
