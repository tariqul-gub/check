<?php

namespace App\Providers;

use DB;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\ServiceProvider;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::listen(function (QueryExecuted $query) {
            // Log::warning(' My Query:  ' . $query->sql);
            // Log::warning($query->bindings);
            Log::info($query->time);
            // $query->sql;
            // $query->bindings;
            // $query->time;
        });
    }
}
