<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Breadcrumbs extends HtmlComponent
{
    public static function process()
    {
        $steps = self::processLinks(self::$items);


        self::$html = <<<html
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                $steps
            </ol>
        </nav>
html;
    }

    public static function processLinks($links)
    {
        $steps = '';
        $active = '';

        foreach ($links as $title => $link) {
            if (request()->url() === $link) {
                $active = 'active';
            }

            $steps .= "<li class=\"breadcrumb-item${active}\"><a href=\"{$link}\">{$title}</a></li>\n";
        }

        return $steps;
    }
}
