<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use InvalidArgumentException;

class Hero extends HtmlComponent
{
    public static $content;

    public static $effect = 'waves';

    public static $color;

    public static $backgroundColor;

    public static $mouseControls = true;

    public static $touchControls = true;

    public static $gyroControls = false;

    public static $minHeight = '400px';

    public static $minWidth = null;

    public static $scale = 1.0;

    public static $scaleMobile = 1.0;

    public static $speed = 1.0;

    public static $zoom = 1.0;

    public static $options = [];

    const ALLOWED_EFFECTS = [
        'birds',
        'fog',
        'waves',
        'clouds',
        'clouds2',
        'globe',
        'net',
        'cells',
        'trunk',
        'topology',
        'dots',
        'rings',
        'halo',
    ];

    const P5_EFFECTS = [
        'trunk',
        'topology',
    ];

    public static function content($value)
    {
        self::$content = $value;

        return new static;
    }

    public static function effect($value)
    {
        $value = strtolower($value);

        if (! in_array($value, self::ALLOWED_EFFECTS)) {
            throw new InvalidArgumentException(
                "Invalid Vanta effect [{$value}]. Allowed effects: ".implode(', ', self::ALLOWED_EFFECTS)
            );
        }

        self::$effect = $value;

        return new static;
    }

    public static function color($value)
    {
        self::$color = $value;

        return new static;
    }

    public static function backgroundColor($value)
    {
        self::$backgroundColor = $value;

        return new static;
    }

    public static function mouseControls($value)
    {
        self::$mouseControls = $value;

        return new static;
    }

    public static function touchControls($value)
    {
        self::$touchControls = $value;

        return new static;
    }

    public static function gyroControls($value)
    {
        self::$gyroControls = $value;

        return new static;
    }

    public static function minHeight($value)
    {
        self::$minHeight = $value;

        return new static;
    }

    public static function minWidth($value)
    {
        self::$minWidth = $value;

        return new static;
    }

    public static function scale($value)
    {
        self::$scale = $value;

        return new static;
    }

    public static function scaleMobile($value)
    {
        self::$scaleMobile = $value;

        return new static;
    }

    public static function speed($value)
    {
        self::$speed = $value;

        return new static;
    }

    public static function zoom($value)
    {
        self::$zoom = $value;

        return new static;
    }

    public static function options($value)
    {
        self::$options = $value;

        return new static;
    }

    public static function stylesheets()
    {
        return [];
    }

    public static function scripts()
    {
        $effect = self::$effect ?? 'waves';

        $scripts = [];

        if (in_array($effect, self::P5_EFFECTS)) {
            $scripts[] = '//cdnjs.cloudflare.com/ajax/libs/p5.js/1.9.0/p5.min.js';
        } else {
            $scripts[] = '//cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js';
        }

        $scripts[] = '//cdn.jsdelivr.net/npm/vanta/dist/vanta.'.$effect.'.min.js';

        return $scripts;
    }

    public static function js()
    {
        $id = self::$id;
        $effect = strtoupper(self::$effect ?? 'waves');

        $config = [
            'el' => "__EL__#{$id}__EL__",
            'mouseControls' => self::$mouseControls ?? true,
            'touchControls' => self::$touchControls ?? true,
            'gyroControls' => self::$gyroControls ?? false,
            'scale' => self::$scale ?? 1.0,
            'scaleMobile' => self::$scaleMobile ?? 1.0,
        ];

        if (self::$color !== null) {
            $config['color'] = '__RAW__'.self::$color.'__RAW__';
        }

        if (self::$backgroundColor !== null) {
            $config['backgroundColor'] = '__RAW__'.self::$backgroundColor.'__RAW__';
        }

        if (self::$speed !== null) {
            $config['speed'] = self::$speed;
        }

        if (self::$zoom !== null) {
            $config['zoom'] = self::$zoom;
        }

        $config = array_merge($config, self::$options ?? []);

        $jsonConfig = json_encode($config);

        // Replace quoted element selector with unquoted document.querySelector
        $jsonConfig = str_replace('"__EL__', 'document.querySelector("', $jsonConfig);
        $jsonConfig = str_replace('__EL__"', '")', $jsonConfig);

        // Replace raw values (hex colors etc.)
        $jsonConfig = preg_replace('/"__RAW__(.+?)__RAW__"/', '$1', $jsonConfig);

        return <<<JS
            document.addEventListener('DOMContentLoaded', (event) => {
                VANTA.{$effect}({$jsonConfig});
            });
        JS;
    }

    public static function styles()
    {
        $id = self::$id;
        $minHeight = self::$minHeight ?? '400px';
        $minWidth = self::$minWidth ? "min-width: ".self::$minWidth.";" : '';

        return <<<CSS
            #{$id} {
                position: relative;
                min-height: {$minHeight};
                {$minWidth}
                display: flex;
                align-items: center;
                justify-content: center;
            }
            #{$id} .hero-content {
                position: relative;
                z-index: 1;
            }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_'.Str::uuid();

        $id = self::$id;
        $content = self::$content ?? '';
        $css = self::$css ?? '';

        self::$html = "<div id=\"{$id}\" class=\"hero-vanta {$css}\"><div class=\"hero-content\">{$content}</div></div>";
    }
}
