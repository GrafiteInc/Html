<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class GridPatternTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $template = "<x-html-grid-pattern />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('html-grid-pattern', $blade);
        $this->assertStringContainsString('background-image', $blade);
    }

    public function test_html_rendering_with_slot()
    {
        $template = "<x-html-grid-pattern><span>On grid</span></x-html-grid-pattern>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('On grid', $blade);
        $this->assertStringContainsString('html-grid-pattern-content', $blade);
    }

    public function test_html_rendering_with_dots_variant()
    {
        $template = "<x-html-grid-pattern variant='dots' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('radial-gradient', $blade);
    }

    public function test_html_rendering_with_custom_size()
    {
        $template = "<x-html-grid-pattern :size='60' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('background-size: 60px 60px', $blade);
    }
}
