<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Alert;
use Tests\TestCase;

class AlertTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Alert::make()->text('Message for the many')->render();
        $this->assertStringContainsString('Message for the many', $html);

        $html = Alert::make()->text('Message for the many')->background('danger')->render();
        $this->assertStringContainsString('alert-danger', $html);

        $html = Alert::make()->text('Message for the many')->heading('Yo!')->render();
        $this->assertStringContainsString('Yo!', $html);
    }
}
