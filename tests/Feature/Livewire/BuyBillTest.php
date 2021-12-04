<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\BuyBill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Vendor;
use App\Models\Item;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Support\Str;

class BuyBillTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     *
     * @return void
     */
    public function test_the_component_can_render()
    {
        $component = Livewire::test(BuyBill::class);

        $component->assertStatus(200);
    }

    /**
     *
     * @return void
     */
    public function test_add_bill_where_dropping_place_is_repository()
    {
        /*
        'item_barcode' => ['required'],
        'item_name' => ['required'],
        'item_unit' => ['required'],
        'item_group' => ['required'],
        'item_quantity_in_stock' => ['required'],
        'item_quantity_on_show' => ['required'],
        'vendor_id' => ['required'],
        'payment_method' => ['required'],
        'dropping_place' => ['required'],
        'buying_type' => ['required'],
        'amount' => ['required'],
        'group_price' => ['sometimes'],
        'buying_price' => ['sometimes'],
        'payed' => ['sometimes'],
        'money' => ['required'],

        if ($this->dropping_place == __('launcher.repository'))
            {
                $item = Item::where('barcode', $this->item_barcode)->first();
                $item['quantity_in_stock'] = $item['quantity_in_stock'] + $this->amount;
                $item->save();

                $buy_bill = new \App\Models\BuyBill();
                $buy_bill['item_barcode'] = $this->item_barcode;
                $buy_bill['item_name'] = $this->item_name;
                $buy_bill['group_name'] = $this->item_group;
                $buy_bill['unit_name'] = $this->item_unit;
                $buy_bill['dropping_place'] = $this->dropping_place;
                $buy_bill['buying_type'] = $this->buying_type;
                $buy_bill['amount'] = $this->amount;
                $buy_bill['group_price'] = $this->group_price ?? 0.0;
                $buy_bill['individual_price'] = $this->buying_price ?? 0.0;
                $buy_bill['payed'] = $this->payed ?? 0.0;
                $buy_bill['money'] = $this->money;
                $buy_bill['item_quantity_on_show'] = $this->item_quantity_on_show;
                $buy_bill['item_quantity_in_stock'] = $this->item_quantity_in_stock;
                $buy_bill['vendor_id'] = $this->vendor_id;
                $buy_bill['payment_method'] = $this->payment_method;
                $buy_bill->save();
                return redirect()
                    ->route('buy.bill')
                    ->with('message', 'Buyed successfully');
            }*/
        Vendor::factory()->count(1)->create();
        Item::factory()->count(1)->create();
        Livewire::test(BuyBill::class)
            ->set('item_barcode', Item::first()->barcode)
            ->set('item_name', Item::first()->name)
            ->set('item_unit', Item::first()->unit->name)
            ->set('item_group', Item::first()->group->name)
            ->set('item_quantity_on_show', Item::first()->quantity_on_show)
            ->set('item_quantity_in_stock', Item::first()->quantity_in_stock)
            ->set('vendor_id', Vendor::first()->id)
            ->set('dropping_place', __('launcher.repository'))
            ->set('buying_type', Str::random(8))
            ->set('amount', $this->faker->randomDigit())
            ->set('group_price', $this->faker->randomFloat(2, 1, 1000))
            ->set('buying_price', $this->faker->randomFloat(2, 1, 1000))
            ->set('payment_method', Str::random(8))
            ->set('payed', $this->faker->randomFloat(2, 1, 1000))
            ->set('money', $this->faker->randomFloat(2, 1, 1000))
            ->call('saveBuyBill');
        $this->assertDatabaseCount('buy_bills', 1);
        $this->assertDatabaseCount('vendors', 1);
    }
}
