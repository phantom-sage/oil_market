<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Item;
use App\Models\SellBill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SellBillControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test case for dismiss customer sell bill where selling place is repository.
     *
     * @return void
     */
    public function test_dismiss_sell_bill_where_selling_place_is_repository()
    {
        Item::factory()->count(1)->create();
        SellBill::factory([
            'item_barcode' => Item::first()->barcode,
            'selling_place' => __('launcher.repository'),
        ])->count(1)->create();
        $this->assertDatabaseCount('units', 1);
        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseCount('sell_bills', 1);

        $customer_id = Customer::first()->id;

        $customer_bill = SellBill::where('customer_id', $customer_id)->first();
        $item = Item::where('barcode', $customer_bill->item_barcode)->first();

        $this->assertNotNull($customer_bill);
        $this->assertNotNull($item);


        // todo: case where selling place is repository
        $this->get(route('bill.sell.dismiss', ['customer_bill_id' => Customer::first()->sell_bills->first()->id]))
        ->assertRedirect(route('sell.bill'));

        $this->assertDatabaseCount('units', 1);
        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseCount('sell_bills', 0);
    }


    /**
     * Test case for dismiss customer sell bill where selling place is show.
     *
     * @return void
     */
    public function test_dismiss_sell_bill_where_selling_place_is_show()
    {
        Item::factory()->count(1)->create();
        SellBill::factory([
            'item_barcode' => Item::first()->barcode,
            'selling_place' => __('launcher.show'),
        ])->count(1)->create();
        $this->assertDatabaseCount('units', 1);
        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseCount('sell_bills', 1);

        $customer_id = Customer::first()->id;

        $customer_bill = SellBill::where('customer_id', $customer_id)->first();
        $item = Item::where('barcode', $customer_bill->item_barcode)->first();

        $this->assertNotNull($customer_bill);
        $this->assertNotNull($item);


        $this->get(route('bill.sell.dismiss', ['customer_bill_id' => Customer::first()->sell_bills->first()->id]))
        ->assertRedirect(route('sell.bill'));

        $this->assertDatabaseCount('units', 1);
        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseCount('sell_bills', 0);

    }

    /**
     * Test case for paying part of sell bill.
     *
     * @return void
     */
    public function test_sell_bill_pay_part_update()
    {
        SellBill::factory()->count(1)->create();
        $this->assertDatabaseCount('sell_bills', 1);
        $money_before_pay_part = SellBill::first()->money;
        $data = [
            'payed_amount' => SellBill::first()->money,
        ];
        $this->put(route('bill.sell.pay.part.update', ['sell_bill_id' => SellBill::first()->id]), $data)
        ->assertRedirect(route('sell.bill'));
        $this->assertEquals(0.0, SellBill::first()->money);
        $this->assertEquals($money_before_pay_part, SellBill::first()->payed);
    }
}
