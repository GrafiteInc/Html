<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\DropdownItemButton as ButtonTag;

class DropdownItemButton extends HtmlComponent
{
    public $text;

    public $onClick;

    public function __construct(
        $text = null,
        $onClick = null,
    ) {
        $this->text = $text;
        $this->onClick = $onClick;
    }

    public function render()
    {
        return function (array $data) {
            if (empty($this->text)) {
                $this->text = (string) $data['slot'];
            }

            return ButtonTag::make()
                ->text($this->text)
                ->onClick($this->onClick)
                ->render();
        };
    }
}
