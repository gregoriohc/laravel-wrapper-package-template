<?php

namespace Vendor\Package;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class PackageServiceProvider extends LaravelServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {

        $this->handleConfigs();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        $this->app['packagename'] = $this->app->share(function($app)
        {
            return new Wrapper($app['config']);
        });

        $this->app->alias('MyFacade', 'Vendor\Package\Facades\Wrapper');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {

        return [];
    }

    private function handleConfigs() {

        $configPath = __DIR__ . '/../config/packagename.php';

        $this->publishes([$configPath => config_path('packagename.php')]);

        $this->mergeConfigFrom($configPath, 'packagename');
    }
}
