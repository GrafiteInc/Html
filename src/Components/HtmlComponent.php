<?php

namespace Grafite\Html\Components;

use Illuminate\View\Component;

class HtmlComponent extends Component
{
    public $id;
    public $css;
    public $url;
    public $text;
    public $html;
    public $onClick;
    public $menuCss;
    public $items = [];
    public $attributes = [];

    public function __contruct(
        $id = null,
        $css = null,
        $url = null,
        $text = null,
        $html = null,
        $onClick = null,
        $menuCss = null,
        $items = [],
        $attributes = []
    ) {}

    public function render() {}

    protected function setDefaultProperties(
        $id,
        $css,
        $url,
        $text,
        $html,
        $onClick,
        $menuCss,
        $items,
        $attributes
    ) {
        $this->id = $id;
        $this->css = $css;
        $this->url = $url;
        $this->text = $text;
        $this->html = $html;
        $this->onClick = $onClick;
        $this->menuCss = $menuCss;
        $this->items = $items;
        $this->attributes = $attributes;
    }
}
