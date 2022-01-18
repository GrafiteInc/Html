<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class ListGroup extends HtmlComponent
{
    public static function process()
    {
        $links = self::processLinks(self::$items);

        self::$html = <<<html
        <div class="list-group">
            $links
        </div>
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

            $steps .= "<a href=\"${link}\" class=\"list-group-item list-group-item-action${active}\">${title}</a>\n";
        }

        return $steps;
    }
}
