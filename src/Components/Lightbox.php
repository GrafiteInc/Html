<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\Lightbox as LightboxTag;

class Lightbox extends HtmlComponent
{
    public $gallery;
    public $css;
    public $images = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $gallery = null,
        $images = null,
        $css = null,
    ) {
        $this->gallery = $gallery;
        $this->images = $images;
        $this->css = $css;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            return LightboxTag::make()
                ->items($this->images)
                ->thumbnailCss($this->css)
                ->gallery($this->gallery)
                ->render();
        };
    }
}
