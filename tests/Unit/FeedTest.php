<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Feed;
use Grafite\Html\Tags\FeedItem;

class FeedTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = Feed::make()->items([
            FeedItem::make()->content('What a big event<br>Cannot believe how big a moment it was')->icon('<i class="fas fa-address-book"></i>', 'var(--bs-success)')->render(),
            FeedItem::make()->content('What a big event<br>Cannot believe how big a moment it was')->icon('<i class="fas fa-pencil-alt"></i>', 'var(--bs-danger)')->render(),
            FeedItem::make()->content('<p>We noticed a serious issue.</p>')->date('May 8, 2020')->icon('<i class="fas fa-exclamation-triangle"></i>', 'var(--bs-warning)')->render(),
        ])->render();

        $this->assertStringContainsString('<i class="fas fa-address-book"></i>', $html);
        $this->assertStringContainsString('background-color: var(--bs-warning);', $html);
        $this->assertStringContainsString('html-component-activity-feed', $html);
        $this->assertStringContainsString('feed-item', $html);
    }
}
