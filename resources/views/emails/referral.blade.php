@component('mail::message')
# You have been invited to join {{ config('app.name') }} by {{ ucfirst(auth()->user()->name) }}

Join {{ config('app.name') }} to start generating your content by AI.

<a href="{{ config('app.url') }}/?ref={{ auth()->user()->referral_id }}">Register Now</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
