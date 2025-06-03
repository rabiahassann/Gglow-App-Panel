<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * Laravel 8+ में यह डिफ़ॉल्ट तौर पर null है और
     * आप अपनी controller के फुल namespace का इस्तेमाल करते हैं।
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            // API Routes
            Route::prefix('api')
                ->middleware('api')
                // ->namespace($this->namespace) // Laravel 8+ में namespace null होने से आमतौर पर यह कमेंट रहता है
                ->group(base_path('routes/api.php'));

            // Web Routes
            Route::middleware('web')
                // ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            // API रूट्स पर 60 requests प्रति मिनट की लिमिट
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
