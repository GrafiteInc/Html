<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Sparkline as SparklineTag;

class Sparkline extends HtmlComponent
{
    public $data;

    public $width;

    public $height;

    public $strokeWidth;

    public $color;

    public $area;

    public $showDot;

    public $type;

    public $label;

    public function __construct(
        $data = [],
        $width = 120,
        $height = 32,
        $strokeWidth = 2,
        $color = 'primary',
        $area = false,
        $showDot = false,
        $type = 'line',
        $label = null,
        $css = null,
    ) {
        $this->data = $data;
        $this->width = $width;
        $this->height = $height;
        $this->strokeWidth = $strokeWidth;
        $this->color = $color;
        $this->area = $area;
        $this->showDot = $showDot;
        $this->type = $type;
        $this->label = $label;
        $this->css = $css;
    }

    public function render()
    {
        return SparklineTag::make()
            ->data($this->data)
            ->width($this->width)
            ->height($this->height)
            ->strokeWidth($this->strokeWidth)
            ->color($this->color)
            ->area($this->area)
            ->showDot($this->showDot)
            ->type($this->type)
            ->label($this->label)
            ->css($this->css)
            ->render();
    }
}
