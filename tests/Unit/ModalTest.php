<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Modal;
use Tests\TestCase;

class ModalTest extends TestCase
{
    public function test_html_rendering()
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
