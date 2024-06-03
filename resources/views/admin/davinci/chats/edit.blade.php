@extends('layouts.app')

@section('page-header')
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7"> 
		<div class="page-leftheader">
			<h4 class="page-title mb-0">{{ __('Edit Chat Bot') }}</h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-microchip-ai mr-2 fs-12"></i>{{ __('Admin') }}</a></li>
				<li class="breadcrumb-item"><a href="{{ route('admin.davinci.dashboard') }}"> {{ __('Davinci Management') }}</a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="#"> {{ __('AI Chats Customization') }}</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> {{ __('Edit Chat Bot') }}</a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
@endsection

@section('content')						
	<div class="row">
		<div class="col-lg-6 col-md-12 col-xm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title">{{ __('Edit Chat Bot') }}</h3>
				</div>
				<div class="card-body pt-5">									
					<form action="{{ route('admin.davinci.chat.update', $chat->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
          
            <div class="row">
          
              <div class="col-sm-12 col-md-3">
                <div class="chat-logo-image overflow-hidden">
                  <img class="rounded-circle" src="{{ URL::asset($chat->logo) }}" alt="Main Logo">
                </div>
              </div>
          
              <div class="col-sm-12 col-md-9">
                <div class="input-box">
                  <label class="form-label fs-12">{{ __('Select Avatar') }} </label>
                  <div class="input-group file-browser">									
                    <input type="text" class="form-control border-right-0 browse-file" placeholder="Minimum 60px by 60px image" readonly>
                    <label class="input-group-btn">
                      <span class="btn btn-primary special-btn">
                        {{ __('Browse') }} <input type="file" name="logo" style="display: none;">
                      </span>
                    </label>
                  </div>
                  @error('logo')
                    <p class="text-danger">{{ $errors->first('logo') }}</p>
                  @enderror
                </div>
              </div>					
          
            </div>
          
            <div class="col-md-12 col-sm-12 mt-2 mb-4 pl-0">
              <div class="form-group">
                <label class="custom-switch">
                  <input type="checkbox" name="activate" class="custom-switch-input" @if($chat->status) checked @endif>
                  <span class="custom-switch-indicator"></span>
                  <span class="custom-switch-description">{{ __('Activate Chat Bot') }}</span>
                </label>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-12 col-sm-12">													
                <div class="input-box">								
                  <h6>{{ __('Name') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
                  <div class="form-group">							    
                    <input type="text" class="form-control @error('name') is-danger @enderror" id="name" name="name" value="{{ $chat->name }}">
                    @error('name')
                      <p class="text-danger">{{ $errors->first('name') }}</p>
                    @enderror
                  </div> 
                </div> 
              </div>
          
              <div class="col-md-12 col-sm-12">													
                <div class="input-box">								
                  <h6>{{ __('Character') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
                  <div class="form-group">							    
                    <input type="text" class="form-control @error('character') is-danger @enderror" id="character" name="character" value="{{ $chat->sub_name }}">
                    @error('character')
                      <p class="text-danger">{{ $errors->first('character') }}</p>
                    @enderror
                  </div> 
                </div> 
              </div>
          
              <div class="col-md-12 col-sm-12">
                <div class="input-box">
                  <h6>{{ __('Chat Bot Category') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
                  <select id="chats" name="category" data-placeholder="{{ __('Set AI Chat Bot Category') }}">
                    <option value="all" @if($chat->category == 'all') selected @endif>{{ __('All') }}</option>
                    <option value="free" @if($chat->category == 'free') selected @endif>{{ __('Free Chat Bot') }}</option>																																											
                    <option value="standard" @if($chat->category == 'standard') selected @endif> {{ __('Standard Chat Bot') }}</option>
                    <option value="professional" @if($chat->category == 'professional') selected @endif> {{ __('Professional Chat Bot') }}</option>
                    <option value="premium" @if($chat->category == 'premium') selected @endif> {{ __('Premium Chat Bot') }}</option>																																																														
                  </select>
                </div>
              </div>
          
              <div class="col-sm-12">								
                <div class="input-box">								
                  <h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Introduction') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
                  <div class="form-group">
                    <div id="field-buttons"></div>							    
                    <textarea type="text" rows=5 class="form-control @error('introduction') is-danger @enderror" id="prompt" name="introduction">{{ $chat->description }}</textarea>
                    @error('introduction')
                      <p class="text-danger">{{ $errors->first('introduction') }}</p>
                    @enderror
                  </div> 
                </div> 
              </div>
          
              <div class="col-sm-12">								
                <div class="input-box">								
                  <h6 class="fs-11 mb-2 font-weight-semibold">{{ __('Prompt') }} <span class="text-required"><i class="fa-solid fa-asterisk"></i></span></h6>
                  <div class="form-group">
                    <div id="field-buttons"></div>							    
                    <textarea type="text" rows=5 class="form-control @error('prompt') is-danger @enderror" id="prompt" name="prompt">{{ $chat->prompt }}</textarea>
                    @error('prompt')
                      <p class="text-danger">{{ $errors->first('prompt') }}</p>
                    @enderror
                  </div> 
                </div> 
              </div>
            </div>
          
            <div class="modal-footer d-inline">
              <div class="row text-center">
                <div class="col-md-12">
                  <a href="{{ route('admin.davinci.chats') }}" class="btn btn-cancel mr-2">{{ __('Cancel') }}</a>
                  <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </div>
              </div>
              
            </div>
          </form>			
				</div>
			</div>
		</div>
	</div>
@endsection

