<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Image as ImageTag;
use Grafite\Html\Components\HtmlComponent;

class Image extends HtmlComponent
{
    public $thumbnail = false;
    public $fluid = false;
    public $css = '';
    public $alt = '';
    public $source;

    public function __construct(
        $thumbnail = false,
        $fluid = false,
        $css = '',
        $alt = '',
        $source = null,
    ) {
        $this->thumbnail = $thumbnail;
        $this->fluid = $fluid;
        $this->css = $css;
        $this->alt = $alt;
        $this->source = $source;
    }

    public function render()
    {
        $image = ImageTag::make()
            ->css($this->css)
            ->alt($this->alt)
            ->source($this->source);

        if ($this->fluid) {
            $image = $image->fluid();
        }

        if ($this->thumbnail) {
            $image = $image->thumbnail();
        }

        return $image->render();
    }
}