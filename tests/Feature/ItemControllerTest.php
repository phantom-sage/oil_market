<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ItemControllerTest extends TestCase
{
    private const PERCENTAGE = 1.2;
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


    /**
     * Test case for upload item image
     *
     * @return void
     */
    public function test_item_image_upload()
    {
        $this->withoutExceptionHandling();
        Group::factory()->count(1)->create();
        Unit::factory()->count(1)->create();
        Storage::fake('public');

        $file = UploadedFile::fake()->image('item_image.jpg');

        $response = $this->post(route('items.store'), [
            'name' => $this->faker->name(),
            'barcode' => Str::random(8),
            'purchasing_price' => $this->faker->randomFloat(2, 0, 10000),
            'wholesale_price' => $this->faker->randomFloat(2, 0, 10000),
            'selling_price' => $this->faker->randomFloat(2, 0, 10000),
            'quantity_on_show' => $this->faker->randomDigit(),
            'quantity_in_stock' => $this->faker->randomDigit(),
            'group_id' => Group::first()->id,
            'unit_id' => Unit::first()->id,
            'image' => $file,
        ]);

        Storage::disk('public')->assertExists('item_image/' . $file->hashName());
    }


    /**
     * Test case for update items price ( plus case ).
     *
     * @return void
     */
    public function test_update_prices_when_prices_are_plus()
    {
        $this->withoutExceptionHandling();
        Item::factory()->count(3)->create();
        $this->assertDatabaseCount('items', 3);

        $selling_prices = array();
        $purchasing_prices = array();
        $wholesale_prices = array();
        foreach (Item::all() as $item) {
            $selling_prices[] = $item['selling_price'];
            $purchasing_prices[] = $item['purchasing_price'];
            $wholesale_prices[] = $item['wholesale_price'];
        }
        $data = [
            'items' => __('launcher.all'),
            'type' => 'plus',
            'percentage' => self::PERCENTAGE,
        ];
        $response = $this->put(route('items.update.prices'), $data);

        // case 0: update all items price ( plus case )
        $count = 0;
        foreach (Item::all() as $item)
        {
            $expected = $item['selling_price'];
            $actual = $this->truncate($selling_prices[$count] + self::PERCENTAGE / 100, '3');
            $this->assertEquals($expected, $actual);

            $expected = $item['purchasing_price'];
            $actual = $this->truncate($purchasing_prices[$count] + self::PERCENTAGE / 100, '3');
            $this->assertEquals($expected, $actual);

            $expected = $item['wholesale_price'];
            $actual = $this->truncate($wholesale_prices[$count] + self::PERCENTAGE / 100, '3');
            $this->assertEquals($expected, $actual);
            ++$count;
        }

        $response->assertRedirect(route('items.index'))->assertSessionHas('items_price_updated_successfully');
    }


    /**
     * Test case for update items price ( minus case ).
     *
     * @return void
     */
    public function test_update_prices_when_prices_are_minus()
    {
        $this->withoutExceptionHandling();
        Item::factory()->count(3)->create();
        $this->assertDatabaseCount('items', 3);

        $selling_prices = array();
        $purchasing_prices = array();
        $wholesale_prices = array();
        foreach (Item::all() as $item) {
            $selling_prices[] = $item['selling_price'];
            $purchasing_prices[] = $item['purchasing_price'];
            $wholesale_prices[] = $item['wholesale_price'];
        }
        $data = [
            'items' => __('launcher.all'),
            'type' => 'minus',
            'percentage' => self::PERCENTAGE,
        ];

        $response = $this->put(route('items.update.prices'), $data);

        // case 0: update all items price ( minus case )
        $count = 0;
        foreach (Item::all() as $item)
        {
            $expected = $item['selling_price'];
            $actual = $this->truncate($selling_prices[$count] - (self::PERCENTAGE / 100), '3');
            $this->assertEquals($expected, $actual);

            $expected = $item['purchasing_price'];
            $actual = $this->truncate($purchasing_prices[$count] - (self::PERCENTAGE / 100), '3');
            $this->assertEquals($expected, $actual);

            $expected = $item['wholesale_price'];
            $actual = $this->truncate($wholesale_prices[$count] - (self::PERCENTAGE / 100), '3');
            $this->assertEquals($expected, $actual);
            ++$count;
        }

        $response->assertRedirect(route('items.index'))->assertSessionHas('items_price_updated_successfully');
    }

    /**
     * Test case for update specific item price ( item not found ).
     *
     * @return void
     */
    public function test_update_specific_item_price_when_item_not_found()
    {
        $this->withoutExceptionHandling();
        Item::factory()->count(1)->create();
        $this->assertDatabaseCount('items', 1);

        $data = [
            'items' => 12,
            'type' => 'minus',
            'percentage' => self::PERCENTAGE,
        ];

        $response = $this->put(route('items.update.prices'), $data);
        $response->assertRedirect(route('items.index'))->assertSessionHas('item_not_found');
    }

    /**
     * Test case for update specific item price ( plus ).
     *
     * @return void
     */
    public function test_update_specific_item_price_when_price_is_plus()
    {
        $this->withoutExceptionHandling();
        Item::factory()->count(1)->create();
        $this->assertDatabaseCount('items', 1);

        $selling_price = Item::first()->selling_price;
        $purchasing_price = Item::first()->purchasing_price;
        $wholesale_price = Item::first()->wholesale_price;

        $data = [
            'items' => Item::first()->id,
            'type' => 'plus',
            'percentage' => self::PERCENTAGE,
        ];

        $response = $this->put(route('items.update.prices'), $data);

        $expected = Item::first()->selling_price;
        $actual = $this->truncate($selling_price + self::PERCENTAGE / 100, '3');
        $this->assertEquals($expected, $actual);

        $expected = Item::first()->purchasing_price;
        $actual = $this->truncate($purchasing_price + self::PERCENTAGE / 100, '3');
        $this->assertEquals($expected, $actual);


        $expected = Item::first()->wholesale_price;
        $actual = $this->truncate($wholesale_price + self::PERCENTAGE / 100, '3');
        $this->assertEquals($expected, $actual);

        $response->assertRedirect(route('items.index'))->assertSessionHas('items_price_updated_successfully');
    }


    /**
     * Test case for update specific item price ( minus ).
     *
     * @return void
     */
    public function test_update_specific_item_price_when_price_is_minus()
    {
        $this->withoutExceptionHandling();
        Item::factory()->count(1)->create();
        $this->assertDatabaseCount('items', 1);

        $selling_price = Item::first()->selling_price;
        $purchasing_price = Item::first()->purchasing_price;
        $wholesale_price = Item::first()->wholesale_price;

        $data = [
            'items' => Item::first()->id,
            'type' => 'minus',
            'percentage' => self::PERCENTAGE,
        ];

        $response = $this->put(route('items.update.prices'), $data);

        $expected = Item::first()->selling_price;
        $actual = $this->truncate($selling_price - self::PERCENTAGE / 100, '3');
        $this->assertEquals($expected, $actual);

        $expected = Item::first()->purchasing_price;
        $actual = $this->truncate($purchasing_price - self::PERCENTAGE / 100, '3');
        $this->assertEquals($expected, $actual);


        $expected = Item::first()->wholesale_price;
        $actual = $this->truncate($wholesale_price - self::PERCENTAGE / 100, '3');
        $this->assertEquals($expected, $actual);

        $response->assertRedirect(route('items.index'))->assertSessionHas('items_price_updated_successfully');
    }


    /**
    * @example truncate(-1.49999, 2); // returns -1.49
    * @example truncate(.49999, 3); // returns 0.499
    * @param float $val
    * @param int f
     * @return float
   */
    function truncate($val, $f="0")
    {
        if(($p = strpos($val, '.')) !== false) {
            $val = floatval(substr($val, 0, $p + 1 + $f));
        }
        return $val;
    }
}
