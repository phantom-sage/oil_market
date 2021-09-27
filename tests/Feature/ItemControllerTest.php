<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test case for item store route.
     *
     * @return void
     */
    public function test_store_route()
    {
        $this->withoutExceptionHandling();
        Group::factory()->count(1)->create();
        Unit::factory()->count(1)->create();
        $data = [
            'name' => $this->faker->unique()->name(),
            'barcode' => Str::random(16),
            'purchasing_price' => $this->faker->randomFloat(2, 1, 10000),
            'wholesale_price' => $this->faker->randomFloat(2, 0, 10000),
            'selling_price' => $this->faker->randomFloat(2, 0, 10000),
            'quantity_on_show' => $this->faker->randomDigit(),
            'quantity_in_stock' => $this->faker->randomDigit(),
            'group_id' => Group::first()->id,
            'unit_id' => Unit::first()->id,
        ];
        $resp = $this->post(route('items.store'), $data);
        $resp->assertRedirect(route('launcher'))
            ->assertSessionHas('message', __('messages.new_item_created'));
        $this->assertDatabaseCount('units', 1);
        $this->assertDatabaseCount('groups', 1);
        $this->assertDatabaseCount('items', 1);
    }
}
