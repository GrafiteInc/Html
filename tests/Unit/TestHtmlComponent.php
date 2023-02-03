<?php

namespace Tests\Unit;

use Grafite\Html\Tags\HtmlTagComponent;

class TestHtmlComponent extends HtmlTagComponent
{
    public static function template()
    {
        return view('test-element')->render();
    }

    public static function styles()
    {
        return <<<styles
            .html-component-overlay {
                display: none;
            }
        styles;
    }

    public static function js()
    {
        return <<<scripts
            window.showOverlay = () => {
                console.log('overlay-function');
            }
        scripts;
    }
}
