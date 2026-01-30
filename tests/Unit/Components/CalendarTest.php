<?php

namespace Tests\Unit\Components;

use Illuminate\Support\Carbon;
use Tests\ComponentTestCase;

class CalendarTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $items = collect([
            [
                'color' => 'blue',
                'events' => [
                    [
                        'title' => 'test event',
                        'content' => 'nothing to mention',
                        'start' => Carbon::parse('02-03-2023'),
                        'allDay' => true,
                    ],
                    [
                        'title' => 'another test event',
                        'content' => 'A couple days later',
                        'start' => Carbon::parse('02-08-2023'),
                        'allDay' => true,
                    ],
                ],
            ],
        ]);

        $template = "<x-html-calendar :items=\"$items\" />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString(':items="[{"color":"blue","events"', $blade);
        $this->assertStringContainsString('"content":"A couple days later"', $blade);
    }
}
