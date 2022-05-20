<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class TableTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-table />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<table class="table"></table>', $blade);

        $template = "<x-html-table class=\"table table-carded\" />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<table class="table table-carded"></table>', $blade);

        $collection = collect([
            (object) ['id' => 1, 'job' => 'bar', 'name' => 'baz', 'actions' => '<button class="btn btn-sm btn-info">Now</button>'],
            (object) ['id' => 2, 'job' => 'janitor', 'name' => 'jim', 'actions' => '<a>What</a>'],
        ]);

        $template = '<x-html-table :collection="$collection" />';

        $blade = (string) $this->blade($template, ['collection' => $collection]);

        $this->assertStringContainsString('<table class="table"><th >0</th><th >1</th><th >2</th><th >3</th><tr><td >1</td><td >bar</td><td >baz</td><td class="text-right"><button class="btn btn-sm btn-info">Now</button></td></tr><tr><td >2</td><td >janitor</td><td >jim</td><td class="text-right"><a>What</a></td></tr></table>', $blade);

        $template = '<x-html-table :collection="$collection" sortable="window.app.processFilters" :headers="$headers" />';

        $headers = ['employee number' => 'id', 'title' => 'job', 'Name' => 'name', 'Actions' => null];

        $blade = (string) $this->blade($template, ['collection' => $collection, 'headers' => $headers]);

        $this->assertStringContainsString('<span class="html-component-pointer" onclick="window.app.processFilters(\'id\', \'asc\')">Employee Number', $blade);
    }
}
