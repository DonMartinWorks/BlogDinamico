<?php

namespace Tests\Feature\Navigation;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Http\Livewire\Navigation\Item;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Esta prueba corrobora que el componente (ITEM) sea visible en la vista.
     *
     * @test
     */
    public function item_component_can_be_rendered()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(Item::class)->assertStatus(200);
    }

    /**
     * Esta prueba corrobora el usuario pueda crear un nuevo item.
     *
     * @test
     */
    public function user_admin_can_add_a_new_item()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(Item::class)
            ->set('item.label', 'New Label')
            ->set('item.link', '#newlabel')
            ->call('save');

        $this->assertDatabaseHas('navitems', ['label' => 'New Label', 'link' => '#newlabel']);
    }
}
