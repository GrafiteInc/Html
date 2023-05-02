<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class AccordionTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-accordion :items=\"['who' => 'batman', 'what' => 'superman']\" />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"', $blade);
        $this->assertStringContainsString('what', $blade);
        $this->assertStringContainsString('accordion', $blade);
    }
}
