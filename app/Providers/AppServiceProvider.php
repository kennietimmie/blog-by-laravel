<?php

namespace App\Providers;

use App\Http\Requests\StorePostRequest;
use App\Services\MailchimpNewsletter;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;
use App\Services\Newsletter;

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
        //
    }
}
