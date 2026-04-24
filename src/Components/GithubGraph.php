<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\GithubGraph as GithubGraphTag;

class GithubGraph extends HtmlComponent
{
    public $eventType;

    public $title;

    public $events;

    public $colors;

    public $linkUrl;

    public $linkTitle;

    public $linkTarget;

    public $enablePastEntries;

    public $localStoragePrefix;

    public $remoteStorageUrl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $eventType = 'gradient',
        $title = null,
        $events = null,
        $colors = null,
        $linkUrl = null,
        $linkTitle = null,
        $linkTarget = null,
        $enablePastEntries = true,
        $localStoragePrefix = null,
        $remoteStorageUrl = null,
    ) {
        $this->eventType = $eventType;
        $this->title = $title;
        $this->events = $events;
        $this->colors = $colors;
        $this->linkUrl = $linkUrl;
        $this->linkTitle = $linkTitle;
        $this->linkTarget = $linkTarget;
        $this->enablePastEntries = $enablePastEntries;
        $this->localStoragePrefix = $localStoragePrefix;
        $this->remoteStorageUrl = $remoteStorageUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            $tag = GithubGraphTag::make()
                ->eventType($this->eventType)
                ->enablePastEntries($this->enablePastEntries);

            if ($this->title !== null) {
                $tag->title($this->title);
            }

            if ($this->events !== null) {
                $tag->events($this->events);
            }

            if ($this->colors !== null) {
                $tag->colors($this->colors);
            }

            if ($this->linkUrl !== null) {
                $tag->linkUrl($this->linkUrl);
            }

            if ($this->linkTitle !== null) {
                $tag->linkTitle($this->linkTitle);
            }

            if ($this->linkTarget !== null) {
                $tag->linkTarget($this->linkTarget);
            }

            if ($this->localStoragePrefix !== null) {
                $tag->localStoragePrefix($this->localStoragePrefix);
            }

            if ($this->remoteStorageUrl !== null) {
                $tag->remoteStorageUrl($this->remoteStorageUrl);
            }

            return $tag->render();
        };
    }
}
