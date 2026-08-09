<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Dock;
use Tests\TestCase;

class DockTest extends TestCase
{
    protected function items()
    {
        return [
            ['label' => 'Home', 'href' => '/', 'icon' => '<i class="bi bi-house"></i>', 'active' => true],
            ['label' => 'Settings', 'href' => '/settings', 'icon' => '<i class="bi bi-gear"></i>'],
        ];
    }

    public function test_html_rendering()
    {
        $html = Dock::make()->items($this->items())->render();

        $this->assertStringContainsString('role="toolbar"', $html);
        $this->assertStringContainsString('aria-label="Application dock"', $html);
        $this->assertStringContainsString('bi-house', $html);
        $this->assertStringContainsString('bi-gear', $html);
        $this->assertStringContainsString('href="/"', $html);
        $this->assertStringContainsString('href="/settings"', $html);
    }

    public function test_active_item_gets_dot_indicator()
    {
        $html = Dock::make()->items($this->items())->render();

        $this->assertSame(1, substr_count($html, 'html-dock-item-active-dot'));
    }

    public function test_default_position_is_bottom()
    {
        $html = Dock::make()->items($this->items())->render();

        $this->assertStringContainsString('html-dock-bottom', $html);
        $this->assertStringContainsString('flex-row', $html);
    }

    public function test_vertical_position_uses_flex_column()
    {
        $html = Dock::make()->items($this->items())->position('left')->render();

        $this->assertStringContainsString('html-dock-left', $html);
        $this->assertStringContainsString('flex-column', $html);
    }

    public function test_fixed_modifier()
    {
        $html = Dock::make()->items($this->items())->fixed(true)->render();

        $this->assertStringContainsString('html-dock-fixed', $html);
    }

    public function test_js_targets_element_id_when_magnify_enabled()
    {
        $html = Dock::make()->id('main-dock')->items($this->items())->render();

        $this->assertStringContainsString('id="main-dock"', $html);

        $js = Dock::js();

        $this->assertStringContainsString("getElementById('main-dock')", $js);
    }

    public function test_no_js_when_magnify_disabled()
    {
        Dock::make()->items($this->items())->magnify(false)->render();

        $this->assertSame('', Dock::js());
    }

    public function test_no_external_scripts()
    {
        $this->assertEmpty(Dock::scripts());
        $this->assertEmpty(Dock::stylesheets());
    }
}
