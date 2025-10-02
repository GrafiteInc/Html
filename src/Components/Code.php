<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Code as CodeTag;
use Grafite\Html\Components\HtmlComponent;

class Code extends HtmlComponent
{
    public $body = null;
    public $language = 'php';

    public function __construct(
        $language = null,
    ) {
        $this->language = $language;
    }

    public function render()
    {
        return function (array $data) {
            if (empty($this->body)) {
                $this->body = (string) $data['slot'];
            }

            return CodeTag::make()
                ->body($this->body)
                ->language($this->language)
                ->render();
        };
    }
}
