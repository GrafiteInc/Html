<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Badge as BadgeTag;
use Grafite\Html\Components\HtmlComponent;

class Badge extends HtmlComponent
{
    public $name;
    public $status;
    public $color;
    public $theme;

    public function __construct(
        $name,
        $status = null,
        $color = null,
        $theme = null,
    ) {
        $this->name = $name;
        $this->status = $status;
        $this->color = $color;
        $this->theme = $theme;
    }

    public function render()
    {
        return BadgeTag::make()
            ->name($this->name)
            ->status($this->status)
            ->color($this->color)
            ->theme($this->theme)
            ->render();
    }
}
