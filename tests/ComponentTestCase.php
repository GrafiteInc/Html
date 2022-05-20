<?php

namespace Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;

abstract class ComponentTestCase extends TestCase
{
    use InteractsWithViews;
}
