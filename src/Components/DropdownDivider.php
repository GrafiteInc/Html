<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\DropdownDivider as DividerTag;

class DropdownDivider extends HtmlComponent
{
    public function render()
    {
        return function (array $data) {
            return DividerTag::make()
                ->render();
        };
    }
}
