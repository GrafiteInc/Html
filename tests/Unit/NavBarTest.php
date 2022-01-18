<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\NavBar;
use Grafite\Html\Tags\NavLink;

class NavBarTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = NavBar::make()->items([
            NavLink::make()
                ->text('Nav Link Website')
                ->attributes(['disabled'])
                ->url('https://batman.com')
                ->renderWhen(function () {
                    return true;
                }),
        ])->css('navbar-expand-lg navbar-light bg-light')->brand('Superman')->render();

        $this->assertStringContainsString('navbar-expand-lg navbar-light bg-light', $html);
        $this->assertStringContainsString('<a class="navbar-brand" href="/">Superman</a>', $html);
        $this->assertStringContainsString('<span class="navbar-toggler-icon"></span>', $html);
    }
}
