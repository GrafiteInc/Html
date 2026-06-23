<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class LightBarTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $template = "<x-html-light-bar />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('html-light-bar', $blade);
        $this->assertStringContainsString('html-light-bar-beam', $blade);
    }

    public function test_html_rendering_with_slot()
    {
        $template = "<x-html-light-bar><h1>Title</h1></x-html-light-bar>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('Title', $blade);
        $this->assertStringContainsString('html-light-bar-content', $blade);
    }

    public function test_html_rendering_with_position()
    {
        $template = "<x-html-light-bar position='bottom' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('html-light-bar-bottom', $blade);
    }

    public function test_html_rendering_with_color()
    {
        $template = "<x-html-light-bar color='#ff0000' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('#ff0000', $blade);
    }
}
