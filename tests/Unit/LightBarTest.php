<?php

namespace Tests\Unit;

use Grafite\Html\Tags\LightBar;
use Tests\TestCase;

class LightBarTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = LightBar::make()->render();

        $this->assertStringContainsString('html-light-bar', $html);
        $this->assertStringContainsString('html-light-bar-beam', $html);
    }

    public function test_default_position_is_top()
    {
        $html = LightBar::make()->render();

        $this->assertStringContainsString('html-light-bar-top', $html);
    }

    public function test_bottom_position()
    {
        $html = LightBar::make()
            ->position('bottom')
            ->render();

        $this->assertStringContainsString('html-light-bar-bottom', $html);
    }

    public function test_custom_color()
    {
        $html = LightBar::make()
            ->color('#ff0000')
            ->render();

        $this->assertStringContainsString('#ff0000', $html);
    }

    public function test_custom_height_and_blur()
    {
        $html = LightBar::make()
            ->height('8px')
            ->blur('100px')
            ->render();

        $this->assertStringContainsString('height: 8px', $html);
        $this->assertStringContainsString('blur(100px)', $html);
    }

    public function test_content_rendering()
    {
        $html = LightBar::make()
            ->content('<h1>Heading</h1>')
            ->render();

        $this->assertStringContainsString('<h1>Heading</h1>', $html);
        $this->assertStringContainsString('html-light-bar-content', $html);
    }

    public function test_no_external_scripts()
    {
        $this->assertEmpty(LightBar::scripts());
        $this->assertEmpty(LightBar::stylesheets());
        $this->assertEmpty(LightBar::js());
    }
}
