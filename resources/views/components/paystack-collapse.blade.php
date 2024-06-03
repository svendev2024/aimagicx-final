<div>
    <div class="input-box">								
        <h6>{{__('Email Address')}} <span class="text-muted">({{__('Required')}})</span></h6>
        <div class="form-group">							    
            <input type="text" class="form-control @error('paystack_email') is-danger @enderror" id="paystack_email" name="paystack_email" value="{{ auth()->user()->email }}" autocomplete="off">
        </div>
            @error('paystack_email')
            <p class="text-danger">{{ $errors->first('paystack_email') }}</p>
        @enderror
    </div>    
</div>