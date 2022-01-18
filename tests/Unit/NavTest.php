<?php

namespace Tests\Unit;

use Tests\TestCase;
use Grafite\Html\Tags\Nav;
use Grafite\Html\Tags\NavLink;
use Grafite\Html\Tags\NavButton;
use Grafite\Html\Tags\NavDropdown;
use Grafite\Html\Tags\DropdownItem;
use Grafite\Html\Tags\DropdownDivider;
use Grafite\Html\Tags\DropdownItemButton;

class NavTest extends TestCase
{
    public function testHtmlRendering()
    {
        $html = Nav::make()->items([
            NavLink::make()
                ->text('Nav Link Website')
                ->attributes(['disabled'])
                ->url('https://batman.com')
                ->renderWhen(function () {
                    return true;
                }),
            NavButton::make()
                ->text('Nav Button')
                ->onClick('window.location = window.location')
                ->render(),
            NavDropdown::make()
                ->items([
                    DropdownItem::make()->text('batman')->url('batman.com')->render(),
                    DropdownItem::make()->text('superman')->url('superman.com')->render(),
                    DropdownDivider::make()->text('superman')->url('superman.com')->render(),
                    DropdownItemButton::make()->text('superman-button')->onClick("window.location = 'https://marvel.com'")->render(),
                ])
                ->text('Nav Dropdown Button')
                ->render(),
        ])->id('supermanIsGood')->pills()->render();

        $this->assertStringContainsString('<div class="dropdown-divider"></div>', $html);
        $this->assertStringContainsString('<ul id="supermanIsGood" class="nav nav-pills">', $html);
        $this->assertStringContainsString('<a disabled href="https://batman.com" class="nav-link">Nav Link Website', $html);
        $this->assertStringContainsString('<li class="nav-item dropdown">', $html);
    }
}
