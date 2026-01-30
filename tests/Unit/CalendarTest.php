<?php

namespace Tests\Unit;

use Grafite\Html\HtmlAssets;
use Grafite\Html\Tags\Calendar;
use Tests\TestCase;

class CalendarTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Calendar::make()->render();

        $this->assertStringContainsString('class="w-100 h-100"></div>', $html);

        $scripts = app(HtmlAssets::class)->render();

        $this->assertStringContainsString('let _title = d.toLocaleTimeString(\'en-US\', {"timeStyle": "short"});', $scripts);
        $this->assertStringContainsString('new FullCalendar.Calendar(calendarEl,', $scripts);
        $this->assertStringContainsString('initialView: \'dayGridMonth\',', $scripts);
    }
}
