<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VendorControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test case for store vendor.
     *
     */
    public function test_store_route()
    {
        $data = [
            'name' => $this->faker->unique()->name(),
        ];

        $resp = $this->post(route('vendors.store'), $data);
        $resp->assertRedirect(route('launcher'))
            ->assertSessionHas('message', __('messages.new_vendor_created'));
        $this->assertDatabaseCount('vendors', 1);
    }
}
