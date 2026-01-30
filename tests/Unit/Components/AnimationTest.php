<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class AnimationTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $template = "<x-html-animation component='hamster' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<div aria-label="Orange and tan hamster running in a metal wheel" role="img" class="wheel-and-hamster">', $blade);
        $this->assertStringContainsString('hamster__body', $blade);
    }
}
