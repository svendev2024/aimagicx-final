@extends('layouts.app')
@section('css')
	<!-- Data Table CSS -->
	<link href="{{URL::asset('plugins/datatable/datatables.min.css')}}" rel="stylesheet" />
	<!-- Sweet Alert CSS -->
	<link href="{{URL::asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('plugins/photoviewer/photoviewer.min.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header mt-5-7">
	<div class="page-leftheader">
		<h4 class="page-title mb-0">{{ __('All Image') }}</h4>
		<ol class="breadcrumb mb-2">
			<li class="breadcrumb-item"><a href="{{route('user.dashboard')}}"><i class="fa-solid fa-folder-bookmark mr-2 fs-12"></i>{{ __('AI Panel') }}</a></li>
			<li class="breadcrumb-item"><a href="{{route('user.documents')}}"> {{ __('Documents') }}</a></li>
			<li class="breadcrumb-item active"><a href="{{url('#')}}"> {{ __('All Image') }}</a></li>
		</ol>
	</div>
</div>
<!-- END PAGE HEADER -->
@endsection
@section('content')
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="card border-0">
			<div class="card-header">
				<h3 class="card-title"><i class="fa-solid fa-image-landscape mr-2 text-info"></i>{{ __('All My Generated Images') }}</h3>
			</div>
			<div class="card-body">
				<!-- SET DATATABLE -->
				<table id='resultsTable' class='table' width='100%'>
					<thead>
						<tr>
							<th width="15%">{{ __('Image') }}</th> 
							<th width="5%">{{ __('Resolution') }}</th>
							<th width="5%">{{ __('Created On') }}</th> 								           								    						           	
							<th width="3%">{{ __('Actions') }}</th>
						</tr>
					</thead>
			</table> <!-- END SET DATATABLE -->	
			</div>
		</div>
	</div>
@endsection

@section('js')
<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
<script src="{{URL::asset('plugins/character-count/jquery-simple-txt-counter.min.js')}}"></script>
<script src="{{URL::asset('plugins/datatable/datatables.min.js')}}"></script>
<script src="{{URL::asset('plugins/photoviewer/photoviewer.min.js')}}"></script>
<script type="text/javascript">
	$(function () {

		"use strict";

		let table = $('#resultsTable').DataTable({
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
				responsive: true,
				colReorder: true,	
				"order": [[ 3, "desc" ]],	
				language: {
					"emptyTable": "<div><img id='no-results-img' src='{{ URL::asset('img/files/no-result.png') }}'><br>{{ __('Looks like you do not have any images created yet') }}</div>",
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
				ajax: "{{ route('user.images') }}",
				columns: [
					{
						data: 'custom-image',
						name: 'custom-image',
						orderable: true,
						searchable: true
					},
					{
						data: 'resolution',
						name: 'resolution',
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


		$(document).ready(function() {

			$('#title').simpleTxtCounter({
				maxLength: 200,
				countElem: '<div class="form-text"></div>',
				lineBreak: false,
			});

		});	


		$(document).on('click', '.file-name', function(e) {

			"use strict";

			e.preventDefault();

			var id = $(this).attr("id");

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'post',
				url: '/user/images/view',
				data:{
					id: id,
				},
				success:function(data) {   

					var items = [{src: data['url']}];

					var viewer = new PhotoViewer(items, {
						
						footerToolbar: [
							'zoomIn','zoomOut','fullscreen','actualSize',
							'customButton'
						],
						customButtons: {
							customButton: {
							text: '<i class="fas fa-cloud-download-alt" ></i>',
							title: 'Download Image',
							click: function (context, e) {
								getFile(data['url']);
							}
							}
						}

					});
				
				}

			});

		});


		// DELETE SYNTHESIZE RESULT
		$(document).on('click', '.deleteResultButton', function(e) {

			e.preventDefault();

			Swal.fire({
				title: '{{ __('Confirm Image Deletion') }}',
				text: '{{ __('It will permanently delete this image') }}',
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
						url: '/user/images/delete',
						data: formData,
						processData: false,
						contentType: false,
						success: function (data) {
							if (data['status'] == 'success') {
								Swal.fire('{{ __('Image Deleted') }}', '{{ __('Selected image has been successfully deleted') }}', 'success');	
								$("#resultsTable").DataTable().ajax.reload();								
							} else {
								Swal.fire('{{ __('Delete Failed') }}', '{{ __('There was an error while deleting this image') }}', 'error');
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

	function getFile(uri) {
		//window.open(data,'_blank');
		// window.location.href = data;
		var link = document.createElement("a");
            link.href = uri;
            link.setAttribute("download", "download");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            delete link;
		return false;
	}

</script>
@endsection