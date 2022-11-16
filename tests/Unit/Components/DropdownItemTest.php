<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class DropdownItemTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-dropdown-item url=\"somewhere.com\">Linky</x-html-dropdown-item>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('Linky', $blade);
        $this->assertStringContainsString('somewhere.com', $blade);
    }
}
