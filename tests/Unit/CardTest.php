<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Card;

class CardTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = Card::make()->body('Welcome to our awesome website.')->render();
        $this->assertStringContainsString('Welcome to our awesome website', $html);

        $html = Card::make()->header('Welcome')->body('Welcome to our awesome website.')->render();
        $this->assertStringContainsString('card-header', $html);

        $html = Card::make()->image('/images/cool.jpg', 'more')->body('Check out this amazing offer.')->render();
        $this->assertStringContainsString('<img src="/images/cool.jpg" class="card-img-top" alt="more">', $html);
        $this->assertStringContainsString('Check out this amazing offer.', $html);

        $html = Card::make()->title('Welcome')->body('Welcome to our awesome website.')->render();
        $this->assertStringContainsString('card-title', $html);
    }
}
