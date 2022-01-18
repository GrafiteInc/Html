<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Card;
use Grafite\Html\Tags\Breadcrumbs;

class BreadcrumbsTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = Breadcrumbs::make()->items([
            'Batman' => 'https://batman.com',
            'Superman' => 'https://superman.com',
        ])->render();

        $this->assertStringContainsString('<li class="breadcrumb-item"><a href="https://batman.com">Batman</a></li>', $html);
        $this->assertStringContainsString('<nav aria-label="breadcrumb">', $html);
    }
}
