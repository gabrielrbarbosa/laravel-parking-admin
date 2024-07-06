<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanGetTheirOwnVehicles()
    {
        $john           = User::factory()->create();
        $vehicleForJohn = Vehicle::factory()->create([
            'user_id' => $john->id,
        ]);

        $adam           = User::factory()->create();
        $vehicleForAdam = Vehicle::factory()->create([
            'user_id' => $adam->id,
        ]);

        $response = $this->actingAs($john)->getJson('/api/v1/vehicles');

        $response->assertStatus(200)
            ->assertJsonStructure(['data'])
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.license_plate', $vehicleForJohn->license_plate)
            ->assertJsonMissing($vehicleForAdam->toArray());
    }

    public function testUserCanCreateVehicle()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/vehicles', [
            'license_plate' => 'AAA111',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['data'])
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => ['0' => 'license_plate'],
            ])
            ->assertJsonPath('data.license_plate', 'AAA111');

        $this->assertDatabaseHas('vehicles', [
            'license_plate' => 'AAA111',
        ]);
    }

    public function testUserCanUpdateTheirVehicle()
    {
        $user    = User::factory()->create();
        $vehicle = Vehicle::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->putJson('/api/v1/vehicles/'.$vehicle->id, [
            'license_plate' => 'AAA123',
        ]);

        $response->assertStatus(202)
            ->assertJsonStructure(['license_plate'])
            ->assertJsonPath('license_plate', 'AAA123');

        $this->assertDatabaseHas('vehicles', [
            'license_plate' => 'AAA123',
        ]);
    }

    public function testUserCanDeleteTheirVehicle()
    {
        $user    = User::factory()->create();
        $vehicle = Vehicle::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->deleteJson('/api/v1/vehicles/'.$vehicle->id);

        $response->assertNoContent();

        $this->assertDatabaseMissing('vehicles', [
            'id' => $vehicle->id
        ])->assertDatabaseCount('vehicles', 1);
    }
}
