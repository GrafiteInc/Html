<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Avatar as AvatarTag;
use Grafite\Html\Components\HtmlComponent;

class Avatar extends HtmlComponent
{
    public $image;
    public $css;

    public function __construct(
        $image,
        $css = null
    ) {
        $this->image = $image;
        $this->css = $css;
    }

    public function render()
    {
        return AvatarTag::make()
            ->image($this->image)
            ->css($this->css)
            ->render();
    }
}
