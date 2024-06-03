@extends('layouts.guest')

@section('content')
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="section-title">
                    <!-- SECTION TITLE -->
                    <div class="text-center mb-9 mt-9 pt-5" id="contact-row">

                        <div class="title">
                            <h6><span>{{ __('Terms and Conditions') }}</span></h6>
                        </div>

                    </div> <!-- END SECTION TITLE -->
                </div>
            </div>
        </div>
    </div>

    <section id="about-wrapper">

        <div class="container">
            <div class="row justify-content-center background-white">
                <div class="col-md-10 col-sm-12 policy">                
                    <div class="card-body pt-9 pb-9">            

                        <div class="mb-7">
                            {!! $pages['terms'] !!}
                        </div>

                        <div class="form-group mt-6 text-center">                        
                            <a href="{{ route('register') }}" class="btn btn-primary mr-2">{{ __('I Agree, Let\'s Sign Up') }}</a> 
                            <a href="{{ route('login') }}" class="btn btn-primary mr-2">{{ __('I Agree, Let\'s Login') }}</a>                               
                        </div>
                        
                    </div>      
                </div>
            </div>
        </div>
    </section>
    @section('js')
        <script src="{{URL::asset('js/minimize.js')}}"></script>
    @endsection
@endsection

