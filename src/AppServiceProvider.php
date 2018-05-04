<?php

namespace LaravelEnso\ImapAuth;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Auth::provider('imap', function ($app, array $config) {
            $guard = config('auth.defaults.guard');
            $provider = config('auth.guards.'.$guard.'.provider');
            $model = config('auth.providers.'.$provider.'.model');
            $imap = config('enso.imap');

            return new ImapUserProvider(new $model(), $imap);
        });

        $this->publishes([
            __DIR__.'/config/imap.php' => config_path('enso'),
        ], 'imap-config');

        $this->mergeConfigFrom(__DIR__.'/config/imap.php', 'enso.imap');

    }

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
