<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class MarqueeTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $template = "<x-html-marquee content='<span>Test Item</span>' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('html-marquee-container', $blade);
        $this->assertStringContainsString('html-marquee', $blade);
        $this->assertStringContainsString('Test Item', $blade);
    }

    public function test_html_rendering_with_slot()
    {
        $template = "<x-html-marquee><span>Slot Content</span></x-html-marquee>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('html-marquee-container', $blade);
        $this->assertStringContainsString('html-marquee', $blade);
        $this->assertStringContainsString('Slot Content', $blade);
    }

    public function test_html_rendering_with_reverse()
    {
        $template = "<x-html-marquee content='<span>Test</span>' reverse='true' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('html-reverse', $blade);
    }

    public function test_html_rendering_with_vertical()
    {
        $template = "<x-html-marquee content='<span>Test</span>' vertical='true' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('html-vertical', $blade);
    }

    public function test_html_rendering_with_pause_on_hover()
    {
        $template = "<x-html-marquee content='<span>Test</span>' pauseOnHover='true' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('html-pause-on-hover', $blade);
    }

    public function test_html_rendering_with_custom_duration()
    {
        $template = "<x-html-marquee content='<span>Test</span>' duration='30s' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('animation-duration: 30s', $blade);
    }
}
