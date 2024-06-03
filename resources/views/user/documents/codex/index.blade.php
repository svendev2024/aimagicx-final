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
		<h4 class="page-title mb-0">{{ __('All Codes') }}</h4>
		<ol class="breadcrumb mb-2">
			<li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"><i class="fa-solid fa-folder-bookmark mr-2 fs-12"></i>{{ __('User') }}</a></li>
			<li class="breadcrumb-item"><a href="{{route('user.documents')}}"> {{ __('Documents') }}</a></li>
			<li class="breadcrumb-item active"><a href="{{url('#')}}"> {{ __('All Codes') }}</a></li>
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
					<h3 class="card-title"><i class="fa-solid fa-scroll-old mr-2 text-info"></i>{{ __('All My Generated Codes') }}</h3>
				</div>			
				<div class="card-body pt-2">
					<!-- SET DATATABLE -->
					<table id='resultsTable' class='table' width='100%'>
						<thead>
							<tr>
								<th width="10%">{{ __('Code Title') }}</th>
								<th width="25%">{{ __('Instructions') }}</th> 								 
								<th width="10%">{{ __('Language') }}</th> 								 
								<th width="7%">{{ __('Created On') }}</th> 								           								    						           	
								<th width="5%">{{ __('Actions') }}</th>
							</tr>
						</thead>
				</table> <!-- END SET DATATABLE -->
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<!-- Data Tables JS -->
	<script src="{{URL::asset('plugins/datatable/datatables.min.js')}}"></script>
	<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
	<script type="text/javascript">
	var table;
		$(function () {

			"use strict";

			let table = $('#resultsTable').DataTable({
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
				responsive: true,
				colReorder: true,
				"order": [[ 3, "desc" ]],		
				language: {
					"emptyTable": "<div><img id='no-results-img' src='{{ URL::asset('img/files/no-result.png') }}'><br>{{ __('There are no saved documents yet') }}</div>",
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
				ajax: "{{ route('user.documents.codes') }}",
				columns: [
					{
						data: 'custom-title',
						name: 'custom-title',
						orderable: true,
						searchable: true
					},
					{
						data: 'instructions',
						name: 'instructions',
						orderable: true,
						searchable: true
					},
					{
						data: 'language',
						name: 'language',
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


			// DELETE SYNTHESIZE RESULT
			$(document).on('click', '.deleteResultButton', function(e) {

				e.preventDefault();

				Swal.fire({
					title: '{{ __('Confirm Code Deletion') }}',
					text: '{{ __('It will permanently delete this code') }}',
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
							url: 'result/code/delete',
							data: formData,
							processData: false,
							contentType: false,
							success: function (data) {
								if (data == 'success') {
									Swal.fire('{{ __('Code Deleted') }}', '{{ __('Selected code has been successfully deleted') }}', 'success');	
									$("#resultsTable").DataTable().ajax.reload();								
								} else {
									Swal.fire('{{ __('Delete Failed') }}', '{{ __('There was an error while deleting this code') }}t', 'error');
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
	</script>
@endsection