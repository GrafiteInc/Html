<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class ProgressTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-progress min=\"0\" max=\"100\" now=\"25\" />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<div class="progress-bar " role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>', $blade);
        $this->assertStringContainsString('25%', $blade);
    }
}
