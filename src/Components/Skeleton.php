<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Skeleton as SkeletonTag;

class Skeleton extends HtmlComponent
{
    public $width;

    public $height;

    public $rounded;

    public $animation;

    public function __construct(
        $width = null,
        $height = null,
        $rounded = null,
        $animation = null,
        $css = null,
    ) {
        $this->width = $width;
        $this->height = $height;
        $this->rounded = $rounded;
        $this->animation = $animation;
        $this->css = $css;
    }

    public function render()
    {
        return SkeletonTag::make()
            ->width($this->width)
            ->height($this->height)
            ->rounded($this->rounded)
            ->animation($this->animation)
            ->css($this->css)
            ->render();
    }
}
