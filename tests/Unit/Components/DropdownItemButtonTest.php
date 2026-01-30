<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class DropdownItemButtonTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $template = '<x-html-dropdown-item-button onClick="console.log()">Test</x-html-dropdown-item-button>';

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('Test', $blade);
    }
}
