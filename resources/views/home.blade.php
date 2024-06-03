@extends('layouts.frontend')

@section('css')
    <link href="{{URL::asset('plugins/slick/slick.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('plugins/slick/slick-theme.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('plugins/aos/aos.css')}}" rel="stylesheet" />
@endsection

@section('content')

        <section id="main-wrapper">
            
            <div class="h-100vh justify-center min-h-screen" id="main-background">

                <div class="container h-100vh ">
                    <div class="row h-100vh vertical-center">
                        <div class="col-sm-12 upload-responsive">
                            <div class="text-container text-center">
                                <h3 class="mb-4 font-weight-bold text-white" data-aos="fade-left" data-aos-delay="400" data-aos-once="true" data-aos-duration="700">{{ __('Meet') }}, {{ config('app.name') }}</span></h3>
                                <h1 class=" text-white" data-aos="fade-left" data-aos-delay="500" data-aos-once="true" data-aos-duration="700">{{ __('The Future of Writing') }}</span></h1>
                                <h1 class=" mb-0 gradient fixed-height" id="typed" data-aos="fade-left" data-aos-delay="600" data-aos-once="true" data-aos-duration="900"></h1>
                                <p class="fs-18 text-white" data-aos="fade-left" data-aos-delay="700" data-aos-once="true" data-aos-duration="1100">{{ __('Let AI create content for blogs, articles, websites, social media and more') }}</p>

                                <a href="{{ route('register') }}" class="btn btn-primary special-action-button" data-aos="fade-left" data-aos-delay="800" data-aos-once="true" data-aos-duration="1100">{{ __('Try Now For Free') }}</a>

                            </div>
                        </div>                                
                    </div>           
                </div>

            </div> 
        </section>
        <div class="container home-container" style="/*display: none;*/"> 
 



        <!-- SECTION - FEATURES
        ========================================================-->
        @if (config('frontend.features_section') == 'on')
            <section id="features-wrapper">
                

                {!! adsense_frontend_features_728x90() !!}
                

                <div class="container">

                    <div class="row text-center mt-8 mb-8">
                        <div class="col-md-12 title">
                            <h6><span>{{ config('app.name') }}</span> {{ __('Benefits') }}</h6>
                            <p>{{ __('Enjoy the full flexibility of the platform with ton of features') }}</p>
                        </div>
                    </div>
        
                        
                    <!-- LIST OF SOLUTIONS -->
                    <div class="row d-flex" id="solutions-list">
                        
                        <div class="col-md-4 col-sm-12">
                            <!-- SOLUTION -->
                            <div class="col-sm-12 mb-6">
                                    
                                
                                <div class="solution" data-aos="zoom-in" data-aos-delay="1000" data-aos-once="true" data-aos-duration="1000">                                                                          
                                    
                                    <div class="solution-content">
                                        
                                        <div class="solution-logo mb-3">
                                            <img src="{{ URL::asset('img/files/01.png') }}" alt="">
                                        </div>
                                    
                                        <h5>{{ __('Latest AI technology') }}</h5>
                                        
                                        <p>Lorem ipsum dolor sit amet est consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                    </div>                         

                                </div>

                            </div> <!-- END SOLUTION -->
                            
                            <!-- SOLUTION -->
                            <div class="col-sm-12 mb-6">
                                    
                                <div class="solution" data-aos="zoom-in" data-aos-delay="1500" data-aos-once="true" data-aos-duration="1500">
                                    
                                    <div class="solution-content">
                                        
                                        <div class="solution-logo mb-3">
                                            <img src="{{ URL::asset('img/files/09.png') }}" alt="">
                                        </div>
                                    
                                        <h5>{{ __('More than +25 Languages') }}</h5>
                                        
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                    </div>

                                </div>

                            </div> <!-- END SOLUTION -->

                            <!-- SOLUTION -->
                            <div class="col-sm-12 mb-6">
                                    
                                <div class="solution" data-aos="zoom-in" data-aos-delay="2000" data-aos-once="true" data-aos-duration="2000">
                                    
                                    <div class="solution-content">
                                        
                                        <div class="solution-logo mb-3">
                                            <img src="{{ URL::asset('img/files/06.png') }}" alt="">
                                        </div>
                                    
                                        <h5>{{ __('2FA Account Protection') }}</h5>
                                        
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                    </div>

                                </div>

                            </div> <!-- END SOLUTION -->
                        </div>

                        <div class="col-md-4 col-sm-12 mt-7">
                            <!-- SOLUTION -->
                            <div class="col-sm-12 mb-6">
                                    
                                <div class="solution" data-aos="zoom-in" data-aos-delay="1000" data-aos-once="true" data-aos-duration="1000">
                                    
                                    <div class="solution-content">
                                        
                                        <div class="solution-logo mb-3">
                                            <img src="{{ URL::asset('img/files/05.png') }}" alt="">
                                        </div>
                                    
                                        <h5>{{ __('Edit AI Text Easily') }}</h5>
                                        
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                    </div>

                                </div>

                            </div> <!-- END SOLUTION -->


                            <!-- SOLUTION -->
                            <div class="col-sm-12 mb-6">
                                    
                                <div class="solution" data-aos="zoom-in" data-aos-delay="1500" data-aos-once="true" data-aos-duration="1500">
                                    
                                    <div class="solution-content">
                                        
                                        <div class="solution-logo mb-3">
                                            <img src="{{ URL::asset('img/files/03.png') }}" alt="">
                                        </div>
                                    
                                        <h5>{{ __('Export Text Results in PDF & Word') }}</h5>
                                        
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                    </div>                                

                                </div>

                            </div> <!-- END SOLUTION -->


                            <!-- SOLUTION -->
                            <div class="col-sm-12 mb-6">
                                    
                                <div class="solution" data-aos="zoom-in" data-aos-delay="2000" data-aos-once="true" data-aos-duration="2000">
                                    
                                    <div class="solution-content">
                                        
                                        <div class="solution-logo mb-3">
                                            <img src="{{ URL::asset('img/files/04.png') }}" alt="">
                                        </div>
                                    
                                        <h5>{{ __('Generate AI Images by Using Text') }}</h5>
                                        
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                    </div>

                                </div>

                            </div> <!-- END SOLUTION -->
                        </div>

                        <div class="col-md-4 col-sm-12 d-flex">

                            <div class="feature-text">
                                <div>
                                    <h4><span class="text-primary">{{ config('app.name') }}</span> {{ __('Uses most sophisticated Artificial Intelligence Technology') }}</h4>
                                </div>
                                
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, quibusdam? Illum ad eius, molestiae placeat dicta quae, ab nihil omnis obcaecati reiciendis recusandae, voluptatem eos molestias aliquam saepe tenetur optio? Consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati.</p>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde ea et, error quisquam corporis, architecto minus doloremque aut facere itaque culpa eos molestias nulla reiciendis animi dolores, quod sunt illum.</p>
                            </div>
                            
                        </div>
                        
                    </div> <!-- END LIST OF SOLUTIONS -->
         

                </div>

            </section>
        @endif


        <!-- SECTION - FEATURES - TEMPLATES
        ========================================================-->
        @if (config('frontend.features_section') == 'on')
            <section id="features-wrapper">

                {!! adsense_frontend_features_728x90() !!}
                

                <div class="container">

                    <div class="row text-center mb-8">
                        <div class="col-md-12 title">
                            <h6><span>{{ config('app.name') }}</span> {{ __('Templates') }}</h6>
                            <p>{{ __('A lot of AI templates that will allow you generate any text within seconds') }}</p>
                        </div>
                    </div>
        
                        
                    <!-- LIST OF SOLUTIONS -->
                    <div class="row d-flex">
                        
                        @foreach ($other_templates as $template)
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="template mt-2">
                                    <a id="{{ $template->template_code }}"></a>
                                    <div class="card border-0" id="{{ $template->template_code }}-card" onclick="window.location.href='{{ url('user/templates') }}/{{ $template->slug }}'">
                                        <div class="card-body pt-5">
                                            <div class="template-icon mb-4">
                                                {!! $template->icon !!}												
                                            </div>
                                            <div class="template-title">
                                                <h6 class="mb-2 fs-16 number-font">{{ __($template->name) }}</h6>
                                            </div>
                                            <div class="template-info">
                                                <p class="fs-12 text-muted mb-2">{{ __($template->description) }}</p>
                                            </div>
                                            @if($template->professional) <p class="fs-8 btn btn-yellow"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }}</p> @endif
                                        </div>
                                    </div>
                                </div>							
                            </div>
                        @endforeach

                        @foreach ($custom_templates as $template)
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="template mt-2">
                                    <a id="{{ $template->template_code }}"></a>
                                    <div class="card border-0" id="{{ $template->template_code }}-card" onclick="window.location.href='{{ url('user/templates') }}/{{ $template->slug }}/{{ $template->template_code }}'">
                                        <div class="card-body pt-5">
                                            <div class="template-icon mb-4">
                                                {!! $template->icon !!}												
                                            </div>
                                            <div class="template-title">
                                                <h6 class="mb-2 fs-16 number-font">{{ __($template->name) }}</h6>
                                            </div>
                                            <div class="template-info">
                                                <p class="fs-12 text-muted mb-2">{{ __($template->description) }}</p>
                                            </div>
                                            @if($template->professional) <p class="fs-8 btn btn-yellow"><i class="fa-sharp fa-solid fa-crown mr-2"></i>{{ __('Pro') }}</p> @endif
                                        </div>
                                    </div>
                                </div>							
                            </div>
                        @endforeach
                        
                    </div> <!-- END LIST OF SOLUTIONS -->
         

                </div>

            </section>
        @endif


        <!-- SECTION - CUSTOMER FEEDBACKS
        ========================================================-->
        @if (config('frontend.reviews_section') == 'on')
            <section id="feedbacks-wrapper">

                <div class="container pt-4 text-center">


                    <!-- SECTION TITLE -->
                    <div class="row mb-8">

                        <div class="title">
                            <h6>{{ __('Customer') }} <span>{{ __('Reviews') }}</span></h6>
                            <p>{{ __('We guarantee that you will be one of our happy customers as well') }}</p>
                        </div>

                    </div> <!-- END SECTION TITLE -->

                    @if ($review_exists)

                        <div class="row" id="feedbacks">
                            
                            @foreach ($reviews as $review)
                                <div class="feedback" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                                    <!-- MAIN COMMENT -->
                                    <p class="comment"><sup><span class="fa fa-quote-left"></span></sup> {{ __($review->text) }} <sub><span class="fa fa-quote-right"></span></sub></p>

                                    <!-- COMMENTER -->
                                    <div class="feedback-image d-flex">
                                        <div>
                                            <img src="{{ URL::asset($review->image_url) }}" alt="Feedback" class="rounded-circle"><span class="small-quote fa fa-quote-left"></span>
                                        </div>

                                        <div class="pt-3">
                                            <p class="feedback-reviewer">{{ __($review->name) }}</p>
                                            <p class="fs-12">{{ __($review->position) }}</p>
                                        </div>
                                    </div>	
                                </div> 
                            @endforeach                                                       
                        </div>

                        <!-- ROTATORS BUTTONS -->
                        <div class="offers-nav">
                            <a class="offers-prev"><i class="fa fa-chevron-left"></i></a>
                            <a class="offers-next"><i class="fa fa-chevron-right"></i></a>                                
                        </div>

                    @else
                        <div class="row text-center">
                            <div class="col-sm-12 mt-6 mb-6">
                                <h6 class="fs-12 font-weight-bold text-center">{{ __('No customer reviews were published yet') }}</h6>
                            </div>
                        </div>
                    @endif

                    
                    
                </div> <!-- END CONTAINER -->
                
            </section> <!-- END SECTION CUSTOMER FEEDBACK -->
        @endif
        
        
         <!-- SECTION - BANNER
        ========================================================-->
        <section id="banner-wrapper">

            <div class="container">

                <!-- SECTION TITLE -->
                <div class="row mb-7 text-center">

                    <div class="title">
                        <h6>{{ __('Our') }} <span>{{ __('Partners') }}</span></h6>
                        <p class="mb-0">{{ __('Be among the many that trust us') }}</p>
                    </div>

                </div> <!-- END SECTION TITLE -->

                <div class="row" id="partners">
                            
                    <div class="partner" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                        <div class="partner-image d-flex">
                            <div>
                                <img src="{{ URL::asset('img/files/c1.png') }}" alt="partner">
                            </div>
                        </div>	
                    </div>    
                    
                    <div class="partner" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                        <div class="partner-image d-flex">
                            <div>
                                <img src="{{ URL::asset('img/files/c2.png') }}" alt="partner">
                            </div>
                        </div>	
                    </div> 

                    <div class="partner" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                        <div class="partner-image d-flex">
                            <div>
                                <img src="{{ URL::asset('img/files/c7.png') }}" alt="partner">
                            </div>
                        </div>	
                    </div> 

                    <div class="partner" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                        <div class="partner-image d-flex">
                            <div>
                                <img src="{{ URL::asset('img/files/c5.png') }}" alt="partner">
                            </div>
                        </div>	
                    </div> 

                    <div class="partner" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                        <div class="partner-image d-flex">
                            <div>
                                <img src="{{ URL::asset('img/files/c6.png') }}" alt="partner">
                            </div>
                        </div>	
                    </div> 

                    <div class="partner" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                        <div class="partner-image d-flex">
                            <div>
                                <img src="{{ URL::asset('img/files/c7.png') }}" alt="partner">
                            </div>
                        </div>	
                    </div> 

                    <div class="partner" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                        <div class="partner-image d-flex">
                            <div>
                                <img src="{{ URL::asset('img/files/c2.png') }}" alt="partner">
                            </div>
                        </div>	
                    </div> 
                </div>
            </div>

        </section> <!-- END SECTION BANNER -->


        <!-- SECTION - PRICING
        ========================================================-->
        @if (config('frontend.pricing_section') == 'on')
            <section id="prices-wrapper">

                <div class="container pt-9">  
                    
                    <!-- SECTION TITLE -->
                    <div class="row text-center">

                        <div class="title">
                            <h6>{{ __('Various') }} <span>{{ __('Subscription') }}</span> {{ __('Plans') }}</h6>
                            <p>{{ __('Most competitive prices are guaranteed') }}</p>
                        </div>

                    </div> <!-- END SECTION TITLE -->
                    
                    <div class="row">
                        <div class="card-body">			
			
                            @if ($monthly || $yearly || $prepaid || $lifetime)
                
                                <div class="tab-menu-heading text-center">
                                    <div class="tabs-menu">								
                                        <ul class="nav">
                                            @if ($prepaid)						
                                                <li><a href="#prepaid" class="@if (!$monthly && !$yearly && $prepaid) active @else '' @endif" data-bs-toggle="tab"> {{ __('Prepaid Plans') }}</a></li>
                                            @endif							
                                            @if ($monthly)
                                                <li><a href="#monthly_plans" class="@if (($monthly && $prepaid && $yearly) || ($monthly && !$prepaid && !$yearly) || ($monthly && $prepaid && !$yearly) || ($monthly && !$prepaid && $yearly)) active @else '' @endif" data-bs-toggle="tab"> {{ __('Monthly Plans') }}</a></li>
                                            @endif	
                                            @if ($yearly)
                                                <li><a href="#yearly_plans" class="@if (!$monthly && !$prepaid && $yearly) active @else '' @endif" data-bs-toggle="tab"> {{ __('Yearly Plans') }}</a></li>
                                            @endif		
                                            @if ($lifetime)
                                                <li><a href="#lifetime" class="@if (!$monthly && !$yearly && !$prepaid &&  $lifetime) active @else '' @endif" data-bs-toggle="tab"> {{ __('Lifetime Plans') }}</a></li>
                                            @endif							
                                        </ul>
                                    </div>
                                </div>
                
                            
                
                                <div class="tabs-menu-body">
                                    <div class="tab-content">
                
                                        @if ($prepaid)
                                            <div class="tab-pane @if ((!$monthly && $prepaid) && (!$yearly && $prepaid)) active @else '' @endif" id="prepaid">
                
                                                @if ($prepaids->count())
                
                                                    <h6 class="font-weight-normal fs-12 text-center mb-6">{{ __('Top up your subscription with more credits or start with Prepaid Plans credits only') }}</h6>
                                                    
                                                    <div class="row justify-content-md-center">
                                                    
                                                        @foreach ( $prepaids as $prepaid )																			
                                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                                <div class="price-card pl-3 pr-3 pt-2 mb-7">
                                                                    <div class="card border-0 p-4 pl-5">
                                                                        <div class="plan prepaid-plan">
                                                                            <div class="plan-title">{{ $prepaid->plan_name }} <span class="prepaid-currency-sign">{{ $prepaid->currency }}</span><span class="plan-cost">@if (config('payment.decimal_points') == 'allow') {{ number_format((float)$prepaid->price, 2) }} @else {{ number_format($prepaid->price) }} @endif</span><span class="prepaid-currency-sign">{!! config('payment.default_system_currency_symbol') !!}</span></div>
                                                                                <p class="fs-12 mt-2 mb-0">{{ __('Words Included') }}: <span class="ml-2 font-weight-bold text-primary">{{ number_format($prepaid->words) }}</span></p>
                                                                                <p class="fs-12 mt-2 mb-0">{{ __('Images Included') }}: <span class="ml-2 font-weight-bold text-primary">{{ number_format($prepaid->images) }}</span></p>
                                                                                <p class="fs-12 mt-2 mb-0">{{ __('Characters Included') }}: <span class="ml-2 font-weight-bold text-primary">{{ number_format($prepaid->characters) }}</span></p>																								
																                <p class="fs-12 mt-2 mb-4">{{ __('Minutes Included') }}: <span class="ml-2 font-weight-bold text-primary">{{ number_format($prepaid->minutes) }}</span></p>																									
                                                                            <div class="text-center action-button mt-2 mb-2">
                                                                                <a href="{{ route('user.prepaid.checkout', ['type' => 'prepaid', 'id' => $prepaid->id]) }}" class="btn btn-cancel">{{ __('Purchase') }}</a> 
                                                                            </div>
                                                                        </div>							
                                                                    </div>	
                                                                </div>							
                                                            </div>										
                                                        @endforeach						
                
                                                    </div>
                
                                                @else
                                                    <div class="row text-center">
                                                        <div class="col-sm-12 mt-6 mb-6">
                                                            <h6 class="fs-12 font-weight-bold text-center">{{ __('No Prepaid plans were set yet') }}</h6>
                                                        </div>
                                                    </div>
                                                @endif
                
                                            </div>			
                                        @endif	
                
                                        @if ($monthly)	
                                            <div class="tab-pane @if (($monthly && $prepaid) || ($monthly && !$prepaid) || ($monthly && !$yearly)) active @else '' @endif" id="monthly_plans">
                
                                                @if ($monthly_subscriptions->count())		
                                                    
                                                    <h6 class="font-weight-normal fs-12 text-center mb-6">{{ __('Subscribe to our Monthly Subscription Plans and enjoy ton of benefits') }}</h6>
                
                                                    <div class="row justify-content-md-center">
                
                                                        @foreach ( $monthly_subscriptions as $subscription )																			
                                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                                <div class="pt-2 mb-7 prices-responsive">
                                                                    <div class="card border-0 p-4 pl-5 pr-5 pt-7 price-card @if ($subscription->featured) price-card-border @endif">
                                                                        @if ($subscription->featured)
                                                                            <span class="plan-featured">{{ __('Most Popular') }}</span>
                                                                        @endif
                                                                        <div class="plan">			
                                                                            <div class="plan-title text-center">{{ $subscription->plan_name }}</div>		
                                                                            <p class="fs-12 text-center mb-3">{{ $subscription->primary_heading }}</p>																					
                                                                            <p class="plan-cost text-center mb-0"><span class="plan-currency-sign"></span>{!! config('payment.default_system_currency_symbol') !!}@if (config('payment.decimal_points') == 'allow') {{ number_format((float)$subscription->price, 2) }} @else {{ number_format($subscription->price) }} @endif</p>
                                                                            <p class="fs-12 text-center mb-3">{{ $subscription->currency }} / {{ __('Month') }}</p>
                                                                            <div class="text-center action-button mt-2 mb-5">
                                                                                <a href="{{ route('user.plan.subscribe', $subscription->id) }}" class="btn btn-primary">{{ __('Subscribe Now') }}</a>                                                														
                                                                            </div>
                                                                            <p class="fs-12 text-center mb-3">{{ $subscription->secondary_heading }}</p>																	
                                                                            <ul class="fs-12 pl-3">														
                                                                                @foreach ( (explode(',', $subscription->plan_features)) as $feature )
                                                                                    @if ($feature)
                                                                                        <li><i class="fa-solid fa-circle-small fs-10 text-muted"></i> {{ $feature }}</li>
                                                                                    @endif																
                                                                                @endforeach															
                                                                            </ul>																
                                                                        </div>					
                                                                    </div>	
                                                                </div>							
                                                            </div>										
                                                        @endforeach
                
                                                    </div>	
                                                
                                                @else
                                                    <div class="row text-center">
                                                        <div class="col-sm-12 mt-6 mb-6">
                                                            <h6 class="fs-12 font-weight-bold text-center">{{ __('No Subscriptions plans were set yet') }}</h6>
                                                        </div>
                                                    </div>
                                                @endif					
                                            </div>	
                                        @endif	
                                        
                                        @if ($yearly)	
                                            <div class="tab-pane @if (($yearly && $prepaid) && ($yearly && !$prepaid) && ($yearly && !$monthly)) active @else '' @endif" id="yearly_plans">
                
                                                @if ($yearly_subscriptions->count())		
                                                    
                                                    <h6 class="font-weight-normal fs-12 text-center mb-6">{{ __('Subscribe to our Yearly Subscription Plans and enjoy ton of benefits') }}</h6>
                
                                                    <div class="row justify-content-md-center">
                
                                                        @foreach ( $yearly_subscriptions as $subscription )																			
                                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                                <div class="pt-2 mb-7 prices-responsive">
                                                                    <div class="card border-0 p-4 pl-5 pr-5 pt-7 price-card @if ($subscription->featured) price-card-border @endif">
                                                                        @if ($subscription->featured)
                                                                            <span class="plan-featured">{{ __('Most Popular') }}</span>
                                                                        @endif
                                                                        <div class="plan">			
                                                                            <div class="plan-title text-center">{{ $subscription->plan_name }}</div>		
                                                                            <p class="fs-12 text-center mb-3">{{ $subscription->primary_heading }}</p>																					
                                                                            <p class="plan-cost text-center mb-0"><span class="plan-currency-sign"></span>{!! config('payment.default_system_currency_symbol') !!}@if (config('payment.decimal_points') == 'allow') {{ number_format((float)$subscription->price, 2) }} @else {{ number_format($subscription->price) }} @endif</p>
                                                                            <p class="fs-12 text-center mb-3">{{ $subscription->currency }} / {{ __('Year') }}</p>
                                                                            <div class="text-center action-button mt-2 mb-4">          
                                                                                <a href="{{ route('user.plan.subscribe', $subscription->id) }}" class="btn btn-primary">{{ __('Subscribe Now') }}</a>
                                                                           													
                                                                            </div>
                                                                            <p class="fs-12 text-center mb-3">{{ $subscription->secondary_heading }}</p>																	
                                                                            <ul class="fs-12 pl-3">														
                                                                                @foreach ( (explode(',', $subscription->plan_features)) as $feature )
                                                                                    @if ($feature)
                                                                                        <li><i class="fa-solid fa-circle-small fs-10 text-muted"></i> {{ $feature }}</li>
                                                                                    @endif																
                                                                                @endforeach															
                                                                            </ul>																
                                                                        </div>					
                                                                    </div>	
                                                                </div>							
                                                            </div>										
                                                        @endforeach
                
                                                    </div>	
                                                
                                                @else
                                                    <div class="row text-center">
                                                        <div class="col-sm-12 mt-6 mb-6">
                                                            <h6 class="fs-12 font-weight-bold text-center">{{ __('No Subscriptions plans were set yet') }}</h6>
                                                        </div>
                                                    </div>
                                                @endif					
                                            </div>
                                        @endif	
                                        
                                        @if ($lifetime)
                                            <div class="tab-pane @if ((!$monthly && $lifetime) && (!$yearly && $lifetime)) active @else '' @endif" id="lifetime">

                                                @if ($lifetime_subscriptions->count())

                                                    <h6 class="font-weight-normal fs-12 text-center mb-6">{{ __('Sign up and enjoy Lifetime Plans') }}</h6>
                                                    
                                                    <div class="row justify-content-md-center">
                                                    
                                                        @foreach ( $lifetime_subscriptions as $subscription )																			
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="pt-2 mb-7 prices-responsive">
                                                                        <div class="card border-0 p-4 pl-5 pr-5 pt-7 price-card @if ($subscription->featured) price-card-border @endif">
                                                                            @if ($subscription->featured)
                                                                                <span class="plan-featured">{{ __('Most Popular') }}</span>
                                                                            @endif
                                                                            <div class="plan">			
                                                                                <div class="plan-title text-center">{{ __($subscription->plan_name) }}</div>		
                                                                                <p class="fs-12 text-center mb-3">{{ __($subscription->primary_heading) }}</p>																					
                                                                                <p class="plan-cost text-center mb-0"><span class="plan-currency-sign"></span>{!! config('payment.default_system_currency_symbol') !!}{{ number_format((float)$subscription->price, 2) }}</p>
                                                                                <p class="fs-12 text-center mb-3">{{ $subscription->currency }} / {{ __('Lifetime') }}</p>
                                                                                <div class="text-center action-button mt-2 mb-4">
                                                                                    <a href="{{ route('user.prepaid.checkout', ['type' => 'lifetime', 'id' => $subscription->id]) }}" class="btn btn-primary">{{ __('Subscribe Now') }}</a>													
                                                                                </div>
                                                                                <p class="fs-12 text-center mb-3">{{ __($subscription->secondary_heading) }}</p>																	
                                                                                <ul class="fs-12 pl-3">														
                                                                                    @foreach ( (explode(',', $subscription->plan_features)) as $feature )
                                                                                        @if ($feature)
                                                                                            <li><i class="fa-solid fa-circle-small fs-10 text-muted"></i> {{ __($feature) }}</li>
                                                                                        @endif																
                                                                                    @endforeach															
                                                                                </ul>																
                                                                            </div>					
                                                                        </div>	
                                                                    </div>							
                                                                </div>										
                                                            @endforeach					

                                                    </div>

                                                @else
                                                    <div class="row text-center">
                                                        <div class="col-sm-12 mt-6 mb-6">
                                                            <h6 class="fs-12 font-weight-bold text-center">{{ __('No lifetime plans were set yet') }}</h6>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>	
                                        @endif	
                                    </div>
                                </div>
                            
                            @else
                                <div class="row text-center">
                                    <div class="col-sm-12 mt-6 mb-6">
                                        <h6 class="fs-12 font-weight-bold text-center">{{ __('No Subscriptions or Prepaid plans were set yet') }}</h6>
                                    </div>
                                </div>
                            @endif
                
                        </div>
                </div>
                
                </div>
        
            </section>
        @endif


        <!-- SECTION - BLOGS
        ========================================================-->
        @if (config('frontend.blogs_section') == 'on')
            <section id="blog-wrapper">

                <div class="container text-center">


                    <!-- SECTION TITLE -->
                    <div class="row mb-8 mt-5">

                        <div class="title w-100">
                            <h6><span>{{ __('Latest') }}</span> {{ __('Blogs') }}</h6>
                            <p>{{ __('Read our unique blog articles about various data archiving solutions and secrets') }}</p>
                        </div>

                    </div> <!-- END SECTION TITLE -->

                    @if ($blog_exists)
                        
                        <!-- BLOGS -->
                        <div class="row" id="blogs">
                            @foreach ( $blogs as $blog )
                            <div class="blog" data-aos="zoom-in" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">			
                                <div class="blog-box">
                                    <div class="blog-img">
                                        <a href="{{ route('blogs.show', $blog->url) }}"><img src="{{ URL::asset($blog->image) }}" alt="Blog Image"></a>
                                    </div>
                                    <div class="blog-info">
                                        <h6 class="blog-date text-left text-muted mt-3 pt-1 mb-4"><span class="mr-2">{{ $blog->created_by }}</span> | <i class="mdi mdi-alarm mr-2"></i>{{ date('j F Y', strtotime($blog->created_at)) }}</h6>
                                        <h5 class="blog-title fs-16 text-left mb-3">{{ __($blog->title) }}</h5>                                     
                                    </div>
                                </div>                        
                            </div> 
                            @endforeach
                        </div> 
                        

                        <!-- ROTATORS BUTTONS -->
                        <div class="blogs-nav">
                            <a class="blogs-prev"><i class="fa fa-chevron-left"></i></a>
                            <a class="blogs-next"><i class="fa fa-chevron-right"></i></a>                                
                        </div>

                    @else
                        <div class="row text-center">
                            <div class="col-sm-12 mt-6 mb-6">
                                <h6 class="fs-12 font-weight-bold text-center">{{ __('No blog articles were published yet') }}</h6>
                            </div>
                        </div>
                    @endif

                </div> <!-- END CONTAINER -->

                {!! adsense_frontend_blogs_728x90() !!}
                
            </section> <!-- END SECTION BLOGS -->
        @endif


        <!-- SECTION - FAQ
        ========================================================-->
        @if (config('frontend.faq_section') == 'on')
            <section id="faq-wrapper">    
                <div class="container pt-7">

                    <div class="row text-center mb-8 mt-7">
                        <div class="col-md-12 title">
                            <h6>{{ __('Frequently Asked') }} <span>{{ __('Questions') }}</span></h6>
                            <p>{{ __('Got questions? We have you covered.') }}</p>
                        </div>
                    </div>

                    <div class="row justify-content-md-center">
        
                        @if ($faq_exists)

                            <div class="col-md-10">
        
                                @foreach ( $faqs as $faq )

                                    <div id="accordion" data-aos="fade-left" data-aos-delay="300" data-aos-once="true" data-aos-duration="700">
                                        <div class="card">
                                            <div class="card-header" id="heading{{ $faq->id }}">
                                                <h5 class="mb-0">
                                                <span class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $faq->id }}" aria-expanded="false" aria-controls="collapse-{{ $faq->id }}">
                                                    {{ __($faq->question) }}
                                                </span>
                                                </h5>
                                            </div>
                                        
                                            <div id="collapse-{{ $faq->id }}" class="collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#accordion">
                                                <div class="card-body">
                                                    {!! __($faq->answer) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                    
        
                        @else
                            <div class="row text-center">
                                <div class="col-sm-12 mt-6 mb-6">
                                    <h6 class="fs-12 font-weight-bold text-center">{{ __('No FAQ answers were published yet') }}</h6>
                                </div>
                            </div>
                        @endif
            
                    </div>        
                </div>
        
            </section> <!-- END SECTION FAQ -->
        @endif

        
        <!-- SECTION - CONTACT US
        ========================================================-->
        @if (config('frontend.contact_section') == 'on')
            <section id="contact-wrapper">

                <div class="container pt-9">       
                    
                    <!-- SECTION TITLE -->
                    <div class="row mb-8 text-center">

                        <div class="title w-100">
                            <h6><span>{{ __('Contact') }}</span> {{ __('With Us') }}</h6>
                            <p>{{ __('Reach out to us for additional information') }}</p>
                        </div>

                    </div> <!-- END SECTION TITLE -->

                    
                    <div class="row">                
                        
                        <div class="col-md-6 col-sm-12" data-aos="fade-left" data-aos-delay="300" data-aos-once="true" data-aos-duration="700">
                            <img class="w-70" src="{{ URL::asset('img/files/about.svg') }}" alt="">
                        </div>

                        <div class="col-md-6 col-sm-12" data-aos="fade-right" data-aos-delay="300" data-aos-once="true" data-aos-duration="700">
                            <form id="" action="{{ route('contact') }}" method="POST" enctype="multipart/form-data">
                                @csrf
        
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="input-box mb-4">                             
                                            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="off" placeholder="{{ __('First Name') }}" required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="input-box mb-4">                             
                                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autocomplete="off" placeholder="{{ __('Last Name') }}" required>
                                            @error('lastname')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror                            
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="input-box mb-4">                             
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off"  placeholder="{{ __('Email Address') }}" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="input-box mb-4">                             
                                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="off"  placeholder="{{ __('Phone Number') }}" required>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror                            
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row justify-content-md-center">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="input-box">							
                                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="10" required placeholder="{{ __('Message') }}"></textarea>
                                            @error('message')
                                                <p class="text-danger">{{ $errors->first('message') }}</p>
                                            @enderror	
                                        </div>
                                    </div>
                                </div>
        
                                <input type="hidden" name="recaptcha" id="recaptcha">
                                
                                <div class="row justify-content-md-center text-center">
                                    <!-- ACTION BUTTON -->
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary special-action-button">{{ __('Send Message') }}</button>							
                                    </div>
                                </div>
                            
                            </form>
        
                        </div>                   
                        
                    </div>
                
                </div>
        
            </section>
        @endif

@endsection

@section('js')
    <script src="{{URL::asset('plugins/slick/slick.min.js')}}"></script>  
    <script src="{{URL::asset('plugins/aos/aos.js')}}"></script> 
    <script src="{{URL::asset('plugins/typed/typed.min.js')}}"></script>
    <script src="{{URL::asset('js/frontend.js')}}"></script>  
    <script type="text/javascript">
		$(function () {

            var typed = new Typed('#typed', {
                strings: ['<h1><span>{{ __('Article Generator') }}</span></h1>', 
                            '<h1><span>{{ __('Content Improver') }}</span></h1>',
                            '<h1><span>{{ __('Blog Sections') }}</span></h1>',
                            '<h1><span>{{ __('Blog Ideas') }}</span></h1>',
                            '<h1><span>{{ __('SEO Meta Descriptions') }}</span></h1>',
                            '<h1><span>{{ __('FAQ Answers') }}</span></h1>',
                            '<h1><span>{{ __('And Many More!') }}</span></h1>'],
                typeSpeed: 40,
                backSpeed: 40,
                backDelay: 2000,
                loop: true,
                showCursor: false,
            });

            AOS.init();

		});    
    </script>fo

    @if (config('services.google.recaptcha.enable') == 'on')
         <!-- Google reCaptcha JS -->
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.google.recaptcha.site_key') }}"></script>
        <script>
            grecaptcha.ready(function() {
                grecaptcha.execute('{{ config('services.google.recaptcha.site_key') }}', {action: 'contact'}).then(function(token) {
                    if (token) {
                    document.getElementById('recaptcha').value = token;
                    }
                });
            });
        </script>
    @endif
@endsection
        
        
       
        
       
    

