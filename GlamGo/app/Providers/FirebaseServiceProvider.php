<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('firebase', function ($app) {
            $config = config('firebase.credentials');
            
            return (new Factory())
                ->withServiceAccount($config)
                ->withDatabaseUri($config['databaseURL'])
                ->createDatabase();
        });
    }

    public function boot()
    {
        //
    }
}
