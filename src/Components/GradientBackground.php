<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\GradientBackground as GradientBackgroundTag;

class GradientBackground extends HtmlComponent
{
    public $content;

    public $css;

    public $colors;

    public $direction;

    public $animate;

    public $duration;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $content = null,
        $css = null,
        $colors = null,
        $direction = null,
        $animate = null,
        $duration = null,
    ) {
        $this->content = $content;
        $this->css = $css;
        $this->colors = $colors;
        $this->direction = $direction;
        $this->animate = $animate;
        $this->duration = $duration;
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

            $tag = GradientBackgroundTag::make()
                ->content($content)
                ->css($this->css);

            if ($this->colors !== null) {
                $tag->colors($this->colors);
            }

            if ($this->direction !== null) {
                $tag->direction($this->direction);
            }

            if ($this->animate !== null) {
                $tag->animate($this->animate);
            }

            if ($this->duration !== null) {
                $tag->duration($this->duration);
            }

            return $tag->render();
        };
    }
}
