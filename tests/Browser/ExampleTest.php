<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $date_time = now()->format('Ymd_His');
            $screenshot_name = 'test' . $date_time;
            $browser->visit('/')
                    ->pause(3000)
                    ->screenshot($screenshot_name);
        });
    }
}
