<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class FeedItemTest extends ComponentTestCase
{
    public function test_html_slot_rendering()
    {
        $template = '<x-html-feed-item date="future">Superman</x-html-feed-item>';

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<div class="feed-item">', $blade);
        $this->assertStringContainsString('<div class="feed-icon" style="background-color: var(--bs-primary);">', $blade);
        $this->assertStringContainsString('Superman', $blade);
    }
}
