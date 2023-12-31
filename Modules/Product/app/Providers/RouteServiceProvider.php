<?php

namespace Modules\Product\app\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     */
    protected $moduleNamespace = 'Modules\Product\app\Http\Controllers';

    /**
     * Called before routes are registered.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes(): void
    {
        // Central domains route (web)
        $central_domains = config('tenancy.central_domains');
        $web_route = module_path('Product', '/routes/web.php');

        // Tenant route (web)
        if ($central_domains and file_exists($tenant_web_route = module_path('Product', '/routes/web.tenant.php'))) {
            Route::middleware('web')->namespace($this->moduleNamespace)->group($tenant_web_route);

            foreach ($central_domains as $domain) {
                Route::middleware('web')->domain($domain)->namespace($this->moduleNamespace)->group($web_route);
            }
        } else {
            Route::middleware('web')->namespace($this->moduleNamespace)->group($web_route);
        }
    }

    /**
     * Define the "api" routes for the application.
     */
    protected function mapApiRoutes(): void
    {
        // Central domains route (api)
        $central_domains = config('tenancy.central_domains');
        $api_route = module_path('Product', '/routes/api.php');

        // Tenant route (api)
        if ($central_domains and file_exists($tenant_api_route = module_path('Product', '/routes/api.tenant.php'))) {
            Route::prefix('api')->middleware('api')->namespace($this->moduleNamespace)->group($tenant_api_route);

            foreach ($central_domains as $domain) {
                Route::prefix('api')->middleware('api')->domain($domain)->namespace($this->moduleNamespace)->group($api_route);
            }
        } else {
            Route::prefix('api')->middleware('api')->namespace($this->moduleNamespace)->group($api_route);
        }
    }
}
