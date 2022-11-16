<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\DropdownItemButton as ButtonTag;
use Grafite\Html\Components\HtmlComponent;

class DropdownItemButton extends HtmlComponent
{
    public $onClick;

    public function __construct(
        $onClick
    ) {
        $this->onClick = $onClick;
    }

    public function render()
    {
        return function (array $data) {
            $this->text = $data['slot'];

            return ButtonTag::make()
                ->text($this->text)
                ->onClick($this->onClick)
                ->render();
        };
    }
}
