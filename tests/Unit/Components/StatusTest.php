<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class StatusTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $template = "<x-html-status color='green' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('badge', $blade);
        $this->assertStringContainsString('bmx-bg-green', $blade);
        $this->assertStringContainsString('rounded-circle', $blade);
    }

    public function test_custom_color()
    {
        $template = "<x-html-status color='red' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('bmx-bg-red', $blade);
        $this->assertStringContainsString('bmx-outline-red', $blade);
    }

    public function test_thickness()
    {
        $template = "<x-html-status color='blue' thickness='4' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('bmx-outline-4', $blade);
    }

    public function test_style()
    {
        $template = "<x-html-status color='green' style='dashed' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('bmx-outline-dashed', $blade);
    }

    public function test_offset()
    {
        $template = "<x-html-status color='green' offset='4' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('bmx-outline-offset-4', $blade);
    }

    public function test_default_values()
    {
        $template = "<x-html-status />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('bmx-bg-green', $blade);
        $this->assertStringContainsString('bmx-outline-2', $blade);
        $this->assertStringContainsString('bmx-outline-solid', $blade);
    }
}
