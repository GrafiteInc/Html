<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class OffcanvasTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-offcanvas id=\"Superman_Panel\">Hello World</x-html-offcanvas>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('offcanvas-header', $blade);
        $this->assertStringContainsString('h5 id="offcanvasLabel_Superman_Panel"', $blade);
        $this->assertStringContainsString('data-bs-toggle="offcanvas"', $blade);
    }
}
