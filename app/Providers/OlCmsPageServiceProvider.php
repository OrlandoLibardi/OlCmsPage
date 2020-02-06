<?php

namespace OrlandoLibardi\PageBuildCms\app\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use OrlandoLibardi\PageBuildCms\app\Page;
use OrlandoLibardi\PageBuildCms\app\Http\Obervers\PageObserver;

class OlCmsPageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Rotas para controllador pages
        Route::namespace('OrlandoLibardi\PageBuildCms\app\Http\Controllers')
        ->middleware(['web', 'auth'])
        ->prefix('admin')
        ->group(__DIR__. '/../../routes/web.php');

        //Novas rotas dinâmicas
        $this->loadRoutesFrom(__DIR__. '/../../routes/web-dynamic.php');

        //publicar os arquivos
        $this->publishes([
            __DIR__.'/../../resources/views/admin/' => resource_path('views/admin/'),
            __DIR__.'/../../resources/views/website/' => resource_path('views/website/'),            
            __DIR__.'/../../public' => public_path('/'),
            __DIR__.'/../../database/migrations/' => database_path('migrations'),
            __DIR__.'/../../database/seeds/' => database_path('seeds'),
            __DIR__.'/../../config/pages.php' => config_path('pages.php'),
        ],'adminPage');

        Page::observe(PageObserver::class);
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}