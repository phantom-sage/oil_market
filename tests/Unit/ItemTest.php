<?php

namespace Tests\Unit;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test case for create new record of item with factory.
     *
     * @return void
     */
    public function test_create_item_with_factory()
    {
        $this->withoutExceptionHandling();
        Item::factory()->count(1)->create();
        $this->assertDatabaseCount('units', 1);
        $this->assertDatabaseCount('groups', 1);
        $this->assertDatabaseCount('items', 1);
    }
}
