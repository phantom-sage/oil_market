<?php

namespace Tests\Browser;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\CreateVendor;
use Tests\DuskTestCase;

class CreateVendorTest extends DuskTestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test case for insert new vendor record.
     *
     * @return void
     */
    public function test_create_new_vendor_record()
    {
        $this->faker = Factory::create('ar_SA');
        $this->browse(function (Browser $browser) {
            $browser->visit(new CreateVendor())
                    ->typeSlowly('@name', $this->faker->unique()->name(), 100)
                ->click('@submitBtn')
                ->assertPathIs('/launcher');
            $this->assertDatabaseCount('vendors', 1);
        });
    }
}
