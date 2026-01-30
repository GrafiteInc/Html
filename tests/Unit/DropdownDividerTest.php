<?php

namespace Tests\Unit;

use Grafite\Html\Tags\DropdownDivider;
use Tests\TestCase;

class DropdownDividerTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = DropdownDivider::make()->render();
        $this->assertStringContainsString('<div class="dropdown-divider"></div>', $html);
    }
}
