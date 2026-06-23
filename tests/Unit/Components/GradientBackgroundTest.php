<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class GradientBackgroundTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $template = "<x-html-gradient-background />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('html-gradient-background', $blade);
        $this->assertStringContainsString('linear-gradient', $blade);
    }

    public function test_html_rendering_with_slot()
    {
        $template = "<x-html-gradient-background><p>Content</p></x-html-gradient-background>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('Content', $blade);
    }

    public function test_html_rendering_with_direction()
    {
        $template = "<x-html-gradient-background direction='to right' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('linear-gradient(to right', $blade);
    }

    public function test_html_rendering_with_animate()
    {
        $template = "<x-html-gradient-background :animate='true' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('html-gradient-animate', $blade);
    }
}
