<?php

namespace App\Providers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Services\MailchimpNewsletter;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;
use App\Services\Newsletter;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Newsletter::class, function () {
            $client = (new ApiClient())->setConfig(collect(config('services.mailchimp'))->only('apiKey', 'server'));
            return new MailchimpNewsletter($client);
        });

        app()->bind(StorePostRequest::class, fn () => new StorePostRequest(request()->route('post')));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('admin', fn (User $user) =>  in_array($user->role, ['editor', 'administrator']));
        Gate::define('update.create-post', function (User $user, Post $post) {
            return $user->id === $post->user_id && $post->exists || !$post->exists || request()->user()->can('admin');
        });
    }
}
