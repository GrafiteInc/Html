<?php

namespace Tests\Unit;

use Grafite\Html\Tags\DropdownItemButton;
use Tests\TestCase;

class DropdownItemButtonTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = DropdownItemButton::make()->text('Awesome')->onClick("window.location = 'hello.com'")->render();
        $this->assertStringContainsString('<button class="dropdown-item" onclick="window.location = \'hello.com\'">Awesome</button>', $html);
    }
}
