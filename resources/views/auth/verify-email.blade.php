@extends('layouts.auth')

@section('content')
<div class="container-fluid justify-content-center">
    <div class="row h-100vh align-items-center background-white">
        <div class="col-md-7 col-sm-12 text-center background-special h-100 align-middle p-0" id="login-background">
            <div class="login-bg"></div>
        </div>

        <div class="col-md-5 col-sm-12 h-100" id="login-responsive">                
            <div class="card-body pr-10 pl-10 pt-10">               
                
                <h3 class="text-center font-weight-bold mb-8">{{__('Welcome to')}} <span class="text-info">{{ config('app.name') }}</span></h3>
                
                <form method="POST" action="{{ route('verification.send') }}" id="verify-email">
                    @csrf                      
                    
                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-login alert-success mb-8"> 
                            {{ __('A new verification link has been sent to the email address.') }}
                        </div>
                    @endif

                    <div class="mb-6 fs-14">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you did not receive the email, we will gladly send you another.') }}
                    </div>

                    <div class="form-group mb-0 text-center">                        
                        <button type="submit" class="btn btn-primary mr-2">{{ __('Resend Verification Email') }}</button>                                                                         
                    </div>
                
                </form>
                
                <div class="text-center">
                    <p class="fs-10 text-muted mt-2">or <a class="text-info" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></p> 
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

            </div>      
        </div>
    </div>
</div>
@endsection
