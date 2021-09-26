<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_store_route()
    {
        $data = [
            'name' => $this->faker->name,
        ];
        $resp = $this->post(route('customers.store'), $data);
        $resp->assertRedirect(route('launcher'))
            ->assertSessionHas('message', __('messages.new_customer_created'));
        $this->assertDatabaseCount('customers', 1);
    }
}
