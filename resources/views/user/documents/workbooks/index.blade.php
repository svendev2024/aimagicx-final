@extends('layouts.app')
@section('css')
	<!-- Data Table CSS -->
	<link href="{{URL::asset('plugins/datatable/datatables.min.css')}}" rel="stylesheet" />
	<!-- Sweet Alert CSS -->
	<link href="{{URL::asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" />	
@endsection
@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header mt-5-7">
	<div class="page-leftheader">
		<h4 class="page-title mb-0">{{ __('Workbooks') }}</h4>
		<ol class="breadcrumb mb-2">
			<li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"><i class="fa-solid fa-folder-bookmark mr-2 fs-12"></i>{{ __('User') }}</a></li>
			<li class="breadcrumb-item active" aria-current="page"><a href="{{route('user.workbooks')}}"> {{ __('Workbooks') }}</a></li>
		</ol>
	</div>
</div>
<!-- END PAGE HEADER -->
@endsection
@section('content')	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="card border-0">	
				<div class="card-header">
					<h3 class="card-title">{{ __('All My Workbooks') }}</h3>
				</div>			
				<div class="card-body pt-5">
					<div class="row">
						<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
							<div class="row">
								<div class="col-xl-7 col-lg-7 col-md-6 col-sm-12">
									<div class="form-group" id="tts-project">
										<select id="project" name="project" data-placeholder="{{ __('Select Workbook Name') }}" data-callback="changeProjectName">	
											<option value="all"> {{ __('All Workbook') }}</option>
											@foreach ($workbooks as $workbook)
												<option value="{{ $workbook->name }}" @if (strtolower(auth()->user()->workbook) == strtolower($workbook->name)) selected @endif> {{ ucfirst($workbook->name) }}</option>
											@endforeach											
										</select>
									</div>
								</div>
								<div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
									<div class="dropdown w-100">
										<button class="btn btn-special create-project mr-2" type="button" id="add-project" data-tippy-content="{{ __('Create New Workbook') }}" ><i class="fa-solid fa-rectangle-history-circle-plus"></i></button>
										<button class="btn btn-special create-project mr-2" type="button" id="default-project" data-tippy-content="{{ __('Set Default Workbook') }}"><i class="fa-solid fa-rectangle-vertical-history"></i></button>
										<button class="btn btn-special create-project" type="button" id="delete-project" data-tippy-content="{{ __('Delete Workbook') }}"><i class="fa-solid fa-folder-xmark"></i></button>												
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
				
				<div class="card-body pt-2">
					<!-- SET DATATABLE -->
					<table id='resultsTable' class='table' width='100%'>
							<thead>
								<tr>
									<th width="15%">{{ __('Document Name') }}</th> 
									<th width="9%">{{ __('Category') }}</th>
									<th width="5%">{{ __('Created On') }}</th> 
									<th width="5%">{{ __('Language') }}</th>								
									<th width="5%">{{ __('Words Used') }}</th>								           								    						           	
									<th width="5%">{{ __('Actions') }}</th>
								</tr>
							</thead>
					</table> <!-- END SET DATATABLE -->
				</div>
			</div>
		</div>
	</div>

	<!-- SET DEFAULT PROJECT MODAL -->
	<div class="modal fade" id="defaultProjectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header mb-1">
					<h4 class="modal-title" id="myModalLabel"><i class="fa-solid fa-rectangle-vertical-history"></i> {{ __('Select Default Workbook') }}</h4>
					<button type="button" class="btn-close fs-12" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('user.workbooks.update') }}" method="POST" enctype="multipart/form-data">
					@method('PUT')
					@csrf
					<div class="modal-body pb-0 pl-6 pr-6">        
						<div class="input-box">	
							<select id="set-project" name="project" data-placeholder="{{ __('Select Default Workbook') }}:">			
								@foreach ($workbooks as $workbook)
									<option value="{{ $workbook->name }}" @if (strtolower(auth()->user()->workbook) == strtolower($workbook->name)) selected @endif> {{ ucfirst($workbook->name) }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="modal-footer pr-6 pb-3 modal-footer-awselect">
						<button type="button" class="btn btn-cancel mb-4" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
						<button type="submit" class="btn btn-primary mb-4" id="new-project-button">{{ __('Save') }}</button>
					</div>
				</form>				
			</div>
		</div>
	</div>
	<!-- END SET DEFAULT PROJECT MODAL -->

	<!-- DELETE PROJECT MODAL -->
	<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header mb-1">
					<h4 class="modal-title" id="myModalLabel"><i class="fa-solid fa-folder-xmark"></i> {{ __('Delete Workbook') }}</h4>
					<button type="button" class="btn-close fs-12" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('user.workbooks.delete') }}" method="POST" enctype="multipart/form-data">
					@method('DELETE')
					@csrf
					<div class="modal-body pb-0 pl-6 pr-6">       
						<p class="text-danger mb-3 fs-12">{{ __('Warning! This will also delete all documents under selected workbook name') }}</p> 
						<div class="input-box">	
							<select id="del-project" name="project" data-placeholder="{{ __('Select Workbook to Delete') }}:">			
								@foreach ($workbooks as $workbook)
									<option value="{{ $workbook->name }}" @if (strtolower(auth()->user()->workbook) == strtolower($workbook->name)) selected @endif> {{ ucfirst($workbook->name) }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="modal-footer pr-6 pb-3 modal-footer-awselect">
						<button type="button" class="btn btn-cancel mb-4" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
						<button type="submit" class="btn btn-confirm mb-4" id="new-project-button">{{ __('Delete') }}</button>
					</div>
				</form>				
			</div>
		</div>
	</div>
	<!-- END DELETE PROJECT MODAL -->
@endsection

@section('js')
	<!-- Data Tables JS -->
	<script src="{{URL::asset('plugins/datatable/datatables.min.js')}}"></script>
	<script src="{{URL::asset('plugins/datatable/dataTables.checkboxes.min.js')}}"></script>
	<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
	<script type="text/javascript">
	var table;
		$(function () {

			"use strict";

			$('#default-project').on('click', function() {
				$('#defaultProjectModal').modal('show');
			});

			$('#delete-project').on('click', function() {
				$('#deleteProjectModal').modal('show');
			});


			table = $('#resultsTable').DataTable({
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
				responsive: true,
				colReorder: true,	
				"order": [[ 2, "desc" ]],	
				language: {
					"emptyTable": "<div><img id='no-results-img' src='{{ URL::asset('img/files/no-result.png') }}'><br>{{ __('Workbook does not contain any documents yet') }}</div>",
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
				ajax: "{{ route('user.workbooks') }}",
				columns: [
					{
						data: 'custom-title',
						name: 'custom-title',
						orderable: true,
						searchable: true
					},
					{
						data: 'custom-group',
						name: 'custom-group',
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
						data: 'custom-language',
						name: 'custom-language',
						orderable: true,
						searchable: true
					},
					{
						data: 'tokens',
						name: 'tokens',
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


			// CREATE NEW PROJECT
			$(document).on('click', '#add-project', function(e) {

				e.preventDefault();

				Swal.fire({
					title: '{{ __('Create New Workbook') }}',
					showCancelButton: true,
					confirmButtonText: 'Create',
					reverseButtons: true,
					closeOnCancel: true,
					input: 'text',
				}).then((result) => {
					if (result.value) {
						var formData = new FormData();
						formData.append("new-project", result.value);
						$.ajax({
							headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
							method: 'post',
							url: 'workbook',
							data: formData,
							processData: false,
							contentType: false,
							success: function (data) {
								if (data['status'] == 'success') {
									Swal.fire('{{ __('Workbook Created') }}', '{{ __('New workbook has been successfully created') }}', 'success');	
									location.reload();								
								} else {
									Swal.fire('{{ __('Workbook Creation Error') }}', data['message'], 'warning');
								}      
							},
							error: function(data) {
								Swal.fire({ type: 'error', title: 'Oops...', text: '{{ __('Something went wrong') }}!' })
							}
						})
					} else if (result.dismiss !== Swal.DismissReason.cancel) {
						Swal.fire('{{ __('No Workbook Name Entered') }}', '{{ __('Make sure to provide a new workbook name before creating') }}', 'warning')
					}
				})
			});


			// DELETE SYNTHESIZE RESULT
			$(document).on('click', '.deleteResultButton', function(e) {

				e.preventDefault();

				Swal.fire({
					title: '{{ __('Confirm Document Deletion') }}',
					text: '{{ __('It will permanently delete this document') }}',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: '{{ __('Delete') }}',
					reverseButtons: true,
				}).then((result) => {
					if (result.isConfirmed) {
						var formData = new FormData();
						formData.append("id", $(this).attr('id'));
						$.ajax({
							headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
							method: 'post',
							url: 'workbook/result/delete',
							data: formData,
							processData: false,
							contentType: false,
							success: function (data) {
								if (data == 'success') {
									Swal.fire('{{ __('Document Deleted') }}', '{{ __('Selected document has been successfully deleted') }}', 'success');	
									$("#resultsTable").DataTable().ajax.reload();								
								} else {
									Swal.fire('{{ __('Delete Failed') }}', '{{ __('There was an error while deleting this document') }}t', 'error');
								}      
							},
							error: function(data) {
								Swal.fire('Oops...','{{ __('Something went wrong') }}!', 'error')
							}
						})
					} 
				})
			});
		});


		// CHANGE PROJECT NAME
		function changeProjectName(value) {
			
			$.get("{{ route('user.workbooks.change') }}", { group: value}, 
				function(data){
					table = $('#resultsTable').DataTable({
						"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
						responsive: true,
						colReorder: true,
						destroy: true,
						"order": [[ 2, "desc" ]],
						language: {
							"emptyTable": "<div><img id='no-results-img' src='{{ URL::asset('img/files/no-result.png') }}'><br>{{ __('Workbook does not contain any documents yet') }}</div>",
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
						data: data['data'],
						columns: [
							{
								data: 'custom-title',
								name: 'custom-title',
								orderable: true,
								searchable: true
							},
							{
								data: 'custom-group',
								name: 'custom-group',
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
								data: 'custom-language',
								name: 'custom-language',
								orderable: true,
								searchable: true
							},
							{
								data: 'tokens',
								name: 'tokens',
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

			}).fail(function(){
				console.log("Error getting datatable results");
			});

		}
	</script>
@endsection