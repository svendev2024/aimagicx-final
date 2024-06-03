@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('Invoice Settings') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-sack-dollar mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.finance.dashboard') }}"> {{ __('Finance Management') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> {{ __('Invoice Settings') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection
@section('content')					
	<div class="row">
		<div class="col-lg-8 col-md-12 col-xm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Setup Invoice Settings') }}</h3>
				</div>
				<div class="card-body">
									
					<form action="{{ route('admin.settings.invoice.store') }}" method="POST" enctype="multipart/form-data">
						@csrf				

						<div class="row">		
							<div class="col-md-6 col-sm-12">							
								<div class="input-box">	
									<h6>{{ __('Invoice Currency') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<select id="invoice-currency" name="invoice_currency" data-placeholder="{{ __('Select Currency') }}:">			
										<option value="AFA" @if ($invoice['invoice_currency'] == 'AFA') selected @endif>Afghan Afghani</option>
										<option value="ALL" @if ($invoice['invoice_currency'] == 'ALL') selected @endif>Albanian Lek</option>
										<option value="DZD" @if ($invoice['invoice_currency'] == 'DZD') selected @endif>Algerian Dinar</option>
										<option value="AOA" @if ($invoice['invoice_currency'] == 'AOA') selected @endif>Angolan Kwanza</option>
										<option value="ARS" @if ($invoice['invoice_currency'] == 'AFA') selected @endif>Argentine Peso</option>
										<option value="AMD" @if ($invoice['invoice_currency'] == 'AFA') selected @endif>Armenian Dram</option>
										<option value="AWG" @if ($invoice['invoice_currency'] == 'AFA') selected @endif>Aruban Florin</option>
										<option value="AUD" @if ($invoice['invoice_currency'] == 'AFA') selected @endif>Australian Dollar</option>
										<option value="AZN" @if ($invoice['invoice_currency'] == 'AFA') selected @endif>Azerbaijani Manat</option>
										<option value="BSD" @if ($invoice['invoice_currency'] == 'BSD') selected @endif>Bahamian Dollar</option>
										<option value="BHD" @if ($invoice['invoice_currency'] == 'BHD') selected @endif>Bahraini Dinar</option>
										<option value="BDT" @if ($invoice['invoice_currency'] == 'BDT') selected @endif>Bangladeshi Taka</option>
										<option value="BBD" @if ($invoice['invoice_currency'] == 'BBD') selected @endif>Barbadian Dollar</option>
										<option value="BYR" @if ($invoice['invoice_currency'] == 'BYR') selected @endif>Belarusian Ruble</option>
										<option value="BEF" @if ($invoice['invoice_currency'] == 'BEF') selected @endif>Belgian Franc</option>
										<option value="BZD" @if ($invoice['invoice_currency'] == 'BZD') selected @endif>Belize Dollar</option>
										<option value="BMD" @if ($invoice['invoice_currency'] == 'BMD') selected @endif>Bermudan Dollar</option>
										<option value="BTN" @if ($invoice['invoice_currency'] == 'BTN') selected @endif>Bhutanese Ngultrum</option>
										<option value="BOB" @if ($invoice['invoice_currency'] == 'BOB') selected @endif>Bolivian Boliviano</option>
										<option value="BAM" @if ($invoice['invoice_currency'] == 'BAM') selected @endif>Bosnia-Herzegovina Convertible Mark</option>
										<option value="BWP" @if ($invoice['invoice_currency'] == 'BWP') selected @endif>Botswanan Pula</option>
										<option value="BRL" @if ($invoice['invoice_currency'] == 'BRL') selected @endif>Brazilian Real</option>
										<option value="GBP" @if ($invoice['invoice_currency'] == 'GBP') selected @endif>British Pound Sterling</option>
										<option value="BND" @if ($invoice['invoice_currency'] == 'BND') selected @endif>Brunei Dollar</option>
										<option value="BGN" @if ($invoice['invoice_currency'] == 'BGN') selected @endif>Bulgarian Lev</option>
										<option value="BIF" @if ($invoice['invoice_currency'] == 'BIF') selected @endif>Burundian Franc</option>
										<option value="KHR" @if ($invoice['invoice_currency'] == 'KHR') selected @endif>Cambodian Riel</option>
										<option value="CAD" @if ($invoice['invoice_currency'] == 'CAD') selected @endif>Canadian Dollar</option>
										<option value="CVE" @if ($invoice['invoice_currency'] == 'CVE') selected @endif>Cape Verdean Escudo</option>
										<option value="KYD" @if ($invoice['invoice_currency'] == 'KYD') selected @endif>Cayman Islands Dollar</option>
										<option value="XOF" @if ($invoice['invoice_currency'] == 'XOF') selected @endif>CFA Franc BCEAO</option>
										<option value="XAF" @if ($invoice['invoice_currency'] == 'XAF') selected @endif>CFA Franc BEAC</option>
										<option value="XPF" @if ($invoice['invoice_currency'] == 'XPF') selected @endif>CFP Franc</option>
										<option value="CLP" @if ($invoice['invoice_currency'] == 'CLP') selected @endif>Chilean Peso</option>
										<option value="CNY" @if ($invoice['invoice_currency'] == 'CNY') selected @endif>Chinese Yuan</option>
										<option value="COP" @if ($invoice['invoice_currency'] == 'COP') selected @endif>Colombian Peso</option>
										<option value="KMF" @if ($invoice['invoice_currency'] == 'KMF') selected @endif>Comorian Franc</option>
										<option value="CDF" @if ($invoice['invoice_currency'] == 'CDF') selected @endif>Congolese Franc</option>
										<option value="CRC" @if ($invoice['invoice_currency'] == 'CRC') selected @endif>Costa Rican ColÃ³n</option>
										<option value="HRK" @if ($invoice['invoice_currency'] == 'HRK') selected @endif>Croatian Kuna</option>
										<option value="CUC" @if ($invoice['invoice_currency'] == 'CUC') selected @endif>Cuban Convertible Peso</option>
										<option value="CZK" @if ($invoice['invoice_currency'] == 'CZK') selected @endif>Czech Republic Koruna</option>
										<option value="DKK" @if ($invoice['invoice_currency'] == 'DKK') selected @endif>Danish Krone</option>
										<option value="DJF" @if ($invoice['invoice_currency'] == 'DJF') selected @endif>Djiboutian Franc</option>
										<option value="DOP" @if ($invoice['invoice_currency'] == 'DOP') selected @endif>Dominican Peso</option>
										<option value="XCD" @if ($invoice['invoice_currency'] == 'XCD') selected @endif>East Caribbean Dollar</option>
										<option value="EGP" @if ($invoice['invoice_currency'] == 'EGP') selected @endif>Egyptian Pound</option>
										<option value="ERN" @if ($invoice['invoice_currency'] == 'ERN') selected @endif>Eritrean Nakfa</option>
										<option value="EEK" @if ($invoice['invoice_currency'] == 'EEK') selected @endif>Estonian Kroon</option>
										<option value="ETB" @if ($invoice['invoice_currency'] == 'ETB') selected @endif>Ethiopian Birr</option>
										<option value="EUR" @if ($invoice['invoice_currency'] == 'EUR') selected @endif>Euro</option>
										<option value="FKP" @if ($invoice['invoice_currency'] == 'FKP') selected @endif>Falkland Islands Pound</option>
										<option value="FJD" @if ($invoice['invoice_currency'] == 'FJD') selected @endif>Fijian Dollar</option>
										<option value="GMD" @if ($invoice['invoice_currency'] == 'GMD') selected @endif>Gambian Dalasi</option>
										<option value="GEL" @if ($invoice['invoice_currency'] == 'GEL') selected @endif>Georgian Lari</option>
										<option value="DEM" @if ($invoice['invoice_currency'] == 'DEM') selected @endif>German Mark</option>
										<option value="GHS" @if ($invoice['invoice_currency'] == 'GHS') selected @endif>Ghanaian Cedi</option>
										<option value="GIP" @if ($invoice['invoice_currency'] == 'GIP') selected @endif>Gibraltar Pound</option>
										<option value="GRD" @if ($invoice['invoice_currency'] == 'GRD') selected @endif>Greek Drachma</option>
										<option value="GTQ" @if ($invoice['invoice_currency'] == 'GTQ') selected @endif>Guatemalan Quetzal</option>
										<option value="GNF" @if ($invoice['invoice_currency'] == 'GNF') selected @endif>Guinean Franc</option>
										<option value="GYD" @if ($invoice['invoice_currency'] == 'GYD') selected @endif>Guyanaese Dollar</option>
										<option value="HTG" @if ($invoice['invoice_currency'] == 'HTG') selected @endif>Haitian Gourde</option>
										<option value="HNL" @if ($invoice['invoice_currency'] == 'HNL') selected @endif>Honduran Lempira</option>
										<option value="HKD" @if ($invoice['invoice_currency'] == 'HKD') selected @endif>Hong Kong Dollar</option>
										<option value="HUF" @if ($invoice['invoice_currency'] == 'HUF') selected @endif>Hungarian Forint</option>
										<option value="ISK" @if ($invoice['invoice_currency'] == 'ISK') selected @endif>Icelandic KrÃ³na</option>
										<option value="INR" @if ($invoice['invoice_currency'] == 'INR') selected @endif>Indian Rupee</option>
										<option value="IDR" @if ($invoice['invoice_currency'] == 'IDR') selected @endif>Indonesian Rupiah</option>
										<option value="IRR" @if ($invoice['invoice_currency'] == 'IRR') selected @endif>Iranian Rial</option>
										<option value="IQD" @if ($invoice['invoice_currency'] == 'IQD') selected @endif>Iraqi Dinar</option>
										<option value="ILS" @if ($invoice['invoice_currency'] == 'ILS') selected @endif>Israeli New Sheqel</option>
										<option value="ITL" @if ($invoice['invoice_currency'] == 'ITL') selected @endif>Italian Lira</option>
										<option value="JMD" @if ($invoice['invoice_currency'] == 'JMD') selected @endif>Jamaican Dollar</option>
										<option value="JPY" @if ($invoice['invoice_currency'] == 'JPY') selected @endif>Japanese Yen</option>
										<option value="JOD" @if ($invoice['invoice_currency'] == 'JOD') selected @endif>Jordanian Dinar</option>
										<option value="KZT" @if ($invoice['invoice_currency'] == 'KZT') selected @endif>Kazakhstani Tenge</option>
										<option value="KES" @if ($invoice['invoice_currency'] == 'KES') selected @endif>Kenyan Shilling</option>
										<option value="KWD" @if ($invoice['invoice_currency'] == 'KWD') selected @endif>Kuwaiti Dinar</option>
										<option value="KGS" @if ($invoice['invoice_currency'] == 'KGS') selected @endif>Kyrgystani Som</option>
										<option value="LAK" @if ($invoice['invoice_currency'] == 'LAK') selected @endif>Laotian Kip</option>
										<option value="LVL" @if ($invoice['invoice_currency'] == 'LVL') selected @endif>Latvian Lats</option>
										<option value="LBP" @if ($invoice['invoice_currency'] == 'LBP') selected @endif>Lebanese Pound</option>
										<option value="LSL" @if ($invoice['invoice_currency'] == 'LSL') selected @endif>Lesotho Loti</option>
										<option value="LRD" @if ($invoice['invoice_currency'] == 'LRD') selected @endif>Liberian Dollar</option>
										<option value="LYD" @if ($invoice['invoice_currency'] == 'LYD') selected @endif>Libyan Dinar</option>
										<option value="LTL" @if ($invoice['invoice_currency'] == 'LTL') selected @endif>Lithuanian Litas</option>
										<option value="MOP" @if ($invoice['invoice_currency'] == 'MOP') selected @endif>Macanese Pataca</option>
										<option value="MKD" @if ($invoice['invoice_currency'] == 'MKD') selected @endif>Macedonian Denar</option>
										<option value="MGA" @if ($invoice['invoice_currency'] == 'MGA') selected @endif>Malagasy Ariary</option>
										<option value="MWK" @if ($invoice['invoice_currency'] == 'MWK') selected @endif>Malawian Kwacha</option>
										<option value="MYR" @if ($invoice['invoice_currency'] == 'MYR') selected @endif>Malaysian Ringgit</option>
										<option value="MVR" @if ($invoice['invoice_currency'] == 'MVR') selected @endif>Maldivian Rufiyaa</option>
										<option value="MRO" @if ($invoice['invoice_currency'] == 'MRO') selected @endif>Mauritanian Ouguiya</option>
										<option value="MUR" @if ($invoice['invoice_currency'] == 'MUR') selected @endif>Mauritian Rupee</option>
										<option value="MXN" @if ($invoice['invoice_currency'] == 'MXN') selected @endif>Mexican Peso</option>
										<option value="MDL" @if ($invoice['invoice_currency'] == 'MDL') selected @endif>Moldovan Leu</option>
										<option value="MNT" @if ($invoice['invoice_currency'] == 'MNT') selected @endif>Mongolian Tugrik</option>
										<option value="MAD" @if ($invoice['invoice_currency'] == 'MAD') selected @endif>Moroccan Dirham</option>
										<option value="MZM" @if ($invoice['invoice_currency'] == 'MZM') selected @endif>Mozambican Metical</option>
										<option value="MMK" @if ($invoice['invoice_currency'] == 'MMK') selected @endif>Myanmar Kyat</option>
										<option value="NAD" @if ($invoice['invoice_currency'] == 'NAD') selected @endif>Namibian Dollar</option>
										<option value="NPR" @if ($invoice['invoice_currency'] == 'NPR') selected @endif>Nepalese Rupee</option>
										<option value="ANG" @if ($invoice['invoice_currency'] == 'ANG') selected @endif>Netherlands Antillean Guilder</option>
										<option value="TWD" @if ($invoice['invoice_currency'] == 'TWD') selected @endif>New Taiwan Dollar</option>
										<option value="NZD" @if ($invoice['invoice_currency'] == 'NZD') selected @endif>New Zealand Dollar</option>
										<option value="NIO" @if ($invoice['invoice_currency'] == 'NIO') selected @endif>Nicaraguan CÃ³rdoba</option>
										<option value="NGN" @if ($invoice['invoice_currency'] == 'NGN') selected @endif>Nigerian Naira</option>
										<option value="KPW" @if ($invoice['invoice_currency'] == 'KPW') selected @endif>North Korean Won</option>
										<option value="NOK" @if ($invoice['invoice_currency'] == 'NOK') selected @endif>Norwegian Krone</option>
										<option value="OMR" @if ($invoice['invoice_currency'] == 'OMR') selected @endif>Omani Rial</option>
										<option value="PKR" @if ($invoice['invoice_currency'] == 'PKR') selected @endif>Pakistani Rupee</option>
										<option value="PAB" @if ($invoice['invoice_currency'] == 'PAB') selected @endif>Panamanian Balboa</option>
										<option value="PGK" @if ($invoice['invoice_currency'] == 'PGK') selected @endif>Papua New Guinean Kina</option>
										<option value="PYG" @if ($invoice['invoice_currency'] == 'PYG') selected @endif>Paraguayan Guarani</option>
										<option value="PEN" @if ($invoice['invoice_currency'] == 'PEN') selected @endif>Peruvian Nuevo Sol</option>
										<option value="PHP" @if ($invoice['invoice_currency'] == 'PHP') selected @endif>Philippine Peso</option>
										<option value="PLN" @if ($invoice['invoice_currency'] == 'PLN') selected @endif>Polish Zloty</option>
										<option value="QAR" @if ($invoice['invoice_currency'] == 'QAR') selected @endif>Qatari Rial</option>
										<option value="RON" @if ($invoice['invoice_currency'] == 'RON') selected @endif>Romanian Leu</option>
										<option value="RUB" @if ($invoice['invoice_currency'] == 'RUB') selected @endif>Russian Ruble</option>
										<option value="RWF" @if ($invoice['invoice_currency'] == 'RWF') selected @endif>Rwandan Franc</option>
										<option value="SVC" @if ($invoice['invoice_currency'] == 'SVC') selected @endif>Salvadoran ColÃ³n</option>
										<option value="WST" @if ($invoice['invoice_currency'] == 'WST') selected @endif>Samoan Tala</option>
										<option value="SAR" @if ($invoice['invoice_currency'] == 'SAR') selected @endif>Saudi Riyal</option>
										<option value="RSD" @if ($invoice['invoice_currency'] == 'RSD') selected @endif>Serbian Dinar</option>
										<option value="SCR" @if ($invoice['invoice_currency'] == 'SCR') selected @endif>Seychellois Rupee</option>
										<option value="SLL" @if ($invoice['invoice_currency'] == 'SLL') selected @endif>Sierra Leonean Leone</option>
										<option value="SGD" @if ($invoice['invoice_currency'] == 'SGD') selected @endif>Singapore Dollar</option>
										<option value="SKK" @if ($invoice['invoice_currency'] == 'SKK') selected @endif>Slovak Koruna</option>
										<option value="SBD" @if ($invoice['invoice_currency'] == 'SBD') selected @endif>Solomon Islands Dollar</option>
										<option value="SOS" @if ($invoice['invoice_currency'] == 'SOS') selected @endif>Somali Shilling</option>
										<option value="ZAR" @if ($invoice['invoice_currency'] == 'ZAR') selected @endif>South African Rand</option>
										<option value="KRW" @if ($invoice['invoice_currency'] == 'KRW') selected @endif>South Korean Won</option>
										<option value="XDR" @if ($invoice['invoice_currency'] == 'XDR') selected @endif>Special Drawing Rights</option>
										<option value="LKR" @if ($invoice['invoice_currency'] == 'LKR') selected @endif>Sri Lankan Rupee</option>
										<option value="SHP" @if ($invoice['invoice_currency'] == 'SHP') selected @endif>St. Helena Pound</option>
										<option value="SDG" @if ($invoice['invoice_currency'] == 'SDG') selected @endif>Sudanese Pound</option>
										<option value="SRD" @if ($invoice['invoice_currency'] == 'SRD') selected @endif>Surinamese Dollar</option>
										<option value="SZL" @if ($invoice['invoice_currency'] == 'SZL') selected @endif>Swazi Lilangeni</option>
										<option value="SEK" @if ($invoice['invoice_currency'] == 'SEK') selected @endif>Swedish Krona</option>
										<option value="CHF" @if ($invoice['invoice_currency'] == 'CHF') selected @endif>Swiss Franc</option>
										<option value="SYP" @if ($invoice['invoice_currency'] == 'SYP') selected @endif>Syrian Pound</option>
										<option value="STD" @if ($invoice['invoice_currency'] == 'STD') selected @endif>São Tomé and Príncipe Dobra</option>
										<option value="TJS" @if ($invoice['invoice_currency'] == 'TJS') selected @endif>Tajikistani Somoni</option>
										<option value="TZS" @if ($invoice['invoice_currency'] == 'TZS') selected @endif>Tanzanian Shilling</option>
										<option value="THB" @if ($invoice['invoice_currency'] == 'THB') selected @endif>Thai Baht</option>
										<option value="TOP" @if ($invoice['invoice_currency'] == 'TOP') selected @endif>Tongan pa'anga</option>
										<option value="TTD" @if ($invoice['invoice_currency'] == 'TTD') selected @endif>Trinidad & Tobago Dollar</option>
										<option value="TND" @if ($invoice['invoice_currency'] == 'TND') selected @endif>Tunisian Dinar</option>
										<option value="TRY" @if ($invoice['invoice_currency'] == 'TRY') selected @endif>Turkish Lira</option>
										<option value="TMT" @if ($invoice['invoice_currency'] == 'TMT') selected @endif>Turkmenistani Manat</option>
										<option value="UGX" @if ($invoice['invoice_currency'] == 'UGZ') selected @endif>Ugandan Shilling</option>
										<option value="UAH" @if ($invoice['invoice_currency'] == 'UAH') selected @endif>Ukrainian Hryvnia</option>
										<option value="AED" @if ($invoice['invoice_currency'] == 'AED') selected @endif>United Arab Emirates Dirham</option>
										<option value="UYU" @if ($invoice['invoice_currency'] == 'UYU') selected @endif>Uruguayan Peso</option>
										<option value="USD" @if ($invoice['invoice_currency'] == 'USD') selected @endif>US Dollar</option>
										<option value="UZS" @if ($invoice['invoice_currency'] == 'UZS') selected @endif>Uzbekistan Som</option>
										<option value="VUV" @if ($invoice['invoice_currency'] == 'VUV') selected @endif>Vanuatu Vatu</option>
										<option value="VEF" @if ($invoice['invoice_currency'] == 'VEF') selected @endif>Venezuelan BolÃ­var</option>
										<option value="VND" @if ($invoice['invoice_currency'] == 'VND') selected @endif>Vietnamese Dong</option>
										<option value="YER" @if ($invoice['invoice_currency'] == 'YER') selected @endif>Yemeni Rial</option>
										<option value="ZMK" @if ($invoice['invoice_currency'] == 'ZMK') selected @endif>Zambian Kwacha</option>
									</select>
								</div> 							
							</div>

							<div class="col-md-6 col-sm-12">							
								<div class="input-box">	
									<h6>{{ __('Invoice Language') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
			  						<select id="invoice-language" name="invoice_language" data-placeholder="{{ __('Select Language') }}:">			
										<option value="br" @if ($invoice['invoice_language'] == 'br') selected @endif>BR</option>
										<option value="de" @if ($invoice['invoice_language'] == 'de') selected @endif>DE</option>
										<option value="en" @if ($invoice['invoice_language'] == 'en') selected @endif>EN</option>
										<option value="es" @if ($invoice['invoice_language'] == 'es') selected @endif>ES</option>
										<option value="et" @if ($invoice['invoice_language'] == 'et') selected @endif>ET</option>
										<option value="fr" @if ($invoice['invoice_language'] == 'fr') selected @endif>FR</option>
										<option value="it" @if ($invoice['invoice_language'] == 'it') selected @endif>IT</option>
										<option value="lt" @if ($invoice['invoice_language'] == 'lt') selected @endif>LT</option>
										<option value="nl" @if ($invoice['invoice_language'] == 'nl') selected @endif>NL</option>
										<option value="pl" @if ($invoice['invoice_language'] == 'pl') selected @endif>PL</option>
										<option value="ro" @if ($invoice['invoice_language'] == 'ro') selected @endif>RO</option>
										<option value="sv" @if ($invoice['invoice_language'] == 'sv') selected @endif>SV</option>
										<option value="tr" @if ($invoice['invoice_language'] == 'tr') selected @endif>TR</option>
									</select>
								</div> 							
							</div>

							<div class="col-md-6 col-sm-12">
								<div class="input-box">								
									<h6>{{ __('Company Name') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('invoice_vendor') is-danger @enderror" id="invoice_vendor" name="invoice_vendor" value="{{ $invoice['invoice_vendor'] }}" required>
										@error('invoice_vendor')
											<p class="text-danger">{{ $errors->first('invoice_vendor') }}</p>
										@enderror
									</div> 
								</div> 						
							</div>

							<div class="col-md-6 col-sm-12">
								<div class="input-box">								
									<h6>{{ __('Company Website') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('invoice_vendor_website') is-danger @enderror" id="invoice_vendor_website" name="invoice_vendor_website" value="{{ $invoice['invoice_vendor_website'] }}">
										@error('invoice_vendor_website')
											<p class="text-danger">{{ $errors->first('invoice_vendor_website') }}</p>
										@enderror
									</div> 
								</div> 						
							</div>

							<div class="col-12">
								<div class="input-box">								
									<h6>{{ __('Business Address') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('invoice_address') is-danger @enderror" id="invoice_address" name="invoice_address" value="{{ $invoice['invoice_address'] }}">
										@error('invoice_address')
											<p class="text-danger">{{ $errors->first('invoice_address') }}</p>
										@enderror
									</div> 
								</div> 						
							</div>

							<div class="col-md-4 col-sm-12">
								<div class="input-box">								
									<h6>{{ __('City') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('invoice_city') is-danger @enderror" id="invoice_city" name="invoice_city" value="{{ $invoice['invoice_city'] }}">
										@error('invoice_city')
											<p class="text-danger">{{ $errors->first('invoice_city') }}</p>
										@enderror
									</div> 
								</div> 						
							</div>

							<div class="col-md-2 col-sm-12">
								<div class="input-box">								
									<h6>{{ __('State') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('invoice_state') is-danger @enderror" id="invoice_state" name="invoice_state" value="{{ $invoice['invoice_state'] }}">
										@error('invoice_state')
											<p class="text-danger">{{ $errors->first('invoice_state') }}</p>
										@enderror
									</div> 
								</div> 						
							</div>

							<div class="col-md-2 col-sm-12">
								<div class="input-box">								
									<h6>{{ __('Postal Code') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('invoice_postal_code') is-danger @enderror" id="invoice_postal_code" name="invoice_postal_code" value="{{ $invoice['invoice_postal_code'] }}">
										@error('invoice_postal_code')
											<p class="text-danger">{{ $errors->first('invoice_postal_code') }}</p>
										@enderror
									</div> 
								</div> 						
							</div>

							<div class="col-md-4 col-sm-12">							
								<div class="input-box">	
									<h6>{{ __('Country') }}</h6>
									<select id="invoice-country" name="invoice_country" data-placeholder="{{ __('Select Invoice Country') }}:">	
										@foreach(config('countries') as $value)
											<option value="{{ $value }}" @if($invoice['invoice_country'] == $value) selected @endif>{{ $value }}</option>
										@endforeach																			
									</select>
									@error('invoice_country')
										<p class="text-danger">{{ $errors->first('invoice_country') }}</p>
									@enderror
								</div> 							
							</div>

							<div class="col-md-6 col-sm-12">
								<div class="input-box">								
									<h6>{{ __('Phone Number') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('invoice_phone') is-danger @enderror" id="invoice_phone" name="invoice_phone" value="{{ $invoice['invoice_phone'] }}">
										@error('invoice_phone')
											<p class="text-danger">{{ $errors->first('invoice_phone') }}</p>
										@enderror
									</div> 
								</div> 						
							</div>

							<div class="col-md-6 col-sm-12">
								<div class="input-box">								
									<h6>{{ __('VAT Number') }}</h6>
									<div class="form-group">							    
										<input type="text" class="form-control @error('invoice_vat_number') is-danger @enderror" id="invoice_vat_number" name="invoice_vat_number" value="{{ $invoice['invoice_vat_number'] }}">
										@error('invoice_vat_number')
											<p class="text-danger">{{ $errors->first('invoice_vat_number') }}</p>
										@enderror
									</div> 
								</div> 						
							</div>

						</div>

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<a href="{{ route('admin.finance.dashboard') }}" class="btn btn-cancel mr-2">{{ __('Cancel') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('Save') }}</button>							
						</div>				

					</form>					
				</div>
			</div>
		</div>
	</div>
	
@endsection
