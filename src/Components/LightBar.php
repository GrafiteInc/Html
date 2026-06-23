<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\LightBar as LightBarTag;

class LightBar extends HtmlComponent
{
    public $content;

    public $css;

    public $color;

    public $position;

    public $height;

    public $blur;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $content = null,
        $css = null,
        $color = null,
        $position = null,
        $height = null,
        $blur = null,
    ) {
        $this->content = $content;
        $this->css = $css;
        $this->color = $color;
        $this->position = $position;
        $this->height = $height;
        $this->blur = $blur;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            $content = $this->content ?? $data['slot'] ?? '';

            $tag = LightBarTag::make()
                ->content($content)
                ->css($this->css);

            if ($this->color !== null) {
                $tag->color($this->color);
            }

            if ($this->position !== null) {
                $tag->position($this->position);
            }

            if ($this->height !== null) {
                $tag->height($this->height);
            }

            if ($this->blur !== null) {
                $tag->blur($this->blur);
            }

            return $tag->render();
        };
    }
}
