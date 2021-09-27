<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker = \Faker\Factory::create('ar_SA');
        return [
            'name' => $this->faker->unique()->name,
            'barcode' => Str::random(16),
            'purchasing_price' => $this->faker->randomFloat(2, 0, 10000),
            'wholesale_price' => $this->faker->randomFloat(2, 0, 10000),
            'selling_price' => $this->faker->randomFloat(2, 0, 10000),
            'quantity_on_show' => $this->faker->randomDigit(),
            'quantity_in_stock' => $this->faker->randomDigit(),
            'group_id' => Group::factory(),
            'unit_id' => Unit::factory(),
        ];
    }
}
