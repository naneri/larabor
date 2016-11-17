<?php namespace App\Providers;

use App\Zabor\Repositories\CategoryEloquentRepository;
use App\Zabor\Repositories\Contracts\CategoryInterface;
use App\Zabor\Repositories\Contracts\ItemInterface;
use App\Zabor\Repositories\Contracts\MetaInterface;
use App\Zabor\Repositories\ItemEloquentRepository;
use App\Zabor\Repositories\MetaEloquentRepository;
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
        $this->app->bind( ItemInterface::class,     ItemEloquentRepository::class );
        $this->app->bind( CategoryInterface::class, CategoryEloquentRepository::class );
        $this->app->bind( MetaInterface::class,     MetaEloquentRepository::class );
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
