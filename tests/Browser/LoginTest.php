<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */

    public function testLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $date_time = now()->format('Ymd_His');
            $screenshot_name = 'test' . $date_time;
            $user = User::factory()->create();
            $browser->visit('/login')
                    ->pause(3000)
                    ->screenshot($screenshot_name)
                    ->assertSee('Forgot your password?');
        });
    }

}
