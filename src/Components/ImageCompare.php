<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\ImageCompare as ImageCompareTag;

class ImageCompare extends HtmlComponent
{
    public $imageA;
    public $imageB;
    public $width;
    public $height;
    public $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $imageA = null,
        $imageB = null,
        $width = null,
        $height = null,
        $color = null,
    ) {
        $this->imageA = $imageA;
        $this->imageB = $imageB;
        $this->width = $width;
        $this->height = $height;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            return ImageCompareTag::make()
                ->imageA($this->imageA)
                ->imageB($this->imageB)
                ->width($this->width)
                ->height($this->height)
                ->color($this->color)
                ->render();
        };
    }
}
