<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class Map extends HtmlComponent
{
    public static $marker;
    public static $center = [36.668419, -41.176225];
    public static $bubbles;
    public static $zoom = 3;
    public static $maxZoom = 16;
    public static $skin = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png';

    public static function skin($value)
    {
        self::$skin = $value;

        return new static();
    }

    public static function bubbles($array)
    {
        foreach ($array as $bubble) {
            $var = 'bubbles_' . Str::random();
            $x = $bubble['x'];
            $y = $bubble['y'];
            $color = $bubble['color'] ?? 'var(--bs-primary)';
            $fill = $bubble['fill'] ?? 'var(--bs-primary)';
            $opacity = $bubble['opacity'] ?? 1.0;
            $radius = $bubble['radius'] ?? 10;
            $tooltip = $bubble['tooltip'] ?? null;
            $click = $bubble['click'] ?? null;

            self::$bubbles .= "var {$var} = L.circle([{$x}, {$y}], {
                color: '{$color}',
                    fillColor: '{$fill}',
                    fillOpacity: {$opacity},
                    radius: {$radius}
                }).addTo(map); ";

            if (! is_null($tooltip)) {
                self::$bubbles .= " {$var}.bindPopup(\"{$tooltip}\").openPopup();";
            }

            if (! is_null($click)) {
                self::$bubbles .= " {$var}.on('click', function () { {$click}; });";
            }
        }

        return new static();
    }


    public static function zoom($value)
    {
        self::$zoom = $value;

        return new static();
    }

    public static function maxZoom($value)
    {
        self::$maxZoom = $value;

        return new static();
    }

    public static function center($x, $y)
    {
        self::$center = [$x, $y];

        return new static();
    }

    public static function marker($x, $y, $tooltip = null, $click = null)
    {
        $var = 'marker_' . Str::random();

        self::$marker = "var {$var} = L.marker([{$x}, {$y}]).addTo(map);";

        if (! is_null($tooltip)) {
            self::$marker .= " {$var}.bindPopup(\"{$tooltip}\").openPopup();";
        }

        if (! is_null($click)) {
            self::$marker .= " {$var}.on('click', function () { {$click}; });";
        }

        return new static();
    }

    public static function stylesheets()
    {
        return [
            '//unpkg.com/leaflet@1.9.4/dist/leaflet.css',
        ];
    }

    public static function scripts()
    {
        return [
            '//unpkg.com/leaflet@1.9.4/dist/leaflet.js',
        ];
    }

    public static function js()
    {
        $id = self::$id;
        $marker = self::$marker;
        $center = json_encode(self::$center);
        $skin = self::$skin;
        $zoom = self::$zoom ?? 3;
        $maxZoom = self::$maxZoom ?? 16;
        $bubbles = self::$bubbles;

        return <<<JS
           document.addEventListener('DOMContentLoaded', (event) => {
                var map = L.map('{$id}').setView({$center}, $zoom);
                L.tileLayer('{$skin}', {
                    maxZoom: $maxZoom,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                {$marker}
                {$bubbles}
            });
        JS;
    }

    public static function styles()
    {
        return <<<CSS
            .leaflet-map {
                min-height: 400px;
            }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_' . Str::uuid();

        $id = self::$id;

        self::$html = "<div id=\"{$id}\" class=\"leaflet-map\"></div>";
    }
}
