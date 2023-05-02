<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class NavButtonTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-nav-button onClick=\"window.location = window.location\" content=\"Super\" />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<button onclick="window.location = window.location" class="nav-link ">Super</button>', $blade);
    }
}
