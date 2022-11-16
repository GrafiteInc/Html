<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class AvatarTest extends ComponentTestCase
{
    public function testHtmlRendering()
    {
        $template = "<x-html-avatar image='https://i.picsum.photos/id/464/200/300.jpg?hmac=M4MNTPYELJRy0vZcT-h-EWmXkPdnXHvF9ufEPkhDt2g' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('html-component-avatar', $blade);
    }
}
