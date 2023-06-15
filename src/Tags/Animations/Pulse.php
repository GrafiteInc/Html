<?php

namespace Grafite\Html\Tags\Animations;

use Grafite\Html\Tags\HtmlComponent;

class Pulse extends HtmlComponent
{
    public static function styles()
    {
        return <<<CSS
            .pulse-loading svg polyline {
                fill: none;
                stroke-width: 3;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .pulse-loading svg polyline#back {
                fill: none;
                stroke: #ff4d5033;
            }

            .pulse-loading svg polyline#front {
                fill: none;
                stroke: #ff4d4f;
                stroke-dasharray: 48, 144;
                stroke-dashoffset: 192;
                animation: dash_682 1.4s linear infinite;
            }

            @keyframes dash_682 {
                72.5% {
                    opacity: 0;
                }

                to {
                    stroke-dashoffset: 0;
                }
            }
        CSS;
    }

    public static function process()
    {
        self::$html = <<<HTML
            <div class="pulse-loading">
            <svg width="64px" height="48px">
                <polyline points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24" id="back"></polyline>
                <polyline points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24" id="front"></polyline>
            </svg>
            </div>
        HTML;
    }
}
