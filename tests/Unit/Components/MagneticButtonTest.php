<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class MagneticButtonTest extends ComponentTestCase
{
    public function test_html_rendering_as_button()
    {
        $template = "<x-html-magnetic-button>Click me</x-html-magnetic-button>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('html-magnetic-button', $blade);
        $this->assertStringContainsString('<button', $blade);
        $this->assertStringContainsString('Click me', $blade);
    }

    public function test_html_rendering_as_link()
    {
        $template = "<x-html-magnetic-button url='https://example.com'>Go</x-html-magnetic-button>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<a', $blade);
        $this->assertStringContainsString('href="https://example.com"', $blade);
    }

    public function test_html_rendering_with_content_attribute()
    {
        $template = "<x-html-magnetic-button content='Press' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('Press', $blade);
    }
}
