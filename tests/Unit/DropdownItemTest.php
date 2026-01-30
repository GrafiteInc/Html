<?php

namespace Tests\Unit;

use Grafite\Html\Tags\DropdownItem;
use Tests\TestCase;

class DropdownItemTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = DropdownItem::make()->text('Awesome')->url('https://batman.com')->render();
        $this->assertStringContainsString('<a class="dropdown-item" target="_self" href="https://batman.com">Awesome</a>', $html);
    }
}
