<?php

namespace LaravelEnso\ImapAuth;

use Illuminate\Support\ServiceProvider;

class ImapAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->provider('imap', function ($app) {
            $guard = $app['config']['auth']['defaults']['guard'];
            $provider = $app['config']['auth']['guards'][$guard]['provider'];
            $model = $app['config']['auth']['providers'][$provider]['model'];
            $imap = $app['config']['imap'];

            return new ImapUserProvider(new $model(), $imap);
        });

        $this->publishes([
            __DIR__.'/../config/imap.php' => config_path('imap.php'),
        ], 'imap-config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }

    protected function registerAuthEvents()
    {
        $app = $this->app;

        /*
         * If the authentication service has been used, we'll check for any cookies
         * that may be queued by the service. These cookies are all queued until
         * they are attached onto Response objects at the end of the requests.
         */
        $app->after(function ($request, $response) use ($app) {
            if (isset($app['auth.loaded'])) {
                foreach ($app['auth']->getDrivers() as $driver) {
                    foreach ($driver->getQueuedCookies() as $cookie) {
                        $response->headers->setCookie($cookie);
                    }
                }
            }
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['auth'];
    }
}
