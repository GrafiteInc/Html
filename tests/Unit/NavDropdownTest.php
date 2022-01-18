<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\NavDropdown;
use Grafite\Html\Tags\DropdownItem;

class NavDropdownTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = NavDropdown::make()
            ->items([
                DropdownItem::make()->text('batman')->url('batman.com')->render(),
                DropdownItem::make()->text('superman')->url('superman.com')->render(),
            ])
            ->text('Nav Dropdown')
            ->render();

        $this->assertStringContainsString('<a class="nav-link dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Nav Dropdown</a>', $html);
        $this->assertStringContainsString('<li class="nav-item dropdown">', $html);
    }
}
