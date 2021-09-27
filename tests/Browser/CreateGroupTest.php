<?php

namespace Tests\Browser;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\CreateGroup;
use Tests\DuskTestCase;

class CreateGroupTest extends DuskTestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test case for store new group record
     *
     * @return void
     */
    public function test_store_group_route()
    {
        $this->faker = Factory::create('ar_SA');
        $this->browse(function (Browser $browser) {
            $browser->visit(new CreateGroup())
                    ->typeSlowly('@name', $this->faker->name())
                ->click('@submitBtn')
            ->assertPathIs('/launcher');
            $this->assertDatabaseCount('groups', 1);
        });
    }
}
