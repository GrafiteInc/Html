<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\NavLink;

class NavLinkTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = NavLink::make()
            ->text('Nav Link Website')
            ->attributes(['disabled'])
            ->url('https://batman.com')
            ->renderWhen(function () {
                return true;
            });

        $this->assertStringContainsString('disabled', $html);
        $this->assertStringContainsString('Nav Link Website', $html);
        $this->assertStringContainsString('batman', $html);

        $html = NavLink::make()
            ->text('Nav Link Website')
            ->attributes(['disabled'])
            ->url('https://batman.com')
            ->renderWhen(function () {
                return false;
            });

        $this->assertStringContainsString('', $html);
    }
}
