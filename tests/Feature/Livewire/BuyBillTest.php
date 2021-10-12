<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\BuyBill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BuyBillTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(BuyBill::class);

        $component->assertStatus(200);
    }
}
