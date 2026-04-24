<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Hero as HeroTag;

class Hero extends HtmlComponent
{
    public $content;

    public $effect;

    public $color;

    public $backgroundColor;

    public $mouseControls;

    public $touchControls;

    public $gyroControls;

    public $minHeight;

    public $minWidth;

    public $scale;

    public $scaleMobile;

    public $speed;

    public $zoom;

    public $options;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $content = null,
        $effect = 'waves',
        $color = null,
        $backgroundColor = null,
        $mouseControls = true,
        $touchControls = true,
        $gyroControls = false,
        $minHeight = '400px',
        $minWidth = null,
        $scale = 1.0,
        $scaleMobile = 1.0,
        $speed = 1.0,
        $zoom = 1.0,
        $options = [],
    ) {
        $this->content = $content;
        $this->effect = $effect;
        $this->color = $color;
        $this->backgroundColor = $backgroundColor;
        $this->mouseControls = $mouseControls;
        $this->touchControls = $touchControls;
        $this->gyroControls = $gyroControls;
        $this->minHeight = $minHeight;
        $this->minWidth = $minWidth;
        $this->scale = $scale;
        $this->scaleMobile = $scaleMobile;
        $this->speed = $speed;
        $this->zoom = $zoom;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            $content = $this->content;

            if (! $content) {
                $content = (string) $data['slot'];
            }

            $tag = HeroTag::make()
                ->content($content)
                ->effect($this->effect)
                ->mouseControls($this->mouseControls)
                ->touchControls($this->touchControls)
                ->gyroControls($this->gyroControls)
                ->minHeight($this->minHeight)
                ->scale($this->scale)
                ->scaleMobile($this->scaleMobile)
                ->speed($this->speed)
                ->zoom($this->zoom)
                ->options($this->options);

            if ($this->color !== null) {
                $tag->color($this->color);
            }

            if ($this->backgroundColor !== null) {
                $tag->backgroundColor($this->backgroundColor);
            }

            if ($this->minWidth !== null) {
                $tag->minWidth($this->minWidth);
            }

            return $tag->render();
        };
    }
}
