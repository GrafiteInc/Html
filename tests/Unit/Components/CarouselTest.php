<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class CarouselTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-carousel :items=\"collect([
            'https://i.picsum.photos/id/464/200/300.jpg?hmac=M4MNTPYELJRy0vZcT-h-EWmXkPdnXHvF9ufEPkhDt2g',
            'https://i.picsum.photos/id/476/200/300.jpg?hmac=M4MNTPYELJRy0vZcT-h-EWmXkPdnXHvF9ufEPkhDt2g',
            'https://i.picsum.photos/id/874/200/300.jpg?hmac=M4MNTPYELJRy0vZcT-h-EWmXkPdnXHvF9ufEPkhDt2g',
        ])\" />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('class="carousel slide" data-ride="carousel" data-bs-ride="carousel">', $blade);
        $this->assertStringContainsString('<div class="carousel-item"><img src="https://i.picsum.photos/id/464/200/300.jpg?hmac=M4MNTPYELJRy0vZcT-h-EWmXkPdnXHvF9ufEPkhDt2g" class="d-block w-100"></div>', $blade);
        $this->assertStringContainsString('<button class="carousel-control-prev" type="button"', $blade);
        $this->assertStringContainsString('<button class="carousel-control-next" type="button"', $blade);
    }
}
