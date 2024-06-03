<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('plugins/slick/slick.css')); ?>" rel="stylesheet" />
	<link href="<?php echo e(URL::asset('plugins/slick/slick-theme.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(URL::asset('plugins/aos/aos.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

        <section id="main-wrapper">
            
            <div class="h-100vh justify-center min-h-screen" id="main-background">

                <div class="container h-100vh ">
                    <div class="row h-100vh vertical-center">
                        <div class="col-sm-12 upload-responsive">
                            <div class="text-container text-center">
                                <h3 class="mb-4 font-weight-bold text-white" data-aos="fade-left" data-aos-delay="400" data-aos-once="true" data-aos-duration="700"><?php echo e(__('Meet')); ?>, <?php echo e(config('app.name')); ?></span></h3>
                                <h1 class=" text-white" data-aos="fade-left" data-aos-delay="500" data-aos-once="true" data-aos-duration="700"><?php echo e(__('The Future of Writing')); ?></span></h1>
                                <h1 class=" mb-0 gradient fixed-height" id="typed" data-aos="fade-left" data-aos-delay="600" data-aos-once="true" data-aos-duration="900"></h1>
                                <p class="fs-18 text-white" data-aos="fade-left" data-aos-delay="700" data-aos-once="true" data-aos-duration="1100"><?php echo e(__('Let AI create content for blogs, articles, websites, social media and more')); ?></p>

                                <a href="<?php echo e(route('register')); ?>" class="btn btn-primary special-action-button" data-aos="fade-left" data-aos-delay="800" data-aos-once="true" data-aos-duration="1100"><?php echo e(__('Try Now For Free')); ?></a>

                            </div>
                        </div>                                
                    </div>           
                </div>

            </div> 
        </section>
        <div class="container home-container" style="/*display: none;*/"> 
 



        <!-- SECTION - FEATURES
        ========================================================-->
        <?php if(config('frontend.features_section') == 'on'): ?>
            <section id="features-wrapper">
                

                <?php echo adsense_frontend_features_728x90(); ?>

                

                <div class="container">

                    <div class="row text-center mt-8 mb-8">
                        <div class="col-md-12 title">
                            <h6><span><?php echo e(config('app.name')); ?></span> <?php echo e(__('Benefits')); ?></h6>
                            <p><?php echo e(__('Enjoy the full flexibility of the platform with ton of features')); ?></p>
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
                                            <img src="<?php echo e(URL::asset('img/files/01.png')); ?>" alt="">
                                        </div>
                                    
                                        <h5><?php echo e(__('Latest AI technology')); ?></h5>
                                        
                                        <p>Lorem ipsum dolor sit amet est consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                    </div>                         

                                </div>

                            </div> <!-- END SOLUTION -->
                            
                            <!-- SOLUTION -->
                            <div class="col-sm-12 mb-6">
                                    
                                <div class="solution" data-aos="zoom-in" data-aos-delay="1500" data-aos-once="true" data-aos-duration="1500">
                                    
                                    <div class="solution-content">
                                        
                                        <div class="solution-logo mb-3">
                                            <img src="<?php echo e(URL::asset('img/files/09.png')); ?>" alt="">
                                        </div>
                                    
                                        <h5><?php echo e(__('More than +25 Languages')); ?></h5>
                                        
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                    </div>

                                </div>

                            </div> <!-- END SOLUTION -->

                            <!-- SOLUTION -->
                            <div class="col-sm-12 mb-6">
                                    
                                <div class="solution" data-aos="zoom-in" data-aos-delay="2000" data-aos-once="true" data-aos-duration="2000">
                                    
                                    <div class="solution-content">
                                        
                                        <div class="solution-logo mb-3">
                                            <img src="<?php echo e(URL::asset('img/files/06.png')); ?>" alt="">
                                        </div>
                                    
                                        <h5><?php echo e(__('2FA Account Protection')); ?></h5>
                                        
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
                                            <img src="<?php echo e(URL::asset('img/files/05.png')); ?>" alt="">
                                        </div>
                                    
                                        <h5><?php echo e(__('Edit AI Text Easily')); ?></h5>
                                        
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                    </div>

                                </div>

                            </div> <!-- END SOLUTION -->


                            <!-- SOLUTION -->
                            <div class="col-sm-12 mb-6">
                                    
                                <div class="solution" data-aos="zoom-in" data-aos-delay="1500" data-aos-once="true" data-aos-duration="1500">
                                    
                                    <div class="solution-content">
                                        
                                        <div class="solution-logo mb-3">
                                            <img src="<?php echo e(URL::asset('img/files/03.png')); ?>" alt="">
                                        </div>
                                    
                                        <h5><?php echo e(__('Export Text Results in PDF & Word')); ?></h5>
                                        
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                    </div>                                

                                </div>

                            </div> <!-- END SOLUTION -->


                            <!-- SOLUTION -->
                            <div class="col-sm-12 mb-6">
                                    
                                <div class="solution" data-aos="zoom-in" data-aos-delay="2000" data-aos-once="true" data-aos-duration="2000">
                                    
                                    <div class="solution-content">
                                        
                                        <div class="solution-logo mb-3">
                                            <img src="<?php echo e(URL::asset('img/files/04.png')); ?>" alt="">
                                        </div>
                                    
                                        <h5><?php echo e(__('Generate AI Images by Using Text')); ?></h5>
                                        
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati unde.</p>

                                    </div>

                                </div>

                            </div> <!-- END SOLUTION -->
                        </div>

                        <div class="col-md-4 col-sm-12 d-flex">

                            <div class="feature-text">
                                <div>
                                    <h4><span class="text-primary"><?php echo e(config('app.name')); ?></span> <?php echo e(__('Uses most sophisticated Artificial Intelligence Technology')); ?></h4>
                                </div>
                                
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, quibusdam? Illum ad eius, molestiae placeat dicta quae, ab nihil omnis obcaecati reiciendis recusandae, voluptatem eos molestias aliquam saepe tenetur optio? Consectetur adipisicing elit. Ut aspernatur mollitia aliquid consectetur illo sapiente nemo obcaecati.</p>
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde ea et, error quisquam corporis, architecto minus doloremque aut facere itaque culpa eos molestias nulla reiciendis animi dolores, quod sunt illum.</p>
                            </div>
                            
                        </div>
                        
                    </div> <!-- END LIST OF SOLUTIONS -->
         

                </div>

            </section>
        <?php endif; ?>


        <!-- SECTION - FEATURES - TEMPLATES
        ========================================================-->
        <?php if(config('frontend.features_section') == 'on'): ?>
            <section id="features-wrapper">

                <?php echo adsense_frontend_features_728x90(); ?>

                

                <div class="container">

                    <div class="row text-center mb-8">
                        <div class="col-md-12 title">
                            <h6><span><?php echo e(config('app.name')); ?></span> <?php echo e(__('Templates')); ?></h6>
                            <p><?php echo e(__('A lot of AI templates that will allow you generate any text within seconds')); ?></p>
                        </div>
                    </div>
        
                        
                    <!-- LIST OF SOLUTIONS -->
                    <div class="row d-flex">
                        
                        <?php $__currentLoopData = $other_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="template mt-2">
                                    <a id="<?php echo e($template->template_code); ?>"></a>
                                    <div class="card border-0" id="<?php echo e($template->template_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/templates')); ?>/<?php echo e($template->slug); ?>'">
                                        <div class="card-body pt-5">
                                            <div class="template-icon mb-4">
                                                <?php echo $template->icon; ?>												
                                            </div>
                                            <div class="template-title">
                                                <h6 class="mb-2 fs-16 number-font"><?php echo e(__($template->name)); ?></h6>
                                            </div>
                                            <div class="template-info">
                                                <p class="fs-12 text-muted mb-2"><?php echo e(__($template->description)); ?></p>
                                            </div>
                                            <?php if($template->professional): ?> <p class="fs-8 btn btn-yellow"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?></p> <?php endif; ?>
                                        </div>
                                    </div>
                                </div>							
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php $__currentLoopData = $custom_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="template mt-2">
                                    <a id="<?php echo e($template->template_code); ?>"></a>
                                    <div class="card border-0" id="<?php echo e($template->template_code); ?>-card" onclick="window.location.href='<?php echo e(url('user/templates')); ?>/<?php echo e($template->slug); ?>/<?php echo e($template->template_code); ?>'">
                                        <div class="card-body pt-5">
                                            <div class="template-icon mb-4">
                                                <?php echo $template->icon; ?>												
                                            </div>
                                            <div class="template-title">
                                                <h6 class="mb-2 fs-16 number-font"><?php echo e(__($template->name)); ?></h6>
                                            </div>
                                            <div class="template-info">
                                                <p class="fs-12 text-muted mb-2"><?php echo e(__($template->description)); ?></p>
                                            </div>
                                            <?php if($template->professional): ?> <p class="fs-8 btn btn-yellow"><i class="fa-sharp fa-solid fa-crown mr-2"></i><?php echo e(__('Pro')); ?></p> <?php endif; ?>
                                        </div>
                                    </div>
                                </div>							
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </div> <!-- END LIST OF SOLUTIONS -->
         

                </div>

            </section>
        <?php endif; ?>


        <!-- SECTION - CUSTOMER FEEDBACKS
        ========================================================-->
        <?php if(config('frontend.reviews_section') == 'on'): ?>
            <section id="feedbacks-wrapper">

                <div class="container pt-4 text-center">


                    <!-- SECTION TITLE -->
                    <div class="row mb-8">

                        <div class="title">
                            <h6><?php echo e(__('Customer')); ?> <span><?php echo e(__('Reviews')); ?></span></h6>
                            <p><?php echo e(__('We guarantee that you will be one of our happy customers as well')); ?></p>
                        </div>

                    </div> <!-- END SECTION TITLE -->

                    <?php if($review_exists): ?>

                        <div class="row" id="feedbacks">
                            
                            <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="feedback" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                                    <!-- MAIN COMMENT -->
                                    <p class="comment"><sup><span class="fa fa-quote-left"></span></sup> <?php echo e(__($review->text)); ?> <sub><span class="fa fa-quote-right"></span></sub></p>

                                    <!-- COMMENTER -->
                                    <div class="feedback-image d-flex">
                                        <div>
                                            <img src="<?php echo e(URL::asset($review->image_url)); ?>" alt="Feedback" class="rounded-circle"><span class="small-quote fa fa-quote-left"></span>
                                        </div>

                                        <div class="pt-3">
                                            <p class="feedback-reviewer"><?php echo e(__($review->name)); ?></p>
                                            <p class="fs-12"><?php echo e(__($review->position)); ?></p>
                                        </div>
                                    </div>	
                                </div> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                       
                        </div>

                        <!-- ROTATORS BUTTONS -->
                        <div class="offers-nav">
                            <a class="offers-prev"><i class="fa fa-chevron-left"></i></a>
                            <a class="offers-next"><i class="fa fa-chevron-right"></i></a>                                
                        </div>

                    <?php else: ?>
                        <div class="row text-center">
                            <div class="col-sm-12 mt-6 mb-6">
                                <h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No customer reviews were published yet')); ?></h6>
                            </div>
                        </div>
                    <?php endif; ?>

                    
                    
                </div> <!-- END CONTAINER -->
                
            </section> <!-- END SECTION CUSTOMER FEEDBACK -->
        <?php endif; ?>
        
        
         <!-- SECTION - BANNER
        ========================================================-->
        <section id="banner-wrapper">

            <div class="container">

                <!-- SECTION TITLE -->
                <div class="row mb-7 text-center">

                    <div class="title">
                        <h6><?php echo e(__('Our')); ?> <span><?php echo e(__('Partners')); ?></span></h6>
                        <p class="mb-0"><?php echo e(__('Be among the many that trust us')); ?></p>
                    </div>

                </div> <!-- END SECTION TITLE -->

                <div class="row" id="partners">
                            
                    <div class="partner" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                        <div class="partner-image d-flex">
                            <div>
                                <img src="<?php echo e(URL::asset('img/files/c1.png')); ?>" alt="partner">
                            </div>
                        </div>	
                    </div>    
                    
                    <div class="partner" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                        <div class="partner-image d-flex">
                            <div>
                                <img src="<?php echo e(URL::asset('img/files/c2.png')); ?>" alt="partner">
                            </div>
                        </div>	
                    </div> 

                    <div class="partner" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                        <div class="partner-image d-flex">
                            <div>
                                <img src="<?php echo e(URL::asset('img/files/c7.png')); ?>" alt="partner">
                            </div>
                        </div>	
                    </div> 

                    <div class="partner" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                        <div class="partner-image d-flex">
                            <div>
                                <img src="<?php echo e(URL::asset('img/files/c5.png')); ?>" alt="partner">
                            </div>
                        </div>	
                    </div> 

                    <div class="partner" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                        <div class="partner-image d-flex">
                            <div>
                                <img src="<?php echo e(URL::asset('img/files/c6.png')); ?>" alt="partner">
                            </div>
                        </div>	
                    </div> 

                    <div class="partner" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                        <div class="partner-image d-flex">
                            <div>
                                <img src="<?php echo e(URL::asset('img/files/c7.png')); ?>" alt="partner">
                            </div>
                        </div>	
                    </div> 

                    <div class="partner" data-aos="flip-down" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">					
                        <div class="partner-image d-flex">
                            <div>
                                <img src="<?php echo e(URL::asset('img/files/c2.png')); ?>" alt="partner">
                            </div>
                        </div>	
                    </div> 
                </div>
            </div>

        </section> <!-- END SECTION BANNER -->


        <!-- SECTION - PRICING
        ========================================================-->
        <?php if(config('frontend.pricing_section') == 'on'): ?>
            <section id="prices-wrapper">

                <div class="container pt-9">  
                    
                    <!-- SECTION TITLE -->
                    <div class="row text-center">

                        <div class="title">
                            <h6><?php echo e(__('Various')); ?> <span><?php echo e(__('Subscription')); ?></span> <?php echo e(__('Plans')); ?></h6>
                            <p><?php echo e(__('Most competitive prices are guaranteed')); ?></p>
                        </div>

                    </div> <!-- END SECTION TITLE -->
                    
                    <div class="row">
                        <div class="card-body">			
			
                            <?php if($monthly || $yearly || $prepaid || $lifetime): ?>
                
                                <div class="tab-menu-heading text-center">
                                    <div class="tabs-menu">								
                                        <ul class="nav">
                                            <?php if($prepaid): ?>						
                                                <li><a href="#prepaid" class="<?php if(!$monthly && !$yearly && $prepaid): ?> active <?php else: ?> '' <?php endif; ?>" data-bs-toggle="tab"> <?php echo e(__('Prepaid Plans')); ?></a></li>
                                            <?php endif; ?>							
                                            <?php if($monthly): ?>
                                                <li><a href="#monthly_plans" class="<?php if(($monthly && $prepaid && $yearly) || ($monthly && !$prepaid && !$yearly) || ($monthly && $prepaid && !$yearly) || ($monthly && !$prepaid && $yearly)): ?> active <?php else: ?> '' <?php endif; ?>" data-bs-toggle="tab"> <?php echo e(__('Monthly Plans')); ?></a></li>
                                            <?php endif; ?>	
                                            <?php if($yearly): ?>
                                                <li><a href="#yearly_plans" class="<?php if(!$monthly && !$prepaid && $yearly): ?> active <?php else: ?> '' <?php endif; ?>" data-bs-toggle="tab"> <?php echo e(__('Yearly Plans')); ?></a></li>
                                            <?php endif; ?>		
                                            <?php if($lifetime): ?>
                                                <li><a href="#lifetime" class="<?php if(!$monthly && !$yearly && !$prepaid &&  $lifetime): ?> active <?php else: ?> '' <?php endif; ?>" data-bs-toggle="tab"> <?php echo e(__('Lifetime Plans')); ?></a></li>
                                            <?php endif; ?>							
                                        </ul>
                                    </div>
                                </div>
                
                            
                
                                <div class="tabs-menu-body">
                                    <div class="tab-content">
                
                                        <?php if($prepaid): ?>
                                            <div class="tab-pane <?php if((!$monthly && $prepaid) && (!$yearly && $prepaid)): ?> active <?php else: ?> '' <?php endif; ?>" id="prepaid">
                
                                                <?php if($prepaids->count()): ?>
                
                                                    <h6 class="font-weight-normal fs-12 text-center mb-6"><?php echo e(__('Top up your subscription with more credits or start with Prepaid Plans credits only')); ?></h6>
                                                    
                                                    <div class="row justify-content-md-center">
                                                    
                                                        <?php $__currentLoopData = $prepaids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prepaid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>																			
                                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                                <div class="price-card pl-3 pr-3 pt-2 mb-7">
                                                                    <div class="card border-0 p-4 pl-5">
                                                                        <div class="plan prepaid-plan">
                                                                            <div class="plan-title"><?php echo e($prepaid->plan_name); ?> <span class="prepaid-currency-sign"><?php echo e($prepaid->currency); ?></span><span class="plan-cost"><?php if(config('payment.decimal_points') == 'allow'): ?> <?php echo e(number_format((float)$prepaid->price, 2)); ?> <?php else: ?> <?php echo e(number_format($prepaid->price)); ?> <?php endif; ?></span><span class="prepaid-currency-sign"><?php echo config('payment.default_system_currency_symbol'); ?></span></div>
                                                                                <p class="fs-12 mt-2 mb-0"><?php echo e(__('Words Included')); ?>: <span class="ml-2 font-weight-bold text-primary"><?php echo e(number_format($prepaid->words)); ?></span></p>
                                                                                <p class="fs-12 mt-2 mb-0"><?php echo e(__('Images Included')); ?>: <span class="ml-2 font-weight-bold text-primary"><?php echo e(number_format($prepaid->images)); ?></span></p>
                                                                                <p class="fs-12 mt-2 mb-0"><?php echo e(__('Characters Included')); ?>: <span class="ml-2 font-weight-bold text-primary"><?php echo e(number_format($prepaid->characters)); ?></span></p>																								
																                <p class="fs-12 mt-2 mb-4"><?php echo e(__('Minutes Included')); ?>: <span class="ml-2 font-weight-bold text-primary"><?php echo e(number_format($prepaid->minutes)); ?></span></p>																									
                                                                            <div class="text-center action-button mt-2 mb-2">
                                                                                <a href="<?php echo e(route('user.prepaid.checkout', ['type' => 'prepaid', 'id' => $prepaid->id])); ?>" class="btn btn-cancel"><?php echo e(__('Purchase')); ?></a> 
                                                                            </div>
                                                                        </div>							
                                                                    </div>	
                                                                </div>							
                                                            </div>										
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>						
                
                                                    </div>
                
                                                <?php else: ?>
                                                    <div class="row text-center">
                                                        <div class="col-sm-12 mt-6 mb-6">
                                                            <h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No Prepaid plans were set yet')); ?></h6>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                
                                            </div>			
                                        <?php endif; ?>	
                
                                        <?php if($monthly): ?>	
                                            <div class="tab-pane <?php if(($monthly && $prepaid) || ($monthly && !$prepaid) || ($monthly && !$yearly)): ?> active <?php else: ?> '' <?php endif; ?>" id="monthly_plans">
                
                                                <?php if($monthly_subscriptions->count()): ?>		
                                                    
                                                    <h6 class="font-weight-normal fs-12 text-center mb-6"><?php echo e(__('Subscribe to our Monthly Subscription Plans and enjoy ton of benefits')); ?></h6>
                
                                                    <div class="row justify-content-md-center">
                
                                                        <?php $__currentLoopData = $monthly_subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>																			
                                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                                <div class="pt-2 mb-7 prices-responsive">
                                                                    <div class="card border-0 p-4 pl-5 pr-5 pt-7 price-card <?php if($subscription->featured): ?> price-card-border <?php endif; ?>">
                                                                        <?php if($subscription->featured): ?>
                                                                            <span class="plan-featured"><?php echo e(__('Most Popular')); ?></span>
                                                                        <?php endif; ?>
                                                                        <div class="plan">			
                                                                            <div class="plan-title text-center"><?php echo e($subscription->plan_name); ?></div>		
                                                                            <p class="fs-12 text-center mb-3"><?php echo e($subscription->primary_heading); ?></p>																					
                                                                            <p class="plan-cost text-center mb-0"><span class="plan-currency-sign"></span><?php echo config('payment.default_system_currency_symbol'); ?><?php if(config('payment.decimal_points') == 'allow'): ?> <?php echo e(number_format((float)$subscription->price, 2)); ?> <?php else: ?> <?php echo e(number_format($subscription->price)); ?> <?php endif; ?></p>
                                                                            <p class="fs-12 text-center mb-3"><?php echo e($subscription->currency); ?> / <?php echo e(__('Month')); ?></p>
                                                                            <div class="text-center action-button mt-2 mb-5">
                                                                                <a href="<?php echo e(route('user.plan.subscribe', $subscription->id)); ?>" class="btn btn-primary"><?php echo e(__('Subscribe Now')); ?></a>                                                														
                                                                            </div>
                                                                            <p class="fs-12 text-center mb-3"><?php echo e($subscription->secondary_heading); ?></p>																	
                                                                            <ul class="fs-12 pl-3">														
                                                                                <?php $__currentLoopData = (explode(',', $subscription->plan_features)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <?php if($feature): ?>
                                                                                        <li><i class="fa-solid fa-circle-small fs-10 text-muted"></i> <?php echo e($feature); ?></li>
                                                                                    <?php endif; ?>																
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>															
                                                                            </ul>																
                                                                        </div>					
                                                                    </div>	
                                                                </div>							
                                                            </div>										
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                                                    </div>	
                                                
                                                <?php else: ?>
                                                    <div class="row text-center">
                                                        <div class="col-sm-12 mt-6 mb-6">
                                                            <h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No Subscriptions plans were set yet')); ?></h6>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>					
                                            </div>	
                                        <?php endif; ?>	
                                        
                                        <?php if($yearly): ?>	
                                            <div class="tab-pane <?php if(($yearly && $prepaid) && ($yearly && !$prepaid) && ($yearly && !$monthly)): ?> active <?php else: ?> '' <?php endif; ?>" id="yearly_plans">
                
                                                <?php if($yearly_subscriptions->count()): ?>		
                                                    
                                                    <h6 class="font-weight-normal fs-12 text-center mb-6"><?php echo e(__('Subscribe to our Yearly Subscription Plans and enjoy ton of benefits')); ?></h6>
                
                                                    <div class="row justify-content-md-center">
                
                                                        <?php $__currentLoopData = $yearly_subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>																			
                                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                                <div class="pt-2 mb-7 prices-responsive">
                                                                    <div class="card border-0 p-4 pl-5 pr-5 pt-7 price-card <?php if($subscription->featured): ?> price-card-border <?php endif; ?>">
                                                                        <?php if($subscription->featured): ?>
                                                                            <span class="plan-featured"><?php echo e(__('Most Popular')); ?></span>
                                                                        <?php endif; ?>
                                                                        <div class="plan">			
                                                                            <div class="plan-title text-center"><?php echo e($subscription->plan_name); ?></div>		
                                                                            <p class="fs-12 text-center mb-3"><?php echo e($subscription->primary_heading); ?></p>																					
                                                                            <p class="plan-cost text-center mb-0"><span class="plan-currency-sign"></span><?php echo config('payment.default_system_currency_symbol'); ?><?php if(config('payment.decimal_points') == 'allow'): ?> <?php echo e(number_format((float)$subscription->price, 2)); ?> <?php else: ?> <?php echo e(number_format($subscription->price)); ?> <?php endif; ?></p>
                                                                            <p class="fs-12 text-center mb-3"><?php echo e($subscription->currency); ?> / <?php echo e(__('Year')); ?></p>
                                                                            <div class="text-center action-button mt-2 mb-4">          
                                                                                <a href="<?php echo e(route('user.plan.subscribe', $subscription->id)); ?>" class="btn btn-primary"><?php echo e(__('Subscribe Now')); ?></a>
                                                                           													
                                                                            </div>
                                                                            <p class="fs-12 text-center mb-3"><?php echo e($subscription->secondary_heading); ?></p>																	
                                                                            <ul class="fs-12 pl-3">														
                                                                                <?php $__currentLoopData = (explode(',', $subscription->plan_features)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <?php if($feature): ?>
                                                                                        <li><i class="fa-solid fa-circle-small fs-10 text-muted"></i> <?php echo e($feature); ?></li>
                                                                                    <?php endif; ?>																
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>															
                                                                            </ul>																
                                                                        </div>					
                                                                    </div>	
                                                                </div>							
                                                            </div>										
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                                                    </div>	
                                                
                                                <?php else: ?>
                                                    <div class="row text-center">
                                                        <div class="col-sm-12 mt-6 mb-6">
                                                            <h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No Subscriptions plans were set yet')); ?></h6>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>					
                                            </div>
                                        <?php endif; ?>	
                                        
                                        <?php if($lifetime): ?>
                                            <div class="tab-pane <?php if((!$monthly && $lifetime) && (!$yearly && $lifetime)): ?> active <?php else: ?> '' <?php endif; ?>" id="lifetime">

                                                <?php if($lifetime_subscriptions->count()): ?>

                                                    <h6 class="font-weight-normal fs-12 text-center mb-6"><?php echo e(__('Sign up and enjoy Lifetime Plans')); ?></h6>
                                                    
                                                    <div class="row justify-content-md-center">
                                                    
                                                        <?php $__currentLoopData = $lifetime_subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>																			
                                                                <div class="col-lg-3 col-md-6 col-sm-12">
                                                                    <div class="pt-2 mb-7 prices-responsive">
                                                                        <div class="card border-0 p-4 pl-5 pr-5 pt-7 price-card <?php if($subscription->featured): ?> price-card-border <?php endif; ?>">
                                                                            <?php if($subscription->featured): ?>
                                                                                <span class="plan-featured"><?php echo e(__('Most Popular')); ?></span>
                                                                            <?php endif; ?>
                                                                            <div class="plan">			
                                                                                <div class="plan-title text-center"><?php echo e(__($subscription->plan_name)); ?></div>		
                                                                                <p class="fs-12 text-center mb-3"><?php echo e(__($subscription->primary_heading)); ?></p>																					
                                                                                <p class="plan-cost text-center mb-0"><span class="plan-currency-sign"></span><?php echo config('payment.default_system_currency_symbol'); ?><?php echo e(number_format((float)$subscription->price, 2)); ?></p>
                                                                                <p class="fs-12 text-center mb-3"><?php echo e($subscription->currency); ?> / <?php echo e(__('Lifetime')); ?></p>
                                                                                <div class="text-center action-button mt-2 mb-4">
                                                                                    <a href="<?php echo e(route('user.prepaid.checkout', ['type' => 'lifetime', 'id' => $subscription->id])); ?>" class="btn btn-primary"><?php echo e(__('Subscribe Now')); ?></a>													
                                                                                </div>
                                                                                <p class="fs-12 text-center mb-3"><?php echo e(__($subscription->secondary_heading)); ?></p>																	
                                                                                <ul class="fs-12 pl-3">														
                                                                                    <?php $__currentLoopData = (explode(',', $subscription->plan_features)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <?php if($feature): ?>
                                                                                            <li><i class="fa-solid fa-circle-small fs-10 text-muted"></i> <?php echo e(__($feature)); ?></li>
                                                                                        <?php endif; ?>																
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>															
                                                                                </ul>																
                                                                            </div>					
                                                                        </div>	
                                                                    </div>							
                                                                </div>										
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>					

                                                    </div>

                                                <?php else: ?>
                                                    <div class="row text-center">
                                                        <div class="col-sm-12 mt-6 mb-6">
                                                            <h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No lifetime plans were set yet')); ?></h6>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                            </div>	
                                        <?php endif; ?>	
                                    </div>
                                </div>
                            
                            <?php else: ?>
                                <div class="row text-center">
                                    <div class="col-sm-12 mt-6 mb-6">
                                        <h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No Subscriptions or Prepaid plans were set yet')); ?></h6>
                                    </div>
                                </div>
                            <?php endif; ?>
                
                        </div>
                </div>
                
                </div>
        
            </section>
        <?php endif; ?>


        <!-- SECTION - BLOGS
        ========================================================-->
        <?php if(config('frontend.blogs_section') == 'on'): ?>
            <section id="blog-wrapper">

                <div class="container text-center">


                    <!-- SECTION TITLE -->
                    <div class="row mb-8 mt-5">

                        <div class="title w-100">
                            <h6><span><?php echo e(__('Latest')); ?></span> <?php echo e(__('Blogs')); ?></h6>
                            <p><?php echo e(__('Read our unique blog articles about various data archiving solutions and secrets')); ?></p>
                        </div>

                    </div> <!-- END SECTION TITLE -->

                    <?php if($blog_exists): ?>
                        
                        <!-- BLOGS -->
                        <div class="row" id="blogs">
                            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="blog" data-aos="zoom-in" data-aos-delay="500" data-aos-once="true" data-aos-duration="1000">			
                                <div class="blog-box">
                                    <div class="blog-img">
                                        <a href="<?php echo e(route('blogs.show', $blog->url)); ?>"><img src="<?php echo e(URL::asset($blog->image)); ?>" alt="Blog Image"></a>
                                    </div>
                                    <div class="blog-info">
                                        <h6 class="blog-date text-left text-muted mt-3 pt-1 mb-4"><span class="mr-2"><?php echo e($blog->created_by); ?></span> | <i class="mdi mdi-alarm mr-2"></i><?php echo e(date('j F Y', strtotime($blog->created_at))); ?></h6>
                                        <h5 class="blog-title fs-16 text-left mb-3"><?php echo e(__($blog->title)); ?></h5>                                     
                                    </div>
                                </div>                        
                            </div> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div> 
                        

                        <!-- ROTATORS BUTTONS -->
                        <div class="blogs-nav">
                            <a class="blogs-prev"><i class="fa fa-chevron-left"></i></a>
                            <a class="blogs-next"><i class="fa fa-chevron-right"></i></a>                                
                        </div>

                    <?php else: ?>
                        <div class="row text-center">
                            <div class="col-sm-12 mt-6 mb-6">
                                <h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No blog articles were published yet')); ?></h6>
                            </div>
                        </div>
                    <?php endif; ?>

                </div> <!-- END CONTAINER -->

                <?php echo adsense_frontend_blogs_728x90(); ?>

                
            </section> <!-- END SECTION BLOGS -->
        <?php endif; ?>


        <!-- SECTION - FAQ
        ========================================================-->
        <?php if(config('frontend.faq_section') == 'on'): ?>
            <section id="faq-wrapper">    
                <div class="container pt-7">

                    <div class="row text-center mb-8 mt-7">
                        <div class="col-md-12 title">
                            <h6><?php echo e(__('Frequently Asked')); ?> <span><?php echo e(__('Questions')); ?></span></h6>
                            <p><?php echo e(__('Got questions? We have you covered.')); ?></p>
                        </div>
                    </div>

                    <div class="row justify-content-md-center">
        
                        <?php if($faq_exists): ?>

                            <div class="col-md-10">
        
                                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div id="accordion" data-aos="fade-left" data-aos-delay="300" data-aos-once="true" data-aos-duration="700">
                                        <div class="card">
                                            <div class="card-header" id="heading<?php echo e($faq->id); ?>">
                                                <h5 class="mb-0">
                                                <span class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo e($faq->id); ?>" aria-expanded="false" aria-controls="collapse-<?php echo e($faq->id); ?>">
                                                    <?php echo e(__($faq->question)); ?>

                                                </span>
                                                </h5>
                                            </div>
                                        
                                            <div id="collapse-<?php echo e($faq->id); ?>" class="collapse" aria-labelledby="heading<?php echo e($faq->id); ?>" data-bs-parent="#accordion">
                                                <div class="card-body">
                                                    <?php echo __($faq->answer); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                    
        
                        <?php else: ?>
                            <div class="row text-center">
                                <div class="col-sm-12 mt-6 mb-6">
                                    <h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No FAQ answers were published yet')); ?></h6>
                                </div>
                            </div>
                        <?php endif; ?>
            
                    </div>        
                </div>
        
            </section> <!-- END SECTION FAQ -->
        <?php endif; ?>

        
        <!-- SECTION - CONTACT US
        ========================================================-->
        <?php if(config('frontend.contact_section') == 'on'): ?>
            <section id="contact-wrapper">

                <div class="container pt-9">       
                    
                    <!-- SECTION TITLE -->
                    <div class="row mb-8 text-center">

                        <div class="title w-100">
                            <h6><span><?php echo e(__('Contact')); ?></span> <?php echo e(__('With Us')); ?></h6>
                            <p><?php echo e(__('Reach out to us for additional information')); ?></p>
                        </div>

                    </div> <!-- END SECTION TITLE -->

                    
                    <div class="row">                
                        
                        <div class="col-md-6 col-sm-12" data-aos="fade-left" data-aos-delay="300" data-aos-once="true" data-aos-duration="700">
                            <img class="w-70" src="<?php echo e(URL::asset('img/files/about.svg')); ?>" alt="">
                        </div>

                        <div class="col-md-6 col-sm-12" data-aos="fade-right" data-aos-delay="300" data-aos-once="true" data-aos-duration="700">
                            <form id="" action="<?php echo e(route('contact')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
        
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="input-box mb-4">                             
                                            <input id="name" type="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" autocomplete="off" placeholder="<?php echo e(__('First Name')); ?>" required>
                                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <?php echo e($message); ?>

                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="input-box mb-4">                             
                                            <input id="lastname" type="text" class="form-control <?php $__errorArgs = ['lastname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="lastname" value="<?php echo e(old('lastname')); ?>" autocomplete="off" placeholder="<?php echo e(__('Last Name')); ?>" required>
                                            <?php $__errorArgs = ['lastname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <?php echo e($message); ?>

                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>                            
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="input-box mb-4">                             
                                            <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" autocomplete="off"  placeholder="<?php echo e(__('Email Address')); ?>" required>
                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <?php echo e($message); ?>

                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="input-box mb-4">                             
                                            <input id="phone" type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phone" value="<?php echo e(old('phone')); ?>" autocomplete="off"  placeholder="<?php echo e(__('Phone Number')); ?>" required>
                                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <?php echo e($message); ?>

                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>                            
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row justify-content-md-center">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="input-box">							
                                            <textarea class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="message" rows="10" required placeholder="<?php echo e(__('Message')); ?>"></textarea>
                                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-danger"><?php echo e($errors->first('message')); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>	
                                        </div>
                                    </div>
                                </div>
        
                                <input type="hidden" name="recaptcha" id="recaptcha">
                                
                                <div class="row justify-content-md-center text-center">
                                    <!-- ACTION BUTTON -->
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary special-action-button"><?php echo e(__('Send Message')); ?></button>							
                                    </div>
                                </div>
                            
                            </form>
        
                        </div>                   
                        
                    </div>
                
                </div>
        
            </section>
        <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(URL::asset('plugins/slick/slick.min.js')); ?>"></script>  
    <script src="<?php echo e(URL::asset('plugins/aos/aos.js')); ?>"></script> 
    <script src="<?php echo e(URL::asset('plugins/typed/typed.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('js/frontend.js')); ?>"></script>  
    <script type="text/javascript">
		$(function () {

            var typed = new Typed('#typed', {
                strings: ['<h1><span><?php echo e(__('Article Generator')); ?></span></h1>', 
                            '<h1><span><?php echo e(__('Content Improver')); ?></span></h1>',
                            '<h1><span><?php echo e(__('Blog Sections')); ?></span></h1>',
                            '<h1><span><?php echo e(__('Blog Ideas')); ?></span></h1>',
                            '<h1><span><?php echo e(__('SEO Meta Descriptions')); ?></span></h1>',
                            '<h1><span><?php echo e(__('FAQ Answers')); ?></span></h1>',
                            '<h1><span><?php echo e(__('And Many More!')); ?></span></h1>'],
                typeSpeed: 40,
                backSpeed: 40,
                backDelay: 2000,
                loop: true,
                showCursor: false,
            });

            AOS.init();

		});    
    </script>fo

    <?php if(config('services.google.recaptcha.enable') == 'on'): ?>
         <!-- Google reCaptcha JS -->
        <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(config('services.google.recaptcha.site_key')); ?>"></script>
        <script>
            grecaptcha.ready(function() {
                grecaptcha.execute('<?php echo e(config('services.google.recaptcha.site_key')); ?>', {action: 'contact'}).then(function(token) {
                    if (token) {
                    document.getElementById('recaptcha').value = token;
                    }
                });
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
        
        
       
        
       
    


<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/home.blade.php ENDPATH**/ ?>