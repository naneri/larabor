<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            'App\Zabor\Repositories\Contracts\ItemInterface',
            'App\Zabor\Repositories\ItemEloquentRepository'
        );

        $this->app->bind(
            'App\Zabor\Repositories\Contracts\CategoryInterface',
            'App\Zabor\Repositories\CategoryEloquentRepository'
        );

        $this->app->bind(
            'App\Zabor\Repositories\Contracts\MetaInterface',
            'App\Zabor\Repositories\MetaEloquentRepository'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
