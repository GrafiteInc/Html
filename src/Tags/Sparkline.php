<?php

namespace Grafite\Html\Tags;

class Sparkline extends HtmlComponent
{
    public static $data;

    public static $width;

    public static $height;

    public static $strokeWidth;

    public static $color;

    public static $area;

    public static $showDot;

    public static $type;

    public static $label;

    public static function data($value)
    {
        self::$data = $value;

        return new static;
    }

    public static function width($value)
    {
        self::$width = $value;

        return new static;
    }

    public static function height($value)
    {
        self::$height = $value;

        return new static;
    }

    public static function strokeWidth($value)
    {
        self::$strokeWidth = $value;

        return new static;
    }

    public static function color($value)
    {
        self::$color = $value;

        return new static;
    }

    public static function area($value)
    {
        self::$area = $value;

        return new static;
    }

    public static function showDot($value)
    {
        self::$showDot = $value;

        return new static;
    }

    public static function type($value)
    {
        self::$type = $value;

        return new static;
    }

    public static function label($value)
    {
        self::$label = $value;

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
        .html-sparkline-line {
            stroke: currentColor;
        }

        .html-sparkline-area {
            fill: currentColor;
            opacity: 0.15;
            stroke: none;
        }

        .html-sparkline-bar {
            fill: currentColor;
        }

        .html-sparkline-dot {
            fill: currentColor;
        }
        CSS;
    }

    protected static function points($data, $width, $height)
    {
        $min = min($data);
        $max = max($data);
        $range = ($max - $min) ?: 1;
        $count = count($data);
        $stepX = $count > 1 ? $width / ($count - 1) : 0;

        $points = [];

        foreach (array_values($data) as $index => $value) {
            $x = $count > 1 ? $index * $stepX : $width / 2;
            $y = $height - (($value - $min) / $range) * $height;
            $points[] = [round($x, 2), round($y, 2)];
        }

        return $points;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? null;

        $data = self::$data ?? [];
        $width = self::$width ?? 120;
        $height = self::$height ?? 32;
        $strokeWidth = self::$strokeWidth ?? 2;
        $color = self::$color ?? 'primary';
        $area = self::$area ?? false;
        $showDot = self::$showDot ?? false;
        $type = self::$type ?? 'line';
        $css = self::$css ?? '';
        $label = self::$label ?? 'Sparkline chart';

        $id = self::$id ? ' id="'.self::$id.'"' : '';

        if (empty($data)) {
            self::$html = <<<HTML
            <svg{$id} class="html-sparkline text-{$color} {$css}" role="img" aria-label="{$label}" width="{$width}" height="{$height}" viewBox="0 0 {$width} {$height}"></svg>
            HTML;

            return;
        }

        $points = self::points($data, $width, $height);
        $count = count($points);
        $stepX = $count > 1 ? $width / ($count - 1) : 0;

        if ($type === 'bar') {
            $barWidth = $count > 0 ? ($width / $count) * 0.6 : 0;
            $shapes = '';

            foreach ($points as $index => [$x, $y]) {
                $barX = round(($count > 1 ? $index * $stepX : $width / 2) - $barWidth / 2, 2);
                $barHeight = round($height - $y, 2);
                $shapes .= "<rect class=\"html-sparkline-bar\" x=\"{$barX}\" y=\"{$y}\" width=\"{$barWidth}\" height=\"{$barHeight}\" aria-hidden=\"true\"></rect>\n";
            }
        } else {
            $pointsAttr = implode(' ', array_map(fn ($p) => "{$p[0]},{$p[1]}", $points));

            $areaShape = '';

            if ($area) {
                $areaPoints = "0,{$height} {$pointsAttr} {$width},{$height}";
                $areaShape = "<polygon class=\"html-sparkline-area\" points=\"{$areaPoints}\" aria-hidden=\"true\"></polygon>\n";
            }

            $dot = '';

            if ($showDot) {
                [$lastX, $lastY] = end($points);
                $dotRadius = $strokeWidth + 1;
                $dot = "<circle class=\"html-sparkline-dot\" cx=\"{$lastX}\" cy=\"{$lastY}\" r=\"{$dotRadius}\" aria-hidden=\"true\"></circle>\n";
            }

            $shapes = $areaShape."<polyline class=\"html-sparkline-line\" points=\"{$pointsAttr}\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"{$strokeWidth}\" stroke-linecap=\"round\" stroke-linejoin=\"round\" aria-hidden=\"true\"></polyline>\n".$dot;
        }

        self::$html = <<<HTML
        <svg{$id} class="html-sparkline text-{$color} {$css}" role="img" aria-label="{$label}" width="{$width}" height="{$height}" viewBox="0 0 {$width} {$height}">
            {$shapes}
        </svg>
        HTML;
    }
}
