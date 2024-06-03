@extends('layouts.auth')

@section('css')
	<!-- Data Table CSS -->
	<link href="{{URL::asset('plugins/awselect/awselect.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    @if (config('frontend.maintenance') == 'on')			
        <div class="container h-100vh">
            <div class="row text-center h-100vh align-items-center">
                <div class="col-md-12">
                    <img src="{{ URL::asset('img/files/maintenance.png') }}" alt="Maintenance Image">
                    <h2 class="mt-4 font-weight-bold">{{ __('We are just tuning up a few things') }}.</h2>
                    <h5>{{ __('We apologize for the inconvenience but') }} <span class="font-weight-bold text-info">{{ config('app.name') }}</span> {{ __('is currenlty undergoing planned maintenance') }}.</h5>
                </div>
            </div>
        </div>
    @else
        @if (config('settings.registration') == 'enabled')
            <div class="container-fluid justify-content-center">
                <div class="row h-100vh align-items-center background-white">
                    <div class="col-md-7 col-sm-12 text-center background-special h-100 align-middle p-0" id="login-background">
                        <div class="login-bg"></div>
                    </div>
                    
                    <div class="col-md-5 col-sm-12 h-100" id="login-responsive">                
                        <div class="card-body pr-10 pl-10 pt-10">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf                                
                                
                                <h3 class="text-center font-weight-bold mb-8">{{__('Sign Up to')}} <span class="text-info"><a href="{{ url('/') }}">{{ config('app.name') }}</a></span></h3>

                                @if (config('settings.oauth_login') == 'enabled')
                                    <div class="divider">
                                        <div class="divider-text text-muted">
                                            <small>{{__('Register with Your Social Media Account')}}</small>
                                        </div>
                                    </div>

                                    <div class="actions-total text-center">
                                        @if(config('services.facebook.enable') == 'on')<a href="{{ url('/auth/redirect/facebook') }}" data-tippy-content="{{ __('Login with Facebook') }}" class="btn mr-2" id="login-facebook"><i class="fa-brands fa-facebook-f"></i></a>@endif
                                        @if(config('services.twitter.enable') == 'on')<a href="{{ url('/auth/redirect/twitter') }}" data-tippy-content="{{ __('Login with Twitter') }}" class="btn mr-2" id="login-twitter"><i class="fa-brands fa-twitter"></i></a>@endif	
                                        @if(config('services.google.enable') == 'on')<a href="{{ url('/auth/redirect/google') }}" data-tippy-content="{{ __('Login with Google') }}" class="btn mr-2" id="login-google"><i class="fa-brands fa-google"></i></a>@endif	
                                        @if(config('services.linkedin.enable') == 'on')<a href="{{ url('/auth/redirect/linkedin') }}" data-tippy-content="{{ __('Login with Linkedin') }}" class="btn mr-2" id="login-linkedin"><i class="fa-brands fa-linkedin-in"></i></a>@endif	
                                    </div>

                                    <div class="divider">
                                        <div class="divider-text text-muted">
                                            <small>{{ __('or register with email') }}</small>
                                        </div>
                                    </div>
                                @endif

                                <div class="input-box mb-4">                             
                                    <label for="name" class="fs-12 font-weight-bold text-md-right">{{ __('Full Name') }}</label>
                                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="off" autofocus placeholder="{{ __('First and Last Names') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror                            
                                </div>

                                <div class="input-box mb-4">                             
                                    <label for="email" class="fs-12 font-weight-bold text-md-right">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off"  placeholder="{{ __('Email Address') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror                            
                                </div>

                                <div class="input-box mb-4">                             
                                    <label for="country" class="fs-12 font-weight-bold text-md-right">{{ __('Country') }}</label>
                                    <select id="user-country" name="country" data-placeholder="{{ __('Select Your Country') }}" required>	
                                        @foreach(config('countries') as $value)
											<option value="{{ $value }}" @if(config('settings.default_country') == $value) selected @endif>{{ $value }}</option>
										@endforeach										
                                    </select>
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror                            
                                </div>

                                <div class="input-box">                            
                                    <label for="password-input" class="fs-12 font-weight-bold text-md-right">{{ __('Password') }}</label>
                                    <input id="password-input" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off" placeholder="{{ __('Password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror                            
                                </div>

                                <div class="input-box">
                                    <label for="password-confirm" class="fs-12 font-weight-bold text-md-right">{{ __('Confirm Password') }}</label>                       
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off" placeholder="{{ __('Confirm Password') }}">                        
                                </div>

                                <div class="form-group mb-3">  
                                    <div class="d-flex">                        
                                        <label class="custom-switch">
                                            <input type="checkbox" class="custom-switch-input" name="agreement" id="agreement" {{ old('remember') ? 'checked' : '' }} required>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description fs-10 text-muted">{{__('By continuing, I agree with your')}} <a href="{{ route('terms') }}" class="text-info">{{__('Terms and Conditions')}}</a> {{__('and')}} <a href="{{ route('privacy') }}" class="text-info">{{__('Privacy Policies')}}</a></span>
                                        </label>   
                                    </div>
                                </div>

                                <input type="hidden" name="recaptcha" id="recaptcha">

                                <div class="form-group mb-0">                        
                                    <button type="submit" class="btn btn-primary mr-2">{{ __('Sign Up') }}</button> 
                                    <p class="fs-10 text-muted mt-2">or <a class="text-info" href="{{ route('login') }}">{{ __('Login') }}</a></p>                               
                                </div>
                            </form>
                        </div>       
                    </div>
                </div>
            </div>
        @else
            <h5 class="text-center pt-9">{{__('New user registration is disabled currently')}}</h5>
        @endif
    @endif
@endsection

@section('js')
	<!-- Awselect JS -->
	<script src="{{URL::asset('plugins/awselect/awselect.min.js')}}"></script>
	<script src="{{URL::asset('js/awselect.js')}}"></script>

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
