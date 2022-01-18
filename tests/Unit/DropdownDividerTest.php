<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\DropdownDivider;

class DropdownDividerTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = DropdownDivider::make()->render();
        $this->assertStringContainsString('<div class="dropdown-divider"></div>', $html);
    }
}
