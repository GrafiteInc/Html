<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class SpinnerTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-spinner />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<div class="spinner-border " role="status">', $blade);
        $this->assertStringContainsString('<span class="sr-only">Loading...</span>', $blade);
    }
}
