<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Spinner;
use Tests\TestCase;

class SpinnerTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Spinner::make()
            ->css('text-danger')
            ->render();

        $this->assertStringContainsString('<div class="spinner-border text-danger" role="status">', $html);
    }
}
