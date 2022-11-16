<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class DropdownDividerTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-dropdown-divider />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('dropdown-divider', $blade);
    }
}
