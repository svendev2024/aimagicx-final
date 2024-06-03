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
			<h4 class="page-title mb-0">{{ __('Notifications') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"><i class="fa-solid fa-message-exclamation mr-2 fs-12"></i>{{ __('User') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Notifications') }}</a></li>
			</ol>			
		</div>
		<div class="page-rightheader">
			<a href="{{ route('user.notifications.markAllRead') }}" class="btn btn-primary mt-1">{{ __('Mark All as Read') }}</a>
			<a href="{{ route('user.notifications.deleteAll') }}" class="btn btn-primary mt-1">{{ __('Delete All Notification') }}</a>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<!-- NOTIFICATIONS DATA TABLE -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('My Notifications') }}</h3>
				</div>
				<div class="card-body pt-2">
					<!-- SET DATATABLE -->
					<table id='notificationsTable' class='table' width='100%'>
						<thead>
							<tr>
								<th width="10%">{{ __('Type') }}</th>
								<th width="10%">{{ __('Received On') }}</th>
								<th width="10%">{{ __('User Action') }}</th>
								<th width="10%">{{ __('Sender') }}</th>
								<th width="20%">{{ __('Subject') }}</th>
								<th width="10%">{{ __('Read On') }}</th>
								<th width="5%">{{ __('Actions') }}</th>
							</tr>
						</thead>
					</table> <!-- END SET DATATABLE -->
				</div>
			</div>
		</div>
	</div>
	<!-- END NOTIFICATIONS DATA TABLE -->
@endsection

@section('js')
	<!-- Data Tables JS -->
	<script src="{{URL::asset('plugins/datatable/datatables.min.js')}}"></script>
	<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
	<script type="text/javascript">
		$(function () {	

			"use strict";
			
			// INITILIZE DATATABLE
			var table = $('#notificationsTable').DataTable({
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
				responsive: true,
				colReorder: true,
				language: {
					"emptyTable": "<div><img id='no-results-img' src='{{ URL::asset('img/files/no-notification.png') }}'><br>{{ __('There are no notifications for you yet') }}</div>",
					search: "<i class='fa fa-search search-icon'></i>",
					lengthMenu: '_MENU_ ',
					paginate : {
						first    : '<i class="fa fa-angle-double-left"></i>',
						last     : '<i class="fa fa-angle-double-right"></i>',
						previous : '<i class="fa fa-angle-left"></i>',
						next     : '<i class="fa fa-angle-right"></i>'
					}
				},
				"order": [[ 1, "desc" ]],
				pagingType : 'full_numbers',
				processing: true,
				serverSide: true,
				ajax: "{{ route('user.notifications') }}",
				columns: [{
						data: 'notification-type',
						name: 'notification-type',
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
						data: 'user-action',
						name: 'user-action',
						orderable: true,
						searchable: true
					},
					{
						data: 'sender',
						name: 'sender',
						orderable: false,
						searchable: true
					},
					{
						data: 'subject',
						name: 'subject',
						render: $.fn.dataTable.render.text(),
						orderable: true,
						searchable: true
					},
					{
						data: 'read-on',
						name: 'read-on',
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
			

			// DELETE CONFIRMATION 
			$(document).on('click', '.deleteNotificationButton', function(e) {

				e.preventDefault();

				Swal.fire({
					title: '{{__('Confirm Notification Deletion')}}',
					text: '{{__('It will permanently delete this notification')}}',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: '{{__('Delete')}}',
					reverseButtons: true,
				}).then((result) => {
					if (result.isConfirmed) {
						var formData = new FormData();
						formData.append("id", $(this).attr('id'));
						$.ajax({
							headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
							method: 'post',
							url: 'notification/delete',
							data: formData,
							processData: false,
							contentType: false,
							success: function (data) {
								if (data == 'success') {
									Swal.fire('{{__('Notification Deleted')}}', '{{__('Notification has been successfully deleted')}}', 'success');	
									$("#notificationsTable").DataTable().ajax.reload();								
								} else {
									Swal.fire('{{__('Delete Failed')}}', '{{__('There was an error while deleting this notification')}}', 'error');
								}      
							},
							error: function(data) {
								Swal.fire({ type: 'error', title: 'Oops...', text: 'Something went wrong!' })
							}
						})
					} 
				})
			});
	
		});
	</script>
@endsection