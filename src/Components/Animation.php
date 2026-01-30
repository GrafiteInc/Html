<?php

namespace Grafite\Html\Components;

use Illuminate\Support\Str;

class Animation extends HtmlComponent
{
    public $component;

    public function __construct($component = null)
    {
        $this->component = $component;
    }

    public function render()
    {
        $component = Str::of($this->component)->title();

        if (! in_array($component, ['Hamster', 'Pulse', 'Spaceman', 'Typewriter'])) {
            throw new \Exception('Invalid animation.', 1);
        }

        return app("\Grafite\Html\Tags\Animations\\{$component}")->render();
    }
}
