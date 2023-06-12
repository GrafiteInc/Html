<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Accordion;
use Tests\TestCase;

class AccordionTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = Accordion::make()->items([
            'Who is me' => 'What is the long term of this and that?',
            'What is you?' => 'Who is he and you, its me, what is, oh my.',
        ])->render();

        $this->assertStringContainsString('What Is You?', $html);
        $this->assertStringContainsString('<button class="accordion-button collapsed"', $html);
    }
}
