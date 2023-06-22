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

    public function __construct(
        $text = null,
        $background = 'info',
        $heading = null,
        $dismiss = false,
        $timeout = 5000
    ) {
        $this->text = $text;
        $this->background = $background;
        $this->heading = $heading;
        $this->dismiss = $dismiss;
        $this->timeout = $timeout;
    }

    public function render()
    {
        return AnnouncementTag::make()
            ->text($this->text)
            ->background($this->background)
            ->heading($this->heading)
            ->dismiss($this->dismiss)
            ->timeout($this->timeout)
            ->render();
    }
}
