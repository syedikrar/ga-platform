@component('mail::message')

Hey {{ $user->first_name }},

Congratulations - you have been nominated to join the Government Accelerators Plateform. 

Click on the link below to activate your email.

@component('mail::button', ['url' => 'https://gaplatform.200env.com/'])
    Join Now
@endcomponent

You can use this Password to login: 12345678

Thanks,<br>
{{ $user->name }}
@endcomponent