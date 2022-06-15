<?php

namespace App\Providers;
use App\Models\infoSite;
use App\Models\LanguageSwitch;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       if(Schema::hasTable('info_sites')){
         $info = infoSite::first();
         if($info) {
           View::share('info', $info);
         }
       }
      Paginator::useBootstrap();
        if(Schema::hasTable('language_switches')) {
          $languages = LanguageSwitch::get();
          view()->share('languages', $languages);
        }
    }
}
