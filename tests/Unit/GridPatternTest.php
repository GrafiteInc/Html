<?php

namespace Tests\Unit;

use Grafite\Html\Tags\GridPattern;
use Tests\TestCase;

class GridPatternTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = GridPattern::make()->render();

        $this->assertStringContainsString('html-grid-pattern', $html);
        $this->assertStringContainsString('background-image', $html);
    }

    public function test_default_variant_is_lines()
    {
        $html = GridPattern::make()->render();

        $this->assertStringContainsString('linear-gradient', $html);
    }

    public function test_dots_variant()
    {
        $html = GridPattern::make()
            ->variant('dots')
            ->render();

        $this->assertStringContainsString('radial-gradient', $html);
    }

    public function test_custom_size()
    {
        $html = GridPattern::make()
            ->size(60)
            ->render();

        $this->assertStringContainsString('background-size: 60px 60px', $html);
    }

    public function test_custom_color_and_stroke()
    {
        $html = GridPattern::make()
            ->color('#cccccc')
            ->strokeWidth(2)
            ->render();

        $this->assertStringContainsString('#cccccc', $html);
        $this->assertStringContainsString('2px', $html);
    }

    public function test_content_rendering()
    {
        $html = GridPattern::make()
            ->content('<span>On grid</span>')
            ->render();

        $this->assertStringContainsString('<span>On grid</span>', $html);
        $this->assertStringContainsString('html-grid-pattern-content', $html);
    }

    public function test_no_external_scripts()
    {
        $this->assertEmpty(GridPattern::scripts());
        $this->assertEmpty(GridPattern::stylesheets());
        $this->assertEmpty(GridPattern::js());
    }
}
