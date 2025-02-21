<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\Lottie as LottieTag;

class Lottie extends HtmlComponent
{
    public $icon;
    public $image;
    public $trigger;
    public $speed;
    public $color;
    public $stroke;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $icon = null,
        $image = null,
        $trigger = null,
        $color = null,
        $stroke = null,
        $speed = null
    ) {
        $this->icon = $icon;
        $this->image = $image;
        $this->trigger = $trigger;
        $this->speed = $speed;
        $this->color = $color;
        $this->stroke = $stroke;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            return LottieTag::make()
                ->image($this->image)
                ->icon($this->icon)
                ->trigger($this->trigger)
                ->speed($this->speed)
                ->color($this->color)
                ->stroke($this->stroke)
                ->render();
        };
    }
}
