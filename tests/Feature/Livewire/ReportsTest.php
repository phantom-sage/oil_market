<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Reports;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ReportsTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Reports::class);

        $component->assertStatus(200);
    }
}
