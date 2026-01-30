<?php

namespace Tests\Unit;

use Grafite\Html\Tags\NavButton;
use Tests\TestCase;

class NavButtonTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = NavButton::make()
            ->text('Nav Button')
            ->onClick('window.location = window.location')
            ->render();

        $this->assertStringContainsString('window.location', $html);
        $this->assertStringContainsString('Nav Button', $html);
    }
}
