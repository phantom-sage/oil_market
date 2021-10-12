<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\SellBill;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class SellBillTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(SellBill::class);

        $component->assertStatus(200);
    }

    /** @test  */
    public function sell_bill_validation()
    {
        Livewire::test(SellBill::class)
            ->set('item_barcode', '')
            ->set('item_name', '')
            ->assertHasErrors(['item_barcode', 'item_name']);
    }

    /**
     * @test
     */
    public function add_bill()
    {
        Customer::factory()->count(1)->create();
        Item::factory()->count(1)->create();
        Livewire::test(SellBill::class)
            ->set('item_barcode', Item::first()->barcode)
            ->set('item_name', Item::first()->name)
            ->set('item_unit', Item::first()->unit->name)
            ->set('item_group', Item::first()->group->name)
            ->set('item_quantity_on_show', Item::first()->quantity_on_show)
            ->set('item_quantity_in_stock', Item::first()->quantity_in_stock)
            ->set('customer_id', Customer::first()->id)
            ->set('selling_place', Str::random(8))
            ->set('selling_type', Str::random(8))
            ->set('item_amount', $this->faker->randomDigit())
            ->set('group_price', $this->faker->randomFloat(2, 1, 1000))
            ->set('individual_price', $this->faker->randomFloat(2, 1, 1000))
            ->set('discount', $this->faker->randomFloat(2, 1, 1000))
            ->set('opened_balance', $this->faker->randomFloat(2, 1, 1000))
            ->set('payed', $this->faker->randomFloat(2, 1, 1000))
            ->set('money', $this->faker->randomFloat(2, 1, 1000))
            ->call('saveSellBill');
        $this->assertDatabaseCount('sell_bills', 1);
        $this->assertDatabaseCount('customers', 1);
    }
}
