<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class ModalTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-modal
            id=\"SupermanModal\"
            title=\"Modal Test\"
            :dismiss=\"true\"
            :static=\"true\"
        >
            Hello World
        </x-html-modal>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>', $blade);
        $this->assertStringContainsString('Modal Test', $blade);
        $this->assertStringContainsString('SupermanModal', $blade);
        $this->assertStringContainsString('Hello World', $blade);
        $this->assertStringContainsString('data-bs-backdrop="static"', $blade);
    }
}
