<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DomPdfFixServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('path.public', function () {
            return base_path('public_html');
        });
    }

    public function boot()
    {
        //
    }
}
