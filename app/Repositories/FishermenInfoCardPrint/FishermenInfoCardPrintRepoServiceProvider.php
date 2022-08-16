<?php 
namespace App\Repositories\FishermenInfoCardPrint;


use Illuminate\Support\ServiceProvider;

class FishermenInfoCardPrintRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\FishermenInfoCardPrint\FishermenInfoCardPrintInterface', 'App\Repositories\FishermenInfoCardPrint\FishermenInfoCardPrintRepository');
    }
}