<?php

namespace Tests\Unit;

use Grafite\Html\Tags\MagneticButton;
use Tests\TestCase;

class MagneticButtonTest extends TestCase
{
    public function test_html_rendering_as_button()
    {
        $html = MagneticButton::make()
            ->content('Click me')
            ->render();

        $this->assertStringContainsString('<button', $html);
        $this->assertStringContainsString('html-magnetic-button', $html);
        $this->assertStringContainsString('Click me', $html);
    }

    public function test_html_rendering_as_link_when_url_set()
    {
        $html = MagneticButton::make()
            ->content('Go')
            ->url('https://example.com')
            ->render();

        $this->assertStringContainsString('<a', $html);
        $this->assertStringContainsString('href="https://example.com"', $html);
    }

    public function test_default_strength_in_js()
    {
        MagneticButton::make()->render();

        $js = MagneticButton::js();

        $this->assertStringContainsString('const strength = 0.3', $js);
    }

    public function test_custom_strength()
    {
        MagneticButton::make()
            ->strength(0.6)
            ->render();

        $js = MagneticButton::js();

        $this->assertStringContainsString('const strength = 0.6', $js);
    }

    public function test_custom_radius()
    {
        MagneticButton::make()
            ->radius(120)
            ->render();

        $js = MagneticButton::js();

        $this->assertStringContainsString('const radius = 120', $js);
    }

    public function test_js_targets_element_id()
    {
        $html = MagneticButton::make()
            ->id('magnet')
            ->render();

        $this->assertStringContainsString('id="magnet"', $html);

        $js = MagneticButton::js();

        $this->assertStringContainsString("getElementById('magnet')", $js);
    }

    public function test_no_external_scripts()
    {
        $this->assertEmpty(MagneticButton::scripts());
        $this->assertEmpty(MagneticButton::stylesheets());
    }
}
