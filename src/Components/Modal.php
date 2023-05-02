<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Modal as ModalTag;
use Grafite\Html\Components\HtmlComponent;

class Modal extends HtmlComponent
{
    public $id;
    public $title;
    public $content;
    public $footer;
    public $dismiss;
    public $static;

    public function __construct(
        $id = null,
        $title = null,
        $content = null,
        $footer = null,
        $dismiss = false,
        $static = false
    ) {
    $this->id = $id;
    $this->title = $title;
    $this->content = $content;
    $this->footer = $footer;
    $this->dismiss = $dismiss;
    $this->static = $static;
    }

    public function render()
    {
        return function (array $data) {
            if (empty($this->content)) {
                $this->content = (string) $data['slot'];
            }

            $modal =  ModalTag::make()
                ->id($this->id)
                ->content($this->content)
                ->title($this->title)
                ->footer($this->footer);

            if ($this->dismiss) {
                $modal = $modal->dismiss();
            }

            if ($this->static) {
                $modal = $modal->isStatic();
            }

            return $modal->render();
        };
    }
}
