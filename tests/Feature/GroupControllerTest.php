<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;


    /**
     * Test case for create group route.
     *
     */
    public function test_create_group_route()
    {
        $this->withoutExceptionHandling();
       $this->get(route('groups.create'))
       ->assertOk()
           ->assertViewIs('group.create');
    }


    /**
     * Test case for store group route.
     *
     */
    public function test_store_group_route()
    {
        $data = [
            'name' => $this->faker->name(),
        ];
        $resp = $this->post(route('groups.store'), $data);
        $resp->assertSessionHas('message', 'message.new_group_created')
        ->assertRedirect();
        $this->assertDatabaseCount('groups', 1);
    }
}
