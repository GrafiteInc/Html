<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Confetti;
use Tests\TestCase;

class ConfettiTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Confetti::make()->render();

        $this->assertStringContainsString('html-confetti', $html);
        $this->assertStringContainsString('<div', $html);
    }

    public function test_default_trigger_is_load()
    {
        Confetti::make()->render();

        $js = Confetti::js();

        $this->assertStringContainsString('"trigger":"load"', $js);
    }

    public function test_click_trigger()
    {
        Confetti::make()
            ->trigger('click')
            ->render();

        $js = Confetti::js();

        $this->assertStringContainsString('"trigger":"click"', $js);
        $this->assertStringContainsString("addEventListener('click', fire)", $js);
    }

    public function test_custom_particle_count_and_spread()
    {
        Confetti::make()
            ->particleCount(300)
            ->spread(120)
            ->render();

        $js = Confetti::js();

        $this->assertStringContainsString('"particleCount":300', $js);
        $this->assertStringContainsString('"spread":120', $js);
    }

    public function test_custom_colors()
    {
        Confetti::make()
            ->colors(['#aaa', '#bbb'])
            ->render();

        $js = Confetti::js();

        $this->assertStringContainsString('#aaa', $js);
        $this->assertStringContainsString('#bbb', $js);
    }

    public function test_custom_duration()
    {
        Confetti::make()
            ->duration(5000)
            ->render();

        $js = Confetti::js();

        $this->assertStringContainsString('"duration":5000', $js);
    }

    public function test_no_external_scripts()
    {
        $this->assertEmpty(Confetti::scripts());
        $this->assertEmpty(Confetti::stylesheets());
    }

    public function test_custom_css_and_id()
    {
        $html = Confetti::make()
            ->id('my-confetti')
            ->css('my-class')
            ->render();

        $this->assertStringContainsString('id="my-confetti"', $html);
        $this->assertStringContainsString('my-class', $html);
    }
}
