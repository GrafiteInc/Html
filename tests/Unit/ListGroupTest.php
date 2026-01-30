<?php

namespace Tests\Unit;

use Grafite\Html\Tags\ListGroup;
use Tests\TestCase;

class ListGroupTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = ListGroup::make()->items([
            'Batman' => 'https://batman.com',
            'Superman' => 'https://superman.com',
        ])->render();

        $this->assertStringContainsString('<div class="list-group">', $html);
        $this->assertStringContainsString('<a href="https://batman.com" class="list-group-item list-group-item-action">Batman</a>', $html);
    }
}
