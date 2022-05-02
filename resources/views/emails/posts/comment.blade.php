@component('mail::message')
# Hi, {{ $notifiable->fullname}}

There is a new comment on post {{ $post->title }}

@component('mail::button', ['url' => route('posts.single', ['post' => $post->slug]), 'color' => 'blue'])
{{ __('View post') }}
@endcomponent

Regards,<br>
{{ config('app.name') }}

@endcomponent