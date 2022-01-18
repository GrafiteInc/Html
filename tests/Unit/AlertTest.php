<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Alert;

class AlertTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = Alert::make()->text('Message for the many')->render();
        $this->assertStringContainsString('Message for the many', $html);

        $html = Alert::make()->text('Message for the many')->background('danger')->render();
        $this->assertStringContainsString('alert-danger', $html);

        $html = Alert::make()->text('Message for the many')->heading('Yo!')->render();
        $this->assertStringContainsString('Yo!', $html);
    }
}
