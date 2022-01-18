<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Card;
use Grafite\Html\Tags\Modal;

class ModalTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = Modal::make()
            ->text('Modal Yo')
            ->css('btn btn-primary')
            ->title('Whoa!')
            ->content('Are you sure you want to do this thing?')
            ->dismiss()
            ->isStatic()
            ->render();

        $this->assertStringContainsString('Are you sure you want to do this thing?', $html);
        $this->assertStringContainsString('Whoa!', $html);
        $this->assertStringContainsString('btn btn-primary', $html);
        $this->assertStringContainsString('data-bs-backdrop="static"', $html);
    }
}
