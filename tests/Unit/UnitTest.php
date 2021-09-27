<?php

namespace Tests\Unit;

use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnitTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test case for create new unit record using factory.
     *
     */
    public function test_create_unit_with_factory()
    {
        Unit::factory()->count(1)->create();
        $this->assertDatabaseCount('units', 1);
    }
}
