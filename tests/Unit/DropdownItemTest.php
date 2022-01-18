<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\DropdownItem;

class DropdownItemTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = DropdownItem::make()->text('Awesome')->url('https://batman.com')->render();
        $this->assertStringContainsString('<a class="dropdown-item" href="https://batman.com">Awesome</a>', $html);
    }
}
