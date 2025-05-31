<?php

namespace Grafite\Html\Tags;

use PUGX\Poser\Poser;
use Grafite\Html\Tags\HtmlComponent;
use PUGX\Poser\Render\SvgFlatRender;
use PUGX\Poser\Render\SvgPlasticRender;
use PUGX\Poser\Render\SvgFlatSquareRender;
use PUGX\Poser\Render\SvgForTheBadgeRenderer;

class Badge extends HtmlComponent
{
    public static $name;
    public static $status;
    public static $color;
    public static $theme;
    public static $icon;

    public static function name($value)
    {
        self::$name = $value;

        return new static();
    }

    public static function status($value)
    {
        self::$status = $value;

        return new static();
    }

    public static function color($value)
    {
        self::$color = $value;

        return new static();
    }

    public static function theme($value)
    {
        self::$theme = $value;

        return new static();
    }

    public static function process()
    {
        $name = self::$name;
        $status = self::$status;
        $color = self::$color;
        $theme = self::$theme;

        if (! in_array($theme, ['flat', 'flat-square', 'for-the-badge', 'plastic'])) {
            throw new \Exception("Error Processing Theme", 1);
        }

        $flat = new SvgFlatRender();
        $plastic = new SvgPlasticRender();
        $flatSquare = new SvgFlatSquareRender();
        $forTheBadge = new SvgForTheBadgeRenderer();

        $poser = new Poser([
            $flat,
            $plastic,
            $flatSquare,
            $forTheBadge,
        ]);

        $contents = $poser->generate($name, $status, $color, $theme);

        self::$html = (string) $contents;
    }
}
