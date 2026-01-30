<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class NavTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $template = "<x-html-nav type=\"pills\" :items=\"['https://cool.com' => 'Cool', 'https://example.com' => 'Example']\" />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<ul class="nav nav-pills">', $blade);
        $this->assertStringContainsString('<a href="https://example.com" class="nav-link">Example</a>', $blade);
    }

    public function test_html_slot_rendering()
    {
        $template = '<x-html-nav type="pills">
            <x-html-nav-link href="https://example.com">Cool</x-html-nav-link>
        </x-html-nav>';

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<ul class="nav nav-pills">', $blade);
        $this->assertStringContainsString('<a href="https://example.com" class="nav-link">Cool</a>', $blade);
    }
}
