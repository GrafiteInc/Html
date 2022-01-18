<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class FeedItem extends HtmlComponent
{
    public static $icon;
    public static $iconBackground;
    public static $content;
    public static $date;

    public function content($value)
    {
        self::$content = $value;

        return new static;
    }

    public function date($value)
    {
        self::$date = $value;

        return new static;
    }

    public function icon($value, $background)
    {
        self::$icon = $value;
        self::$iconBackground = $background;

        return new static;
    }

    public static function process()
    {
        $icon = self::$icon ?? '';
        $date = self::$date ?? '';
        $iconBackground = self::$iconBackground ?? '';
        $content = self::$content ?? '';

        self::$html = <<<html
        <div class="feed-item">
            <div class="feed-date">
                $date
            </div>
            <div class="feed-icon" style="background-color: $iconBackground;">
                $icon
            </div>
            <div class="feed-content">
                $content
            </div>
        </div>
html;
    }
}
