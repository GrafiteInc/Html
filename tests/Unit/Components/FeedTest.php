<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class FeedTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-feed :items=\"[
            'today' => 'Yes man',
            'tomorrow' => 'No man',
        ]\" />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<ol class="html-component-activity-feed">', $blade);
        $this->assertStringContainsString('today', $blade);
        $this->assertStringContainsString('No man', $blade);
    }

    public function testHtmlSlotRendering()
    {
        $template = "<x-html-feed>
            <x-html-feed-item date=\"future\">Superman</x-html-feed-item>
            <x-html-feed-item date=\"yesterday\" content=\"Batman\" icon=\"<i class=\"fa fa-comment text-dark\"></i>\" />
        </x-html-feed>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('future', $blade);
        $this->assertStringContainsString('text-dark', $blade);
        $this->assertStringContainsString('Batman', $blade);
    }
}
