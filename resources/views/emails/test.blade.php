@component('mail::message')
# {{ $input->subject }}

{{ $input->message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
