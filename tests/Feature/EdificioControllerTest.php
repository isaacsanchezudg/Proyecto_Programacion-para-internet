<?php

namespace Tests\Feature;

use App\Models\Edificio;
use App\Models\Aula;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EdificioControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function se_puede_listar_edificios()
    {
        $edificio1 = Edificio::factory()->create();
        $edificio2 = Edificio::factory()->create();

        $response = $this->get(route('edificios.index'));

        $response->assertStatus(200);
        $response->assertSee($edificio1->nombre);
        $response->assertSee($edificio2->nombre);
    }

    /** @test */
    public function se_puede_mostrar_formulario_de_creacion_de_edificio()
    {
        $response = $this->get(route('edificios.create'));

        $response->assertStatus(200);
        $response->assertSee('Registrar Nuevo Edificio');
        $response->assertSee('Nombre del Edificio');
    }

    /** @test */
    public function se_puede_crear_un_edificio()
    {
        $edificioData = [
            'nombre' => 'Edificio de Prueba',
            'direccion' => 'Dirección de prueba 123',
            'pisos' => 5
        ];

        $response = $this->post(route('edificios.store'), $edificioData);

        $response->assertRedirect(route('edificios.index'));
        $this->assertDatabaseHas('edificios', [
            'nombre' => 'Edificio de Prueba'
        ]);
    }

    /** @test */
    public function se_puede_mostrar_detalle_de_edificio()
    {
        $edificio = Edificio::factory()->create();

        $response = $this->get(route('edificios.show', $edificio));

        $response->assertStatus(200);
        $response->assertSee($edificio->nombre);
        $response->assertSee($edificio->direccion);
    }

    /** @test */
    public function se_puede_mostrar_formulario_de_edicion_de_edificio()
    {
        $edificio = Edificio::factory()->create();

        $response = $this->get(route('edificios.edit', $edificio));

        $response->assertStatus(200);
        $response->assertSee('Editar Edificio');
        $response->assertSee($edificio->nombre);
    }

    /** @test */
    public function se_puede_actualizar_un_edificio()
    {
        $edificio = Edificio::factory()->create();

        $nuevosDatos = [
            'nombre' => 'Edificio Actualizado',
            'direccion' => 'Nueva dirección 456',
            'pisos' => 10
        ];

        $response = $this->put(route('edificios.update', $edificio), $nuevosDatos);

        $response->assertRedirect(route('edificios.index'));
        $this->assertDatabaseHas('edificios', [
            'id' => $edificio->id,
            'nombre' => 'Edificio Actualizado'
        ]);
    }

    /** @test */
    public function se_puede_eliminar_un_edificio()
    {
        $edificio = Edificio::factory()->create();

        $response = $this->delete(route('edificios.destroy', $edificio));

        $response->assertRedirect(route('edificios.index'));
        $this->assertDatabaseMissing('edificios', [
            'id' => $edificio->id
        ]);
    }

    /** @test */
    public function se_puede_agregar_aula_a_edificio()
    {
        $edificio = Edificio::factory()->create(['pisos' => 3]);
        
        $aulaData = [
            'numero' => 'A101',
            'piso' => 1,
            'capacidad' => 30
        ];

        $response = $this->post(route('edificios.aulas.store', $edificio), $aulaData);

        $response->assertRedirect(route('edificios.show', $edificio));
        $this->assertDatabaseHas('aulas', [
            'numero' => 'A101',
            'edificio_id' => $edificio->id
        ]);
    }

    /** @test */
    public function validacion_funciona_al_crear_edificio()
    {
        $response = $this->post(route('edificios.store'), []);

        $response->assertSessionHasErrors([
            'nombre', 'direccion', 'pisos'
        ]);
    }

    /** @test */
    public function validacion_funciona_al_agregar_aula()
    {
        $edificio = Edificio::factory()->create();

        $response = $this->post(route('edificios.aulas.store', $edificio), []);

        $response->assertSessionHasErrors([
            'numero', 'piso', 'capacidad'
        ]);
    }
}