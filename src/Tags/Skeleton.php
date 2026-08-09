<?php

namespace Grafite\Html\Tags;

class Skeleton extends HtmlComponent
{
    public static $width;

    public static $height;

    public static $rounded;

    public static $animation;

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

    public static function rounded($value)
    {
        self::$rounded = $value;

        return new static;
    }

    public static function animation($value)
    {
        self::$animation = $value;

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
        .html-skeleton {
            display: inline-block;
            background-color: var(--bs-secondary-bg, #e9ecef);
        }

        .html-skeleton-rounded-none {
            border-radius: 0;
        }

        .html-skeleton-rounded-sm {
            border-radius: 0.2rem;
        }

        .html-skeleton-rounded-md {
            border-radius: 0.375rem;
        }

        .html-skeleton-rounded-lg {
            border-radius: 0.75rem;
        }

        .html-skeleton-rounded-circle,
        .html-skeleton-rounded-pill {
            border-radius: 50rem;
        }

        .html-skeleton-glow {
            animation: html-skeleton-glow 1.5s ease-in-out infinite;
        }

        .html-skeleton-wave {
            position: relative;
            overflow: hidden;
        }

        .html-skeleton-wave::after {
            content: "";
            position: absolute;
            inset: 0;
            transform: translateX(-100%);
            background-image: linear-gradient(90deg, rgba(255, 255, 255, 0) 0, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0) 100%);
            animation: html-skeleton-wave 1.6s linear infinite;
        }

        @keyframes html-skeleton-glow {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        @keyframes html-skeleton-wave {
            100% {
                transform: translateX(100%);
            }
        }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? null;

        $id = self::$id ? ' id="'.self::$id.'"' : '';
        $width = self::$width ?? '100%';
        $height = self::$height ?? '1rem';
        $rounded = self::$rounded ?? 'md';
        $animation = self::$animation ?? 'glow';
        $css = self::$css ?? '';

        $animationClass = $animation === 'none' ? '' : "html-skeleton-{$animation}";

        self::$html = <<<HTML
        <span{$id} class="html-skeleton {$animationClass} html-skeleton-rounded-{$rounded} {$css}" style="width: {$width}; height: {$height};" aria-hidden="true"></span>
        HTML;
    }
}
