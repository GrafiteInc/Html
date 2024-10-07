<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\DropdownItem;
use Grafite\Html\Tags\DropdownButton;

class DropdownButtonTest extends TestCase
{
    public function testHtmlRendering()
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

    public function testHtmlRenderingAlignment()
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
