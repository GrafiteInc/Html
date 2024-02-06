<?php

namespace Grafite\Html;

use Exception;
use Grafite\Html\HtmlAssets;
use Grafite\Html\Tags\Fathom;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Grafite\Html\Commands\MakeGlobalComponentCommand;

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

         $this->app['blade.compiler']->directive('fathom', function () {
            return "<?php echo app('" . Fathom::class . "')->render(); ?>";
        });

        $this->app['blade.compiler']->directive('htmlAssets', function ($nonce) {
            return "<?php echo app('" . HtmlAssets::class . "')->render('all', $nonce); ?>";
        });

        $this->app['blade.compiler']->directive('htmlScripts', function ($nonce) {
            return "<?php echo app('" . HtmlAssets::class . "')->render('scripts', $nonce); ?>";
        });

        $this->app['blade.compiler']->directive('htmlStyles', function ($nonce) {
            return "<?php echo app('" . HtmlAssets::class . "')->render('styles', $nonce); ?>";
        });

        $this->app['blade.compiler']->directive('when', function ($expression) {
            $params = explode(',', $expression);

            if (count($params) !== 2) {
                throw new Exception("Must have 2 parameters in @when.", 1);
            }

            return "<?php echo ($params[0]) ? $params[1] : ''; ?>";
        });

        $this->app['blade.compiler']->directive('title', function ($expression) {
            return "<?php echo \Illuminate\Support\Str::of($expression)->replace('_', ' ')->title(); ?>";
        });

        $this->app['blade.compiler']->directive('headline', function ($expression) {
            return "<?php echo \Illuminate\Support\Str::of($expression)->replace('_', ' ')->headline(); ?>";
        });

        $this->app['blade.compiler']->directive('limit', function ($expression) {
            return "<?php echo \Illuminate\Support\Str::of($expression)->replace('_', ' ')->limit(40); ?>";
        });

        $this->app['blade.compiler']->directive('plural', function ($expression) {
            return "<?php echo \Illuminate\Support\Str::of($expression)->replace('_', ' ')->plural(); ?>";
        });

        $this->app['blade.compiler']->directive('singular', function ($expression) {
            return "<?php echo \Illuminate\Support\Str::of($expression)->replace('_', ' ')->singular(); ?>";
        });

        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            foreach (
                [
                'animation' => Components\Animation::class,
                'accordion' => Components\Accordion::class,
                'avatar' => Components\Avatar::class,
                'alert' => Components\Alert::class,
                'announcement' => Components\Announcement::class,
                'image' => Components\Image::class,
                'breadcrumbs' => Components\Breadcrumbs::class,
                'calendar' => Components\Calendar::class,
                'card' => Components\Card::class,
                'action-dropdown' => Components\ActionDropdown::class,
                'dropdown-item' => Components\DropdownItem::class,
                'dropdown-divider' => Components\DropdownDivider::class,
                'dropdown-item-button' => Components\DropdownItemButton::class,
                'offcanvas' => Components\Offcanvas::class,
                'table' => Components\Table::class,
                'feed' => Components\Feed::class,
                'feed-item' => Components\FeedItem::class,
                'list-group' => Components\ListGroup::class,
                'list-group-item' => Components\ListGroupItem::class,
                'spinner' => Components\Spinner::class,
                'progress' => Components\Progress::class,
                'nav' => Components\Nav::class,
                'nav-link' => Components\NavLink::class,
                'nav-button' => Components\NavButton::class,
                'nav-dropdown' => Components\NavDropdown::class,
                'carousel' => Components\Carousel::class,
                'modal' => Components\Modal::class,
                'tag' => Components\Tag::class,
                'tilt' => Components\Tilt::class,
                'rating' => Components\Rating::class,
                'text' => Components\Text::class,
                'countdown' => Components\Countdown::class,
                'video' => Components\Video::class,
                'image-compare' => Components\ImageCompare::class,
                'parallax' => Components\Parallax::class,
                'lightbox' => Components\Lightbox::class,
                ] as $alias => $component
            ) {
                $blade->component($component, $alias, 'html');
            }
        });

        $this->commands([
            MakeGlobalComponentCommand::class,
        ]);
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
