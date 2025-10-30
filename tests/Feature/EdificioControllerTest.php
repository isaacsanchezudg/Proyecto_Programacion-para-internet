<?php
// tests/Feature/EdificioControllerTest.php
public function test_agregar_aula_a_edificio()
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