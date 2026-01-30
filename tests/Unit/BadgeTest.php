<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Badge;
use Tests\TestCase;

class BadgeTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Badge::make()
            ->name('Test Badge')
            ->color('#F00F00')
            ->status('success')
            ->theme('flat')
            ->render();

        $this->assertStringContainsString('Test Badge', $html);
    }
}
