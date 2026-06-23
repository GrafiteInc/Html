<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class ConfettiTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $template = "<x-html-confetti />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('html-confetti', $blade);
    }

    public function test_html_rendering_with_slot()
    {
        $template = "<x-html-confetti><button>Celebrate</button></x-html-confetti>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('html-confetti', $blade);
        $this->assertStringContainsString('Celebrate', $blade);
    }

    public function test_html_rendering_with_trigger()
    {
        $template = "<x-html-confetti trigger='click'><button>Go</button></x-html-confetti>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('Go', $blade);
    }
}
