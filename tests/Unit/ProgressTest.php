<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Progress;

class ProgressTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = Progress::make()
            ->now(50)
            ->min(10)
            ->max(120)
            ->render();

        $this->assertStringContainsString('<div class="progress-bar " role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="10" aria-valuemax="120"></div>', $html);
    }
}
