<?php

namespace Tests\Unit;

use Grafite\Html\Tags\Avatar;
use Tests\TestCase;

class AvatarTest extends TestCase
{
    public function test_html_rendering()
    {
        $html = Avatar::make()->image('https://i.picsum.photos/id/464/200/300.jpg?hmac=M4MNTPYELJRy0vZcT-h-EWmXkPdnXHvF9ufEPkhDt2g')->render();
        $this->assertStringContainsString('avatar', $html);
    }
}
