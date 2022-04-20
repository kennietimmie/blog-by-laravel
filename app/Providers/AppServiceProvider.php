<?php

namespace App\Providers;

use App\Models\User;
use App\Services\MailchimpNewsletter;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;
use App\Services\Newsletter;
use Illuminate\Support\Facades\Blade;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('admin', fn (User $user) =>  in_array($user->role, ['editor', 'administrator']));

        Blade::if('admin', fn () => request()->user() && request()->user()->can('admin'));
        Blade::directive(
            'timely',
            function ($time) {
                return "<?php echo ($time)->diffForHumans(); ?>";
            }
        );
    }
}
