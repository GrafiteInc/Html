<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Image;

class ImageTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = Image::make()->source('https://example.com/picture.jpg')->thumbnail()->render();
        $this->assertStringContainsString('<img class="img-thumbnail" src="https://example.com/picture.jpg" alt="" />', $html);

        $html = Image::make()->source('https://example.com/picture.jpg')->fluid()->render();
        $this->assertStringContainsString('<img class="img-fluid" src="https://example.com/picture.jpg" alt="" />', $html);

        $html = Image::make()->source('https://example.com/picture.jpg')->css('rounded')->fluid()->render();
        $this->assertStringContainsString('<img class="rounded img-fluid" src="https://example.com/picture.jpg" alt="" />', $html);

        $html = Image::make()->source('https://example.com/picture.jpg')->css('rounded')->placeholder()->render();
        $this->assertStringContainsString('<div class="html-placeholder"><img class="rounded" src="https://example.com/picture.jpg" alt="" /></div>', $html);
    }
}
