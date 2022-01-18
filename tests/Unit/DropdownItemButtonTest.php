<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\DropdownItemButton;

class DropdownItemButtonTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = DropdownItemButton::make()->text('Awesome')->onClick("window.location = 'hello.com'")->render();
        $this->assertStringContainsString('<button class="dropdown-item" onclick="window.location = \'hello.com\'">Awesome</button>', $html);
    }
}
