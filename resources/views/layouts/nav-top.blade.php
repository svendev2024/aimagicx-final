<!-- TOP MENU BAR -->
<div class="app-header header">
    <div class="container-fluid"> 
        <div class="d-flex">
            <a class="header-brand" href="{{ url('/') }}">
                <img src="{{URL::asset('img/brand/logo.png')}}" class="header-brand-img desktop-lgo" alt="Polly logo">
                <img src="{{URL::asset('img/brand/favicon.png')}}" class="header-brand-img mobile-logo" alt="Polly logo">
            </a>
            <div class="app-sidebar__toggle nav-link icon" data-toggle="sidebar">
                <a class="open-toggle" href="{{url('#')}}">
                    <span class="fa fa-align-left header-icon"></span>
                </a>
            </div>
            <!-- SEARCH BAR -->
            <div id="search-bar">                
                <div>
                    <a class="nav-link icon">
                        <form id="search-field" action="{{ route('search') }}" method="POST" enctype="multipart/form-data">         
                            @csrf                   
                            <input type="search" name='keyword'>
                        </form>                        
                    </a>
                </div>                
            </div>
            <!-- END SEARCH BAR -->
            <!-- MENU BAR -->
            <div class="d-flex order-lg-2 ml-auto"> 
                <div id="form-group">
                    <select id="template-selection" name="template-selection" data-placeholder="{{ __('Create AI Document') }}" data-callback="changeTemplate">
                        @foreach (App\Services\HelperService::listTemplates() as $temp)
                            <option data-id="{{ $temp->template_code }}" value="original-template/{{ $temp->slug }}" data-icon="{{   $temp->icon }}">{{ __($temp->name)  }}</option>
                        @endforeach	
                        @foreach (App\Services\HelperService::listCustomTemplates() as $temp)
                            <option data-id="{{ $temp->template_code }}" value="{{ $temp->slug }}/{{ $temp->template_code }}" data-icon="{{   $temp->icon }}">{{ __($temp->name)  }}</option>
                        @endforeach																																
                    </select>
                </div>
                <div class="dropdown header-notify">
                    <a class="nav-link icon" data-bs-toggle="dropdown">                        
                        @role('admin')
                            <span class="header-icon fa-regular fa-bell pr-3"></span>
                            @if (auth()->user()->unreadNotifications->where('type', '<>', 'App\Notifications\GeneralNotification')->count())
                                <span class="pulse "></span>
                            @endif
                        @endrole
                        @role('user|subscriber')
                            @if (config('settings.user_notification') == 'enabled')
                                <span class="header-icon fa-solid fa-bell pr-3"></span>                            
                                    @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification')->count())
                                        <span class="pulse "></span>
                                    @endif                            
                            @endif
                        @endrole
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow  animated">
                        @role('admin')
                            @if (auth()->user()->unreadNotifications->where('type', '<>', 'App\Notifications\GeneralNotification')->count())
                                <div class="dropdown-header">
                                    <h6 class="mb-0 fs-12 font-weight-bold notification-dark-theme"><span id="total-notifications"></span> <span class="text-primary">{{ __('New') }}</span> {{ __('Notification(s)') }}</h6>
                                    <a href="#" class="mb-1 badge badge-primary ml-auto pl-3 pr-3 mark-read" id="mark-all">{{ __('Mark All Read') }}</a>
                                </div>
                                <div class="notify-menu">
                                    <div class="notify-menu-inner">
                                        @foreach ( auth()->user()->unreadNotifications->where('type', '<>', 'App\Notifications\GeneralNotification') as $notification )
                                            <div class="d-flex dropdown-item border-bottom pl-4 pr-4">
                                                @if ($notification->data['type'] == 'new-user')                                                
                                                    <div>
                                                        <a href="{{ route('admin.notifications.systemShow', [$notification->id]) }}" class="d-flex">
                                                            <div class="notifyimg bg-info-transparent text-info"> <i class="fa-solid fa-user-check fs-18"></i></div>
                                                            <div class="mr-6">
                                                                <div class="font-weight-bold fs-12 notification-dark-theme">{{ __('New User Registered') }}</div>
                                                                <div class="text-muted fs-10">{{ __('Name') }}: {{ $notification->data['name'] }}</div>
                                                                <div class="small text-muted fs-10">{{ $notification->created_at->diffForHumans() }}</div>
                                                            </div>                                            
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="#" class="badge badge-primary mark-read mark-as-read" data-id="{{ $notification->id }}">{{ __('Mark as Read') }}</a>
                                                    </div>
                                                @endif  
                                                @if ($notification->data['type'] == 'new-payment')                                                
                                                    <div>
                                                        <a href="{{ route('admin.notifications.systemShow', [$notification->id]) }}" class="d-flex">
                                                            <div class="notifyimg bg-info-green"> <i class="fa-solid fa-sack-dollar leading-loose"></i></div>
                                                            <div class="mr-4">
                                                                <div class="font-weight-bold fs-12 notification-dark-theme">{{ __('New User Payment') }}</div>
                                                                <div class="text-muted fs-10">{{ __('From') }}: {{ $notification->data['name'] }}</div>
                                                                <div class="small text-muted fs-10">{{ $notification->created_at->diffForHumans() }}</div>
                                                            </div>                                            
                                                        </a>
                                                    </div>
                                                    <div class="text-right">
                                                        <a href="#" class="badge badge-primary mark-read mark-as-read ml-5" data-id="{{ $notification->id }}">{{ __('Mark as Read') }}</a>
                                                    </div>
                                                @endif  
                                                @if ($notification->data['type'] == 'payout-request')                                                
                                                    <div>
                                                        <a href="{{ route('admin.notifications.systemShow', [$notification->id]) }}" class="d-flex">
                                                            <div class="notifyimg bg-info-green"> <i class="fa-solid fa-face-tongue-money fs-20 leading-loose"></i></div>
                                                            <div class="mr-4">
                                                                <div class="font-weight-bold fs-12 notification-dark-theme">{{ __('New Payout Request') }}</div>
                                                                <div class="text-muted fs-10">{{ __('From') }}: {{ $notification->data['name'] }}</div>
                                                                <div class="small text-muted fs-10">{{ $notification->created_at->diffForHumans() }}</div>
                                                            </div>                                            
                                                        </a>
                                                    </div>
                                                    <div class="text-right">
                                                        <a href="#" class="badge badge-primary mark-read mark-as-read ml-5" data-id="{{ $notification->id }}">{{ __('Mark as Read') }}</a>
                                                    </div>
                                                @endif                                                
                                            </div>
                                        @endforeach  
                                    </div>                              
                                </div>
                                <div class="view-all-button text-center">                            
                                    <a href="{{ route('admin.notifications.system') }}" class="fs-12 font-weight-bold notification-dark-theme">{{ __('View All Notifications') }}</a>
                                </div>                            
                            @else
                                <div class="view-all-button text-center">
                                    <h6 class=" fs-12 font-weight-bold mb-1 notification-dark-theme">{{ __('There are no new notifications') }}</h6>                                    
                                </div>
                            @endif
                        @endrole
                        @if (config('settings.user_notification') == 'enabled')
                            @role('user|subscriber')
                                @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification')->count())
                                    <div class="dropdown-header">
                                        <h6 class="mb-0 fs-12 font-weight-bold notification-dark-theme">{{ auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification')->count() }} <span class="text-primary">New</span> Notification(s)</h6>
                                        <a href="#" class="mb-1 badge badge-primary ml-auto pl-3 pr-3 mark-read" id="mark-all">{{ __('Mark All Read') }}</a>
                                    </div>
                                    <div class="notify-menu">
                                        <div class="notify-menu-inner">
                                            @foreach ( auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification') as $notification )
                                                <div class="dropdown-item border-bottom pl-4 pr-4">
                                                    <div>
                                                        <a href="{{ route('user.notifications.show', [$notification->id]) }}" class="d-flex">
                                                            <div class="notifyimg bg-info-transparent text-info"> <i class="fa fa-bell fs-18"></i></div>
                                                            <div>
                                                                <div class="font-weight-bold fs-12 mt-2 notification-dark-theme">{{ __('New') }} {{ $notification->data['type'] }} {{ __('Notification') }}</div>
                                                                <div class="small text-muted fs-10">{{ $notification->created_at->diffForHumans() }}</div>
                                                            </div>                                            
                                                        </a>
                                                    </div>                                            
                                                </div>
                                            @endforeach                                
                                        </div>
                                    </div>
                                    <div class="view-all-button text-center">                            
                                        <a href="{{ route('user.notifications') }}" class="fs-12 font-weight-bold notification-dark-theme">{{ __('View All Notifications') }}</a>
                                    </div>                             
                                @else
                                    <div class="view-all-button text-center">
                                        <h6 class=" fs-12 font-weight-bold mb-1 notification-dark-theme">{{ __('There are no new notifications') }}</h6>                                    
                                    </div>
                                @endif
                            @endrole
                        @endif                        
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
                        <span class="header-icon flag flag-{{ Config::get('locale')[App::getLocale()]['flag'] }} pr-1"></span><span class="header-text fs-13 pr-5">{{ Config::get('locale')[App::getLocale()]['code'] }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
                        <div class="local-menu">
                            @foreach (Config::get('locale') as $lang => $language)
                                @if ($lang != App::getLocale())
                                    <a href="{{ route('locale', $lang) }}" class="dropdown-item d-flex pl-4">
                                        <div class="text-info"><i class="flag flag-{{ $language['flag'] }} mr-4"></i></div>
                                        <div>
                                            <span class="font-weight-normal fs-12">{{ $language['display'] }}</span>
                                        </div>
                                    </a>                                        
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>                
                <div class="dropdown profile-dropdown">
                    <a href="#" class="nav-link" data-bs-toggle="dropdown">
                        <span class="float-right">
                            <img src="@if(auth()->user()->profile_photo_path){{ asset(auth()->user()->profile_photo_path) }} @else {{ URL::asset('img/users/avatar.jpg') }} @endif" alt="img" class="avatar avatar-md">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
                        <div class="text-center pt-2">
                            <span class="text-center user fs-12 pb-0 font-weight-bold">{{ Auth::user()->name }}</span><br>
                            <span class="text-center fs-12 text-muted">{{ Auth::user()->job_role }}</span>
                            <div class="dropdown-divider mt-3"></div>
                            <li class="mt-3 mb-2 fs-12 font-weight-bold">{{ __('Plan') }}: @if (is_null(auth()->user()->plan_id)){{ __('Free Trial') }} @else {{ __(App\Services\HelperService::getPlanName())}}  @endif @if (is_null(auth()->user()->plan_id)) <br><a href="{{ route('user.plans') }}" class="text-yellow upgrade-action-button">{{ __('Upgrade Now') }}</a> @endif</li>
                            <div class="inline-flex w-100 text-left pl-6">
                                <div class="flex w-100">
                                    <span class="fs-11 font-weight-600"><i class="fa-solid fa-message-lines text-primary mr-2"></i><span class="text-muted">{{ __('Words') }}</span> <span class="text-primary ml-1" id="available-words">{{ App\Services\HelperService::userAvailableWords()}}</span></span>
                                </div> 
                                <div class="flex w-100">
                                    <span class="fs-11 font-weight-600"><i class="fa-sharp fa-solid fa-message-image text-primary mr-2"></i><span class="text-muted">{{ __('Images') }}</span> <span class="text-primary ml-1" id="available-images">{{ App\Services\HelperService::userAvailableImages()}}</span></span>
                                </div> 
                                <div class="flex w-100">
                                    <span class="fs-11 font-weight-600"><i class="fa-sharp fa-solid fa-message-music text-primary mr-2"></i><span class="text-muted">{{ __('Minutes') }}</span> <span class="text-primary ml-1" id="available-minutes">{{ App\Services\HelperService::userAvailableMinutes()}}</span></span>
                                </div> 
                                <div class="flex w-100">
                                    <span class="fs-11 font-weight-600"><i class="fa-solid fa-message-captions text-primary mr-2"></i><span class="text-muted">{{ __('Characters') }}</span> <span class="text-primary ml-1" id="available-characters">{{ App\Services\HelperService::userAvailableChars()}}</span></span>
                                </div>                    
                            </div>
                            <div class="dropdown-divider mt-3"></div>     
                        </div>
                        <a class="dropdown-item d-flex" href="{{ route('user.plans') }}">
                            <span class="profile-icon fa-solid fa-box-circle-check"></span>
                            <div class="fs-12">{{ __('Pricing Plans') }}</div>
                        </a>        
                        <a class="dropdown-item d-flex" href="{{ route('user.templates') }}">
                            <span class="profile-icon fa-solid fa-microchip-ai"></span>
                            <div class="fs-12">{{ __('Templates') }}</div>
                        </a>
                        <a class="dropdown-item d-flex" href="{{ route('user.workbooks') }}">
                            <span class="profile-icon fa-solid fa-folder-bookmark"></span>
                            <div class="fs-12">{{ __('Workbooks') }}</div>
                        </a> 
                        @if (config('payment.referral.enabled') == 'on')
                            <a class="dropdown-item d-flex" href="{{ route('user.referral') }}">
                                <span class="profile-icon fa-solid fa-badge-dollar"></span>
                                <span class="fs-12">{{ __('Affiliate Program') }}</span></a>
                            </a>
                        @endif                        
                        <a class="dropdown-item d-flex" href="{{ route('user.purchases') }}">
                            <span class="profile-icon fa-solid fa-money-check-pen"></span>
                            <span class="fs-12">{{ __('Transactions') }}</span></a>
                        </a>
                        <a class="dropdown-item d-flex" href="{{ route('user.purchases.subscriptions') }}">
                            <span class="profile-icon fa-solid fa-box-check"></span>
                            <span class="fs-12">{{ __('Subscriptions') }}</span></a>
                        </a>
                        @role('user|subscriber')
                            @if (config('settings.user_support') == 'enabled')
                                <a class="dropdown-item d-flex" href="{{ route('user.support') }}">
                                    <span class="profile-icon fa-solid fa-messages-question"></span>
                                    <div class="fs-12">{{ __('Support Request') }}</div>
                                </a>
                            @endif        
                            @if (config('settings.user_notification') == 'enabled')
                                <a class="dropdown-item d-flex" href="{{ route('user.notifications') }}">
                                    <span class="profile-icon fa-solid fa-message-exclamation"></span>
                                    <div class="fs-12">{{ __('Notifications') }}</div>
                                    @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification')->count())
                                        <span class="badge badge-warning ml-3">{{ auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification')->count() }}</span>
                                    @endif   
                                </a>
                            @endif 
                        @endrole
                        @role('admin')   
                            <a class="dropdown-item d-flex" href="{{ route('user.support') }}">
                                <span class="profile-icon fa-solid fa-messages-question"></span>
                                <div class="fs-12">{{ __('Support Request') }}</div>
                            </a>
                            <a class="dropdown-item d-flex" href="{{ route('user.notifications') }}">
                                <span class="profile-icon fa-solid fa-message-exclamation"></span>
                                <div class="fs-12">{{ __('Notifications') }}</div>
                                @if (auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification')->count())
                                    <span class="badge badge-warning ml-3">{{ auth()->user()->unreadNotifications->where('type', 'App\Notifications\GeneralNotification')->count() }}</span>
                                @endif   
                            </a>
                        @endrole
                        <a class="dropdown-item d-flex" href="{{ route('user.profile') }}">
                            <span class="profile-icon fa-solid fa-id-badge"></span>
                            <span class="fs-12">{{ __('My Profile') }}</span></a>
                        </a>
                        <a class="dropdown-item d-flex" href="{{ route('user.security') }}">
                            <span class="profile-icon fa-solid fa-lock-hashtag"></span>
                            <div class="fs-12">{{ __('Change Password') }}</div>
                        </a>
                        <a class="dropdown-item d-flex" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"> 
                            <span class="profile-icon fa-solid fa-right-from-bracket"></span>          
                            <div class="fs-12">{{ __('Logout') }}</div>                            
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <!-- END MENU BAR -->
        </div>
    </div>
</div>
<!-- END TOP MENU BAR -->
