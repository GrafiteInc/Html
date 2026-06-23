<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\GridPattern as GridPatternTag;

class GridPattern extends HtmlComponent
{
    public $content;

    public $css;

    public $variant;

    public $size;

    public $color;

    public $strokeWidth;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $content = null,
        $css = null,
        $variant = null,
        $size = null,
        $color = null,
        $strokeWidth = null,
    ) {
        $this->content = $content;
        $this->css = $css;
        $this->variant = $variant;
        $this->size = $size;
        $this->color = $color;
        $this->strokeWidth = $strokeWidth;
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

            $tag = GridPatternTag::make()
                ->content($content)
                ->css($this->css);

            if ($this->variant !== null) {
                $tag->variant($this->variant);
            }

            if ($this->size !== null) {
                $tag->size($this->size);
            }

            if ($this->color !== null) {
                $tag->color($this->color);
            }

            if ($this->strokeWidth !== null) {
                $tag->strokeWidth($this->strokeWidth);
            }

            return $tag->render();
        };
    }
}
