<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\MagneticButton as MagneticButtonTag;

class MagneticButton extends HtmlComponent
{
    public $content;

    public $css;

    public $url;

    public $strength;

    public $radius;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $content = null,
        $css = null,
        $url = null,
        $strength = null,
        $radius = null,
    ) {
        $this->content = $content;
        $this->css = $css;
        $this->url = $url;
        $this->strength = $strength;
        $this->radius = $radius;
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

            $tag = MagneticButtonTag::make()
                ->content($content)
                ->css($this->css);

            if ($this->url !== null) {
                $tag->url($this->url);
            }

            if ($this->strength !== null) {
                $tag->strength($this->strength);
            }

            if ($this->radius !== null) {
                $tag->radius($this->radius);
            }

            return $tag->render();
        };
    }
}
