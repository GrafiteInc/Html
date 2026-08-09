<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Gauge;
use Tests\TestCase;

class GaugeTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Gauge::make()->value(50)->render();

        $this->assertStringContainsString('<svg', $html);
        $this->assertStringContainsString('role="meter"', $html);
        $this->assertStringContainsString('aria-valuenow="50"', $html);
        $this->assertStringContainsString('aria-valuemin="0"', $html);
        $this->assertStringContainsString('aria-valuemax="100"', $html);
    }

    public function test_stroke_dashoffset_for_known_value()
    {
        $html = Gauge::make()->value(50)->min(0)->max(100)->render();

        // size=140 (md), thickness default 10 -> radius = 65, circumference = 2*pi*65
        $radius = (140 - 10) / 2;
        $circumference = 2 * M_PI * $radius;
        $offset = $circumference * 0.5;

        $this->assertStringContainsString('stroke-dashoffset="'.$offset.'"', $html);
    }

    public function test_default_color_is_primary()
    {
        $html = Gauge::make()->value(10)->render();

        $this->assertStringContainsString('text-primary', $html);
    }

    public function test_threshold_resolves_highest_matching_color()
    {
        $html = Gauge::make()
            ->value(95)
            ->thresholds([
                ['from' => 60, 'color' => 'warning'],
                ['from' => 90, 'color' => 'danger'],
            ])
            ->render();

        $this->assertStringContainsString('text-danger', $html);
        $this->assertStringNotContainsString('text-warning', $html);
    }

    public function test_threshold_below_first_boundary_uses_base_color()
    {
        $html = Gauge::make()
            ->value(30)
            ->color('primary')
            ->thresholds([
                ['from' => 60, 'color' => 'warning'],
                ['from' => 90, 'color' => 'danger'],
            ])
            ->render();

        $this->assertStringContainsString('text-primary', $html);
    }

    public function test_no_external_scripts()
    {
        $this->assertEmpty(Gauge::scripts());
        $this->assertEmpty(Gauge::stylesheets());
    }
}
