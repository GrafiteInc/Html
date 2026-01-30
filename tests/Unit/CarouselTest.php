<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Carousel;
use Tests\TestCase;

class CarouselTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Carousel::make()->items(collect([
            '/location-of-image.jpg',
            '/another-picture.jpg',
        ]))->render();

        $this->assertStringContainsString('class="carousel slide" data-ride="carousel" data-bs-ride="carousel"', $html);
        $this->assertStringContainsString('<div class="carousel-item"><img src="/location-of-image.jpg" class="d-block w-100"></div>', $html);
        $this->assertStringContainsString('<span class="carousel-control-prev-icon" aria-hidden="true"></span>', $html);
    }
}
