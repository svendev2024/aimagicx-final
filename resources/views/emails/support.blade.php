@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => {{ config('app.url') }}])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
