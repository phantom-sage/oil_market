<?php

namespace Tests\Unit;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test case for create new group record
     *
     */
    public function test_create_new_group_with_factory()
    {
        Group::factory()->count(1)->create();
        $this->assertDatabaseCount('groups', 1);
    }
}
