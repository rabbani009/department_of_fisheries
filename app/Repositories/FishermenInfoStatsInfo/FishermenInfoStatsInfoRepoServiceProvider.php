<?php 
namespace App\Repositories\FishermenInfoStatsInfo;


use Illuminate\Support\ServiceProvider;

class FishermenInfoStatsInfoRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\FishermenInfoStatsInfo\FishermenInfoStatsInfoInterface', 'App\Repositories\FishermenInfoStatsInfo\FishermenInfoStatsInfoRepository');
    }
}