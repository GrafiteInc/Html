<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\NavButton;

class NavButtonTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = NavButton::make()
            ->text('Nav Button')
            ->onClick('window.location = window.location')
            ->render();

        $this->assertStringContainsString('window.location', $html);
        $this->assertStringContainsString('Nav Button', $html);
    }
}
