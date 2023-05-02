<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Table as TableTag;
use Grafite\Html\Components\HtmlComponent;

class Table extends HtmlComponent
{
    public $class;
    public $collection;
    public $keys;
    public $sortable;
    public $headers;

    public function __construct(
        $class = null,
        $collection = [],
        $keys = [],
        $sortable = null,
        $headers = []
    ) {
        $this->class = $class;
        $this->collection = is_array($collection) ? collect($collection) : $collection;
        $this->keys = $keys;
        $this->sortable = $sortable;
        $this->headers = $headers;
    }

    public function render()
    {
        return TableTag::make()
            ->css($this->class)
            ->collection($this->collection)
            ->keys($this->keys)
            ->sortable($this->sortable)
            ->headers($this->headers)
            ->render();
    }
}
