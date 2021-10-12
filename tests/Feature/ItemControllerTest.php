<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\Item;
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

    public function test_move_item_to_stock_when_it_petro_12()
    {
        Item::factory()->count(1)->create([
            'name' => __('item.petro_12'),
            'quantity_on_show' => 2,
            'quantity_in_stock' => 12,
        ]);
        $data = [
            'item_id' => Item::first()->id,
            'item_amount' => 10,
        ];
        $resp = $this->post(route('items.move.to.show'), $data);
        $resp->assertRedirect(route('items.index'))
            ->assertSessionHas('message', __('messages.item_move_to_show_successfully'));
        $this->assertDatabaseCount('items', 1);
        $this->assertEquals(Item::first()->quantity_in_stock, 2);
        $this->assertEquals(Item::first()->quantity_on_show, 122);
    }

    public function test_move_item_to_stock_when_it_petro_6()
    {
        Item::factory()->count(1)->create([
            'name' => __('item.petro_6'),
            'quantity_on_show' => 5,
            'quantity_in_stock' => 34,
        ]);
        $data = [
            'item_id' => Item::first()->id,
            'item_amount' => 30,
        ];
        $resp = $this->post(route('items.move.to.show'), $data);
        $resp->assertRedirect(route('items.index'))
            ->assertSessionHas('message', __('messages.item_move_to_show_successfully'));
        $this->assertDatabaseCount('items', 1);
        $this->assertEquals(Item::first()->quantity_in_stock, 4);
        $this->assertEquals(Item::first()->quantity_on_show, 185);
    }

    /**
     * Test case when item moved and hit the else branch.
     *
     */
    public function test_move_item_to_stock_when_it_not_in_list()
    {
        Item::factory()->count(1)->create([
            'quantity_on_show' => 1,
            'quantity_in_stock' => 5,
        ]);
        $data = [
            'item_id' => Item::first()->id,
            'item_amount' => 5,
        ];
        $resp = $this->post(route('items.move.to.show'), $data);
        $resp->assertRedirect(route('items.index'))
            ->assertSessionHas('message', __('messages.item_move_to_show_successfully'));
        $this->assertDatabaseCount('items', 1);
        $this->assertEquals(Item::first()->quantity_in_stock, 0);
        $this->assertEquals(Item::first()->quantity_on_show, 6);
    }
}
