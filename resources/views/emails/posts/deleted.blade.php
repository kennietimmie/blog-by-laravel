@component('mail::message')
# Welcome to {{env('APP_NAME')}}

Dear {{$post->author->name}},


Your post {{ $post->title }} has been deleted<br>
***{!! $post->content !!}***

@component('mail::button', ['url' => "{{env('APP_URL')}}/login"])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent