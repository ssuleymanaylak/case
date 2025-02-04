<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Yukatechtest;
use Illuminate\Testing\Fluent\AssertableJson;

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

    public function it_returns_sorted_locations_by_proximity()
    {
        // Arrange: Create test locations
        $locations = [
            Yukatechtest::factory()->create(['latitude' => 40.0, 'longitude' => -74.0]), // A
            Yukatechtest::factory()->create(['latitude' => 40.1, 'longitude' => -74.1]), // B
            Yukatechtest::factory()->create(['latitude' => 39.9, 'longitude' => -73.9]), // C
        ];

        $lat = 40.0;
        $lng = -74.0;

        // Act: Call the route API
        $response = $this->getJson('/api/locations/route?lat=' . $lat . '&lng=' . $lng);

        // Assert: Check if the response is sorted by distance
        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJson(fn (AssertableJson $json) =>
                $json->where('0.id', $locations[0]->id)
                    ->whereNot('1.id', $locations[0]->id)
            );
    }
}

