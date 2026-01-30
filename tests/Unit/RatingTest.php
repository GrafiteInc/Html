<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Rating;
use Tests\TestCase;

class RatingTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Rating::make()
            ->value(2.5)
            ->render();

        $count = substr_count($html, 'text-primary');

        $this->assertEquals(2, $count);
    }
}
