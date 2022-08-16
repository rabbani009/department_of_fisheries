<?php 
namespace App\Repositories\Fishers;


use Illuminate\Support\ServiceProvider;

class FishersRepoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Fishers\FishersInterface', 'App\Repositories\Fishers\FishersRepository');
    }
}