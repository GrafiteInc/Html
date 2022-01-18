<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Card;
use Grafite\Html\Tags\ListGroup;
use Grafite\Html\Tags\Breadcrumbs;

class ListGroupTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = ListGroup::make()->items([
            'Batman' => 'https://batman.com',
            'Superman' => 'https://superman.com',
        ])->render();

        $this->assertStringContainsString('<div class="list-group">', $html);
        $this->assertStringContainsString('<a href="https://batman.com" class="list-group-item list-group-item-action">Batman</a>', $html);
    }
}
