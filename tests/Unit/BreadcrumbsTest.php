<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Breadcrumbs;
use Tests\TestCase;

class BreadcrumbsTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Breadcrumbs::make()->items([
            'Batman' => 'https://batman.com',
            'Superman' => 'https://superman.com',
        ])->render();

        $this->assertStringContainsString('<li class="breadcrumb-item"><a href="https://batman.com">Batman</a></li>', $html);
        $this->assertStringContainsString('<nav aria-label="breadcrumb">', $html);
    }
}
