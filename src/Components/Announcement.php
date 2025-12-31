<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Announcement as AnnouncementTag;
use Grafite\Html\Components\HtmlComponent;

class Announcement extends HtmlComponent
{
    public $background = 'info';
    public $heading;
    public $dismiss;
    public $timeout;
    public $position;

    public function __construct(
        $text = null,
        $background = 'info',
        $heading = null,
        $dismiss = false,
        $timeout = 5000,
        $position = null
    ) {
        $this->text = $text;
        $this->background = $background;
        $this->heading = $heading;
        $this->dismiss = $dismiss;
        $this->timeout = $timeout;
        $this->position = $position ?? 'top';
    }

    public function render()
    {
        return AnnouncementTag::make()
            ->text($this->text)
            ->background($this->background)
            ->heading($this->heading)
            ->dismiss($this->dismiss)
            ->timeout($this->timeout)
            ->position($this->position)
            ->render();
    }
}
