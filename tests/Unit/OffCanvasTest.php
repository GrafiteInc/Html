<?php

namespace Tests\Unit;

use Grafite\Html\Tags\OffCanvas;
use Tests\TestCase;

class OffCanvasTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = OffCanvas::make()
            ->text('OffCanvas Yo')
            ->css('btn btn-primary')
            ->position('bottom')
            ->render();

        $this->assertStringContainsString('$slot', $html);
        $this->assertStringContainsString('OffCanvas Yo', $html);
        $this->assertStringContainsString('btn btn-primary', $html);
        $this->assertStringContainsString('offcanvas-bottom', $html);
    }
}
