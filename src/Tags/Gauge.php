<?php

namespace Grafite\Html\Tags;

class Gauge extends HtmlComponent
{
    public static $value;

    public static $min;

    public static $max;

    public static $size;

    public static $thickness;

    public static $color;

    public static $label;

    public static $unit;

    public static $showValue;

    public static $thresholds;

    public static function value($value)
    {
        self::$value = $value;

        return new static;
    }

    public static function min($value)
    {
        self::$min = $value;

        return new static;
    }

    public static function max($value)
    {
        self::$max = $value;

        return new static;
    }

    public static function size($value)
    {
        self::$size = $value;

        return new static;
    }

    public static function thickness($value)
    {
        self::$thickness = $value;

        return new static;
    }

    public static function color($value)
    {
        self::$color = $value;

        return new static;
    }

    public static function label($value)
    {
        self::$label = $value;

        return new static;
    }

    public static function unit($value)
    {
        self::$unit = $value;

        return new static;
    }

    public static function showValue($value)
    {
        self::$showValue = $value;

        return new static;
    }

    public static function thresholds($value)
    {
        self::$thresholds = $value;

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
        .html-gauge {
            position: relative;
            display: inline-grid;
            place-items: center;
            width: var(--html-gauge-size);
            height: var(--html-gauge-size);
        }

        .html-gauge svg {
            grid-column: 1;
            grid-row: 1;
        }

        .html-gauge-track {
            stroke: var(--bs-secondary-bg, #e9ecef);
        }

        .html-gauge-value {
            stroke-linecap: round;
            transition: stroke-dashoffset 0.3s ease;
        }

        .html-gauge-label {
            grid-column: 1;
            grid-row: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            line-height: 1.1;
        }

        .html-gauge-value-text {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .html-gauge-caption {
            font-size: 0.75rem;
            color: var(--bs-secondary-color);
        }
        CSS;
    }

    protected static function sizeInPixels($size)
    {
        return match ($size) {
            'sm' => 96,
            'lg' => 180,
            default => 140,
        };
    }

    protected static function resolveColor($value, $defaultColor, $thresholds)
    {
        $resolved = $defaultColor;
        $matchedFrom = null;

        foreach ((array) $thresholds as $threshold) {
            if (! isset($threshold['from'], $threshold['color'])) {
                continue;
            }

            if ($value >= $threshold['from'] && ($matchedFrom === null || $threshold['from'] >= $matchedFrom)) {
                $matchedFrom = $threshold['from'];
                $resolved = $threshold['color'];
            }
        }

        return $resolved;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? null;

        $value = self::$value ?? 0;
        $min = self::$min ?? 0;
        $max = self::$max ?? 100;
        $size = self::sizeInPixels(self::$size ?? 'md');
        $thickness = self::$thickness ?? 10;
        $color = self::resolveColor($value, self::$color ?? 'primary', self::$thresholds ?? []);
        $label = self::$label ?? '';
        $unit = self::$unit ?? '';
        $showValue = self::$showValue ?? true;
        $css = self::$css ?? '';

        $radius = ($size - $thickness) / 2;
        $circumference = 2 * M_PI * $radius;
        $range = ($max - $min) ?: 1;
        $percent = max(0, min(1, ($value - $min) / $range));
        $offset = $circumference * (1 - $percent);
        $center = $size / 2;

        $id = self::$id ? ' id="'.self::$id.'"' : '';

        $caption = $label ? "<span class=\"html-gauge-caption\">{$label}</span>" : '';

        $valueLabel = $showValue
            ? <<<HTML
            <div class="html-gauge-label">
                <span class="html-gauge-value-text">{$value}{$unit}</span>
                {$caption}
            </div>
            HTML
            : '';

        self::$html = <<<HTML
        <div{$id} class="html-gauge text-{$color} {$css}" style="--html-gauge-size: {$size}px;" role="meter" aria-valuenow="{$value}" aria-valuemin="{$min}" aria-valuemax="{$max}" aria-label="{$label}">
            <svg width="{$size}" height="{$size}" viewBox="0 0 {$size} {$size}">
                <circle class="html-gauge-track" cx="{$center}" cy="{$center}" r="{$radius}" stroke-width="{$thickness}" fill="none"></circle>
                <circle class="html-gauge-value" cx="{$center}" cy="{$center}" r="{$radius}" stroke-width="{$thickness}" fill="none" stroke="currentColor" stroke-dasharray="{$circumference}" stroke-dashoffset="{$offset}" transform="rotate(-90 {$center} {$center})"></circle>
            </svg>
            {$valueLabel}
        </div>
        HTML;
    }
}
