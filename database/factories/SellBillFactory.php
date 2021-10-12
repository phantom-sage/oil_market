<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\SellBill;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SellBillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SellBill::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_barcode' => Str::random(8),
            'item_name' => Str::random(8),
            'item_unit' => Str::random(8),
            'item_group' => Str::random(8),
            'item_quantity_on_show' => $this->faker->randomDigit(),
            'item_quantity_in_stock' => $this->faker->randomDigit(),
            'customer_id' => Customer::factory(),
            'selling_place' => Str::random(4),
            'selling_type' => Str::random(4),
            'item_amount' => $this->faker->randomDigit(),
            'group_price' => $this->faker->randomFloat(2, 1, 1000),
            'individual_price' => $this->faker->randomFloat(2, 1, 1000),
            'discount' => $this->faker->randomFloat(2, 1, 1000),
            'opened_balance' => $this->faker->randomFloat(2, 1, 1000),
            'payed' => $this->faker->randomFloat(2, 1, 1000),
            'money' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
