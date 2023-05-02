<?php

namespace Grafite\Html\Components;

use Illuminate\View\Component;
use Grafite\Html\Tags\FeedItem as FeedItemTag;

class FeedItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $date = '',
        public $content = null,
        public $icon = null,
        public $color = null
    ) {
        if (is_null($icon)) {
            $this->icon = '<i class="fa fa-comment text-white"></i>';
            $this->color = 'var(--bs-primary)';
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
            if (empty($this->content)) {
                $this->content = (string) $data['slot'];
            }

            return FeedItemTag::make()
                ->icon($this->icon, $this->color)
                ->date($this->date)
                ->content($this->content)
                ->render();
        };
    }
}
