<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ConsoleTVs\Charts\Registrar as Charts;

class AppServiceProvider extends ServiceProvider
{
    protected $repositories = ["User","Schedule"];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //bind the repositories
        foreach($this->repositories as $repository){
            $this->app->bind(
                "App\\Repositories\\$repository\\$repository"."RepositoryInterface",
                "App\\Repositories\\$repository\\$repository"."Repository"
            );
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Charts $charts)
    {
        $charts->register([
            \App\Charts\SampleChart::class
        ]);
    }
}
