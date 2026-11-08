<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Lottie;
use Tests\TestCase;

class LottieTest extends TestCase
{
    protected $cwd;

    protected $sandbox;

    protected function setUp(): void
    {
        parent::setUp();

        // Lottie::js() reads icons relative to the app's public directory.
        $this->cwd = getcwd();
        $this->sandbox = sys_get_temp_dir().'/grafite-lottie-'.uniqid();

        mkdir($this->sandbox.'/public', 0777, true);
        mkdir($this->sandbox.'/vendor/grafite/html', 0777, true);
        symlink(realpath(__DIR__.'/../../images'), $this->sandbox.'/vendor/grafite/html/images');

        chdir($this->sandbox.'/public');
    }

    protected function tearDown(): void
    {
        chdir($this->cwd);

        unlink($this->sandbox.'/vendor/grafite/html/images');
        rmdir($this->sandbox.'/vendor/grafite/html');
        rmdir($this->sandbox.'/vendor/grafite');
        rmdir($this->sandbox.'/vendor');
        rmdir($this->sandbox.'/public');
        rmdir($this->sandbox);

        parent::tearDown();
    }

    public function test_styles_do_not_force_a_stroke_width()
    {
        Lottie::make()->icon('bell')->stroke(4)->color('red');
        Lottie::$id = 'icon';

        $css = Lottie::styles();

        $this->assertStringNotContainsString('stroke-width', $css);
        $this->assertStringContainsString('#icon svg g path[stroke-linecap]', $css);
        $this->assertStringContainsString('#icon svg g path:not([stroke-linecap])', $css);
        $this->assertStringContainsString('stroke: red;', $css);
        $this->assertStringContainsString('fill: red;', $css);
    }

    public function test_js_scales_strokes_to_the_given_width()
    {
        Lottie::make()->icon('bell')->stroke(4);
        Lottie::$id = 'icon';

        $js = Lottie::js();

        $this->assertStringContainsString('var animationData = {', $js);
        $this->assertStringContainsString('})(animationData, 4, svgContainer);', $js);
        $this->assertStringContainsString('animationData: animationData', $js);
    }

    public function test_js_defaults_stroke_to_three_pixels()
    {
        Lottie::make()->icon('bell');
        Lottie::$id = 'icon';

        $this->assertStringContainsString('})(animationData, 3, svgContainer);', Lottie::js());
    }

    public function test_html_rendering()
    {
        $html = Lottie::make()->icon('bell')->speed(2)->attributes(['id' => 'icon'])->render();

        $this->assertStringContainsString('id="icon"', $html);
        $this->assertStringContainsString('data-speed="2"', $html);
    }
}
