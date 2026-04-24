<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class HeroTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $template = "<x-html-hero effect='waves'>
            <h1>Welcome to our site</h1>
        </x-html-hero>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('hero-vanta', $blade);
        $this->assertStringContainsString('hero-content', $blade);
        $this->assertStringContainsString('Welcome to our site', $blade);
    }

    public function test_with_effect_birds()
    {
        $template = "<x-html-hero effect='birds'>
            <h1>Hello</h1>
        </x-html-hero>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('hero-vanta', $blade);
        $this->assertStringContainsString('Hello', $blade);
    }

    public function test_with_color_props()
    {
        $template = "<x-html-hero effect='fog' color='0xff0000' background-color='0x000000'>
            Content
        </x-html-hero>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('hero-vanta', $blade);
        $this->assertStringContainsString('Content', $blade);
    }

    public function test_with_min_height()
    {
        $template = "<x-html-hero effect='net' min-height='800px'>
            Tall hero
        </x-html-hero>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('hero-vanta', $blade);
        $this->assertStringContainsString('Tall hero', $blade);
    }

    public function test_with_content_attribute()
    {
        $template = "<x-html-hero effect='waves' content='<h1>Direct content</h1>' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('hero-vanta', $blade);
        $this->assertStringContainsString('Direct content', $blade);
    }
}
