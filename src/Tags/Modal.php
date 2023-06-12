<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class Modal extends HtmlComponent
{
    public static $title;
    public static $content;
    public static $footer;
    public static $dismiss;
    public static $isStatic;

    public static function content($value)
    {
        self::$content = $value;

        return new static();
    }

    public static function isStatic()
    {
        self::$isStatic = true;

        return new static();
    }

    public static function footer($value)
    {
        self::$footer = $value;

        return new static();
    }

    public static function title($value)
    {
        self::$title = $value;

        return new static();
    }

    public static function dismiss()
    {
        self::$dismiss = true;

        return new static();
    }

    public static function process()
    {
        $header = '';
        $footerContent = '';
        $close = '';
        $css = self::$css ?? '';
        $text = self::$text ?? '';
        $content = self::$content ?? '';
        $static = (self::$isStatic) ? 'data-backdrop="static" data-bs-backdrop="static"' : '';
        $id = self::$id ?? 'html_component_modal_' . Str::uuid();

        if (self::usingBootstrap5()) {
            // $class = "bg-{$bg}";
        }

        if ($title = self::$title) {
            $header = "<h5 class=\"modal-title\" id=\"{$id}Label\">{$title}</h5>";
        }

        if (self::$dismiss) {
            $close = '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

            if (self::usingBootstrap5()) {
                $close = '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            }
        }

        if ($footer = self::$footer) {
            $footerContent = "<div class=\"modal-footer\">{$footer}</div>";
        }

        self::$html =  <<<html
<button type="button" class="btn {$css}" data-toggle="modal" data-target="#{$id}" data-bs-toggle="modal" data-bs-target="#{$id}">
  $text
</button>

<div class="modal fade" id="{$id}" data-keyboard="false" $static data-bs-keyboard="false" tabindex="-1" aria-labelledby="{$id}Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        {$header}
        {$close}
      </div>
      <div class="modal-body">
        {$content}
      </div>
      {$footerContent}
    </div>
  </div>
</div>
html;
    }
}
