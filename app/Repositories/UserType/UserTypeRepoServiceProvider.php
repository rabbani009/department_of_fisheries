<?php 
namespace App\Repositories\UserType;


use Illuminate\Support\ServiceProvider;

class UserTypeRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\UserType\UserTypeInterface', 'App\Repositories\UserType\UserTypeRepository');
    }
}