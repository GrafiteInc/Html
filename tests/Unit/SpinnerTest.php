<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Spinner;

class SpinnerTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = Spinner::make()
            ->css('text-danger')
            ->render();

        $this->assertStringContainsString('<div class="spinner-border text-danger" role="status">', $html);
    }
}
