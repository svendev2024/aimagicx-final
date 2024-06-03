@extends('layouts.auth')

@section('content')
<div class="container vertical-center">
    <div class="row justify-content-md-center">
        
                <div class="col-md-6 col-sm-12">   
                    <div class="install-path text-center mt-9 mb-5">
                        <span class="btn mr-2"><i class="fa-brands fa-instalod"></i></span>
                        <span class="btn mr-2"><i class="fa-solid fa-ballot-check"></i></span>
                        <span class="btn mr-2"><i class="fa-solid fa-file-check"></i></span>	
                        <span class="btn mr-2 active"><i class="fa fa-database"></i></span>
                        <span class="btn mr-2"><i class="fa-solid fa-file-certificate"></i></span>
                        <span class="btn mr-2"><i class="fa-solid fa-shield-check"></i></span>
                    </div>
                    <div class="card border-0 special-shadow">	
                                                
                        <div class="card-body install-notification">                                                  

                            <h3 class="text-center font-weight-bold fs-16 mb-4 mt-3">{{ __('Database Configuration') }}</h3>

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
                            
                            <form action="{{ route('install.database.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div id="install-wrapper">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">								
                                            <div class="input-box">								
                                                <h6>{{ __('Hostname') }}</h6>
                                                <div class="form-group">							    
                                                    <input type="text" class="form-control @error('hostname') is-danger @enderror" id="hostname" name="hostname" value="{{ old('hostname') }}" placeholder="Enter Database Hostname" autocomplete="off" required>
                                                    @error('hostname')
                                                        <p class="text-danger">{{ $errors->first('hostname') }}</p>
                                                    @enderror
                                                </div> 
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">								
                                            <div class="input-box">								
                                                <h6>{{ __('Port') }}</h6>
                                                <div class="form-group">							    
                                                    <input type="text" class="form-control @error('port') is-danger @enderror" id="port" name="port" value="{{ old('port') }}" placeholder="Enter Database Port" autocomplete="off" required>
                                                    @error('port')
                                                        <p class="text-danger">{{ $errors->first('port') }}</p>
                                                    @enderror
                                                </div> 
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12">								
                                            <div class="input-box">								
                                                <h6>{{ __('Database Name') }}</h6>
                                                <div class="form-group">							    
                                                    <input type="text" class="form-control @error('database') is-danger @enderror" id="database" name="database" value="{{ old('database') }}" placeholder="Enter Database Name" autocomplete="off" required>
                                                    @error('database')
                                                        <p class="text-danger">{{ $errors->first('database') }}</p>
                                                    @enderror
                                                </div> 
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12">								
                                            <div class="input-box">								
                                                <h6>{{ __('DB User') }}</h6>
                                                <div class="form-group">							    
                                                    <input type="text" class="form-control @error('user') is-danger @enderror" id="user" name="user" value="{{ old('user') }}" placeholder="Enter Database User" autocomplete="off" required>
                                                    @error('user')
                                                        <p class="text-danger">{{ $errors->first('user') }}</p>
                                                    @enderror
                                                </div> 
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12">								
                                            <div class="input-box">								
                                                <h6>{{ __('DB User Password') }}</h6>
                                                <div class="form-group">							    
                                                    <input type="text" class="form-control @error('password') is-danger @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="Enter Database User Password" autocomplete="off">
                                                    @error('password')
                                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                                    @enderror
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                    </div>                    

                </div>  
                <div class="form-group mb-0 text-center">                        
                    <button type="submit"  class="btn btn-primary pr-7 pl-7">{{ __('Next') }} <i class="fa fa-angle-double-right ml-1"></i></button>                                               
                </div>
            </form>    
        </div>
         
    </div>
</div>
@endsection

