<?php

namespace Tests\Browser;

use App\Models\Group;
use App\Models\Unit;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\CreateItem;
use Tests\DuskTestCase;

class CreateItemTest extends DuskTestCase
{
    use DatabaseMigrations;
    use WithFaker;

    /**
     * Test case for store item record.
     *
     * @return void
     */
    public function test_store_item()
    {
        Group::factory()->count(15)->create();
        Unit::factory()->count(15)->create();

        $this->browse(function (Browser $browser) {
            $browser->visit(new CreateItem())
                    ->typeSlowly('@name', $this->faker->unique()->name, 100)
                ->typeSlowly('@item_barcode', Str::random(16), 100)
                ->typeSlowly('@item_purchasing_price', $this->faker->randomFloat(2, 1, 1000))
                ->typeSlowly('@item_wholesale_price', $this->faker->randomFloat(2, 1, 1000))
                ->typeSlowly('@item_selling_price', $this->faker->randomFloat(2, 1, 1000))
                ->typeSlowly('@item_quantity_on_show', $this->faker->randomDigit())
                ->typeSlowly('@item_quantity_in_stock', $this->faker->randomDigit())
                ->select('group_id')
                ->select('unit_id')
                ->click('@submitBtn')
            ->assertPathIs('/launcher');
            $this->assertDatabaseCount('items', 1);
            $this->assertDatabaseCount('groups', 15);
            $this->assertDatabaseCount('units', 15);
        });
    }
}
