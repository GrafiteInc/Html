<?php

namespace Grafite\Html;

use Grafite\Html\HtmlAssets;
use Illuminate\Support\ServiceProvider;

class HtmlProvider extends ServiceProvider
{
    /**
     * Boot method.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/html.php' => base_path('config/html.php'),
        ]);

        $this->app['blade.compiler']->directive('htmlAssets', function () {
            return "<?php echo app('" . HtmlAssets::class . "')->render(); ?>";
        });

        $this->app['blade.compiler']->directive('htmlScripts', function () {
            return "<?php echo app('" . HtmlAssets::class . "')->render('scripts'); ?>";
        });

        $this->app['blade.compiler']->directive('htmlStyles', function () {
            return "<?php echo app('" . HtmlAssets::class . "')->render('styles'); ?>";
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(HtmlAssets::class, function ($app) {
            return new HtmlAssets($app);
        });
    }
}
