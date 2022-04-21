<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class CustomBladesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Admin check
         */
        Blade::if('admin', fn () => request()->user() && request()->user()->can('admin'));

        /**
         * Calls the diffForHumans on a Carbon instance
         */
        Blade::directive(
            'timely',
            function ($time) {
                return "<?php echo ($time)->diffForHumans(); ?>";
            }
        );
    }
}
