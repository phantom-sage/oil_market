<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\CreateCustomer;
use Tests\DuskTestCase;

class CreateCustomerTest extends DuskTestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_create_new_customer()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new CreateCustomer())
                    ->typeSlowly('@name', $this->faker->name, 100)
                ->click('@submitBtn')
            ->assertPathIs('/launcher');
            $this->assertDatabaseCount('customers', 1);
        });
    }
}
