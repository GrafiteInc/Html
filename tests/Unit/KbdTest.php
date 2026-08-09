<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Kbd;
use Tests\TestCase;

class KbdTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Kbd::make()->text('Esc')->render();

        $this->assertStringContainsString('<kbd', $html);
        $this->assertStringContainsString('html-kbd', $html);
        $this->assertStringContainsString('Esc', $html);
    }

    public function test_default_size_is_md()
    {
        $html = Kbd::make()->text('Ctrl')->render();

        $this->assertStringContainsString('html-kbd-md', $html);
    }

    public function test_custom_size()
    {
        $html = Kbd::make()->text('Ctrl')->size('lg')->render();

        $this->assertStringContainsString('html-kbd-lg', $html);
    }

    public function test_no_external_scripts()
    {
        $this->assertEmpty(Kbd::scripts());
        $this->assertEmpty(Kbd::stylesheets());
    }

    public function test_custom_css_and_id()
    {
        $html = Kbd::make()
            ->id('my-kbd')
            ->css('my-class')
            ->text('A')
            ->render();

        $this->assertStringContainsString('id="my-kbd"', $html);
        $this->assertStringContainsString('my-class', $html);
    }
}
