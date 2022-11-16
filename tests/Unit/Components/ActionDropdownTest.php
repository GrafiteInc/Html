<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class ActionDropdownTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-action-dropdown>
            <x-html-dropdown-item-button onClick=\"console.log()\">Test</x-html-dropdown-item-button>
            <x-html-dropdown-item-button onClick=\"console.warning()\">Big</x-html-dropdown-item-button>
        </x-html-action-dropdown>";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('Test', $blade);
        $this->assertStringContainsString('Big', $blade);
    }

    public function testHtmlRenderingWithActions()
    {
        $template = '<x-html-action-dropdown :actions="[\'cool\', \'stuff\']"></x-html-action-dropdown>';

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('cool', $blade);
        $this->assertStringContainsString('stuff', $blade);
    }
}
