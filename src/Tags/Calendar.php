<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class Calendar extends HtmlComponent
{
    public static $initialView = 'dayGridMonth';
    public static $dayOfWeekStart = 0;

    public function initialView($value)
    {
        self::$initialView = $value;

        return new static();
    }

    public function dayOfWeekStart($value)
    {
        self::$dayOfWeekStart = $value;

        return new static();
    }

    public static function scripts()
    {
        return [
            '//cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js',
        ];
    }

    public static function js()
    {
        $id = self::$id;
        $initialView = self::$initialView;
        $dayOfWeekStart = self::$dayOfWeekStart ?? 0;
        $windowId = Str::random();
        $items = json_encode(self::$items);

        return <<<JS
            document.addEventListener('DOMContentLoaded', function () {
                let _toolBar = (window.outerWidth > 400) ? {
                    left: 'prev,next today threeMonthView sixMonthView',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay',
                } : {
                    start: '',
                    center: '',
                    end: 'prev,next'
                };

                var calendarEl = document.getElementById('{$id}');
                window.calendarInstance_{$windowId} = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: _toolBar,
                    timeZone: 'local',
                    themeSystem: 'bootstrap5',
                    eventSources: {$items},
                    selectable: true,
                    fixedWeekCount: false,
                    initialView: '{$initialView}',
                    views: {
                        multiMonthThreeMonth: {
                            type: 'multiMonth',
                            duration: { months: 3 }
                        },
                        multiMonthSixMonth: {
                            type: 'multiMonth',
                            duration: { months: 6 }
                        }
                    },
                    customButtons: {
                        threeMonthView: {
                            text: '3 Months',
                            click: function() {
                                window.calendarInstance_{$windowId}.changeView('multiMonthThreeMonth');
                            }
                        },
                        sixMonthView: {
                            text: '6 Months',
                            click: function() {
                                window.calendarInstance_{$windowId}.changeView('multiMonthSixMonth');
                            }
                        }
                    },
                    buttonText: {
                        today: 'Today',
                        month: 'Month',
                        week: 'Week',
                        day: 'Day',
                        list: 'List'
                    },
                    firstDay: {$dayOfWeekStart},
                    eventDidMount: function (info) {
                        // manipulating the event title
                        let titleEl = info.el.getElementsByClassName('fc-event-title')[0]

                        if (titleEl) {
                            // adding HTML
                            titleEl.innerHTML = `\${titleEl.textContent.split('<br>')[0]}`
                        }
                    },
                    dateClick: function(info) {
                        this.changeView("timeGridWeek", info.dateStr);
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

                calendarInstance_{$windowId}.render();
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
                    --fc-page-bg-color: transparent;
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
            .fc-day-past {
                background-color: var(--app-fc-day-other);
            }
            .fc-day-sat, .fc-day-sun {
                background-color: var(--app-fc-weekend);
            }
            .fc-view-harness a {
                color: var(--bs-body-color);
            }
            .fc-view-harness {
                color: var(--bs-body-color);
            }
            .fc .fc-more-popover {
                background: var(--app-fc-day-other);
            }
            .fc .fc-multimonth-singlecol .fc-multimonth-header {
                background: var(--app-fc-day-other);
            }
            .fc-timegrid-slots tr:nth-child(-n + 14) {
                background: var(--app-fc-day-other);
            }
            .fc-timegrid-slots tr:nth-last-child(-n + 4) {
                background: var(--app-fc-day-other);
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
