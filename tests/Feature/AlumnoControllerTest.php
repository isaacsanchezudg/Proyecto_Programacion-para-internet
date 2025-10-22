<?php

namespace Tests\Feature;

use App\Models\Alumno;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlumnoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function se_puede_listar_alumnos()
    {
        // Crear dos alumnos de prueba
        $alumno1 = Alumno::factory()->create();
        $alumno2 = Alumno::factory()->create();

        // Hacer petición GET a la ruta index
        $response = $this->get(route('alumnos.index'));

        // Verificar que la respuesta sea exitosa
        $response->assertStatus(200);

        // Verificar que se muestren los alumnos en la vista
        $response->assertSee($alumno1->nombre);
        $response->assertSee($alumno2->nombre);
        $response->assertSee($alumno1->codigo);
        $response->assertSee($alumno2->codigo);
    }

    /** @test */
    public function se_puede_mostrar_formulario_de_creacion()
    {
        $response = $this->get(route('alumnos.create'));

        $response->assertStatus(200);
        $response->assertSee('Registrar Nuevo Alumno');
        $response->assertSee('Código');
        $response->assertSee('Nombre');
        $response->assertSee('Correo');
    }

    /** @test */
    public function se_puede_crear_un_alumno()
    {
        $alumnoData = [
            'codigo' => 'AL9999',
            'nombre' => 'Juan Pérez Test',
            'correo' => 'juan.test@ejemplo.com',
            'fecha_nacimiento' => '2000-01-01',
            'sexo' => 'M',
            'carrera' => 'Ingeniería de Testing'
        ];

        $response = $this->post(route('alumnos.store'), $alumnoData);

        $response->assertRedirect(route('alumnos.index'));
        $this->assertDatabaseHas('alumnos', [
            'codigo' => 'AL9999',
            'nombre' => 'Juan Pérez Test'
        ]);
    }

    /** @test */
    public function se_puede_mostrar_formulario_de_edicion()
    {
        $alumno = Alumno::factory()->create();

        $response = $this->get(route('alumnos.edit', $alumno));

        $response->assertStatus(200);
        $response->assertSee('Editar Alumno');
        $response->assertSee($alumno->nombre);
        $response->assertSee($alumno->codigo);
    }

    /** @test */
    public function se_puede_actualizar_un_alumno()
    {
        $alumno = Alumno::factory()->create();

        $nuevosDatos = [
            'codigo' => 'AL8888',
            'nombre' => 'Nombre Actualizado',
            'correo' => 'actualizado@ejemplo.com',
            'fecha_nacimiento' => '1999-12-31',
            'sexo' => 'F',
            'carrera' => 'Carrera Actualizada'
        ];

        $response = $this->put(route('alumnos.update', $alumno), $nuevosDatos);

        $response->assertRedirect(route('alumnos.index'));
        $this->assertDatabaseHas('alumnos', [
            'id' => $alumno->id,
            'nombre' => 'Nombre Actualizado',
            'codigo' => 'AL8888'
        ]);
    }

    /** @test */
    public function se_puede_mostrar_detalle_de_alumno()
    {
        $alumno = Alumno::factory()->create();

        $response = $this->get(route('alumnos.show', $alumno));

        $response->assertStatus(200);
        $response->assertSee($alumno->nombre);
        $response->assertSee($alumno->codigo);
        $response->assertSee($alumno->correo);
    }

    /** @test */
    public function se_puede_eliminar_un_alumno()
    {
        $alumno = Alumno::factory()->create();

        $response = $this->delete(route('alumnos.destroy', $alumno));

        $response->assertRedirect(route('alumnos.index'));
        $this->assertDatabaseMissing('alumnos', [
            'id' => $alumno->id
        ]);
    }

    /** @test */
    public function validacion_funciona_al_crear_alumno()
    {
        // Intentar crear alumno sin datos requeridos
        $response = $this->post(route('alumnos.store'), []);

        $response->assertSessionHasErrors([
            'codigo', 'nombre', 'correo', 'fecha_nacimiento', 'sexo', 'carrera'
        ]);
    }
}