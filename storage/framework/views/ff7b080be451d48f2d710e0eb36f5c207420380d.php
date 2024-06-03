

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"> <?php echo e(__('Global Settings')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-sliders mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('General Settings')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('Global Settings')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>					
	<div class="row">
		<div class="col-lg-8 col-md-12 col-xm-12">
			<div class="card overflow-hidden border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('Setup Global Settings')); ?></h3>
				</div>
				<div class="card-body">
							
					<form action="<?php echo e(route('admin.settings.global.store')); ?>" method="POST" enctype="multipart/form-data">
						<?php echo csrf_field(); ?>

						<div class="card border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><?php echo e(__('General Settings')); ?></h6>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6><?php echo e(__('Website Name')); ?></h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['site-name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="site-name" name="site-name" value="<?php echo e(config('app.name')); ?>" autocomplete="off">
												<?php $__errorArgs = ['site-name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
													<p class="text-danger"><?php echo e($errors->first('site-name')); ?></p>
												<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
											</div> 
										</div> 
									</div>	
									
									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6><?php echo e(__('Website URL')); ?></h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['site-website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="site-website" name="site-website" value="<?php echo e(config('app.url')); ?>" autocomplete="off">
												<?php $__errorArgs = ['site-website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
													<p class="text-danger"><?php echo e($errors->first('site-website')); ?></p>
												<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
											</div> 
										</div> 
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6><?php echo e(__('Website Email Address')); ?></h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['site-email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="site-email" name="site-email" value="<?php echo e(config('app.email')); ?>" autocomplete="off">
												<?php $__errorArgs = ['site-email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
													<p class="text-danger"><?php echo e($errors->first('site-email')); ?></p>
												<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
											</div> 
										</div> 
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6><?php echo e(__('Time Zone')); ?></h6>
											<select id="time-zone" name="time-zone" data-placeholder="Select Time Zone">
												<option value="Pacific/Midway" <?php if(config('app.timezone') == 'Pacific/Midway'): ?> selected <?php endif; ?>>(UTC-11:00) Midway</option>
												<option value="Pacific/Niue" <?php if(config('app.timezone') == 'Pacific/Niue'): ?> selected <?php endif; ?>>(UTC-11:00) Niue</option>
												<option value="Pacific/Pago_Pago" <?php if(config('app.timezone') == 'Pacific/Pago_Pago'): ?> selected <?php endif; ?>>(UTC-11:00) Pago Pago</option>
												<option value="America/Adak" <?php if(config('app.timezone') == 'America/Adak'): ?> selected <?php endif; ?>>(UTC-10:00) Adak</option>
												<option value="Pacific/Honolulu" <?php if(config('app.timezone') == 'Pacific/Honolulu'): ?> selected <?php endif; ?>>(UTC-10:00) Honolulu</option>
												<option value="Pacific/Johnston" <?php if(config('app.timezone') == 'Pacific/Johnston'): ?> selected <?php endif; ?>>(UTC-10:00) Johnston</option>
												<option value="Pacific/Rarotonga" <?php if(config('app.timezone') == 'Pacific/Rarotonga'): ?> selected <?php endif; ?>>(UTC-10:00) Rarotonga</option>
												<option value="Pacific/Tahiti" <?php if(config('app.timezone') == 'Pacific/Tahiti'): ?> selected <?php endif; ?>>(UTC-10:00) Tahiti</option>
												<option value="Pacific/Marquesas" <?php if(config('app.timezone') == 'Pacific/Marquesas'): ?> selected <?php endif; ?>>(UTC-09:30) Marquesas</option>
												<option value="America/Anchorage" <?php if(config('app.timezone') == 'America/Anchorage'): ?> selected <?php endif; ?>>(UTC-09:00) Anchorage</option>
												<option value="Pacific/Gambier" <?php if(config('app.timezone') == 'Pacific/Gambier'): ?> selected <?php endif; ?>>(UTC-09:00) Gambier</option>
												<option value="America/Juneau" <?php if(config('app.timezone') == 'America/Juneau'): ?> selected <?php endif; ?>>(UTC-09:00) Juneau</option>
												<option value="America/Nome" <?php if(config('app.timezone') == 'America/Nome'): ?> selected <?php endif; ?>>(UTC-09:00) Nome</option>
												<option value="America/Sitka" <?php if(config('app.timezone') == 'America/Sitka'): ?> selected <?php endif; ?>>(UTC-09:00) Sitka</option>
												<option value="America/Yakutat" <?php if(config('app.timezone') == 'America/Yakutat'): ?> selected <?php endif; ?>>(UTC-09:00) Yakutat</option>
												<option value="America/Dawson" <?php if(config('app.timezone') == 'America/Dawson'): ?> selected <?php endif; ?>>(UTC-08:00) Dawson</option>
												<option value="America/Los_Angeles" <?php if(config('app.timezone') == 'America/Los_Angeles'): ?> selected <?php endif; ?>>(UTC-08:00) Los Angeles</option>
												<option value="America/Metlakatla" <?php if(config('app.timezone') == 'America/Metlakatla'): ?> selected <?php endif; ?>>(UTC-08:00) Metlakatla</option>
												<option value="Pacific/Pitcairn" <?php if(config('app.timezone') == 'Pacific/Pitcairn'): ?> selected <?php endif; ?>>(UTC-08:00) Pitcairn</option>
												<option value="America/Santa_Isabel" <?php if(config('app.timezone') == 'America/Santa_Isabel'): ?> selected <?php endif; ?>>(UTC-08:00) Santa Isabel</option>
												<option value="America/Tijuana" <?php if(config('app.timezone') == 'America/Tijuana'): ?> selected <?php endif; ?>>(UTC-08:00) Tijuana</option>
												<option value="America/Vancouver" <?php if(config('app.timezone') == 'America/Vancouver'): ?> selected <?php endif; ?>>(UTC-08:00) Vancouver</option>
												<option value="America/Whitehorse" <?php if(config('app.timezone') == 'America/Whitehorse'): ?> selected <?php endif; ?>>(UTC-08:00) Whitehorse</option>
												<option value="America/Boise" <?php if(config('app.timezone') == 'America/Boise'): ?> selected <?php endif; ?>>(UTC-07:00) Boise</option>
												<option value="America/Cambridge_Bay" <?php if(config('app.timezone') == 'America/Cambridge_Bay'): ?> selected <?php endif; ?>>(UTC-07:00) Cambridge Bay</option>
												<option value="America/Chihuahua" <?php if(config('app.timezone') == 'America/Chihuahua'): ?> selected <?php endif; ?>>(UTC-07:00) Chihuahua</option>
												<option value="America/Creston" <?php if(config('app.timezone') == 'America/Creston'): ?> selected <?php endif; ?>>(UTC-07:00) Creston</option>
												<option value="America/Dawson_Creek" <?php if(config('app.timezone') == 'America/Dawson_Creek'): ?> selected <?php endif; ?>>(UTC-07:00) Dawson Creek</option>
												<option value="America/Denver" <?php if(config('app.timezone') == 'America/Denver'): ?> selected <?php endif; ?>>(UTC-07:00) Denver</option>
												<option value="America/Edmonton" <?php if(config('app.timezone') == 'America/Edmonton'): ?> selected <?php endif; ?>>(UTC-07:00) Edmonton</option>
												<option value="America/Hermosillo" <?php if(config('app.timezone') == 'America/Hermosillo'): ?> selected <?php endif; ?>>(UTC-07:00) Hermosillo</option>
												<option value="America/Inuvik" <?php if(config('app.timezone') == 'America/Inuvik'): ?> selected <?php endif; ?>>(UTC-07:00) Inuvik</option>
												<option value="America/Mazatlan" <?php if(config('app.timezone') == 'America/Mazatlan'): ?> selected <?php endif; ?>>(UTC-07:00) Mazatlan</option>
												<option value="America/Ojinaga" <?php if(config('app.timezone') == 'America/Ojinaga'): ?> selected <?php endif; ?>>(UTC-07:00) Ojinaga</option>
												<option value="America/Phoenix" <?php if(config('app.timezone') == 'America/Phoenix'): ?> selected <?php endif; ?>>(UTC-07:00) Phoenix</option>
												<option value="America/Shiprock" <?php if(config('app.timezone') == 'America/Shiprock'): ?> selected <?php endif; ?>>(UTC-07:00) Shiprock</option>
												<option value="America/Yellowknife" <?php if(config('app.timezone') == 'America/Yellowknife'): ?> selected <?php endif; ?>>(UTC-07:00) Yellowknife</option>
												<option value="America/Bahia_Banderas" <?php if(config('app.timezone') == 'America/Bahia_Banderas'): ?> selected <?php endif; ?>>(UTC-06:00) Bahia Banderas</option>
												<option value="America/Belize" <?php if(config('app.timezone') == 'America/Belize'): ?> selected <?php endif; ?>>(UTC-06:00) Belize</option>
												<option value="America/North_Dakota/Beulah" <?php if(config('app.timezone') == 'America/North_Dakota/Beulah'): ?> selected <?php endif; ?>>(UTC-06:00) Beulah</option>
												<option value="America/Cancun" <?php if(config('app.timezone') == 'America/Cancun'): ?> selected <?php endif; ?>>(UTC-06:00) Cancun</option>
												<option value="America/North_Dakota/Center" <?php if(config('app.timezone') == 'America/North_Dakota/Center'): ?> selected <?php endif; ?>>(UTC-06:00) Center</option>
												<option value="America/Chicago" <?php if(config('app.timezone') == 'America/Chicago'): ?> selected <?php endif; ?>>(UTC-06:00) Chicago</option>
												<option value="America/Costa_Rica" <?php if(config('app.timezone') == 'America/Costa_Rica'): ?> selected <?php endif; ?>>(UTC-06:00) Costa Rica</option>
												<option value="Pacific/Easter" <?php if(config('app.timezone') == 'Pacific/Easter'): ?> selected <?php endif; ?>>(UTC-06:00) Easter</option>
												<option value="America/El_Salvador" <?php if(config('app.timezone') == 'America/El_Salvador'): ?> selected <?php endif; ?>>(UTC-06:00) El Salvador</option>
												<option value="Pacific/Galapagos" <?php if(config('app.timezone') == 'Pacific/Galapagos'): ?> selected <?php endif; ?>>(UTC-06:00) Galapagos</option>
												<option value="America/Guatemala" <?php if(config('app.timezone') == 'America/Guatemala'): ?> selected <?php endif; ?>>(UTC-06:00) Guatemala</option>
												<option value="America/Indiana/Knox" <?php if(config('app.timezone') == 'America/Indiana/Knox'): ?> selected <?php endif; ?>>(UTC-06:00) Knox</option>
												<option value="America/Managua" <?php if(config('app.timezone') == 'America/Managua'): ?> selected <?php endif; ?>>(UTC-06:00) Managua</option>
												<option value="America/Matamoros" <?php if(config('app.timezone') == 'America/Matamoros'): ?> selected <?php endif; ?>>(UTC-06:00) Matamoros</option>
												<option value="America/Menominee" <?php if(config('app.timezone') == 'America/Menominee'): ?> selected <?php endif; ?>>(UTC-06:00) Menominee</option>
												<option value="America/Merida" <?php if(config('app.timezone') == 'America/Merida'): ?> selected <?php endif; ?>>(UTC-06:00) Merida</option>
												<option value="America/Mexico_City" <?php if(config('app.timezone') == 'America/Mexico_City'): ?> selected <?php endif; ?>>(UTC-06:00) Mexico City</option>
												<option value="America/Monterrey" <?php if(config('app.timezone') == 'America/Monterrey'): ?> selected <?php endif; ?>>(UTC-06:00) Monterrey</option>
												<option value="America/North_Dakota/New_Salem" <?php if(config('app.timezone') == 'America/North_Dakota/New_Salem'): ?> selected <?php endif; ?>>(UTC-06:00) New Salem</option>
												<option value="America/Rainy_River" <?php if(config('app.timezone') == 'America/Rainy_River'): ?> selected <?php endif; ?>>(UTC-06:00) Rainy River</option>
												<option value="America/Rankin_Inlet" <?php if(config('app.timezone') == 'America/Rankin_Inlet'): ?> selected <?php endif; ?>>(UTC-06:00) Rankin Inlet</option>
												<option value="America/Regina" <?php if(config('app.timezone') == 'America/Regina'): ?> selected <?php endif; ?>>(UTC-06:00) Regina</option>
												<option value="America/Resolute" <?php if(config('app.timezone') == 'America/Resolute'): ?> selected <?php endif; ?>>(UTC-06:00) Resolute</option>
												<option value="America/Swift_Current" <?php if(config('app.timezone') == 'America/Swift_Current'): ?> selected <?php endif; ?>>(UTC-06:00) Swift Current</option>
												<option value="America/Tegucigalpa" <?php if(config('app.timezone') == 'America/Tegucigalpa'): ?> selected <?php endif; ?>>(UTC-06:00) Tegucigalpa</option>
												<option value="America/Indiana/Tell_City" <?php if(config('app.timezone') == 'America/Indiana/Tell_City'): ?> selected <?php endif; ?>>(UTC-06:00) Tell City</option>
												<option value="America/Winnipeg" <?php if(config('app.timezone') == 'America/Winnipeg'): ?> selected <?php endif; ?>>(UTC-06:00) Winnipeg</option>
												<option value="America/Atikokan" <?php if(config('app.timezone') == 'America/Atikokan'): ?> selected <?php endif; ?>>(UTC-05:00) Atikokan</option>
												<option value="America/Bogota" <?php if(config('app.timezone') == 'America/Bogota'): ?> selected <?php endif; ?>>(UTC-05:00) Bogota</option>
												<option value="America/Cayman" <?php if(config('app.timezone') == 'America/Cayman'): ?> selected <?php endif; ?>>(UTC-05:00) Cayman</option>
												<option value="America/Detroit" <?php if(config('app.timezone') == 'America/Detroit'): ?> selected <?php endif; ?>>(UTC-05:00) Detroit</option>
												<option value="America/Grand_Turk" <?php if(config('app.timezone') == 'America/Grand_Turk'): ?> selected <?php endif; ?>>(UTC-05:00) Grand Turk</option>
												<option value="America/Guayaquil" <?php if(config('app.timezone') == 'America/Guayaquil'): ?> selected <?php endif; ?>>(UTC-05:00) Guayaquil</option>
												<option value="America/Havana" <?php if(config('app.timezone') == 'America/Havana'): ?> selected <?php endif; ?>>(UTC-05:00) Havana</option>
												<option value="America/Indiana/Indianapolis" <?php if(config('app.timezone') == 'America/Indiana/Indianapolis'): ?> selected <?php endif; ?>>(UTC-05:00) Indianapolis</option>
												<option value="America/Iqaluit" <?php if(config('app.timezone') == 'America/Iqaluit'): ?> selected <?php endif; ?>>(UTC-05:00) Iqaluit</option>
												<option value="America/Jamaica" <?php if(config('app.timezone') == 'America/Jamaica'): ?> selected <?php endif; ?>>(UTC-05:00) Jamaica</option>
												<option value="America/Lima" <?php if(config('app.timezone') == 'America/Lima'): ?> selected <?php endif; ?>>(UTC-05:00) Lima</option>
												<option value="America/Kentucky/Louisville" <?php if(config('app.timezone') == 'America/Kentucky/Louisville'): ?> selected <?php endif; ?>>(UTC-05:00) Louisville</option>
												<option value="America/Indiana/Marengo" <?php if(config('app.timezone') == 'America/Indiana/Marengo'): ?> selected <?php endif; ?>>(UTC-05:00) Marengo</option>
												<option value="America/Kentucky/Monticello" <?php if(config('app.timezone') == 'America/Kentucky/Monticello'): ?> selected <?php endif; ?>>(UTC-05:00) Monticello</option>
												<option value="America/Montreal" <?php if(config('app.timezone') == 'America/Montreal'): ?> selected <?php endif; ?>>(UTC-05:00) Montreal</option>
												<option value="America/Nassau" <?php if(config('app.timezone') == 'America/Nassau'): ?> selected <?php endif; ?>>(UTC-05:00) Nassau</option>
												<option value="America/New_York" <?php if(config('app.timezone') == 'America/New_York'): ?> selected <?php endif; ?>>(UTC-05:00) New York</option>
												<option value="America/Nipigon" <?php if(config('app.timezone') == 'America/Nipigon'): ?> selected <?php endif; ?>>(UTC-05:00) Nipigon</option>
												<option value="America/Panama" <?php if(config('app.timezone') == 'America/Panama'): ?> selected <?php endif; ?>>(UTC-05:00) Panama</option>
												<option value="America/Pangnirtung" <?php if(config('app.timezone') == 'America/Pangnirtung'): ?> selected <?php endif; ?>>(UTC-05:00) Pangnirtung</option>
												<option value="America/Indiana/Petersburg" <?php if(config('app.timezone') == 'America/Indiana/Petersburg'): ?> selected <?php endif; ?>>(UTC-05:00) Petersburg</option>
												<option value="America/Port-au-Prince" <?php if(config('app.timezone') == 'America/Port-au-Prince'): ?> selected <?php endif; ?>>(UTC-05:00) Port-au-Prince</option>
												<option value="America/Thunder_Bay" <?php if(config('app.timezone') == 'America/Thunder_Bay'): ?> selected <?php endif; ?>>(UTC-05:00) Thunder Bay</option>
												<option value="America/Toronto" <?php if(config('app.timezone') == 'America/Toronto'): ?> selected <?php endif; ?>>(UTC-05:00) Toronto</option>
												<option value="America/Indiana/Vevay" <?php if(config('app.timezone') == 'America/Indiana/Vevay'): ?> selected <?php endif; ?>>(UTC-05:00) Vevay</option>
												<option value="America/Indiana/Vincennes" <?php if(config('app.timezone') == 'America/Indiana/Vincennes'): ?> selected <?php endif; ?>>(UTC-05:00) Vincennes</option>
												<option value="America/Indiana/Winamac" <?php if(config('app.timezone') == 'America/Indiana/Winama'): ?> selected <?php endif; ?>>(UTC-05:00) Winamac</option>
												<option value="America/Caracas" <?php if(config('app.timezone') == 'America/Caracas'): ?> selected <?php endif; ?>>(UTC-04:30) Caracas</option>
												<option value="America/Anguilla" <?php if(config('app.timezone') == 'America/Anguilla'): ?> selected <?php endif; ?>>(UTC-04:00) Anguilla</option>
												<option value="America/Antigua" <?php if(config('app.timezone') == 'America/Antigua'): ?> selected <?php endif; ?>>(UTC-04:00) Antigua</option>
												<option value="America/Aruba" <?php if(config('app.timezone') == 'America/Aruba'): ?> selected <?php endif; ?>>(UTC-04:00) Aruba</option>
												<option value="America/Asuncion" <?php if(config('app.timezone') == 'America/Asuncion'): ?> selected <?php endif; ?>>(UTC-04:00) Asuncion</option>
												<option value="America/Barbados" <?php if(config('app.timezone') == 'America/Barbados'): ?> selected <?php endif; ?>>(UTC-04:00) Barbados</option>
												<option value="Atlantic/Bermuda" <?php if(config('app.timezone') == 'Atlantic/Bermuda'): ?> selected <?php endif; ?>>(UTC-04:00) Bermuda</option>
												<option value="America/Blanc-Sablon" <?php if(config('app.timezone') == 'America/Blanc-Sablon'): ?> selected <?php endif; ?>>(UTC-04:00) Blanc-Sablon</option>
												<option value="America/Boa_Vista" <?php if(config('app.timezone') == 'America/Boa_Vista'): ?> selected <?php endif; ?>>(UTC-04:00) Boa Vista</option>
												<option value="America/Campo_Grande" <?php if(config('app.timezone') == 'America/Campo_Grande'): ?> selected <?php endif; ?>>(UTC-04:00) Campo Grande</option>
												<option value="America/Cuiaba" <?php if(config('app.timezone') == 'America/Cuiaba'): ?> selected <?php endif; ?>>(UTC-04:00) Cuiaba</option>
												<option value="America/Curacao" <?php if(config('app.timezone') == 'America/Curacao'): ?> selected <?php endif; ?>>(UTC-04:00) Curacao</option>
												<option value="America/Dominica" <?php if(config('app.timezone') == 'America/Dominica'): ?> selected <?php endif; ?>>(UTC-04:00) Dominica</option>
												<option value="America/Eirunepe" <?php if(config('app.timezone') == 'America/Eirunepe'): ?> selected <?php endif; ?>>(UTC-04:00) Eirunepe</option>
												<option value="America/Glace_Bay" <?php if(config('app.timezone') == 'America/Glace_Bay'): ?> selected <?php endif; ?>>(UTC-04:00) Glace Bay</option>
												<option value="America/Goose_Bay" <?php if(config('app.timezone') == 'America/Goose_Bay'): ?> selected <?php endif; ?>>(UTC-04:00) Goose Bay</option>
												<option value="America/Grenada" <?php if(config('app.timezone') == 'America/Grenada'): ?> selected <?php endif; ?>>(UTC-04:00) Grenada</option>
												<option value="America/Guadeloupe" <?php if(config('app.timezone') == 'America/Guadeloupe'): ?> selected <?php endif; ?>>(UTC-04:00) Guadeloupe</option>
												<option value="America/Guyana" <?php if(config('app.timezone') == 'America/Guyana'): ?> selected <?php endif; ?>>(UTC-04:00) Guyana</option>
												<option value="America/Halifax" <?php if(config('app.timezone') == 'America/Halifax'): ?> selected <?php endif; ?>>(UTC-04:00) Halifax</option>
												<option value="America/Kralendijk" <?php if(config('app.timezone') == 'America/Kralendijk'): ?> selected <?php endif; ?>>(UTC-04:00) Kralendijk</option>
												<option value="America/La_Paz" <?php if(config('app.timezone') == 'America/La_Paz'): ?> selected <?php endif; ?>>(UTC-04:00) La Paz</option>
												<option value="America/Lower_Princes" <?php if(config('app.timezone') == 'America/Lower_Princes'): ?> selected <?php endif; ?>>(UTC-04:00) Lower Princes</option>
												<option value="America/Manaus" <?php if(config('app.timezone') == 'America/Manaus'): ?> selected <?php endif; ?>>(UTC-04:00) Manaus</option>
												<option value="America/Marigot" <?php if(config('app.timezone') == 'America/Marigot'): ?> selected <?php endif; ?>>(UTC-04:00) Marigot</option>
												<option value="America/Martinique" <?php if(config('app.timezone') == 'America/Martinique'): ?> selected <?php endif; ?>>(UTC-04:00) Martinique</option>
												<option value="America/Moncton" <?php if(config('app.timezone') == 'America/Moncton'): ?> selected <?php endif; ?>>(UTC-04:00) Moncton</option>
												<option value="America/Montserrat" <?php if(config('app.timezone') == 'America/Montserrat'): ?> selected <?php endif; ?>>(UTC-04:00) Montserrat</option>
												<option value="Antarctica/Palmer" <?php if(config('app.timezone') == 'Antarctica/Palmer'): ?> selected <?php endif; ?>>(UTC-04:00) Palmer</option>
												<option value="America/Port_of_Spain" <?php if(config('app.timezone') == 'America/Port_of_Spain'): ?> selected <?php endif; ?>>(UTC-04:00) Port of Spain</option>
												<option value="America/Porto_Velho" <?php if(config('app.timezone') == 'America/Porto_Velho'): ?> selected <?php endif; ?>>(UTC-04:00) Porto Velho</option>
												<option value="America/Puerto_Rico" <?php if(config('app.timezone') == 'America/Puerto_Rico'): ?> selected <?php endif; ?>>(UTC-04:00) Puerto Rico</option>
												<option value="America/Rio_Branco" <?php if(config('app.timezone') == 'America/Rio_Branco'): ?> selected <?php endif; ?>>(UTC-04:00) Rio Branco</option>
												<option value="America/Santiago" <?php if(config('app.timezone') == 'America/Santiago'): ?> selected <?php endif; ?>>(UTC-04:00) Santiago</option>
												<option value="America/Santo_Domingo" <?php if(config('app.timezone') == 'America/Santo_Domingo'): ?> selected <?php endif; ?>>(UTC-04:00) Santo Domingo</option>
												<option value="America/St_Barthelemy" <?php if(config('app.timezone') == 'America/St_Barthelemy'): ?> selected <?php endif; ?>>(UTC-04:00) St. Barthelemy</option>
												<option value="America/St_Kitts" <?php if(config('app.timezone') == 'America/St_Kitts'): ?> selected <?php endif; ?>>(UTC-04:00) St. Kitts</option>
												<option value="America/St_Lucia" <?php if(config('app.timezone') == 'America/St_Lucia'): ?> selected <?php endif; ?>>(UTC-04:00) St. Lucia</option>
												<option value="America/St_Thomas" <?php if(config('app.timezone') == 'America/St_Thomas'): ?> selected <?php endif; ?>>(UTC-04:00) St. Thomas</option>
												<option value="America/St_Vincent" <?php if(config('app.timezone') == 'America/St_Vincent'): ?> selected <?php endif; ?>>(UTC-04:00) St. Vincent</option>
												<option value="America/Thule" <?php if(config('app.timezone') == 'America/Thule'): ?> selected <?php endif; ?>>(UTC-04:00) Thule</option>
												<option value="America/Tortola" <?php if(config('app.timezone') == 'America/Tortola'): ?> selected <?php endif; ?>>(UTC-04:00) Tortola</option>
												<option value="America/St_Johns" <?php if(config('app.timezone') == 'America/St_Johns'): ?> selected <?php endif; ?>>(UTC-03:30) St. Johns</option>
												<option value="America/Araguaina" <?php if(config('app.timezone') == 'America/Araguaina'): ?> selected <?php endif; ?>>(UTC-03:00) Araguaina</option>
												<option value="America/Bahia" <?php if(config('app.timezone') == 'America/Bahia'): ?> selected <?php endif; ?>>(UTC-03:00) Bahia</option>
												<option value="America/Belem" <?php if(config('app.timezone') == 'America/Belem'): ?> selected <?php endif; ?>>(UTC-03:00) Belem</option>
												<option value="America/Argentina/Buenos_Aires" <?php if(config('app.timezone') == 'America/Argentina/Buenos_Aires'): ?> selected <?php endif; ?>>(UTC-03:00) Buenos Aires</option>
												<option value="America/Argentina/Catamarca" <?php if(config('app.timezone') == 'America/Argentina/Catamarca'): ?> selected <?php endif; ?>>(UTC-03:00) Catamarca</option>
												<option value="America/Cayenne" <?php if(config('app.timezone') == 'America/Cayenne'): ?> selected <?php endif; ?>>(UTC-03:00) Cayenne</option>
												<option value="America/Argentina/Cordoba" <?php if(config('app.timezone') == 'America/Argentina/Cordoba'): ?> selected <?php endif; ?>>(UTC-03:00) Cordoba</option>
												<option value="America/Fortaleza" <?php if(config('app.timezone') == 'America/Fortaleza'): ?> selected <?php endif; ?>>(UTC-03:00) Fortaleza</option>
												<option value="America/Godthab" <?php if(config('app.timezone') == 'America/Godthab'): ?> selected <?php endif; ?>>(UTC-03:00) Godthab</option>
												<option value="America/Argentina/Jujuy" <?php if(config('app.timezone') == 'America/Argentina/Jujuy'): ?> selected <?php endif; ?>>(UTC-03:00) Jujuy</option>
												<option value="America/Argentina/La_Rioja" <?php if(config('app.timezone') == 'America/Argentina/La_Rioja'): ?> selected <?php endif; ?>>(UTC-03:00) La Rioja</option>
												<option value="America/Maceio" <?php if(config('app.timezone') == 'America/Maceio'): ?> selected <?php endif; ?>>(UTC-03:00) Maceio</option>
												<option value="America/Argentina/Mendoza" <?php if(config('app.timezone') == 'America/Argentina/Mendoza'): ?> selected <?php endif; ?>>(UTC-03:00) Mendoza</option>
												<option value="America/Miquelon" <?php if(config('app.timezone') == 'America/Miquelon'): ?> selected <?php endif; ?>>(UTC-03:00) Miquelon</option>
												<option value="America/Montevideo" <?php if(config('app.timezone') == 'America/Montevideo'): ?> selected <?php endif; ?>>(UTC-03:00) Montevideo</option>
												<option value="America/Paramaribo" <?php if(config('app.timezone') == 'America/Paramaribo'): ?> selected <?php endif; ?>>(UTC-03:00) Paramaribo</option>
												<option value="America/Recife" <?php if(config('app.timezone') == 'America/Recife'): ?> selected <?php endif; ?>>(UTC-03:00) Recife</option>
												<option value="America/Argentina/Rio_Gallegos" <?php if(config('app.timezone') == 'America/Argentina/Rio_Gallegos'): ?> selected <?php endif; ?>>(UTC-03:00) Rio Gallegos</option>
												<option value="Antarctica/Rothera" <?php if(config('app.timezone') == 'Antarctica/Rothera'): ?> selected <?php endif; ?>>(UTC-03:00) Rothera</option>
												<option value="America/Argentina/Salta" <?php if(config('app.timezone') == 'America/Argentina/Salta'): ?> selected <?php endif; ?>>(UTC-03:00) Salta</option>
												<option value="America/Argentina/San_Juan" <?php if(config('app.timezone') == 'America/Argentina/San_Juan'): ?> selected <?php endif; ?>>(UTC-03:00) San Juan</option>
												<option value="America/Argentina/San_Luis" <?php if(config('app.timezone') == 'America/Argentina/San_Luis'): ?> selected <?php endif; ?>>(UTC-03:00) San Luis</option>
												<option value="America/Santarem" <?php if(config('app.timezone') == 'America/Santarem'): ?> selected <?php endif; ?>>(UTC-03:00) Santarem</option>
												<option value="America/Sao_Paulo" <?php if(config('app.timezone') == 'America/Sao_Paulo'): ?> selected <?php endif; ?>>(UTC-03:00) Sao Paulo</option>
												<option value="Atlantic/Stanley" <?php if(config('app.timezone') == 'Atlantic/Stanley'): ?> selected <?php endif; ?>>(UTC-03:00) Stanley</option>
												<option value="America/Argentina/Tucuman" <?php if(config('app.timezone') == 'America/Argentina/Tucuman'): ?> selected <?php endif; ?>>(UTC-03:00) Tucuman</option>
												<option value="America/Argentina/Ushuaia" <?php if(config('app.timezone') == 'America/Argentina/Ushuaia'): ?> selected <?php endif; ?>>(UTC-03:00) Ushuaia</option>
												<option value="America/Noronha" <?php if(config('app.timezone') == 'America/Noronha'): ?> selected <?php endif; ?>>(UTC-02:00) Noronha</option>
												<option value="Atlantic/South_Georgia" <?php if(config('app.timezone') == 'Atlantic/South_Georgia'): ?> selected <?php endif; ?>>(UTC-02:00) South Georgia</option>
												<option value="Atlantic/Azores" <?php if(config('app.timezone') == 'Atlantic/Azores'): ?> selected <?php endif; ?>>(UTC-01:00) Azores</option>
												<option value="Atlantic/Cape_Verde" <?php if(config('app.timezone') == 'Atlantic/Cape_Verde'): ?> selected <?php endif; ?>>(UTC-01:00) Cape Verde</option>
												<option value="America/Scoresbysund" <?php if(config('app.timezone') == 'America/Scoresbysund'): ?> selected <?php endif; ?>>(UTC-01:00) Scoresbysund</option>
												<option value="Africa/Abidjan" <?php if(config('app.timezone') == 'Africa/Abidjan'): ?> selected <?php endif; ?>>(UTC+00:00) Abidjan</option>
												<option value="Africa/Accra" <?php if(config('app.timezone') == 'Africa/Accra'): ?> selected <?php endif; ?>>(UTC+00:00) Accra</option>
												<option value="Africa/Bamako" <?php if(config('app.timezone') == 'Africa/Bamako'): ?> selected <?php endif; ?>>(UTC+00:00) Bamako</option>
												<option value="Africa/Banjul" <?php if(config('app.timezone') == 'Africa/Banjul'): ?> selected <?php endif; ?>>(UTC+00:00) Banjul</option>
												<option value="Africa/Bissau" <?php if(config('app.timezone') == 'Africa/Bissau'): ?> selected <?php endif; ?>>(UTC+00:00) Bissau</option>
												<option value="Atlantic/Canary" <?php if(config('app.timezone') == 'Atlantic/Canary'): ?> selected <?php endif; ?>>(UTC+00:00) Canary</option>
												<option value="Africa/Casablanca" <?php if(config('app.timezone') == 'Africa/Casablanca'): ?> selected <?php endif; ?>>(UTC+00:00) Casablanca</option>
												<option value="Africa/Conakry" <?php if(config('app.timezone') == 'Africa/Conakry'): ?> selected <?php endif; ?>>(UTC+00:00) Conakry</option>
												<option value="Africa/Dakar" <?php if(config('app.timezone') == 'Africa/Dakar'): ?> selected <?php endif; ?>>(UTC+00:00) Dakar</option>
												<option value="America/Danmarkshavn" <?php if(config('app.timezone') == 'America/Danmarkshavn'): ?> selected <?php endif; ?>>(UTC+00:00) Danmarkshavn</option>
												<option value="Europe/Dublin" <?php if(config('app.timezone') == 'Europe/Dublin'): ?> selected <?php endif; ?>>(UTC+00:00) Dublin</option>
												<option value="Africa/El_Aaiun" <?php if(config('app.timezone') == 'Africa/El_Aaiun'): ?> selected <?php endif; ?>>(UTC+00:00) El Aaiun</option>
												<option value="Atlantic/Faroe" <?php if(config('app.timezone') == 'Atlantic/Faroe'): ?> selected <?php endif; ?>>(UTC+00:00) Faroe</option>
												<option value="Africa/Freetown" <?php if(config('app.timezone') == 'Africa/Freetown'): ?> selected <?php endif; ?>>(UTC+00:00) Freetown</option>
												<option value="Europe/Guernsey" <?php if(config('app.timezone') == 'Europe/Guernsey'): ?> selected <?php endif; ?>>(UTC+00:00) Guernsey</option>
												<option value="Europe/Isle_of_Man" <?php if(config('app.timezone') == 'Europe/Isle_of_Man'): ?> selected <?php endif; ?>>(UTC+00:00) Isle of Man</option>
												<option value="Europe/Jersey" <?php if(config('app.timezone') == 'Europe/Jersey'): ?> selected <?php endif; ?>>(UTC+00:00) Jersey</option>
												<option value="Europe/Lisbon" <?php if(config('app.timezone') == 'Europe/Lisbon'): ?> selected <?php endif; ?>>(UTC+00:00) Lisbon</option>
												<option value="Africa/Lome" <?php if(config('app.timezone') == 'Africa/Lome'): ?> selected <?php endif; ?>>(UTC+00:00) Lome</option>
												<option value="Europe/London" <?php if(config('app.timezone') == 'Europe/London'): ?> selected <?php endif; ?>>(UTC+00:00) London</option>
												<option value="Atlantic/Madeira" <?php if(config('app.timezone') == 'Atlantic/Madeira'): ?> selected <?php endif; ?>>(UTC+00:00) Madeira</option>
												<option value="Africa/Monrovia" <?php if(config('app.timezone') == 'Africa/Monrovia'): ?> selected <?php endif; ?>>(UTC+00:00) Monrovia</option>
												<option value="Africa/Nouakchott" <?php if(config('app.timezone') == 'Africa/Nouakchott'): ?> selected <?php endif; ?>>(UTC+00:00) Nouakchott</option>
												<option value="Africa/Ouagadougou" <?php if(config('app.timezone') == 'Africa/Ouagadougou'): ?> selected <?php endif; ?>>(UTC+00:00) Ouagadougou</option>
												<option value="Atlantic/Reykjavik" <?php if(config('app.timezone') == 'Atlantic/Reykjavik'): ?> selected <?php endif; ?>>(UTC+00:00) Reykjavik</option>
												<option value="Africa/Sao_Tome" <?php if(config('app.timezone') == 'Africa/Sao_Tome'): ?> selected <?php endif; ?>>(UTC+00:00) Sao Tome</option>
												<option value="Atlantic/St_Helena" <?php if(config('app.timezone') == 'Atlantic/St_Helena'): ?> selected <?php endif; ?>>(UTC+00:00) St. Helena</option>
												<option value="UTC" <?php if(config('app.timezone') == 'UTC'): ?> selected <?php endif; ?>>(UTC+00:00) UTC</option>
												<option value="Africa/Algiers" <?php if(config('app.timezone') == 'Africa/Algiers'): ?> selected <?php endif; ?>>(UTC+01:00) Algiers</option>
												<option value="Europe/Amsterdam" <?php if(config('app.timezone') == 'Europe/Amsterdam'): ?> selected <?php endif; ?>>(UTC+01:00) Amsterdam</option>
												<option value="Europe/Andorra" <?php if(config('app.timezone') == 'Europe/Andorra'): ?> selected <?php endif; ?>>(UTC+01:00) Andorra</option>
												<option value="Africa/Bangui" <?php if(config('app.timezone') == 'Africa/Bangui'): ?> selected <?php endif; ?>>(UTC+01:00) Bangui</option>
												<option value="Europe/Belgrade" <?php if(config('app.timezone') == 'Europe/Belgrade'): ?> selected <?php endif; ?>>(UTC+01:00) Belgrade</option>
												<option value="Europe/Berlin" <?php if(config('app.timezone') == 'Europe/Berlin'): ?> selected <?php endif; ?>>(UTC+01:00) Berlin</option>
												<option value="Europe/Bratislava" <?php if(config('app.timezone') == 'Europe/Bratislava'): ?> selected <?php endif; ?>>(UTC+01:00) Bratislava</option>
												<option value="Africa/Brazzaville" <?php if(config('app.timezone') == 'Africa/Brazzaville'): ?> selected <?php endif; ?>>(UTC+01:00) Brazzaville</option>
												<option value="Europe/Brussels" <?php if(config('app.timezone') == 'Europe/Brussels'): ?> selected <?php endif; ?>>(UTC+01:00) Brussels</option>
												<option value="Europe/Budapest" <?php if(config('app.timezone') == 'Europe/Budapest'): ?> selected <?php endif; ?>>(UTC+01:00) Budapest</option>
												<option value="Europe/Busingen" <?php if(config('app.timezone') == 'Europe/Busingen'): ?> selected <?php endif; ?>>(UTC+01:00) Busingen</option>
												<option value="Africa/Ceuta" <?php if(config('app.timezone') == 'Africa/Ceuta'): ?> selected <?php endif; ?>>(UTC+01:00) Ceuta</option>
												<option value="Europe/Copenhagen" <?php if(config('app.timezone') == 'Europe/Copenhagen'): ?> selected <?php endif; ?>>(UTC+01:00) Copenhagen</option>
												<option value="Africa/Douala" <?php if(config('app.timezone') == 'Africa/Douala'): ?> selected <?php endif; ?>>(UTC+01:00) Douala</option>
												<option value="Europe/Gibraltar" <?php if(config('app.timezone') == 'Europe/Gibraltar'): ?> selected <?php endif; ?>>(UTC+01:00) Gibraltar</option>
												<option value="Africa/Kinshasa" <?php if(config('app.timezone') == 'Africa/Kinshasa'): ?> selected <?php endif; ?>>(UTC+01:00) Kinshasa</option>
												<option value="Africa/Lagos" <?php if(config('app.timezone') == 'Africa/Lagos'): ?> selected <?php endif; ?>>(UTC+01:00) Lagos</option>
												<option value="Africa/Libreville" <?php if(config('app.timezone') == 'Africa/Libreville'): ?> selected <?php endif; ?>>(UTC+01:00) Libreville</option>
												<option value="Europe/Ljubljana" <?php if(config('app.timezone') == 'Europe/Ljubljana'): ?> selected <?php endif; ?>>(UTC+01:00) Ljubljana</option>
												<option value="Arctic/Longyearbyen" <?php if(config('app.timezone') == 'Arctic/Longyearbyen'): ?> selected <?php endif; ?>>(UTC+01:00) Longyearbyen</option>
												<option value="Africa/Luanda" <?php if(config('app.timezone') == 'Africa/Luanda'): ?> selected <?php endif; ?>>(UTC+01:00) Luanda</option>
												<option value="Europe/Luxembourg" <?php if(config('app.timezone') == 'Europe/Luxembourg'): ?> selected <?php endif; ?>>(UTC+01:00) Luxembourg</option>
												<option value="Europe/Madrid" <?php if(config('app.timezone') == 'Europe/Madrid'): ?> selected <?php endif; ?>>(UTC+01:00) Madrid</option>
												<option value="Africa/Malabo" <?php if(config('app.timezone') == 'Africa/Malabo'): ?> selected <?php endif; ?>>(UTC+01:00) Malabo</option>
												<option value="Europe/Malta" <?php if(config('app.timezone') == 'Europe/Malta'): ?> selected <?php endif; ?>>(UTC+01:00) Malta</option>
												<option value="Europe/Monaco" <?php if(config('app.timezone') == 'Europe/Monaco'): ?> selected <?php endif; ?>>(UTC+01:00) Monaco</option>
												<option value="Africa/Ndjamena" <?php if(config('app.timezone') == 'Africa/Ndjamena'): ?> selected <?php endif; ?>>(UTC+01:00) Ndjamena</option>
												<option value="Africa/Niamey" <?php if(config('app.timezone') == 'Africa/Niamey'): ?> selected <?php endif; ?>>(UTC+01:00) Niamey</option>
												<option value="Europe/Oslo" <?php if(config('app.timezone') == 'Europe/Oslo'): ?> selected <?php endif; ?>>(UTC+01:00) Oslo</option>
												<option value="Europe/Paris" <?php if(config('app.timezone') == 'Europe/Paris'): ?> selected <?php endif; ?>>(UTC+01:00) Paris</option>
												<option value="Europe/Podgorica" <?php if(config('app.timezone') == 'Europe/Podgorica'): ?> selected <?php endif; ?>>(UTC+01:00) Podgorica</option>	
												<option value="Africa/Porto-Novo" <?php if(config('app.timezone') == 'Africa/Porto-Novo'): ?> selected <?php endif; ?>>(UTC+01:00) Porto-Novo</option>
												<option value="Europe/Prague" <?php if(config('app.timezone') == 'Europe/Prague'): ?> selected <?php endif; ?>>(UTC+01:00) Prague</option>
												<option value="Europe/Rome" <?php if(config('app.timezone') == 'Europe/Rome'): ?> selected <?php endif; ?>>(UTC+01:00) Rome</option>
												<option value="Europe/San_Marino" <?php if(config('app.timezone') == 'Europe/San_Marino'): ?> selected <?php endif; ?>>(UTC+01:00) San Marino</option>
												<option value="Europe/Sarajevo" <?php if(config('app.timezone') == 'Europe/Sarajevo'): ?> selected <?php endif; ?>>(UTC+01:00) Sarajevo</option>
												<option value="Europe/Skopje" <?php if(config('app.timezone') == 'Europe/Skopje'): ?> selected <?php endif; ?>>(UTC+01:00) Skopje</option>
												<option value="Europe/Stockholm" <?php if(config('app.timezone') == 'Europe/Stockholm'): ?> selected <?php endif; ?>>(UTC+01:00) Stockholm</option>
												<option value="Europe/Tirane" <?php if(config('app.timezone') == 'Europe/Tirane'): ?> selected <?php endif; ?>>(UTC+01:00) Tirane</option>
												<option value="Africa/Tripoli" <?php if(config('app.timezone') == 'Africa/Tripoli'): ?> selected <?php endif; ?>>(UTC+01:00) Tripoli</option>
												<option value="Africa/Tunis" <?php if(config('app.timezone') == 'Africa/Tunis'): ?> selected <?php endif; ?>>(UTC+01:00) Tunis</option>
												<option value="Europe/Vaduz" <?php if(config('app.timezone') == 'Europe/Vaduz'): ?> selected <?php endif; ?>>(UTC+01:00) Vaduz</option>
												<option value="Europe/Vatican" <?php if(config('app.timezone') == 'Europe/Vatican'): ?> selected <?php endif; ?>>(UTC+01:00) Vatican</option>
												<option value="Europe/Vienna" <?php if(config('app.timezone') == 'Europe/Vienna'): ?> selected <?php endif; ?>>(UTC+01:00) Vienna</option>
												<option value="Europe/Warsaw" <?php if(config('app.timezone') == 'Europe/Warsaw'): ?> selected <?php endif; ?>>(UTC+01:00) Warsaw</option>
												<option value="Africa/Windhoek" <?php if(config('app.timezone') == 'Africa/Windhoek'): ?> selected <?php endif; ?>>(UTC+01:00) Windhoek</option>
												<option value="Europe/Zagreb" <?php if(config('app.timezone') == 'Europe/Zagreb'): ?> selected <?php endif; ?>>(UTC+01:00) Zagreb</option>
												<option value="Europe/Zurich" <?php if(config('app.timezone') == 'Europe/Zurich'): ?> selected <?php endif; ?>>(UTC+01:00) Zurich</option>
												<option value="Europe/Athens" <?php if(config('app.timezone') == 'Europe/Athens'): ?> selected <?php endif; ?>>(UTC+02:00) Athens</option>
												<option value="Asia/Beirut" <?php if(config('app.timezone') == 'Asia/Beirut"'): ?> selected <?php endif; ?>>(UTC+02:00) Beirut</option>
												<option value="Africa/Blantyre" <?php if(config('app.timezone') == 'Africa/Blantyre'): ?> selected <?php endif; ?>>(UTC+02:00) Blantyre</option>
												<option value="Europe/Bucharest" <?php if(config('app.timezone') == 'Europe/Bucharest'): ?> selected <?php endif; ?>>(UTC+02:00) Bucharest</option>
												<option value="Africa/Bujumbura" <?php if(config('app.timezone') == 'Africa/Bujumbura'): ?> selected <?php endif; ?>>(UTC+02:00) Bujumbura</option>
												<option value="Africa/Cairo" <?php if(config('app.timezone') == 'Africa/Cairo'): ?> selected <?php endif; ?>>(UTC+02:00) Cairo</option>
												<option value="Europe/Chisinau" <?php if(config('app.timezone') == 'Europe/Chisinau'): ?> selected <?php endif; ?>>(UTC+02:00) Chisinau</option>
												<option value="Asia/Damascus" <?php if(config('app.timezone') == 'Asia/Damascus'): ?> selected <?php endif; ?>>(UTC+02:00) Damascus</option>
												<option value="Africa/Gaborone" <?php if(config('app.timezone') == 'Africa/Gaborone'): ?> selected <?php endif; ?>>(UTC+02:00) Gaborone</option>
												<option value="Asia/Gaza" <?php if(config('app.timezone') == 'Asia/Gaza'): ?> selected <?php endif; ?>>(UTC+02:00) Gaza</option>
												<option value="Africa/Harare" <?php if(config('app.timezone') == 'Africa/Harare'): ?> selected <?php endif; ?>>(UTC+02:00) Harare</option>
												<option value="Asia/Hebron" <?php if(config('app.timezone') == 'Asia/Hebron'): ?> selected <?php endif; ?>>(UTC+02:00) Hebron</option>
												<option value="Europe/Helsinki" <?php if(config('app.timezone') == 'Europe/Helsinki'): ?> selected <?php endif; ?>>(UTC+02:00) Helsinki</option>
												<option value="Europe/Istanbul" <?php if(config('app.timezone') == 'Europe/Istanbul'): ?> selected <?php endif; ?>>(UTC+02:00) Istanbul</option>
												<option value="Asia/Jerusalem" <?php if(config('app.timezone') == 'Asia/Jerusalem'): ?> selected <?php endif; ?>>(UTC+02:00) Jerusalem</option>
												<option value="Africa/Johannesburg" <?php if(config('app.timezone') == 'Africa/Johannesburg'): ?> selected <?php endif; ?>>(UTC+02:00) Johannesburg</option>
												<option value="Europe/Kiev" <?php if(config('app.timezone') == 'Europe/Kiev'): ?> selected <?php endif; ?>>(UTC+02:00) Kiev</option>
												<option value="Africa/Kigali" <?php if(config('app.timezone') == 'Africa/Kigali'): ?> selected <?php endif; ?>>(UTC+02:00) Kigali</option>
												<option value="Africa/Lubumbashi" <?php if(config('app.timezone') == 'Africa/Lubumbashi'): ?> selected <?php endif; ?>>(UTC+02:00) Lubumbashi</option>
												<option value="Africa/Lusaka" <?php if(config('app.timezone') == 'Africa/Lusaka'): ?> selected <?php endif; ?>>(UTC+02:00) Lusaka</option>
												<option value="Africa/Maputo" <?php if(config('app.timezone') == 'Africa/Maputo'): ?> selected <?php endif; ?>>(UTC+02:00) Maputo</option>
												<option value="Europe/Mariehamn" <?php if(config('app.timezone') == 'Europe/Mariehamn'): ?> selected <?php endif; ?>>(UTC+02:00) Mariehamn</option>
												<option value="Africa/Maseru" <?php if(config('app.timezone') == 'Africa/Maseru'): ?> selected <?php endif; ?>>(UTC+02:00) Maseru</option>
												<option value="Africa/Mbabane" <?php if(config('app.timezone') == 'Africa/Mbabane'): ?> selected <?php endif; ?>>(UTC+02:00) Mbabane</option>
												<option value="Asia/Nicosia" <?php if(config('app.timezone') == 'Asia/Nicosia'): ?> selected <?php endif; ?>>(UTC+02:00) Nicosia</option>
												<option value="Europe/Riga" <?php if(config('app.timezone') == 'Europe/Riga'): ?> selected <?php endif; ?>>(UTC+02:00) Riga</option>
												<option value="Europe/Simferopol" <?php if(config('app.timezone') == 'Europe/Simferopol'): ?> selected <?php endif; ?>>(UTC+02:00) Simferopol</option>
												<option value="Europe/Sofia" <?php if(config('app.timezone') == 'Europe/Sofia'): ?> selected <?php endif; ?>>(UTC+02:00) Sofia</option>
												<option value="Europe/Tallinn" <?php if(config('app.timezone') == 'Europe/Tallinn'): ?> selected <?php endif; ?>>(UTC+02:00) Tallinn</option>
												<option value="Europe/Uzhgorod" <?php if(config('app.timezone') == 'Europe/Uzhgorod'): ?> selected <?php endif; ?>>(UTC+02:00) Uzhgorod</option>
												<option value="Europe/Vilnius" <?php if(config('app.timezone') == 'Europe/Vilnius'): ?> selected <?php endif; ?>>(UTC+02:00) Vilnius</option>
												<option value="Europe/Zaporozhye" <?php if(config('app.timezone') == 'Europe/Zaporozhye'): ?> selected <?php endif; ?>>(UTC+02:00) Zaporozhye</option>
												<option value="Africa/Addis_Ababa" <?php if(config('app.timezone') == 'Africa/Addis_Ababa'): ?> selected <?php endif; ?>>(UTC+03:00) Addis Ababa</option>
												<option value="Asia/Aden" <?php if(config('app.timezone') == 'Asia/Aden'): ?> selected <?php endif; ?>>(UTC+03:00) Aden</option>
												<option value="Asia/Amman" <?php if(config('app.timezone') == 'Asia/Amman'): ?> selected <?php endif; ?>>(UTC+03:00) Amman</option>
												<option value="Indian/Antananarivo" <?php if(config('app.timezone') == 'Indian/Antananarivo'): ?> selected <?php endif; ?>>(UTC+03:00) Antananarivo</option>
												<option value="Africa/Asmara" <?php if(config('app.timezone') == 'Africa/Asmara'): ?> selected <?php endif; ?>>(UTC+03:00) Asmara</option>
												<option value="Asia/Baghdad" <?php if(config('app.timezone') == 'Asia/Baghdad'): ?> selected <?php endif; ?>>(UTC+03:00) Baghdad</option>
												<option value="Asia/Bahrain" <?php if(config('app.timezone') == 'Asia/Bahrain'): ?> selected <?php endif; ?>>(UTC+03:00) Bahrain</option>
												<option value="Indian/Comoro" <?php if(config('app.timezone') == 'Indian/Comoro'): ?> selected <?php endif; ?>>(UTC+03:00) Comoro</option>
												<option value="Africa/Dar_es_Salaam" <?php if(config('app.timezone') == 'Africa/Dar_es_Salaam'): ?> selected <?php endif; ?>>(UTC+03:00) Dar es Salaam</option>
												<option value="Africa/Djibouti" <?php if(config('app.timezone') == 'Africa/Djibouti'): ?> selected <?php endif; ?>>(UTC+03:00) Djibouti</option>
												<option value="Africa/Juba" <?php if(config('app.timezone') == 'Africa/Juba'): ?> selected <?php endif; ?>>(UTC+03:00) Juba</option>
												<option value="Europe/Kaliningrad" <?php if(config('app.timezone') == 'Europe/Kaliningrad'): ?> selected <?php endif; ?>>(UTC+03:00) Kaliningrad</option>
												<option value="Africa/Kampala" <?php if(config('app.timezone') == 'Africa/Kampala'): ?> selected <?php endif; ?>>(UTC+03:00) Kampala</option>
												<option value="Africa/Khartoum" <?php if(config('app.timezone') == 'Africa/Khartoum'): ?> selected <?php endif; ?>>(UTC+03:00) Khartoum</option>
												<option value="Asia/Kuwait" <?php if(config('app.timezone') == 'Asia/Kuwait'): ?> selected <?php endif; ?>>(UTC+03:00) Kuwait</option>
												<option value="Indian/Mayotte" <?php if(config('app.timezone') == 'Indian/Mayotte'): ?> selected <?php endif; ?>>(UTC+03:00) Mayotte</option>
												<option value="Europe/Minsk" <?php if(config('app.timezone') == 'Europe/Minsk'): ?> selected <?php endif; ?>>(UTC+03:00) Minsk</option>
												<option value="Africa/Mogadishu" <?php if(config('app.timezone') == 'Africa/Mogadishu'): ?> selected <?php endif; ?>>(UTC+03:00) Mogadishu</option>
												<option value="Europe/Moscow" <?php if(config('app.timezone') == 'Europe/Moscow'): ?> selected <?php endif; ?>>(UTC+03:00) Moscow</option>
												<option value="Africa/Nairobi" <?php if(config('app.timezone') == 'Africa/Nairobi'): ?> selected <?php endif; ?>>(UTC+03:00) Nairobi</option>
												<option value="Asia/Qatar" <?php if(config('app.timezone') == 'Asia/Qatar'): ?> selected <?php endif; ?>>(UTC+03:00) Qatar</option>
												<option value="Asia/Riyadh" <?php if(config('app.timezone') == 'Asia/Riyadh'): ?> selected <?php endif; ?>>(UTC+03:00) Riyadh</option>
												<option value="Antarctica/Syowa" <?php if(config('app.timezone') == 'Antarctica/Syowa'): ?> selected <?php endif; ?>>(UTC+03:00) Syowa</option>
												<option value="Asia/Tehran" <?php if(config('app.timezone') == 'Asia/Tehran'): ?> selected <?php endif; ?>>(UTC+03:30) Tehran</option>
												<option value="Asia/Baku" <?php if(config('app.timezone') == 'Asia/Baku'): ?> selected <?php endif; ?>>(UTC+04:00) Baku</option>
												<option value="Asia/Dubai" <?php if(config('app.timezone') == 'Asia/Dubai'): ?> selected <?php endif; ?>>(UTC+04:00) Dubai</option>
												<option value="Indian/Mahe" <?php if(config('app.timezone') == 'Indian/Mahe'): ?> selected <?php endif; ?>>(UTC+04:00) Mahe</option>
												<option value="Indian/Mauritius" <?php if(config('app.timezone') == 'Indian/Mauritius'): ?> selected <?php endif; ?>>(UTC+04:00) Mauritius</option>
												<option value="Asia/Muscat" <?php if(config('app.timezone') == 'Asia/Muscat'): ?> selected <?php endif; ?>>(UTC+04:00) Muscat</option>
												<option value="Indian/Reunion" <?php if(config('app.timezone') == 'Indian/Reunion'): ?> selected <?php endif; ?>>(UTC+04:00) Reunion</option>
												<option value="Europe/Samara" <?php if(config('app.timezone') == 'Europe/Samara'): ?> selected <?php endif; ?>>(UTC+04:00) Samara</option>
												<option value="Asia/Tbilisi" <?php if(config('app.timezone') == 'Asia/Tbilisi'): ?> selected <?php endif; ?>>(UTC+04:00) Tbilisi</option>
												<option value="Europe/Volgograd" <?php if(config('app.timezone') == 'Europe/Volgograd'): ?> selected <?php endif; ?>>(UTC+04:00) Volgograd</option>
												<option value="Asia/Yerevan" <?php if(config('app.timezone') == 'Asia/Yerevan'): ?> selected <?php endif; ?>>(UTC+04:00) Yerevan</option>
												<option value="Asia/Kabul" <?php if(config('app.timezone') == 'Asia/Kabul'): ?> selected <?php endif; ?>>(UTC+04:30) Kabul</option>
												<option value="Asia/Aqtau" <?php if(config('app.timezone') == 'Asia/Aqtau'): ?> selected <?php endif; ?>>(UTC+05:00) Aqtau</option>
												<option value="Asia/Aqtobe" <?php if(config('app.timezone') == 'Asia/Aqtobe'): ?> selected <?php endif; ?>>(UTC+05:00) Aqtobe</option>
												<option value="Asia/Ashgabat" <?php if(config('app.timezone') == 'Asia/Ashgabat'): ?> selected <?php endif; ?>>(UTC+05:00) Ashgabat</option>
												<option value="Asia/Dushanbe" <?php if(config('app.timezone') == 'Asia/Dushanbe'): ?> selected <?php endif; ?>>(UTC+05:00) Dushanbe</option>
												<option value="Asia/Karachi" <?php if(config('app.timezone') == 'Asia/Karachi'): ?> selected <?php endif; ?>>(UTC+05:00) Karachi</option>
												<option value="Indian/Kerguelen" <?php if(config('app.timezone') == 'Indian/Kerguelen'): ?> selected <?php endif; ?>>(UTC+05:00) Kerguelen</option>
												<option value="Indian/Maldives" <?php if(config('app.timezone') == 'Indian/Maldives'): ?> selected <?php endif; ?>>(UTC+05:00) Maldives</option>
												<option value="Antarctica/Mawson" <?php if(config('app.timezone') == 'Antarctica/Mawson'): ?> selected <?php endif; ?>>(UTC+05:00) Mawson</option>
												<option value="Asia/Oral" <?php if(config('app.timezone') == 'Asia/Oral'): ?> selected <?php endif; ?>>(UTC+05:00) Oral</option>
												<option value="Asia/Samarkand" <?php if(config('app.timezone') == 'Asia/Samarkand'): ?> selected <?php endif; ?>>(UTC+05:00) Samarkand</option>
												<option value="Asia/Tashkent" <?php if(config('app.timezone') == 'Asia/Tashkent'): ?> selected <?php endif; ?>>(UTC+05:00) Tashkent</option>
												<option value="Asia/Colombo" <?php if(config('app.timezone') == 'Asia/Colombo'): ?> selected <?php endif; ?>>(UTC+05:30) Colombo</option>
												<option value="Asia/Kolkata" <?php if(config('app.timezone') == 'Asia/Kolkata'): ?> selected <?php endif; ?>>(UTC+05:30) Kolkata</option>
												<option value="Asia/Kathmandu" <?php if(config('app.timezone') == 'Asia/Kathmandu'): ?> selected <?php endif; ?>>(UTC+05:45) Kathmandu</option>
												<option value="Asia/Almaty" <?php if(config('app.timezone') == 'Asia/Almaty'): ?> selected <?php endif; ?>>(UTC+06:00) Almaty</option>
												<option value="Asia/Bishkek" <?php if(config('app.timezone') == 'Asia/Bishkek'): ?> selected <?php endif; ?>>(UTC+06:00) Bishkek</option>
												<option value="Indian/Chagos" <?php if(config('app.timezone') == 'Indian/Chagos'): ?> selected <?php endif; ?>>(UTC+06:00) Chagos</option>
												<option value="Asia/Dhaka" <?php if(config('app.timezone') == 'Asia/Dhaka'): ?> selected <?php endif; ?>>(UTC+06:00) Dhaka</option>
												<option value="Asia/Qyzylorda" <?php if(config('app.timezone') == 'Asia/Qyzylorda'): ?> selected <?php endif; ?>>(UTC+06:00) Qyzylorda</option>
												<option value="Asia/Thimphu" <?php if(config('app.timezone') == 'Asia/Thimphu'): ?> selected <?php endif; ?>>(UTC+06:00) Thimphu</option>
												<option value="Antarctica/Vostok" <?php if(config('app.timezone') == 'Antarctica/Vostok'): ?> selected <?php endif; ?>>(UTC+06:00) Vostok</option>
												<option value="Asia/Yekaterinburg" <?php if(config('app.timezone') == 'Asia/Yekaterinburg'): ?> selected <?php endif; ?>>(UTC+06:00) Yekaterinburg</option>
												<option value="Indian/Cocos" <?php if(config('app.timezone') == 'Indian/Cocos'): ?> selected <?php endif; ?>>(UTC+06:30) Cocos</option>
												<option value="Asia/Rangoon" <?php if(config('app.timezone') == 'Asia/Rangoon'): ?> selected <?php endif; ?>>(UTC+06:30) Rangoon</option>
												<option value="Asia/Bangkok" <?php if(config('app.timezone') == 'Asia/Bangkok'): ?> selected <?php endif; ?>>(UTC+07:00) Bangkok</option>
												<option value="Indian/Christmas" <?php if(config('app.timezone') == 'Indian/Christmas'): ?> selected <?php endif; ?>>(UTC+07:00) Christmas</option>
												<option value="Antarctica/Davis" <?php if(config('app.timezone') == 'Antarctica/Davis'): ?> selected <?php endif; ?>>(UTC+07:00) Davis</option>
												<option value="Asia/Ho_Chi_Minh" <?php if(config('app.timezone') == 'Asia/Ho_Chi_Minh'): ?> selected <?php endif; ?>>(UTC+07:00) Ho Chi Minh</option>
												<option value="Asia/Hovd" <?php if(config('app.timezone') == 'Asia/Hovd'): ?> selected <?php endif; ?>>(UTC+07:00) Hovd</option>
												<option value="Asia/Jakarta" <?php if(config('app.timezone') == 'Asia/Jakarta'): ?> selected <?php endif; ?>>(UTC+07:00) Jakarta</option>
												<option value="Asia/Novokuznetsk" <?php if(config('app.timezone') == 'Asia/Novokuznetsk'): ?> selected <?php endif; ?>>(UTC+07:00) Novokuznetsk</option>
												<option value="Asia/Novosibirsk" <?php if(config('app.timezone') == 'Asia/Novosibirsk'): ?> selected <?php endif; ?>>(UTC+07:00) Novosibirsk</option>
												<option value="Asia/Omsk" <?php if(config('app.timezone') == 'Asia/Omsk'): ?> selected <?php endif; ?>>(UTC+07:00) Omsk</option>
												<option value="Asia/Phnom_Penh" <?php if(config('app.timezone') == 'Asia/Phnom_Penh'): ?> selected <?php endif; ?>>(UTC+07:00) Phnom Penh</option>
												<option value="Asia/Pontianak" <?php if(config('app.timezone') == 'Asia/Pontianak'): ?> selected <?php endif; ?>>(UTC+07:00) Pontianak</option>
												<option value="Asia/Vientiane" <?php if(config('app.timezone') == 'Asia/Vientiane'): ?> selected <?php endif; ?>>(UTC+07:00) Vientiane</option>
												<option value="Asia/Brunei" <?php if(config('app.timezone') == 'Asia/Brunei'): ?> selected <?php endif; ?>>(UTC+08:00) Brunei</option>
												<option value="Antarctica/Casey" <?php if(config('app.timezone') == 'Antarctica/Casey'): ?> selected <?php endif; ?>>(UTC+08:00) Casey</option>
												<option value="Asia/Choibalsan" <?php if(config('app.timezone') == 'Asia/Choibalsan'): ?> selected <?php endif; ?>>(UTC+08:00) Choibalsan</option>
												<option value="Asia/Chongqing" <?php if(config('app.timezone') == 'Asia/Chongqing'): ?> selected <?php endif; ?>>(UTC+08:00) Chongqing</option>
												<option value="Asia/Harbin" <?php if(config('app.timezone') == 'Asia/Harbin'): ?> selected <?php endif; ?>>(UTC+08:00) Harbin</option>
												<option value="Asia/Hong_Kong" <?php if(config('app.timezone') == 'Asia/Hong_Kong'): ?> selected <?php endif; ?>>(UTC+08:00) Hong Kong</option>
												<option value="Asia/Kashgar" <?php if(config('app.timezone') == 'Asia/Kashgar'): ?> selected <?php endif; ?>>(UTC+08:00) Kashgar</option>
												<option value="Asia/Krasnoyarsk" <?php if(config('app.timezone') == 'Asia/Krasnoyarsk'): ?> selected <?php endif; ?>>(UTC+08:00) Krasnoyarsk</option>
												<option value="Asia/Kuala_Lumpur" <?php if(config('app.timezone') == 'Asia/Kuala_Lumpur'): ?> selected <?php endif; ?>>(UTC+08:00) Kuala Lumpur</option>
												<option value="Asia/Kuching" <?php if(config('app.timezone') == 'Asia/Kuching'): ?> selected <?php endif; ?>>(UTC+08:00) Kuching</option>
												<option value="Asia/Macau" <?php if(config('app.timezone') == 'Asia/Macau'): ?> selected <?php endif; ?>>(UTC+08:00) Macau</option>
												<option value="Asia/Makassar" <?php if(config('app.timezone') == 'Asia/Makassar'): ?> selected <?php endif; ?>>(UTC+08:00) Makassar</option>
												<option value="Asia/Manila" <?php if(config('app.timezone') == 'Asia/Manila'): ?> selected <?php endif; ?>>(UTC+08:00) Manila</option>
												<option value="Australia/Perth" <?php if(config('app.timezone') == 'Australia/Perth'): ?> selected <?php endif; ?>>(UTC+08:00) Perth</option>
												<option value="Asia/Shanghai" <?php if(config('app.timezone') == 'Asia/Shanghai'): ?> selected <?php endif; ?>>(UTC+08:00) Shanghai</option>
												<option value="Asia/Singapore" <?php if(config('app.timezone') == 'Asia/Singapore'): ?> selected <?php endif; ?>>(UTC+08:00) Singapore</option>
												<option value="Asia/Taipei" <?php if(config('app.timezone') == 'Asia/Taipei'): ?> selected <?php endif; ?>>(UTC+08:00) Taipei</option>
												<option value="Asia/Ulaanbaatar" <?php if(config('app.timezone') == 'Asia/Ulaanbaatar'): ?> selected <?php endif; ?>>(UTC+08:00) Ulaanbaatar</option>
												<option value="Asia/Urumqi" <?php if(config('app.timezone') == 'Asia/Urumqi'): ?> selected <?php endif; ?>>(UTC+08:00) Urumqi</option>
												<option value="Australia/Eucla" <?php if(config('app.timezone') == 'Australia/Eucla'): ?> selected <?php endif; ?>>(UTC+08:45) Eucla</option>
												<option value="Asia/Dili" <?php if(config('app.timezone') == 'Asia/Dili'): ?> selected <?php endif; ?>>(UTC+09:00) Dili</option>
												<option value="Asia/Irkutsk" <?php if(config('app.timezone') == 'Asia/Irkutsk'): ?> selected <?php endif; ?>>(UTC+09:00) Irkutsk</option>
												<option value="Asia/Jayapura" <?php if(config('app.timezone') == 'Asia/Jayapura'): ?> selected <?php endif; ?>>(UTC+09:00) Jayapura</option>
												<option value="Pacific/Palau" <?php if(config('app.timezone') == 'Pacific/Palau'): ?> selected <?php endif; ?>>(UTC+09:00) Palau</option>
												<option value="Asia/Pyongyang" <?php if(config('app.timezone') == 'Asia/Pyongyang'): ?> selected <?php endif; ?>>(UTC+09:00) Pyongyang</option>
												<option value="Asia/Seoul" <?php if(config('app.timezone') == 'Asia/Seoul'): ?> selected <?php endif; ?>>(UTC+09:00) Seoul</option>
												<option value="Asia/Tokyo" <?php if(config('app.timezone') == 'Asia/Tokyo'): ?> selected <?php endif; ?>>(UTC+09:00) Tokyo</option>
												<option value="Australia/Adelaide" <?php if(config('app.timezone') == 'Australia/Adelaide'): ?> selected <?php endif; ?>>(UTC+09:30) Adelaide</option>
												<option value="Australia/Broken_Hill" <?php if(config('app.timezone') == 'Australia/Broken_Hill'): ?> selected <?php endif; ?>>(UTC+09:30) Broken Hill</option>
												<option value="Australia/Darwin" <?php if(config('app.timezone') == 'Australia/Darwin'): ?> selected <?php endif; ?>>(UTC+09:30) Darwin</option>
												<option value="Australia/Brisbane" <?php if(config('app.timezone') == 'Australia/Brisbane'): ?> selected <?php endif; ?>>(UTC+10:00) Brisbane</option>
												<option value="Pacific/Chuuk" <?php if(config('app.timezone') == 'Pacific/Chuuk'): ?> selected <?php endif; ?>>(UTC+10:00) Chuuk</option>
												<option value="Australia/Currie" <?php if(config('app.timezone') == 'Australia/Currie'): ?> selected <?php endif; ?>>(UTC+10:00) Currie</option>
												<option value="Antarctica/DumontDUrville" <?php if(config('app.timezone') == 'Antarctica/DumontDUrville'): ?> selected <?php endif; ?>>(UTC+10:00) DumontDUrville</option>
												<option value="Pacific/Guam" <?php if(config('app.timezone') == 'Pacific/Guam'): ?> selected <?php endif; ?>>(UTC+10:00) Guam</option>
												<option value="Australia/Hobart" <?php if(config('app.timezone') == 'Australia/Hobart'): ?> selected <?php endif; ?>>(UTC+10:00) Hobart</option>
												<option value="Asia/Khandyga" <?php if(config('app.timezone') == 'Asia/Khandyga'): ?> selected <?php endif; ?>>(UTC+10:00) Khandyga</option>
												<option value="Australia/Lindeman" <?php if(config('app.timezone') == 'Australia/Lindeman'): ?> selected <?php endif; ?>>(UTC+10:00) Lindeman</option>
												<option value="Australia/Melbourne" <?php if(config('app.timezone') == 'Australia/Melbourne'): ?> selected <?php endif; ?>>(UTC+10:00) Melbourne</option>
												<option value="Pacific/Port_Moresby" <?php if(config('app.timezone') == 'Pacific/Port_Moresby'): ?> selected <?php endif; ?>>(UTC+10:00) Port Moresby</option>
												<option value="Pacific/Saipan" <?php if(config('app.timezone') == 'Pacific/Saipan'): ?> selected <?php endif; ?>>(UTC+10:00) Saipan</option>
												<option value="Australia/Sydney" <?php if(config('app.timezone') == 'Australia/Sydney'): ?> selected <?php endif; ?>>(UTC+10:00) Sydney</option>
												<option value="Asia/Yakutsk" <?php if(config('app.timezone') == 'Asia/Yakutsk'): ?> selected <?php endif; ?>>(UTC+10:00) Yakutsk</option>
												<option value="Australia/Lord_Howe" <?php if(config('app.timezone') == 'Australia/Lord_Howe'): ?> selected <?php endif; ?>>(UTC+10:30) Lord Howe</option>
												<option value="Pacific/Efate" <?php if(config('app.timezone') == 'Pacific/Efate'): ?> selected <?php endif; ?>>(UTC+11:00) Efate</option>
												<option value="Pacific/Guadalcanal" <?php if(config('app.timezone') == 'Pacific/Guadalcanal'): ?> selected <?php endif; ?>>(UTC+11:00) Guadalcanal</option>
												<option value="Pacific/Kosrae" <?php if(config('app.timezone') == 'Pacific/Kosrae'): ?> selected <?php endif; ?>>(UTC+11:00) Kosrae</option>
												<option value="Antarctica/Macquarie" <?php if(config('app.timezone') == 'Antarctica/Macquarie'): ?> selected <?php endif; ?>>(UTC+11:00) Macquarie</option>
												<option value="Pacific/Noumea" <?php if(config('app.timezone') == 'Pacific/Noumea'): ?> selected <?php endif; ?>>(UTC+11:00) Noumea</option>
												<option value="Pacific/Pohnpei" <?php if(config('app.timezone') == 'Pacific/Pohnpei'): ?> selected <?php endif; ?>>(UTC+11:00) Pohnpei</option>
												<option value="Asia/Sakhalin" <?php if(config('app.timezone') == 'Asia/Sakhalin'): ?> selected <?php endif; ?>>(UTC+11:00) Sakhalin</option>
												<option value="Asia/Ust-Nera" <?php if(config('app.timezone') == 'Asia/Ust-Nera'): ?> selected <?php endif; ?>>(UTC+11:00) Ust-Nera</option>
												<option value="Asia/Vladivostok" <?php if(config('app.timezone') == 'Asia/Vladivostok'): ?> selected <?php endif; ?>>(UTC+11:00) Vladivostok</option>
												<option value="Pacific/Norfolk" <?php if(config('app.timezone') == 'Pacific/Norfolk'): ?> selected <?php endif; ?>>(UTC+11:30) Norfolk</option>
												<option value="Asia/Anadyr" <?php if(config('app.timezone') == 'Asia/Anadyr'): ?> selected <?php endif; ?>>(UTC+12:00) Anadyr</option>
												<option value="Pacific/Auckland" <?php if(config('app.timezone') == 'Pacific/Auckland'): ?> selected <?php endif; ?>>(UTC+12:00) Auckland</option>
												<option value="Pacific/Fiji" <?php if(config('app.timezone') == 'Pacific/Fiji'): ?> selected <?php endif; ?>>(UTC+12:00) Fiji</option>
												<option value="Pacific/Funafuti" <?php if(config('app.timezone') == 'Pacific/Funafuti'): ?> selected <?php endif; ?>>(UTC+12:00) Funafuti</option>
												<option value="Asia/Kamchatka" <?php if(config('app.timezone') == 'Asia/Kamchatka'): ?> selected <?php endif; ?>>(UTC+12:00) Kamchatka</option>
												<option value="Pacific/Kwajalein" <?php if(config('app.timezone') == 'Pacific/Kwajalein'): ?> selected <?php endif; ?>>(UTC+12:00) Kwajalein</option>
												<option value="Asia/Magadan" <?php if(config('app.timezone') == 'Asia/Magadan'): ?> selected <?php endif; ?>>(UTC+12:00) Magadan</option>
												<option value="Pacific/Majuro" <?php if(config('app.timezone') == 'Pacific/Majuro'): ?> selected <?php endif; ?>>(UTC+12:00) Majuro</option>
												<option value="Antarctica/McMurdo" <?php if(config('app.timezone') == 'Antarctica/McMurdo'): ?> selected <?php endif; ?>>(UTC+12:00) McMurdo</option>
												<option value="Pacific/Nauru" <?php if(config('app.timezone') == 'Pacific/Nauru'): ?> selected <?php endif; ?>>(UTC+12:00) Nauru</option>
												<option value="Antarctica/South_Pole" <?php if(config('app.timezone') == 'Antarctica/South_Pole'): ?> selected <?php endif; ?>>(UTC+12:00) South Pole</option>
												<option value="Pacific/Tarawa" <?php if(config('app.timezone') == 'Pacific/Tarawa'): ?> selected <?php endif; ?>>(UTC+12:00) Tarawa</option>
												<option value="Pacific/Wake" <?php if(config('app.timezone') == 'Pacific/Wake'): ?> selected <?php endif; ?>>(UTC+12:00) Wake</option>
												<option value="Pacific/Wallis" <?php if(config('app.timezone') == 'Pacific/Wallis'): ?> selected <?php endif; ?>>(UTC+12:00) Wallis</option>
												<option value="Pacific/Chatham" <?php if(config('app.timezone') == 'Pacific/Chatham'): ?> selected <?php endif; ?>>(UTC+12:45) Chatham</option>
												<option value="Pacific/Apia" <?php if(config('app.timezone') == 'Pacific/Apia'): ?> selected <?php endif; ?>>(UTC+13:00) Apia</option>
												<option value="Pacific/Enderbury" <?php if(config('app.timezone') == 'Pacific/Enderbury'): ?> selected <?php endif; ?>>(UTC+13:00) Enderbury</option>
												<option value="Pacific/Fakaofo" <?php if(config('app.timezone') == 'Pacific/Fakaofo'): ?> selected <?php endif; ?>>(UTC+13:00) Fakaofo</option>
												<option value="Pacific/Tongatapu" <?php if(config('app.timezone') == 'Pacific/Tongatapu'): ?> selected <?php endif; ?>>(UTC+13:00) Tongatapu</option>
												<option value="Pacific/Kiritimati" <?php if(config('app.timezone') == 'Pacific/Kiritimati'): ?> selected <?php endif; ?>>(UTC+14:00) Kiritimati</option>
											</select> 
										</div> 
									</div>

								</div>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6><?php echo e(__('Default Group for New Users')); ?></h6>
											<select id="user-group" name="user-group" data-placeholder="<?php echo e(__('Select Default New User Group')); ?>">	
												<option value="user" <?php echo e((config('settings.default_user') == 'user') ? 'selected' : ''); ?>><?php echo e(__('User')); ?></option>
												<option value="subscriber" <?php echo e((config('settings.default_user') == 'subscriber') ? 'selected' : ''); ?>><?php echo e(__('Subscriber')); ?></option>
												<option value="admin" <?php echo e((config('settings.default_user') == 'admin') ? 'selected' : ''); ?>><?php echo e(__('Administrator')); ?></option>																		
											</select> 
										</div> 
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6><?php echo e(__('Email for Support Tickets')); ?></h6>
											<select id="support-ticket" name="support-ticket" data-placeholder="<?php echo e(__('Enable/Disable Email Sending for Support Ticket Statuses')); ?>">	
												<option value="enabled" <?php echo e((config('settings.support_email') == 'enabled') ? 'selected' : ''); ?>><?php echo e(__('Enable')); ?></option>
												<option value="disabled" <?php echo e((config('settings.support_email') == 'disabled') ? 'selected' : ''); ?>><?php echo e(__('Disable')); ?></option>																		
											</select> 
										</div> 
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6><?php echo e(__('User Notifications Panel')); ?></h6>
											<select id="user-notification" name="user-notification" data-placeholder="<?php echo e(__('Enable/Disable User Notification View Panel')); ?>">	
												<option value="enabled" <?php echo e((config('settings.user_notification') == 'enabled') ? 'selected' : ''); ?>><?php echo e(__('Enable')); ?></option>
												<option value="disabled" <?php echo e((config('settings.user_notification') == 'disabled') ? 'selected' : ''); ?>><?php echo e(__('Disable')); ?></option>																		
											</select> 
										</div> 
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">									
										<div class="input-box">								
											<h6><?php echo e(__('User Support Request Panel')); ?></h6>
											<select id="user-support" name="user-support" data-placeholder="Enable/Disable User Support Ticket Panel">	
												<option value="enabled" <?php echo e((config('settings.user_support') == 'enabled') ? 'selected' : ''); ?>><?php echo e(__('Enable')); ?></option>
												<option value="disabled" <?php echo e((config('settings.user_support') == 'disabled') ? 'selected' : ''); ?>><?php echo e(__('Disable')); ?></option>																		
											</select> 
										</div> 
									</div>
								</div>
	
							</div>
						</div>

						<div class="card border-0 special-shadow">							
							<div class="card-body">
								<h6 class="fs-12 font-weight-bold mb-4"><?php echo e(__('Live Chat')); ?> <span class="text-muted">(<?php echo e(__('tawk.to')); ?>)</span></h6>
								
								<div class="form-group">
									<label class="custom-switch">
										<input type="checkbox" name="enable-live-chat" class="custom-switch-input" <?php if( config('settings.live_chat')  == 'on'): ?> checked <?php endif; ?>>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description"><?php echo e(__('Enable Live Chat')); ?></span>
									</label>
								</div>
							
								<div class="input-box mb-2 mt-2">								
									<h6><?php echo e(__('Direct Chat Link')); ?></h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['live-chat-link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="live-chat-link" name="live-chat-link" value="<?php echo e(config('settings.live_chat_link')); ?>" autocomplete="off">
										<?php $__errorArgs = ['live-chat-link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
											<p class="text-danger"><?php echo e($errors->first('live-chat-link')); ?></p>
										<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
									</div> 
								</div> 	
							</div>
						</div>

						<div class="card border-0 special-shadow">							
							<div class="card-body pb-0">
								<h6 class="fs-12 font-weight-bold mb-4"><?php echo e(__('Google reCaptcha v3')); ?></h6>
								
								<div class="form-group">
									<label class="custom-switch">
										<input type="checkbox" name="enable-recaptcha" class="custom-switch-input" <?php if( config('services.google.recaptcha.enable')  == 'on'): ?> checked <?php endif; ?>>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description"><?php echo e(__('Enable Google reCaptcha')); ?></span>
									</label>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box mt-2">								
											<h6><?php echo e(__('reCaptcha Site Key')); ?></h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['recaptcha-site-key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="recaptcha-site-key" name="recaptcha-site-key" value="<?php echo e(config('services.google.recaptcha.site_key')); ?>" autocomplete="off">
												<?php $__errorArgs = ['recaptcha-site-key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
													<p class="text-danger"><?php echo e($errors->first('recaptcha-site-key')); ?></p>
												<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- SECRET ACCESS KEY -->
										<div class="input-box mt-2">								
											<h6><?php echo e(__('reCaptcha Secret Key')); ?></h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['recaptcha-secret-key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="recaptcha-secret-key" name="recaptcha-secret-key" value="<?php echo e(config('services.google.recaptcha.secret_key')); ?>" autocomplete="off">
												<?php $__errorArgs = ['recaptcha-secret-key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
													<p class="text-danger"><?php echo e($errors->first('recaptcha-secret-key')); ?></p>
												<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
											</div> 
										</div> <!-- END SECRET ACCESS KEY -->
									</div>
								</div>	
							</div>
						</div>	

						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body pb-0">

								<h6 class="fs-12 font-weight-bold mb-4"><?php echo e(__('Google Analytics')); ?></h6>

								<div class="form-group">
									<label class="custom-switch">
										<input type="checkbox" name="enable-analytics" class="custom-switch-input" <?php if( config('services.google.analytics.enable')  == 'on'): ?> checked <?php endif; ?>>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description"><?php echo e(__('Enable Google Analytics')); ?></span>
									</label>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box mt-2">								
											<h6><?php echo e(__('Google Analytics Tracking ID')); ?></h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['google-analytics'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="google-analytics" name="google-analytics" value="<?php echo e(config('services.google.analytics.id')); ?>" autocomplete="off">
												<?php $__errorArgs = ['google-analytics'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
													<p class="text-danger"><?php echo e($errors->first('google-analytics')); ?></p>
												<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>		
								
								</div>
	
							</div>
						</div>

						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body pb-0">

								<h6 class="fs-12 font-weight-bold mb-4"><?php echo e(__('Google Maps')); ?></h6>

								<div class="form-group">
									<label class="custom-switch">
										<input type="checkbox" name="enable-maps" class="custom-switch-input" <?php if( config('services.google.maps.enable')  == 'on'): ?> checked <?php endif; ?>>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description"><?php echo e(__('Enable Google Maps')); ?></span>
									</label>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box mt-2">								
											<h6><?php echo e(__('Google Maps API Key')); ?></h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['google-key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="google-key" name="google-key" value="<?php echo e(config('services.google.maps.key')); ?>" autocomplete="off">
												<?php $__errorArgs = ['google-key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
													<p class="text-danger"><?php echo e($errors->first('google-key')); ?></p>
												<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
											</div> 
										</div> <!-- END ACCESS KEY -->
									</div>								
								</div>
							</div>
						</div>						
						
						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><?php echo e(__('GDPR Policy')); ?></h6>

								<div class="form-group">
									<label class="custom-switch">
										<input type="checkbox" name="enable-gdpr" class="custom-switch-input" <?php if( config('cookie-consent.enabled') ): ?> checked <?php endif; ?>>
										<span class="custom-switch-indicator"></span>
										<span class="custom-switch-description"><?php echo e(__('Enable GDPR Consent Popup')); ?></span>
									</label>
								</div>	
							</div>
						</div>


						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-cancel mr-2"><?php echo e(__('Cancel')); ?></a>
							<button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>							
						</div>				

					</form>
					
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/admin/settings/global/index.blade.php ENDPATH**/ ?>