<form action="{{ route('user.payments.subscription.stop', $id) }}" method="GET" enctype="multipart/form-data">
    @csrf
        
    <div class="modal-body">        
		<p>{{ __('Are you sure you want to cancel your subscription') }}?</p>     
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-cancel mr-2" data-dismiss="modal">{{ __('Cancel') }}</button>
        <button type="submit" class="btn btn-confirm">{{ __('Confirm') }}</button>
    </div>
</form>