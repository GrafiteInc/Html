<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\Video as VideoTag;

class Video extends HtmlComponent
{
    public $type;
    public $poster;
    public $source;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $type = 'video',
        $poster = '',
        $source = ''
    ) {
        $this->type = $type;
        $this->poster = $poster;
        $this->source = $source;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            return VideoTag::make()
                ->type($this->type)
                ->poster($this->poster)
                ->source($this->source)
                ->render();
        };
    }
}
