<?php

namespace Tests\Unit;

use Grafite\Html\Tags\GradientBackground;
use Tests\TestCase;

class GradientBackgroundTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = GradientBackground::make()->render();

        $this->assertStringContainsString('html-gradient-background', $html);
        $this->assertStringContainsString('linear-gradient', $html);
    }

    public function test_default_direction()
    {
        $html = GradientBackground::make()->render();

        $this->assertStringContainsString('linear-gradient(135deg', $html);
    }

    public function test_custom_direction()
    {
        $html = GradientBackground::make()
            ->direction('to right')
            ->render();

        $this->assertStringContainsString('linear-gradient(to right', $html);
    }

    public function test_custom_colors()
    {
        $html = GradientBackground::make()
            ->colors(['#111111', '#222222'])
            ->render();

        $this->assertStringContainsString('#111111', $html);
        $this->assertStringContainsString('#222222', $html);
    }

    public function test_animate()
    {
        $html = GradientBackground::make()
            ->animate(true)
            ->duration('12s')
            ->render();

        $this->assertStringContainsString('html-gradient-animate', $html);
        $this->assertStringContainsString('--html-gradient-duration: 12s', $html);
    }

    public function test_not_animated_by_default()
    {
        $html = GradientBackground::make()->render();

        $this->assertStringNotContainsString('html-gradient-animate', $html);
    }

    public function test_content_rendering()
    {
        $html = GradientBackground::make()
            ->content('<p>Inside</p>')
            ->render();

        $this->assertStringContainsString('<p>Inside</p>', $html);
    }

    public function test_no_external_scripts()
    {
        $this->assertEmpty(GradientBackground::scripts());
        $this->assertEmpty(GradientBackground::stylesheets());
    }
}
