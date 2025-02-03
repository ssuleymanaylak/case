<?php

// app/Services/LocationService.php

namespace App\Services;

use App\Repositories\YukatectestRepository
;

class YukatechtestService
{
    protected YukatectestRepository $locationRepository;

    public function __construct(YukatectestRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function createLocation(array $data)
    {
        return $this->locationRepository->create($data);
    }

    public function getAllLocations()
    {
        return $this->locationRepository->getAll();
    }

    public function getLocationById($id)
    {
        return $this->locationRepository->getById($id);
    }

    public function updateLocation($id, array $data)
    {
        return $this->locationRepository->update($id, $data);
    }

    public function getSortedLocationsByDistance($lat, $lng)
    {
        return $this->locationRepository->getAll()
            ->sortBy(fn($location) => $this->haversineDistance($lat, $lng, $location->latitude, $location->longitude))
            ->values();
    }

    private function haversineDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLng / 2) * sin($dLng / 2);

        return 2 * $earthRadius * atan2(sqrt($a), sqrt(1 - $a));
    }
}
