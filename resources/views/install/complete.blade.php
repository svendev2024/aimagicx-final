@extends('layouts.auth')

@section('content')
<div class="container vertical-center">
    <div class="row justify-content-md-center">
        <div class="col-md-6 col-sm-12">   
            <div class="install-path text-center mt-9 mb-5">
                <span class="btn mr-2"><i class="fa-brands fa-instalod"></i></span>
                <span class="btn mr-2"><i class="fa-solid fa-ballot-check"></i></span>
                <span class="btn mr-2"><i class="fa-solid fa-file-check"></i></span>	
                <span class="btn mr-2"><i class="fa fa-database"></i></span>
                <span class="btn mr-2"><i class="fa-solid fa-file-certificate"></i></span>
                <span class="btn mr-2 active"><i class="fa-solid fa-shield-check"></i></span>
            </div>
            <div class="card border-0 special-shadow mt-5 mb-5">	
                						
                <div class="card-body mt-7">                                                  

                    <h3 class="text-center font-weight-bold mb-8">{{ __('Installation Complete') }}</h3>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-login alert-success"> 
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong><i class="fa fa-check-circle"></i> {{ $message }}</strong>
                        </div>
                        @endif

                        @if ($message = Session::get('error'))
                        <div class="alert alert-login alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong><i class="fa fa-exclamation-triangle"></i> {{ $message }}</strong>
                        </div>
                    @endif
                    
                    <div id="install-wrapper" class="text-center pb-7">
                        <span><i class="fa-solid fa-shield-check"></i></span>
                        @if ($activated)
                            <p class="text-success">{{ __('Application Successfully Activated') }}!</p>
                        @else 
                            <p class="text-danger">{{ __('Application was NOT Activated') }}!</p>
                        @endif

                        @if ($createDefaultAdmin)
                            <p>{{ __('You can Login with following default admin credentials') }}:</p>
                            <ul>
                                <li>{{ __('Username') }}: <strong>admin@example.com</strong></li>
                                <li>{{ __('Password') }}: <strong>admin12345</strong></li>
                            </ul>
                            <br>
                        @endif
                        
                    </div>

       
            </div>

            

        </div>  
        <div class="form-group mb-0 text-center">                        
            <a href="{{ url('/') }}"  class="btn btn-primary pr-5 pl-5">{{ __('Finish Installation') }}</a>                                               
        </div>
                  
        </div>
         
    </div>
</div>
@endsection

