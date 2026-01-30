<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class NavLinkTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $template = '<x-html-nav-link href="https://example.com" content="Super" />';

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<a href="https://example.com" class="nav-link">Super</a>', $blade);
    }
}
