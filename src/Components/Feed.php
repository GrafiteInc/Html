<?php

namespace Grafite\Html\Components;

use Illuminate\View\Component;
use Grafite\Html\Tags\FeedItem;
use Grafite\Html\Tags\Feed as FeedTag;

class Feed extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $items = [],
        public $icon = null,
        public $color = null
    ) {
        if (is_null($icon)) {
            $this->icon = '<i class="fas fa-comment text-white"></i>';
            $this->icon = 'var(--bs-primary)';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            $items = $this->processItems();

            if (empty($items)) {
                $items = [(string) $data['slot']];
            }

            return FeedTag::make()->items($items)->render();
        };
    }

    public function processItems()
    {
        $items = [];

        foreach (array_reverse($this->items) as $key => $value) {
            $items[] = FeedItem::make()
                ->date("{$key}")
                ->content("{$value}")
                ->icon($this->icon, $this->color)
                ->render();
        }

        return $items;
    }
}
