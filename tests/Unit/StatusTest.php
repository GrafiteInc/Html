<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Status;
use Tests\TestCase;

class StatusTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Status::make()
            ->color('green')
            ->render();

        $this->assertStringContainsString('badge', $html);
        $this->assertStringContainsString('bmx-bg-green', $html);
        $this->assertStringContainsString('rounded-circle', $html);
    }

    public function test_custom_color()
    {
        $html = Status::make()
            ->color('red')
            ->render();

        $this->assertStringContainsString('bmx-bg-red', $html);
        $this->assertStringContainsString('bmx-outline-red', $html);
    }

    public function test_thickness()
    {
        $html = Status::make()
            ->color('blue')
            ->thickness('4')
            ->render();

        $this->assertStringContainsString('bmx-outline-4', $html);
    }

    public function test_style()
    {
        $html = Status::make()
            ->color('green')
            ->style('dashed')
            ->render();

        $this->assertStringContainsString('bmx-outline-dashed', $html);
    }

    public function test_offset()
    {
        $html = Status::make()
            ->color('green')
            ->offset('4')
            ->render();

        $this->assertStringContainsString('bmx-outline-offset-4', $html);
    }

    public function test_default_values()
    {
        $html = Status::make()->render();

        $this->assertStringContainsString('bmx-bg-green', $html);
        $this->assertStringContainsString('bmx-outline-2', $html);
        $this->assertStringContainsString('bmx-outline-offset-2', $html);
        $this->assertStringContainsString('bmx-outline-solid', $html);
    }
}
