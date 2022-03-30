<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Card;
use Grafite\Html\Tags\Modal;
use Grafite\Html\Tags\OffCanvas;

class OffCanvasTest extends TestCase
{
    public function testHtmlRendering()
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
