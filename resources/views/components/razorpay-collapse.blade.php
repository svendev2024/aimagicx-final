<div>
    <div class="input-box">								
        <h6>{{__('Full Name')}} <span class="text-muted">({{__('Required')}})</span></h6>
        <div class="form-group">							    
            <input type="text" class="form-control @error('razorpay_name') is-danger @enderror" id="razorpay_name" name="razorpay_name" value="{{ auth()->user()->name }}" autocomplete="off" required>
        </div>
            @error('razorpay_name')
            <p class="text-danger">{{ $errors->first('razorpay_name') }}</p>
        @enderror
    </div> 
    <div class="input-box">								
        <h6>{{__('Email Address')}} <span class="text-muted">({{__('Required')}})</span></h6>
        <div class="form-group">							    
            <input type="text" class="form-control @error('razorpay_email') is-danger @enderror" id="razorpay_email" name="razorpay_email" value="{{ auth()->user()->email }}" autocomplete="off" required>
        </div>
            @error('razorpay_email')
            <p class="text-danger">{{ $errors->first('razorpay_email') }}</p>
        @enderror
    </div>    
</div>