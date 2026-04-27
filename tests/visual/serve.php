<?php

/**
 * Visual Test Fixture Renderer
 *
 * Renders individual Tag components as standalone HTML pages
 * for Playwright screenshot comparison tests.
 *
 * Usage: php tests/visual/serve.php <component-name>
 * Or via PHP built-in server: php -S localhost:8234 tests/visual/serve.php
 */

require_once __DIR__.'/../../vendor/autoload.php';

// Suppress deprecation warnings (PHP 8.2 ${var} syntax etc.) so they don't pollute HTML output
error_reporting(E_ALL & ~E_DEPRECATED);

use Grafite\Html\HtmlAssets;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

// Minimal container with environment() support
$app = new class extends Container {
    public function environment(...$environments) {
        $env = 'testing';
        if (count($environments) > 0) {
            return in_array($env, $environments);
        }
        return $env;
    }
};
Container::setInstance($app);
$app->instance('app', $app);

$app->singleton(HtmlAssets::class, function () {
    return new HtmlAssets;
});

// Register config repository
$app->singleton('config', function () {
    return new ConfigRepository([
        'html' => ['bootstrap-version' => '5.3'],
        'services' => ['fathom' => ['key' => 'TESTKEY']],
    ]);
});

// Register a request instance
$app->singleton('request', function () {
    return Request::create('http://localhost:8234/', 'GET');
});

if (! function_exists('now')) {
    function now() {
        return \Carbon\Carbon::now();
    }
}

// Parse request
$uri = $_SERVER['REQUEST_URI'] ?? '';
$component = trim(parse_url($uri, PHP_URL_PATH), '/');

if (empty($component)) {
    $component = $argv[1] ?? 'index';
}

// Reset HtmlAssets for each render
$app->singleton(HtmlAssets::class, function () {
    return new HtmlAssets;
});

$components = getComponentDefinitions();

if ($component === 'index') {
    $html = '<html><body><h1>Visual Test Fixtures</h1><ul>';
    foreach (array_keys($components) as $name) {
        $html .= "<li><a href=\"/{$name}\">{$name}</a></li>";
    }
    $html .= '</ul></body></html>';
    echo $html;
    exit;
}

if (! isset($components[$component])) {
    http_response_code(404);
    echo "Component not found: {$component}";
    exit;
}

$rendered = $components[$component]();

$assets = app(HtmlAssets::class);

// Collect stylesheets
$stylesheets = collect($assets->stylesheets)->unique()->implode("\n");

// Collect styles
$styles = collect($assets->styles)->unique()->implode("\n");

// Collect scripts
$scripts = collect($assets->scripts)->unique()->implode("\n");

// Collect JS
$js = collect($assets->js)->unique()->implode("\n");

$page = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visual Test: {$component}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    {$stylesheets}
    <style>
        body {
            padding: 20px;
            background: #fff;
        }
        .visual-test-container {
            max-width: 800px;
            margin: 0 auto;
        }
        {$styles}
    </style>
</head>
<body>
    <div class="visual-test-container">
        {$rendered}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {$scripts}
    <script>
        window.HtmlJS = () => { {$js} };
        window.HtmlJS();
    </script>
</body>
</html>
HTML;

echo $page;

function getComponentDefinitions(): array
{
    return [
        'accordion' => function () {
            return \Grafite\Html\Tags\Accordion::make()
                ->items([
                    'Section One' => 'This is the content for section one.',
                    'Section Two' => 'This is the content for section two.',
                    'Section Three' => 'This is the content for section three.',
                ])->render();
        },

        'admonition' => function () {
            return \Grafite\Html\Tags\Admonition::make()
                ->title('Important Notice')
                ->body('This is an important message you should read carefully.')
                ->color('warning')
                ->render();
        },

        'alert' => function () {
            return \Grafite\Html\Tags\Alert::make()
                ->text('This is an alert message.')
                ->render()
                . '<br>'
                . \Grafite\Html\Tags\Alert::make()
                    ->text('Dismissible alert.')
                    ->css('alert-danger')
                    ->render();
        },

        'announcement' => function () {
            return \Grafite\Html\Tags\Announcement::make()
                ->text('Important announcement!')
                ->timeout(999999)
                ->render();
        },

        'avatar' => function () {
            return \Grafite\Html\Tags\Avatar::make()
                ->image('https://placehold.co/200x200/336699/ffffff?text=AV')
                ->render();
        },

        'breadcrumbs' => function () {
            return \Grafite\Html\Tags\Breadcrumbs::make()
                ->items([
                    'Home' => '/',
                    'Library' => '/library',
                    'Current Page' => '#',
                ])->render();
        },

        'calendar' => function () {
            return \Grafite\Html\Tags\Calendar::make()
                ->id('visual-calendar')
                ->items([])
                ->render();
        },

        'card' => function () {
            return \Grafite\Html\Tags\Card::make()
                ->title('Card Title')
                ->header('Featured')
                ->body('This is a card with a header, title, body, and footer.')
                ->footer('Last updated 3 mins ago')
                ->render();
        },

        'carousel' => function () {
            return \Grafite\Html\Tags\Carousel::make()
                ->items(collect([
                    'https://placehold.co/800x400/3498db/ffffff?text=Slide+1',
                    'https://placehold.co/800x400/e74c3c/ffffff?text=Slide+2',
                    'https://placehold.co/800x400/2ecc71/ffffff?text=Slide+3',
                ]))->render();
        },

        'countdown' => function () {
            return \Grafite\Html\Tags\Countdown::make()
                ->id('visual-countdown')
                ->time(\Carbon\Carbon::now()->addDays(7)->addHours(3))
                ->render();
        },

        'divider' => function () {
            return '<p>Content above the divider</p>'
                . \Grafite\Html\Tags\Divider::make()
                    ->text('OR')
                    ->render()
                . '<p>Content below the divider</p>';
        },

        'dropdown-button' => function () {
            $items = [
                \Grafite\Html\Tags\DropdownItem::make()->url('#')->text('Action')->render(),
                \Grafite\Html\Tags\DropdownItem::make()->url('#')->text('Another action')->render(),
                \Grafite\Html\Tags\DropdownDivider::make()->render(),
                \Grafite\Html\Tags\DropdownItem::make()->url('#')->text('Something else')->render(),
            ];

            return \Grafite\Html\Tags\DropdownButton::make()
                ->text('Dropdown')
                ->css('btn-primary')
                ->items($items)
                ->render();
        },

        'dropdown-button-action' => function () {
            $items = [
                \Grafite\Html\Tags\DropdownItem::make()->url('#')->text('Save as...')->render(),
                \Grafite\Html\Tags\DropdownItem::make()->url('#')->text('Export')->render(),
            ];

            return \Grafite\Html\Tags\DropdownButtonAction::make()
                ->text('Save')
                ->css('btn-success')
                ->items($items)
                ->render();
        },

        'dropdown-button-group' => function () {
            $items = [
                \Grafite\Html\Tags\DropdownItem::make()->url('#')->text('Option A')->render(),
                \Grafite\Html\Tags\DropdownItem::make()->url('#')->text('Option B')->render(),
            ];

            return \Grafite\Html\Tags\DropdownButtonGroup::make()
                ->text('Options')
                ->css('btn-secondary')
                ->items($items)
                ->render();
        },

        'feed' => function () {
            $items = [
                \Grafite\Html\Tags\FeedItem::make()
                    ->date('Jan 15')
                    ->icon('&#9733;', '#007bff')
                    ->content('First event happened')
                    ->render(),
                \Grafite\Html\Tags\FeedItem::make()
                    ->date('Feb 20')
                    ->icon('&#9654;', '#28a745')
                    ->content('Second event happened')
                    ->render(),
            ];

            return \Grafite\Html\Tags\Feed::make()
                ->items($items)
                ->render();
        },

        'github-graph' => function () {
            return \Grafite\Html\Tags\GithubGraph::make()
                ->id('visual_github_graph')
                ->title('% contributions in the past year')
                ->render();
        },

        'hero' => function () {
            return \Grafite\Html\Tags\Hero::make()
                ->id('visual-hero')
                ->effect('net')
                ->content('<h1 class="text-white text-center">Welcome</h1><p class="text-white text-center">Hero with Vanta.js net effect</p>')
                ->minHeight('300px')
                ->color('0x3fffff')
                ->backgroundColor('0x23153c')
                ->render();
        },

        'image' => function () {
            return \Grafite\Html\Tags\Image::make()
                ->source('https://placehold.co/400x300/3498db/ffffff?text=Image')
                ->alt('Sample image')
                ->css('rounded')
                ->render();
        },

        'image-compare' => function () {
            return \Grafite\Html\Tags\ImageCompare::make()
                ->id('visual-img-compare')
                ->imageA('https://placehold.co/400x300/e74c3c/ffffff?text=Before')
                ->imageB('https://placehold.co/400x300/2ecc71/ffffff?text=After')
                ->width(400)
                ->height(300)
                ->render();
        },

        'lightbox' => function () {
            return \Grafite\Html\Tags\Lightbox::make()
                ->items([
                    'https://placehold.co/600x400/3498db/ffffff?text=Photo+1',
                    'https://placehold.co/600x400/e74c3c/ffffff?text=Photo+2',
                    'https://placehold.co/600x400/2ecc71/ffffff?text=Photo+3',
                ])->render();
        },

        'list-group' => function () {
            return \Grafite\Html\Tags\ListGroup::make()
                ->items([
                    'Dashboard' => '#',
                    'Settings' => '#',
                    'Profile' => '#',
                    'Logout' => '#',
                ])->render();
        },

        'map' => function () {
            return \Grafite\Html\Tags\Map::make()
                ->id('visual-map')
                ->center(40.7128, -74.0060)
                ->zoom(12)
                ->render();
        },

        'marquee' => function () {
            return \Grafite\Html\Tags\Marquee::make()
                ->content('<span class="mx-4">Breaking News</span><span class="mx-4">Welcome to our website</span><span class="mx-4">Check out the latest updates</span>')
                ->render();
        },

        'modal' => function () {
            return \Grafite\Html\Tags\Modal::make()
                ->text('Open Modal')
                ->title('Sample Modal')
                ->content('<p>This is the modal body content.</p>')
                ->footer('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>')
                ->css('btn btn-primary')
                ->render();
        },

        'nav' => function () {
            $items = [
                \Grafite\Html\Tags\NavLink::make()->url('#')->text('Home')->render(),
                \Grafite\Html\Tags\NavLink::make()->url('#')->text('About')->render(),
                \Grafite\Html\Tags\NavLink::make()->url('#')->text('Contact')->render(),
            ];

            return \Grafite\Html\Tags\Nav::make()
                ->items($items)
                ->render();
        },

        'nav-bar' => function () {
            $items = [
                \Grafite\Html\Tags\NavLink::make()->url('#')->text('Home')->render(),
                \Grafite\Html\Tags\NavLink::make()->url('#')->text('Features')->render(),
                \Grafite\Html\Tags\NavLink::make()->url('#')->text('Pricing')->render(),
            ];

            return \Grafite\Html\Tags\NavBar::make()
                ->brand('My App')
                ->css('navbar-expand-lg navbar-light bg-light')
                ->items($items)
                ->render();
        },

        'offcanvas' => function () {
            return \Grafite\Html\Tags\OffCanvas::make()
                ->text('Open Offcanvas')
                ->css('btn btn-primary')
                ->render();
        },

        'parallax' => function () {
            return \Grafite\Html\Tags\Parallax::make()
                ->id('visual-parallax')
                ->image('https://placehold.co/800x400/3498db/ffffff?text=Parallax+Image')
                ->render();
        },

        'popover' => function () {
            return \Grafite\Html\Tags\Popover::make()
                ->text('Hover me')
                ->title('Popover Title')
                ->content('This is the popover content.')
                ->css('btn btn-info')
                ->render();
        },

        'progress' => function () {
            return \Grafite\Html\Tags\Progress::make()
                ->now(65)
                ->min(0)
                ->max(100)
                ->css('bg-success')
                ->render();
        },

        'rating' => function () {
            return \Grafite\Html\Tags\Rating::make()
                ->value(3.5)
                ->max(5)
                ->render();
        },

        'spinner' => function () {
            return \Grafite\Html\Tags\Spinner::make()
                ->css('text-primary')
                ->render()
                . ' '
                . \Grafite\Html\Tags\Spinner::make()
                    ->css('text-danger')
                    ->render();
        },

        'status' => function () {
            return \Grafite\Html\Tags\Status::make()
                ->color('green')
                ->state('Active')
                ->render()
                . '&nbsp;&nbsp;'
                . \Grafite\Html\Tags\Status::make()
                    ->color('red')
                    ->state('Inactive')
                    ->render();
        },

        'table' => function () {
            return \Grafite\Html\Tags\Table::make()
                ->collection(collect([
                    (object) ['name' => 'Alice', 'email' => 'alice@example.com', 'role' => 'Admin'],
                    (object) ['name' => 'Bob', 'email' => 'bob@example.com', 'role' => 'Editor'],
                    (object) ['name' => 'Charlie', 'email' => 'charlie@example.com', 'role' => 'Viewer'],
                ]))
                ->keys(['name', 'email', 'role'])
                ->render();
        },

        'text' => function () {
            return \Grafite\Html\Tags\Text::make()
                ->id('visual-text')
                ->text('Animated Text Effect')
                ->effect('fade')
                ->render();
        },

        'tilt' => function () {
            return \Grafite\Html\Tags\Tilt::make()
                ->id('visual-tilt')
                ->content('<div class="p-5 bg-primary text-white rounded shadow">Tilt this card</div>')
                ->render();
        },

        'video' => function () {
            return \Grafite\Html\Tags\Video::make()
                ->id('visual-video')
                ->type('video')
                ->source('https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4')
                ->poster('https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg')
                ->render();
        },

        'word-switcher' => function () {
            return \Grafite\Html\Tags\WordSwitcher::make()
                ->id('visual-word-switcher')
                ->text('Hello')
                ->items(['World', 'Earth', 'Globe', 'Planet'])
                ->render();
        },
    ];
}
