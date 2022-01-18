<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\DropdownItemButton;
use Grafite\Html\Tags\DropdownButtonAction;

class DropdownButtonActionTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = DropdownButtonAction::make()
            ->items([
                DropdownItemButton::make()->text('Nothing')->onClick('window.location = window.locaton')->render(),
            ])
            ->text('Actions')
            ->css('btn-info')
            ->render();

        $this->assertStringContainsString('<button type="button" class="btn btn-info">Actions</button>', $html);
        $this->assertStringContainsString('<button class="dropdown-item" onclick="window.location = window.locaton">Nothing</button>', $html);
    }
}
