@component('mail::message')
# Your quality claim reports decision has updated!

@component('mail::panel')
Decision: {{$decision}}<br>
@endcomponent

@component('mail::button', ['url' => route("home")])
View Claims
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent