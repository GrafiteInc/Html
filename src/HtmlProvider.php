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
                'avatar' => Components\Avatar::class,
                'alert' => Components\Alert::class,
                'breadcrumbs' => Components\Breadcrumbs::class,
                'action-dropdown' => Components\ActionDropdown::class,
                'dropdown-item' => Components\DropdownItem::class,
                'dropdown-divider' => Components\DropdownDivider::class,
                'dropdown-item-button' => Components\DropdownItemButton::class,
                'offcanvas' => Components\Offcanvas::class,
                'table' => Components\Table::class,
                'tag' => Components\Tag::class,
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
