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

        $this->assertStringContainsString('<a class="dropdown-item" href="#">Nothing</a>', $html);
        $this->assertStringContainsString('<a class="btn dropdown-toggle btn-info" href="#" role="button" ', $html);
    }
}
