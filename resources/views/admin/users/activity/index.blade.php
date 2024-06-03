@extends('layouts.app')

@section('css')
	<!-- Data Table CSS -->
	<link href="{{URL::asset('plugins/datatable/datatables.min.css')}}" rel="stylesheet" />
@endsection
 
@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('Activity Monitoring') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-user-shield mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.user.dashboard') }}"> {{ __('User Management') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> {{ __('Activity Monitoring') }}</a></li>
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
					<h3 class="card-title">{{ __('User Activity Monitoring') }}</h3>
				</div>				
				<div class="card-body pt-0">
					<table class="table table-hover" id="database-backup">
						<thead>
							<tr role="row">
							<th class="fs-12 font-weight-700 border-top-0">{{ __('User Email') }}</th>
							<th class="fs-12 font-weight-700 border-top-0">{{ __('User Group') }}</th>
							<th class="fs-12 font-weight-700 border-top-0">{{ __('IP Address') }}</th>
							<th class="fs-12 font-weight-700 border-top-0">{{ __('Connection') }}</th>
							<th class="fs-12 font-weight-700 border-top-0">{{ __('Last Activity') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($result as $data)
							<tr>
							<td>{{ $data->email }}</td>
							<td><span class="cell-box user-group-{{ $data->group }}">{{ ucfirst($data->group) }}</span></td>
							<td>{{ $data->ip_address }}</td>
							<td>{{ $data->user_agent }}</td>
							<td>{{ \Carbon\Carbon::createFromTimestamp($data->last_activity, '+01:00')->diffForHumans() }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>			
				</div>				  
			</div>
		</div>
	</div>
@endsection

@section('js')
	<!-- Data Tables JS -->
	<script src="{{URL::asset('plugins/datatable/datatables.min.js')}}"></script>
@endsection