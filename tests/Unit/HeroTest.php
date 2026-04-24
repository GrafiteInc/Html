<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Hero;
use InvalidArgumentException;
use Tests\TestCase;

class HeroTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Hero::make()
            ->content('<h1>Welcome</h1>')
            ->render();

        $this->assertStringContainsString('hero-vanta', $html);
        $this->assertStringContainsString('hero-content', $html);
        $this->assertStringContainsString('<h1>Welcome</h1>', $html);
    }

    public function test_default_effect_is_waves()
    {
        $hero = Hero::make()
            ->content('Hello');

        $scripts = Hero::scripts();

        $this->assertContains('//cdn.jsdelivr.net/npm/vanta/dist/vanta.waves.min.js', $scripts);
        $this->assertContains('//cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js', $scripts);
    }

    public function test_effect_birds()
    {
        Hero::make()
            ->effect('birds')
            ->content('Hello');

        $scripts = Hero::scripts();
        $js = Hero::js();

        $this->assertContains('//cdn.jsdelivr.net/npm/vanta/dist/vanta.birds.min.js', $scripts);
        $this->assertStringContainsString('VANTA.BIRDS', $js);
    }

    public function test_effect_fog()
    {
        Hero::make()
            ->effect('fog')
            ->content('Hello');

        $scripts = Hero::scripts();
        $js = Hero::js();

        $this->assertContains('//cdn.jsdelivr.net/npm/vanta/dist/vanta.fog.min.js', $scripts);
        $this->assertStringContainsString('VANTA.FOG', $js);
    }

    public function test_p5_effect_trunk()
    {
        Hero::make()
            ->effect('trunk')
            ->content('Hello');

        $scripts = Hero::scripts();

        $this->assertContains('//cdnjs.cloudflare.com/ajax/libs/p5.js/1.9.0/p5.min.js', $scripts);
        $this->assertContains('//cdn.jsdelivr.net/npm/vanta/dist/vanta.trunk.min.js', $scripts);
    }

    public function test_p5_effect_topology()
    {
        Hero::make()
            ->effect('topology')
            ->content('Hello');

        $scripts = Hero::scripts();

        $this->assertContains('//cdnjs.cloudflare.com/ajax/libs/p5.js/1.9.0/p5.min.js', $scripts);
        $this->assertContains('//cdn.jsdelivr.net/npm/vanta/dist/vanta.topology.min.js', $scripts);
    }

    public function test_invalid_effect_throws_exception()
    {
        $this->expectException(InvalidArgumentException::class);

        Hero::make()->effect('invalid');
    }

    public function test_all_allowed_effects()
    {
        $effects = ['birds', 'fog', 'waves', 'clouds', 'clouds2', 'globe', 'net', 'cells', 'trunk', 'topology', 'dots', 'rings', 'halo'];

        foreach ($effects as $effect) {
            $hero = Hero::make()->effect($effect)->content('Test');
            $scripts = Hero::scripts();

            $this->assertContains(
                '//cdn.jsdelivr.net/npm/vanta/dist/vanta.'.$effect.'.min.js',
                $scripts,
                "Script for effect [{$effect}] not found"
            );
        }
    }

    public function test_color_options()
    {
        Hero::make()
            ->effect('waves')
            ->color('0xff0000')
            ->backgroundColor('0x000000')
            ->content('Hello')
            ->render();

        $js = Hero::js();

        $this->assertStringContainsString('0xff0000', $js);
        $this->assertStringContainsString('0x000000', $js);
    }

    public function test_interaction_controls()
    {
        Hero::make()
            ->mouseControls(false)
            ->touchControls(false)
            ->gyroControls(true)
            ->content('Hello')
            ->render();

        $js = Hero::js();

        $this->assertStringContainsString('"mouseControls":false', $js);
        $this->assertStringContainsString('"touchControls":false', $js);
        $this->assertStringContainsString('"gyroControls":true', $js);
    }

    public function test_min_height_style()
    {
        Hero::make()
            ->minHeight('600px')
            ->content('Hello')
            ->render();

        $styles = Hero::styles();

        $this->assertStringContainsString('min-height: 600px', $styles);
    }

    public function test_speed_and_zoom()
    {
        Hero::make()
            ->speed(2.0)
            ->zoom(0.5)
            ->content('Hello')
            ->render();

        $js = Hero::js();

        $this->assertStringContainsString('"speed":2', $js);
        $this->assertStringContainsString('"zoom":0.5', $js);
    }

    public function test_custom_options()
    {
        Hero::make()
            ->effect('waves')
            ->options(['waveHeight' => 20, 'shininess' => 50])
            ->content('Hello')
            ->render();

        $js = Hero::js();

        $this->assertStringContainsString('"waveHeight":20', $js);
        $this->assertStringContainsString('"shininess":50', $js);
    }

    public function test_effect_is_case_insensitive()
    {
        $hero = Hero::make()->effect('BIRDS')->content('Test');

        $scripts = Hero::scripts();

        $this->assertContains('//cdn.jsdelivr.net/npm/vanta/dist/vanta.birds.min.js', $scripts);
    }
}
