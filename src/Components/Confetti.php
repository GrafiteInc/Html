<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Confetti as ConfettiTag;

class Confetti extends HtmlComponent
{
    public $content;

    public $css;

    public $trigger;

    public $particleCount;

    public $spread;

    public $colors;

    public $duration;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $content = null,
        $css = null,
        $trigger = null,
        $particleCount = null,
        $spread = null,
        $colors = null,
        $duration = null,
    ) {
        $this->content = $content;
        $this->css = $css;
        $this->trigger = $trigger;
        $this->particleCount = $particleCount;
        $this->spread = $spread;
        $this->colors = $colors;
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

            $tag = ConfettiTag::make()
                ->content($content)
                ->css($this->css);

            if ($this->trigger !== null) {
                $tag->trigger($this->trigger);
            }

            if ($this->particleCount !== null) {
                $tag->particleCount($this->particleCount);
            }

            if ($this->spread !== null) {
                $tag->spread($this->spread);
            }

            if ($this->colors !== null) {
                $tag->colors($this->colors);
            }

            if ($this->duration !== null) {
                $tag->duration($this->duration);
            }

            return $tag->render();
        };
    }
}
