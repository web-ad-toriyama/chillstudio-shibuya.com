<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;
use App\Models\Company;

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
    public function boot(UrlGenerator $url)
    {
        // SSL通信を強制する
        $url->forceScheme('https');

        // 共通変数の受け渡し
        view()->composer('*', function ($view) {
            // 会社情報
            $view->with('company', Company::first());
        });
    }
}
