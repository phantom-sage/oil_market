<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UnitControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test case for crate units route.
     *
     */
    public function test_create_route()
    {
        $this->get(route('units.create'))
            ->assertOk()
            ->assertViewIs('unit.create');
    }

    /**
     * Test case for store units route.
     *
     */
    public function test_store_route()
    {
        $data = [
            'name' => $this->faker->unique()->name(),
        ];
        $resp = $this->post(route('units.store'), $data);
        $resp->assertRedirect(route('launcher'))
            ->assertSessionHas('message', __('messages.new_unit_created'));
        $this->assertDatabaseCount('units', 1);
    }
}
