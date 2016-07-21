<?php namespace AttractGroup\SocialAuther;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
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
    public function boot()
    {
        $app = $this->app;
        $app['config']->package('attractgroup/social-auther', __DIR__ . '/config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}