@extends('layouts.app')

@section('css')
	<!-- Sweet Alert CSS -->
	<link href="{{URL::asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('plugins/highlight/highlight.dark.min.css')}}" rel="stylesheet" />
@endsection

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('View Code') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"><i class="fa-solid fa-folder-bookmark mr-2 fs-12"></i>{{ __('User') }}</a></li>
			<li class="breadcrumb-item" aria-current="page"><a href="{{route('user.documents')}}"> {{ __('Documents') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ url('#') }}"> {{ __('View Code') }}</a></li>
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
					<div class="row">						
						<div class="col-lg-4 col-md-12 col-sm-12">								
							<div class="input-box mb-2">								
								<div class="form-group">							    
									<input type="text" class="form-control @error('document') is-danger @enderror" id="document" name="document" value="{{ $id->title }}">
									@error('document')
										<p class="text-danger">{{ $errors->first('document') }}</p>
									@enderror
								</div> 
							</div> 
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12">
							<div class="d-flex" id="template-buttons-group">	
								<div>
									<a id="export-txt" class="template-button mr-2" onclick="exportTXT();" href="#"><i class="fa-solid fa-file-lines table-action-buttons table-action-buttons-big view-action-button" data-tippy-content="{{ __('Download as Text File') }}"></i></a>
								</div>	
								<div>
									<a id="copy-button" class="template-button mr-2" onclick="copyText();" href="#"><i class="fa-solid fa-copy table-action-buttons table-action-buttons-big edit-action-button" data-tippy-content="{{ __('Copy Code') }}"></i></a>
								</div>				
							</div>
						</div>

					</div>
					<div>						
						<div id="code">
							<pre>
								<code id="codetext">{!! $id->code !!}</code>
							</pre>						
						</div>									
					</div>

					<div class="border-0 text-right mb-4 mr-4">
						<a href="{{ route('user.documents.codes') }}" class="btn btn-primary">{{ __('Return') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
<script type="text/javascript">
	hljs.highlightAuto();

	function copyText() {
		var r = document.createRange();
		r.selectNode(document.getElementById('codetext'));
		window.getSelection().removeAllRanges();
		window.getSelection().addRange(r);
		document.execCommand('copy');
		window.getSelection().removeAllRanges();

		toastr.success('{{ __('Code has been copied successfully') }}');
	}

	function exportTXT() {
		var elHtml = document.getElementById('codetext').innerText;
		var link = document.createElement('a');
		var mimeType = 'text/plain';

		link.setAttribute('download', 'document.txt');
		link.setAttribute('href', 'data:' + mimeType  +  ';charset=utf-8,' + encodeURIComponent(elHtml));
		link.click(); 
	}

	function copyCode(e) {
		var input = document.createElement('textarea');
		input.innerHTML = $(e).parents('code').clone().text();
		document.body.appendChild(input);
		input.select();
		var result = document.execCommand('copy');
		document.body.removeChild(input);
		toastr.success('{{ __('Code has been copied successfully') }}');
	}

</script>
@endsection
