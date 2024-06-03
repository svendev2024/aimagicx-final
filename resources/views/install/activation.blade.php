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
                        <span class="btn mr-2 active"><i class="fa-solid fa-file-certificate"></i></span>
                        <span class="btn mr-2"><i class="fa-solid fa-shield-check"></i></span>
                    </div>
                    <div class="card border-0 special-shadow">	
                                                
                        <div class="card-body">                                                  

                            <h3 class="text-center font-weight-bold fs-16 mb-4 mt-3">{{ __('License Activation') }}</h3>

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
                            
                            <form action="{{ route('install.activation.activate') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div id="install-wrapper">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">								
                                            <div class="input-box">								
                                                <h6>{{ __('Your Activation Code') }}</h6>
                                                <div class="form-group">							    
                                                    <input type="text" class="form-control @error('license') is-danger @enderror" id="license" name="license" value="{{ old('license') }}" placeholder="Enter Your License Code" autocomplete="off" required>
                                                    @error('license')
                                                        <p class="text-danger">{{ $errors->first('license') }}</p>
                                                    @enderror
                                                </div> 
                                            </div>
                                        </div>                                

                                        <div class="col-lg-12 col-md-12 col-sm-12">								
                                            <div class="input-box">								
                                                <h6>{{ __('Your Entavo Username') }}</h6>
                                                <div class="form-group">							    
                                                    <input type="text" class="form-control @error('username') is-danger @enderror" id="username" name="username" value="{{ old('username') }}" placeholder="Enter Your Envato Username" autocomplete="off" required>
                                                    @error('username')
                                                        <p class="text-danger">{{ $errors->first('username') }}</p>
                                                    @enderror
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                    </div>                    

                </div>  
                <div class="form-group mb-0 text-center">                        
                    <button type="submit"  class="btn btn-primary pr-7 pl-7">{{ __('Activate') }} <i class="fa fa-angle-double-right ml-1"></i></button>                                               
                </div>
            </form>    
        </div>
         
    </div>
</div>
@endsection

