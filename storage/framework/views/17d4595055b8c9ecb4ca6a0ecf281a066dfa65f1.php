

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Invoice Settings')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa-solid fa-sack-dollar mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.finance.dashboard')); ?>"> <?php echo e(__('Finance Management')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> <?php echo e(__('Invoice Settings')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>					
	<div class="row">
		<div class="col-lg-8 col-md-12 col-xm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('Setup Invoice Settings')); ?></h3>
				</div>
				<div class="card-body">
									
					<form action="<?php echo e(route('admin.settings.invoice.store')); ?>" method="POST" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>				

						<div class="row">		
							<div class="col-md-6 col-sm-12">							
								<div class="input-box">	
									<h6><?php echo e(__('Invoice Currency')); ?> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<select id="invoice-currency" name="invoice_currency" data-placeholder="<?php echo e(__('Select Currency')); ?>:">			
										<option value="AFA" <?php if($invoice['invoice_currency'] == 'AFA'): ?> selected <?php endif; ?>>Afghan Afghani</option>
										<option value="ALL" <?php if($invoice['invoice_currency'] == 'ALL'): ?> selected <?php endif; ?>>Albanian Lek</option>
										<option value="DZD" <?php if($invoice['invoice_currency'] == 'DZD'): ?> selected <?php endif; ?>>Algerian Dinar</option>
										<option value="AOA" <?php if($invoice['invoice_currency'] == 'AOA'): ?> selected <?php endif; ?>>Angolan Kwanza</option>
										<option value="ARS" <?php if($invoice['invoice_currency'] == 'AFA'): ?> selected <?php endif; ?>>Argentine Peso</option>
										<option value="AMD" <?php if($invoice['invoice_currency'] == 'AFA'): ?> selected <?php endif; ?>>Armenian Dram</option>
										<option value="AWG" <?php if($invoice['invoice_currency'] == 'AFA'): ?> selected <?php endif; ?>>Aruban Florin</option>
										<option value="AUD" <?php if($invoice['invoice_currency'] == 'AFA'): ?> selected <?php endif; ?>>Australian Dollar</option>
										<option value="AZN" <?php if($invoice['invoice_currency'] == 'AFA'): ?> selected <?php endif; ?>>Azerbaijani Manat</option>
										<option value="BSD" <?php if($invoice['invoice_currency'] == 'BSD'): ?> selected <?php endif; ?>>Bahamian Dollar</option>
										<option value="BHD" <?php if($invoice['invoice_currency'] == 'BHD'): ?> selected <?php endif; ?>>Bahraini Dinar</option>
										<option value="BDT" <?php if($invoice['invoice_currency'] == 'BDT'): ?> selected <?php endif; ?>>Bangladeshi Taka</option>
										<option value="BBD" <?php if($invoice['invoice_currency'] == 'BBD'): ?> selected <?php endif; ?>>Barbadian Dollar</option>
										<option value="BYR" <?php if($invoice['invoice_currency'] == 'BYR'): ?> selected <?php endif; ?>>Belarusian Ruble</option>
										<option value="BEF" <?php if($invoice['invoice_currency'] == 'BEF'): ?> selected <?php endif; ?>>Belgian Franc</option>
										<option value="BZD" <?php if($invoice['invoice_currency'] == 'BZD'): ?> selected <?php endif; ?>>Belize Dollar</option>
										<option value="BMD" <?php if($invoice['invoice_currency'] == 'BMD'): ?> selected <?php endif; ?>>Bermudan Dollar</option>
										<option value="BTN" <?php if($invoice['invoice_currency'] == 'BTN'): ?> selected <?php endif; ?>>Bhutanese Ngultrum</option>
										<option value="BOB" <?php if($invoice['invoice_currency'] == 'BOB'): ?> selected <?php endif; ?>>Bolivian Boliviano</option>
										<option value="BAM" <?php if($invoice['invoice_currency'] == 'BAM'): ?> selected <?php endif; ?>>Bosnia-Herzegovina Convertible Mark</option>
										<option value="BWP" <?php if($invoice['invoice_currency'] == 'BWP'): ?> selected <?php endif; ?>>Botswanan Pula</option>
										<option value="BRL" <?php if($invoice['invoice_currency'] == 'BRL'): ?> selected <?php endif; ?>>Brazilian Real</option>
										<option value="GBP" <?php if($invoice['invoice_currency'] == 'GBP'): ?> selected <?php endif; ?>>British Pound Sterling</option>
										<option value="BND" <?php if($invoice['invoice_currency'] == 'BND'): ?> selected <?php endif; ?>>Brunei Dollar</option>
										<option value="BGN" <?php if($invoice['invoice_currency'] == 'BGN'): ?> selected <?php endif; ?>>Bulgarian Lev</option>
										<option value="BIF" <?php if($invoice['invoice_currency'] == 'BIF'): ?> selected <?php endif; ?>>Burundian Franc</option>
										<option value="KHR" <?php if($invoice['invoice_currency'] == 'KHR'): ?> selected <?php endif; ?>>Cambodian Riel</option>
										<option value="CAD" <?php if($invoice['invoice_currency'] == 'CAD'): ?> selected <?php endif; ?>>Canadian Dollar</option>
										<option value="CVE" <?php if($invoice['invoice_currency'] == 'CVE'): ?> selected <?php endif; ?>>Cape Verdean Escudo</option>
										<option value="KYD" <?php if($invoice['invoice_currency'] == 'KYD'): ?> selected <?php endif; ?>>Cayman Islands Dollar</option>
										<option value="XOF" <?php if($invoice['invoice_currency'] == 'XOF'): ?> selected <?php endif; ?>>CFA Franc BCEAO</option>
										<option value="XAF" <?php if($invoice['invoice_currency'] == 'XAF'): ?> selected <?php endif; ?>>CFA Franc BEAC</option>
										<option value="XPF" <?php if($invoice['invoice_currency'] == 'XPF'): ?> selected <?php endif; ?>>CFP Franc</option>
										<option value="CLP" <?php if($invoice['invoice_currency'] == 'CLP'): ?> selected <?php endif; ?>>Chilean Peso</option>
										<option value="CNY" <?php if($invoice['invoice_currency'] == 'CNY'): ?> selected <?php endif; ?>>Chinese Yuan</option>
										<option value="COP" <?php if($invoice['invoice_currency'] == 'COP'): ?> selected <?php endif; ?>>Colombian Peso</option>
										<option value="KMF" <?php if($invoice['invoice_currency'] == 'KMF'): ?> selected <?php endif; ?>>Comorian Franc</option>
										<option value="CDF" <?php if($invoice['invoice_currency'] == 'CDF'): ?> selected <?php endif; ?>>Congolese Franc</option>
										<option value="CRC" <?php if($invoice['invoice_currency'] == 'CRC'): ?> selected <?php endif; ?>>Costa Rican ColÃ³n</option>
										<option value="HRK" <?php if($invoice['invoice_currency'] == 'HRK'): ?> selected <?php endif; ?>>Croatian Kuna</option>
										<option value="CUC" <?php if($invoice['invoice_currency'] == 'CUC'): ?> selected <?php endif; ?>>Cuban Convertible Peso</option>
										<option value="CZK" <?php if($invoice['invoice_currency'] == 'CZK'): ?> selected <?php endif; ?>>Czech Republic Koruna</option>
										<option value="DKK" <?php if($invoice['invoice_currency'] == 'DKK'): ?> selected <?php endif; ?>>Danish Krone</option>
										<option value="DJF" <?php if($invoice['invoice_currency'] == 'DJF'): ?> selected <?php endif; ?>>Djiboutian Franc</option>
										<option value="DOP" <?php if($invoice['invoice_currency'] == 'DOP'): ?> selected <?php endif; ?>>Dominican Peso</option>
										<option value="XCD" <?php if($invoice['invoice_currency'] == 'XCD'): ?> selected <?php endif; ?>>East Caribbean Dollar</option>
										<option value="EGP" <?php if($invoice['invoice_currency'] == 'EGP'): ?> selected <?php endif; ?>>Egyptian Pound</option>
										<option value="ERN" <?php if($invoice['invoice_currency'] == 'ERN'): ?> selected <?php endif; ?>>Eritrean Nakfa</option>
										<option value="EEK" <?php if($invoice['invoice_currency'] == 'EEK'): ?> selected <?php endif; ?>>Estonian Kroon</option>
										<option value="ETB" <?php if($invoice['invoice_currency'] == 'ETB'): ?> selected <?php endif; ?>>Ethiopian Birr</option>
										<option value="EUR" <?php if($invoice['invoice_currency'] == 'EUR'): ?> selected <?php endif; ?>>Euro</option>
										<option value="FKP" <?php if($invoice['invoice_currency'] == 'FKP'): ?> selected <?php endif; ?>>Falkland Islands Pound</option>
										<option value="FJD" <?php if($invoice['invoice_currency'] == 'FJD'): ?> selected <?php endif; ?>>Fijian Dollar</option>
										<option value="GMD" <?php if($invoice['invoice_currency'] == 'GMD'): ?> selected <?php endif; ?>>Gambian Dalasi</option>
										<option value="GEL" <?php if($invoice['invoice_currency'] == 'GEL'): ?> selected <?php endif; ?>>Georgian Lari</option>
										<option value="DEM" <?php if($invoice['invoice_currency'] == 'DEM'): ?> selected <?php endif; ?>>German Mark</option>
										<option value="GHS" <?php if($invoice['invoice_currency'] == 'GHS'): ?> selected <?php endif; ?>>Ghanaian Cedi</option>
										<option value="GIP" <?php if($invoice['invoice_currency'] == 'GIP'): ?> selected <?php endif; ?>>Gibraltar Pound</option>
										<option value="GRD" <?php if($invoice['invoice_currency'] == 'GRD'): ?> selected <?php endif; ?>>Greek Drachma</option>
										<option value="GTQ" <?php if($invoice['invoice_currency'] == 'GTQ'): ?> selected <?php endif; ?>>Guatemalan Quetzal</option>
										<option value="GNF" <?php if($invoice['invoice_currency'] == 'GNF'): ?> selected <?php endif; ?>>Guinean Franc</option>
										<option value="GYD" <?php if($invoice['invoice_currency'] == 'GYD'): ?> selected <?php endif; ?>>Guyanaese Dollar</option>
										<option value="HTG" <?php if($invoice['invoice_currency'] == 'HTG'): ?> selected <?php endif; ?>>Haitian Gourde</option>
										<option value="HNL" <?php if($invoice['invoice_currency'] == 'HNL'): ?> selected <?php endif; ?>>Honduran Lempira</option>
										<option value="HKD" <?php if($invoice['invoice_currency'] == 'HKD'): ?> selected <?php endif; ?>>Hong Kong Dollar</option>
										<option value="HUF" <?php if($invoice['invoice_currency'] == 'HUF'): ?> selected <?php endif; ?>>Hungarian Forint</option>
										<option value="ISK" <?php if($invoice['invoice_currency'] == 'ISK'): ?> selected <?php endif; ?>>Icelandic KrÃ³na</option>
										<option value="INR" <?php if($invoice['invoice_currency'] == 'INR'): ?> selected <?php endif; ?>>Indian Rupee</option>
										<option value="IDR" <?php if($invoice['invoice_currency'] == 'IDR'): ?> selected <?php endif; ?>>Indonesian Rupiah</option>
										<option value="IRR" <?php if($invoice['invoice_currency'] == 'IRR'): ?> selected <?php endif; ?>>Iranian Rial</option>
										<option value="IQD" <?php if($invoice['invoice_currency'] == 'IQD'): ?> selected <?php endif; ?>>Iraqi Dinar</option>
										<option value="ILS" <?php if($invoice['invoice_currency'] == 'ILS'): ?> selected <?php endif; ?>>Israeli New Sheqel</option>
										<option value="ITL" <?php if($invoice['invoice_currency'] == 'ITL'): ?> selected <?php endif; ?>>Italian Lira</option>
										<option value="JMD" <?php if($invoice['invoice_currency'] == 'JMD'): ?> selected <?php endif; ?>>Jamaican Dollar</option>
										<option value="JPY" <?php if($invoice['invoice_currency'] == 'JPY'): ?> selected <?php endif; ?>>Japanese Yen</option>
										<option value="JOD" <?php if($invoice['invoice_currency'] == 'JOD'): ?> selected <?php endif; ?>>Jordanian Dinar</option>
										<option value="KZT" <?php if($invoice['invoice_currency'] == 'KZT'): ?> selected <?php endif; ?>>Kazakhstani Tenge</option>
										<option value="KES" <?php if($invoice['invoice_currency'] == 'KES'): ?> selected <?php endif; ?>>Kenyan Shilling</option>
										<option value="KWD" <?php if($invoice['invoice_currency'] == 'KWD'): ?> selected <?php endif; ?>>Kuwaiti Dinar</option>
										<option value="KGS" <?php if($invoice['invoice_currency'] == 'KGS'): ?> selected <?php endif; ?>>Kyrgystani Som</option>
										<option value="LAK" <?php if($invoice['invoice_currency'] == 'LAK'): ?> selected <?php endif; ?>>Laotian Kip</option>
										<option value="LVL" <?php if($invoice['invoice_currency'] == 'LVL'): ?> selected <?php endif; ?>>Latvian Lats</option>
										<option value="LBP" <?php if($invoice['invoice_currency'] == 'LBP'): ?> selected <?php endif; ?>>Lebanese Pound</option>
										<option value="LSL" <?php if($invoice['invoice_currency'] == 'LSL'): ?> selected <?php endif; ?>>Lesotho Loti</option>
										<option value="LRD" <?php if($invoice['invoice_currency'] == 'LRD'): ?> selected <?php endif; ?>>Liberian Dollar</option>
										<option value="LYD" <?php if($invoice['invoice_currency'] == 'LYD'): ?> selected <?php endif; ?>>Libyan Dinar</option>
										<option value="LTL" <?php if($invoice['invoice_currency'] == 'LTL'): ?> selected <?php endif; ?>>Lithuanian Litas</option>
										<option value="MOP" <?php if($invoice['invoice_currency'] == 'MOP'): ?> selected <?php endif; ?>>Macanese Pataca</option>
										<option value="MKD" <?php if($invoice['invoice_currency'] == 'MKD'): ?> selected <?php endif; ?>>Macedonian Denar</option>
										<option value="MGA" <?php if($invoice['invoice_currency'] == 'MGA'): ?> selected <?php endif; ?>>Malagasy Ariary</option>
										<option value="MWK" <?php if($invoice['invoice_currency'] == 'MWK'): ?> selected <?php endif; ?>>Malawian Kwacha</option>
										<option value="MYR" <?php if($invoice['invoice_currency'] == 'MYR'): ?> selected <?php endif; ?>>Malaysian Ringgit</option>
										<option value="MVR" <?php if($invoice['invoice_currency'] == 'MVR'): ?> selected <?php endif; ?>>Maldivian Rufiyaa</option>
										<option value="MRO" <?php if($invoice['invoice_currency'] == 'MRO'): ?> selected <?php endif; ?>>Mauritanian Ouguiya</option>
										<option value="MUR" <?php if($invoice['invoice_currency'] == 'MUR'): ?> selected <?php endif; ?>>Mauritian Rupee</option>
										<option value="MXN" <?php if($invoice['invoice_currency'] == 'MXN'): ?> selected <?php endif; ?>>Mexican Peso</option>
										<option value="MDL" <?php if($invoice['invoice_currency'] == 'MDL'): ?> selected <?php endif; ?>>Moldovan Leu</option>
										<option value="MNT" <?php if($invoice['invoice_currency'] == 'MNT'): ?> selected <?php endif; ?>>Mongolian Tugrik</option>
										<option value="MAD" <?php if($invoice['invoice_currency'] == 'MAD'): ?> selected <?php endif; ?>>Moroccan Dirham</option>
										<option value="MZM" <?php if($invoice['invoice_currency'] == 'MZM'): ?> selected <?php endif; ?>>Mozambican Metical</option>
										<option value="MMK" <?php if($invoice['invoice_currency'] == 'MMK'): ?> selected <?php endif; ?>>Myanmar Kyat</option>
										<option value="NAD" <?php if($invoice['invoice_currency'] == 'NAD'): ?> selected <?php endif; ?>>Namibian Dollar</option>
										<option value="NPR" <?php if($invoice['invoice_currency'] == 'NPR'): ?> selected <?php endif; ?>>Nepalese Rupee</option>
										<option value="ANG" <?php if($invoice['invoice_currency'] == 'ANG'): ?> selected <?php endif; ?>>Netherlands Antillean Guilder</option>
										<option value="TWD" <?php if($invoice['invoice_currency'] == 'TWD'): ?> selected <?php endif; ?>>New Taiwan Dollar</option>
										<option value="NZD" <?php if($invoice['invoice_currency'] == 'NZD'): ?> selected <?php endif; ?>>New Zealand Dollar</option>
										<option value="NIO" <?php if($invoice['invoice_currency'] == 'NIO'): ?> selected <?php endif; ?>>Nicaraguan CÃ³rdoba</option>
										<option value="NGN" <?php if($invoice['invoice_currency'] == 'NGN'): ?> selected <?php endif; ?>>Nigerian Naira</option>
										<option value="KPW" <?php if($invoice['invoice_currency'] == 'KPW'): ?> selected <?php endif; ?>>North Korean Won</option>
										<option value="NOK" <?php if($invoice['invoice_currency'] == 'NOK'): ?> selected <?php endif; ?>>Norwegian Krone</option>
										<option value="OMR" <?php if($invoice['invoice_currency'] == 'OMR'): ?> selected <?php endif; ?>>Omani Rial</option>
										<option value="PKR" <?php if($invoice['invoice_currency'] == 'PKR'): ?> selected <?php endif; ?>>Pakistani Rupee</option>
										<option value="PAB" <?php if($invoice['invoice_currency'] == 'PAB'): ?> selected <?php endif; ?>>Panamanian Balboa</option>
										<option value="PGK" <?php if($invoice['invoice_currency'] == 'PGK'): ?> selected <?php endif; ?>>Papua New Guinean Kina</option>
										<option value="PYG" <?php if($invoice['invoice_currency'] == 'PYG'): ?> selected <?php endif; ?>>Paraguayan Guarani</option>
										<option value="PEN" <?php if($invoice['invoice_currency'] == 'PEN'): ?> selected <?php endif; ?>>Peruvian Nuevo Sol</option>
										<option value="PHP" <?php if($invoice['invoice_currency'] == 'PHP'): ?> selected <?php endif; ?>>Philippine Peso</option>
										<option value="PLN" <?php if($invoice['invoice_currency'] == 'PLN'): ?> selected <?php endif; ?>>Polish Zloty</option>
										<option value="QAR" <?php if($invoice['invoice_currency'] == 'QAR'): ?> selected <?php endif; ?>>Qatari Rial</option>
										<option value="RON" <?php if($invoice['invoice_currency'] == 'RON'): ?> selected <?php endif; ?>>Romanian Leu</option>
										<option value="RUB" <?php if($invoice['invoice_currency'] == 'RUB'): ?> selected <?php endif; ?>>Russian Ruble</option>
										<option value="RWF" <?php if($invoice['invoice_currency'] == 'RWF'): ?> selected <?php endif; ?>>Rwandan Franc</option>
										<option value="SVC" <?php if($invoice['invoice_currency'] == 'SVC'): ?> selected <?php endif; ?>>Salvadoran ColÃ³n</option>
										<option value="WST" <?php if($invoice['invoice_currency'] == 'WST'): ?> selected <?php endif; ?>>Samoan Tala</option>
										<option value="SAR" <?php if($invoice['invoice_currency'] == 'SAR'): ?> selected <?php endif; ?>>Saudi Riyal</option>
										<option value="RSD" <?php if($invoice['invoice_currency'] == 'RSD'): ?> selected <?php endif; ?>>Serbian Dinar</option>
										<option value="SCR" <?php if($invoice['invoice_currency'] == 'SCR'): ?> selected <?php endif; ?>>Seychellois Rupee</option>
										<option value="SLL" <?php if($invoice['invoice_currency'] == 'SLL'): ?> selected <?php endif; ?>>Sierra Leonean Leone</option>
										<option value="SGD" <?php if($invoice['invoice_currency'] == 'SGD'): ?> selected <?php endif; ?>>Singapore Dollar</option>
										<option value="SKK" <?php if($invoice['invoice_currency'] == 'SKK'): ?> selected <?php endif; ?>>Slovak Koruna</option>
										<option value="SBD" <?php if($invoice['invoice_currency'] == 'SBD'): ?> selected <?php endif; ?>>Solomon Islands Dollar</option>
										<option value="SOS" <?php if($invoice['invoice_currency'] == 'SOS'): ?> selected <?php endif; ?>>Somali Shilling</option>
										<option value="ZAR" <?php if($invoice['invoice_currency'] == 'ZAR'): ?> selected <?php endif; ?>>South African Rand</option>
										<option value="KRW" <?php if($invoice['invoice_currency'] == 'KRW'): ?> selected <?php endif; ?>>South Korean Won</option>
										<option value="XDR" <?php if($invoice['invoice_currency'] == 'XDR'): ?> selected <?php endif; ?>>Special Drawing Rights</option>
										<option value="LKR" <?php if($invoice['invoice_currency'] == 'LKR'): ?> selected <?php endif; ?>>Sri Lankan Rupee</option>
										<option value="SHP" <?php if($invoice['invoice_currency'] == 'SHP'): ?> selected <?php endif; ?>>St. Helena Pound</option>
										<option value="SDG" <?php if($invoice['invoice_currency'] == 'SDG'): ?> selected <?php endif; ?>>Sudanese Pound</option>
										<option value="SRD" <?php if($invoice['invoice_currency'] == 'SRD'): ?> selected <?php endif; ?>>Surinamese Dollar</option>
										<option value="SZL" <?php if($invoice['invoice_currency'] == 'SZL'): ?> selected <?php endif; ?>>Swazi Lilangeni</option>
										<option value="SEK" <?php if($invoice['invoice_currency'] == 'SEK'): ?> selected <?php endif; ?>>Swedish Krona</option>
										<option value="CHF" <?php if($invoice['invoice_currency'] == 'CHF'): ?> selected <?php endif; ?>>Swiss Franc</option>
										<option value="SYP" <?php if($invoice['invoice_currency'] == 'SYP'): ?> selected <?php endif; ?>>Syrian Pound</option>
										<option value="STD" <?php if($invoice['invoice_currency'] == 'STD'): ?> selected <?php endif; ?>>São Tomé and Príncipe Dobra</option>
										<option value="TJS" <?php if($invoice['invoice_currency'] == 'TJS'): ?> selected <?php endif; ?>>Tajikistani Somoni</option>
										<option value="TZS" <?php if($invoice['invoice_currency'] == 'TZS'): ?> selected <?php endif; ?>>Tanzanian Shilling</option>
										<option value="THB" <?php if($invoice['invoice_currency'] == 'THB'): ?> selected <?php endif; ?>>Thai Baht</option>
										<option value="TOP" <?php if($invoice['invoice_currency'] == 'TOP'): ?> selected <?php endif; ?>>Tongan pa'anga</option>
										<option value="TTD" <?php if($invoice['invoice_currency'] == 'TTD'): ?> selected <?php endif; ?>>Trinidad & Tobago Dollar</option>
										<option value="TND" <?php if($invoice['invoice_currency'] == 'TND'): ?> selected <?php endif; ?>>Tunisian Dinar</option>
										<option value="TRY" <?php if($invoice['invoice_currency'] == 'TRY'): ?> selected <?php endif; ?>>Turkish Lira</option>
										<option value="TMT" <?php if($invoice['invoice_currency'] == 'TMT'): ?> selected <?php endif; ?>>Turkmenistani Manat</option>
										<option value="UGX" <?php if($invoice['invoice_currency'] == 'UGZ'): ?> selected <?php endif; ?>>Ugandan Shilling</option>
										<option value="UAH" <?php if($invoice['invoice_currency'] == 'UAH'): ?> selected <?php endif; ?>>Ukrainian Hryvnia</option>
										<option value="AED" <?php if($invoice['invoice_currency'] == 'AED'): ?> selected <?php endif; ?>>United Arab Emirates Dirham</option>
										<option value="UYU" <?php if($invoice['invoice_currency'] == 'UYU'): ?> selected <?php endif; ?>>Uruguayan Peso</option>
										<option value="USD" <?php if($invoice['invoice_currency'] == 'USD'): ?> selected <?php endif; ?>>US Dollar</option>
										<option value="UZS" <?php if($invoice['invoice_currency'] == 'UZS'): ?> selected <?php endif; ?>>Uzbekistan Som</option>
										<option value="VUV" <?php if($invoice['invoice_currency'] == 'VUV'): ?> selected <?php endif; ?>>Vanuatu Vatu</option>
										<option value="VEF" <?php if($invoice['invoice_currency'] == 'VEF'): ?> selected <?php endif; ?>>Venezuelan BolÃ­var</option>
										<option value="VND" <?php if($invoice['invoice_currency'] == 'VND'): ?> selected <?php endif; ?>>Vietnamese Dong</option>
										<option value="YER" <?php if($invoice['invoice_currency'] == 'YER'): ?> selected <?php endif; ?>>Yemeni Rial</option>
										<option value="ZMK" <?php if($invoice['invoice_currency'] == 'ZMK'): ?> selected <?php endif; ?>>Zambian Kwacha</option>
									</select>
								</div> 							
							</div>

							<div class="col-md-6 col-sm-12">							
								<div class="input-box">	
									<h6><?php echo e(__('Invoice Language')); ?> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
			  						<select id="invoice-language" name="invoice_language" data-placeholder="<?php echo e(__('Select Language')); ?>:">			
										<option value="br" <?php if($invoice['invoice_language'] == 'br'): ?> selected <?php endif; ?>>BR</option>
										<option value="de" <?php if($invoice['invoice_language'] == 'de'): ?> selected <?php endif; ?>>DE</option>
										<option value="en" <?php if($invoice['invoice_language'] == 'en'): ?> selected <?php endif; ?>>EN</option>
										<option value="es" <?php if($invoice['invoice_language'] == 'es'): ?> selected <?php endif; ?>>ES</option>
										<option value="et" <?php if($invoice['invoice_language'] == 'et'): ?> selected <?php endif; ?>>ET</option>
										<option value="fr" <?php if($invoice['invoice_language'] == 'fr'): ?> selected <?php endif; ?>>FR</option>
										<option value="it" <?php if($invoice['invoice_language'] == 'it'): ?> selected <?php endif; ?>>IT</option>
										<option value="lt" <?php if($invoice['invoice_language'] == 'lt'): ?> selected <?php endif; ?>>LT</option>
										<option value="nl" <?php if($invoice['invoice_language'] == 'nl'): ?> selected <?php endif; ?>>NL</option>
										<option value="pl" <?php if($invoice['invoice_language'] == 'pl'): ?> selected <?php endif; ?>>PL</option>
										<option value="ro" <?php if($invoice['invoice_language'] == 'ro'): ?> selected <?php endif; ?>>RO</option>
										<option value="sv" <?php if($invoice['invoice_language'] == 'sv'): ?> selected <?php endif; ?>>SV</option>
										<option value="tr" <?php if($invoice['invoice_language'] == 'tr'): ?> selected <?php endif; ?>>TR</option>
									</select>
								</div> 							
							</div>

							<div class="col-md-6 col-sm-12">
								<div class="input-box">								
									<h6><?php echo e(__('Company Name')); ?> <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['invoice_vendor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="invoice_vendor" name="invoice_vendor" value="<?php echo e($invoice['invoice_vendor']); ?>" required>
										<?php $__errorArgs = ['invoice_vendor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('invoice_vendor')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 						
							</div>

							<div class="col-md-6 col-sm-12">
								<div class="input-box">								
									<h6><?php echo e(__('Company Website')); ?></h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['invoice_vendor_website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="invoice_vendor_website" name="invoice_vendor_website" value="<?php echo e($invoice['invoice_vendor_website']); ?>">
										<?php $__errorArgs = ['invoice_vendor_website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('invoice_vendor_website')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 						
							</div>

							<div class="col-12">
								<div class="input-box">								
									<h6><?php echo e(__('Business Address')); ?></h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['invoice_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="invoice_address" name="invoice_address" value="<?php echo e($invoice['invoice_address']); ?>">
										<?php $__errorArgs = ['invoice_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('invoice_address')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 						
							</div>

							<div class="col-md-4 col-sm-12">
								<div class="input-box">								
									<h6><?php echo e(__('City')); ?></h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['invoice_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="invoice_city" name="invoice_city" value="<?php echo e($invoice['invoice_city']); ?>">
										<?php $__errorArgs = ['invoice_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('invoice_city')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 						
							</div>

							<div class="col-md-2 col-sm-12">
								<div class="input-box">								
									<h6><?php echo e(__('State')); ?></h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['invoice_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="invoice_state" name="invoice_state" value="<?php echo e($invoice['invoice_state']); ?>">
										<?php $__errorArgs = ['invoice_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('invoice_state')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 						
							</div>

							<div class="col-md-2 col-sm-12">
								<div class="input-box">								
									<h6><?php echo e(__('Postal Code')); ?></h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['invoice_postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="invoice_postal_code" name="invoice_postal_code" value="<?php echo e($invoice['invoice_postal_code']); ?>">
										<?php $__errorArgs = ['invoice_postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('invoice_postal_code')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 						
							</div>

							<div class="col-md-4 col-sm-12">							
								<div class="input-box">	
									<h6><?php echo e(__('Country')); ?></h6>
									<select id="invoice-country" name="invoice_country" data-placeholder="<?php echo e(__('Select Invoice Country')); ?>:">	
										<?php $__currentLoopData = config('countries'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($value); ?>" <?php if($invoice['invoice_country'] == $value): ?> selected <?php endif; ?>><?php echo e($value); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>																			
									</select>
									<?php $__errorArgs = ['invoice_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<p class="text-danger"><?php echo e($errors->first('invoice_country')); ?></p>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div> 							
							</div>

							<div class="col-md-6 col-sm-12">
								<div class="input-box">								
									<h6><?php echo e(__('Phone Number')); ?></h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['invoice_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="invoice_phone" name="invoice_phone" value="<?php echo e($invoice['invoice_phone']); ?>">
										<?php $__errorArgs = ['invoice_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('invoice_phone')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 						
							</div>

							<div class="col-md-6 col-sm-12">
								<div class="input-box">								
									<h6><?php echo e(__('VAT Number')); ?></h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['invoice_vat_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="invoice_vat_number" name="invoice_vat_number" value="<?php echo e($invoice['invoice_vat_number']); ?>">
										<?php $__errorArgs = ['invoice_vat_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('invoice_vat_number')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 						
							</div>

						</div>

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<a href="<?php echo e(route('admin.finance.dashboard')); ?>" class="btn btn-cancel mr-2"><?php echo e(__('Cancel')); ?></a>
							<button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>							
						</div>				

					</form>					
				</div>
			</div>
		</div>
	</div>
	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/admin/finance/invoice/index.blade.php ENDPATH**/ ?>