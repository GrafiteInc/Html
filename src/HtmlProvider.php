<?php

namespace Grafite\Html;

use Grafite\Html\HtmlAssets;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

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

        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            foreach ([
                'alert' => Components\Alert::class,
                // 'avatar' => Components\Avatar::class,
                // 'breadcrumbs' => Components\Breadcrumbs::class,
                // 'card' => Components\Card::class,
                // 'dropdown-button' => Components\DropdownButton::class,
                'table' => Components\Table::class,
            ] as $alias => $component) {
                $blade->component($component, $alias, 'html');
            }
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
