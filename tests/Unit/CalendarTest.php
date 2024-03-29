<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\HtmlAssets;
use Grafite\Html\Tags\Calendar;

class CalendarTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = Calendar::make()->render();

        $this->assertStringContainsString('class="w-100 h-100"></div>', $html);

        $scripts = app(HtmlAssets::class)->render();

        $this->assertStringContainsString('let _title = d.toLocaleTimeString(\'en-US\', {"timeStyle": "short"});', $scripts);
        $this->assertStringContainsString('var calendar = new FullCalendar.Calendar(calendarEl,', $scripts);
        $this->assertStringContainsString('initialView: (window.outerWidth > 400) ? \'dayGridMonth\' : \'timeGridDay\'', $scripts);
    }
}
