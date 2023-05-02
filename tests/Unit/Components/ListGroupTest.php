<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class ListGroupTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-list-group :items=\"[
            'Title' => 'https://example.com',
            'Coolio' => 'https://coolio.com',
        ]\" />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<div class="list-group">', $blade);
        $this->assertStringContainsString('<a href="https://example.com" class="list-group-item list-group-item-action">Title</a>', $blade);
    }

    public function testHtmlSlotRendering()
    {
        $template = "<x-html-list-group>
            <x-html-list-group-item href=\"https://example.com\">Title</x-html-list-group-item>
            <x-html-list-group-item href=\"https://batman.com\" content=\"Batman\" />
        </x-html-list-group>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<div class="list-group">', $blade);
        $this->assertStringContainsString('<a href="https://example.com" class="list-group-item list-group-item-action">Title</a>', $blade);
        $this->assertStringContainsString('<a href="https://batman.com" class="list-group-item list-group-item-action">Batman</a>', $blade);
    }
}
