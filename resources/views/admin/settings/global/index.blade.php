@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"> {{ __('Global Settings') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-sliders mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{url('#')}}"> {{ __('General Settings') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{url('#')}}"> {{ __('Global Settings') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection
@section('content')					
	<div class="row">
		<div class="col-lg-8 col-md-12 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Setup Global Settings') }}</h3>
				</div>
				<div class="card-body">
							
					<form action="{{ route('admin.settings.global.store') }}" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="card border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('General Settings') }}</h6>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6>{{ __('Website Name') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('site-name') is-danger @enderror" id="site-name" name="site-name" value="{{ config('app.name') }}" autocomplete="off">
												@error('site-name')
													<p class="text-danger">{{ $errors->first('site-name') }}</p>
												@enderror
											</div> 
										</div> 
									</div>	
									
									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6>{{ __('Website URL') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('site-website') is-danger @enderror" id="site-website" name="site-website" value="{{ config('app.url') }}" autocomplete="off">
												@error('site-website')
													<p class="text-danger">{{ $errors->first('site-website') }}</p>
												@enderror
											</div> 
										</div> 
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6>{{ __('Website Email Address') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('site-email') is-danger @enderror" id="site-email" name="site-email" value="{{ config('app.email') }}" autocomplete="off">
												@error('site-email')
													<p class="text-danger">{{ $errors->first('site-email') }}</p>
												@enderror
											</div> 
										</div> 
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6>{{ __('Time Zone') }}</h6>
											<select id="time-zone" name="time-zone" data-placeholder="Select Time Zone">
												<option value="Pacific/Midway" @if (config('app.timezone') == 'Pacific/Midway') selected @endif>(UTC-11:00) Midway</option>
												<option value="Pacific/Niue" @if (config('app.timezone') == 'Pacific/Niue') selected @endif>(UTC-11:00) Niue</option>
												<option value="Pacific/Pago_Pago" @if (config('app.timezone') == 'Pacific/Pago_Pago') selected @endif>(UTC-11:00) Pago Pago</option>
												<option value="America/Adak" @if (config('app.timezone') == 'America/Adak') selected @endif>(UTC-10:00) Adak</option>
												<option value="Pacific/Honolulu" @if (config('app.timezone') == 'Pacific/Honolulu') selected @endif>(UTC-10:00) Honolulu</option>
												<option value="Pacific/Johnston" @if (config('app.timezone') == 'Pacific/Johnston') selected @endif>(UTC-10:00) Johnston</option>
												<option value="Pacific/Rarotonga" @if (config('app.timezone') == 'Pacific/Rarotonga') selected @endif>(UTC-10:00) Rarotonga</option>
												<option value="Pacific/Tahiti" @if (config('app.timezone') == 'Pacific/Tahiti') selected @endif>(UTC-10:00) Tahiti</option>
												<option value="Pacific/Marquesas" @if (config('app.timezone') == 'Pacific/Marquesas') selected @endif>(UTC-09:30) Marquesas</option>
												<option value="America/Anchorage" @if (config('app.timezone') == 'America/Anchorage') selected @endif>(UTC-09:00) Anchorage</option>
												<option value="Pacific/Gambier" @if (config('app.timezone') == 'Pacific/Gambier') selected @endif>(UTC-09:00) Gambier</option>
												<option value="America/Juneau" @if (config('app.timezone') == 'America/Juneau') selected @endif>(UTC-09:00) Juneau</option>
												<option value="America/Nome" @if (config('app.timezone') == 'America/Nome') selected @endif>(UTC-09:00) Nome</option>
												<option value="America/Sitka" @if (config('app.timezone') == 'America/Sitka') selected @endif>(UTC-09:00) Sitka</option>
												<option value="America/Yakutat" @if (config('app.timezone') == 'America/Yakutat') selected @endif>(UTC-09:00) Yakutat</option>
												<option value="America/Dawson" @if (config('app.timezone') == 'America/Dawson') selected @endif>(UTC-08:00) Dawson</option>
												<option value="America/Los_Angeles" @if (config('app.timezone') == 'America/Los_Angeles') selected @endif>(UTC-08:00) Los Angeles</option>
												<option value="America/Metlakatla" @if (config('app.timezone') == 'America/Metlakatla') selected @endif>(UTC-08:00) Metlakatla</option>
												<option value="Pacific/Pitcairn" @if (config('app.timezone') == 'Pacific/Pitcairn') selected @endif>(UTC-08:00) Pitcairn</option>
												<option value="America/Santa_Isabel" @if (config('app.timezone') == 'America/Santa_Isabel') selected @endif>(UTC-08:00) Santa Isabel</option>
												<option value="America/Tijuana" @if (config('app.timezone') == 'America/Tijuana') selected @endif>(UTC-08:00) Tijuana</option>
												<option value="America/Vancouver" @if (config('app.timezone') == 'America/Vancouver') selected @endif>(UTC-08:00) Vancouver</option>
												<option value="America/Whitehorse" @if (config('app.timezone') == 'America/Whitehorse') selected @endif>(UTC-08:00) Whitehorse</option>
												<option value="America/Boise" @if (config('app.timezone') == 'America/Boise') selected @endif>(UTC-07:00) Boise</option>
												<option value="America/Cambridge_Bay" @if (config('app.timezone') == 'America/Cambridge_Bay') selected @endif>(UTC-07:00) Cambridge Bay</option>
												<option value="America/Chihuahua" @if (config('app.timezone') == 'America/Chihuahua') selected @endif>(UTC-07:00) Chihuahua</option>
												<option value="America/Creston" @if (config('app.timezone') == 'America/Creston') selected @endif>(UTC-07:00) Creston</option>
												<option value="America/Dawson_Creek" @if (config('app.timezone') == 'America/Dawson_Creek') selected @endif>(UTC-07:00) Dawson Creek</option>
												<option value="America/Denver" @if (config('app.timezone') == 'America/Denver') selected @endif>(UTC-07:00) Denver</option>
												<option value="America/Edmonton" @if (config('app.timezone') == 'America/Edmonton') selected @endif>(UTC-07:00) Edmonton</option>
												<option value="America/Hermosillo" @if (config('app.timezone') == 'America/Hermosillo') selected @endif>(UTC-07:00) Hermosillo</option>
												<option value="America/Inuvik" @if (config('app.timezone') == 'America/Inuvik') selected @endif>(UTC-07:00) Inuvik</option>
												<option value="America/Mazatlan" @if (config('app.timezone') == 'America/Mazatlan') selected @endif>(UTC-07:00) Mazatlan</option>
												<option value="America/Ojinaga" @if (config('app.timezone') == 'America/Ojinaga') selected @endif>(UTC-07:00) Ojinaga</option>
												<option value="America/Phoenix" @if (config('app.timezone') == 'America/Phoenix') selected @endif>(UTC-07:00) Phoenix</option>
												<option value="America/Shiprock" @if (config('app.timezone') == 'America/Shiprock') selected @endif>(UTC-07:00) Shiprock</option>
												<option value="America/Yellowknife" @if (config('app.timezone') == 'America/Yellowknife') selected @endif>(UTC-07:00) Yellowknife</option>
												<option value="America/Bahia_Banderas" @if (config('app.timezone') == 'America/Bahia_Banderas') selected @endif>(UTC-06:00) Bahia Banderas</option>
												<option value="America/Belize" @if (config('app.timezone') == 'America/Belize') selected @endif>(UTC-06:00) Belize</option>
												<option value="America/North_Dakota/Beulah" @if (config('app.timezone') == 'America/North_Dakota/Beulah') selected @endif>(UTC-06:00) Beulah</option>
												<option value="America/Cancun" @if (config('app.timezone') == 'America/Cancun') selected @endif>(UTC-06:00) Cancun</option>
												<option value="America/North_Dakota/Center" @if (config('app.timezone') == 'America/North_Dakota/Center') selected @endif>(UTC-06:00) Center</option>
												<option value="America/Chicago" @if (config('app.timezone') == 'America/Chicago') selected @endif>(UTC-06:00) Chicago</option>
												<option value="America/Costa_Rica" @if (config('app.timezone') == 'America/Costa_Rica') selected @endif>(UTC-06:00) Costa Rica</option>
												<option value="Pacific/Easter" @if (config('app.timezone') == 'Pacific/Easter') selected @endif>(UTC-06:00) Easter</option>
												<option value="America/El_Salvador" @if (config('app.timezone') == 'America/El_Salvador') selected @endif>(UTC-06:00) El Salvador</option>
												<option value="Pacific/Galapagos" @if (config('app.timezone') == 'Pacific/Galapagos') selected @endif>(UTC-06:00) Galapagos</option>
												<option value="America/Guatemala" @if (config('app.timezone') == 'America/Guatemala') selected @endif>(UTC-06:00) Guatemala</option>
												<option value="America/Indiana/Knox" @if (config('app.timezone') == 'America/Indiana/Knox') selected @endif>(UTC-06:00) Knox</option>
												<option value="America/Managua" @if (config('app.timezone') == 'America/Managua') selected @endif>(UTC-06:00) Managua</option>
												<option value="America/Matamoros" @if (config('app.timezone') == 'America/Matamoros') selected @endif>(UTC-06:00) Matamoros</option>
												<option value="America/Menominee" @if (config('app.timezone') == 'America/Menominee') selected @endif>(UTC-06:00) Menominee</option>
												<option value="America/Merida" @if (config('app.timezone') == 'America/Merida') selected @endif>(UTC-06:00) Merida</option>
												<option value="America/Mexico_City" @if (config('app.timezone') == 'America/Mexico_City') selected @endif>(UTC-06:00) Mexico City</option>
												<option value="America/Monterrey" @if (config('app.timezone') == 'America/Monterrey') selected @endif>(UTC-06:00) Monterrey</option>
												<option value="America/North_Dakota/New_Salem" @if (config('app.timezone') == 'America/North_Dakota/New_Salem') selected @endif>(UTC-06:00) New Salem</option>
												<option value="America/Rainy_River" @if (config('app.timezone') == 'America/Rainy_River') selected @endif>(UTC-06:00) Rainy River</option>
												<option value="America/Rankin_Inlet" @if (config('app.timezone') == 'America/Rankin_Inlet') selected @endif>(UTC-06:00) Rankin Inlet</option>
												<option value="America/Regina" @if (config('app.timezone') == 'America/Regina') selected @endif>(UTC-06:00) Regina</option>
												<option value="America/Resolute" @if (config('app.timezone') == 'America/Resolute') selected @endif>(UTC-06:00) Resolute</option>
												<option value="America/Swift_Current" @if (config('app.timezone') == 'America/Swift_Current') selected @endif>(UTC-06:00) Swift Current</option>
												<option value="America/Tegucigalpa" @if (config('app.timezone') == 'America/Tegucigalpa') selected @endif>(UTC-06:00) Tegucigalpa</option>
												<option value="America/Indiana/Tell_City" @if (config('app.timezone') == 'America/Indiana/Tell_City') selected @endif>(UTC-06:00) Tell City</option>
												<option value="America/Winnipeg" @if (config('app.timezone') == 'America/Winnipeg') selected @endif>(UTC-06:00) Winnipeg</option>
												<option value="America/Atikokan" @if (config('app.timezone') == 'America/Atikokan') selected @endif>(UTC-05:00) Atikokan</option>
												<option value="America/Bogota" @if (config('app.timezone') == 'America/Bogota') selected @endif>(UTC-05:00) Bogota</option>
												<option value="America/Cayman" @if (config('app.timezone') == 'America/Cayman') selected @endif>(UTC-05:00) Cayman</option>
												<option value="America/Detroit" @if (config('app.timezone') == 'America/Detroit') selected @endif>(UTC-05:00) Detroit</option>
												<option value="America/Grand_Turk" @if (config('app.timezone') == 'America/Grand_Turk') selected @endif>(UTC-05:00) Grand Turk</option>
												<option value="America/Guayaquil" @if (config('app.timezone') == 'America/Guayaquil') selected @endif>(UTC-05:00) Guayaquil</option>
												<option value="America/Havana" @if (config('app.timezone') == 'America/Havana') selected @endif>(UTC-05:00) Havana</option>
												<option value="America/Indiana/Indianapolis" @if (config('app.timezone') == 'America/Indiana/Indianapolis') selected @endif>(UTC-05:00) Indianapolis</option>
												<option value="America/Iqaluit" @if (config('app.timezone') == 'America/Iqaluit') selected @endif>(UTC-05:00) Iqaluit</option>
												<option value="America/Jamaica" @if (config('app.timezone') == 'America/Jamaica') selected @endif>(UTC-05:00) Jamaica</option>
												<option value="America/Lima" @if (config('app.timezone') == 'America/Lima') selected @endif>(UTC-05:00) Lima</option>
												<option value="America/Kentucky/Louisville" @if (config('app.timezone') == 'America/Kentucky/Louisville') selected @endif>(UTC-05:00) Louisville</option>
												<option value="America/Indiana/Marengo" @if (config('app.timezone') == 'America/Indiana/Marengo') selected @endif>(UTC-05:00) Marengo</option>
												<option value="America/Kentucky/Monticello" @if (config('app.timezone') == 'America/Kentucky/Monticello') selected @endif>(UTC-05:00) Monticello</option>
												<option value="America/Montreal" @if (config('app.timezone') == 'America/Montreal') selected @endif>(UTC-05:00) Montreal</option>
												<option value="America/Nassau" @if (config('app.timezone') == 'America/Nassau') selected @endif>(UTC-05:00) Nassau</option>
												<option value="America/New_York" @if (config('app.timezone') == 'America/New_York') selected @endif>(UTC-05:00) New York</option>
												<option value="America/Nipigon" @if (config('app.timezone') == 'America/Nipigon') selected @endif>(UTC-05:00) Nipigon</option>
												<option value="America/Panama" @if (config('app.timezone') == 'America/Panama') selected @endif>(UTC-05:00) Panama</option>
												<option value="America/Pangnirtung" @if (config('app.timezone') == 'America/Pangnirtung') selected @endif>(UTC-05:00) Pangnirtung</option>
												<option value="America/Indiana/Petersburg" @if (config('app.timezone') == 'America/Indiana/Petersburg') selected @endif>(UTC-05:00) Petersburg</option>
												<option value="America/Port-au-Prince" @if (config('app.timezone') == 'America/Port-au-Prince') selected @endif>(UTC-05:00) Port-au-Prince</option>
												<option value="America/Thunder_Bay" @if (config('app.timezone') == 'America/Thunder_Bay') selected @endif>(UTC-05:00) Thunder Bay</option>
												<option value="America/Toronto" @if (config('app.timezone') == 'America/Toronto') selected @endif>(UTC-05:00) Toronto</option>
												<option value="America/Indiana/Vevay" @if (config('app.timezone') == 'America/Indiana/Vevay') selected @endif>(UTC-05:00) Vevay</option>
												<option value="America/Indiana/Vincennes" @if (config('app.timezone') == 'America/Indiana/Vincennes') selected @endif>(UTC-05:00) Vincennes</option>
												<option value="America/Indiana/Winamac" @if (config('app.timezone') == 'America/Indiana/Winama') selected @endif>(UTC-05:00) Winamac</option>
												<option value="America/Caracas" @if (config('app.timezone') == 'America/Caracas') selected @endif>(UTC-04:30) Caracas</option>
												<option value="America/Anguilla" @if (config('app.timezone') == 'America/Anguilla') selected @endif>(UTC-04:00) Anguilla</option>
												<option value="America/Antigua" @if (config('app.timezone') == 'America/Antigua') selected @endif>(UTC-04:00) Antigua</option>
												<option value="America/Aruba" @if (config('app.timezone') == 'America/Aruba') selected @endif>(UTC-04:00) Aruba</option>
												<option value="America/Asuncion" @if (config('app.timezone') == 'America/Asuncion') selected @endif>(UTC-04:00) Asuncion</option>
												<option value="America/Barbados" @if (config('app.timezone') == 'America/Barbados') selected @endif>(UTC-04:00) Barbados</option>
												<option value="Atlantic/Bermuda" @if (config('app.timezone') == 'Atlantic/Bermuda') selected @endif>(UTC-04:00) Bermuda</option>
												<option value="America/Blanc-Sablon" @if (config('app.timezone') == 'America/Blanc-Sablon') selected @endif>(UTC-04:00) Blanc-Sablon</option>
												<option value="America/Boa_Vista" @if (config('app.timezone') == 'America/Boa_Vista') selected @endif>(UTC-04:00) Boa Vista</option>
												<option value="America/Campo_Grande" @if (config('app.timezone') == 'America/Campo_Grande') selected @endif>(UTC-04:00) Campo Grande</option>
												<option value="America/Cuiaba" @if (config('app.timezone') == 'America/Cuiaba') selected @endif>(UTC-04:00) Cuiaba</option>
												<option value="America/Curacao" @if (config('app.timezone') == 'America/Curacao') selected @endif>(UTC-04:00) Curacao</option>
												<option value="America/Dominica" @if (config('app.timezone') == 'America/Dominica') selected @endif>(UTC-04:00) Dominica</option>
												<option value="America/Eirunepe" @if (config('app.timezone') == 'America/Eirunepe') selected @endif>(UTC-04:00) Eirunepe</option>
												<option value="America/Glace_Bay" @if (config('app.timezone') == 'America/Glace_Bay') selected @endif>(UTC-04:00) Glace Bay</option>
												<option value="America/Goose_Bay" @if (config('app.timezone') == 'America/Goose_Bay') selected @endif>(UTC-04:00) Goose Bay</option>
												<option value="America/Grenada" @if (config('app.timezone') == 'America/Grenada') selected @endif>(UTC-04:00) Grenada</option>
												<option value="America/Guadeloupe" @if (config('app.timezone') == 'America/Guadeloupe') selected @endif>(UTC-04:00) Guadeloupe</option>
												<option value="America/Guyana" @if (config('app.timezone') == 'America/Guyana') selected @endif>(UTC-04:00) Guyana</option>
												<option value="America/Halifax" @if (config('app.timezone') == 'America/Halifax') selected @endif>(UTC-04:00) Halifax</option>
												<option value="America/Kralendijk" @if (config('app.timezone') == 'America/Kralendijk') selected @endif>(UTC-04:00) Kralendijk</option>
												<option value="America/La_Paz" @if (config('app.timezone') == 'America/La_Paz') selected @endif>(UTC-04:00) La Paz</option>
												<option value="America/Lower_Princes" @if (config('app.timezone') == 'America/Lower_Princes') selected @endif>(UTC-04:00) Lower Princes</option>
												<option value="America/Manaus" @if (config('app.timezone') == 'America/Manaus') selected @endif>(UTC-04:00) Manaus</option>
												<option value="America/Marigot" @if (config('app.timezone') == 'America/Marigot') selected @endif>(UTC-04:00) Marigot</option>
												<option value="America/Martinique" @if (config('app.timezone') == 'America/Martinique') selected @endif>(UTC-04:00) Martinique</option>
												<option value="America/Moncton" @if (config('app.timezone') == 'America/Moncton') selected @endif>(UTC-04:00) Moncton</option>
												<option value="America/Montserrat" @if (config('app.timezone') == 'America/Montserrat') selected @endif>(UTC-04:00) Montserrat</option>
												<option value="Antarctica/Palmer" @if (config('app.timezone') == 'Antarctica/Palmer') selected @endif>(UTC-04:00) Palmer</option>
												<option value="America/Port_of_Spain" @if (config('app.timezone') == 'America/Port_of_Spain') selected @endif>(UTC-04:00) Port of Spain</option>
												<option value="America/Porto_Velho" @if (config('app.timezone') == 'America/Porto_Velho') selected @endif>(UTC-04:00) Porto Velho</option>
												<option value="America/Puerto_Rico" @if (config('app.timezone') == 'America/Puerto_Rico') selected @endif>(UTC-04:00) Puerto Rico</option>
												<option value="America/Rio_Branco" @if (config('app.timezone') == 'America/Rio_Branco') selected @endif>(UTC-04:00) Rio Branco</option>
												<option value="America/Santiago" @if (config('app.timezone') == 'America/Santiago') selected @endif>(UTC-04:00) Santiago</option>
												<option value="America/Santo_Domingo" @if (config('app.timezone') == 'America/Santo_Domingo') selected @endif>(UTC-04:00) Santo Domingo</option>
												<option value="America/St_Barthelemy" @if (config('app.timezone') == 'America/St_Barthelemy') selected @endif>(UTC-04:00) St. Barthelemy</option>
												<option value="America/St_Kitts" @if (config('app.timezone') == 'America/St_Kitts') selected @endif>(UTC-04:00) St. Kitts</option>
												<option value="America/St_Lucia" @if (config('app.timezone') == 'America/St_Lucia') selected @endif>(UTC-04:00) St. Lucia</option>
												<option value="America/St_Thomas" @if (config('app.timezone') == 'America/St_Thomas') selected @endif>(UTC-04:00) St. Thomas</option>
												<option value="America/St_Vincent" @if (config('app.timezone') == 'America/St_Vincent') selected @endif>(UTC-04:00) St. Vincent</option>
												<option value="America/Thule" @if (config('app.timezone') == 'America/Thule') selected @endif>(UTC-04:00) Thule</option>
												<option value="America/Tortola" @if (config('app.timezone') == 'America/Tortola') selected @endif>(UTC-04:00) Tortola</option>
												<option value="America/St_Johns" @if (config('app.timezone') == 'America/St_Johns') selected @endif>(UTC-03:30) St. Johns</option>
												<option value="America/Araguaina" @if (config('app.timezone') == 'America/Araguaina') selected @endif>(UTC-03:00) Araguaina</option>
												<option value="America/Bahia" @if (config('app.timezone') == 'America/Bahia') selected @endif>(UTC-03:00) Bahia</option>
												<option value="America/Belem" @if (config('app.timezone') == 'America/Belem') selected @endif>(UTC-03:00) Belem</option>
												<option value="America/Argentina/Buenos_Aires" @if (config('app.timezone') == 'America/Argentina/Buenos_Aires') selected @endif>(UTC-03:00) Buenos Aires</option>
												<option value="America/Argentina/Catamarca" @if (config('app.timezone') == 'America/Argentina/Catamarca') selected @endif>(UTC-03:00) Catamarca</option>
												<option value="America/Cayenne" @if (config('app.timezone') == 'America/Cayenne') selected @endif>(UTC-03:00) Cayenne</option>
												<option value="America/Argentina/Cordoba" @if (config('app.timezone') == 'America/Argentina/Cordoba') selected @endif>(UTC-03:00) Cordoba</option>
												<option value="America/Fortaleza" @if (config('app.timezone') == 'America/Fortaleza') selected @endif>(UTC-03:00) Fortaleza</option>
												<option value="America/Godthab" @if (config('app.timezone') == 'America/Godthab') selected @endif>(UTC-03:00) Godthab</option>
												<option value="America/Argentina/Jujuy" @if (config('app.timezone') == 'America/Argentina/Jujuy') selected @endif>(UTC-03:00) Jujuy</option>
												<option value="America/Argentina/La_Rioja" @if (config('app.timezone') == 'America/Argentina/La_Rioja') selected @endif>(UTC-03:00) La Rioja</option>
												<option value="America/Maceio" @if (config('app.timezone') == 'America/Maceio') selected @endif>(UTC-03:00) Maceio</option>
												<option value="America/Argentina/Mendoza" @if (config('app.timezone') == 'America/Argentina/Mendoza') selected @endif>(UTC-03:00) Mendoza</option>
												<option value="America/Miquelon" @if (config('app.timezone') == 'America/Miquelon') selected @endif>(UTC-03:00) Miquelon</option>
												<option value="America/Montevideo" @if (config('app.timezone') == 'America/Montevideo') selected @endif>(UTC-03:00) Montevideo</option>
												<option value="America/Paramaribo" @if (config('app.timezone') == 'America/Paramaribo') selected @endif>(UTC-03:00) Paramaribo</option>
												<option value="America/Recife" @if (config('app.timezone') == 'America/Recife') selected @endif>(UTC-03:00) Recife</option>
												<option value="America/Argentina/Rio_Gallegos" @if (config('app.timezone') == 'America/Argentina/Rio_Gallegos') selected @endif>(UTC-03:00) Rio Gallegos</option>
												<option value="Antarctica/Rothera" @if (config('app.timezone') == 'Antarctica/Rothera') selected @endif>(UTC-03:00) Rothera</option>
												<option value="America/Argentina/Salta" @if (config('app.timezone') == 'America/Argentina/Salta') selected @endif>(UTC-03:00) Salta</option>
												<option value="America/Argentina/San_Juan" @if (config('app.timezone') == 'America/Argentina/San_Juan') selected @endif>(UTC-03:00) San Juan</option>
												<option value="America/Argentina/San_Luis" @if (config('app.timezone') == 'America/Argentina/San_Luis') selected @endif>(UTC-03:00) San Luis</option>
												<option value="America/Santarem" @if (config('app.timezone') == 'America/Santarem') selected @endif>(UTC-03:00) Santarem</option>
												<option value="America/Sao_Paulo" @if (config('app.timezone') == 'America/Sao_Paulo') selected @endif>(UTC-03:00) Sao Paulo</option>
												<option value="Atlantic/Stanley" @if (config('app.timezone') == 'Atlantic/Stanley') selected @endif>(UTC-03:00) Stanley</option>
												<option value="America/Argentina/Tucuman" @if (config('app.timezone') == 'America/Argentina/Tucuman') selected @endif>(UTC-03:00) Tucuman</option>
												<option value="America/Argentina/Ushuaia" @if (config('app.timezone') == 'America/Argentina/Ushuaia') selected @endif>(UTC-03:00) Ushuaia</option>
												<option value="America/Noronha" @if (config('app.timezone') == 'America/Noronha') selected @endif>(UTC-02:00) Noronha</option>
												<option value="Atlantic/South_Georgia" @if (config('app.timezone') == 'Atlantic/South_Georgia') selected @endif>(UTC-02:00) South Georgia</option>
												<option value="Atlantic/Azores" @if (config('app.timezone') == 'Atlantic/Azores') selected @endif>(UTC-01:00) Azores</option>
												<option value="Atlantic/Cape_Verde" @if (config('app.timezone') == 'Atlantic/Cape_Verde') selected @endif>(UTC-01:00) Cape Verde</option>
												<option value="America/Scoresbysund" @if (config('app.timezone') == 'America/Scoresbysund') selected @endif>(UTC-01:00) Scoresbysund</option>
												<option value="Africa/Abidjan" @if (config('app.timezone') == 'Africa/Abidjan') selected @endif>(UTC+00:00) Abidjan</option>
												<option value="Africa/Accra" @if (config('app.timezone') == 'Africa/Accra') selected @endif>(UTC+00:00) Accra</option>
												<option value="Africa/Bamako" @if (config('app.timezone') == 'Africa/Bamako') selected @endif>(UTC+00:00) Bamako</option>
												<option value="Africa/Banjul" @if (config('app.timezone') == 'Africa/Banjul') selected @endif>(UTC+00:00) Banjul</option>
												<option value="Africa/Bissau" @if (config('app.timezone') == 'Africa/Bissau') selected @endif>(UTC+00:00) Bissau</option>
												<option value="Atlantic/Canary" @if (config('app.timezone') == 'Atlantic/Canary') selected @endif>(UTC+00:00) Canary</option>
												<option value="Africa/Casablanca" @if (config('app.timezone') == 'Africa/Casablanca') selected @endif>(UTC+00:00) Casablanca</option>
												<option value="Africa/Conakry" @if (config('app.timezone') == 'Africa/Conakry') selected @endif>(UTC+00:00) Conakry</option>
												<option value="Africa/Dakar" @if (config('app.timezone') == 'Africa/Dakar') selected @endif>(UTC+00:00) Dakar</option>
												<option value="America/Danmarkshavn" @if (config('app.timezone') == 'America/Danmarkshavn') selected @endif>(UTC+00:00) Danmarkshavn</option>
												<option value="Europe/Dublin" @if (config('app.timezone') == 'Europe/Dublin') selected @endif>(UTC+00:00) Dublin</option>
												<option value="Africa/El_Aaiun" @if (config('app.timezone') == 'Africa/El_Aaiun') selected @endif>(UTC+00:00) El Aaiun</option>
												<option value="Atlantic/Faroe" @if (config('app.timezone') == 'Atlantic/Faroe') selected @endif>(UTC+00:00) Faroe</option>
												<option value="Africa/Freetown" @if (config('app.timezone') == 'Africa/Freetown') selected @endif>(UTC+00:00) Freetown</option>
												<option value="Europe/Guernsey" @if (config('app.timezone') == 'Europe/Guernsey') selected @endif>(UTC+00:00) Guernsey</option>
												<option value="Europe/Isle_of_Man" @if (config('app.timezone') == 'Europe/Isle_of_Man') selected @endif>(UTC+00:00) Isle of Man</option>
												<option value="Europe/Jersey" @if (config('app.timezone') == 'Europe/Jersey') selected @endif>(UTC+00:00) Jersey</option>
												<option value="Europe/Lisbon" @if (config('app.timezone') == 'Europe/Lisbon') selected @endif>(UTC+00:00) Lisbon</option>
												<option value="Africa/Lome" @if (config('app.timezone') == 'Africa/Lome') selected @endif>(UTC+00:00) Lome</option>
												<option value="Europe/London" @if (config('app.timezone') == 'Europe/London') selected @endif>(UTC+00:00) London</option>
												<option value="Atlantic/Madeira" @if (config('app.timezone') == 'Atlantic/Madeira') selected @endif>(UTC+00:00) Madeira</option>
												<option value="Africa/Monrovia" @if (config('app.timezone') == 'Africa/Monrovia') selected @endif>(UTC+00:00) Monrovia</option>
												<option value="Africa/Nouakchott" @if (config('app.timezone') == 'Africa/Nouakchott') selected @endif>(UTC+00:00) Nouakchott</option>
												<option value="Africa/Ouagadougou" @if (config('app.timezone') == 'Africa/Ouagadougou') selected @endif>(UTC+00:00) Ouagadougou</option>
												<option value="Atlantic/Reykjavik" @if (config('app.timezone') == 'Atlantic/Reykjavik') selected @endif>(UTC+00:00) Reykjavik</option>
												<option value="Africa/Sao_Tome" @if (config('app.timezone') == 'Africa/Sao_Tome') selected @endif>(UTC+00:00) Sao Tome</option>
												<option value="Atlantic/St_Helena" @if (config('app.timezone') == 'Atlantic/St_Helena') selected @endif>(UTC+00:00) St. Helena</option>
												<option value="UTC" @if (config('app.timezone') == 'UTC') selected @endif>(UTC+00:00) UTC</option>
												<option value="Africa/Algiers" @if (config('app.timezone') == 'Africa/Algiers') selected @endif>(UTC+01:00) Algiers</option>
												<option value="Europe/Amsterdam" @if (config('app.timezone') == 'Europe/Amsterdam') selected @endif>(UTC+01:00) Amsterdam</option>
												<option value="Europe/Andorra" @if (config('app.timezone') == 'Europe/Andorra') selected @endif>(UTC+01:00) Andorra</option>
												<option value="Africa/Bangui" @if (config('app.timezone') == 'Africa/Bangui') selected @endif>(UTC+01:00) Bangui</option>
												<option value="Europe/Belgrade" @if (config('app.timezone') == 'Europe/Belgrade') selected @endif>(UTC+01:00) Belgrade</option>
												<option value="Europe/Berlin" @if (config('app.timezone') == 'Europe/Berlin') selected @endif>(UTC+01:00) Berlin</option>
												<option value="Europe/Bratislava" @if (config('app.timezone') == 'Europe/Bratislava') selected @endif>(UTC+01:00) Bratislava</option>
												<option value="Africa/Brazzaville" @if (config('app.timezone') == 'Africa/Brazzaville') selected @endif>(UTC+01:00) Brazzaville</option>
												<option value="Europe/Brussels" @if (config('app.timezone') == 'Europe/Brussels') selected @endif>(UTC+01:00) Brussels</option>
												<option value="Europe/Budapest" @if (config('app.timezone') == 'Europe/Budapest') selected @endif>(UTC+01:00) Budapest</option>
												<option value="Europe/Busingen" @if (config('app.timezone') == 'Europe/Busingen') selected @endif>(UTC+01:00) Busingen</option>
												<option value="Africa/Ceuta" @if (config('app.timezone') == 'Africa/Ceuta') selected @endif>(UTC+01:00) Ceuta</option>
												<option value="Europe/Copenhagen" @if (config('app.timezone') == 'Europe/Copenhagen') selected @endif>(UTC+01:00) Copenhagen</option>
												<option value="Africa/Douala" @if (config('app.timezone') == 'Africa/Douala') selected @endif>(UTC+01:00) Douala</option>
												<option value="Europe/Gibraltar" @if (config('app.timezone') == 'Europe/Gibraltar') selected @endif>(UTC+01:00) Gibraltar</option>
												<option value="Africa/Kinshasa" @if (config('app.timezone') == 'Africa/Kinshasa') selected @endif>(UTC+01:00) Kinshasa</option>
												<option value="Africa/Lagos" @if (config('app.timezone') == 'Africa/Lagos') selected @endif>(UTC+01:00) Lagos</option>
												<option value="Africa/Libreville" @if (config('app.timezone') == 'Africa/Libreville') selected @endif>(UTC+01:00) Libreville</option>
												<option value="Europe/Ljubljana" @if (config('app.timezone') == 'Europe/Ljubljana') selected @endif>(UTC+01:00) Ljubljana</option>
												<option value="Arctic/Longyearbyen" @if (config('app.timezone') == 'Arctic/Longyearbyen') selected @endif>(UTC+01:00) Longyearbyen</option>
												<option value="Africa/Luanda" @if (config('app.timezone') == 'Africa/Luanda') selected @endif>(UTC+01:00) Luanda</option>
												<option value="Europe/Luxembourg" @if (config('app.timezone') == 'Europe/Luxembourg') selected @endif>(UTC+01:00) Luxembourg</option>
												<option value="Europe/Madrid" @if (config('app.timezone') == 'Europe/Madrid') selected @endif>(UTC+01:00) Madrid</option>
												<option value="Africa/Malabo" @if (config('app.timezone') == 'Africa/Malabo') selected @endif>(UTC+01:00) Malabo</option>
												<option value="Europe/Malta" @if (config('app.timezone') == 'Europe/Malta') selected @endif>(UTC+01:00) Malta</option>
												<option value="Europe/Monaco" @if (config('app.timezone') == 'Europe/Monaco') selected @endif>(UTC+01:00) Monaco</option>
												<option value="Africa/Ndjamena" @if (config('app.timezone') == 'Africa/Ndjamena') selected @endif>(UTC+01:00) Ndjamena</option>
												<option value="Africa/Niamey" @if (config('app.timezone') == 'Africa/Niamey') selected @endif>(UTC+01:00) Niamey</option>
												<option value="Europe/Oslo" @if (config('app.timezone') == 'Europe/Oslo') selected @endif>(UTC+01:00) Oslo</option>
												<option value="Europe/Paris" @if (config('app.timezone') == 'Europe/Paris') selected @endif>(UTC+01:00) Paris</option>
												<option value="Europe/Podgorica" @if (config('app.timezone') == 'Europe/Podgorica') selected @endif>(UTC+01:00) Podgorica</option>	
												<option value="Africa/Porto-Novo" @if (config('app.timezone') == 'Africa/Porto-Novo') selected @endif>(UTC+01:00) Porto-Novo</option>
												<option value="Europe/Prague" @if (config('app.timezone') == 'Europe/Prague') selected @endif>(UTC+01:00) Prague</option>
												<option value="Europe/Rome" @if (config('app.timezone') == 'Europe/Rome') selected @endif>(UTC+01:00) Rome</option>
												<option value="Europe/San_Marino" @if (config('app.timezone') == 'Europe/San_Marino') selected @endif>(UTC+01:00) San Marino</option>
												<option value="Europe/Sarajevo" @if (config('app.timezone') == 'Europe/Sarajevo') selected @endif>(UTC+01:00) Sarajevo</option>
												<option value="Europe/Skopje" @if (config('app.timezone') == 'Europe/Skopje') selected @endif>(UTC+01:00) Skopje</option>
												<option value="Europe/Stockholm" @if (config('app.timezone') == 'Europe/Stockholm') selected @endif>(UTC+01:00) Stockholm</option>
												<option value="Europe/Tirane" @if (config('app.timezone') == 'Europe/Tirane') selected @endif>(UTC+01:00) Tirane</option>
												<option value="Africa/Tripoli" @if (config('app.timezone') == 'Africa/Tripoli') selected @endif>(UTC+01:00) Tripoli</option>
												<option value="Africa/Tunis" @if (config('app.timezone') == 'Africa/Tunis') selected @endif>(UTC+01:00) Tunis</option>
												<option value="Europe/Vaduz" @if (config('app.timezone') == 'Europe/Vaduz') selected @endif>(UTC+01:00) Vaduz</option>
												<option value="Europe/Vatican" @if (config('app.timezone') == 'Europe/Vatican') selected @endif>(UTC+01:00) Vatican</option>
												<option value="Europe/Vienna" @if (config('app.timezone') == 'Europe/Vienna') selected @endif>(UTC+01:00) Vienna</option>
												<option value="Europe/Warsaw" @if (config('app.timezone') == 'Europe/Warsaw') selected @endif>(UTC+01:00) Warsaw</option>
												<option value="Africa/Windhoek" @if (config('app.timezone') == 'Africa/Windhoek') selected @endif>(UTC+01:00) Windhoek</option>
												<option value="Europe/Zagreb" @if (config('app.timezone') == 'Europe/Zagreb') selected @endif>(UTC+01:00) Zagreb</option>
												<option value="Europe/Zurich" @if (config('app.timezone') == 'Europe/Zurich') selected @endif>(UTC+01:00) Zurich</option>
												<option value="Europe/Athens" @if (config('app.timezone') == 'Europe/Athens') selected @endif>(UTC+02:00) Athens</option>
												<option value="Asia/Beirut" @if (config('app.timezone') == 'Asia/Beirut"') selected @endif>(UTC+02:00) Beirut</option>
												<option value="Africa/Blantyre" @if (config('app.timezone') == 'Africa/Blantyre') selected @endif>(UTC+02:00) Blantyre</option>
												<option value="Europe/Bucharest" @if (config('app.timezone') == 'Europe/Bucharest') selected @endif>(UTC+02:00) Bucharest</option>
												<option value="Africa/Bujumbura" @if (config('app.timezone') == 'Africa/Bujumbura') selected @endif>(UTC+02:00) Bujumbura</option>
												<option value="Africa/Cairo" @if (config('app.timezone') == 'Africa/Cairo') selected @endif>(UTC+02:00) Cairo</option>
												<option value="Europe/Chisinau" @if (config('app.timezone') == 'Europe/Chisinau') selected @endif>(UTC+02:00) Chisinau</option>
												<option value="Asia/Damascus" @if (config('app.timezone') == 'Asia/Damascus') selected @endif>(UTC+02:00) Damascus</option>
												<option value="Africa/Gaborone" @if (config('app.timezone') == 'Africa/Gaborone') selected @endif>(UTC+02:00) Gaborone</option>
												<option value="Asia/Gaza" @if (config('app.timezone') == 'Asia/Gaza') selected @endif>(UTC+02:00) Gaza</option>
												<option value="Africa/Harare" @if (config('app.timezone') == 'Africa/Harare') selected @endif>(UTC+02:00) Harare</option>
												<option value="Asia/Hebron" @if (config('app.timezone') == 'Asia/Hebron') selected @endif>(UTC+02:00) Hebron</option>
												<option value="Europe/Helsinki" @if (config('app.timezone') == 'Europe/Helsinki') selected @endif>(UTC+02:00) Helsinki</option>
												<option value="Europe/Istanbul" @if (config('app.timezone') == 'Europe/Istanbul') selected @endif>(UTC+02:00) Istanbul</option>
												<option value="Asia/Jerusalem" @if (config('app.timezone') == 'Asia/Jerusalem') selected @endif>(UTC+02:00) Jerusalem</option>
												<option value="Africa/Johannesburg" @if (config('app.timezone') == 'Africa/Johannesburg') selected @endif>(UTC+02:00) Johannesburg</option>
												<option value="Europe/Kiev" @if (config('app.timezone') == 'Europe/Kiev') selected @endif>(UTC+02:00) Kiev</option>
												<option value="Africa/Kigali" @if (config('app.timezone') == 'Africa/Kigali') selected @endif>(UTC+02:00) Kigali</option>
												<option value="Africa/Lubumbashi" @if (config('app.timezone') == 'Africa/Lubumbashi') selected @endif>(UTC+02:00) Lubumbashi</option>
												<option value="Africa/Lusaka" @if (config('app.timezone') == 'Africa/Lusaka') selected @endif>(UTC+02:00) Lusaka</option>
												<option value="Africa/Maputo" @if (config('app.timezone') == 'Africa/Maputo') selected @endif>(UTC+02:00) Maputo</option>
												<option value="Europe/Mariehamn" @if (config('app.timezone') == 'Europe/Mariehamn') selected @endif>(UTC+02:00) Mariehamn</option>
												<option value="Africa/Maseru" @if (config('app.timezone') == 'Africa/Maseru') selected @endif>(UTC+02:00) Maseru</option>
												<option value="Africa/Mbabane" @if (config('app.timezone') == 'Africa/Mbabane') selected @endif>(UTC+02:00) Mbabane</option>
												<option value="Asia/Nicosia" @if (config('app.timezone') == 'Asia/Nicosia') selected @endif>(UTC+02:00) Nicosia</option>
												<option value="Europe/Riga" @if (config('app.timezone') == 'Europe/Riga') selected @endif>(UTC+02:00) Riga</option>
												<option value="Europe/Simferopol" @if (config('app.timezone') == 'Europe/Simferopol') selected @endif>(UTC+02:00) Simferopol</option>
												<option value="Europe/Sofia" @if (config('app.timezone') == 'Europe/Sofia') selected @endif>(UTC+02:00) Sofia</option>
												<option value="Europe/Tallinn" @if (config('app.timezone') == 'Europe/Tallinn') selected @endif>(UTC+02:00) Tallinn</option>
												<option value="Europe/Uzhgorod" @if (config('app.timezone') == 'Europe/Uzhgorod') selected @endif>(UTC+02:00) Uzhgorod</option>
												<option value="Europe/Vilnius" @if (config('app.timezone') == 'Europe/Vilnius') selected @endif>(UTC+02:00) Vilnius</option>
												<option value="Europe/Zaporozhye" @if (config('app.timezone') == 'Europe/Zaporozhye') selected @endif>(UTC+02:00) Zaporozhye</option>
												<option value="Africa/Addis_Ababa" @if (config('app.timezone') == 'Africa/Addis_Ababa') selected @endif>(UTC+03:00) Addis Ababa</option>
												<option value="Asia/Aden" @if (config('app.timezone') == 'Asia/Aden') selected @endif>(UTC+03:00) Aden</option>
												<option value="Asia/Amman" @if (config('app.timezone') == 'Asia/Amman') selected @endif>(UTC+03:00) Amman</option>
												<option value="Indian/Antananarivo" @if (config('app.timezone') == 'Indian/Antananarivo') selected @endif>(UTC+03:00) Antananarivo</option>
												<option value="Africa/Asmara" @if (config('app.timezone') == 'Africa/Asmara') selected @endif>(UTC+03:00) Asmara</option>
												<option value="Asia/Baghdad" @if (config('app.timezone') == 'Asia/Baghdad') selected @endif>(UTC+03:00) Baghdad</option>
												<option value="Asia/Bahrain" @if (config('app.timezone') == 'Asia/Bahrain') selected @endif>(UTC+03:00) Bahrain</option>
												<option value="Indian/Comoro" @if (config('app.timezone') == 'Indian/Comoro') selected @endif>(UTC+03:00) Comoro</option>
												<option value="Africa/Dar_es_Salaam" @if (config('app.timezone') == 'Africa/Dar_es_Salaam') selected @endif>(UTC+03:00) Dar es Salaam</option>
												<option value="Africa/Djibouti" @if (config('app.timezone') == 'Africa/Djibouti') selected @endif>(UTC+03:00) Djibouti</option>
												<option value="Africa/Juba" @if (config('app.timezone') == 'Africa/Juba') selected @endif>(UTC+03:00) Juba</option>
												<option value="Europe/Kaliningrad" @if (config('app.timezone') == 'Europe/Kaliningrad') selected @endif>(UTC+03:00) Kaliningrad</option>
												<option value="Africa/Kampala" @if (config('app.timezone') == 'Africa/Kampala') selected @endif>(UTC+03:00) Kampala</option>
												<option value="Africa/Khartoum" @if (config('app.timezone') == 'Africa/Khartoum') selected @endif>(UTC+03:00) Khartoum</option>
												<option value="Asia/Kuwait" @if (config('app.timezone') == 'Asia/Kuwait') selected @endif>(UTC+03:00) Kuwait</option>
												<option value="Indian/Mayotte" @if (config('app.timezone') == 'Indian/Mayotte') selected @endif>(UTC+03:00) Mayotte</option>
												<option value="Europe/Minsk" @if (config('app.timezone') == 'Europe/Minsk') selected @endif>(UTC+03:00) Minsk</option>
												<option value="Africa/Mogadishu" @if (config('app.timezone') == 'Africa/Mogadishu') selected @endif>(UTC+03:00) Mogadishu</option>
												<option value="Europe/Moscow" @if (config('app.timezone') == 'Europe/Moscow') selected @endif>(UTC+03:00) Moscow</option>
												<option value="Africa/Nairobi" @if (config('app.timezone') == 'Africa/Nairobi') selected @endif>(UTC+03:00) Nairobi</option>
												<option value="Asia/Qatar" @if (config('app.timezone') == 'Asia/Qatar') selected @endif>(UTC+03:00) Qatar</option>
												<option value="Asia/Riyadh" @if (config('app.timezone') == 'Asia/Riyadh') selected @endif>(UTC+03:00) Riyadh</option>
												<option value="Antarctica/Syowa" @if (config('app.timezone') == 'Antarctica/Syowa') selected @endif>(UTC+03:00) Syowa</option>
												<option value="Asia/Tehran" @if (config('app.timezone') == 'Asia/Tehran') selected @endif>(UTC+03:30) Tehran</option>
												<option value="Asia/Baku" @if (config('app.timezone') == 'Asia/Baku') selected @endif>(UTC+04:00) Baku</option>
												<option value="Asia/Dubai" @if (config('app.timezone') == 'Asia/Dubai') selected @endif>(UTC+04:00) Dubai</option>
												<option value="Indian/Mahe" @if (config('app.timezone') == 'Indian/Mahe') selected @endif>(UTC+04:00) Mahe</option>
												<option value="Indian/Mauritius" @if (config('app.timezone') == 'Indian/Mauritius') selected @endif>(UTC+04:00) Mauritius</option>
												<option value="Asia/Muscat" @if (config('app.timezone') == 'Asia/Muscat') selected @endif>(UTC+04:00) Muscat</option>
												<option value="Indian/Reunion" @if (config('app.timezone') == 'Indian/Reunion') selected @endif>(UTC+04:00) Reunion</option>
												<option value="Europe/Samara" @if (config('app.timezone') == 'Europe/Samara') selected @endif>(UTC+04:00) Samara</option>
												<option value="Asia/Tbilisi" @if (config('app.timezone') == 'Asia/Tbilisi') selected @endif>(UTC+04:00) Tbilisi</option>
												<option value="Europe/Volgograd" @if (config('app.timezone') == 'Europe/Volgograd') selected @endif>(UTC+04:00) Volgograd</option>
												<option value="Asia/Yerevan" @if (config('app.timezone') == 'Asia/Yerevan') selected @endif>(UTC+04:00) Yerevan</option>
												<option value="Asia/Kabul" @if (config('app.timezone') == 'Asia/Kabul') selected @endif>(UTC+04:30) Kabul</option>
												<option value="Asia/Aqtau" @if (config('app.timezone') == 'Asia/Aqtau') selected @endif>(UTC+05:00) Aqtau</option>
												<option value="Asia/Aqtobe" @if (config('app.timezone') == 'Asia/Aqtobe') selected @endif>(UTC+05:00) Aqtobe</option>
												<option value="Asia/Ashgabat" @if (config('app.timezone') == 'Asia/Ashgabat') selected @endif>(UTC+05:00) Ashgabat</option>
												<option value="Asia/Dushanbe" @if (config('app.timezone') == 'Asia/Dushanbe') selected @endif>(UTC+05:00) Dushanbe</option>
												<option value="Asia/Karachi" @if (config('app.timezone') == 'Asia/Karachi') selected @endif>(UTC+05:00) Karachi</option>
												<option value="Indian/Kerguelen" @if (config('app.timezone') == 'Indian/Kerguelen') selected @endif>(UTC+05:00) Kerguelen</option>
												<option value="Indian/Maldives" @if (config('app.timezone') == 'Indian/Maldives') selected @endif>(UTC+05:00) Maldives</option>
												<option value="Antarctica/Mawson" @if (config('app.timezone') == 'Antarctica/Mawson') selected @endif>(UTC+05:00) Mawson</option>
												<option value="Asia/Oral" @if (config('app.timezone') == 'Asia/Oral') selected @endif>(UTC+05:00) Oral</option>
												<option value="Asia/Samarkand" @if (config('app.timezone') == 'Asia/Samarkand') selected @endif>(UTC+05:00) Samarkand</option>
												<option value="Asia/Tashkent" @if (config('app.timezone') == 'Asia/Tashkent') selected @endif>(UTC+05:00) Tashkent</option>
												<option value="Asia/Colombo" @if (config('app.timezone') == 'Asia/Colombo') selected @endif>(UTC+05:30) Colombo</option>
												<option value="Asia/Kolkata" @if (config('app.timezone') == 'Asia/Kolkata') selected @endif>(UTC+05:30) Kolkata</option>
												<option value="Asia/Kathmandu" @if (config('app.timezone') == 'Asia/Kathmandu') selected @endif>(UTC+05:45) Kathmandu</option>
												<option value="Asia/Almaty" @if (config('app.timezone') == 'Asia/Almaty') selected @endif>(UTC+06:00) Almaty</option>
												<option value="Asia/Bishkek" @if (config('app.timezone') == 'Asia/Bishkek') selected @endif>(UTC+06:00) Bishkek</option>
												<option value="Indian/Chagos" @if (config('app.timezone') == 'Indian/Chagos') selected @endif>(UTC+06:00) Chagos</option>
												<option value="Asia/Dhaka" @if (config('app.timezone') == 'Asia/Dhaka') selected @endif>(UTC+06:00) Dhaka</option>
												<option value="Asia/Qyzylorda" @if (config('app.timezone') == 'Asia/Qyzylorda') selected @endif>(UTC+06:00) Qyzylorda</option>
												<option value="Asia/Thimphu" @if (config('app.timezone') == 'Asia/Thimphu') selected @endif>(UTC+06:00) Thimphu</option>
												<option value="Antarctica/Vostok" @if (config('app.timezone') == 'Antarctica/Vostok') selected @endif>(UTC+06:00) Vostok</option>
												<option value="Asia/Yekaterinburg" @if (config('app.timezone') == 'Asia/Yekaterinburg') selected @endif>(UTC+06:00) Yekaterinburg</option>
												<option value="Indian/Cocos" @if (config('app.timezone') == 'Indian/Cocos') selected @endif>(UTC+06:30) Cocos</option>
												<option value="Asia/Rangoon" @if (config('app.timezone') == 'Asia/Rangoon') selected @endif>(UTC+06:30) Rangoon</option>
												<option value="Asia/Bangkok" @if (config('app.timezone') == 'Asia/Bangkok') selected @endif>(UTC+07:00) Bangkok</option>
												<option value="Indian/Christmas" @if (config('app.timezone') == 'Indian/Christmas') selected @endif>(UTC+07:00) Christmas</option>
												<option value="Antarctica/Davis" @if (config('app.timezone') == 'Antarctica/Davis') selected @endif>(UTC+07:00) Davis</option>
												<option value="Asia/Ho_Chi_Minh" @if (config('app.timezone') == 'Asia/Ho_Chi_Minh') selected @endif>(UTC+07:00) Ho Chi Minh</option>
												<option value="Asia/Hovd" @if (config('app.timezone') == 'Asia/Hovd') selected @endif>(UTC+07:00) Hovd</option>
												<option value="Asia/Jakarta" @if (config('app.timezone') == 'Asia/Jakarta') selected @endif>(UTC+07:00) Jakarta</option>
												<option value="Asia/Novokuznetsk" @if (config('app.timezone') == 'Asia/Novokuznetsk') selected @endif>(UTC+07:00) Novokuznetsk</option>
												<option value="Asia/Novosibirsk" @if (config('app.timezone') == 'Asia/Novosibirsk') selected @endif>(UTC+07:00) Novosibirsk</option>
												<option value="Asia/Omsk" @if (config('app.timezone') == 'Asia/Omsk') selected @endif>(UTC+07:00) Omsk</option>
												<option value="Asia/Phnom_Penh" @if (config('app.timezone') == 'Asia/Phnom_Penh') selected @endif>(UTC+07:00) Phnom Penh</option>
												<option value="Asia/Pontianak" @if (config('app.timezone') == 'Asia/Pontianak') selected @endif>(UTC+07:00) Pontianak</option>
												<option value="Asia/Vientiane" @if (config('app.timezone') == 'Asia/Vientiane') selected @endif>(UTC+07:00) Vientiane</option>
												<option value="Asia/Brunei" @if (config('app.timezone') == 'Asia/Brunei') selected @endif>(UTC+08:00) Brunei</option>
												<option value="Antarctica/Casey" @if (config('app.timezone') == 'Antarctica/Casey') selected @endif>(UTC+08:00) Casey</option>
												<option value="Asia/Choibalsan" @if (config('app.timezone') == 'Asia/Choibalsan') selected @endif>(UTC+08:00) Choibalsan</option>
												<option value="Asia/Chongqing" @if (config('app.timezone') == 'Asia/Chongqing') selected @endif>(UTC+08:00) Chongqing</option>
												<option value="Asia/Harbin" @if (config('app.timezone') == 'Asia/Harbin') selected @endif>(UTC+08:00) Harbin</option>
												<option value="Asia/Hong_Kong" @if (config('app.timezone') == 'Asia/Hong_Kong') selected @endif>(UTC+08:00) Hong Kong</option>
												<option value="Asia/Kashgar" @if (config('app.timezone') == 'Asia/Kashgar') selected @endif>(UTC+08:00) Kashgar</option>
												<option value="Asia/Krasnoyarsk" @if (config('app.timezone') == 'Asia/Krasnoyarsk') selected @endif>(UTC+08:00) Krasnoyarsk</option>
												<option value="Asia/Kuala_Lumpur" @if (config('app.timezone') == 'Asia/Kuala_Lumpur') selected @endif>(UTC+08:00) Kuala Lumpur</option>
												<option value="Asia/Kuching" @if (config('app.timezone') == 'Asia/Kuching') selected @endif>(UTC+08:00) Kuching</option>
												<option value="Asia/Macau" @if (config('app.timezone') == 'Asia/Macau') selected @endif>(UTC+08:00) Macau</option>
												<option value="Asia/Makassar" @if (config('app.timezone') == 'Asia/Makassar') selected @endif>(UTC+08:00) Makassar</option>
												<option value="Asia/Manila" @if (config('app.timezone') == 'Asia/Manila') selected @endif>(UTC+08:00) Manila</option>
												<option value="Australia/Perth" @if (config('app.timezone') == 'Australia/Perth') selected @endif>(UTC+08:00) Perth</option>
												<option value="Asia/Shanghai" @if (config('app.timezone') == 'Asia/Shanghai') selected @endif>(UTC+08:00) Shanghai</option>
												<option value="Asia/Singapore" @if (config('app.timezone') == 'Asia/Singapore') selected @endif>(UTC+08:00) Singapore</option>
												<option value="Asia/Taipei" @if (config('app.timezone') == 'Asia/Taipei') selected @endif>(UTC+08:00) Taipei</option>
												<option value="Asia/Ulaanbaatar" @if (config('app.timezone') == 'Asia/Ulaanbaatar') selected @endif>(UTC+08:00) Ulaanbaatar</option>
												<option value="Asia/Urumqi" @if (config('app.timezone') == 'Asia/Urumqi') selected @endif>(UTC+08:00) Urumqi</option>
												<option value="Australia/Eucla" @if (config('app.timezone') == 'Australia/Eucla') selected @endif>(UTC+08:45) Eucla</option>
												<option value="Asia/Dili" @if (config('app.timezone') == 'Asia/Dili') selected @endif>(UTC+09:00) Dili</option>
												<option value="Asia/Irkutsk" @if (config('app.timezone') == 'Asia/Irkutsk') selected @endif>(UTC+09:00) Irkutsk</option>
												<option value="Asia/Jayapura" @if (config('app.timezone') == 'Asia/Jayapura') selected @endif>(UTC+09:00) Jayapura</option>
												<option value="Pacific/Palau" @if (config('app.timezone') == 'Pacific/Palau') selected @endif>(UTC+09:00) Palau</option>
												<option value="Asia/Pyongyang" @if (config('app.timezone') == 'Asia/Pyongyang') selected @endif>(UTC+09:00) Pyongyang</option>
												<option value="Asia/Seoul" @if (config('app.timezone') == 'Asia/Seoul') selected @endif>(UTC+09:00) Seoul</option>
												<option value="Asia/Tokyo" @if (config('app.timezone') == 'Asia/Tokyo') selected @endif>(UTC+09:00) Tokyo</option>
												<option value="Australia/Adelaide" @if (config('app.timezone') == 'Australia/Adelaide') selected @endif>(UTC+09:30) Adelaide</option>
												<option value="Australia/Broken_Hill" @if (config('app.timezone') == 'Australia/Broken_Hill') selected @endif>(UTC+09:30) Broken Hill</option>
												<option value="Australia/Darwin" @if (config('app.timezone') == 'Australia/Darwin') selected @endif>(UTC+09:30) Darwin</option>
												<option value="Australia/Brisbane" @if (config('app.timezone') == 'Australia/Brisbane') selected @endif>(UTC+10:00) Brisbane</option>
												<option value="Pacific/Chuuk" @if (config('app.timezone') == 'Pacific/Chuuk') selected @endif>(UTC+10:00) Chuuk</option>
												<option value="Australia/Currie" @if (config('app.timezone') == 'Australia/Currie') selected @endif>(UTC+10:00) Currie</option>
												<option value="Antarctica/DumontDUrville" @if (config('app.timezone') == 'Antarctica/DumontDUrville') selected @endif>(UTC+10:00) DumontDUrville</option>
												<option value="Pacific/Guam" @if (config('app.timezone') == 'Pacific/Guam') selected @endif>(UTC+10:00) Guam</option>
												<option value="Australia/Hobart" @if (config('app.timezone') == 'Australia/Hobart') selected @endif>(UTC+10:00) Hobart</option>
												<option value="Asia/Khandyga" @if (config('app.timezone') == 'Asia/Khandyga') selected @endif>(UTC+10:00) Khandyga</option>
												<option value="Australia/Lindeman" @if (config('app.timezone') == 'Australia/Lindeman') selected @endif>(UTC+10:00) Lindeman</option>
												<option value="Australia/Melbourne" @if (config('app.timezone') == 'Australia/Melbourne') selected @endif>(UTC+10:00) Melbourne</option>
												<option value="Pacific/Port_Moresby" @if (config('app.timezone') == 'Pacific/Port_Moresby') selected @endif>(UTC+10:00) Port Moresby</option>
												<option value="Pacific/Saipan" @if (config('app.timezone') == 'Pacific/Saipan') selected @endif>(UTC+10:00) Saipan</option>
												<option value="Australia/Sydney" @if (config('app.timezone') == 'Australia/Sydney') selected @endif>(UTC+10:00) Sydney</option>
												<option value="Asia/Yakutsk" @if (config('app.timezone') == 'Asia/Yakutsk') selected @endif>(UTC+10:00) Yakutsk</option>
												<option value="Australia/Lord_Howe" @if (config('app.timezone') == 'Australia/Lord_Howe') selected @endif>(UTC+10:30) Lord Howe</option>
												<option value="Pacific/Efate" @if (config('app.timezone') == 'Pacific/Efate') selected @endif>(UTC+11:00) Efate</option>
												<option value="Pacific/Guadalcanal" @if (config('app.timezone') == 'Pacific/Guadalcanal') selected @endif>(UTC+11:00) Guadalcanal</option>
												<option value="Pacific/Kosrae" @if (config('app.timezone') == 'Pacific/Kosrae') selected @endif>(UTC+11:00) Kosrae</option>
												<option value="Antarctica/Macquarie" @if (config('app.timezone') == 'Antarctica/Macquarie') selected @endif>(UTC+11:00) Macquarie</option>
												<option value="Pacific/Noumea" @if (config('app.timezone') == 'Pacific/Noumea') selected @endif>(UTC+11:00) Noumea</option>
												<option value="Pacific/Pohnpei" @if (config('app.timezone') == 'Pacific/Pohnpei') selected @endif>(UTC+11:00) Pohnpei</option>
												<option value="Asia/Sakhalin" @if (config('app.timezone') == 'Asia/Sakhalin') selected @endif>(UTC+11:00) Sakhalin</option>
												<option value="Asia/Ust-Nera" @if (config('app.timezone') == 'Asia/Ust-Nera') selected @endif>(UTC+11:00) Ust-Nera</option>
												<option value="Asia/Vladivostok" @if (config('app.timezone') == 'Asia/Vladivostok') selected @endif>(UTC+11:00) Vladivostok</option>
												<option value="Pacific/Norfolk" @if (config('app.timezone') == 'Pacific/Norfolk') selected @endif>(UTC+11:30) Norfolk</option>
												<option value="Asia/Anadyr" @if (config('app.timezone') == 'Asia/Anadyr') selected @endif>(UTC+12:00) Anadyr</option>
												<option value="Pacific/Auckland" @if (config('app.timezone') == 'Pacific/Auckland') selected @endif>(UTC+12:00) Auckland</option>
												<option value="Pacific/Fiji" @if (config('app.timezone') == 'Pacific/Fiji') selected @endif>(UTC+12:00) Fiji</option>
												<option value="Pacific/Funafuti" @if (config('app.timezone') == 'Pacific/Funafuti') selected @endif>(UTC+12:00) Funafuti</option>
												<option value="Asia/Kamchatka" @if (config('app.timezone') == 'Asia/Kamchatka') selected @endif>(UTC+12:00) Kamchatka</option>
												<option value="Pacific/Kwajalein" @if (config('app.timezone') == 'Pacific/Kwajalein') selected @endif>(UTC+12:00) Kwajalein</option>
												<option value="Asia/Magadan" @if (config('app.timezone') == 'Asia/Magadan') selected @endif>(UTC+12:00) Magadan</option>
												<option value="Pacific/Majuro" @if (config('app.timezone') == 'Pacific/Majuro') selected @endif>(UTC+12:00) Majuro</option>
												<option value="Antarctica/McMurdo" @if (config('app.timezone') == 'Antarctica/McMurdo') selected @endif>(UTC+12:00) McMurdo</option>
												<option value="Pacific/Nauru" @if (config('app.timezone') == 'Pacific/Nauru') selected @endif>(UTC+12:00) Nauru</option>
												<option value="Antarctica/South_Pole" @if (config('app.timezone') == 'Antarctica/South_Pole') selected @endif>(UTC+12:00) South Pole</option>
												<option value="Pacific/Tarawa" @if (config('app.timezone') == 'Pacific/Tarawa') selected @endif>(UTC+12:00) Tarawa</option>
												<option value="Pacific/Wake" @if (config('app.timezone') == 'Pacific/Wake') selected @endif>(UTC+12:00) Wake</option>
												<option value="Pacific/Wallis" @if (config('app.timezone') == 'Pacific/Wallis') selected @endif>(UTC+12:00) Wallis</option>
												<option value="Pacific/Chatham" @if (config('app.timezone') == 'Pacific/Chatham') selected @endif>(UTC+12:45) Chatham</option>
												<option value="Pacific/Apia" @if (config('app.timezone') == 'Pacific/Apia') selected @endif>(UTC+13:00) Apia</option>
												<option value="Pacific/Enderbury" @if (config('app.timezone') == 'Pacific/Enderbury') selected @endif>(UTC+13:00) Enderbury</option>
												<option value="Pacific/Fakaofo" @if (config('app.timezone') == 'Pacific/Fakaofo') selected @endif>(UTC+13:00) Fakaofo</option>
												<option value="Pacific/Tongatapu" @if (config('app.timezone') == 'Pacific/Tongatapu') selected @endif>(UTC+13:00) Tongatapu</option>
												<option value="Pacific/Kiritimati" @if (config('app.timezone') == 'Pacific/Kiritimati') selected @endif>(UTC+14:00) Kiritimati</option>
											</select> 
										</div> 
									</div>

								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6>{{ __('Default Group for New Users') }}</h6>
											<select id="user-group" name="user-group" data-placeholder="{{ __('Select Default New User Group') }}">	
												<option value="user" {{ (config('settings.default_user') == 'user') ? 'selected' : '' }}>{{ __('User') }}</option>
												<option value="subscriber" {{ (config('settings.default_user') == 'subscriber') ? 'selected' : '' }}>{{ __('Subscriber') }}</option>
												<option value="admin" {{ (config('settings.default_user') == 'admin') ? 'selected' : '' }}>{{ __('Administrator') }}</option>																		
											</select> 
										</div> 
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6>{{ __('Email for Support Tickets') }}</h6>
											<select id="support-ticket" name="support-ticket" data-placeholder="{{ __('Enable/Disable Email Sending for Support Ticket Statuses') }}">	
												<option value="enabled" {{ (config('settings.support_email') == 'enabled') ? 'selected' : '' }}>{{ __('Enable') }}</option>
												<option value="disabled" {{ (config('settings.support_email') == 'disabled') ? 'selected' : '' }}>{{ __('Disable') }}</option>																		
											</select> 
										</div> 
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6>{{ __('User Notifications Panel') }}</h6>
											<select id="user-notification" name="user-notification" data-placeholder="{{ __('Enable/Disable User Notification View Panel') }}">	
												<option value="enabled" {{ (config('settings.user_notification') == 'enabled') ? 'selected' : '' }}>{{ __('Enable') }}</option>
												<option value="disabled" {{ (config('settings.user_notification') == 'disabled') ? 'selected' : '' }}>{{ __('Disable') }}</option>																		
											</select> 
										</div> 
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6>{{ __('User Support Request Panel') }}</h6>
											<select id="user-support" name="user-support" data-placeholder="Enable/Disable User Support Ticket Panel">	
												<option value="enabled" {{ (config('settings.user_support') == 'enabled') ? 'selected' : '' }}>{{ __('Enable') }}</option>
												<option value="disabled" {{ (config('settings.user_support') == 'disabled') ? 'selected' : '' }}>{{ __('Disable') }}</option>																		
											</select> 
										</div> 
									</div>
								</div>
	
							</div>
						</div>

						<div class="card border-0 special-shadow">							
							<div class="card-body">
								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Live Chat') }} <span class="text-muted">({{ __('tawk.to') }})</span></h6>
								
								<div class="form-group">
									<label class="custom-switch">
										<input type="checkbox" name="enable-live-chat" class="custom-switch-input" @if ( config('settings.live_chat')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Enable Live Chat') }}</span>
									</label>
								</div>
							
								<div class="input-box mb-2 mt-2">								
									<h6>{{ __('Direct Chat Link') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('live-chat-link') is-danger @enderror" id="live-chat-link" name="live-chat-link" value="{{ config('settings.live_chat_link') }}" autocomplete="off">
										@error('live-chat-link')
											<p class="text-danger">{{ $errors->first('live-chat-link') }}</p>
										@enderror
									</div> 
								</div> 	
							</div>
						</div>

						<div class="card border-0 special-shadow">							
							<div class="card-body pb-0">
								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Google reCaptcha v3') }}</h6>
								
								<div class="form-group">
									<label class="custom-switch">
										<input type="checkbox" name="enable-recaptcha" class="custom-switch-input" @if ( config('services.google.recaptcha.enable')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Enable Google reCaptcha') }}</span>
									</label>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box mt-2">								
											<h6>{{ __('reCaptcha Site Key') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('recaptcha-site-key') is-danger @enderror" id="recaptcha-site-key" name="recaptcha-site-key" value="{{ config('services.google.recaptcha.site_key') }}" autocomplete="off">
												@error('recaptcha-site-key')
													<p class="text-danger">{{ $errors->first('recaptcha-site-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- SECRET ACCESS KEY -->
										<div class="input-box mt-2">								
											<h6>{{ __('reCaptcha Secret Key') }}</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control @error('recaptcha-secret-key') is-danger @enderror" id="recaptcha-secret-key" name="recaptcha-secret-key" value="{{ config('services.google.recaptcha.secret_key') }}" autocomplete="off">
												@error('recaptcha-secret-key')
													<p class="text-danger">{{ $errors->first('recaptcha-secret-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END SECRET ACCESS KEY -->
									</div>
								</div>	
							</div>
						</div>	

						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body pb-0">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Google Analytics') }}</h6>

								<div class="form-group">
									<label class="custom-switch">
										<input type="checkbox" name="enable-analytics" class="custom-switch-input" @if ( config('services.google.analytics.enable')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Enable Google Analytics') }}</span>
									</label>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box mt-2">								
											<h6>{{ __('Google Analytics Tracking ID') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('google-analytics') is-danger @enderror" id="google-analytics" name="google-analytics" value="{{ config('services.google.analytics.id') }}" autocomplete="off">
												@error('google-analytics')
													<p class="text-danger">{{ $errors->first('google-analytics') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>		
								
								</div>
	
							</div>
						</div>

						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body pb-0">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('Google Maps') }}</h6>

								<div class="form-group">
									<label class="custom-switch">
										<input type="checkbox" name="enable-maps" class="custom-switch-input" @if ( config('services.google.maps.enable')  == 'on') checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Enable Google Maps') }}</span>
									</label>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box mt-2">								
											<h6>{{ __('Google Maps API Key') }}</h6>
											<div class="form-group">							    
												<input type="text" class="form-control @error('google-key') is-danger @enderror" id="google-key" name="google-key" value="{{ config('services.google.maps.key') }}" autocomplete="off">
												@error('google-key')
													<p class="text-danger">{{ $errors->first('google-key') }}</p>
												@enderror
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>								
								</div>
							</div>
						</div>						
						
						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4">{{ __('GDPR Policy') }}</h6>

								<div class="form-group">
									<label class="custom-switch">
										<input type="checkbox" name="enable-gdpr" class="custom-switch-input" @if ( config('cookie-consent.enabled') ) checked @endif>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description">{{ __('Enable GDPR Consent Popup') }}</span>
									</label>
								</div>	
							</div>
						</div>


						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<a href="{{ route('admin.dashboard') }}" class="btn btn-cancel mr-2">{{ __('Cancel') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('Save') }}</button>							
						</div>				

					</form>
					
				</div>
			</div>
		</div>
	</div>
@endsection