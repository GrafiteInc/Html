<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class NavLinkTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-nav-link href=\"https://example.com\" content=\"Super\" />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<a href="https://example.com" class="nav-link">Super</a>', $blade);
    }
}
