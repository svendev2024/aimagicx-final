@extends('layouts.auth')

@section('content')
<div class="container vertical-center">
    <div class="row justify-content-md-center">
        <div class="col-md-6 col-sm-12">   
            <div class="install-path text-center mt-9 mb-5">
                <span class="btn mr-2"><i class="fa-brands fa-instalod"></i></span>
                <span class="btn mr-2 active"><i class="fa-solid fa-ballot-check"></i></span>
                <span class="btn mr-2"><i class="fa-solid fa-file-check"></i></span>	
                <span class="btn mr-2"><i class="fa fa-database"></i></span>
                <span class="btn mr-2"><i class="fa-solid fa-file-certificate"></i></span>
                <span class="btn mr-2"><i class="fa-solid fa-shield-check"></i></span>
            </div>
            <div class="card border-0 special-shadow">	
                						
                <div class="card-body">                                                  

                    <h3 class="text-center font-weight-bold fs-16 mb-4 mt-3">{{ __('Requirements') }}</h3>

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
                    
                    <div id="install-wrapper">
                        @foreach($results['extensions'] as $type => $extension)
                            <div class="list-group list-group-flush {{ $loop->index == 0 ? 'mb-n3 mt-n3' : 'mt-3 mb-n3 pt-3' }}">
                                <div class="list-group-item px-0">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <span class="font-weight-medium">{{ mb_strtoupper($type) }}</span>
                                            @if($type == 'php')
                                                {{ config('install.php_version') }}+
                                            @endif
                                        </div>
                
                                        <div class="col-auto d-flex align-items-center pr-4">
                                            @if($type == 'php')
                                                @if(version_compare(PHP_VERSION, config('installer.php_version')) >= 0)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="svg-success" viewBox="0 0 17.44 13.13"><g id="61594a51-9b02-49ff-a94c-05e8c8f16478" data-name="Layer 2"><g id="21687ac0-78b2-4ea5-8955-fcde8112835a" data-name="Layer 30"><path d="M16,0,5.72,10.28,1.44,6,0,7.44l5,5,.72.69.72-.69,11-11Z"/></g></g></svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="svg-error" viewBox="0 0 16 16"><path d="M14.8,0a1.2,1.2,0,0,1,.85,2.05L9.7,8l5.95,5.95a1.2,1.2,0,0,1-1.7,1.7L8,9.7,2.05,15.65a1.2,1.2,0,0,1-1.7-1.7L6.3,8,.35,2.05A1.2,1.2,0,1,1,2.05.35L8,6.3,13.95.35A1.2,1.2,0,0,1,14.8,0Z"/></svg>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                
                                @foreach($extension as $name => $enabled)
                                    <div class="list-group-item px-0 text-muted">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                {{ $name }}
                                            </div>
                                            <div class="col-auto d-flex align-items-center pr-4">
                                                @if($enabled)
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="svg-success" viewBox="0 0 17.44 13.13"><g id="61594a51-9b02-49ff-a94c-05e8c8f16478" data-name="Layer 2"><g id="21687ac0-78b2-4ea5-8955-fcde8112835a" data-name="Layer 30"><path d="M16,0,5.72,10.28,1.44,6,0,7.44l5,5,.72.69.72-.69,11-11Z"/></g></g></svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="svg-error" viewBox="0 0 16 16"><path d="M14.8,0a1.2,1.2,0,0,1,.85,2.05L9.7,8l5.95,5.95a1.2,1.2,0,0,1-1.7,1.7L8,9.7,2.05,15.65a1.2,1.2,0,0,1-1.7-1.7L6.3,8,.35,2.05A1.2,1.2,0,1,1,2.05.35L8,6.3,13.95.35A1.2,1.2,0,0,1,14.8,0Z"/></svg>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

            </div>

        </div>  
        <div class="form-group mb-0 text-center">                        
            <a href="{{ route('install.permissions') }}"  class="btn btn-primary pr-7 pl-7">{{ __('Next') }} <i class="fa fa-angle-double-right ml-1"></i></a>                                               
        </div>
                  
        </div>
         
    </div>

</div>
@endsection

