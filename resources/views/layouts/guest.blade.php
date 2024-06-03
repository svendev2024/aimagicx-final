@if (config('frontend.custom_url.status') == 'on')
    <script type="text/javascript">
		window.location.href = "{{ config('frontend.custom_url.link') }}"
	</script>
@else

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<!-- Meta data -->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="{{ $information['author'] }}">
	    <meta name="keywords" content="{{ $information['keywords'] }}">
	    <meta name="description" content="{{ $information['description'] }}">
		
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title -->
        <title>{{ $information['title'] }}</title>

        <!--CSS Files -->
        <link href="{{URL::asset('plugins/slick/slick.css')}}" rel="stylesheet">
        <link href="{{URL::asset('plugins/slick/slick-theme.css')}}" rel="stylesheet">

		@include('layouts.header')

		<!--Custom User CSS File -->
		<link href="{{URL::asset($information['css'])}}" rel="stylesheet">

		<!--Google AdSense-->
		{!! adsense_header() !!}

	</head>

	<body class="app sidebar-mini frontend-body {{ Request::path() != '/' ? 'blue-background' : '' }}">

		@if (config('frontend.maintenance') == 'on')
			
			<div class="container h-100vh">
				<div class="row text-center h-100vh align-items-center">
					<div class="col-md-12">
						<img src="{{ URL::asset('img/files/maintenance.png') }}" alt="Maintenance Image">
						<h2 class="mt-4 font-weight-bold">{{ __('We are just tuning up a few things') }}.</h2>
						<h5>{{ __('We apologize for the inconvenience but') }} <span class="font-weight-bold text-info">{{ config('app.name') }}</span> {{ __('is currently undergoing planned maintenance') }}.</h5>
					</div>
				</div>
			</div>
		@else

			<!-- Page -->
			@if (config('frontend.frontend_page') == 'on')
						
				<div class="page">
					<div class="page-main">

						<section id="main-wrapper">
					
							<div class="relative flex items-top justify-center min-h-screen">
				
								<div class="container-fluid fixed-top" id="navbar-container">
				
									<div class="container">
										<div class="row">
				
											<nav class="navbar navbar-expand-lg navbar-light w-100" id="navbar-responsive">
												<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ URL::asset('img/brand/logo.png') }}" alt=""></a>
												<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
													<span class="navbar-toggler-icon"></span>
												</button>
												<div class="collapse navbar-collapse section-links" id="navbarNav">
													<ul class="navbar-nav">
														<li class="nav-item">
															<a class="nav-link scroll" href="{{ url('/') }}">{{ __('Home') }} <span class="sr-only">(current)</span></a>
														</li>						

														<li class="nav-item text-center frontend-buttons">
															@if (Route::has('login'))
																<div>
																	@auth
																		<a href="{{ route('user.dashboard') }}" class="action-button dashboard-button pl-5 pr-5">{{ __('Dashboard') }}</a>
																	@else
																		<a href="{{ route('login') }}" class="action-button" id="login-button">{{ __('Login') }}</a>
				
																		@if (config('settings.registration') == 'enabled')
																			@if (Route::has('register'))
																				<a href="{{ route('register') }}" class="ml-2 action-button register-button pl-5 pr-5">{{ __('Sign Up') }}</a>
																			@endif
																		@endif
																	@endauth
																</div>
															@endif
														</li>
													</ul>
												</div>
											</nav>
				
										</div>
									</div>
				
									@include('layouts.flash')
				
								</div>
				
							</div>  
						</section>

						<!-- App-Content -->			
						<div class="main-content">
							<div class="side-app">

								@yield('content')

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
								
								<img src="{{ URL::asset('img/brand/logo-white.png') }}" alt="Brand Logo">

								<p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi ut culpa maiores maxime illo nostrum aut totam, porro dolore minima</p>		

								<div class="dropdown header-locale" id="frontend-local">
									<a class="nav-link icon" data-bs-toggle="dropdown">
										<span class="fs-17 fa fa-globe pr-2"></span><span class="fs-12" style="vertical-align:middle">{{ Config::get('locale')[App::getLocale()]['code'] }}</span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
										<div class="local-menu">
											@foreach (Config::get('locale') as $lang => $language)
												@if ($lang != App::getLocale())
													<a href="{{ route('locale', $lang) }}" class="dropdown-item d-flex">
														<div class="text-info"><i class="flag flag-{{ $language['flag'] }} mr-3"></i></div>
														<div>
															<span class="font-weight-normal fs-12">{{ $language['display'] }}</span>
														</div>
													</a>                                        
												@endif
											@endforeach
										</div>
									</div>
								</div>

							</div> <!-- END FOOTER TITLE & SOCIAL ICONS -->


							<!-- FOOTER LINKS -->
							<div class="col-md-8 col-sm-12" id="footer-links">
								
								<div class="row w-100">

									<!-- INFORMATION LINKS -->
									<div class="col-md-3 col-sm-12">
									
										<h5>{{ __('Information') }}</h5>

										<ul class="list-unstyled">
											<li><a href="https://aws.amazon.com" target="_blank">{{ __('AWS Cloud') }}</a></li>                             
										</ul>

									</div> <!-- END INFORMATION LINKS -->


									<!-- SOLUTIONS LINKS -->
									<div class="col-md-3 col-sm-12">				
											
										<h5>{{ __('Site Pages') }}</h5>

										<ul class="list-unstyled">
											<li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>							
											<li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>							
										</ul>				

									</div> <!-- END SOLUTIONS LINKS -->


									<!-- COMPANY LINKS -->
									<div class="col-md-3 col-sm-12">
										
										<h5>{{ __('Company') }}</h5>
										
										<ul class="list-unstyled">
											<li><a href="{{ route('terms') }}">{{ __('Terms & Conditions') }}</a></li>
											<li><a href="{{ route('privacy') }}">{{ __('Privacy Policy') }}</a></li>							
										</ul>		         

									</div> <!-- COMPANY LINKS -->

									
									<!-- CONNECTION & NEWS LINKS -->
									<div class="col-md-3 col-sm-12 footer-connect pr-0">
																
										<h5>{{ __('Social Media') }}</h5>

										<h6>{{ __('Follow up on social media to find out the latest updates') }}.</h6>

										<ul id="footer-icons" class="list-inline">
											@if (config('frontend.social_linkedin'))
												<a href="{{ config('frontend.social_linkedin') }}" target="_blank"><li class="list-inline-item"><i class="footer-icon fa-brands fa-linkedin"></i></li></a>
											@endif
											@if (config('frontend.social_twitter'))
												<a href="{{ config('frontend.social_twitter') }}" target="_blank"><li class="list-inline-item"><i class="footer-icon fa-brands fa-twitter"></i></li></a>
											@endif
											@if (config('frontend.social_instagram'))
												<a href="{{ config('frontend.social_instagram') }}" target="_blank"><li class="list-inline-item"><i class="footer-icon fa-brands fa-instagram"></i></li></a>
											@endif
											@if (config('frontend.social_facebook'))
												<a href="{{ config('frontend.social_facebook') }}" target="_blank"><li class="list-inline-item"><i class="footer-icon fa-brands fa-facebook"></i></li></a>
											@endif											
											
										</ul>

										<h5 class="mt-6 mb-4">{{ __('Get Started For Free') }}</h5>

										<a href="{{ route('register') }}" class="btn btn-primary pl-5 pr-5">{{ __('Sign Up Now') }}</a>

									</div> <!-- END CONNECTION & NEWS LINKS -->
								
								</div>


							</div> <!-- END FOOTER LINKS -->
							

						</div> <!-- END ROW -->

					</div> <!-- END CONTAINER-->



					<!-- COPYRIGHT INFORMATION -->
					<div id="copyright" class="container">
						
						<p class="copyright-left">{{ __('Copyright') }} © {{ date("Y") }} <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> {{ __(' All rights reserved') }}</p>
						
						<div>
							<p class="copyright-right"><a href="{{ route('terms') }}" target="_blank">{{ __('Terms & Conditions') }}</a></p>
							<p class="copyright-right"><a href="{{ route('privacy') }}" target="_blank">{{ __('Privacy Policy') }}</a><span>|</span></p>
						</div>

						<!-- SCROLL TO TOP -->
						<a href="#top" id="back-to-top"><i class="fa fa-angle-double-up"></i></a>

					</div>
					
				</footer> <!-- END FOOTER -->  

				@include('cookie-consent::index')

			@endif
		
		@endif

		@include('layouts.footer-frontend')

		<!-- Custom User JS File -->
		@if ($information['js'])
			<script src="{{URL::asset($information['js'])}}"></script>
		@endif
		
            
	</body>
</html>

@endif