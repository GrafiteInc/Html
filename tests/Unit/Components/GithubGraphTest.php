<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class GithubGraphTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $template = "<x-html-github-graph />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('github-contrib', $blade);
    }

    public function test_with_event_type()
    {
        $template = "<x-html-github-graph event-type='boolean' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('github-contrib', $blade);
    }

    public function test_with_title()
    {
        $template = "<x-html-github-graph title='My Contributions' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('github-contrib', $blade);
    }

    public function test_with_remote_url()
    {
        $template = "<x-html-github-graph remote-storage-url='https://api.example.com/data' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('github-contrib', $blade);
    }

    public function test_with_local_storage_prefix()
    {
        $template = "<x-html-github-graph local-storage-prefix='my-app-' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('github-contrib', $blade);
    }

    public function test_past_entries_disabled()
    {
        $template = "<x-html-github-graph :enable-past-entries='false' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('github-contrib', $blade);
    }
}
