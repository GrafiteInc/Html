<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class CompilerTest extends ComponentTestCase
{
    public function testPlural()
    {
        $template = "@plural('banana')";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('bananas', $blade);
    }

    public function testSingular()
    {
        $template = "@singular('bananas')";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('banana', $blade);
    }

    public function testTitle()
    {
        $template = "@title('bananas_are_handy')";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('Bananas Are Handy', $blade);
    }

    public function testHeadline()
    {
        $template = "@headline('bananas_are_handy')";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('Bananas Are Handy', $blade);
    }

    public function testLimit()
    {
        $template = "@limit('bananas_are_handy dont you agreee with me on this topic and overall I think we have many options')";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('bananas are handy dont you agreee with m...', $blade);
    }
}
