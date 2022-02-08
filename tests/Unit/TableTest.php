<?php

namespace Tests\Unit;

use Tests\TestCase;

class TableTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = \Grafite\Html\Tags\Table::make()->sortable('window.app.processFilters')->headers(['employee number' => 'id', 'title' => 'job', 'Name' => 'name', 'Actions' => null])->collection(collect([
            (object) ['id' => 1, 'job' => 'bar', 'name' => 'baz', 'actions' => '<button class="btn btn-sm btn-info">Now</button>'],
            (object) ['id' => 2, 'job' => 'janitor', 'name' => 'jim', 'actions' => '<a>What</a>'],
        ]))->render();

        $this->assertStringContainsString('<span class="html-component-pointer" onclick="window.app.processFilters(\'id\', \'asc\')">Employee Number', $html);
    }
}
