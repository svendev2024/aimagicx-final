@if ($message = Session::get('success'))
<div class="alert alert-success"> 
    <strong><i class="fa fa-check-circle"></i> {{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger">
    <strong><i class="fa fa-exclamation-triangle"></i> {{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning">
    <strong><i class="fa fa-exclamation-circle"></i> {{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info">
    <strong><i class="fa fa-info-circle"></i> {{ $message }}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    {{ __('There were some errors, please clear them first') }}
</div>
@endif