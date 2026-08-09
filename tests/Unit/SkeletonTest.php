<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Skeleton;
use Tests\TestCase;

class SkeletonTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Skeleton::make()->render();

        $this->assertStringContainsString('html-skeleton', $html);
        $this->assertStringContainsString('aria-hidden="true"', $html);
    }

    public function test_default_animation_is_glow()
    {
        $html = Skeleton::make()->render();

        $this->assertStringContainsString('html-skeleton-glow', $html);
    }

    public function test_wave_animation()
    {
        $html = Skeleton::make()->animation('wave')->render();

        $this->assertStringContainsString('html-skeleton-wave', $html);
        $this->assertStringNotContainsString('html-skeleton-glow', $html);
    }

    public function test_custom_dimensions_and_rounded()
    {
        $html = Skeleton::make()
            ->width('3rem')
            ->height('3rem')
            ->rounded('circle')
            ->render();

        $this->assertStringContainsString('width: 3rem', $html);
        $this->assertStringContainsString('height: 3rem', $html);
        $this->assertStringContainsString('html-skeleton-rounded-circle', $html);
    }

    public function test_no_external_scripts()
    {
        $this->assertEmpty(Skeleton::scripts());
        $this->assertEmpty(Skeleton::stylesheets());
    }
}
