<?php

namespace Tests\Unit;

use Grafite\Html\Tags\GithubGraph;
use Tests\TestCase;

class GithubGraphTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = GithubGraph::make()->render();

        $this->assertStringContainsString('github-contrib', $html);
        $this->assertStringContainsString('<div', $html);
    }

    public function test_default_event_type_is_gradient()
    {
        GithubGraph::make()->render();

        $js = GithubGraph::js();

        $this->assertStringContainsString('"eventType":"gradient"', $js);
    }

    public function test_boolean_event_type()
    {
        GithubGraph::make()
            ->eventType('boolean')
            ->render();

        $js = GithubGraph::js();

        $this->assertStringContainsString('"eventType":"boolean"', $js);
    }

    public function test_custom_title()
    {
        GithubGraph::make()
            ->title('My Custom Graph')
            ->render();

        $js = GithubGraph::js();

        $this->assertStringContainsString('"title":"My Custom Graph"', $js);
    }

    public function test_custom_colors()
    {
        GithubGraph::make()
            ->colors([null, '#aaa', '#bbb', '#ccc', '#ddd'])
            ->render();

        $js = GithubGraph::js();

        $this->assertStringContainsString('#aaa', $js);
        $this->assertStringContainsString('#ddd', $js);
    }

    public function test_link_options()
    {
        GithubGraph::make()
            ->linkUrl('https://example.com')
            ->linkTitle('View details')
            ->linkTarget('_blank')
            ->render();

        $js = GithubGraph::js();

        $this->assertStringContainsString('"url":"https:\/\/example.com"', $js);
        $this->assertStringContainsString('"title":"View details"', $js);
        $this->assertStringContainsString('"target":"_blank"', $js);
    }

    public function test_enable_past_entries()
    {
        GithubGraph::make()
            ->enablePastEntries(false)
            ->render();

        $js = GithubGraph::js();

        $this->assertStringContainsString('"enablePastEntries":false', $js);
    }

    public function test_local_storage_prefix()
    {
        GithubGraph::make()
            ->localStoragePrefix('my-app-')
            ->render();

        $js = GithubGraph::js();

        $this->assertStringContainsString('"localStoragePrefix":"my-app-"', $js);
    }

    public function test_remote_storage_url()
    {
        GithubGraph::make()
            ->remoteStorageUrl('https://api.example.com/data')
            ->render();

        $js = GithubGraph::js();

        $this->assertStringContainsString('remoteStorageUrl', $js);
        $this->assertStringContainsString('api.example.com', $js);
    }

    public function test_no_external_scripts()
    {
        $scripts = GithubGraph::scripts();
        $stylesheets = GithubGraph::stylesheets();

        $this->assertEmpty($scripts);
        $this->assertEmpty($stylesheets);
    }

    public function test_inline_styles_present()
    {
        GithubGraph::make()->render();

        $styles = GithubGraph::styles();

        $this->assertStringContainsString('.github-contrib', $styles);
        $this->assertStringContainsString('.grid', $styles);
        $this->assertStringContainsString('.legend', $styles);
        $this->assertStringContainsString('.github-contrib-tooltip', $styles);
    }

    public function test_inline_js_present()
    {
        GithubGraph::make()->render();

        $js = GithubGraph::js();

        $this->assertStringContainsString('GithubContributions_', $js);
        $this->assertStringContainsString('DOMContentLoaded', $js);
        $this->assertStringContainsString('localStorage', $js);
    }

    public function test_custom_css()
    {
        $html = GithubGraph::make()
            ->css('my-custom-class')
            ->render();

        $this->assertStringContainsString('my-custom-class', $html);
    }

    public function test_custom_id()
    {
        $html = GithubGraph::make()
            ->id('my-graph')
            ->render();

        $this->assertStringContainsString('id="my-graph"', $html);

        $js = GithubGraph::js();

        $this->assertStringContainsString('"targetId":"my-graph"', $js);
    }

    public function test_custom_events_for_boolean()
    {
        $events = [
            'success' => ['label' => 'Success', 'color' => '#00ff00', 'value' => true],
            'failure' => ['label' => 'Failure', 'color' => '#ff0000', 'value' => false],
        ];

        GithubGraph::make()
            ->eventType('boolean')
            ->events($events)
            ->render();

        $js = GithubGraph::js();

        $this->assertStringContainsString('Success', $js);
        $this->assertStringContainsString('#00ff00', $js);
    }
}
