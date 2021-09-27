<?php

namespace Tests\Browser;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\CreateUnit;
use Tests\DuskTestCase;

class CreateUnitTest extends DuskTestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * Test case for insert new unit record.
     *
     * @return void
     */
    public function test_store_unit()
    {
        $this->faker = Factory::create('ar_SA');
        $this->browse(function (Browser $browser) {
            $browser->visit(new CreateUnit())
                    ->typeSlowly('@name', $this->faker->unique()->name(), 100)
                ->click('#submitBtn')
            ->assertPathIs('/launcher');
            $this->assertDatabaseCount('units', 1);
        });
    }
}
