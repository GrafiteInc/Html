<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Avatar;

class AvatarTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = Avatar::make()->image('https://i.picsum.photos/id/464/200/300.jpg?hmac=M4MNTPYELJRy0vZcT-h-EWmXkPdnXHvF9ufEPkhDt2g')->render();
        $this->assertStringContainsString('avatar', $html);
    }
}
