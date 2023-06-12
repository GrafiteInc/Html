<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Map;
use Grafite\Html\HtmlAssets;

class MapTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = Map::make()
            ->center(43.981739, -80.735542)
            ->marker(43.981739, -80.735542, 'This is my home')
            ->render();

        $scripts = app(HtmlAssets::class)->render();

        $this->assertStringContainsString('class="leaflet-map"', $html);
        $this->assertStringContainsString('.setView([43.981739,-80.735542]', $scripts);
        $this->assertStringContainsString('This is my home', $scripts);
    }
}
