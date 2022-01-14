@component('mail::message')
# The account created successfully

@component('mail::panel')
Email: {{$user->email}}<br>
Password: {{$password}}
@endcomponent

@component('mail::button', ['url' => route("user.login")])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent