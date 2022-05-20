<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Alert as AlertTag;
use Grafite\Html\Components\HtmlComponent;

class Alert extends HtmlComponent
{
    public $background = 'info';
    public $heading;
    public $dismiss;

    public function __construct(
        $text = null,
        $background = 'info',
        $heading = null,
        $dismiss = false
    ) {
        $this->text = $text;
        $this->background = $background;
        $this->heading = $heading;
        $this->dismiss = $dismiss;
    }

    public function render()
    {
        return AlertTag::make()
            ->text($this->text)
            ->background($this->background)
            ->heading($this->heading)
            ->dismiss($this->dismiss)
            ->render();
    }
}
