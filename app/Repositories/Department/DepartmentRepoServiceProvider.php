<?php 
namespace App\Repositories\Department;


use Illuminate\Support\ServiceProvider;

class DepartmentRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Department\DepartmentInterface', 'App\Repositories\Department\DepartmentRepository');
    }
}