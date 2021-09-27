<?php

namespace Tests\Unit;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Test customer created with faker.
     *
     */
    public function test_create_customer_with_faker()
    {
        Customer::factory()->count(1)->create();
        $this->assertDatabaseCount('customers', 1);
    }
}
