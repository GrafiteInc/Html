<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class DropdownItemButtonTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-dropdown-item-button onClick=\"console.log()\">Test</x-html-dropdown-item-button>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('Test', $blade);
    }
}
