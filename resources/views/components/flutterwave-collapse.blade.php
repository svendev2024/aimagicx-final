<div>
    <div class="input-box">								
        <h6>{{__('Full Name')}} <span class="text-muted">({{__('Required')}})</span></h6>
        <div class="form-group">							    
            <input type="text" class="form-control @error('flutterwave_name') is-danger @enderror" id="flutterwave_name" name="flutterwave_name" value="{{ auth()->user()->name }}" autocomplete="off" required>
        </div>
            @error('flutterwave_name')
            <p class="text-danger">{{ $errors->first('flutterwave_name') }}</p>
        @enderror
    </div> 
    <div class="input-box">								
        <h6>{{__('Email Address')}} <span class="text-muted">({{__('Required')}})</span></h6>
        <div class="form-group">							    
            <input type="text" class="form-control @error('flutterwave_email') is-danger @enderror" id="flutterwave_email" name="flutterwave_email" value="{{ auth()->user()->email }}" autocomplete="off" required>
        </div>
            @error('flutterwave_email')
            <p class="text-danger">{{ $errors->first('flutterwave_email') }}</p>
        @enderror
    </div>    
    <div class="input-box">								
        <h6>{{__('Phone Number')}}</h6>
        <div class="form-group">							    
            <input type="text" class="form-control @error('flutterwave_phone') is-danger @enderror" id="flutterwave_phone" name="flutterwave_phone" value="{{ auth()->user()->phone_number }}" autocomplete="off" required>
        </div>
            @error('flutterwave_phone')
            <p class="text-danger">{{ $errors->first('flutterwave_phone') }}</p>
        @enderror
    </div> 
</div>