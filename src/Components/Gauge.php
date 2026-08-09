<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Gauge as GaugeTag;

class Gauge extends HtmlComponent
{
    public $value;

    public $min;

    public $max;

    public $size;

    public $thickness;

    public $color;

    public $label;

    public $unit;

    public $showValue;

    public $thresholds;

    public function __construct(
        $value = 0,
        $min = 0,
        $max = 100,
        $size = 'md',
        $thickness = null,
        $color = 'primary',
        $label = null,
        $unit = null,
        $showValue = true,
        $thresholds = [],
        $css = null,
    ) {
        $this->value = $value;
        $this->min = $min;
        $this->max = $max;
        $this->size = $size;
        $this->thickness = $thickness;
        $this->color = $color;
        $this->label = $label;
        $this->unit = $unit;
        $this->showValue = $showValue;
        $this->thresholds = $thresholds;
        $this->css = $css;
    }

    public function render()
    {
        return GaugeTag::make()
            ->value($this->value)
            ->min($this->min)
            ->max($this->max)
            ->size($this->size)
            ->thickness($this->thickness)
            ->color($this->color)
            ->label($this->label)
            ->unit($this->unit)
            ->showValue($this->showValue)
            ->thresholds($this->thresholds)
            ->css($this->css)
            ->render();
    }
}
