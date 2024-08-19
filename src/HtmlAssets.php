<?php

namespace Grafite\Html;

use MatthiasMullie\Minify\JS;
use MatthiasMullie\Minify\CSS;

class HtmlAssets
{
    public $stylesheets = [];

    public $scripts = [];

    public $styles = [];

    public $js = [];

    /**
     * Render the form assets
     *
     * @return string
     */
    public function render($type = 'all', $nonce = false)
    {
        $output = '';

        $output .= $this->compileStyles($type, $nonce);
        $output .= $this->compileScripts($type, $nonce);

        return $output;
    }

    /**
     * Add field stylesheets to a form
     *
     * @param array $stylesheets
     * @return self
     */
    public function addStylesheets($stylesheets)
    {
        foreach ($stylesheets as $sheet) {
            $this->stylesheets[] = '<link href="' . $sheet . '" rel="stylesheet">';
        }

        return $this;
    }

    /**
     * Add field scripts to a form
     *
     * @param array $scripts
     * @return self
     */
    public function addScripts($scripts)
    {
        foreach ($scripts as $script => $scriptType) {
            $type = 'type="module"';

            if ($scriptType === 'global') {
                $type = '';
            }

            $this->scripts[] = '<script '.$type.' src="' . $script . '"></script>';
        }

        return $this;
    }

    /**
     * Add field Styles code to a form
     *
     * @param string $styles
     * @return self
     */
    public function addStyles($styles)
    {
        if (! is_null($styles)) {
            $this->styles[] = $styles;
        }

        return $this;
    }

    /**
     * Add field JS code to a form
     *
     * @param string $js
     * @return self
     */
    public function addJs($js)
    {
        if (! is_null($js)) {
            $this->js[] = $js;
        }

        return $this;
    }

    protected function compileStyles($type, $nonce)
    {
        $nonce = $nonce ? ' nonce="' . $nonce . '"' : '';
        $output = '';

        if (in_array($type, ['all', 'styles'])) {
            $output .= collect($this->stylesheets)->unique()->implode("\n");
            $styles = collect($this->styles)->unique()->implode("\n");

            if (app()->environment('production')) {
                $minifierCSS = new CSS();
                $styles = $minifierCSS->add($styles)->minify();
            }

            $output .= "<!-- Html Styles -->\n<style {$nonce}>\n{$styles}\n</style>\n";
        }

        return $output;
    }

    protected function compileScripts($type, $nonce)
    {
        $nonce = $nonce ? ' nonce="' . $nonce . '"' : '';
        $output = '';

        if (in_array($type, ['all', 'scripts'])) {
            $output .= collect($this->scripts)->unique()->implode("\n");
            $js = collect($this->js)->unique()->implode("\n");

            if (app()->environment('production')) {
                $minifierJS = new JS();
                $js = $minifierJS->add($js)->minify();
            }

            $function = "window.HtmlJS = () => { {$js} }";

            $output .= "<!-- Html Scripts -->\n<script type=\"module\" {$nonce}>\n{$function}\nwindow.HtmlJS();\n</script>\n";
        }

        return $output;
    }
}
