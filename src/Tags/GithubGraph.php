<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;

class GithubGraph extends HtmlComponent
{
    public static $eventType = 'gradient';

    public static $title;

    public static $events;

    public static $colors;

    public static $linkUrl;

    public static $linkTitle;

    public static $linkTarget;

    public static $enablePastEntries = true;

    public static $localStoragePrefix;

    public static $remoteStorageUrl;

    public static function eventType($value)
    {
        self::$eventType = $value;

        return new static;
    }

    public static function title($value)
    {
        self::$title = $value;

        return new static;
    }

    public static function events($value)
    {
        self::$events = $value;

        return new static;
    }

    public static function colors($value)
    {
        self::$colors = $value;

        return new static;
    }

    public static function linkUrl($value)
    {
        self::$linkUrl = $value;

        return new static;
    }

    public static function linkTitle($value)
    {
        self::$linkTitle = $value;

        return new static;
    }

    public static function linkTarget($value)
    {
        self::$linkTarget = $value;

        return new static;
    }

    public static function enablePastEntries($value)
    {
        self::$enablePastEntries = $value;

        return new static;
    }

    public static function localStoragePrefix($value)
    {
        self::$localStoragePrefix = $value;

        return new static;
    }

    public static function remoteStorageUrl($value)
    {
        self::$remoteStorageUrl = $value;

        return new static;
    }

    public static function stylesheets()
    {
        return [];
    }

    public static function scripts()
    {
        return [];
    }

    public static function styles()
    {
        return <<<'CSS'
            .github-contrib {
                display: none;
                line-height: 12px;
                margin: 10px;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Noto Sans", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
            }
            .github-contrib h2 {
                font-size: 1rem;
                font-weight: normal;
            }
            .github-contrib table {
                padding: 10px;
                border-radius: 2px;
                outline: 1px solid var(--color-border-default, #d1d9e0);
                outline-offset: -1px;
            }
            .github-contrib th {
                font-size: 12px;
                font-weight: normal;
                padding-bottom: 4px;
                padding-top: 10px;
            }
            .github-contrib tr {
                line-height: 10px;
            }
            .github-contrib td {
                width: 10px;
            }
            .github-contrib td.label {
                padding-right: 4px;
                font-size: 12px;
                font-weight: 400;
                color: var(--color-fg-default, black);
                text-align: left;
                fill: var(--color-fg-default, black);
            }
            .github-contrib .grid {
                fill: var(--color-calendar-graph-day-bg, #ebedf0);
                shape-rendering: geometricPrecision;
                background-color: var(--color-calendar-graph-day-bg, #ebedf0);
                border-radius: 2px;
                outline: 1px solid var(--color-calendar-graph-day-border, rgba(27, 31, 35, 0.06));
                outline-offset: -1px;
                cursor: pointer;
                user-select: none;
            }
            .github-contrib td a {
                font-size: 10px;
            }
            .github-contrib tfoot tr td {
                padding-top: 10px;
            }
            .github-contrib tfoot,
            .github-contrib a.muted {
                color: var(--fgColor-muted, #59636e);
                text-decoration: none;
                font-size: 12px;
            }
            .github-contrib tfoot a.muted:hover {
                color: var(--fgColor-accent, #0969da);
            }
            .github-contrib .legend span {
                display: block;
            }
            .github-contrib .legend .grid {
                width: 12px;
                height: 12px;
            }
            .github-contrib .legend .grid,
            .github-contrib .legend span {
                float: left;
                margin-right: 5px;
            }
            .github-contrib .github-contrib-tooltip {
                position: absolute;
                background: black;
                color: white;
                padding: 4px;
                margin-top: -12px;
                border-radius: 4px;
                font-size: 12px;
                transform: translateY(-100%);
            }
            .github-contrib .future {
                pointer-events: none;
            }
        CSS;
    }

    public static function js()
    {
        $id = self::$id;

        $options = [];

        $options['targetId'] = $id;

        $options['eventType'] = self::$eventType ?? 'gradient';

        if (self::$title !== null) {
            $options['title'] = self::$title;
        }

        if (self::$events !== null) {
            $options['events'] = self::$events;
        }

        if (self::$colors !== null) {
            $options['colors'] = self::$colors;
        }

        if (self::$linkUrl !== null || self::$linkTitle !== null) {
            $link = [];
            if (self::$linkUrl !== null) {
                $link['url'] = self::$linkUrl;
            }
            if (self::$linkTitle !== null) {
                $link['title'] = self::$linkTitle;
            }
            if (self::$linkTarget !== null) {
                $link['target'] = self::$linkTarget;
            }
            $options['link'] = $link;
        }

        $options['enablePastEntries'] = self::$enablePastEntries ?? true;

        if (self::$localStoragePrefix !== null) {
            $options['localStoragePrefix'] = self::$localStoragePrefix;
        }

        if (self::$remoteStorageUrl !== null) {
            $options['remoteStorageUrl'] = self::$remoteStorageUrl;
        }

        $jsonOptions = json_encode($options);

        return <<<JS
            const GithubContributions_{$id} = function(options) {
                const targetId = options && options.targetId ? options.targetId : 'github-contrib';
                const dataStore = options && options.localStoragePrefix ? options.localStoragePrefix : '';
                const remoteUrl = options && options.remoteStorageUrl ? options.remoteStorageUrl : undefined;
                let title = options && options.title ? options.title : '% contributions in the past year';
                let link = {
                    url: '#',
                    title: 'Learn how we count contributions',
                };
                link = options && options.link ? options.link : link;
                let enablePastEntries = options && options.enablePastEntries !== undefined ? options.enablePastEntries : true;

                const eventType = options && options.eventType !== undefined ? options.eventType : 'boolean';
                var events, colors;
                if (eventType == "boolean") {
                    events = {
                        good: { label: 'Good', color: '#9be9a8', value: true },
                        bad: { label: 'Bad', color: 'palevioletred', value: false },
                    };
                    events = options && options.events ? options.events : events;
                } else if (eventType == "gradient") {
                    colors = [null, '#9be9a8', '#40c463', '#30a14e', '#216e39'];
                    colors = options && options.colors ? options.colors : colors;
                }

                function nthNumber(number) {
                    if (number > 3 && number < 21) return number + "th";
                    switch (number % 10) {
                        case 1: return number + "st";
                        case 2: return number + "nd";
                        case 3: return number + "rd";
                        default: return number + "th";
                    }
                }

                this.track = function(action) {
                    return new Promise((resolve, reject) => {
                        let target = document.querySelector('#' + targetId + ' [data-date="' + currentDate + '"]');

                        if (eventType == "gradient") {
                            let data = localStorage.getItem(dataStore + currentDate);
                            if (data == null || isNaN(data)) {
                                data = 1;
                            } else {
                                data++;
                            }
                            target.style.backgroundColor = colors[data];
                            localStorage.setItem(dataStore + currentDate, data);
                        } else {
                            if (events.good.value == action) {
                                target.style.backgroundColor = events.good.color;
                            } else if (events.bad.value == action) {
                                target.style.backgroundColor = events.bad.color;
                            } else {
                                target.style.backgroundColor = null;
                            }
                            localStorage.setItem(dataStore + currentDate, action);
                        }
                        resolve();
                    });
                };

                const elem = document.getElementById(targetId);
                elem.innerHTML = '';

                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const dLabels = ['', 'Mon', '', 'Wed', '', 'Fri', ''];
                let eventCount = 0;

                let grid = Array.from(Array(52), () => new Array(7));

                let today = new Date();
                const n = today.getDay();
                const offset = today.getTimezoneOffset();
                today = new Date(today.getTime() - (offset * 60 * 1000));
                let currentDate = today.toISOString().split('T')[0];

                let curDate = today;
                curDate = new Date(curDate.getTime() + 86400 * 1000 * (6 - n));
                curDate = new Date(curDate.getTime() + 86400 * 1000);

                let mLabels = [];
                for (let w = 51; w >= 0; w--) {
                    for (let i = 6; i >= 0; i--) {
                        curDate = new Date(curDate.getTime() - 86400 * 1000);
                        grid[w][i] = curDate.toISOString().split('T')[0];
                        mLabels[w] = months[curDate.getMonth()];
                    }
                }

                let tableElem = document.createElement('table');
                let thead = document.createElement('thead');
                let tr = document.createElement('tr');
                let th = document.createElement('th');
                tr.append(th);

                let count = 0;
                let curMonth = -1;
                for (let i = 0; i < grid.length; i++) {
                    let month;
                    for (let j = 0; j < grid[0].length; j++) {
                        let mDate = new Date(grid[i][j]);
                        mDate = new Date(mDate.getTime() - (offset * 60 * 1000));
                        month = mDate.getMonth();
                    }
                    if (curMonth != month) {
                        if (curMonth != -1) {
                            let th = document.createElement('th');
                            th.colSpan = count;
                            if (count > 1) {
                                th.innerHTML = months[curMonth];
                            }
                            tr.append(th);
                        }
                        count = 1;
                        curMonth = month;
                    } else {
                        count++;
                    }
                }
                th = document.createElement('th');
                th.colSpan = count;
                if (count > 1) {
                    th.innerHTML = months[curMonth];
                }
                tr.append(th);
                thead.append(tr);

                let remoteData = undefined;
                if (remoteUrl) {
                    fetch(remoteUrl)
                        .then(response => response.json())
                        .then(json => {
                            remoteData = json.data;
                            buildGraph();
                        });
                } else {
                    buildGraph();
                }

                function buildGraph() {
                    let max = 0;
                    let values = [];
                    if (eventType == "gradient") {
                        for (let i = 0; i < grid[0].length; i++) {
                            for (let j = 0; j < grid.length; j++) {
                                let data;
                                if (remoteData) {
                                    let index = grid[j][i];
                                    if (remoteData[index] == undefined) continue;
                                    data = parseInt(remoteData[index]);
                                } else {
                                    data = parseInt(localStorage.getItem(dataStore + grid[j][i]));
                                }
                                if (data) {
                                    if (data > max) max = data;
                                    values.push(data);
                                }
                            }
                        }
                    }

                    let tbody = document.createElement('tbody');
                    for (let i = 0; i < grid[0].length; i++) {
                        let tr = document.createElement('tr');
                        let td = document.createElement('td');
                        td.innerHTML = dLabels[i];
                        td.className = "label";
                        tr.append(td);
                        for (let j = 0; j < grid.length; j++) {
                            let td = document.createElement('td');
                            td.setAttribute('data-date', grid[j][i]);
                            td.className = "grid";
                            if (grid[j][i] > currentDate) {
                                td.classList.add("future");
                                tr.append(td);
                                continue;
                            }

                            if (enablePastEntries) {
                                td.addEventListener('click', function() {
                                    let target = document.querySelector('#' + targetId + ' [data-date="' + currentDate + '"]');
                                    target.style.outline = "1px solid var(--color-calendar-graph-day-border)";
                                    currentDate = grid[j][i];
                                    target = document.querySelector('#' + targetId + ' [data-date="' + currentDate + '"]');
                                    target.style.outline = "1px solid black";
                                });
                            }

                            let a = document.createElement('a');
                            a.title = grid[j][i];
                            a.innerHTML = '&nbsp;';
                            td.append(a);
                            tr.append(td);

                            let data;
                            if (remoteData) {
                                let index = grid[j][i];
                                if (remoteData[index] == undefined) continue;
                                data = remoteData[index].toString();
                            } else {
                                data = localStorage.getItem(dataStore + grid[j][i]);
                            }

                            if (data) {
                                if (eventType == 'gradient') {
                                    eventCount += parseInt(data);
                                    switch (true) {
                                        case (data == 1):
                                            td.style.backgroundColor = colors[1]; break;
                                        case (data == 2):
                                            td.style.backgroundColor = colors[2]; break;
                                        case (data < max * 2/3):
                                            td.style.backgroundColor = colors[3]; break;
                                        case (data <= max):
                                            td.style.backgroundColor = colors[4];
                                    }
                                } else {
                                    if (data == String(events.good.value)) {
                                        td.style.backgroundColor = events.good.color;
                                        eventCount++;
                                    } else if (data == String(events.bad.value)) {
                                        td.style.backgroundColor = events.bad.color;
                                        eventCount++;
                                    }
                                }
                            }

                            td.addEventListener('mouseenter', function() {
                                let div = document.createElement('div');
                                div.className = "github-contrib-tooltip";
                                let date = new Date(grid[j][i] + "T12:00:00");
                                date = new Date(date.getTime() - (offset * 60 * 1000));

                                if (eventType == "gradient") {
                                    div.innerHTML = data ? data : "No";
                                } else {
                                    div.innerHTML = data ? "1" : "No";
                                }
                                div.innerHTML += " events on " + date.toLocaleString('default', { month: 'long' }) + " " + nthNumber(date.getDate());
                                this.append(div);
                            });
                            td.addEventListener('mouseleave', function() {
                                let div = this.querySelector('.github-contrib-tooltip');
                                if (div) div.remove();
                            });
                        }
                        tbody.append(tr);
                    }

                    let tfoot = document.createElement('tfoot');
                    tr = document.createElement('tr');
                    let td = document.createElement('td');
                    tr.append(td);

                    td = document.createElement('td');
                    td.colSpan = 40;
                    let a = document.createElement('a');
                    a.className = "muted";
                    a.href = link.url;
                    a.innerHTML = link.title;
                    a.target = link.target ? link.target : '';
                    td.append(a);
                    tr.append(td);

                    td = document.createElement('td');
                    td.className = "legend";
                    td.colSpan = 12;

                    if (eventType == 'gradient') {
                        let span = document.createElement('span');
                        span.innerHTML = "Less";
                        td.append(span);
                        for (let c = 0; c < colors.length; c++) {
                            let div = document.createElement('div');
                            div.className = "grid";
                            if (colors[c]) div.style.backgroundColor = colors[c];
                            td.append(div);
                        }
                        span = document.createElement('span');
                        span.innerHTML = "More";
                        td.append(span);
                    } else {
                        for (let event in events) {
                            let span = document.createElement('span');
                            span.innerHTML = events[event].label;
                            td.append(span);
                            let div = document.createElement('div');
                            div.className = "grid";
                            div.style.backgroundColor = events[event].color;
                            td.append(div);
                        }
                    }
                    tr.append(td);
                    tfoot.append(tr);

                    let h2 = document.createElement('h2');
                    title = title.replace('%', eventCount);
                    h2.innerHTML = title;
                    elem.append(h2);

                    tableElem.append(thead);
                    tableElem.append(tbody);
                    tableElem.append(tfoot);
                    elem.append(tableElem);
                    elem.style.display = 'block';
                }
            };

            document.addEventListener('DOMContentLoaded', function() {
                new GithubContributions_{$id}({$jsonOptions});
            });

            if (document.readyState !== 'loading') {
                new GithubContributions_{$id}({$jsonOptions});
            }
        JS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_'.Str::uuid();

        $id = self::$id;
        $css = self::$css ?? '';

        self::$html = "<div id=\"{$id}\" class=\"github-contrib {$css}\"></div>";
    }
}
