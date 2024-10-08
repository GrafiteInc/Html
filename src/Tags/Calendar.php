<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class Calendar extends HtmlComponent
{
    public static function scripts()
    {
        return [
            '//cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js',
        ];
    }

    public static function js()
    {
        $id = self::$id;
        $items = json_encode(self::$items);

        return <<<JS
            document.addEventListener('DOMContentLoaded', function () {
                let _toolBar = (window.outerWidth > 400) ? {
                    start: 'title',
                    center: '',
                    end: 'today dayGridMonth,timeGridWeek,timeGridDay prev,next'
                } : {
                    start: 'title',
                    center: '',
                    end: 'prev,next'
                };
                var calendarEl = document.getElementById('{$id}');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: (window.outerWidth > 400) ? 'dayGridMonth' : 'timeGridDay',
                    headerToolbar: _toolBar,
                    timeZone: 'local',
                    themeSystem: 'bootstrap5',
                    eventSources: {$items},
                    selectable: true,
                    fixedWeekCount: false,
                    firstDay: 1,
                    eventDidMount: function (info) {
                        // manipulating the event title
                        let titleEl = info.el.getElementsByClassName('fc-event-title')[0]

                        if (titleEl) {
                            // adding HTML
                            titleEl.innerHTML = `\${titleEl.textContent.split('<br>')[0]}`
                        }
                    },
                    dateClick: function(info) {
                        this.changeView("timeGridDay", info.dateStr);
                    },
                    eventClick: function(info) {
                        const d = new Date(info.event.start);
                        let _title = d.toLocaleTimeString('en-US', {"timeStyle": "short"});

                        if (info.event.allDay) {
                            _title = 'All day';
                        }

                        window.modal(_title, info.event.extendedProps.content);
                    }
                });

                calendar.render();
            });
        JS;
    }

    public static function styles()
    {
        return <<<CSS
            @media (prefers-color-scheme: light) {
                :root {
                    --app-fc-weekend: var(--bs-gray-200);
                    --app-fc-day-past: var(--bs-gray-100);
                }
            }
            @media (prefers-color-scheme: dark) {
                :root {
                    --app-fc-weekend: var(--bs-gray-800);
                    --app-fc-day-other: var(--bs-black);
                }
            }
            :root {
                --fc-border-color: var(--bs-border-color) !important;
            }
            .fc-day-other {
                background-color: var(--app-fc-day-other);
            }
            .fc-day-past {
                background-color: var(--app-fc-day-other);
            }
            .fc-day-sat, .fc-day-sun {
                background-color: var(--app-fc-weekend);
            }
            .fc-view-harness a {
                color: var(--bs-body-color);
            }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_' . Str::uuid();

        $id = self::$id;

        self::$html = "<div id=\"{$id}\" class=\"w-100 h-100\"></div>";
    }
}
