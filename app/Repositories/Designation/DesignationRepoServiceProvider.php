<?php 
namespace App\Repositories\Designation;


use Illuminate\Support\ServiceProvider;

class DesignationRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Designation\DesignationInterface', 'App\Repositories\Designation\DesignationRepository');
    }
}