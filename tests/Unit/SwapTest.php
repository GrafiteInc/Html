<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Swap;
use Tests\TestCase;

class SwapTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Swap::make()
            ->on('<i class="bi bi-sun"></i>')
            ->off('<i class="bi bi-moon"></i>')
            ->render();

        $this->assertStringContainsString('role="switch"', $html);
        $this->assertStringContainsString('bi-sun', $html);
        $this->assertStringContainsString('bi-moon', $html);
    }

    public function test_default_inactive_state()
    {
        $html = Swap::make()->on('A')->off('B')->render();

        $this->assertStringContainsString('aria-checked="false"', $html);
        $this->assertStringNotContainsString('html-swap-active', $html);
    }

    public function test_active_state()
    {
        $html = Swap::make()->on('A')->off('B')->active(true)->render();

        $this->assertStringContainsString('aria-checked="true"', $html);
        $this->assertStringContainsString('html-swap-active', $html);
    }

    public function test_rotate_and_flip_modifiers()
    {
        $html = Swap::make()->on('A')->off('B')->rotate(true)->flip(true)->render();

        $this->assertStringContainsString('html-swap-rotate', $html);
        $this->assertStringContainsString('html-swap-flip', $html);
    }

    public function test_js_targets_element_id()
    {
        $html = Swap::make()->id('theme-swap')->on('A')->off('B')->render();

        $this->assertStringContainsString('id="theme-swap"', $html);

        $js = Swap::js();

        $this->assertStringContainsString("getElementById('theme-swap')", $js);
    }

    public function test_no_external_scripts()
    {
        $this->assertEmpty(Swap::scripts());
        $this->assertEmpty(Swap::stylesheets());
    }
}
