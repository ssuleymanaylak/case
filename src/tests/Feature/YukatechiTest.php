<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Yukatechtest;

class YukatechiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_location()
    {
        $response = $this->postJson('/api/locations', [
            'name' => 'Test Location',
            'latitude' => 40.7128,
            'longitude' => -74.0060,
            'color' => '#FF5733',
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Location added!',
                     'data' => [
                         'name' => 'Test Location',
                         'latitude' => 40.7128,
                         'longitude' => -74.0060,
                         'color' => '#FF5733',
                     ]
                 ]);
    }

    public function test_can_list_locations()
    {
        Yukatechtest::factory()->count(3)->create();
        $response = $this->getJson('/api/locations');
        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_can_update_location()
    {
        $location = Yukatechtest::factory()->create();

        $response = $this->putJson("/api/locations/{$location->id}", [
            'name' => 'Updated Location',
            'latitude' => 40.73061,
            'longitude' => -73.935242,
            'color' => '#00FF00',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Location updated!',
                     'data' => [
                         'name' => 'Updated Location',
                         'latitude' => 40.73061,
                         'longitude' => -73.935242,
                         'color' => '#00FF00',
                     ]
                 ]);
    }

    public function test_can_delete_location()
    {
        $location = Yukatechtest::factory()->create();
        $response = $this->deleteJson("/api/locations/{$location->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('locations', ['id' => $location->id]);
    }

    public function test_can_get_location_details()
    {
        $location = Yukatechtest::factory()->create();
        $response = $this->getJson("/api/locations/{$location->id}");
        $response->assertStatus(200)
                 ->assertJson(['id' => $location->id]);
    }
}

