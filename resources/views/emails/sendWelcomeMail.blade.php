@component('mail::message')
# Welcome

To the Government Accelerators

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
