<?php

namespace Grafite\Html\Tags;

use ReflectionClass;
use ReflectionProperty;
use Illuminate\Support\Str;
use Grafite\Html\HtmlAssets;

class HtmlComponent
{
    public static $id;
    public static $css;
    public static $url;
    public static $text;
    public static $html;
    public static $onClick;
    public static $items = [];
    public static $attributes = [];

    public static function make()
    {
        $properties = (new ReflectionClass(new static))
            ->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            static::$$propertyName = null;
        }

        self::$items = [];
        self::$attributes = [];

        return new static;
    }

    public static function onClick($onClick)
    {
        self::$onClick = $onClick;

        return new static;
    }

    public static function items($items)
    {
        self::$items = $items;

        return new static;
    }

    public static function css($css)
    {
        self::$css = $css;

        return new static;
    }

    public static function url($url)
    {
        self::$url = $url;

        return new static;
    }

    public static function id($id)
    {
        self::$id = $id;

        self::$attributes = array_merge(['id' => $id], self::$attributes);

        return new static;
    }

    public static function text($text)
    {
        self::$text = $text;

        return new static;
    }

    public static function attributes($attributes)
    {
        self::$attributes = $attributes;

        return new static;
    }

    public static function renderWhen($callback)
    {
        if ($callback()) {
            static::process();

            app(HtmlAssets::class)
                ->addScripts(static::scripts())
                ->addJs(static::js())
                ->addStyles(static::styles());

            return static::render();
        }

        return '';
    }

    public static function render()
    {
        static::process();

        app(HtmlAssets::class)
            ->addScripts(static::scripts())
            ->addJs(static::js())
            ->addStyles(static::styles());

        return static::$html;
    }

    public static function usingBootstrap5()
    {
        return Str::of(config('html.bootstrap-version'))->startsWith('5');
    }

    public static function scripts()
    {
        return [];
    }

    public static function js()
    {
        return '';
    }

    public static function styles()
    {
        return '';
    }

    public static function processAttributes($attributes)
    {
        $attributesGroup = array_merge(static::$attributes, $attributes);

        $attributes = '';

        foreach ($attributesGroup as $key => $value) {
            if (! empty($value)) {
                $attributes .= ' '.self::attributeElement($key, $value);
            }
        }

        return $attributes;
    }

    public static function attributeElement($key, $value)
    {
        if (is_numeric($key)) {
            return $value;
        }

        if (is_bool($value) && $key !== 'value') {
            return $value ? $key : '';
        }

        if (is_array($value) && $key === 'class') {
            return 'class="' . implode(' ', $value) . '"';
        }

        if (! is_null($value)) {
            return $key . '="' . e($value, false) . '"';
        }
    }
}
