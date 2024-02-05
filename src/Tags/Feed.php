<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Feed extends HtmlComponent
{
    public static $borderColor;

    public static function borderColor($value)
    {
        self::$borderColor = $value;

        return new static();
    }

    public static function process()
    {
        $content = collect(self::$items)->implode("\n");

        self::$html = <<<html
        <ol class="html-component-activity-feed">
            $content
        </ol>
html;
    }

    public static function styles()
    {
        $borderColor = self::$borderColor ?? '#FFF';

        return <<<styles
.html-component-activity-feed {
  padding: 15px;
  list-style: none;
}

.html-component-activity-feed .feed-item {
  display: flex;
  flex: list;
}

.html-component-activity-feed .feed-item .feed-date {
  width: 124px;
  text-align: right;
  padding-top: 16px;
  padding-right: 16px;
}

.html-component-activity-feed .feed-item .feed-icon {
  text-align: center;
  line-height: 42px;
  float: left;
  width: 56px;
  height: 56px;
  background-color: #EEE;
  border-radius: 36px;
  z-index: 1000;
  border: 6px solid $borderColor;
}

.html-component-activity-feed .feed-item .feed-content {
  float: left;
  width: calc(100% - 56px - 124px);
  border-left: 2px solid;
  padding-left: 48px;
  margin-left: -28px;
  padding-top: 14px;
  padding-bottom: 48px;
}

.html-component-activity-feed .feed-item:last-child .feed-content {
  border: none;
  border-color: transparent;
}
styles;
    }
}
