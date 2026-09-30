<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

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
        $path = database_path('categories.json');
        if (!File::exists($path)) {
            $pathAlt = database_path('category.json');
            if (File::exists($pathAlt)) {
                $path = $pathAlt;
            }
        }
        $categories = File::exists($path) ? json_decode(File::get($path), true) : [];
        View::share('categories', $categories);
    }
}
