<form action="{{ route('user.referral.payout.decline', $id) }}" method="POST" enctype="multipart/form-data">
    @method('DELETE')
    @csrf
        
    <div class="modal-body">        
		<p>{{ __('Do you want to cancel this payout request') }}?</p>     
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-cancel mr-2" data-dismiss="modal">{{ __('Cancel') }}</button>
        <button type="submit" class="btn btn-confirm">{{ __('Confirm') }}</button>
    </div>
</form>