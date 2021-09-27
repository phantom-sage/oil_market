<?php

namespace Tests\Feature;

use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test case for store customer route.
     *
     */
    public function test_store_route()
    {
        $this->faker = Faker::create('ar_SA');
        $data = [
            'name' => $this->faker->name,
        ];
        $resp = $this->post(route('customers.store'), $data);
        $resp->assertRedirect(route('launcher'))
            ->assertSessionHas('message', __('messages.new_customer_created'));
        $this->assertDatabaseCount('customers', 1);
    }

    /**
     * Test case for create customer route.
     *
     */
    public function test_create_route()
    {
        $this->get(route('customers.create'))
            ->assertOk()
            ->assertViewIs('customer.create');
    }
}
