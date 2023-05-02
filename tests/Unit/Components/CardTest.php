<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class CardTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-card imageSrc='https://i.picsum.photos/id/464/200/300.jpg?hmac=M4MNTPYELJRy0vZcT-h-EWmXkPdnXHvF9ufEPkhDt2g'>
        Hello World
        </x-html-card>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<div class="card shadow-sm">', $blade);
        $this->assertStringContainsString('Hello World', $blade);
    }
}
