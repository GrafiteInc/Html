<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Badge;

class BadgeTest extends TestCase
{
    public function testHtmlRendering()
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
