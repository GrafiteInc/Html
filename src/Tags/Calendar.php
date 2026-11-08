<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;

class Calendar extends HtmlComponent
{
    public static $initialView = 'dayGridMonth';

    public static $dayOfWeekStart = 0;

    public function initialView($value)
    {
        self::$initialView = $value;

        return new static;
    }

    public function dayOfWeekStart($value)
    {
        self::$dayOfWeekStart = $value;

        return new static;
    }

    public static function stylesheets()
    {
        return [
            '//cdn.jsdelivr.net/npm/fullcalendar@7.1.4/skeleton.css',
            '//cdn.jsdelivr.net/npm/fullcalendar@7.1.4/themes/classic/theme.css',
            '//cdn.jsdelivr.net/npm/fullcalendar@7.1.4/themes/classic/palette.css',
        ];
    }

    public static function scripts()
    {
        return [
            '//cdn.jsdelivr.net/npm/fullcalendar@7.1.4/all/global.js',
            '//cdn.jsdelivr.net/npm/fullcalendar@7.1.4/themes/classic/global.js',
        ];
    }

    public static function js()
    {
        $id = self::$id;
        $initialView = self::$initialView ?? 'dayGridMonth';
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

                let _dayClass = function (info) {
                    return [
                        info.isOther ? 'app-fc-day-other' : '',
                        info.isPast ? 'app-fc-day-past' : '',
                        (info.dow === 0 || info.dow === 6) ? 'app-fc-weekend' : '',
                    ].filter(Boolean).join(' ');
                };

                var calendarEl = document.getElementById('{$id}');
                window.calendarInstance_{$windowId} = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: _toolBar,
                    timeZone: 'local',
                    colorScheme: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light',
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
                    buttons: {
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
                        },
                        today: { text: 'Today' },
                        dayGridMonth: { text: 'Month' },
                        timeGridWeek: { text: 'Week' },
                        timeGridDay: { text: 'Day' }
                    },
                    dayCellClass: _dayClass,
                    dayLaneClass: _dayClass,
                    slotLaneClass: function (info) {
                        let hour = info.time.milliseconds / 3600000;

                        return (hour < 7 || hour >= 22) ? 'app-fc-off-hours' : '';
                    },
                    eventTitleClass: 'app-fc-event-title',
                    popoverClass: 'app-fc-popover',
                    singleMonthHeaderClass: 'app-fc-month-header',
                    firstDay: {$dayOfWeekStart},
                    eventDidMount: function (info) {
                        // manipulating the event title
                        let titleEl = info.el.getElementsByClassName('app-fc-event-title')[0];

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
        return <<<'CSS'
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
                [data-color-scheme=dark] {
                    --fc-classic-background: transparent !important;
                }
            }
            :root, [data-color-scheme] {
                --fc-classic-border: var(--bs-border-color) !important;
            }
            .app-fc-day-other,
            .app-fc-day-past {
                background-color: var(--app-fc-day-other);
            }
            .app-fc-weekend {
                background-color: var(--app-fc-weekend);
            }
            .app-fc,
            .app-fc a {
                color: var(--bs-body-color);
            }
            .app-fc-popover,
            .app-fc-month-header,
            .app-fc-off-hours {
                background: var(--app-fc-day-other);
            }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_'.Str::uuid();

        $id = self::$id;

        self::$html = "<div id=\"{$id}\" class=\"app-fc w-100 h-100\"></div>";
    }
}
