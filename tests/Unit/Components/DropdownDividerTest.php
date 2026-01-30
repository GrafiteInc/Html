<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class DropdownDividerTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $template = '<x-html-dropdown-divider />';

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('dropdown-divider', $blade);
    }
}
