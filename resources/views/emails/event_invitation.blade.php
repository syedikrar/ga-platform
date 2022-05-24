@component('mail::message')
Hey {{$user->name_en}} , <br/>
You have been Invited for this meeting "{{ $event->subject_en }}"

Thanks,<br>

@endcomponent
