<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\SortTextWithIcon;
use Illuminate\Database\Eloquent\Model;
use Grafite\Html\Tags\HtmlComponent;

class Table extends HtmlComponent
{
    public static $collection;
    public static $keys;
    public static $sortable = null;
    public static $headers;

    public static function collection($value)
    {
        self::$collection = $value;

        return new static();
    }

    public static function keys($value)
    {
        self::$keys = $value;

        return new static();
    }

    public static function sortable($value)
    {
        self::$sortable = $value;

        return new static();
    }

    public static function headers($value)
    {
        self::$headers = $value;

        return new static();
    }

    public static function process()
    {
        $collection = self::$collection;
        $keys = self::$keys;
        $sortable = self::$sortable;
        $headers = self::$headers;
        $class = self::$css ?? 'table';

        // Handles Eloquent Models
        if ($collection->first() instanceof Model) {
            $keys = $collection->first()->htmlTableHeaders ?? [];

            if (empty($keys)) {
                $keys = collect($collection->first()->getAttributes())->keys();
            }

            $body = $collection->map(function ($item) use ($keys, $collection) {
                $attributes = '';

                foreach ($keys as $key) {
                    $class = (collect($keys)->last() === $key) ? 'class="text-right"' : '';
                    $value = $item->$key ?? 'N/A';
                    $attributes .= "<td ${class}>${value}</td>";
                }

                return "<tr>${attributes}</tr>";
            })->implode('');
        }

        // Its not a collection of models
        if (! $collection->first() instanceof Model) {
            if (! is_object($collection->first())) {
                $body = $collection->map(function ($item, $key) use ($keys) {
                    $attributes = '';

                    $title = Str::of($keys[$key])->title()->replace('_', ' ');

                    $attributes .= "<td>${title}</td>";
                    $attributes .= "<td class=\"text-right\">${item}</td>";

                    return "<tr>${attributes}</tr>";
                })->implode('');
            }

            if (is_object($collection->first())) {
                if (empty($keys)) {
                    $keys = get_object_vars($collection->first());
                    $keys = array_keys($keys);
                }

                $body = $collection->map(function ($item) use ($keys) {
                    $attributes = '';

                    foreach ($keys as $key) {
                        $class = (collect($keys)->last() === $key) ? 'class="text-right"' : '';
                        $value = $item->$key;
                        $attributes .= "<td ${class}>${value}</td>";
                    }

                    return "<tr>${attributes}</tr>";
                })->implode('');
            }
        }

        if (empty($headers)) {
            $headers = $keys;
        }

        // Transform header text to cleaner text
        $headers = collect($headers)->map(function ($field, $item) use ($headers, $sortable) {
            $value = Str::of($item)->title()->replace('_', ' ');

            $headerValue = $value;

            if ($sortable) {
                $headerValue = SortTextWithIcon::make()->text($value)->field($field)->onClick($sortable)->render();
            }

            $class = (collect($headers)->last() === $item) ? 'class="text-right"' : '';


            return "<th ${class}>${headerValue}</th>";
        })->implode('');

        self::$html = "<table class=\"${class}\">${headers}${body}</table>";
    }
}
