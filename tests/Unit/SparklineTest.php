<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Sparkline;
use Tests\TestCase;

class SparklineTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Sparkline::make()->data([3, 7, 4, 9, 6, 11, 8])->render();

        $this->assertStringContainsString('<svg', $html);
        $this->assertStringContainsString('role="img"', $html);
        $this->assertStringContainsString('html-sparkline-line', $html);
    }

    public function test_line_point_count_matches_data_count()
    {
        $data = [1, 5, 3, 8, 2];

        $html = Sparkline::make()->data($data)->render();

        preg_match('/points="([^"]+)"/', $html, $matches);

        $this->assertNotEmpty($matches);
        $this->assertCount(count($data), explode(' ', trim($matches[1])));
    }

    public function test_bar_type_renders_one_rect_per_data_point()
    {
        $data = [1, 5, 3, 8];

        $html = Sparkline::make()->data($data)->type('bar')->render();

        $this->assertSame(count($data), substr_count($html, '<rect'));
    }

    public function test_show_dot_renders_circle()
    {
        $html = Sparkline::make()->data([1, 2, 3])->showDot(true)->render();

        $this->assertStringContainsString('html-sparkline-dot', $html);
        $this->assertStringContainsString('<circle', $html);
    }

    public function test_area_renders_polygon()
    {
        $html = Sparkline::make()->data([1, 2, 3])->area(true)->render();

        $this->assertStringContainsString('html-sparkline-area', $html);
        $this->assertStringContainsString('<polygon', $html);
    }

    public function test_default_color_is_primary()
    {
        $html = Sparkline::make()->data([1, 2, 3])->render();

        $this->assertStringContainsString('text-primary', $html);
    }

    public function test_no_external_scripts()
    {
        $this->assertEmpty(Sparkline::scripts());
        $this->assertEmpty(Sparkline::stylesheets());
    }
}
