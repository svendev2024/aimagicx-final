<!-- TOP MENU BAR -->
<div class="app-header header">
    <div class="container-fluid"> 
        <div class="d-flex">
            <a class="header-brand" href="<?php echo e(url('/')); ?>">
                <img src="<?php echo e(URL::asset('img/brand/logo.png')); ?>" class="header-brand-img desktop-lgo" alt="Polly logo">
                <img src="<?php echo e(URL::asset('img/brand/favicon.png')); ?>" class="header-brand-img mobile-logo" alt="Polly logo">
            </a>
            <div class="app-sidebar__toggle nav-link icon" data-toggle="sidebar">
                <a class="open-toggle" href="<?php echo e(url('#')); ?>">
                    <span class="fa fa-align-left header-icon"></span>
                </a>
            </div>
            <!-- SEARCH BAR -->
            <div id="search-bar">                
                <div>
                    <a class="nav-link icon">
                        <form id="search-field" action="<?php echo e(route('search')); ?>" method="POST" enctype="multipart/form-data">         
                            <?php echo csrf_field(); ?>                   
                            <input type="search" name='keyword'>
                        </form>                        
                    </a>
                </div>                
            </div>
            <!-- END SEARCH BAR -->
            <!-- MENU BAR -->
            <div class="d-flex order-lg-2 ml-auto"> 
                <div id="form-group">
                    <select id="template-selection" name="template-selection" data-placeholder="<?php echo e(__('Create AI Document')); ?>" data-callback="changeTemplate">
                        <?php $__currentLoopData = App\Services\HelperService::listTemplates(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option data-id="<?php echo e($temp->template_code); ?>" value="original-template/<?php echo e($temp->slug); ?>" data-icon="<?php echo e($temp->icon); ?>"><?php echo e(__($temp->name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
                        <?php $__currentLoopData = App\Services\HelperService::listCustomTemplates(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option data-id="<?php echo e($temp->template_code); ?>" value="<?php echo e($temp->slug); ?>/<?php echo e($temp->template_code); ?>" data-icon="<?php echo e($temp->icon); ?>"><?php echo e(__($temp->name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>																																
                    </select>
                </div>
                <div class="dropdown header-notify">
                    <a class="nav-link icon" data-bs-toggle="dropdown">                        
                        <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'admin')): ?>
                            <span class="header-icon fa-regular fa-bell pr-3"></span>
                            <?php if(auth()->user()->unreadNotifications->where('type', '<>', 'App\Notifications\GeneralNotification')->count()): ?>
                                <span class="pulse "></span>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'user|subscriber')): ?>
                            <?php if(config('settings.user_notification') == 'enabled'): ?>
                                <span class="header-icon fa-solid fa-bell pr-3"></span>                            
                                    <?php if(auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification')->count()): ?>
                                        <span class="pulse "></span>
                                    <?php endif; ?>                            
                            <?php endif; ?>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow  animated">
                        <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'admin')): ?>
                            <?php if(auth()->user()->unreadNotifications->where('type', '<>', 'App\Notifications\GeneralNotification')->count()): ?>
                                <div class="dropdown-header">
                                    <h6 class="mb-0 fs-12 font-weight-bold notification-dark-theme"><span id="total-notifications"></span> <span class="text-primary"><?php echo e(__('New')); ?></span> <?php echo e(__('Notification(s)')); ?></h6>
                                    <a href="#" class="mb-1 badge badge-primary ml-auto pl-3 pr-3 mark-read" id="mark-all"><?php echo e(__('Mark All Read')); ?></a>
                                </div>
                                <div class="notify-menu">
                                    <div class="notify-menu-inner">
                                        <?php $__currentLoopData = auth()->user()->unreadNotifications->where('type', '<>', 'App\Notifications\GeneralNotification'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="d-flex dropdown-item border-bottom pl-4 pr-4">
                                                <?php if($notification->data['type'] == 'new-user'): ?>                                                
                                                    <div>
                                                        <a href="<?php echo e(route('admin.notifications.systemShow', [$notification->id])); ?>" class="d-flex">
                                                            <div class="notifyimg bg-info-transparent text-info"> <i class="fa-solid fa-user-check fs-18"></i></div>
                                                            <div class="mr-6">
                                                                <div class="font-weight-bold fs-12 notification-dark-theme"><?php echo e(__('New User Registered')); ?></div>
                                                                <div class="text-muted fs-10"><?php echo e(__('Name')); ?>: <?php echo e($notification->data['name']); ?></div>
                                                                <div class="small text-muted fs-10"><?php echo e($notification->created_at->diffForHumans()); ?></div>
                                                            </div>                                            
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="#" class="badge badge-primary mark-read mark-as-read" data-id="<?php echo e($notification->id); ?>"><?php echo e(__('Mark as Read')); ?></a>
                                                    </div>
                                                <?php endif; ?>  
                                                <?php if($notification->data['type'] == 'new-payment'): ?>                                                
                                                    <div>
                                                        <a href="<?php echo e(route('admin.notifications.systemShow', [$notification->id])); ?>" class="d-flex">
                                                            <div class="notifyimg bg-info-green"> <i class="fa-solid fa-sack-dollar leading-loose"></i></div>
                                                            <div class="mr-4">
                                                                <div class="font-weight-bold fs-12 notification-dark-theme"><?php echo e(__('New User Payment')); ?></div>
                                                                <div class="text-muted fs-10"><?php echo e(__('From')); ?>: <?php echo e($notification->data['name']); ?></div>
                                                                <div class="small text-muted fs-10"><?php echo e($notification->created_at->diffForHumans()); ?></div>
                                                            </div>                                            
                                                        </a>
                                                    </div>
                                                    <div class="text-right">
                                                        <a href="#" class="badge badge-primary mark-read mark-as-read ml-5" data-id="<?php echo e($notification->id); ?>"><?php echo e(__('Mark as Read')); ?></a>
                                                    </div>
                                                <?php endif; ?>  
                                                <?php if($notification->data['type'] == 'payout-request'): ?>                                                
                                                    <div>
                                                        <a href="<?php echo e(route('admin.notifications.systemShow', [$notification->id])); ?>" class="d-flex">
                                                            <div class="notifyimg bg-info-green"> <i class="fa-solid fa-face-tongue-money fs-20 leading-loose"></i></div>
                                                            <div class="mr-4">
                                                                <div class="font-weight-bold fs-12 notification-dark-theme"><?php echo e(__('New Payout Request')); ?></div>
                                                                <div class="text-muted fs-10"><?php echo e(__('From')); ?>: <?php echo e($notification->data['name']); ?></div>
                                                                <div class="small text-muted fs-10"><?php echo e($notification->created_at->diffForHumans()); ?></div>
                                                            </div>                                            
                                                        </a>
                                                    </div>
                                                    <div class="text-right">
                                                        <a href="#" class="badge badge-primary mark-read mark-as-read ml-5" data-id="<?php echo e($notification->id); ?>"><?php echo e(__('Mark as Read')); ?></a>
                                                    </div>
                                                <?php endif; ?>                                                
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                    </div>                              
                                </div>
                                <div class="view-all-button text-center">                            
                                    <a href="<?php echo e(route('admin.notifications.system')); ?>" class="fs-12 font-weight-bold notification-dark-theme"><?php echo e(__('View All Notifications')); ?></a>
                                </div>                            
                            <?php else: ?>
                                <div class="view-all-button text-center">
                                    <h6 class=" fs-12 font-weight-bold mb-1 notification-dark-theme"><?php echo e(__('There are no new notifications')); ?></h6>                                    
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(config('settings.user_notification') == 'enabled'): ?>
                            <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'user|subscriber')): ?>
                                <?php if(auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification')->count()): ?>
                                    <div class="dropdown-header">
                                        <h6 class="mb-0 fs-12 font-weight-bold notification-dark-theme"><?php echo e(auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification')->count()); ?> <span class="text-primary">New</span> Notification(s)</h6>
                                        <a href="#" class="mb-1 badge badge-primary ml-auto pl-3 pr-3 mark-read" id="mark-all"><?php echo e(__('Mark All Read')); ?></a>
                                    </div>
                                    <div class="notify-menu">
                                        <div class="notify-menu-inner">
                                            <?php $__currentLoopData = auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="dropdown-item border-bottom pl-4 pr-4">
                                                    <div>
                                                        <a href="<?php echo e(route('user.notifications.show', [$notification->id])); ?>" class="d-flex">
                                                            <div class="notifyimg bg-info-transparent text-info"> <i class="fa fa-bell fs-18"></i></div>
                                                            <div>
                                                                <div class="font-weight-bold fs-12 mt-2 notification-dark-theme"><?php echo e(__('New')); ?> <?php echo e($notification->data['type']); ?> <?php echo e(__('Notification')); ?></div>
                                                                <div class="small text-muted fs-10"><?php echo e($notification->created_at->diffForHumans()); ?></div>
                                                            </div>                                            
                                                        </a>
                                                    </div>                                            
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                
                                        </div>
                                    </div>
                                    <div class="view-all-button text-center">                            
                                        <a href="<?php echo e(route('user.notifications')); ?>" class="fs-12 font-weight-bold notification-dark-theme"><?php echo e(__('View All Notifications')); ?></a>
                                    </div>                             
                                <?php else: ?>
                                    <div class="view-all-button text-center">
                                        <h6 class=" fs-12 font-weight-bold mb-1 notification-dark-theme"><?php echo e(__('There are no new notifications')); ?></h6>                                    
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>                        
                    </div>
                </div>
                <div class="dropdown items-center flex">
                    <a href="#" class="nav-link icon btn-theme-toggle">
                        <span class="header-icon fa-sharp fa-solid"></span>
                    </a>
                </div>
                <div class="dropdown header-expand" >
                    <a  class="nav-link icon" id="fullscreen-button">
                        <span class="header-icon fa-solid fa-expand" id="fullscreen-icon"></span>
                    </a>
                </div>
                <div class="dropdown header-locale">
                    <a class="nav-link icon" data-bs-toggle="dropdown">
                        <span class="header-icon flag flag-<?php echo e(Config::get('locale')[App::getLocale()]['flag']); ?> pr-1"></span><span class="header-text fs-13 pr-5"><?php echo e(Config::get('locale')[App::getLocale()]['code']); ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
                        <div class="local-menu">
                            <?php $__currentLoopData = Config::get('locale'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($lang != App::getLocale()): ?>
                                    <a href="<?php echo e(route('locale', $lang)); ?>" class="dropdown-item d-flex pl-4">
                                        <div class="text-info"><i class="flag flag-<?php echo e($language['flag']); ?> mr-4"></i></div>
                                        <div>
                                            <span class="font-weight-normal fs-12"><?php echo e($language['display']); ?></span>
                                        </div>
                                    </a>                                        
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>                
                <div class="dropdown profile-dropdown">
                    <a href="#" class="nav-link" data-bs-toggle="dropdown">
                        <span class="float-right">
                            <img src="<?php if(auth()->user()->profile_photo_path): ?><?php echo e(asset(auth()->user()->profile_photo_path)); ?> <?php else: ?> <?php echo e(URL::asset('img/users/avatar.jpg')); ?> <?php endif; ?>" alt="img" class="avatar avatar-md">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
                        <div class="text-center pt-2">
                            <span class="text-center user fs-12 pb-0 font-weight-bold"><?php echo e(Auth::user()->name); ?></span><br>
                            <span class="text-center fs-12 text-muted"><?php echo e(Auth::user()->job_role); ?></span>
                            <div class="dropdown-divider mt-3"></div>
                            <li class="mt-3 mb-2 fs-12 font-weight-bold"><?php echo e(__('Plan')); ?>: <?php if(is_null(auth()->user()->plan_id)): ?><?php echo e(__('Free Trial')); ?> <?php else: ?> <?php echo e(__(App\Services\HelperService::getPlanName())); ?>  <?php endif; ?> <?php if(is_null(auth()->user()->plan_id)): ?> <br><a href="<?php echo e(route('user.plans')); ?>" class="text-yellow upgrade-action-button"><?php echo e(__('Upgrade Now')); ?></a> <?php endif; ?></li>
                            <div class="inline-flex w-100 text-left pl-6">
                                <div class="flex w-100">
                                    <span class="fs-11 font-weight-600"><i class="fa-solid fa-message-lines text-primary mr-2"></i><span class="text-muted"><?php echo e(__('Words')); ?></span> <span class="text-primary ml-1" id="available-words"><?php echo e(App\Services\HelperService::userAvailableWords()); ?></span></span>
                                </div> 
                                <div class="flex w-100">
                                    <span class="fs-11 font-weight-600"><i class="fa-sharp fa-solid fa-message-image text-primary mr-2"></i><span class="text-muted"><?php echo e(__('Images')); ?></span> <span class="text-primary ml-1" id="available-images"><?php echo e(App\Services\HelperService::userAvailableImages()); ?></span></span>
                                </div> 
                                <div class="flex w-100">
                                    <span class="fs-11 font-weight-600"><i class="fa-sharp fa-solid fa-message-music text-primary mr-2"></i><span class="text-muted"><?php echo e(__('Minutes')); ?></span> <span class="text-primary ml-1" id="available-minutes"><?php echo e(App\Services\HelperService::userAvailableMinutes()); ?></span></span>
                                </div> 
                                <div class="flex w-100">
                                    <span class="fs-11 font-weight-600"><i class="fa-solid fa-message-captions text-primary mr-2"></i><span class="text-muted"><?php echo e(__('Characters')); ?></span> <span class="text-primary ml-1" id="available-characters"><?php echo e(App\Services\HelperService::userAvailableChars()); ?></span></span>
                                </div>                    
                            </div>
                            <div class="dropdown-divider mt-3"></div>     
                        </div>
                        <a class="dropdown-item d-flex" href="<?php echo e(route('user.plans')); ?>">
                            <span class="profile-icon fa-solid fa-box-circle-check"></span>
                            <div class="fs-12"><?php echo e(__('Pricing Plans')); ?></div>
                        </a>        
                        <a class="dropdown-item d-flex" href="<?php echo e(route('user.templates')); ?>">
                            <span class="profile-icon fa-solid fa-microchip-ai"></span>
                            <div class="fs-12"><?php echo e(__('Templates')); ?></div>
                        </a>
                        <a class="dropdown-item d-flex" href="<?php echo e(route('user.workbooks')); ?>">
                            <span class="profile-icon fa-solid fa-folder-bookmark"></span>
                            <div class="fs-12"><?php echo e(__('Workbooks')); ?></div>
                        </a> 
                        <?php if(config('payment.referral.enabled') == 'on'): ?>
                            <a class="dropdown-item d-flex" href="<?php echo e(route('user.referral')); ?>">
                                <span class="profile-icon fa-solid fa-badge-dollar"></span>
                                <span class="fs-12"><?php echo e(__('Affiliate Program')); ?></span></a>
                            </a>
                        <?php endif; ?>                        
                        <a class="dropdown-item d-flex" href="<?php echo e(route('user.purchases')); ?>">
                            <span class="profile-icon fa-solid fa-money-check-pen"></span>
                            <span class="fs-12"><?php echo e(__('Transactions')); ?></span></a>
                        </a>
                        <a class="dropdown-item d-flex" href="<?php echo e(route('user.purchases.subscriptions')); ?>">
                            <span class="profile-icon fa-solid fa-box-check"></span>
                            <span class="fs-12"><?php echo e(__('Subscriptions')); ?></span></a>
                        </a>
                        <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'user|subscriber')): ?>
                            <?php if(config('settings.user_support') == 'enabled'): ?>
                                <a class="dropdown-item d-flex" href="<?php echo e(route('user.support')); ?>">
                                    <span class="profile-icon fa-solid fa-messages-question"></span>
                                    <div class="fs-12"><?php echo e(__('Support Request')); ?></div>
                                </a>
                            <?php endif; ?>        
                            <?php if(config('settings.user_notification') == 'enabled'): ?>
                                <a class="dropdown-item d-flex" href="<?php echo e(route('user.notifications')); ?>">
                                    <span class="profile-icon fa-solid fa-message-exclamation"></span>
                                    <div class="fs-12"><?php echo e(__('Notifications')); ?></div>
                                    <?php if(auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification')->count()): ?>
                                        <span class="badge badge-warning ml-3"><?php echo e(auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification')->count()); ?></span>
                                    <?php endif; ?>   
                                </a>
                            <?php endif; ?> 
                        <?php endif; ?>
                        <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'admin')): ?>   
                            <a class="dropdown-item d-flex" href="<?php echo e(route('user.support')); ?>">
                                <span class="profile-icon fa-solid fa-messages-question"></span>
                                <div class="fs-12"><?php echo e(__('Support Request')); ?></div>
                            </a>
                            <a class="dropdown-item d-flex" href="<?php echo e(route('user.notifications')); ?>">
                                <span class="profile-icon fa-solid fa-message-exclamation"></span>
                                <div class="fs-12"><?php echo e(__('Notifications')); ?></div>
                                <?php if(auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification')->count()): ?>
                                    <span class="badge badge-warning ml-3"><?php echo e(auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification')->count()); ?></span>
                                <?php endif; ?>   
                            </a>
                        <?php endif; ?>
                        <a class="dropdown-item d-flex" href="<?php echo e(route('user.profile')); ?>">
                            <span class="profile-icon fa-solid fa-id-badge"></span>
                            <span class="fs-12"><?php echo e(__('My Profile')); ?></span></a>
                        </a>
                        <a class="dropdown-item d-flex" href="<?php echo e(route('user.security')); ?>">
                            <span class="profile-icon fa-solid fa-lock-hashtag"></span>
                            <div class="fs-12"><?php echo e(__('Change Password')); ?></div>
                        </a>
                        <a class="dropdown-item d-flex" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"> 
                            <span class="profile-icon fa-solid fa-right-from-bracket"></span>          
                            <div class="fs-12"><?php echo e(__('Logout')); ?></div>                            
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END MENU BAR -->
        </div>
    </div>
</div>
<!-- END TOP MENU BAR -->
<?php /**PATH /home/u685450742/domains/aimagicx.com/public_html/Dashboard-app/resources/views/layouts/nav-top.blade.php ENDPATH**/ ?>