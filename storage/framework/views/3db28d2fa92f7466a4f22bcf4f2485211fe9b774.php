<?php if(config('frontend.custom_url.status') == 'on'): ?>
    <script type="text/javascript">
		window.location.href = "<?php echo e(config('frontend.custom_url.link')); ?>"
	</script>
<?php else: ?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
		<!-- Meta data -->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="<?php echo e($information['author']); ?>">
	    <meta name="keywords" content="<?php echo e($information['keywords']); ?>">
	    <meta name="description" content="<?php echo e($information['description']); ?>">
		
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <!-- Title -->
        <title><?php echo e($information['title']); ?></title>

        <!--CSS Files -->
        <link href="<?php echo e(URL::asset('plugins/slick/slick.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(URL::asset('plugins/slick/slick-theme.css')); ?>" rel="stylesheet">

		<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<!--Custom User CSS File -->
		<link href="<?php echo e(URL::asset($information['css'])); ?>" rel="stylesheet">

		<!--Google AdSense-->
		<?php echo adsense_header(); ?>


	</head>

	<body class="app sidebar-mini frontend-body <?php echo e(Request::path() != '/' ? 'blue-background' : ''); ?>">

		<?php if(config('frontend.maintenance') == 'on'): ?>
			
			<div class="container h-100vh">
				<div class="row text-center h-100vh align-items-center">
					<div class="col-md-12">
						<img src="<?php echo e(URL::asset('img/files/maintenance.png')); ?>" alt="Maintenance Image">
						<h2 class="mt-4 font-weight-bold"><?php echo e(__('We are just tuning up a few things')); ?>.</h2>
						<h5><?php echo e(__('We apologize for the inconvenience but')); ?> <span class="font-weight-bold text-info"><?php echo e(config('app.name')); ?></span> <?php echo e(__('is currently undergoing planned maintenance')); ?>.</h5>
					</div>
				</div>
			</div>
		<?php else: ?>

			<!-- Page -->
			<?php if(config('frontend.frontend_page') == 'on'): ?>
						
				<div class="page">
					<div class="page-main">

						<section id="main-wrapper">
					
							<div class="relative flex items-top justify-center min-h-screen">
				
								<div class="container-fluid fixed-top" id="navbar-container">
				
									<div class="container">
										<div class="row">
				
											<nav class="navbar navbar-expand-lg navbar-light w-100" id="navbar-responsive">
												<a class="navbar-brand" href="<?php echo e(url('/')); ?>"><img src="<?php echo e(URL::asset('img/brand/logo.png')); ?>" alt=""></a>
												<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
													<span class="navbar-toggler-icon"></span>
												</button>
												<div class="collapse navbar-collapse section-links" id="navbarNav">
													<ul class="navbar-nav">
														<li class="nav-item">
															<a class="nav-link scroll" href="<?php echo e(url('/')); ?>"><?php echo e(__('Home')); ?> <span class="sr-only">(current)</span></a>
														</li>						

														<li class="nav-item text-center frontend-buttons">
															<?php if(Route::has('login')): ?>
																<div>
																	<?php if(auth()->guard()->check()): ?>
																		<a href="<?php echo e(route('user.dashboard')); ?>" class="action-button dashboard-button pl-5 pr-5"><?php echo e(__('Dashboard')); ?></a>
																	<?php else: ?>
																		<a href="<?php echo e(route('login')); ?>" class="action-button" id="login-button"><?php echo e(__('Login')); ?></a>
				
																		<?php if(config('settings.registration') == 'enabled'): ?>
																			<?php if(Route::has('register')): ?>
																				<a href="<?php echo e(route('register')); ?>" class="ml-2 action-button register-button pl-5 pr-5"><?php echo e(__('Sign Up')); ?></a>
																			<?php endif; ?>
																		<?php endif; ?>
																	<?php endif; ?>
																</div>
															<?php endif; ?>
														</li>
													</ul>
												</div>
											</nav>
				
										</div>
									</div>
				
									<?php echo $__env->make('layouts.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				
								</div>
				
							</div>  
						</section>

						<!-- App-Content -->			
						<div class="main-content">
							<div class="side-app">

								<?php echo $__env->yieldContent('content'); ?>

							</div>                   
						</div>
				
				</div><!-- End Page -->
			
				<!-- FOOTER SECTION
				========================================================-->
				<footer id="welcome-footer" >

					<!-- FOOTER MAIN CONTENT -->
					<div id="footer" class="container text-center">
								
						<div class="row">    

							<!-- FOOTER TITLE -->
							<div class="col-md-4 col-sm-12" id="footer-logo">
								
								<img src="<?php echo e(URL::asset('img/brand/logo-white.png')); ?>" alt="Brand Logo">

								<p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi ut culpa maiores maxime illo nostrum aut totam, porro dolore minima</p>		

								<div class="dropdown header-locale" id="frontend-local">
									<a class="nav-link icon" data-bs-toggle="dropdown">
										<span class="fs-17 fa fa-globe pr-2"></span><span class="fs-12" style="vertical-align:middle"><?php echo e(Config::get('locale')[App::getLocale()]['code']); ?></span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
										<div class="local-menu">
											<?php $__currentLoopData = Config::get('locale'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php if($lang != App::getLocale()): ?>
													<a href="<?php echo e(route('locale', $lang)); ?>" class="dropdown-item d-flex">
														<div class="text-info"><i class="flag flag-<?php echo e($language['flag']); ?> mr-3"></i></div>
														<div>
															<span class="font-weight-normal fs-12"><?php echo e($language['display']); ?></span>
														</div>
													</a>                                        
												<?php endif; ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
									</div>
								</div>

							</div> <!-- END FOOTER TITLE & SOCIAL ICONS -->


							<!-- FOOTER LINKS -->
							<div class="col-md-8 col-sm-12" id="footer-links">
								
								<div class="row w-100">

									<!-- INFORMATION LINKS -->
									<div class="col-md-3 col-sm-12">
									
										<h5><?php echo e(__('Information')); ?></h5>

										<ul class="list-unstyled">
											<li><a href="https://aws.amazon.com" target="_blank"><?php echo e(__('AWS Cloud')); ?></a></li>                             
										</ul>

									</div> <!-- END INFORMATION LINKS -->


									<!-- SOLUTIONS LINKS -->
									<div class="col-md-3 col-sm-12">				
											
										<h5><?php echo e(__('Site Pages')); ?></h5>

										<ul class="list-unstyled">
											<li><a href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a></li>							
											<li><a href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a></li>							
										</ul>				

									</div> <!-- END SOLUTIONS LINKS -->


									<!-- COMPANY LINKS -->
									<div class="col-md-3 col-sm-12">
										
										<h5><?php echo e(__('Company')); ?></h5>
										
										<ul class="list-unstyled">
											<li><a href="<?php echo e(route('terms')); ?>"><?php echo e(__('Terms & Conditions')); ?></a></li>
											<li><a href="<?php echo e(route('privacy')); ?>"><?php echo e(__('Privacy Policy')); ?></a></li>							
										</ul>		         

									</div> <!-- COMPANY LINKS -->

									
									<!-- CONNECTION & NEWS LINKS -->
									<div class="col-md-3 col-sm-12 footer-connect pr-0">
																
										<h5><?php echo e(__('Social Media')); ?></h5>

										<h6><?php echo e(__('Follow up on social media to find out the latest updates')); ?>.</h6>

										<ul id="footer-icons" class="list-inline">
											<?php if(config('frontend.social_linkedin')): ?>
												<a href="<?php echo e(config('frontend.social_linkedin')); ?>" target="_blank"><li class="list-inline-item"><i class="footer-icon fa-brands fa-linkedin"></i></li></a>
											<?php endif; ?>
											<?php if(config('frontend.social_twitter')): ?>
												<a href="<?php echo e(config('frontend.social_twitter')); ?>" target="_blank"><li class="list-inline-item"><i class="footer-icon fa-brands fa-twitter"></i></li></a>
											<?php endif; ?>
											<?php if(config('frontend.social_instagram')): ?>
												<a href="<?php echo e(config('frontend.social_instagram')); ?>" target="_blank"><li class="list-inline-item"><i class="footer-icon fa-brands fa-instagram"></i></li></a>
											<?php endif; ?>
											<?php if(config('frontend.social_facebook')): ?>
												<a href="<?php echo e(config('frontend.social_facebook')); ?>" target="_blank"><li class="list-inline-item"><i class="footer-icon fa-brands fa-facebook"></i></li></a>
											<?php endif; ?>											
											
										</ul>

										<h5 class="mt-6 mb-4"><?php echo e(__('Get Started For Free')); ?></h5>

										<a href="<?php echo e(route('register')); ?>" class="btn btn-primary pl-5 pr-5"><?php echo e(__('Sign Up Now')); ?></a>

									</div> <!-- END CONNECTION & NEWS LINKS -->
								
								</div>


							</div> <!-- END FOOTER LINKS -->
							

						</div> <!-- END ROW -->

					</div> <!-- END CONTAINER-->



					<!-- COPYRIGHT INFORMATION -->
					<div id="copyright" class="container">
						
						<p class="copyright-left"><?php echo e(__('Copyright')); ?> © <?php echo e(date("Y")); ?> <a href="<?php echo e(config('app.url')); ?>"><?php echo e(config('app.name')); ?></a> <?php echo e(__(' All rights reserved')); ?></p>
						
						<div>
							<p class="copyright-right"><a href="<?php echo e(route('terms')); ?>" target="_blank"><?php echo e(__('Terms & Conditions')); ?></a></p>
							<p class="copyright-right"><a href="<?php echo e(route('privacy')); ?>" target="_blank"><?php echo e(__('Privacy Policy')); ?></a><span>|</span></p>
						</div>

						<!-- SCROLL TO TOP -->
						<a href="#top" id="back-to-top"><i class="fa fa-angle-double-up"></i></a>

					</div>
					
				</footer> <!-- END FOOTER -->  

				<?php echo $__env->make('cookie-consent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			<?php endif; ?>
		
		<?php endif; ?>

		<?php echo $__env->make('layouts.footer-frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<!-- Custom User JS File -->
		<?php if($information['js']): ?>
			<script src="<?php echo e(URL::asset($information['js'])); ?>"></script>
		<?php endif; ?>
		
            
	</body>
</html>

<?php endif; ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/layouts/guest.blade.php ENDPATH**/ ?>