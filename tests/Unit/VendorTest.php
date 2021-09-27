<?php

namespace Tests\Unit;

use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VendorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test case for create new vendor record.
     *
     */
    public function test_create_vendor_with_factory()
    {
        Vendor::factory()->count(1)->create();
        $this->assertDatabaseCount('vendors', 1);
    }
}
