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

    /**
     * Esta prueba se corrobora que label sea obligatorio.
     *
     * @test
     */
    public function label_is_required()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(Item::class)
            ->set('item.label', '')
            ->set('item.link', '#mylink')
            ->call('save')
            ->assertHasErrors(['item.label' => 'required']);
    }

    /**
     * Esta prueba se corrobora que label no supere 20 caracteres.
     *
     * @test
     */
    public function label_of_must_have_a_maxium_of_20_characters()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(Item::class)
            ->set('item.label', 'QWERTYUIOP0987654321Z')
            ->set('item.link', '#mylink')
            ->call('save')
            ->assertHasErrors(['item.label' => 'max']);
    }

    /**
     * Esta prueba se corrobora que link sea obligatorio.
     *
     * @test
     */
    public function link_is_required()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(Item::class)
            ->set('item.label', 'Mi link')
            ->set('item.link', '')
            ->call('save')
            ->assertHasErrors(['item.link' => 'required']);
    }

    /**
     * Esta prueba se corrobora que link no supere 40 caracteres.
     *
     * @test
     */
    public function link_of_must_have_a_maxium_of_40_characters()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(Item::class)
            ->set('item.label', 'QWERTYUIOP0987654321Z')
            ->set('item.link', '#QWERTYUIOP0987654321ZQWERTYUIOP0987654321Z')
            ->call('save')
            ->assertHasErrors(['item.link' => 'max']);
    }
}
