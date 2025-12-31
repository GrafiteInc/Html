<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class AlertTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-alert text='What?' background='danger' dismiss='true' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<button type="button" class="close float-right acknowledge-alert-btn" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', $blade);
        $this->assertStringContainsString('What?', $blade);
        $this->assertStringContainsString('alert-danger', $blade);
    }
}
