<?php

namespace Tests\Unit;

use Grafite\Html\Tags\DropdownButton;
use Grafite\Html\Tags\DropdownItem;
use Tests\TestCase;

class DropdownButtonTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = DropdownButton::make()
            ->items([
                DropdownItem::make()->text('Nothing')->url('#')->render(),
            ])
            ->text('Actions')
            ->css('btn-info')
            ->render();

        $this->assertStringContainsString('<a class="dropdown-item" target="_self" href="#">Nothing</a>', $html);
        $this->assertStringContainsString('<a class="btn dropdown-toggle btn-info" href="#" role="button" ', $html);
    }

    public function test_html_rendering_alignment()
    {
        $html = DropdownButton::make()
            ->items([
                DropdownItem::make()->text('Nothing')->url('#')->render(),
            ])
            ->id('DropdownButtonAlign')
            ->text('Actions')
            ->css('btn-info')
            ->menuCss('dropdown-menu-end')
            ->render();

        $this->assertStringContainsString('<div class="dropdown-menu dropdown-menu-end" aria-labelledby="DropdownButtonAlign">', $html);
        $this->assertStringContainsString('<a class="dropdown-item" target="_self" href="#">Nothing</a>', $html);
        $this->assertStringContainsString('<a class="btn dropdown-toggle btn-info" href="#" role="button" ', $html);
    }
}
