<?php

namespace Tests\Unit\Components;

use Tests\ComponentTestCase;

class ImageTest extends ComponentTestCase
{
    public function test_html_rendering()
    {
        $template = "<x-html-image with-placeholder source='https://somewhere.com/picture.jpg' fluid thumbnail alt='What!' />";

        $blade = (string) $this->blade($template);

        $this->assertStringContainsString('<img  class="img-thumbnail img-fluid" src="https://somewhere.com/picture.jpg"', $blade);
        $this->assertStringContainsString('img-thumbnail img-fluid', $blade);
        $this->assertStringContainsString('What!', $blade);
    }
}
