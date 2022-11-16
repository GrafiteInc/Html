<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\Breadcrumbs as BreadcrumbsTag;

class Breadcrumbs extends HtmlComponent
{
    public $links;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($links)
    {
        $this->links = $links;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->links = array_filter($this->links);

        return BreadcrumbsTag::make()->items($this->links)->render();
    }
}
