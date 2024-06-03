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
			<h4 class="page-title mb-0">{{ __('Subscribers') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-sack-dollar mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.finance.dashboard') }}"> {{ __('Finance Management') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> {{ __('Subscribers') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-xm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('All Subscribers') }}</h3>
				</div>
				<div class="card-body pt-2">
					<!-- SET DATATABLE -->
					<table id='subscriptionsTable' class='table' width='100%'>
							<thead>
								<tr>
									<th width="15%">{{ __('User') }}</th>
									<th width="10%">{{ __('Plan Name') }}</th>									
									<th width="8%">{{ __('Status') }}</th>	
									<th width="10%">{{ __('Subscribed On') }}</th>								
									<th width="10%">{{ __('Subscription ID') }}</th>
									<th width="10%">{{ __('Paid By') }}</th>																
									<th width="10%">{{ __('Words') }}</th>
									<th width="10%">{{ __('Pricing Plan') }}</th>
									<th width="10%">{{ __('Next Payment') }}</th>
									<th width="7%">{{ __('Actions') }}</th>
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
		$(function () {

			"use strict";
			
			// INITILIZE DATATABLE
			var table = $('#subscriptionsTable').DataTable({
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
				responsive: true,
				colReorder: true,
				"order": [[ 0, "desc" ]],
				language: {
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
				ajax: "{{ route('admin.finance.subscriptions') }}",
				columns: [
					{
						data: 'user',
						name: 'user',
						orderable: true,
						searchable: true
					},	
					{
						data: 'custom-plan-name',
						name: 'custom-plan-name',
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
						data: 'subscription_id',
						name: 'subscription_id',
						orderable: true,
						searchable: true
					},								
					{
						data: 'custom-gateway',
						name: 'custom-gateway',
						orderable: true,
						searchable: true
					},					
					{
						data: 'custom-words',
						name: 'custom-words',
						orderable: false,
						searchable: true
					},	
					{
						data: 'custom-frequency',
						name: 'custom-frequency',
						orderable: false,
						searchable: true
					},				
					{
						data: 'custom-until',
						name: 'custom-until',
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

			
			// DELETE TRANSACTION
			$(document).on('click', '.cancelSubscriptionButton', function(e) {

				e.preventDefault();

				Swal.fire({
					title: '{{ __('Confirm Subscription Cancellation') }}',
					text: '{{ __('It will permanently cancel this subscription') }}',
					icon: 'warning',
					confirmButtonText: '{{ __('Yes, Cancel Now') }}',
					reverseButtons: true,
				}).then((result) => {
					if (result.isConfirmed) {
						var formData = new FormData();
						formData.append("id", $(this).attr('id'));
						console.log($(this).attr('id'))
						$.ajax({
							headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
							method: 'post',
							url: 'subscriptions/cancel',
							data: formData,
							processData: false,
							contentType: false,
							success: function (data) {
								if (data['status'] == 200) {
									Swal.fire('{{ __('Subscription Cancelled') }}', data['message'], 'success');	
									$("#subscriptionsTable").DataTable().ajax.reload();								
								} else {
									Swal.fire('{{ __('Cancellation Failed') }}', '{{ __('There was an error while cancelling this subscription') }}', 'error');
								}      
							},
							error: function(data) {
								Swal.fire('Oops...','Something went wrong!', 'error')
							}
						})
					} 
				})
				});

		});
	</script>
@endsection