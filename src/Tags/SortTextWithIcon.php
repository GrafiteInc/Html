<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class SortTextWithIcon extends HtmlComponent
{
    public static $field;

    public static function field($field)
    {
        self::$field = $field;

        return new static;
    }

    public static function process()
    {
        $icon = 'fa-sort';
        $direction = (request()->field_order === 'asc') ? 'desc' : 'asc';

        if (request()->field === self::$field && ! is_null(self::$field)) {
            $icon = (request()->field_order === 'asc') ? 'fa-sort-up' : 'fa-sort-down';
        }

        $icon = (! is_null(self::$field)) ? "<span class=\"fa {$icon}\"></span>" : '';
        $text = self::$text;
        $onClick = self::$onClick;
        $field = self::$field;

        self::$html = "<span class=\"html-component-pointer\" onclick=\"$onClick('{$field}', '{$direction}')\">{$text} {$icon}</span>";
    }

    public static function styles()
    {
        return <<<styles
            .html-component-pointer {
                cursor: pointer;
            }
styles;
    }
}
