@extends('layouts.guest')

@section('css')
	<!-- Data Table CSS -->
	<link href="{{URL::asset('plugins/awselect/awselect.min.css')}}" rel="stylesheet" />
@endsection

@section('content')

    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="section-title">
                    <!-- SECTION TITLE -->
                    <div class="text-center mb-9 mt-9" id="contact-row">

                        <div class="title">
                            <h6><span>{{ __('Blog') }}</span></h6>
                            <p>{{ $blog->title }}</p>
                        </div>

                    </div> <!-- END SECTION TITLE -->
                </div>
            </div>
        </div>
    </div>

    <section id="blog-wrapper">

        <div class="container pt-9">

            <div class="row justify-content-md-center">

                <div class="col-md-12 col-sm-12">
                    <div class="blog">
                        <img src="{{ URL::asset($blog->image) }}" alt="Blog Image">
                    </div>
                    <h6 class="fs-20 mt-6 font-weight-bold text-center">{{ $blog->title }}</h6>
                    <p class="fs-12 text-center text-muted mb-5"><span><i class="mdi mdi-account-edit mr-1"></i>{{ $blog->created_by }}</span> / <span><i class="mdi mdi-alarm mr-1"></i>{{ date('F j, Y', strtotime($blog->created_at)) }}</span></p>

                    <div class="fs-14" id="blog-view-mobile">{!! $blog->body !!}</div>
                </div>
     
            </div>        
        </div>

    </section>
@endsection

@section('js')
	<!-- Awselect JS -->
	<script src="{{URL::asset('plugins/awselect/awselect.min.js')}}"></script>
	<script src="{{URL::asset('js/awselect.js')}}"></script>  
    <script src="{{URL::asset('js/minimize.js')}}"></script> 
@endsection
