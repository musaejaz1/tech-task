@component('mail::message')
# Hello,

Historical Data for {{$data['subject']}} requested for dates {{$data['body']}}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
