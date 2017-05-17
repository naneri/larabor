<?php namespace App\Providers;

use App\Zabor\Categories\CategoryEloquentRepository;
use App\Zabor\Categories\Contracts\CategoryInterface;
use App\Zabor\Items\Contracts\ItemInterface;
use App\Zabor\Metas\Contracts\MetaInterface;
use App\Zabor\Items\ItemEloquentRepository;
use App\Zabor\Metas\MetaEloquentRepository;
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
        $this->app->bind(ItemInterface::class, ItemEloquentRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryEloquentRepository::class);
        $this->app->bind(MetaInterface::class, MetaEloquentRepository::class);
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
