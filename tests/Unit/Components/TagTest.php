<?php

namespace Tests\Unit\Components;

use Grafite\Html\HtmlAssets;
use Tests\ComponentTestCase;

class TagTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-tag component='\Tests\Unit\TestHtmlComponent' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('So this is a template more or less.', $blade);
        $this->assertEquals(1, count(app(HtmlAssets::class)->js));
        $this->assertEquals(1, count(app(HtmlAssets::class)->styles));
        $this->assertStringContainsString('.html-component-overlay', app(HtmlAssets::class)->styles[0]);
        $this->assertStringContainsString('console.log(', app(HtmlAssets::class)->js[0]);
    }
}
