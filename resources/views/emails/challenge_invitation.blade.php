@component('mail::message')

Hey {{ $user->first_name }},

You have been added in challenge

Thanks,<br>
{{ $user->name }}
@endcomponent
