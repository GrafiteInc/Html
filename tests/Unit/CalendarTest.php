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

        $this->assertStringContainsString('class="app-fc w-100 h-100"></div>', $html);

        $scripts = app(HtmlAssets::class)->render();

        $this->assertStringContainsString('let _title = d.toLocaleTimeString(\'en-US\', {"timeStyle": "short"});', $scripts);
        $this->assertStringContainsString('new FullCalendar.Calendar(calendarEl,', $scripts);
        $this->assertStringContainsString('initialView: \'dayGridMonth\',', $scripts);
    }

    public function test_assets_use_fullcalendar_v7()
    {
        $this->assertSame([
            '//cdn.jsdelivr.net/npm/fullcalendar@7.1.4/all/global.js',
            '//cdn.jsdelivr.net/npm/fullcalendar@7.1.4/themes/classic/global.js',
        ], Calendar::scripts());

        $this->assertSame([
            '//cdn.jsdelivr.net/npm/fullcalendar@7.1.4/skeleton.css',
            '//cdn.jsdelivr.net/npm/fullcalendar@7.1.4/themes/classic/theme.css',
            '//cdn.jsdelivr.net/npm/fullcalendar@7.1.4/themes/classic/palette.css',
        ], Calendar::stylesheets());
    }
}
