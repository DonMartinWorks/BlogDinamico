<?php

namespace Tests\Feature\Navigation;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Navitem;
use App\Http\Livewire\Navigation\Navigation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NavigationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Esta prueba corrobora que el componente (NAVIGATION) sea visible en la vista.
     *
     * @test
     */
    public function navigation_component_can_be_rendered()
    {
        $this->get('/')->assertStatus(200)->assertSeeLivewire('navigation.navigation');
    }

    /**
     * Esta prueba se encarga de cargar y renderizar los enlaces a la vista.
     *
     * @test
     */
    public function component_can_load_items_navigation()
    {
        $items = Navitem::factory(3)->create();

        Livewire::test(Navigation::class)
            ->assertSee($items->first()->label)
            ->assertSee($items->first()->link);
    }

    /**
     * Esta prueba se corrobora que solo el usuario autenticado pueda acceder a los botones de la vista.
     *
     * @test
     */
    public function only_admin_can_see_navigation_actions()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)->test(Navigation::class)
            ->assertStatus(200)
            ->assertSee(__('Edit'))
            ->assertSee(__('New'));
    }

    /**
     * Esta prueba se corrobora que solo el usuario autenticado pueda acceder a los botones de la vista.
     *
     * @test
     */
    public function guests_cannot_see_navigation_actions()
    {
        Livewire::test(Navigation::class)
            ->assertStatus(200)
            ->assertDontSee(__('Edit'))
            ->assertDontSee(__('New'));

        $this->assertGuest();
    }

    /**
     * Esta prueba se corrobora que solo el usuario autenticado pueda editar los navitems
     * y estos cambios se vean reflejados en la vista.
     *
     * @test
     */
    public function only_admin_can_edit_items()
    {
        $user = User::factory()->create();
        $items = Navitem::factory(2)->create();

        Livewire::actingAs($user)->test(Navigation::class)
            ->set('items.0.label', 'My Projects')
            ->set('items.0.link', '#myprojects')
            ->set('items.1.label', 'Contact Me')
            ->set('items.1.link', '#contactme')
            ->call('edit');

        $this->assertDatabaseHas('navitems', [
            'id' => $items->first()->id,
            'label' => 'My Projects',
            'link' => '#myprojects'
        ]);

        $this->assertDatabaseHas('navitems', [
            'id' => $items->last()->id,
            'label' => 'Contact Me',
            'link' => '#contactme'
        ]);
    }

    /**
     * Esta prueba se corrobora que solo el usuario autenticado pueda eliminar los navitems
     * y estos cambios se vean reflejados en la vista.
     *
     * @test
     */
    public function only_admin_can_delete_an_item()
    {
        $user = User::factory()->create();
        $item = Navitem::factory()->create();

        Livewire::actingAs($user)->test(Navigation::class)->call('deleteItem', $item);

        $this->assertDatabaseMissing('navitems', ['id' => $item->id]);
    }

    /**
     * Esta prueba se corrobora que label sea obligatorio al actualizar.
     *
     * @test
     */
    public function label_navigation_of_items_is_required()
    {
        $user = User::factory()->create();
        $items = Navitem::factory(2)->create();

        Livewire::actingAs($user)->test(Navigation::class)
            ->set('items.0.label', '')
            ->set('items.1.label', '')
            ->call('edit')
            ->assertHasErrors(['items.0.label' => 'required'])
            ->assertHasErrors(['items.1.label' => 'required']);
    }

    /**
     * Esta prueba se corrobora que link sea obligatorio al actualizar.
     *
     * @test
     */
    public function link_navigation_of_items_is_required()
    {
        $user = User::factory()->create();
        $items = Navitem::factory(2)->create();

        Livewire::actingAs($user)->test(Navigation::class)
            ->set('items.0.link', '')
            ->set('items.1.link', '')
            ->call('edit')
            ->assertHasErrors(['items.0.link' => 'required'])
            ->assertHasErrors(['items.1.link' => 'required']);
    }

    /**
     * Esta prueba se corrobora que link no supere 20 caracteres al actualizar.
     *
     * @test
     */
    public function label_of_must_have_a_maxium_of_20_characters()
    {
        $user = User::factory()->create();
        $items = Navitem::factory(2)->create();

        Livewire::actingAs($user)->test(Navigation::class)
            ->set('items.0.label', 'QWERTYUIOP0987654321Z')
            ->set('items.1.label', 'QWERTYUIOP0987654321Z')
            ->call('edit')
            ->assertHasErrors(['items.0.label' => 'max'])
            ->assertHasErrors(['items.1.label' => 'max']);
    }

    /**
     * Esta prueba se corrobora que label no supere 40 caracteres al actualizar.
     *
     * @test
     */
    public function link_of_must_have_a_maxium_of_40_characters()
    {
        $user = User::factory()->create();
        $items = Navitem::factory(2)->create();

        Livewire::actingAs($user)->test(Navigation::class)
            ->set('items.0.link', 'QWERTYUIOP0987654321ZQWERTYUIOP0987654321Z')
            ->set('items.1.link', 'QWERTYUIOP0987654321ZQWERTYUIOP0987654321Z')
            ->call('edit')
            ->assertHasErrors(['items.0.link' => 'max'])
            ->assertHasErrors(['items.1.link' => 'max']);
    }
}
