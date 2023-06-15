<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Rating;

class RatingTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = Rating::make()
            ->value(2.5)
            ->render();

        $count = substr_count($html, 'text-primary');

        $this->assertEquals(2, $count);
    }
}
